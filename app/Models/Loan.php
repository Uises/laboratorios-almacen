<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
   

    use HasFactory;
    protected $guarded = [];


    public function student():BelongsTo{
        return $this->belongsTo(Student::class);
    }

    public function component():HasMany{
        return $this->hasMany(Component::class);
    }

    public function user():BelongsTo{

        return $this->belongsTo(User::class);
    }

    public function teacher():BelongsTo{
        return $this->belongsTo(Teacher::class);
    }

    public function laboratory():BelongsTo{
        return $this->belongsTo(Laboratory::class);
    }

    
}
