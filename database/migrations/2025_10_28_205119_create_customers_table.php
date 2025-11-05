<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('customers', function (Blueprint $table) {
        $table->id(); // id AUTO_INCREMENT (identity 1,1)
        $table->string('first_name'); // nombre
        $table->string('last_name'); // apellido
        $table->string('phone')->nullable(); // teléfono
        $table->string('id_card')->unique(); // cédula
        $table->string('email')->unique(); // correo
        $table->string('code')->nullable(); // código
        $table->boolean('registered')->default(false); // tipo bit (true/false)
        $table->string('account')->nullable(); // cuenta
        $table->decimal('amount', 10, 2)->default(0.00); // monto decimal
        $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
