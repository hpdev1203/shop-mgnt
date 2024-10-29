<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $m8User = DB::table('users')->where('username', 'm8')->first();

        if (!$m8User) {
            DB::table('users')->insert([
                'username' => 'm8',
                'email' => 'm8@system.com',
                'name' => 'M8 System',
                'password' => Hash::make('m8m8m8'),
                'role' => 'system',
                'code' => 'M8ADMIN',
                'is_active' => 1,
                'is_super_admin' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->where('username', 'm8')->delete();
    }
};
