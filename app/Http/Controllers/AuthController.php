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
            'password' => 'required|min:6'
        ]);
 
        $email = $request->input("email");
        $password = $request->input("password");
 
        $user = User::where("email", $email)->first();

        if(Hash::check($password, $user->password)) {

           $data = $user->toArray();
           $data['token'] = $user->createToken('users')->accessToken;      

           return $this->successObjResponse($data);
        }

 
     }

    

}