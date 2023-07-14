<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractitionerWorkingHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'practitioner_id',
        'category_id',
        'sub_category_id',
        'hour_start',
        'hour_end',
        'general_hour_start',
        'general_hour_end',
        'exceptional_hour_start',
        'exceptional_hour_end',
        'specific_service_hour_start',
        'specific_service_hour_end',

    ];
}
