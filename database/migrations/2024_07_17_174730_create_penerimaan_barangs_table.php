<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaanBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimaan_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('barang')->unique();
            $table->integer('surat');
            $table->foreignId('supplier')->constrained();
            $table->date('tanggal');
            $table->decimal('totalBeratReal', 8, 2);
            $table->decimal('totalBeratKotor', 8, 2);
            $table->decimal('timbangan', 8, 2);
            $table->decimal('selisih', 8, 2);
            $table->text('catatan')->nullable();
            $table->string('pembayaran');
            $table->decimal('harga_beli', 10, 2);
            $table->date('jatuh_tempo');
            $table->string('nama_pengirim');
            $table->string('pic');
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
        Schema::dropIfExists('penerimaan_barangs');
    }
}
