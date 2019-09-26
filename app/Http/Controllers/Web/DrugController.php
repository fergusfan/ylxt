<?php

namespace App\Http\Controllers\Web;

use App\Model\Drug;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DrugController extends Controller
{
    public function index(Request $request)
    {
        $list = new Drug();
        $list = $list->paginate(12);
        return view('web.drug', compact('list'));
    }

    public function info(Request $request)
    {
        $info = new Drug();
        $item = $info->find($request->route('id'));
        return view('web.drug_info', compact('item'));
    }

    public function search(Request $request)
    {
        $q = $request->get('q');
        $list = new Drug();
        $list = $list->where('name','like',"%{$q}%")->paginate(12);
        return view('web.drug', compact('list'));
    }

}
