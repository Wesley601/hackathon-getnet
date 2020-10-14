<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property array $days
 * @property array $transaction_template
 * @property int $installments
 * @property Carbon $start_at
 * @property Carbon $end_at
 */

class RecurrentTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'days',
        'transaction_template',
        'installments',
        'start_at',
        'end_at',
    ];

    protected $casts = [
        'transaction_template' => 'array',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
