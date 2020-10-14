<?php

namespace App\Events;

use App\Models\RecurrentTransaction;

class CreateRecurrentTransactionEvent extends Event
{
    public RecurrentTransaction $recurrentTransaction;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(RecurrentTransaction $recurrentTransaction)
    {
        $this->recurrentTransaction = $recurrentTransaction;
    }
}
