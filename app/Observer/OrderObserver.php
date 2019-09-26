<?php

namespace App\Observer;

use App\Model\Order;
use App\Notifications\OrderReplay;

class OrderObserver
{
    public function updated(Order $order)
    {
      if($order->order_replay){
          $order->user->notify(new OrderReplay($order));
      }
    }
}
