{{-- <div class="w-1/2"> --}}
    @foreach($steps as $item)
    @if($item['id']==4)
    @if(\App\Models\SpmbConfig::where('id',1)->first()->kip_enable=="true")
    <div class="flex">
        <div class="flex flex-col items-center mr-4">
            <div>
                <div class="flex items-center justify-center w-10 h-10 border rounded-full">


                </div>
            </div>
            <div class="w-px h-full bg-gray-700" style="border-left: 6px solid gray;"></div>
        </div>
        <div class="pb-8 ">
            <p class="mb-2 text-xl font-bold text-gray-600">{{$item['title']}}</p>
            <img src="{{ $item['icon'] }}" class="w-16 rounded sm:mx-auto">
            <p class="text-gray-700">
                {{$item['description']}}
            </p>
        </div>
    </div>
    @endif
    @else
    <div class="flex">
        <div class="flex flex-col items-center mr-4">
            <div>
                <div class="flex items-center justify-center w-10 h-10 border rounded-full">
                    @if($item['status']==1)
                    <img src="{{ asset('/themes/tailwind/images/checked.png') }}" class="w-18 rounded sm:mx-auto">
                    @elseif($item['status']==0)
                    <img src="{{ asset('/themes/tailwind/images/wait2.png') }}" class="w-18 rounded sm:mx-auto">
                    @elseif($item['status']==2)
                    <img src="{{ asset('/themes/tailwind/images/work-in-progress2.png') }}"
                        class="w-18 rounded sm:mx-auto">
                    @endif
                </div>
            </div>
            @if($item['id']==11)
            @else
            <div class="w-px h-full bg-gray-700" style="border-left: 6px solid gray;"></div>
            @endif
        </div>
        <div class="pb-8 ">
            <p class="mb-2 text-xl font-bold text-gray-600">{{$item['title']}}</p>
            <img src="{{ $item['icon'] }}" class="w-16 rounded sm:mx-auto">
            <p class="text-gray-700">
                @if($item['id']==1)
                Kamu telah berhasil melakukan pendaftaran dan juga mengunggah bukti pembayaran formulir pendaftaran
                online.
                @else
                {{$item['description']}}
                @endif
            </p>
        </div>
    </div>
    @endif
    @endforeach
    {{--
</div> --}}