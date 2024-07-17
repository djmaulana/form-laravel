<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaanBarangDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimaan_barang_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerimaan_barang_id')->constrained()->onDelete('cascade');
            $table->string('karat');
            $table->decimal('berat_real', 8, 2);
            $table->decimal('berat_kotor', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penerimaan_barang_details');
    }
}
