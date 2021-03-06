<?php

namespace App\Observers;

use App\Entities\OrderProduct;
use App\Entities\OrderLog;
use App\Entities\Order;
use Illuminate\Support\Facades\Auth;

class OrderProductObserver
{
    /**
     * Handle the order product "created" event.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return void
     */
    public function created(OrderProduct $orderProduct)
    {
        Order::where('id', $orderProduct->id_order)->update(['total' => $orderProduct->price * $orderProduct->quantity]);
    }

    /**
     * Handle the order product "updated" event.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return void
     */
    public function updated(OrderProduct $orderProduct)
    {
        // update order total
        if($orderProduct->isDirty('price') || $orderProduct->isDirty('quantity')){
            $old_total = $orderProduct->getOriginal('price') * $orderProduct->getOriginal('quantity');
            $new_total = $orderProduct->price * $orderProduct->quantity;
            $update_total = $new_total - $old_total;
            $current_total = Order::where('id', $orderProduct->id_order)->first()->total;
            Order::where('id', $orderProduct->id_order)->update(['total' => $current_total + $update_total]);
        }
    }

    /**
     * Handle the order product "deleted" event.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return void
     */
    public function deleted(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the order product "restored" event.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return void
     */
    public function restored(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Handle the order product "force deleted" event.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return void
     */
    public function forceDeleted(OrderProduct $orderProduct)
    {
        //
    }
}
