<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Barang Hilang & Ditemukan
            </h2>
            <a href="{{ route('lost-found.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                +  Posting Barang
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                
                @forelse($items as $item)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                    
                    <div class="relative h-48 w-full bg-gray-200">
                        @if($item->image)
                            <img src="{{ asset( 'storage/' .  $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400 flex-col">
                                <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-sm">No Image</span>
                            </div>
                        @endif

                        <div class="absolute top-2 right-2">
                            @if($item->type == 'LOST')
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow">KEHILANGAN</span>
                            @else
                                <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded shadow">DITEMUKAN</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-4 flex-grow">
                        <div class="mb-2">
                            <span class="px-2 py-1 text-[10px] uppercase font-bold border rounded 
                                {{ $item->status == 'OPEN' ? 'text-blue-600 border-blue-600 bg-blue-50' : '' }}
                                {{ $item->status == 'CLAIMED' ? 'text-yellow-600 border-yellow-600 bg-yellow-50' : '' }}
                                {{ $item->status == 'RESOLVED' ? 'text-gray-600 border-gray-600 bg-gray-50' : '' }}">
                                {{ $item->status }}
                            </span>
                        </div>

                        <h3 class="font-bold text-gray-900 text-lg mb-1 truncate" title="{{ $item->title }}">
                            {{ $item->title }}
                        </h3>

                        <p class="text-sm text-gray-500 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ Str::limit($item->location, 20) }}
                        </p>
                        <p class="text-xs text-gray-400 mb-3">
                            {{ \Carbon\Carbon::parse($item->date_event)->format('d M Y') }}
                        </p>

                        <p class="text-gray-600 text-sm line-clamp-2">
                            {{ $item->description }}
                        </p>
                    </div>

                    <div class="p-4 border-t bg-gray-50 flex justify-between items-center">
                        <a href="{{ route('lost-found.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-800 font-semibold text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit
                        </a>

                        <form action="{{ route('lost-found.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada barang</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat laporan kehilangan atau penemuan.</p>
                </div>
                @endforelse

            </div>
            <div class="mt-6">
                {{ $items->links() }}
            </div>

        </div>
    </div>
</x-app-layout>