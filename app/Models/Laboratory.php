<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function loan():HasMany{

        return $this->hasMany(Loan::class);
    }


}
