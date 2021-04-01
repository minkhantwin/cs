<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Builder;

class Poll extends Model
{
    use HasFactory,Uuids;


    protected $fillable = [
        'title',
        'description',
        'organization_id',
        'deadline'
    ];

    protected $dates = [
        'deadline',
    ];
    
    public $primaryKey = 'id';


    protected static function booted()
    {
        if(auth()->check())
        {
            static::addGlobalScope('user',function(Builder $builder) {
                return $builder->where('organization_id',auth()->user()->organization_id);
            });
        }

    }


    public function choice()
    {
        return $this->hasMany(Choice::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function vote()
    {
        return $this->hasMany(Vote::class);
    }

}
