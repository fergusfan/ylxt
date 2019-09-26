<?php

namespace App\Http\Controllers\Web;

use App\Tag;
use App\User;
use App\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorsController extends Controller
{
    public function list()
    {
        $list = new User();
        $list = $list->where('user_type',1)->with(['doctor'])->paginate(9);
        return view('web.doctors', compact('list'));
    }

    public function question(Request $request,User $user)
    {
        $user = $user->find($request->route('id'));
        $tags = Tag::query()->get();
        return view('web.doctor_question', compact(['user','tags']));
    }

    public function search(Request $request)
    {
        $q = $request->get('q');
        $list = new User();
        $list = $list->where('user_type',1)
            ->where('name','like',"%{$q}%")
            ->with(['doctor'])
            ->paginate(9);
        return view('web.doctors', compact('list'));
    }

}
