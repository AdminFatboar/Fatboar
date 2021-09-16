<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class EmployerController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            if (Auth::guard('employer')->attempt(['email' => $data['email'], 'password' => $data['password']])) {

                return redirect('/employer/page1');
            } else {
                return redirect('/employer/login')->with('flash_message_error', 'Incorrent username or password');
            }
        }
        return view('employer.login');
    }

    public function page1()
    {
        $tickets = Ticket::all();

        $win_results = DB::table('users')
            ->join('tickets', 'users.id', '=', 'tickets.user_id')
            ->select(array('users.*', DB::raw('COUNT(tickets.id) as ticket_count')))
            ->groupBy('users.id')
            ->where('tickets.is_rewarded', true)
            ->get();

        /* $non_win_results = DB::table('users')
            ->join('tickets', 'users.id', '=', 'tickets.user_id')
            ->select(array('users.*', DB::raw('COUNT(tickets.id) as ticket_count')))
            ->groupBy('users.id')
            ->where('tickets.is_rewarded', false)
            ->get(); */



        return view('employer.employee', [
            'tickets' => $tickets,
            'win_results' => $win_results,
            //'non_win_results' => $non_win_results,
        ]);
    }

    public function validate_ticket(Request $request)
    {
        foreach ($request->is_this_ticket as $key => $item) {
            if ($item == 1) {
                $tkt_id = $request->ticket_id[$key];
                $ticket = Ticket::where('id', $tkt_id)->first();
                $ticket->is_rewarded = true;
                $ticket->save();
                break;
            }
        }

        return redirect()->route('employer.page1');
    }
}
