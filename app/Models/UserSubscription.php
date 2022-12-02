<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'transaction_id',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo(SubscriptionTransaction::class, 'transaction_id', 'id');
    }

    public function subscription()
    {
        return $this->belongsTo(SubscriptionPrice::class, 'subscription_id', 'id');
    }
}
