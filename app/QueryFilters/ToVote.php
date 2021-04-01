<?php

namespace App\QueryFilters;

use Closure;

use App\Models\Vote;

class ToVote extends Filter{


    public function applyFilter($builder)
    {
        $voted = Vote::where('user_id',auth()->user()->id)->select('poll_id')->get();

        return $builder->whereNotIn('id',$voted);

    }

}
