<?php

namespace App\Http\Controllers\Web;

use App\Model\Order;
use App\Tag;
use App\User;
use App\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->order_time) {
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->department = $request->department;
            $order->order_time = $request->order_time;
            $order->description = $request->description;
            $order->save();
            echo ("<script>alert('预约成功！');location='/'</script>");
        }
        return view('web.order');
    }
}
