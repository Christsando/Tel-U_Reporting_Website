<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="p-2 font-semibold text-xl text-gray-800 leading-tight">
                Points Exchange
            </h2>
            <div class="mb-4 text-right font-semibold text-gray-700">
                Point kamu: <span class="text-green-600">{{ auth()->user()->points }}</span>
            </div>
        </div>
    </x-slot>
    <div class="py-6 bg-gray-100 min-h-screen lg:min-h-[500px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 border w-12">No.</th>
                            <th class="py-3 border">Name</th>
                            <th class="py-3 border w-32">Points</th>
                            <th class="py-3 border w-32">Quantity</th>
                            <th class="py-3 border w-32">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($point_items_exchange as $index => $item)
                            <tr class="text-center">
                                <td class="py-3 border">
                                    {{ $index + 1 }}
                                </td>

                                <td class="py-3 border">
                                    {{ $item->item_name }}
                                </td>

                                <td class="py-3 border">
                                    {{ $item->points }}
                                </td>

                                <td class="py-3 border">
                                    {{ $item->quantity }}
                                </td>

                                <td class="py-3 border">
                                    <form action="{{ route('points.exchange', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            class="px-3 py-1 rounded text-white
                                            {{ $item->quantity > 0 ? 'bg-green-500' : 'bg-gray-400 cursor-not-allowed' }}"
                                            {{ $item->quantity <= 0 ? 'disabled' : '' }}>
                                            Exchange
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-4 text-center text-gray-500">
                                    <i class="fas mr-2 fa-coins"></i>Belum ada item dibuat
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if (session('success') && session('voucher'))
                    <script>
                        Swal.fire({
                            title: 'Exchange Berhasil 🎉',
                            html: `
                <p>{{ session('success') }}</p>
                <div style="margin-top:10px;font-size:18px;font-weight:bold;">
                    Kode Voucher:
                    <br>
                    <span style="color:#16a34a;">
                        {{ session('voucher') }}
                    </span>
                </div>
            `,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            title: 'Gagal',
                            text: '{{ session('error') }}',
                            icon: 'error'
                        });
                    </script>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
