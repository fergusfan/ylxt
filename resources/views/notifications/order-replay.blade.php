<?php
$order = App\Model\Order::find($notification->data['id']);



?>

<li :class="'{{ empty($notification->read_at) }}' ? 'bold' : ''">
    @if ($order)
        <a class="text-info" style="display:block;background-color:#ffffff">
            挂号预约通知<br>
        </a>
        姓名：{{$order->user->name}}<br>
        科室：{{$order->department}}<br>
        预约时间：{{$order->order_time}}<br>
        回复时间：{{$order->order_replay}}<br>
    @endif
</li>
