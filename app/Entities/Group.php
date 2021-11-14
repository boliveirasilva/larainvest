<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Group.
 *
 * @package namespace App\Entities;
 */
class Group extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id', 'institution_id'];

    public function getPoolValueAttribute()
    {
        $deposits = $this->movements()->deposits()->sum('value');
        $withdraws = $this->movements()->withdraws()->sum('value');

        return $deposits - $withdraws;
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_groups');
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
