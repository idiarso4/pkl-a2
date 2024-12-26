<x-filament-panels::page>
    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold">
            Selamat Datang, {{ auth()->user()->name }}
        </h2>
    </div>

    {{-- Stats Overview --}}
    <div class="grid gap-6 mb-6">
        {{-- Siswa PKL Stats --}}
        <div class="p-6 space-y-2 bg-white rounded-lg shadow">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-base font-medium text-gray-500">Total Siswa PKL</h3>
                    <p class="text-3xl font-semibold">{{ \App\Models\Internship::count() }}</p>
                </div>
                <div class="p-3 bg-primary-100 rounded-full">
                    <svg class="w-6 h-6 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-600">Semua siswa yang sedang PKL</p>
        </div>

        {{-- Jurnal Stats --}}
        <div class="p-6 space-y-2 bg-white rounded-lg shadow">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-base font-medium text-gray-500">Total Jurnal</h3>
                    <p class="text-3xl font-semibold">{{ \App\Models\Journal::count() }}</p>
                </div>
                <div class="p-3 bg-success-100 rounded-full">
                    <svg class="w-6 h-6 text-success-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-600">Semua jurnal yang dibuat</p>
        </div>

        {{-- Pending Stats --}}
        <div class="p-6 space-y-2 bg-white rounded-lg shadow">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-base font-medium text-gray-500">Jurnal Pending</h3>
                    <p class="text-3xl font-semibold">{{ \App\Models\Journal::where('status', 'pending')->count() }}</p>
                </div>
                <div class="p-3 bg-warning-100 rounded-full">
                    <svg class="w-6 h-6 text-warning-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-600">Menunggu persetujuan</p>
        </div>
    </div>

    <style>
        .fi-logo, 
        .fi-topbar nav,
        a[href*="filamentphp.com"],
        a[href*="github.com"] {
            display: none !important;
        }
    </style>
</x-filament-panels::page> 