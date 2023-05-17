@if( !auth()->guest() && auth()->user()->role_id==3 )
@if(\App\Models\UserSpmbStep::where('user_id',auth()->user()->id)->first()->step_2==1)
<a href="{{ route('wave.biodata') }}"
    class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none border-b-2 border-transparent @if(Request::is('biodata')){{ 'border-b-2 border-indigo-500 text-gray-900 focus:border-indigo-700' }}@else{{ 'text-gray-500 hover:border-gray-300 hover:text-gray-700 focus:text-gray-700 focus:border-gray-300' }}@endif">Biodata</a>
@endif

@if(\App\Models\SpmbConfig::where('id',1)->first()->kip_enable=="true")
<a href="#"
    class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
    Ajuan KIP
</a>
@endif
<a href="#"
    class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
    Tagihan
</a>
<div x-data="{ dropdown: false }" @mouseenter="dropdown = true" @mouseleave="dropdown=false"
    @click.away="dropdown=false"
    class="relative inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out border-b-2 border-transparent cursor-pointer hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 @if(Request::is('seleksi-info')||Request::is('pelaksanaan-seleksi')||Request::is('hasil-seleksi')){{ 'border-b-2 border-indigo-500 text-gray-900 focus:border-indigo-700' }}@else{{ 'text-gray-500 hover:border-gray-300 hover:text-gray-700 focus:text-gray-700 focus:border-gray-300' }}@endif">
    <span>Seleksi</span>
    <svg class="w-5 h-5 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"></path>
    </svg>
    <div x-show="dropdown" x-transition:enter="duration-200 ease-out scale-95"
        x-transition:enter-start="opacity-50 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition duration-100 ease-in scale-100" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute top-0 w-screen max-w-xs px-2 mt-20 transform -translate-x-1/2 left-1/2 sm:px-0" x-cloak>
        <div class="border border-gray-100 shadow-md rounded-xl">
            <div class="overflow-hidden shadow-xs rounded-xl">
                <div class="relative z-20 grid gap-6 px-5 py-6 bg-white sm:p-8 sm:gap-8">
                    <a href={{route("wave.seleksi-info")}}
                        class="block px-5 py-3 -m-3 space-y-1 transition duration-150 ease-in-out hover:border-blue-500 hover:border-l-2 rounded-xl hover:bg-gray-100">
                        <p class="text-base font-medium leading-6 text-gray-900">
                            Info
                        </p>
                    </a>
                    <a href="#"
                        class="block px-5 py-3 -m-3 space-y-1 transition duration-150 ease-in-out hover:border-blue-500 hover:border-l-2 rounded-xl hover:bg-gray-100">
                        <p class="text-base font-medium leading-6 text-gray-900">
                            Pelaksanaan Seleksi
                        </p>
                    </a>
                    <a href="#"
                        class="block px-5 py-3 -m-3 space-y-1 transition duration-150 ease-in-out hover:border-blue-500 hover:border-l-2 rounded-xl hover:bg-gray-100">
                        <p class="text-base font-medium leading-6 text-gray-900">
                            Hasil Seleksi
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif