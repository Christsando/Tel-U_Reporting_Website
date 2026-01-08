{{-- carousel --}}
<div class="bg-white overflow-hidden shadow-sm">
    <div x-data="{
        active: 0,
        total: {{ $carousels->count() }},
        start() {
            setInterval(() => {
                this.active = (this.active + 1) % this.total
            }, 4000)
        }
    }" x-init="start()" class="relative w-full overflow-hidden min-h-[calc(100vh-9rem)]">

        {{-- SLIDES --}}
        @foreach ($carousels as $index => $carousel)
            <div x-show="active === {{ $index }}" x-transition class="absolute inset-0">
                <img src="{{ asset('storage/' . $carousel->image) }}" alt="{{ $carousel->title }}"
                    class="w-full h-full object-cover">

                @if (!empty($carousel->title))
                    <div class="absolute bottom-6 left-6 bg-black/50 text-white px-4 py-2 rounded">
                        {{ $carousel->title }}
                    </div>
                @endif
            </div>
        @endforeach

        {{-- button --}}
        <button class="absolute left-2 top-1/2 bg-white px-2 py-1" @click="active = active > 0 ? active - 1 : total - 1">
            ‹
        </button>

        <button @click="active = active < total - 1 ? active + 1 : 0" class="absolute right-2 top-1/2 bg-white px-2 py-1">
            ›
        </button>
    </div>
</div>
