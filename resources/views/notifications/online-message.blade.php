<?php
$room = \App\Model\OnlineMessageRoom::find($notification->data['id']);
$type = lang('Discussion');
$url = url('discussion', ['id' => $room->id]);

?>

<li :class="'{{ empty($notification->read_at) }}' ? 'bold' : ''">
    @if(!isset($notification->data['user']))
        <a class="text-info"  href="/online/message/doctor/{{$notification->data['doctor_id']}}?room_id={{$notification->data['id']}}">有人向你发起了在线问诊</a>
    @else
        <a class="text-info"  href="/online/message/doctor/{{$notification->data['doctor_id']}}?room_id={{$notification->data['id']}}">
            你向 {{$notification->data['doctor']['name']}} 医生发起了在线问诊
        </a>
    @endif
</li>
