<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles;

    protected $guard_name = 'api';

    public const STATUS_PENDING = 'pending';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_SUSPENDED = 'suspended';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'password',
        'dob',
        'phone',
        'picture',
        'phone_verified',
        'address',
        'country_code',
        'country',
        'state',
        'city',
        'zip_code',
        'featured',
        'state_issued_id_number',
        'professional_license_numbers',
        'professional_associations',
        'category_id',
        'remote_service_offerings',
        'on_demand_service_offerings',
        'appointment_cancellation_policy',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'phone_verified',
        'email_verified',
        'phone_verification_code'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function reviews()
    {
        return $this->morphMany(Review::class,'morphable_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function practitionerServices()
    {
        return $this->hasMany(PractitionerService::class);
    }
}
