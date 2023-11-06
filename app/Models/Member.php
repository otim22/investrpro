<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model implements HasMedia
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
        'occupation',
        'nin',
        'passport_number',
        'company_id',
    ];

    protected $guard_name = 'web';

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['surname', 'given_name'])
            ->saveSlugsTo('slug')
            ->allowDuplicateSlugs()
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

    public function nextOfKin(): HasOne
    {
        return $this->hasOne(NextOfKin::class);
    }
    
    public function memberSaving(): HasOne
    {
        return $this->hasOne(MemberSaving::class);
    }
}
