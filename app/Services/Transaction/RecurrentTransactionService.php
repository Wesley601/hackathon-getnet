<?php

namespace App\Services\Transaction;

use App\Events\CreateRecurrentTransactionEvent;
use App\Models\RecurrentTransaction;
use Carbon\Carbon;

class RecurrentTransactionService
{
    public function execute($args)
    {
        $recurrentTransaction = RecurrentTransaction::create($args);
        event(new CreateRecurrentTransactionEvent($recurrentTransaction));
        return $recurrentTransaction;
    }
}
