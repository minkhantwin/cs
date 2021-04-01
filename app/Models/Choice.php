<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Choice extends Model
{
    use HasFactory,Uuids;

    protected $fillable = [
        'poll_id',
        'choice',
        'vote_count',
    ];

    public function poll() {
        return $this->belongsTo('App\Models\Poll');
    }

    public function vote()
    {
        return $this->hasMany(Vote::class);
    }

}
