<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

use App\User;
use App\Employer;
use App\Admin;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Illuminate\Support\Str;

use App\Rules\PasswordLenght;
use App\Rules\PasswordLower;
use App\Rules\PasswordUpper;
use App\Rules\PasswordSpec;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login(Request $request)
    {

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', new PasswordLenght, new PasswordUpper, new PasswordLower, new PasswordSpec],
              ]);
            
            $data = $request->all();
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $auth = Admin::where("email", $data['email'])->first();
                session(['auth_user_id' => $auth->id]);

                return redirect('/admin/page1');
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        return view('admin.login');
    }


    public function page1(){
        $ticket = Ticket::where('draw_is_rewarded',true)->first();

        $win_results = DB::table('users')
            ->join('tickets', 'users.id', '=', 'tickets.user_id')
            ->select(array('users.*', DB::raw('COUNT(tickets.id) as ticket_count')))
            ->groupBy('users.id')
            ->where('tickets.is_rewarded', true)
            ->get();

        $users = User::all();
        $employers = Employer::all();
        $admins = Admin::all();


        return view('admin.administration', [
            'ticket' => $ticket,
            'win_results' => $win_results,
            'users' => $users,
            'employers' => $employers,
            'admins' => $admins
        ]);
    }

    public function resetStats(){
        DB::table('tickets')->truncate();

        return response()->json(['success' => true]);
    }

    public function resetTirage(){
        $reset_draw_tickets = Ticket::where('draw_is_rewarded',true)->get();
        foreach($reset_draw_tickets as $ticket){
            $ticket->draw_is_rewarded = false;
            $ticket->save();
        }

        return response()->json(['success' => true]);
    }


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
            return response()->json(['success' => false]);

        $user->delete();

        return response()->json(['success' => true]);
    }

    public function deleteAdmin(Request $request){
        $user_id = $request->post('id');

        if($user_id == session('auth_user_id'))
            return response()->json(['success' => false]);

        $user = Admin::where('id', $user_id);

        if($user == null)
            return response()->json(['success' => false]);

        $user->delete();
        
        return response()->json(['success' => true]);
    }


    public function createEmployer(Request $request){
        $validated = $request->validate([
            'email' => 'required|unique:employers,email|email',
            'name' => 'required',
            'password' => ['required', new PasswordLenght, new PasswordUpper, new PasswordLower, new PasswordSpec]
        ]);

        $data = $request->only('email', 'name', 'password');
        $data['password'] = bcrypt($data['password']);
        $user = Employer::create($data);

        Session::flash('the_pass_employer', true);

        return redirect('/admin/page1');
    }

    public function createAdmin(Request $request){
        $validated = $request->validate([
            'email' => 'required|unique:admins,email|email',
            'name' => 'required',
            'password' => ['required', new PasswordLenght, new PasswordUpper, new PasswordLower, new PasswordSpec]
        ]);

        $data = $request->only('email', 'name', 'password');
        $data['password'] = bcrypt($data['password']);
        $user = Admin::create($data);

        Session::flash('the_pass_admin', true);

        return redirect('/admin/page1');
    }


    public function draw(Request $request)
    {
        $reset_draw_tickets = Ticket::where('draw_is_rewarded',true)->get();
        foreach($reset_draw_tickets as $ticket){
            $ticket->draw_is_rewarded = false;
            $ticket->save();
        }
        $win_nonwin_results = DB::table('users')
            ->join('tickets', 'users.id', '=', 'tickets.user_id')
            ->select(array('users.*', DB::raw('COUNT(tickets.id) as ticket_count')))
            ->groupBy('users.id')
            //->where('tickets.is_rewarded', true)
            ->get();
        
        $max_submitted_tickets_user = $win_nonwin_results->count();
        if($max_submitted_tickets_user == 0)
            return redirect()->route('admin.page1')->with('status', 'Une erreur est survenue : aucun ticket enregistré');

        $winner = rand(0, $max_submitted_tickets_user-1);


        $winner_user_id = $win_nonwin_results[$winner]->id;

        $user = User::where('id', $winner_user_id)->first(); //->tickets->update(['draw_is_rewarded'=> true]);
        
        foreach($user->tickets as $ticket)
        {
            $ticket->draw_is_rewarded = true;
            $ticket->save();
        }

        return redirect()->route('admin.page1');

    }
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');

        
    }

    public function kpi(){
        return view('kpi');
    }
}
