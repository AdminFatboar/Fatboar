<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Employer;
use App\Admin;
use App\Ticket;
use Session;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

use App\Rules\PasswordLenght;
use App\Rules\PasswordLower;
use App\Rules\PasswordUpper;
use App\Rules\PasswordSpec;

class UserAPIController extends Controller
{

    public function deleteUser(Request $request){
        $user_id = $request->post('id');
        $user = User::where('id', $user_id);

        if($user == null)
            return response()->json(['success' => false]);

        $user->delete();

        $tickets = Ticket::where('user_id', $user_id)->get();
        foreach($tickets as $ticket){
            $ticket->delete();
        }

        return response()->json(['success' => true]);
    }

    public function deleteEmployer(Request $request){
        $user_id = $request->post('id');
        $user = Employer::where('id', $user_id);

        if($user == null)
            return response()->json(['success' => false, 'message' => "L'utilisateur n'existe pas."]);

        $user->delete();

        return response()->json(['success' => true]);
    }

    public function deleteAdmin(Request $request){
        $user_id = $request->post('id');

        if($user_id == session('auth_user_id'))
            return response()->json(['success' => false, 'message' => "Vous ne pouvez pas supprimer votre compte."]);

        $user = Admin::where('id', $user_id);

        if($user == null)
            return response()->json(['success' => false, 'message' => "L'utilisateur n'existe pas."]);

        $user->delete();
        
        return response()->json(['success' => true]);
    }


    public function createEmployer(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:employers,email|email',
            'name' => 'required',
            'password' => ['required', new PasswordLenght, new PasswordUpper, new PasswordLower, new PasswordSpec]
        ]);

        if($validator->fails()){
            return response()->json(['success' => false, 'message' => 'Les champs ne sont pas corrects.']);
        }

        $data = $request->only('email', 'name', 'password');
        $data['password'] = bcrypt($data['password']);
        $user = Employer::create($data);

        return response()->json(['success' => true]);
    }

    public function createAdmin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:employers,email|email',
            'name' => 'required',
            'password' => ['required', new PasswordLenght, new PasswordUpper, new PasswordLower, new PasswordSpec]
        ]);

        if($validator->fails()){
            return response()->json(['success' => false, 'message' => 'Les champs ne sont pas corrects.']);
        }

        $data = $request->only('email', 'name', 'password');
        $data['password'] = bcrypt($data['password']);
        $user = Admin::create($data);

        return response()->json(['success' => true]);
    }
}
