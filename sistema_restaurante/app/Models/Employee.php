<?php

namespace App\Models;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Employee extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $table = 'employees';
    protected $primaryKey = 'id';
    public $incrementing = true; 
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'start_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $guarded = [];
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
    protected static function booted()
    {
        static::creating(function ($employee) {
            $employee->start_date = now();

            $user = User::create([
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'email' => $employee->email,
                'username' => $employee->email,
                'password' => Hash::make($employee->phone),
            ]);
            $employee->user_id = $user->id;
            $employeeRole = 12;
            $user->roles()->sync($employeeRole);
        });
        
        static::deleting(function ($employee) {
        
            if ($employee->user) {
                $employee->user->delete();
            }
        });

    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
