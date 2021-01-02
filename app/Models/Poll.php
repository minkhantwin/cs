<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Poll extends Model
{
    use HasFactory,Uuids;


    protected $fillable = [
        'title',
        'description',
        'organization_id'
    ];

    public $primaryKey = 'id';

    public function choice()
    {
        return $this->belongsTo('App\Models\Choice');
    }

}
