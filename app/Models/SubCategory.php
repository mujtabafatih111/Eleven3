<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
    ];

    public function practitionerService(): HasMany
    {
        return $this->hasMany(PractitionerService::class);
    }
    public function review(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
