<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create("users", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email")->unique();
            $table->string("password");
            $table->timestamps();
        });

        Schema::create("musicians", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->string("name");
            $table->string("slug")->unique();
            $table->string("pix_key")->nullable();
            $table->timestamps();
        });

        Schema::create("songs", function (Blueprint $table) {
            $table->id();
            $table->foreignId("musician_id")->constrained()->onDelete("cascade");
            $table->string("title");
            $table->string("artist_original")->nullable();
            $table->timestamps();
        });

        Schema::create("song_requests", function (Blueprint $table) {
            $table->id();
            $table->foreignId("song_id")->constrained()->onDelete("cascade");
            $table->string("customer_name");
            $table->string("status")->default("pending");
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists("song_requests");
        Schema::dropIfExists("songs");
        Schema::dropIfExists("musicians");
        Schema::dropIfExists("users");
    }
};
