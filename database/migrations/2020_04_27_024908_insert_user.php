<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            [
                'name' => 'Adlet',
                'email' => 'begmanov.adlet@gmail.com',
                'password' => '$2y$10$XpSUwtE4GQJVkNbMRKgIaua8p/xyIYZLtc1oeqlsssnryvzy91ogS',
                'remember_token' => 'jvOj31Qmq6gRKCXOx3jTyV29N07VFXgijXv9Pw5KwxWlTttC7zpz0pt75NNI'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
