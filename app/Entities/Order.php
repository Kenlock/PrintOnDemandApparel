<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Order.
 *
 * @package namespace App\Entities;
 */
class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function logs(){
        return $this->hasMany('App\Entities\OrderLog', 'id_order');
    }

    public function status(){
        return $this->belongTo('App\Entities\OrderStatus', 'id_status');
    }

    public function product(){
        return $this->belongTo('App\Entities\Product', 'id_product');
    }

    public function customer(){
        return $this->belongTo('App\Entities\User', 'id_user');
    }

    public function products(){
        return $this->hasManyThrough('App\Entities\Product', 'App\Entities\OrderProduct', 'id_order', 'id_product');
    }

}
