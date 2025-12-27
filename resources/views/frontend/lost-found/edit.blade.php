<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Laporan: {{ $lostFoundItem->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('lost-found.update', $lostFoundItem->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Judul Barang</label>
                        <input type="text" name="title" value="{{ old('title', $lostFoundItem->title) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $lostFoundItem->location) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tipe</label>
                            <select name="type" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="LOST" {{ old('type', $lostFoundItem->type) == 'LOST' ? 'selected' : '' }}>Kehilangan (LOST)</option>
                                <option value="FOUND" {{ old('type', $lostFoundItem->type) == 'FOUND' ? 'selected' : '' }}>Menemukan (FOUND)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                            <select name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="OPEN" {{ old('status', $lostFoundItem->status) == 'OPEN' ? 'selected' : '' }}>OPEN (Masih Dicari)</option>
                                <option value="CLAIMED" {{ old('status', $lostFoundItem->status) == 'CLAIMED' ? 'selected' : '' }}>CLAIMED (Diklaim)</option>
                                <option value="RESOLVED" {{ old('status', $lostFoundItem->status) == 'RESOLVED' ? 'selected' : '' }}>RESOLVED (Selesai)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kejadian</label>
                        <input type="date" name="date_event" value="{{ old('date_event', $lostFoundItem->date_event) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('description', $lostFoundItem->description) }}</textarea>
                    </div>

                    @if($lostFoundItem->image)
                    <div class="mb-2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $lostFoundItem->image) }}" alt="Current Image" class="h-32 w-auto object-cover rounded border">
                    </div>
                    @endif

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Ganti Foto (Kosongkan jika tidak ingin mengganti)</label>
                        <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB.</p>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('lost-found.index') }}" class="text-gray-500 hover:text-gray-700 font-bold">Batal</a>
                        
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>