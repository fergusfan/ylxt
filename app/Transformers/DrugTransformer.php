<?php

namespace App\Transformers;

use App\Model\Drug;
use League\Fractal\TransformerAbstract;

class DrugTransformer extends TransformerAbstract
{


    public function transform(Drug $order)
    {
        return [
            'id'                => $order->id,
            'name'              => $order->name,
            'price'             => $order->price,
            'img'               => $order->img,
            'description'       => $order->description,
            'type'              => $order->type,
            'use'              => $order->use,
            'provider'              => $order->provider,
            'has'              => $order->has,
        ];
    }


}
