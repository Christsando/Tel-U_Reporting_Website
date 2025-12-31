<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Laporan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h1 style="font-size: 20px; font-weight: bold; margin-bottom: 20px;">Form Lapor Fasilitas</h1>

                <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold;">Judul Laporan</label>
                        <input type="text" name="title" style="width: 100%; border: 1px solid #ccc; padding: 8px; border-radius: 4px;" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold;">Lokasi</label>
                        <input type="text" name="location" style="width: 100%; border: 1px solid #ccc; padding: 8px; border-radius: 4px;" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold;">Tanggal Kejadian</label>
                        <input type="date" name="date_time" style="width: 100%; border: 1px solid #ccc; padding: 8px; border-radius: 4px;" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold;">Deskripsi</label>
                        <textarea name="description" rows="4" style="width: 100%; border: 1px solid #ccc; padding: 8px; border-radius: 4px;" required></textarea>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: bold;">Bukti Foto</label>
                        <input type="file" name="image" style="width: 100%;">
                    </div>

                    <div style="margin-top: 20px; text-align: right;"> <button type="submit" style="background-color: #2563eb; color: white; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold; border: none;">
                            Kirim Laporan
                        </button>
                    </div> 

                </form>
            </div>
        </div>
    </div>
</x-app-layout>