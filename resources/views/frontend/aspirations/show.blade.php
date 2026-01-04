<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Aspirasi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                
                <!-- Header Section -->
                <div class="p-6 border-b">
                    <!-- Badges -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-3 py-1 text-xs uppercase font-bold rounded 
                            {{ $aspiration->status == 'submitted' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $aspiration->status == 'reviewed' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $aspiration->status == 'accepted' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $aspiration->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ $aspiration->status }}
                        </span>
                        <span class="px-3 py-1 text-xs uppercase font-bold rounded bg-indigo-100 text-indigo-700">
                            {{ $aspiration->topic }}
                        </span>
                        @if($aspiration->is_anonymous)
                            <span class="px-3 py-1 text-xs uppercase font-bold rounded bg-gray-100 text-gray-600">
                                <i class="fas fa-user-secret mr-1"></i> Anonim
                            </span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h1 class="text-2xl font-bold text-gray-900 mb-3">
                        {{ $aspiration->title }}
                    </h1>

                    <!-- Meta Info -->
                    <div class="flex items-center text-sm text-gray-500 gap-4">
                        <span>
                            <i class="fas fa-user mr-1"></i>
                            {{ $aspiration->is_anonymous ? 'Anonim' : ($aspiration->user->name ?? 'Unknown') }}
                        </span>
                        <span>
                            <i class="fas fa-calendar mr-1"></i>
                            {{ $aspiration->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-6 border-b">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">Isi Aspirasi</h3>
                    <div class="prose max-w-none text-gray-700 whitespace-pre-wrap">{{ $aspiration->content }}</div>
                </div>

                <!-- Admin Response Section -->
                @if($aspiration->admin_response)
                <div class="p-6 bg-indigo-50 border-b">
                    <h3 class="text-sm font-semibold text-indigo-700 uppercase mb-3">
                        <i class="fas fa-reply mr-1"></i> Tanggapan Admin
                    </h3>
                    <div class="prose max-w-none text-gray-700 whitespace-pre-wrap">{{ $aspiration->admin_response }}</div>
                </div>
                @endif

                <!-- Actions Section -->
                <div class="p-6 bg-gray-50 flex justify-between items-center">
                    <a href="{{ route('aspirations.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    
                    @if($aspiration->user_id == Auth::id())
                    <div class="flex gap-3">
                        @if($aspiration->status == 'submitted')
                            <a href="{{ route('aspirations.edit', $aspiration->id) }}" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                        @endif
                        
                        <button type="button" onclick="openDeleteModal()" 
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- Custom Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/40" onclick="closeDeleteModal()"></div>
        
        <!-- Modal Content -->
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-5">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    <i class="fas fa-exclamation-triangle text-yellow-500 mr-2"></i>Hapus Aspirasi?
                </h3>
                <p class="text-gray-600 text-sm mb-4">Yakin ingin menghapus? Data tidak dapat dikembalikan.</p>
                
                <div class="flex gap-2 justify-end">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">
                        <i class="fas fa-times mr-1"></i>Batal
                    </button>
                    <form action="{{ route('aspirations.destroy', $aspiration->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded font-medium">
                            <i class="fas fa-trash mr-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDeleteModal();
        });
    </script>
</x-app-layout>
