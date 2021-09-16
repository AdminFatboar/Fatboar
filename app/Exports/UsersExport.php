<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithProperties;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use App\User;
use DB;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function view(): View
    {
        $win_nonwin_results = DB::table('users')
            ->join('tickets', 'users.id', '=', 'tickets.user_id')
            ->select(array('users.name','users.email', DB::raw('COUNT(tickets.id) as ticket_count')))
            ->groupBy('users.id')
            //->where('tickets.is_rewarded', true)
            ->get();
        return view('admin.export', [
            'win_nonwin_results' => $win_nonwin_results,
        ]);
    }
}
