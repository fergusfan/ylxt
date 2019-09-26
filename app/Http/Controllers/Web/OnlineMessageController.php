<?php

namespace App\Http\Controllers\Web;

use App\Model\OnlineMessage;
use App\Model\OnlineMessageRoom;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OnlineMessageController extends Controller
{
    public function doctor(Request $request)
    {
        $user_id = $request->user()->id;
        $doctor_id = $request->route('id');

        if($request->get('room_id')){
            $room = new OnlineMessageRoom();
            $room = $room->find($request->get('room_id'));
        }else{
            //创建在线咨询的房间
            $room = new OnlineMessageRoom();
            $room->user_id = $user_id;
            $room->doctor_id = $doctor_id;
            $room->save();

            //发送消息通知
            $room->doctor->notify(new \App\Notifications\OnlineMessage($room,1));
            $room->user->notify(new  \App\Notifications\OnlineMessage($room,2));
        }

        $message = OnlineMessage::where([
            'room_id'   => $room->id,
        ])->with(['user','doctor'])->orderBy('id','asc')->get();


        $user_model = new User();
        $user = $user_model->find($user_id);
        $doctor = $user_model->find($doctor_id);
        return view('web.online_message', compact(['room','user','doctor','message']));
    }

    public function storeMessage(Request $request)
    {
        $online_message = new OnlineMessage();
        $online_message->user_id = $request->get('user_id');
        $online_message->doctor_id = $request->get('doctor_id');
        $online_message->message = $request->get('message');
        $online_message->room_id = $request->get('room_id');
        $online_message->tell_id = 2; //1医生 2 用户
        $online_message->save();

        return redirect('/online/message/doctor/'.$online_message->doctor_id.'?room_id='.$online_message->room_id);
    }
}
