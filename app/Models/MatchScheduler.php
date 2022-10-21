<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchScheduler extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'team1_id',
        'team2_id',
        'tournament_id',
        'status_id',
        'start_date',
        'end_date'
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

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id', 'id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id', 'id');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id', 'id');
    }
}
