<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customers extends Model
{
    protected $fillable = ["customer_id", "name", "email", "phone", "address", "status"];

    protected function cast() : array {
        return [

        ];
    }

    /**
    * @return HasMany<Subscription, $this>
    */

    public function subscriptions() : HasMany {
        return $this->hasMany(Subscription::class);
    }
}
