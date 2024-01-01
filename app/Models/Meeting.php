<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meeting extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'start',
        'end',
        'company_id'
    ];

    protected $casts = [
        "start" => "datetime",
        "end" => "datetime"
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function attendance(): HasOne
    {
        return $this->hasOne(Attendance::class);
    }
}
