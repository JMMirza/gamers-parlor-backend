<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournament extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'published',
        'start_date',
        'end_date',
        'number_of_request',
        'registration_fee',
        'terms_and_condition',
        'status_id',
        'game_id',
        'platform_id',
        'is_vip'
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

    public function prizes()
    {
        return $this->morphMany(TournamentPrize::class, 'eventable');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id', 'id');
    }

    public function levels()
    {
        return $this->hasMany(TournamentLevel::class);
    }

    public function levelMatches()
    {
        return $this->hasMany(TournamentLevelMatch::class);
    }
}
