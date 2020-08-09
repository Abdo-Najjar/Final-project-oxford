<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Course extends Model implements HasMedia
{

    use InteractsWithMedia;

    /**
     * remove mass assingment 
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * image path from media table
     * 
     * @return string | null
     */
    public function image()
    {
        if ($this->media->first()) {

            return $this->media->first()->getFullUrl('thumbnail');
        }
        return null;
    }

    /**
     * make a copy of the uploaded image and resize it
     *
     * @param \Spatie\MediaLibrary\HasMedia|null $media
     *
     * @return void
     */
    public function registerAllMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(100)
            ->height(100);
    }

    /**
     * elequant relation with course type table
     */
    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }

}
