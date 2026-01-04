<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h1 style="font-size: 20px; font-weight: bold; margin-bottom: 20px;">Edit Laporan</h1>

                <form action="{{ route('reports.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold;">Judul Laporan</label>
                        <input type="text" name="title" value="{{ old('title', $report->title) }}" style="width: 100%; border: 1px solid #ccc; padding: 8px; border-radius: 4px;" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold;">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $report->location) }}" style="width: 100%; border: 1px solid #ccc; padding: 8px; border-radius: 4px;" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold;">Tanggal Kejadian</label>
                        <input type="date" name="date_time" value="{{ old('date_time', $report->date_time) }}" style="width: 100%; border: 1px solid #ccc; padding: 8px; border-radius: 4px;" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold;">Deskripsi</label>
                        <textarea name="description" rows="4" style="width: 100%; border: 1px solid #ccc; padding: 8px; border-radius: 4px;" required>{{ old('description', $report->description) }}</textarea>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: bold;">Ganti Foto (Opsional)</label>
                        <input type="file" name="image" style="width: 100%;">
                        @if($report->image)
                            <div style="margin-top: 5px; font-size: 0.8em; color: gray;">*Foto lama tersimpan</div>
                        @endif
                    </div>

                    <div style="margin-top: 20px;">
                        <button type="submit" style="background-color: black; color: white; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                            UPDATE LAPORAN
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout> 