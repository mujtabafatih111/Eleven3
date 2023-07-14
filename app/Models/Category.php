<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_SUSPENDED = 'in-active';


    protected $fillable = [
        'name',
        'slug',
        'status'
    ];


    public function subCategory(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }
    public function practitionerService(): HasMany
    {
        return $this->hasMany(PractitionerService::class);
    }
}
