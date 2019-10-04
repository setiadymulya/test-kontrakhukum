<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Ramsey\Uuid\Uuid;

class Order extends Model
{
    /**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
    protected $hidden = ['id'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->code = Uuid::uuid4()->toString();
        });
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'code', 'ticket_code');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'code', 'customer_code');
    }
}