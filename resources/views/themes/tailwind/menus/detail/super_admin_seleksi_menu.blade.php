@if( !auth()->guest() && auth()->user()->role_id==9 )
<a href="{{ route('wave.bank-soal') }}"
    class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none border-b-2  @if(Request::is('bank-soal')){{ 'border-b-2 border-indigo-500 text-gray-900 focus:border-indigo-700 active:border-indigo-700' }}@else{{ 'text-gray-500 hover:border-gray-300 hover:text-gray-700 focus:text-gray-700 focus:border-gray-300 border-transparent' }}@endif">Bank
    Soal</a>
<a href="{{ route('wave.interview-question') }}"
    class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none border-b-2  @if(Request::is('interview-question')){{ 'border-b-2 border-indigo-500 text-gray-900 focus:border-indigo-700 active:border-indigo-700' }}@else{{ 'text-gray-500 hover:border-gray-300 hover:text-gray-700 focus:text-gray-700 focus:border-gray-300 border-transparent' }}@endif">Soal
    Interview</a>
<a href="{{ route('wave.daftar-penguji') }}"
    class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none border-b-2  @if(Request::is('daftar-penguji')){{ 'border-b-2 border-indigo-500 text-gray-900 focus:border-indigo-700 active:border-indigo-700' }}@else{{ 'text-gray-500 hover:border-gray-300 hover:text-gray-700 focus:text-gray-700 focus:border-gray-300 border-transparent' }}@endif">Daftar
    Penguji</a>
<a href="{{ route('wave.penjadwalan-ujian') }}"
    class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none border-b-2  @if(Request::is('penjadwalan-ujian')||Request::is('exam-academic/*')||Request::is('exam-interview/*')||Request::is('exam-read-quran/*')||Request::is('exam-read-shalawat/*')){{ 'border-b-2 border-indigo-500 text-gray-900 focus:border-indigo-700 active:border-indigo-700' }}@else{{ 'text-gray-500 hover:border-gray-300 hover:text-gray-700 focus:text-gray-700 focus:border-gray-300 border-transparent' }}@endif">Penjadwalan
    Ujian</a>
{{-- <a href="{{ route('wave.kelompok-ujian') }}"
    class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none border-b-2  @if(Request::is('kelompok-ujian')){{ 'border-b-2 border-indigo-500 text-gray-900 focus:border-indigo-700 active:border-indigo-700' }}@else{{ 'text-gray-500 hover:border-gray-300 hover:text-gray-700 focus:text-gray-700 focus:border-gray-300 border-transparent' }}@endif">Kelompok
    Ujian</a> --}}
@endif