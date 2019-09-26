<?php

namespace App\Transformers;

use App\Model\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{


    public function transform(Order $order)//依赖注入
    {
        return [
            'id'                => $order->id,
            'user'              => $order->user->name,
            'department'        => $order->department,
            'order_time'        => $order->order_time,
            'description'       => $order->description,
            'order_replay'       => $order->order_replay,
            'created_at'        => $order->created_at->toDateTimeString(),
        ];
    }


}
