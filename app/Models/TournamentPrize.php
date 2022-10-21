<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentPrize extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'amount',
        'eventable_id',
        'eventable_type',
        'status_id'
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function events()
    {
        return $this->belongsTo(Tournament::class, 'eventable_id', 'id');
    }

    public function eventable()
    {
        return $this->morphTo();
    }
}
