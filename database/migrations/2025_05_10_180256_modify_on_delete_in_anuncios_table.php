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
    // 1) Eliminar foreign key existente en user_id
    $table->dropForeign('announcements_user_id_foreign');

    // 2) Eliminar foreign key existente en category_id (¡esto es lo que faltaba!)
    $table->dropForeign('announcements_category_id_foreign');

    // 3) Hacer nullable user_id y category_id
    $table->unsignedBigInteger('user_id')->nullable()->change();
    $table->unsignedBigInteger('category_id')->nullable()->change();

    // 4) Volver a crear la foreign key de user_id con onDelete('set null')
    $table->foreign('user_id')
          ->references('id')->on('users')
          ->onDelete('set null');

    // 5) Volver a crear la foreign key de category_id con onDelete('set null')
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
        Schema::table('announcements', function (Blueprint $table) {
    // Reversión si quieres hacerlo bien
});
    }
};
