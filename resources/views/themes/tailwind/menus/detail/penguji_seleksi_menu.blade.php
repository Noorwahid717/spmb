@if( !auth()->guest() && auth()->user()->role_id==10 )
<a href="{{ route('wave.examination') }}"
    class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none border-b-2  @if(Request::is('examination')){{ 'border-b-2 border-indigo-500 text-gray-900 focus:border-indigo-700 active:border-indigo-700' }}@else{{ 'text-gray-500 hover:border-gray-300 hover:text-gray-700 focus:text-gray-700 focus:border-gray-300 border-transparent' }}@endif">Pengujian</a>
@endif