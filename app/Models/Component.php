<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Component extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function store():BelongsTo{
        return $this->belongsTo(Store::class);
    }
    public function loan():BelongsTo{
        return $this->belongsTo(Loan::class);
    }

    
}
