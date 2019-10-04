<?php

namespace App;

use Ramsey\Uuid\Uuid;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    /**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
    protected $hidden = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'phone', 'email',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->code = Uuid::uuid4()->toString();
        });
    }
}