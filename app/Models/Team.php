<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'number_of_members',
        'team_logo',
        'user_id',
        'status_id',
        'is_ladder',
        'ranking'
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    protected $appends = [
        'team_logo_url',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function getTeamLogoUrlAttribute()
    {
        $image = asset('images/demo.jpg');

        if (!empty($this->team_logo) && file_exists('uploads/team_logos/' . $this->team_logo)) {
            $image = asset('uploads/team_logos/' . $this->team_logo);
        }

        return $image;
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function team_members()
    {
        return $this->belongsToMany(User::class, 'team_members', 'team_id', 'user_id');
    }
}
