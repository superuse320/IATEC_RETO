<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class VacationRequest  extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;
    public $table = 'vacation_request';
    protected $fillable = [
        'user_id',
        'employee_id',
        'start_date',
        'description',
        'end_date',
        'status',
    
    ];
    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }
}
