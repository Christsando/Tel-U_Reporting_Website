<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inbox & Percakapan
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            @forelse($messages as $msg)
                <div x-data="{ openReply: false }" class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                    
                    <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold uppercase mr-3">
                                {{ substr($msg->sender->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800">{{ $msg->sender->name }}</h3>
                                <p class="text-xs text-gray-500">
                                    Membahas: <span class="font-semibold text-blue-600">{{ $msg->item->title ?? 'Item Dihapus' }}</span>
                                </p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded">
                            {{ $msg->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div class="p-6">
                        <p class="text-gray-700 whitespace-pre-line">{{ $msg->message }}</p>
                    </div>

                    <div class="bg-gray-50 px-6 py-3 border-t flex justify-end">
                        <button @click="openReply = !openReply" class="text-blue-600 hover:text-blue-800 font-bold text-sm flex items-center focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                            </svg>
                            <span x-text="openReply ? 'Batal' : 'Balas Pesan'"></span>
                        </button>
                    </div>

                    <div x-show="openReply" class="p-6 border-t bg-blue-50 transition-all duration-300">
                        <form action="{{ route('messages.reply', $msg->id) }}" method="POST">
                            @csrf
                            <label class="block text-sm font-bold text-gray-700 mb-2">Balasan Anda:</label>
                            <textarea name="message" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="Ketik balasan di sini..." required></textarea>
                            
                            <div class="mt-3 flex justify-end">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow-lg flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                    Kirim Balasan
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Kotak Masuk Kosong</h3>
                    <p class="mt-1 text-sm text-gray-500">Belum ada pesan dari pengguna lain.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>