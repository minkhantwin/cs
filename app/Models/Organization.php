<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Organization extends Model
{
    use HasFactory,Uuids;


    protected $fillable = [
        'name',
        'description',
        'admin_id',
        'invite_token'
    ];

    public $primaryKey = 'id';

    public function user() {
        return $this->hasMany('App\User');
    }

}
