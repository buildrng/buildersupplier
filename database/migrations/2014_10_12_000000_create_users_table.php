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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile')->unique();
            $table->string('email')->unique();
            $table->enum('gender',['female' , 'male' , 'other'])->default('male');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->enum('type',['admin', 'user', 'store', 'driver', 'vendor', 'customer', 'staff'])->default('customer');
            $table->string('country_code')->default('+NIG');
            $table->string('cover')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->date('dob')->nullable();
            $table->date('date')->nullable();
            $table->text('fcm_token')->nullable();
            $table->text('stripe_key')->nullable();
            // $table->text('others')->nullable();
            // for marketing
            $table->string('channel')->nullable();
            $table->string('marketing_stage')->default('onboarding');
            // end for marketing
            $table->tinyInteger('status')->default(1);
            $table->json('settings')->nullable();
            $table->json('preferences')->nullable();
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
