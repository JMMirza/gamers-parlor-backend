<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTrophy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'logo',
        'tournament_prize_id',
        'gameable_id',
        'gameable_type',
        'status_id',
        'user_id',
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
}
