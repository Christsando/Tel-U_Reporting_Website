<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Points Exchange
            </h2>
            <x-primary-button x-data x-on:click="$dispatch('open-modal', 'create-item')"
                class="!bg-blue-600 !hover:bg-blue-700 !text-white !font-bold !py-2 !px-4 !rounded !shadow-lg !transition !duration-300">
                + Tambah Item
            </x-primary-button>
        </div>
        <x-modal name="create-item" focusable>
            <div class="p-6">

                <h2 class="text-lg font-medium text-gray-900">
                    Tambah Item
                </h2>

                <form action="{{ route('points.store') }}" method="POST" enctype="multipart/form-data"
                    class="mt-4 space-y-4">
                    @csrf

                    {{-- TITLE --}}
                    <div>
                        <x-input-label for="item_name" value="Item Name" />
                        <x-text-input id="title" name="item_name" type="text" class="mt-1 block w-full"
                            required />
                    </div>

                    {{-- POINTS --}}
                    <div>
                        <x-input-label for="points" value="Points Value" />
                        <x-text-input id="title" name="points" type="number" min="0" step="1"
                            class="mt-1 block w-full" required />
                    </div>

                    {{-- QUANTITY --}}
                    <div>
                        <x-input-label for="quantity" value="Quantity" />
                        <x-text-input id="title" name="quantity" type="number" min="0" step="1"
                            class="mt-1 block w-full" required />
                    </div>

                    {{-- STATUS --}}
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="status" value="1" checked>
                        <span>Aktifkan Item</span>
                    </div>

                    {{-- ACTION --}}
                    <div class="flex justify-end gap-2">
                        <x-secondary-button x-on:click="$dispatch('close-modal', 'create-item')">
                            Batal
                        </x-secondary-button>

                        <x-primary-button>
                            Simpan
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </x-modal>
    </x-slot>
    <div class="py-6 bg-gray-100 min-h-screen lg:min-h-[500px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 border">No.</th>
                            <th class="py-3 border">Item Name</th>
                            <th class="py-3 border">Points</th>
                            <th class="py-3 border">Qty</th>
                            <th class="py-3 border">Active</th>
                            <th class="py-3 border">Action</th>
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
                                    <form action="{{ route('points.toggle', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            class="px-3 py-1 rounded text-white
                                            {{ $item->status ? 'bg-green-500' : 'bg-gray-400' }}">
                                            {{ $item->status ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                </td>

                                <td class="py-2 border">
                                    <div class="flex justify-center gap-2">

                                        {{-- EDIT --}}
                                        <x-secondary-button x-data
                                            x-on:click="$dispatch('open-modal', 'edit-item-{{ $item->id }}')">
                                            Edit
                                        </x-secondary-button>

                                        {{-- DELETE --}}
                                        <form action="{{ route('points.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <x-danger-button>
                                                Delete
                                            </x-danger-button>
                                        </form>

                                    </div>
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

                @foreach ($point_items_exchange as $index => $item)
                    <x-modal name="edit-item-{{ $item->id }}" focusable>
                        <div class="p-6">

                            <h2 class="text-lg font-medium text-gray-900">
                                Edit Carousel
                            </h2>

                            <form action="{{ route('points.update', $item->id) }}" method="POST"
                                enctype="multipart/form-data" class="mt-4 space-y-4">
                                @csrf
                                @method('PUT')

                                {{-- TITLE --}}
                                <div>
                                    <x-input-label value="Item Name" />
                                    <x-text-input name="item_name" type="text" class="mt-1 block w-full"
                                        value="{{ $item->item_name }}" required />
                                </div>
                                
                                {{-- POINTS --}}
                                <div>
                                    <x-input-label value="Points Value" />
                                    <x-text-input name="points" type="number" class="mt-1 block w-full"
                                        value="{{ $item->points }}" required />
                                </div>

                                {{-- POINTS --}}
                                <div>
                                    <x-input-label value="Quantity" />
                                    <x-text-input name="quantity" type="number" class="mt-1 block w-full"
                                        value="{{ $item->quantity }}" required />
                                </div>

                                {{-- STATUS --}}
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" name="status" value="1"
                                        {{ $item->status ? 'checked' : '' }}>
                                    <span>Aktifkan Carousel</span>
                                </div>

                                {{-- ACTION --}}
                                <div class="flex justify-end gap-2">
                                    <x-secondary-button
                                        x-on:click="$dispatch('close-modal', 'edit-item-{{ $item->id }}')">
                                        Batal
                                    </x-secondary-button>

                                    <x-primary-button>
                                        Update
                                    </x-primary-button>
                                </div>
                            </form>

                        </div>
                    </x-modal>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
