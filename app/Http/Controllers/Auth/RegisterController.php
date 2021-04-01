<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Rules\isExistOrg;
use Carbon\Carbon;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
  

        if(isset($data['invite_token']) && $data['invite_token'] !== '')
        {
            // memeber request validation
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'invite_token' => new isExistOrg
            ]);

        }
        else {
            // admin request validation
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'is_admin' => ['required', 'string'],
    
                'org_name' => ['required', 'string', 'max:255'],
                'org_description' => ['required', 'string',  'max:255']
    
            ]);

        }


        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function register(Request $request)
    {
      
        // MailController::sendSignupEmail('minkhant','minkhant144.mk@gmail.com', 'sdfdf');
        // memeber registration
        $data = $request->toArray();
        if(isset($data['invite_token']) && $data['invite_token'] !== '')
        {
            $str = explode("??", base64_decode($data['invite_token']));
            $invite_org_id = $str[1];

            $user = User::create([
                   'name' => $data['name'],
                   'email' => $data['email'],
                   'password' => Hash::make($data['password']),
                   'is_admin' => '0', //which is member
                   'organization_id' => $invite_org_id,
                   'verification_code' => sha1(time()),
                   
            ]);
            
        }
        //admin registration
        else 
        {
        
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'is_admin' => $data['is_admin'],
                'verification_code' => sha1(time()),
                
            ]);
            $org = Organization::create([
                'name' => $data['org_name'],
                'description' => $data['org_description'],
                'admin_id' => $user->id
            ]);

            $date = date('Y-m-d H:i:s');
                
            $org->invite_token = base64_encode($date.'??'.$org->id);
            $org->save();
    
            $user->organization_id = $org->id;
            $user->save();

        }

        if($user != null)
        {
            MailController::sendSignupEmail($user->name,$user->email, $user->verification_code);
            return redirect()->back()->with('status','success');
        }

        
        return redirect()->back()->with('status','error');
            
    }

    protected function redirectTo() {

     
        if(auth()->user()->is_admin) {
            return '/admin';
        }
        return '/member';
    }

    public function verifyEmail(Request $request)
    {
        $verification_code = $request->input('code');
        $user = User::where('verification_code',$verification_code)->first();

        if($user != null)
        {
            $user->is_verified = 1;
            $user->email_verified_at = Carbon::now();
            $user->save();
            return  redirect()->to('login');
        }


    }




}
