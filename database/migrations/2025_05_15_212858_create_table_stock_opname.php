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
        Schema::create('stock_opname', function (Blueprint $table) {
            $table->id();
            $table->string('no_opname');
            $table->unsignedBigInteger('user_id');
            $table->date('tanggal');
            $table->text('deskripsi')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });

        Schema::create('stock_opname_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opname_id');
            $table->unsignedBigInteger('barang_id');
            $table->integer('quantity');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('opname_id')->references('id')->on('stock_opname')->onDelete('cascade');
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_opname');
        Schema::dropIfExists('stock_opname_items');
    }
};
