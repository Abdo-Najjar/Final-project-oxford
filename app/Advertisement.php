<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Advertisement extends Model implements HasMedia
{
    
    use InteractsWithMedia;

    protected $guarded = [];

    /**
     * get image from polymporfic realationship
     *
     */
    public function image()
    {
        if ($this->media->first()) {

            return $this->media->first()->getFullUrl('thumbnail');
        }
        return null;
    }


    public function registerAllMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
                ->width(100)
                ->height(100);

    }
}
