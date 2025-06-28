<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("activities", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("community_id");
            $table->string("name");
            $table->dateTime("start_date_time");
            $table->dateTime("end_date_time");
            $table->string("location");
            $table->text("details");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("activities");
    }
};
