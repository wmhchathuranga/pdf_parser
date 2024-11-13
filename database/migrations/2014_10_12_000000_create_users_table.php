<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('user_role_id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('avatar');
            $table->rememberToken();
            $table->timestamps();
        });
        User::create(['name' => 'Developer', 'user_role_id' => 1,'email' => 'developer@gmail.com','password' => Hash::make('password'),'email_verified_at'=>'2022-01-02 17:04:58','avatar' => 'avatar-1.jpg','created_at' => now(),]);
        User::create(['name' => 'Admin', 'user_role_id' => 2,'email' => 'admin@gmail.com','password' => Hash::make('password'),'email_verified_at'=>'2022-01-02 17:04:58','avatar' => 'avatar-2.jpg','created_at' => now(),]);
        User::create(['name' => 'User', 'user_role_id' => 3,'email' => 'user@gmail.com','password' => Hash::make('password'),'email_verified_at'=>'2022-01-02 17:04:58','avatar' => 'avatar-2.jpg','created_at' => now(),]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
