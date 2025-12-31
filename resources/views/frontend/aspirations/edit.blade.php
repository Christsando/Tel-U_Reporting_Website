<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Aspirasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('aspirations.update', $aspiration->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Judul Aspirasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title', $aspiration->title) }}" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" 
                            placeholder="Maksimal 120 karakter" maxlength="120">
                        @error('title') 
                            <span class="text-red-500 text-xs">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Topic -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Topik <span class="text-red-500">*</span>
                        </label>
                        <select name="topic" class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('topic') border-red-500 @enderror">
                            <option value="">-- Pilih Topik --</option>
                            <option value="akademik" {{ old('topic', $aspiration->topic) == 'akademik' ? 'selected' : '' }}>Akademik</option>
                            <option value="fasilitas" {{ old('topic', $aspiration->topic) == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                            <option value="organisasi" {{ old('topic', $aspiration->topic) == 'organisasi' ? 'selected' : '' }}>Organisasi</option>
                            <option value="lainnya" {{ old('topic', $aspiration->topic) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('topic') 
                            <span class="text-red-500 text-xs">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Isi Aspirasi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" rows="6" 
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 @error('content') border-red-500 @enderror"
                            placeholder="Tuliskan aspirasi Anda secara detail (minimal 20 karakter)">{{ old('content', $aspiration->content) }}</textarea>
                        @error('content') 
                            <span class="text-red-500 text-xs">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Anonymous -->
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_anonymous" value="1" 
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                {{ old('is_anonymous', $aspiration->is_anonymous) ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700 text-sm">
                                Kirim sebagai <span class="font-semibold">Anonim</span>
                            </span>
                        </label>
                        <p class="text-xs text-gray-500 mt-1">Nama Anda tidak akan ditampilkan jika memilih opsi ini.</p>
                    </div>

                    <!-- Current Status -->
                    <div class="mb-6 p-3 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-700">
                            <i class="fas fa-info-circle mr-1"></i> 
                            Status saat ini: <span class="font-bold uppercase">{{ $aspiration->status }}</span>
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between">
                        <a href="{{ route('aspirations.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                            <i class="fas fa-times mr-1"></i>Batal
                        </a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
