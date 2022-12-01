<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name')->comment('사용자 이름');
            $table->string('email')->unique()->comment('사용자 이메일');
            $table->timestamp('email_verified_at')->nullable()->comment('이메일 인증');
            $table->string('password')->comment('사용자 비밀번호');
            $table->string('phone')->comment('사용자 전화번호');
            $table->boolean('permission')->default(false)->comment('관리자 권한');
            $table->rememberToken();
            $table->timestamps();
        });
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
};