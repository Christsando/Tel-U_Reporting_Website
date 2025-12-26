<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Laporan Fasilitas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-4 text-right">
                <a href="{{ route('reports.create') }}" style="background-color: blue; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                    + Buat Laporan Baru
                </a>
            </div>

            @if(session('success'))
                <div style="background-color: #d1e7dd; color: #0f5132; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                            <th style="padding: 12px; text-align: left;">Foto</th> <th style="padding: 12px; text-align: left;">Judul</th>
                            <th style="padding: 12px; text-align: left;">Lokasi</th>
                            <th style="padding: 12px; text-align: left;">Status</th>
                            <th style="padding: 12px; text-align: left;">Lainnya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                            <tr style="border-bottom: 1px solid #dee2e6;">
                                <td style="padding: 12px;">
                                    @if($report->image)
                                        <img src="{{ asset('storage/' . $report->image) }}" alt="Bukti" style="width: 100px; height: auto; border-radius: 5px;">
                                    @else
                                        <span style="color: gray; font-size: 0.8em;">Tidak ada foto</span>
                                    @endif
                                </td>

                                <td style="padding: 12px;">
                                    <strong>{{ $report->title }}</strong><br>
                                    <small style="color: #666;">{{ $report->description }}</small>
                                </td>
                                <td style="padding: 12px;">{{ $report->location }}</td>
                                <td style="padding: 12px;">
                                    <span style="background-color: #eee; padding: 5px 10px; border-radius: 15px; font-size: 0.8em; font-weight: bold;">
                                        {{ $report->status }}
                                    </span>
                                </td>
                                <td style="padding: 12px;">
                                    <a href="{{ route('reports.edit', $report->id) }}" style="color: blue; margin-right: 10px; text-decoration: none; font-weight: bold;">Edit</a>
                                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="color: red; background: none; border: none; font-weight: bold; cursor: pointer;" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px;">Belum ada laporan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>