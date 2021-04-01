<?php

namespace App\QueryFilters;

use Closure;

use App\Models\Vote;

class Voted extends Filter{


    public function applyFilter($builder)
    {
        $voted = Vote::where('user_id',auth()->user()->id)->select('poll_id')->get();

        return $builder->whereIn('id',$voted);

    }

}
