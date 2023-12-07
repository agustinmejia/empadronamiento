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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('nombre_completo')->nullable();
            $table->string('ci')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('celular')->nullable();
            $table->string('provincia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('localidad')->nullable();
            $table->geometry('ubicacion')->nullable();
            $table->string('foto')->nullable();
            $table->string('foto_ci_anverso')->nullable();
            $table->string('foto_ci_reverso')->nullable();
            $table->string('cargo')->nullable();
            $table->string('observacion')->nullable();
            $table->string('operador')->nullable();
            $table->string('libro')->nullable();
            $table->string('partida')->nullable();
            $table->string('folio')->nullable();
            $table->smallInteger('estado')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
};
