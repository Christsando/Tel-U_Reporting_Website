<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail ') . ucfirst(str_replace('_', ' ', $data->source_type)) . ' #' . $data->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="md:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    
                    @if($data->source_type != 'report')
                        <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $data->title }}</h1>
                    @endif

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="text-xs text-gray-500 uppercase font-bold">Pelapor</label>
                            @if($data->source_type == 'aspiration' && $data->is_anonymous)
                                <p class="text-gray-900 text-lg italic">Anonim</p>
                            @else
                                <p class="text-gray-900 text-lg">{{ $data->user->name ?? 'User Tidak Dikenal' }}</p>
                                <p class="text-gray-600 text-sm">{{ $data->user->email ?? '-' }}</p>
                            @endif
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase font-bold">Tanggal</label>
                            <p class="text-gray-900">{{ $data->created_at->format('d F Y, H:i') }} WIB</p>
                        </div>
                    </div>

                    @if($data->source_type == 'aspiration')
                        <div class="mb-4">
                            <label class="text-xs text-gray-500 uppercase font-bold">Topik</label>
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-bold">{{ $data->topic }}</span>
                        </div>
                    @elseif($data->source_type == 'lost_found')
                        <div class="mb-4 grid grid-cols-2 gap-4 bg-orange-50 p-4 rounded-lg">
                            <div>
                                <label class="text-xs text-gray-500 uppercase font-bold">Lokasi</label>
                                <p class="font-semibold">{{ $data->location }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 uppercase font-bold">Tanggal Kejadian</label>
                                <p class="font-semibold">{{ $data->date_event ?? '-' }}</p>
                            </div>
                             <div>
                                <label class="text-xs text-gray-500 uppercase font-bold">Kategori Barang</label>
                                <p class="font-semibold">{{ ucfirst($data->type) }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label class="text-xs text-gray-500 uppercase font-bold">Isi / Deskripsi</label>
                        <div class="bg-gray-50 p-4 rounded border border-gray-200 mt-1">
                            <p class="text-gray-800 whitespace-pre-line">{{ $data->description ?? $data->content }}</p>
                        </div>
                    </div>

                    @if(!empty($data->image))
                        <div class="mb-4">
                            <label class="text-xs text-gray-500 uppercase font-bold">Bukti Foto</label>
                            <img src="{{ asset('storage/' . $data->image) }}" alt="Bukti" class="mt-2 rounded-lg shadow-sm max-h-96">
                        </div>
                    @endif
                </div>

                <div class="md:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 h-fit">
                    <h3 class="text-lg font-bold mb-4 text-gray-700">Tindak Lanjut</h3>

                    <form action="{{ route('admin.reports.update', ['report' => $data->id, 'type' => $data->source_type]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                
                                @if($data->source_type == 'lost_found')
                                    <option value="CLAIMED" {{ $data->status == 'CLAIMED' ? 'selected' : '' }}>Sudah ditemukan</option>
                                    <option value="RESOLVED" {{ $data->status == 'RESOLVED' ? 'selected' : '' }}>Selesai</option>
                                @elseif($data->source_type == 'aspiration')
                                    <option value="submitted" {{ $data->status == 'submitted' ? 'selected' : '' }}>Submitted</option>
                                    <option value="reviewed" {{ $data->status == 'Ditinjau Ulang' ? 'selected' : '' }}>Ditinjau Ulang</option>
                                    <option value="accepted" {{ $data->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="ditolak" {{ $data->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                @else
                                    <option value="PENDING" {{ $data->status == 'PENDING' ? 'selected' : '' }}>Pending</option>
                                    <option value="PROCESSED" {{ $data->status == 'PROCESSED' ? 'selected' : '' }}>Dalam Proses</option>
                                    <option value="COMPLETED" {{ $data->status == 'COMPLETED' ? 'selected' : '' }}>Selesai</option>
                                    <option value="REJECTED" {{ $data->status == 'REJECTED' ? 'selected' : '' }}>Ditolak</option>
                                @endif
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="response" class="block text-sm font-medium text-gray-700">Pesan Balasan</label>
                            <textarea name="response" id="response" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Tulis balasan...">{{ $data->admin_response ?? '' }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('responses.index') }}" class="text-gray-600 hover:text-gray-900 mr-4 text-sm">Kembali</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>