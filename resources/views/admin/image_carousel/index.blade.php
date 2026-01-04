<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Image Carousel CMS
            </h2>
            <x-primary-button x-data x-on:click="$dispatch('open-modal', 'create-carousel')"
                class="!bg-blue-600 !hover:bg-blue-700 !text-white !font-bold !py-2 !px-4 !rounded !shadow-lg !transition !duration-300">
                + Tambah Carousel
            </x-primary-button>

        </div>
        <x-modal name="create-carousel" focusable>
            <div class="p-6">

                <h2 class="text-lg font-medium text-gray-900">
                    Tambah Image Carousel
                </h2>

                <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data"
                    class="mt-4 space-y-4">
                    @csrf

                    {{-- TITLE --}}
                    <div>
                        <x-input-label for="title" value="Title" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                    </div>

                    {{-- IMAGE --}}
                    <div>
                        <x-input-label for="image" value="Image" />
                        <input type="file" name="image" class="mt-1 block w-full border rounded" required>
                    </div>

                    {{-- STATUS --}}
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="status" value="1" checked>
                        <span>Aktifkan Carousel</span>
                    </div>

                    {{-- ACTION --}}
                    <div class="flex justify-end gap-2">
                        <x-secondary-button x-on:click="$dispatch('close-modal', 'create-carousel')">
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

    <div class="py-12 min-h-screen lg:min-h-[500px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 border">ID</th>
                            <th class="py-3 border">Title</th>
                            <th class="py-3 border">Image</th>
                            <th class="py-3 border">Status</th>
                            <th class="py-3 border">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($carousels as $carousel)
                            <tr class="text-center">
                                <td class="p-3 border">{{ $carousel->id }}</td>
                                <td class="p-3 border">{{ $carousel->title }}</td>

                                <td class="p-3 border">
                                    <img src="{{ asset('storage/' . $carousel->image) }}" class="h-16 mx-auto rounded">
                                </td>

                                {{-- STATUS --}}
                                <td class="p-3 border">
                                    <form action="{{ route('admin.carousel.toggle', $carousel->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            class="px-3 py-1 rounded text-white
                                            {{ $carousel->status ? 'bg-green-500' : 'bg-gray-400' }}">
                                            {{ $carousel->status ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                </td>

                                {{-- ACTION --}}
                                <td class="p-3 border">
                                    <div class="flex justify-center gap-2">

                                        {{-- EDIT --}}
                                        <x-secondary-button x-data
                                            x-on:click="$dispatch('open-modal', 'edit-carousel-{{ $carousel->id }}')">
                                            Edit
                                        </x-secondary-button>

                                        {{-- DELETE --}}
                                        <form action="{{ route('carousel.destroy', $carousel->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus carousel ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <x-danger-button>
                                                Delete
                                            </x-danger-button>
                                        </form>

                                    </div>
                                </td>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">
                                    Belum ada data carousel
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                @foreach ($carousels as $carousel)
                    <x-modal name="edit-carousel-{{ $carousel->id }}" focusable>
                        <div class="p-6">

                            <h2 class="text-lg font-medium text-gray-900">
                                Edit Carousel
                            </h2>

                            <form action="{{ route('carousel.update', $carousel->id) }}" method="POST"
                                enctype="multipart/form-data" class="mt-4 space-y-4">
                                @csrf
                                @method('PUT')

                                {{-- TITLE --}}
                                <div>
                                    <x-input-label value="Title" />
                                    <x-text-input name="title" type="text" class="mt-1 block w-full"
                                        value="{{ $carousel->title }}" required />
                                </div>

                                {{-- IMAGE --}}
                                <div>
                                    <x-input-label value="Ganti Image (Opsional)" />
                                    <input type="file" name="image" class="mt-1 block w-full border rounded">

                                    <img src="{{ asset('storage/' . $carousel->image) }}" class="h-20 mt-2 rounded">
                                </div>

                                {{-- STATUS --}}
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" name="status" value="1"
                                        {{ $carousel->status ? 'checked' : '' }}>
                                    <span>Aktifkan Carousel</span>
                                </div>

                                {{-- ACTION --}}
                                <div class="flex justify-end gap-2">
                                    <x-secondary-button
                                        x-on:click="$dispatch('close-modal', 'edit-carousel-{{ $carousel->id }}')">
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
