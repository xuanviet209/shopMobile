<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id()->autoIncrement(); //mặc định
            $table->string('username',30)->unique();
            $table->string('password',60);
            $table->string('email',50);
            $table->tinyInteger('role')->default(1);
            $table->string('fullname',60);
            $table->string('phone',20);
            $table->string('address',255);
            $table->date('birthday');
            $table->string('avatar',100)->nullable();//ko cần nhập giá trị
            $table->tinyInteger('status')->default(1);//giá trị mặc định
            $table->tinyInteger('gender')->default(1);
            $table->timestamps(); // 2 trường create và update
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
