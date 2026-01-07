<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight p-1">
                Detail Response
            </h2>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen lg:min-h-[500px]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- DETAIL --}}
                <div class="mb-6">
                    <p><strong>Judul:</strong> {{ $item->title }}</p>
                    <p class="mt-2">
                        <strong>Isi:</strong><br>
                        {{ $type === 'report' ? $item->description : $item->content }}
                    </p>
                    <p class="mt-2"><strong>Status:</strong> {{ $item->status }}</p>
                </div>

                {{-- FORM RESPONSE --}}
                <form action="{{ route('responses.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="id" value="{{ $item->id }}">

                    {{-- DROPDOWN STATUS --}}
                    <div>
                        <label class="block font-medium">Ubah Status</label>
                        <select name="status" class="w-full border rounded p-2">
                            @foreach (['PENDING', 'ACCEPTED', 'ONPROGRESS', 'DONE', 'REJECTED'] as $status)
                                <option value="{{ $status }}" {{ $item->status === $status ? 'selected' : '' }}>
                                    {{ ucfirst(strtolower($status)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- TEXT BOX RESPONSE --}}
                    <div>
                        <label class="block font-medium">Respon Admin</label>
                        <textarea name="message" rows="4" class="w-full border rounded p-2" placeholder="Tulis respon admin..."></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button class="px-4 py-2 bg-blue-600 text-white rounded">
                            Simpan Respon
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
