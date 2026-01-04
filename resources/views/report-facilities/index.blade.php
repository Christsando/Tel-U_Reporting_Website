<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Laporan Fasilitas') }}
            </h2>
            <a href="{{ route('reports.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition">
                + Buat Laporan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen lg:min-h-[500px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 text-green-800 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-gray-200 text-left">
                            <th class="px-4 py-3">Foto</th>
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Lainnya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($reports as $report)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">
                                    @if ($report->image)
                                        <img src="{{ asset('storage/' . $report->image) }}" alt="Bukti"
                                            class="w-24 rounded-md object-cover">
                                    @else
                                        <span class="text-gray-400 text-sm">Tidak ada foto</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    <p class="font-semibold text-gray-800">
                                        {{ $report->title }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ $report->description }}
                                    </p>
                                </td>

                                <td class="px-4 py-3 text-gray-700">
                                    {{ $report->location }}
                                </td>

                                <td class="px-4 py-3">
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                        @if ($report->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($report->status === 'proses') bg-blue-100 text-blue-800
                                        @elseif($report->status === 'selesai') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $report->status }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 align-middle">
                                    @if (auth()->id() === $report->user_id)
                                        <div class="flex items-center justify-start gap-3">
                                            <a href="{{ route('reports.edit', $report->id) }}"
                                                class="text-yellow-600 hover:text-yellow-800 font-semibold text-sm flex items-center">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>

                                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 font-semibold text-sm flex items-center"
                                                    onclick="return confirm('Yakin mau hapus?')">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm italic">—</span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-gray-500">
                                    Belum ada laporan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <x-footer />
</x-app-layout>
