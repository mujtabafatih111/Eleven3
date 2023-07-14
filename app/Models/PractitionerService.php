<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PractitionerService extends Model
{
    use HasFactory;

    protected $fillable = [
        'practitioner_id',
        'category_id',
        'sub_category_id',
        'cost_per_unit_time',
        'remote_availability',
        'on_demand_availability',
        'start_time',
        'end_time'
    ];

    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function practitioner() :BelongsTo
    {
        return $this->belongsTo(User::class,'id','practitioner_id');
    }
}
