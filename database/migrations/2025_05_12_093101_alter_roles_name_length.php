<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Amplía la columna 'name' a 50 caracteres (ajusta a lo que prefieras)
            $table->string('name', 50)->change();
        });
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Devuélvela a su tamaño original (ajusta el número correcto si era 3-4)
            $table->string('name', 4)->change();
        });
    }
};
