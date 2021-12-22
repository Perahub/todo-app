<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class todo extends Model
{
    use HasFactory;
    public function getDateAttribute($value){
        return Carbon::parse($value)->format('M d, Y');
    }
}
