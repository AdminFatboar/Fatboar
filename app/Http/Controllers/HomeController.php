<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\ValidTicket;
use Auth;
use App\WinPercent;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
public function test(Request $request)
    {
        \Artisan::call('cache:clear');
        \Artisan::call('route:clear');
        \Artisan::call('view:clear');

    dd("Cache is cleared");
    }




    public function competition(Request $request)
    {

        if ($request->isMethod('post')) {
            $isValid = ValidTicket::where('number',$request->ticket)->first();
            if(!isset($isValid)){
                Session::flash('message', 'Billet invalide ! Veuillez rééssayer.');
                Session::flash('message_type', 'danger');
                Session::flash('message_icon', 'fas fa-exclamation-circle');

                return redirect()->back();
            }

            $data = $request->validate([
                'ticket' => 'required|numeric|unique:tickets,number',
            ]);

            $ticket = new Ticket();
            $ticket->number = $request->ticket;
            $ticket->user_id = Auth::user()->id;
            $number = rand(1, 100);
            $winPercent = WinPercent::where('id', $number)->first();
            $ticket->reward_id = $winPercent->reward_id;

            $ticket->save();

            Session::flash('message', 'Billet validé. Rendez-vous dans votre espace client afin de découvrir votre récompense !'); 
            Session::flash('message_type', 'success');
            Session::flash('message_icon', 'fas fa-check-circle');
        }

        return view('user.competition');
    }

    public function once()
    {
        $winPercent = array();

        //60% dessert
        for ($x = 1; $x <= 60; $x++) {
            $winPercent[$x] = 1;
        }

        //20% Burger au choix
        for ($x = 61; $x <= 80; $x++) {
            $winPercent[$x] = 2;
        }

        //10% Menu du jour
        for ($x = 81; $x <= 90; $x++) {
            $winPercent[$x] = 3;
        }

        //6% Choix du menu
        for ($x = 91; $x <= 96; $x++) {
            $winPercent[$x] = 4;
        }

        //4% 70% remise
        for ($x = 97; $x <= 100; $x++) {
            $winPercent[$x] = 5;
        }

        shuffle($winPercent);

        foreach ($winPercent as $item) {
            $obj = new WinPercent();
            $obj->reward_id = $item;
            $obj->save();
        }
    }


    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    public function userProfile(Request $request)
    {
        if($request->isMethod('post'))
        {
            $user = Auth::user();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;

            if($request->password)
            $user->password = $request->password;

            $user->website = $request->website;
            $user->save();
            return redirect()->route('user.profile');
        }
        return view('user.useraccount');
    }

    public function deleteProfile(){
        $user = Auth::user();

        Auth::logout();
        $user->delete();

        Session::flash('message', 'Votre compte a été supprimé');
        Session::flash('message_type', 'success');

        return response()->json(['success' => true]);
    }
	
	public function cgu()
    {
        return view('cgu');
    }
	
	public function mentions()
    {
        return view('mentions');
    }
	
	public function confidentialite()
    {
        return view('confidentialite');
    }
	
	public function cookies()
    {
        return view('cookies');
    }
	
	
}
						