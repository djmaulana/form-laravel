<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use App\Models\ParameterKarat;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormBarang extends Component
{
    use WithFileUploads;

    public $gambar;
    public $barang;
    public $surat;
    public $supplier;
    public $tanggal;
    public $rows = [
        ['karat' => '', 'berat_real' => '', 'berat_kotor' => ''],
    ];
    public $karats;
    public $totalBeratReal;
    public $totalBeratKotor = 0;
    public $timbangan;
    public $selisih;
    public $catatan;
    public $pembayaran;
    public $harga_beli;
    public $jatuh_tempo;
    public $nama_pengirim;
    public $pic;

    protected $rules = [
        'gambar' => 'required|image|max:2048',
        'barang' => 'required|string|max:255',
        'surat' => 'required|integer|min:1',
        'supplier' => 'required|integer|exists:suppliers,id',
        'tanggal' => 'required|date|before_or_equal:today',
        'rows.*.karat' => 'required|string',
        'rows.*.berat_real' => 'required|numeric|min:0.1',
        'rows.*.berat_kotor' => 'required|numeric|min:0.1',
        'totalBeratReal' => 'required|numeric|min:0.1',
        'totalBeratKotor' => 'required|numeric|min:0.1',
        'timbangan' => 'required|numeric|min:0.1',
        'selisih' => 'required|numeric|min:0.1',
        'catatan' => 'nullable|string|max:255',
        'pembayaran' => 'required|string|max:255',
        'harga_beli' => 'required_if:pembayaran,Lunas|numeric|min:0',
        'jatuh_tempo' => 'required_if:pembayaran,Jatuh Tempo|date|after_or_equal:today',
        'nama_pengirim' => 'required|string|max:255',
        'pic' => 'required|string|max:255',
    ];

    public function mount()
    {
        // Inisialisasi $rows dengan satu blok
        $this->rows = [['karat' => '', 'berat_real' => '', 'berat_kotor' => '']];

        $this->generateNoPenerimaanBarang();
        $this->tanggal = now()->toDateString();
        $this->karats = ParameterKarat::all();
        $this->pic = 'Administrator';
    }

    public function generateNoPenerimaanBarang()
    {
        $this->barang = 'PO-' . strtoupper(uniqid());
    }

    public function addKaratBlock()
    {
        $this->rows[] = ['karat' => '', 'berat_real' => '', 'berat_kotor' => ''];
    }

    public function removeKaratBlock($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); 
        $this->calculateTotalBeratKotor();
    }

    public function calculateTotalBeratKotor()
    {
        $total = 0;

        foreach ($this->rows as $row) {
            if (is_numeric($row['berat_kotor'])) {
                $total += floatval($row['berat_kotor']);
            }
        }

        $this->totalBeratKotor = $total;
    }

    public function updatedTimbangan($value)
    {
        $this->calculateSelisih();
    }
    
    public function updatedTotalBeratReal($value)
    {
        $this->calculateSelisih();
    }
    
    private function calculateSelisih()
    {
        if (!empty($this->timbangan) && !empty($this->totalBeratReal)) {
            $this->selisih = $this->timbangan - $this->totalBeratReal;
        } else {
            $this->selisih = null;
        }
    }

    public function updatedRows($value, $index)
    {
        $this->calculateTotalBeratKotor();
    }

    public function submit()
    {
        $this->validate();
        try{
            $path = $this->gambar->store('images');

            // Simpan data ke tabel penerimaan barang
            $penerimaanBarang = PenerimaanBarang::create([
                'gambar' => $path,
                'barang' => $this->barang,
                'surat' => $this->surat,
                'supplier' => $this->supplier,
                'tanggal' => $this->tanggal,
                'totalBeratReal' => $this->totalBeratReal,
                'totalBeratKotor' => $this->totalBeratKotor,
                'timbangan' => $this->timbangan,
                'selisih' => $this->selisih,
                'catatan' => $this->catatan,
                'pembayaran' => $this->pembayaran,
                'harga_beli' => $this->harga_beli,
                'jatuh_tempo' => $this->jatuh_tempo,
                'nama_pengirim' => $this->nama_pengirim,
                'pic' => $this->pic,
            ]);

            // Simpan data ke tabel detail penerimaan barang
            foreach ($this->rows as $row) {
                PenerimaanBarangDetail::create([
                    'penerimaan_barang_id' => $penerimaanBarang->id,
                    'karat' => $row['karat'],
                    'berat_real' => $row['berat_real'],
                    'berat_kotor' => $row['berat_kotor'],
                ]);
            }
            session()->flash('message', 'Data penerimaan barang berhasil disimpan.');
        } catch (\Exception $e) {
            session()->flash('error',  'Terjadi kesalahan saat menyimpan data: ' .$e->getMessage());
        }
    }
    public function render()
    {
        $suppliers = Supplier::orderBy('name')->get();
        return view('livewire.form-barang', compact('suppliers'));
    }
}
