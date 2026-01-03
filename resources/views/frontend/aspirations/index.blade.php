<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Aspirasi Mahasiswa
            </h2>
            <a href="{{ route('aspirations.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                + Buat Aspirasi
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen lg:min-h-[500px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 shadow" role="alert">
                    <p class="font-bold">Error!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Aspirations Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @forelse($aspirations as $aspiration)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                    <div class="p-5 flex-grow">
                        <!-- Status & Topic Badges -->
                        <div class="flex flex-wrap gap-2 mb-3">
                            <span class="px-2 py-1 text-[10px] uppercase font-bold rounded 
                                {{ $aspiration->status == 'submitted' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $aspiration->status == 'reviewed' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $aspiration->status == 'accepted' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $aspiration->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ $aspiration->status }}
                            </span>
                            <span class="px-2 py-1 text-[10px] uppercase font-bold rounded bg-indigo-100 text-indigo-700">
                                {{ $aspiration->topic }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2" title="{{ $aspiration->title }}">
                            {{ $aspiration->title }}
                        </h3>

                        <!-- Content Preview -->
                        <p class="text-gray-600 text-sm line-clamp-3 mb-3">
                            {{ $aspiration->content }}
                        </p>

                        <!-- Author & Date -->
                        <div class="text-xs text-gray-400 flex items-center gap-2">
                            <i class="fas fa-user"></i>
                            <span>{{ $aspiration->is_anonymous ? 'Anonim' : ($aspiration->user->name ?? 'Unknown') }}</span>
                            <span class="mx-1">•</span>
                            <i class="fas fa-clock"></i>
                            <span>{{ $aspiration->created_at->format('d M Y') }}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="p-4 border-t bg-gray-50 flex justify-between items-center">
                        <a href="{{ route('aspirations.show', $aspiration->id) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm flex items-center">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </a>
                        
                        @if($aspiration->user_id == Auth::id())
                            <div class="flex gap-3">
                                @if($aspiration->status == 'submitted')
                                    <a href="{{ route('aspirations.edit', $aspiration->id) }}" class="text-yellow-600 hover:text-yellow-800 font-semibold text-sm flex items-center">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                @endif
                                
                                <button type="button" onclick="openDeleteModal({{ $aspiration->id }})" class="text-red-600 hover:text-red-800 font-semibold text-sm flex items-center">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada aspirasi</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat aspirasi pertama Anda.</p>
                </div>
                @endforelse

            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $aspirations->withQueryString()->links() }}
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
                    <form id="deleteForm" method="POST">
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

    <x-footer/>

    <script>
        function openDeleteModal(id) {
            document.getElementById('deleteForm').action = '/aspirations/' + id;
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
