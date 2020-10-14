<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function check(Request $request)
    {
        $now = new Carbon();
        $amountsReceived = Transaction::where('type', 'input')->whereDate('date', '<=', $now)->sum('value');
        $amountsPaid = Transaction::where('type', 'output')->whereDate('date', '<=', $now)->sum('value');
        $amountsToPay = Transaction::where('type', 'output')->whereDate('date', $request->input('date'))->sum('value');

        $total = $amountsReceived - $amountsPaid;

        if ($request->input('risk') == 'hight') {
            $amountsToReceive = Transaction::where('type', 'input')->whereDate('date', '>', $now)->sum('value');
            $total += $amountsToReceive;
        }

        $amountsToPay += $request->input('value');


        return $total / $amountsToPay;
    }
}
