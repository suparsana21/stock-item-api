<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\User; // Include User Class


class AuthController extends Controller
{
    
    /**
     * Attempt login action
     * @var Request
     * @return Eloquent Paginate
     */

     public function login(Request $request) // Acception request for filtering
     {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
 
        $email = $request->input("email");
        $password = $request->input("password");
 
        $user = User::where("email", $email)->first();

        if($user && Hash::check($password, $user->password)) {

           $data = $user->toArray();
           $data['token'] = $user->createToken('users')->accessToken;      

           return $this->successObjResponse($data);
        } else {
            return $this->errorWithMessage(null,"Wrong Credentials");
        }

 
     }

     /**
     * Attempt register action
     * @var Request
     * @return Eloquent Paginate
     */

    public function register(Request $request) // Acception request for filtering
    {
       
       $this->validate($request, [
           'name' => 'required',
           'email' => 'required',
           'password' => 'required'
       ]);

       if(User::where('email',$request->email)->count() > 0) {
            return $this->errorWithMessage(null,"Email already registered");
       }

       $name = $request->input("name");
       $email = $request->input("email");
       $password = $request->input("password");

       $user = User::create([
           'name' => $name,
           'email' => $email,
           'password' => Hash::make($password)
       ]);
       
       if($user) {

          $data = $user->toArray();
          $data['token'] = $user->createToken('users')->accessToken;      

          return $this->successObjResponse($data);
       } else {
           return $this->errorWithMessage(null,"Somethings Went Wrong");
       }


    }

    

}