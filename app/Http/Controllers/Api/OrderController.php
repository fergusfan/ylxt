<?php

namespace App\Http\Controllers\Api;

use App\Model\Order;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;

class OrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $tags = Order::select('orders.*')->orderBy('orders.created_at', 'desc')
            ->join('users',function ($join){
                $join->on('users.id','=','orders.user_id');
            })
            ->when($keyword,function ($query) use($keyword){
                $query->where('users.name','like',"%".$keyword."%");
            })
            ->paginate(10);

        return $this->response->collection($tags);
    }

    /**
     * Show all of the tags.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getList()
    {
        return $this->response->collection(Order::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\TagRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TagRequest $request)
    {
        Order::create($request->all());

        return $this->response->withNoContent();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function edit($id)
    {
        return $this->response->item(Order::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        Order::findOrFail($id)->update($request->except('tag'));

        return $this->response->withNoContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return $this->response->withNoContent();
    }
}


