<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Laporan: {{ $lostFoundItem->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('lost-found.update', $lostFoundItem->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Judul Barang</label>
                        <input type="text" name="title" value="{{ old('title', $lostFoundItem->title) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tipe</label>
                            <select name="type" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                                <option value="LOST" {{ $lostFoundItem->type == 'LOST' ? 'selected' : '' }}>Kehilangan</option>
                                <option value="FOUND" {{ $lostFoundItem->type == 'FOUND' ? 'selected' : '' }}>Menemukan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                            <select name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                                <option value="OPEN" {{ $lostFoundItem->status == 'OPEN' ? 'selected' : '' }}>OPEN</option>
                                <option value="CLAIMED" {{ $lostFoundItem->status == 'CLAIMED' ? 'selected' : '' }}>CLAIMED</option>
                                <option value="RESOLVED" {{ $lostFoundItem->status == 'RESOLVED' ? 'selected' : '' }}>RESOLVED</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kejadian</label>
                        <input type="date" name="date_event" value="{{ old('date_event', $lostFoundItem->date_event) }}" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" class="shadow border rounded w-full py-2 px-3 text-gray-700">{{ old('description', $lostFoundItem->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $lostFoundItem->image) }}" alt="Current Image" class="h-32 w-auto object-cover rounded border">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Ganti Foto (Kosongkan jika tidak ingin mengganti)</label>
                        <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('lost-found.index') }}" class="text-gray-500 hover:text-gray-700">Batal</a>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>