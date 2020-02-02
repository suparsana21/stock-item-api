<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\User; // Include User Class

use Auth;

class ProfileController extends Controller
{
    
    /**
     * Attempt login action
     * @var Request
     * @return Eloquent Paginate
     */

     public function index(Request $request) // Acception request for filtering
     {
        $token = $request->bearerToken();
 
        $user = Auth::guard('api')->user();

        if($user) {

           $data = $user->toArray();

           return $this->successObjResponse($data);
        } else {
            return $this->errorWithMessage(null,"Wrong Credentials");
        }

 
     }


}