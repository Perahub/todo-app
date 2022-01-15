<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddRolesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = now();
        DB::table('roles')->insert(
            array(
            [
                'name' => 'staff',
                'updated_at' => $now,
                'created_at' => $now
            ],

            [
                'name' => 'leader',
                'updated_at' => $now,
                'created_at' => $now
            ],

            [
                'name' => 'admin',
                'updated_at' => $now,
                'created_at' => $now
            ]
            )
        );
    }
}
