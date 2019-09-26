<?php

namespace App\Http\Controllers\Web;


use App\Model\Advice;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdviceController extends Controller
{
    public function index(Request $request)
    {
        $user = new User();
        $user = $user->find($request->get('user_id'));
        return view('web.advice',compact('user'));
    }

    public function store(Request $request)
    {
        $advice = new Advice();
        $advice->user_id = $request->input('user_id');
        $advice->doctor_id = $request->input('doctor_id');
        $advice->message = $request->input('message');
        $advice->save();
        //发送消息通知
        $advice->doctor->notify(new \App\Notifications\AdviceMessage($advice,1));
        $advice->user->notify(new  \App\Notifications\AdviceMessage($advice,2));
        echo ("<script>alert('回复成功！');location='/'</script>");
    }

    public function info(Request $request,Advice $advice)
    {
        $advice = $advice->find($request->route('id'));
        return view('web.advice_info',compact('advice'));
    }
}
