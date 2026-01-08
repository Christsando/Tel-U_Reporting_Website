<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pusat Respon Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">Kategori</th>
                                    <th class="border px-4 py-2 text-left">Pelapor</th>
                                    <th class="border px-4 py-2 text-left">Judul & Isi</th>
                                    <th class="border px-4 py-2 text-left">Status</th>
                                    <th class="border px-4 py-2 text-left">Tanggal</th>
                                    <th class="border px-4 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">
                                            @if($item->source_type == 'report')
                                                <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded">Fasilitas</span>
                                            @elseif($item->source_type == 'aspiration')
                                                <span class="bg-purple-100 text-purple-800 text-xs font-bold px-2 py-1 rounded">Aspirasi</span>
                                            @elseif($item->source_type == 'lost_found')
                                                <span class="bg-orange-100 text-orange-800 text-xs font-bold px-2 py-1 rounded">Lost&Found</span>
                                            @endif
                                        </td>
                                        
                                        <td class="border px-4 py-2">
                                            <div class="font-medium text-gray-900">{{ $item->display_user }}</div>
                                            <div class="text-xs text-gray-500">{{ $item->display_email }}</div>
                                        </td>

                                        <td class="border px-4 py-2">
                                            <div class="font-bold text-sm text-gray-800">{{ Str::limit($item->display_title, 40) }}</div>
                                            <div class="text-sm text-gray-600">{{ Str::limit($item->display_content, 50) }}</div>
                                        </td>

                                        <td class="border px-4 py-2">
                                            @php
                                                $status = strtolower($item->status);
                                                $color = match($status) {
                                                    'completed', 'selesai', 'found', 'claimed' => 'bg-green-100 text-green-800',
                                                    'processed', 'proses' => 'bg-blue-100 text-blue-800',
                                                    'rejected', 'ditolak' => 'bg-red-100 text-red-800',
                                                    default => 'bg-yellow-100 text-yellow-800',
                                                };
                                            @endphp
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $color }}">
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>

                                        <td class="border px-4 py-2 text-sm">
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>

                                        <td class="border px-4 py-2 text-center">
                                            <a href="{{ route('admin.reports.show', ['report' => $item->id, 'type' => $item->source_type]) }}" 
                                               class="text-blue-600 hover:text-blue-900 font-medium text-sm">
                                                Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="border px-4 py-8 text-center text-gray-500">
                                            Belum ada data masuk.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>