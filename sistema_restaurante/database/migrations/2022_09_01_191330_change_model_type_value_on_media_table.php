<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class changeModelTypeValueOnMediaTable extends Migration
{
    public function up()
    {
        Media::whereModelType('App\\Speaker')->update(['model_type' => 'App\\Models\\Speaker']);
        Media::whereModelType('App\\Sponsor')->update(['model_type' => 'App\\Models\\Sponsor']);
        Media::whereModelType('App\\Gallery')->update(['model_type' => 'App\\Models\\Gallery']);
        Media::whereModelType('App\\Venue')->update(['model_type' => 'App\\Models\\Venue']);
    }

    public function down()
    {
        Media::whereModelType('App\\Models\\Speaker')->update(['model_type' => 'App\\Speaker']);
        Media::whereModelType('App\\Models\\Sponsor')->update(['model_type' => 'App\\Sponsor']);
        Media::whereModelType('App\\Models\\Gallery')->update(['model_type' => 'App\\Gallery']);
        Media::whereModelType('App\\Models\\Venue')->update(['model_type' => 'App\\Venue']);
    }
}
