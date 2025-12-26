<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-lg font-bold mb-2">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="mb-6 text-gray-600">Selamat datang di sistem pelaporan fasilitas. Apa yang ingin kamu lakukan?</p>

                    <div class="flex gap-4">
                        <a href="{{ route('reports.create') }}" style="background-color: #2563eb; color: white; padding: 12px 24px; border-radius: 8px; font-weight: bold; text-decoration: none;">
                            + Buat Laporan Baru
                        </a>

                        <a href="{{ route('reports.index') }}" style="background-color: #f3f4f6; color: #1f2937; padding: 12px 24px; border-radius: 8px; font-weight: bold; text-decoration: none; border: 1px solid #d1d5db; margin-left: 10px;">
                            Lihat Riwayat Laporan
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>