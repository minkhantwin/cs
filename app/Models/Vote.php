<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_id',
        'choice_id',
        'user_id'
    ];


    public function poll()
    {
        return $this->belongsTo(Poll::class);

    }

    public function choice()
    {
        return $this->belongsTo(Choice::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }



    


}
