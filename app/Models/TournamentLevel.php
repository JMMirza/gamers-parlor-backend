<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentLevel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "tournament_levels";

    protected $fillable = [
        'tournament_id',
        'teams',
        'level',
        'status',
        'start_date',
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id', 'id');
    }
}
