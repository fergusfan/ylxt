<?php

namespace App\Http\Controllers\Api;

use App\Model\Drug;
use App\Model\Order;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;

class DrugController extends ApiController
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
        $tags = Drug::orderBy('id', 'desc')
            ->when($keyword,function ($query) use($keyword){
                $query->where('name','like',"%".$keyword."%");
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
        return $this->response->collection(Drug::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\TagRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        Drug::create($request->all());

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
        return $this->response->item(Drug::findOrFail($id));
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
        Drug::findOrFail($id)->update($request->except('tag'));

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
        Drug::destroy($id);

        return $this->response->withNoContent();
    }
}
