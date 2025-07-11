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
        Schema::create("community_members", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("community_id")
                ->constrained()
                ->onDelete("cascade");
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->timestamp("joined_at")->useCurrent();
            $table->string("role")->default("member"); // member, admin, moderator, etc.
            $table->boolean("is_active")->default(true);
            $table->timestamps();

            // Ensure a user can only be a member of a community once
            $table->unique(["community_id", "user_id"]);

            // Add indexes for performance
            $table->index(["community_id", "is_active"]);
            $table->index(["user_id", "is_active"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("community_members");
    }
};
