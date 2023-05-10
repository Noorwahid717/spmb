@extends('theme::layouts.app')


@section('content')


<div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">
    <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
        <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
            <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                <img src="{{ asset('/themes/tailwind/images/biodata.png') }}" class="w-10 rounded sm:mx-auto">
            </div>
            <div class="relative flex-1">
                <h3 class="text-lg font-medium leading-6 text-gray-700">
                    Biodata Calon Mahasiswa
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    Isi kelengkapan biodata sesuai dengan data pendukung seperti (KTP, Ijasah, dan data lainnya.)
                </p>
            </div>

        </div>
        <div class="relative p-5">

            <!-- Tab links -->
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'dapok')">Data Pokok</button>
                <button class="tablinks" onclick="openCity(event, 'alkon')">Alamat & Kontak</button>
                <button class="tablinks" onclick="openCity(event, 'ortu')">Orang Tua</button>
                <button class="tablinks" onclick="openCity(event, 'persos')">Perlindungan Sosial</button>
                <button class="tablinks" onclick="openCity(event, 'ripen')">Riwayat Pendidikan</button>
                <button class="tablinks" onclick="openCity(event, 'propil')">Prodi Dipilih</button>
                <button class="tablinks" onclick="openCity(event, 'dok')">Dokumen</button>
                <button class="tablinks" onclick="openCity(event, 'nyata')">Pernyataan</button>
            </div>

            <!-- Tab content -->
            <div id="dapok" class="tabcontent">
                <h3>London</h3>
                <p>London is the capital city of England.</p>
            </div>

            <div id="alkon" class="tabcontent">
                <h3>Paris</h3>
                <p>Paris is the capital of France.</p>
            </div>

            <div id="ortu" class="tabcontent">
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
            </div>

            <div id="persos" class="tabcontent">
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
            </div>

            <div id="ripen" class="tabcontent">
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
            </div>

            <div id="propil" class="tabcontent">
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
            </div>

            <div id="dok" class="tabcontent">
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
            </div>

            <div id="nyata" class="tabcontent">
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
            </div>

        </div>
    </div>
</div>


<script>
    function openCity(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    } 
</script>
@endsection
@section('script')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $( function() {
  $( "#tabs" ).tabs();
} );
</script> --}}

@endsection