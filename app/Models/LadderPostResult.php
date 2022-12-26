<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LadderPostResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'winner_id',
        'losser_id',
        'ladder_post_id',
        'ladder_post_enrollment_id',
        'proof',
        'status'
    ];

    protected $dates = [

        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    protected $appends = [
        'wining_proof_url',
    ];

    public function getWinningProofUrlAttribute()
    {
        $image = asset('images/demo.jpg');

        if (!empty($this->proof) && file_exists('uploads/ladder_proofs/' . $this->proof)) {
            $image = asset('uploads/ladder_proofs/' . $this->proof);
        }

        return $image;
    }
}
