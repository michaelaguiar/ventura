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
        Schema::create("amenity_bookings", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("community_id");
            $table->unsignedBigInteger("user_id");
            $table->string("amenity_name");
            $table->date("booking_date");
            $table->datetime("start_time");
            $table->datetime("end_time");
            $table->integer("guest_count");
            $table->text("special_requests")->nullable();
            $table->string("contact_name");
            $table->string("contact_phone", 20);
            $table->string("contact_email");
            $table->string("status")->default("pending");

            $table->timestamps();
        });
    }
};
