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
        Schema::create('application_form', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
            ->onDelete('cascade');
            $table->string('name');
            $table->string('resume')->nullable();
            $table->string('contact_number');
            $table->longText('email');
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
        Schema::dropIfExists('application_form');
    }
};
