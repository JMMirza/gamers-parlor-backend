<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentLevelMatchResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tournament_id',
        'tournament_level_id',
        'tournament_level_match_id',
        'winner_team_id',
        'winning_proof',
        'result',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    protected $appends = [
        'winning_proof_url',
    ];

    public function tournaments()
    {
        return $this->hasMany(Tournament::class, 'tournament_id');
    }

    public function tournament_levels()
    {
        return $this->hasMany(TournamentLevel::class, 'tournament_level_id');
    }

    public function tournament_level_matches()
    {
        return $this->hasMany(TournamentLevelMatch::class, 'tournament_level_match_id');
    }

    public function winner_team()
    {
        return $this->hasOne(Team::class, 'winner_team_id');
    }

    public function getWiningProofUrlAttribute()
    {
        $image = asset('/files/platform/user-dummy-img.jpg');
        if (!empty($this->winning_proof) && file_exists('files/results/' . $this->winning_proof)) {
            $image = asset('/files/results/' . $this->winning_proof);
        }
        return $image;
    }
}
