<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LadderPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'game_id',
        'platform_id',
        'fee',
        'start_time',
        'challenger_id',
        'host_id',
        'team_id',
        'status',
        'terms_and_condition',
        'challenger_team_id',
        'winner_team_id',
        'losser_team_id',
        'wining_proof',
        'result_status',
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'wining_proof_url',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id', 'id');
    }

    public function challenger()
    {
        return $this->belongsTo(User::class, 'challenger_id', 'id');
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function challenger_team()
    {
        return $this->belongsTo(Team::class, 'challenger_team_id', 'id');
    }

    public function winner_team()
    {
        return $this->belongsTo(Team::class, 'winner_team_id', 'id');
    }

    public function losser_team()
    {
        return $this->belongsTo(Team::class, 'losser_team_id', 'id');
    }

    public function ladder_enrollments()
    {
        return $this->hasMany(LadderPostEnrollment::class);
    }

    public function getWiningProofUrlAttribute()
    {
        $image = asset('images/demo.jpg');

        if (!empty($this->wining_proof) && file_exists('uploads/ladder_proofs/' . $this->wining_proof)) {
            $image = asset('uploads/ladder_proofs/' . $this->wining_proof);
        }

        return $image;
    }
}
