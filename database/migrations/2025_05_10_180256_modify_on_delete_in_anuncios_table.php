<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
   Schema::table('announcements', function (Blueprint $table) {
    // 1) Drop de la FK de user_id (ésta sí existe)
    $table->dropForeign('announcements_user_id_foreign');

    // 2) Hacer nullable la columna
    $table->unsignedBigInteger('user_id')->nullable()->change();

    // 3) Volver a crear la FK con SET NULL
    $table->foreign('user_id')
          ->references('id')->on('users')
          ->onDelete('set null');

          // 4) Asegurarte de que category_id existe y es nullable
    $table->unsignedBigInteger('category_id')->nullable()->change();
    // 5) Crear la FK con SET NULL
    $table->foreign('category_id')
          ->references('id')->on('categories')
          ->onDelete('set null');
});
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anuncios', function (Blueprint $table) {
            //
        });
    }
};
