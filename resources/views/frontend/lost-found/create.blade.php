<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Laporan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('lost-found.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Judul Barang</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: Dompet Coklat Kulit">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tipe Laporan</label>
                            <select name="type" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                                <option value="LOST">Kehilangan (LOST)</option>
                                <option value="FOUND">Menemukan (FOUND)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Status Awal</label>
                            <select name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                                <option value="OPEN">OPEN (Masih Dicari)</option>
                                <option value="CLAIMED">CLAIMED (Ada yang Menemukan)</option>
                                <option value="RESOLVED">RESOLVED (Selesai)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kejadian</label>
                        <input type="date" name="date_event" value="{{ old('date_event') }}" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                    </div>
                    <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Lokasi Hilang/Ditemukan</label>
                        <input 
                            type="text" 
                            name="location" 
                            value="{{ old('location') }}" 
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            placeholder="Contoh: Gedung TULT Lt. 3 / Kantin Asrama"
                            required
    >
                            @error('location') 
                        <span class="text-red-500 text-xs">{{ $message }}</span> 
                            @enderror
                    </div>
                    
                    {{-- Pastikan di migration Anda ada kolom 'location' atau hapus input ini jika tidak ada --}}
                    {{-- <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Lokasi</label>
                        <input type="text" name="location" class="shadow border rounded w-full py-2 px-3 text-gray-700" placeholder="Gedung TULT, Kantin, dll">
                    </div> --}}

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi / Ciri-ciri</label>
                        <textarea name="description" rows="4" class="shadow border rounded w-full py-2 px-3 text-gray-700">{{ old('description') }}</textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Foto Barang</label>
                        <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                        @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Simpan Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>