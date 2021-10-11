<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {

      return view('change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
          'password' => 'required|string|min:6',
          'password_confirmation' => 'required|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('failed', 'Vous avez fait une erreur dans le mot de passe');

        }
        
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('gone', 'Mot de passe modifié avec succès !');
    }
}