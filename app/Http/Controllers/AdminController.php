<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use Carbon\Carbon;
use Exception, Validator;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $data = User::select('id','name','email','role','created_at')->orderBy('id','asc')->get();
        $i=1;
        foreach ($data as $user) {
            $user['Sno'] = $i++;
            $user['create_date'] = ($user->created_at)->format('d-m-Y');
        }
        if($request->ajax()){

            return response()->json([
                'status'=>200,
                'data'=>$data,
            ]);
        }
       return view('Admin.dashboard');
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]); 

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()],422);
        } 

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at'=>Carbon::now(),
        ]);

        if($user) {
            return response()->json([
                'success' => true,
                'message' => 'User created successfully!',
            ], 200);
        }
    }
    public function editUser(Request $request,$id)
    {

        $user = User::where('id',$id)->first();

        if($user) {
            return response()->json([
                'success' => true,
                'data' => $user,
            ], 200);
        }
    }
    public function updateUser(Request $request)
    {

      
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' =>['confirmed'] ,
        ]); 

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()],422);
        } 

        $userData = User::where('id',$request->userId)->first();

        if($request->password){
            $password=Hash::make($request->password);
        }else{
            $password=$userData->password;
        }

        $user = User::where('id',$request->userId)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'role'=>$request->role,
        ]);

        if($user) {
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully!',
            ], 200);
        }
    }
    public function deleteUser($id)
    {
       User::where('id',$id)->delete();
       
       return response()->json([
           'success' => true,
           'message' => 'User deleted successfully!',
       ], 200);
    }

    public function changeUserRole(Request $request)
    {

       $userRole=$request->role;
       $userId=$request->id;

        if($userRole=='User'){
            $role="Admin";
        }else{
            $role="User";
        }
       $user=User::where('id',$userId)->update(['role'=>$role]);
       
       if($user){
            return response()->json([
                'success' => true,
                'message' => 'User role updated successfully!',
            ], 200);
       }else{
            return response()->json([
                'success' => false,
                'message' => 'something went wrong!',
            ], 500);
       }
       
    }
    public function changePassword(){
        return view('Admin/changePassword');
    }

    public function changePasswordData(Request $request){
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation'=>['required']
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::where('id',1)->update(['password'=>$input['password']]);
    
        return back()->with('success', 'Your password successfully changed.');
    }
}
