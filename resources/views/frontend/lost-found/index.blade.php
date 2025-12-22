<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lost & Found') }}
            </h2>
            <a href="{{ route('lost-found.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Buat Laporan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($items as $item)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="h-48 w-full bg-gray-200">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="h-full w-full object-cover">
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <span class="px-2 py-1 text-xs font-bold text-white rounded {{ $item->type == 'LOST' ? 'bg-red-500' : 'bg-green-500' }}">
                                    {{ $item->type }}
                                </span>
                                <span class="text-xs text-gray-500 border border-gray-300 px-2 py-1 rounded">
                                    {{ $item->status }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $item->title }}</h3>
                            <p class="text-sm text-gray-600 mb-2">
                                <span class="font-semibold">Lokasi:</span> {{ $item->location }} <br>
                                <span class="font-semibold">Tanggal:</span> {{ \Carbon\Carbon::parse($item->date_event)->format('d M Y') }}
                            </p>
                            <p class="text-gray-700 text-sm mb-4 line-clamp-3">
                                {{ $item->description }}
                            </p>
                            
                            <div class="flex items-center justify-between mt-4 border-t pt-4">
                                <div class="text-xs text-gray-500">
                                    Oleh: {{ $item->user->name ?? 'Unknown' }}
                                </div>

                                @if(Auth::id() === $item->user_id)
                                    <div class="flex space-x-2">
                                        <a href="{{ route('lost-found.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900 text-sm font-semibold">Edit</a>
                                        
                                        <form action="{{ route('lost-found.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-semibold">Hapus</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-10 text-gray-500">
                        Belum ada laporan barang hilang/ditemukan.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $items->links() }}
            </div>
        </div>
    </div>
</x-app-layout>