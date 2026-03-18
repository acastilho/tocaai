<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        // Remove a tabela se ela existir para evitar conflitos
        Schema::dropIfExists("musicians");
        
        Schema::create("musicians", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->string("name");
            $table->string("slug")->unique();
            $table->string("pix_key")->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists("musicians");
    }
};
