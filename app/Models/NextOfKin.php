<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NextOfKin extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia, HasRoles;
    
    protected $fillable = [
        'surname',
        'given_name',
        'other_name',
        'date_of_birth',
        'telephone_number',
        'email',
        'address',
        'nin',
        'passport_number',
        'member_id',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['surname', 'given_name'])
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

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
