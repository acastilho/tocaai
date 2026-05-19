<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
/*    public function up(): void
    {
        Schema::create('leads_prospeccao', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
  /*  public function down(): void
    {
        Schema::dropIfExists('leads_prospeccao');
  }
 */

	public function up(): void
		    {
			            Schema::create('leads_prospeccao', function (Blueprint $table) {
					                $table->id();
							            $table->string('nome_perfil');
							            $table->string('link_instagram')->unique();
								                $table->string('whatsapp', 20);
								                $table->string('status', 50)->default('Pendente'); // Pendente, Abordado, Respondido, Falhou
										            $table->text('ultima_mensagem_enviada')->nullable(); // Guarda o texto que a IA gerou
										            $table->text('log_erro')->nullable(); // Para caso o envio do WhatsApp falhe
											                $table->timestamps();
											            });
				        }

	    /**
	     *      * Reverse the migrations.
	     *           */
	    public function down(): void
		        {
				        Schema::dropIfExists('leads_prospeccao');
					    }
};
