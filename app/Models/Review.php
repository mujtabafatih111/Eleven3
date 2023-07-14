<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'practitioner_id',
        'patient_id',
        'admin_id',
        'practitioner_id',
        'reviewer_id',
        'rating',
        'review',
        'sub_category_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
