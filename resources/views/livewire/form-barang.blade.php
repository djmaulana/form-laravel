<div class="text-gray-500">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <form wire:submit.prevent="submit">
        <div class="mb-4 text-gray-500">
            <label for="gambar" class="block text-sm font-medium mb-2">Upload</label>
            <input type="file" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700  leading-tight focus:outline-none focus:shadow-outline" wire:model="gambar">
            @error('gambar') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
        </div>
        <div class="flex flex-wrap -mx-2">
        <div class="w-full md:w-1/2 px-2 mb-4 md:mb-0">
                <label for="barang" class="block text-sm font-medium mb-2">No Penerimaan Barang</label>
                <input type="text" id="barang" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-slate-400 leading-tight focus:outline-none focus:shadow-outline" wire:model="barang" readonly>
                @error('barang') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>
            <div class="w-full md:w-1/2 px-2 mb-4">
                <label for="surat" class="block text-sm font-medium mb-2">No Surat Jalan / Invoice</label>
                <input type="text" id="surat" placeholder="No. Surat Jalan / Invoice" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="surat">
                @error('surat') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>
            <div class="w-full md:w-1/2 px-2 mb-4">
                <label for="supplier" class="block text-sm font-medium mb-2">Supplier</label>
                <select id="supplier" wire:model="supplier" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Pilih Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
                @error('supplier') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>
            <div class="w-full md:w-1/2 px-2 mb-4">
                <label for="tanggal" class="block text-sm font-medium mb-2">Tanggal</label>
                <input type="date" id="tanggal" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="tanggal">
                @error('tanggal') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>
        </div>
       <!-- Blok input untuk Parameter Karat, Berat Real, dan Berat Kotor -->
       @foreach($rows as $index => $row)
            <div class="flex flex-wrap -mx-2 mb-4">
                <div class="w-full md:w-1/4 px-2 mb-4 md:mb-0">
                    <label for="karat-{{ $index }}" class="block text-sm font-medium mb-2">Parameter Karat</label>
                    <select id="karat-{{ $index }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="rows.{{ $index }}.karat">
                        <option value="">Pilih Parameter Karat</option>
                        @foreach($karats as $karat)
                            <option value="{{ $karat->id }}">{{ $karat->name }}</option>
                        @endforeach
                    </select>
                    @error('rows.' . $index . '.karat') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                </div>
                <div class="w-full md:w-1/4 px-2 mb-4 md:mb-0">
                    <label for="berat_real-{{ $index }}" class="block text-sm font-medium mb-2">Berat Real</label>
                    <input type="number" id="berat_real-{{ $index }}" placeholder="Berat Real" step="0.1" min="0.0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="rows.{{ $index }}.berat_real">
                    @error('rows.' . $index . '.berat_real') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                </div>
                <div class="w-full md:w-1/4 px-2 mb-4 md:mb-0">
                    <label for="berat_kotor-{{ $index }}" class="block text-sm font-medium mb-2">Berat Kotor</label>
                    <input type="number" id="berat_kotor-{{ $index }}" placeholder="Berat Kotor" step="0.1" min="0.0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="rows.{{ $index }}.berat_kotor">
                    @error('rows.' . $index . '.berat_kotor') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                </div>
                <div class="w-full md:w-1/4 px-2 mb-4 md:mb-0 flex items-end space-x-2">
                    <button type="button" class="bg-blue-500 hover:bg-blue-700 py-2 px-2 rounded text-white" wire:click.prevent="addKaratBlock">+</button>
                    @if(count($rows) > 1)
                        <button type="button" class="bg-red-500 hover:bg-red-700 py-2 px-2 rounded text-white" wire:click.prevent="removeKaratBlock({{ $index }})">-</button>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="flex flex-wrap -mx-2 mb-4">
            <div class="w-full md:w-1/4 px-2 mb-4 md:mb-0">
                <label for="totalBeratReal" class="block text-sm font-medium mb-2">Total Berat Real <span class="text-red-500 text-[9px]">(yang harus dibayar)</span></label>
                <input type="number" id="totalBeratReal" placeholder="0" step="0.1" min="0.0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="totalBeratReal">
                @error('totalBeratReal') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>
            <div class="w-full md:w-1/4 px-2 mb-4 md:mb-0">
                <label for="tot_berat_kotor" class="block text-sm font-medium mb-2">Total Berat Kotor <span class="text-red-500">*</span></label>
                <input type="number" id="tot_berat_kotor" step="0.1" min="0.0" class="shadow appearance-none bg-slate-400 border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="totalBeratKotor" readonly>
                @error('totalBeratKotor') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>
            <div class="w-full md:w-1/4 px-2 mb-4 md:mb-0">
                <label for="timbangan" class="block text-sm font-medium mb-2">Berat Timbangan <span class="text-red-500">*</span></label>
                <input type="number" id="timbangan" placeholder="0" step="0.1" min="0.0" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="timbangan">
                @error('timbangan') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>
            <div class="w-full md:w-1/4 px-2 mb-4 md:mb-0">
                <label for="selisih" class="block text-sm font-medium mb-2">Selisih <span class="text-red-500 text-[9px]">(Gram)</span></label>
                <input type="number" id="selisih" placeholder="0" class="shadow bg-slate-400 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="selisih" readonly>
                @error('selisih') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-4 text-gray-500">
            <label for="catatan" class="block text-sm font-medium mb-2">Catatan</label>
            <textarea name="catatan" id="catatan" placeholder="Catatan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="catatan"></textarea>
        </div>
        <div class="flex flex-wrap -mx-2 mb-4">
            <div class="w-full md:w-1/3 px-2 md:mb-0">
                <label for="pembayaran" class="block text-sm font-medium mb-2">Tipe Pembayaran <span class="text-red-500">*</span></label>
                <select id="pembayaran" wire:model="pembayaran" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Pilih Tipe Pembayaran</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Jatuh Tempo">Jatuh Tempo</option>
                </select>
                @error('pembayaran') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>
            @if ($pembayaran === 'Lunas')
                    <div class="w-full md:w-1/3 px-2 md:mb-0">
                        <label for="harga_beli" class="block text-sm font-medium mb-2">Harga Beli</label>
                        <input type="number" id="harga_beli" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="harga_beli">
                        @error('harga_beli') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                    </div>
            @elseif ($pembayaran === 'Jatuh Tempo')
                    <div class="w-full md:w-1/3 px-2 md:mb-0">
                        <label for="jatuh_tempo" class="block text-sm font-medium mb-2">Jatuh Tempo</label>
                        <input type="date" id="jatuh_tempo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="jatuh_tempo">
                        @error('jatuh_tempo') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
                    </div>
            @endif
        </div>

        <div class="flex flex-wrap -mx-2 mb-4">
            <div class="w-full md:w-1/2 px-2 md:mb-0">
                <label for="nama_pengirim" class="block text-sm font-medium mb-2">Nama Pengirim</label>
                <input type="text" id="nama_pengirim" placeholder="Nama Pengirim" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="nama_pengirim">
                @error('nama_pengirim') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror            
            </div>
            <div class="w-full md:w-1/2 px-2 md:mb-0">
                <label for="pic" class="block text-sm font-medium mb-2 ml-2">PIC</label>
                <input type="text" id="pic" class="shadow appearance-none border rounded w-full py-2 px-3 bg-slate-400 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly wire:model="pic">
            </div>
        </div>
        <div class="flex justify-end space-x-2">
            <button type="button" class="bg-red-500 hover:bg-red-700 mt-5 text-white py-2 px-3 rounded focus:outline-none focus:shadow-outline">Batal</button>
            <button type="submit" class="bg-green-500 hover:bg-green-700 mt-5 text-white py-2 px-6 rounded focus:outline-none focus:shadow-outline">Simpan</button>
        </div>
    </form>
</div>
