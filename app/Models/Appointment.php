<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELED = 'canceled';
    public const STATUS_PENDING = 'pending';
    public const STATUS_UPCOMING = 'upcoming';
    public const STATUS_PAST = 'past';

    protected $fillable = [
        'practitioner_id',
        'patient_id',
        'practitioner_service_id',
        'appointment_date',
        'start_time',
        'end_time',
        'duration',
        'status',
        'reason',
        'notes'
    ];

}
