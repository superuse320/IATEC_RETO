<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;

class addNewRoles extends Migration
{
    public function up()
    {
        Role::create(['title' => 'Administrador']);
        Role::create(['title' => 'Director']);
        Role::create(['title' => 'Estudiante']);
        Role::create(['title' => 'Marketing']);
    }
}
