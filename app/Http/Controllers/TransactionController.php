<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Events\CreateRecurrentTransactionEvent;
use App\Models\RecurrentTransaction;
use App\Services\Transaction\RecurrentTransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function all()
    {
        return Transaction::orderBy('date')->get([
            'id',
            ...(new Transaction())->getFillable()
        ]);
    }

    public function find($id)
    {
        return Transaction::findOrFail($id);
    }

    public function create(Request $request)
    {
        return Transaction::create($request->all());
    }

    public function createRecurrent(Request $request)
    {
        $recurrentTransaction = new RecurrentTransactionService();
        return $recurrentTransaction->execute($request->all());
    }

    public function update(Request $request, $id)
    {
        return Transaction::findOrFail($id)->update($request->all());
    }

    public function delete($id)
    {
        return Transaction::findOrFail($id)->delete();
    }
}
