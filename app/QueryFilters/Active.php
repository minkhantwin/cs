<?php

namespace App\QueryFilters;

use Closure;
use Carbon;
use Carbon\Carbon as CarbonCarbon;

class Active extends Filter
{

    public function applyFilter($builder)
    {
        if(request('active') === 'true')
        {
            return $builder->where('deadline','>',Carbon\Carbon::now());
        }

        return $builder;

    }


}

