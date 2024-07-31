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
        Schema::create('trx_pinjam', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id') 
            ->foreign('user_id')
            ->references('id')
            ->on('sys_users');
            $table->bigInteger('book_id') 
            ->foreign('book_id')
            ->references('id')
            ->on('mst_books');
            $table->timestamp('date_pinjam')->nullable();
            $table->timestamp('date_retur')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_pinjam');
    }
};
