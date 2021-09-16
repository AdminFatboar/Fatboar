<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ticket;
use App\ValidTicket;
use Auth;
use App\WinPercent;

class TicketController extends Controller
{

    public function generate(Request $request){
        /* $this->validate($request,[
            'ticket' => 'required|unique:valid_tickets,number|numeric|min:10|max:10',
        ]); */
        $number = 1;
        do {
            $valid_ticket=null;
            $digits = 10;
            $number = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
            $valid_ticket = ValidTicket::where('number', $number)->first();
            
        } while (isset($valid_ticket));

        /* $ticket = new Ticket();
        $ticket->user_id = 0;
        $ticket->reward_id = 0;
        $ticket->is_rewarded = 0;
        $ticket->draw_is_rewarded = 0;
        $ticket->number = $request->ticket;
        $ticket->save(); */

        $valid_ticket = new ValidTicket();
        $valid_ticket->number = $number;
        $valid_ticket->save();

        $response = [
            'status' => 200,
            'message' => 'saved',
        ];
        return response()->json($response, 200);

    }

}
