@if( !auth()->guest() && auth()->user()->role_id==3 )
<a href="{{ route('wave.biodata') }}"
    class="flex items-center p-3 -m-3 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-gray-50">
    <svg class="flex-shrink-0 w-6 h-6 text-wave-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
        </path>
    </svg>
    <div class="text-base font-medium leading-6 text-gray-900">
        Biodata
    </div>
</a>

@if(\App\Models\SpmbConfig::where('id',1)->first()->kip_enable=="true")
<a href="#"
    class="flex items-center p-3 -m-3 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-gray-50">
    <svg class="flex-shrink-0 w-6 h-6 text-wave-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z">
        </path>
    </svg>
    <div class="text-base font-medium leading-6 text-gray-900">
        Ajuan KIP
    </div>
</a>
@endif

<a href="{{ route('wave.tagihan-camaba') }}"
    class="flex items-center p-3 -m-3 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-gray-50">
    <svg class="flex-shrink-0 w-6 h-6 text-wave-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
        </path>
    </svg>
    <div class="text-base font-medium leading-6 text-gray-900">
        Tagihan
    </div>
</a>
<a href={{route("wave.seleksi-info")}}
    class="flex items-center p-3 -m-3 space-x-3 transition duration-150 ease-in-out rounded-md hover:bg-gray-50">
    <svg class="flex-shrink-0 w-6 h-6 text-wave-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
        </path>
    </svg>
    <div class="text-base font-medium leading-6 text-gray-900">
        Info dan Jadwal Seleksi
    </div>
</a>
@endif