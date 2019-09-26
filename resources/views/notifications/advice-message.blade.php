<?php
$advice = \App\Model\Advice::find($notification->data['id']);
$user = \Illuminate\Support\Facades\Auth::user();
//dd($user->id,$notification->data['user_id'])
?>

<li :class="'{{ empty($notification->read_at) }}' ? 'bold' : ''">
    @if($user->id == $notification->data['user_id'])
        <a class="text-info"  href="/advice/info/{{$notification->data['id']}}">你收到了 {{$advice->doctor->name}} 医生的电子药方</a>
    @else
        <a class="text-info"  href="/advice/info/{{$notification->data['id']}}">你向患者  {{$advice->user->name}} 发送了电子药方</a>
    @endif
</li>
