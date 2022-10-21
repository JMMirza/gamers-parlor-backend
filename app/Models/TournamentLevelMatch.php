<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentLevelMatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tournament_id',
        'tournament_level_id',
        'status',
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function tournament_levels()
    {
        return $this->hasMany(TournamentLevel::class, 'tournament_level_id');
    }

    public function team()
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_matches', 'tournament_level_match_id');
    }
}
