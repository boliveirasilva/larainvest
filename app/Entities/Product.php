<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Product.
 *
 * @package namespace App\Entities;
 */
class Product extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['institution_id', 'name', 'description', 'interest_rate', 'index'];

    public function valueFromUser(User $user)
    {
        $deposits = $this->movements()->product($this)->deposits()->sum('value');
        $withdraws = $this->movements()->product($this)->withdraws()->sum('value');

        return $deposits - $withdraws;
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}
