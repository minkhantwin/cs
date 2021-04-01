<?php


namespace App\QueryFilters;

use Closure;

class Sort {

    public function handle($request,Closure $next)
    {
        $builder = $next($request);

        return $builder->orderBy('created_at','desc');


    }

}

