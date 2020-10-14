<?php

namespace App\Listeners;

use App\Events\CreateRecurrentTransactionEvent;
use App\Jobs\ProcessCreateRecurrentTransaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MakeRecurrentTransaction
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Create  $event
     * @return void
     */
    public function handle(CreateRecurrentTransactionEvent $event)
    {
        $transactions = [];
        $transaction_template = $event->recurrentTransaction->transaction_template;
        $transaction_template['recurrent_transaction_id'] = $event->recurrentTransaction->id;
        $transaction_template['value'] = $event->recurrentTransaction->transaction_template['value'] / $event->recurrentTransaction->installments;
        $start_at = $event->recurrentTransaction->start_at;
        $day = 0;

        do {
            $transaction_template['date'] = $start_at->format('Y-m-d');
            $transactions[] = $transaction_template;
            $start_at->addDays(30);
            $day++;
        } while ($day < $event->recurrentTransaction->installments);

        Transaction::insert($transactions);
    }
}
