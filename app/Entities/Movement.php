<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Movement.
 *
 * @package namespace App\Entities;
 */
class Movement extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'group_id', 'product_id', 'value', 'type'];

    public function scopeDeposits($query)
    {
        return $query->where('type', 1);
    }

    public function scopeWithdraws($query)
    {
        return $query->where('type', 2);
    }

    public function scopeProduct($query, $product)
    {
        return $query->where('product_id', $product->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
