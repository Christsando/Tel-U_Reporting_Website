<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight p-1">
                Responses
            </h2>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen lg:min-h-[500px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <table class="w-full border border-gray-300" border="1" cellpadding="8">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 border w-16">Title</th>
                            <th class="py-3 border w-24 text-center">Type</th>
                            <th class="py-3 border">Message</th>
                            <th class="py-3 border text-center">Status</th>
                            <th class="py-3 border text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $item)
                            <tr class="border">
                                <td class="align-middle">
                                    {{ $item->title }}
                                </td>

                                <td class="text-center align-middle">
                                    {{ $item->source === 'report' ? 'Laporan Fasilitas' : 'Aspirasi' }}
                                </td>

                                <td class="align-middle">
                                    {{ $item->message }}
                                </td>

                                <td class="text-center align-middle">
                                    {{ $item->status }}
                                </td>

                                <td class="text-center align-middle">
                                    <a href="{{ route('responses.show', $item->source.'-'.$item->id) }}"
                                        class="text-blue-600 hover:underline">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</x-app-layout>
