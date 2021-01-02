<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Organization;

class isExistOrg implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $str = explode("??", base64_decode($value));
        if(count($str) == 2)
        {
            $org_id = $str[1];
            if(Organization::find($org_id))
            {
                return true;
            }
            else {
                return false;
            }

        }
        else{
            return false;
        }
        

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Organization you try to join does not exit.';
    }
}
