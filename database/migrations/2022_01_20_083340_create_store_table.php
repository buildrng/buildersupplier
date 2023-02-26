<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->id();
            $table->integer('uid');
            $table->string('name');
            $table->string('slug');
            $table->string('mobile');
            $table->string('lat');
            $table->string('lng');
            $table->enum('sector', ['residential', 'commercial', 'industrial'])->default('residential');
            $table->tinyInteger('verified')->nullable();
            $table->text('address')->nullable();
            $table->text('descriptions')->nullable();
            $table->text('images')->nullable();
            $table->text('cover')->nullable();
            $table->double('commission',10,2)->nullable();
            $table->string('open_time')->nullable(); // hh:mm:ss time format
            $table->string('close_time')->nullable(); // hh:mm:ss time format
            $table->tinyInteger('isClosed')->nullable();  // Store is opened=1, closed=0
            $table->string('certificate_url')->nullable();
            $table->string('certificate_type')->nullable();
            $table->double('rating',10,2)->nullable();
            $table->integer('total_rating')->nullable();
            $table->integer('cid')->nullable();
            $table->text('zipcode')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('store');
    }
}
