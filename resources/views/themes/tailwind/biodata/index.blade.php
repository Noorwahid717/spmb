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
                <button class="tablinks" id="tablinks1" onclick="openTabs(event, 'step1')">Data Pokok</button>
                <button class="tablinks" id="tablinks2" onclick="openTabs(event, 'step2')">Alamat & Kontak</button>
                <button class="tablinks" id="tablinks3" onclick="openTabs(event, 'step3')">Orang Tua</button>
                <button class="tablinks" id="tablinks4" onclick="openTabs(event, 'step4')">Perlindungan Sosial</button>
                <button class="tablinks" id="tablinks5" onclick="openTabs(event, 'step5')">Riwayat Pendidikan</button>
                <button class="tablinks" id="tablinks6" onclick="openTabs(event, 'step6')">Prodi Dipilih</button>
                <button class="tablinks" id="tablinks7" onclick="openTabs(event, 'step7')">Dokumen</button>
                <button class="tablinks" id="tablinks8" onclick="openTabs(event, 'step8')">Pernyataan</button>
            </div>

            <!-- Tab content -->
            <div id="step1" class="tabcontent">
                @include('theme::biodata.include.step1')
            </div>
            <div id="step2" class="tabcontent">
                @include('theme::biodata.include.step2')
            </div>
            <div id="step3" class="tabcontent">
                @include('theme::biodata.include.step3')
            </div>
            <div id="step4" class="tabcontent">
                @include('theme::biodata.include.step4')
            </div>
            <div id="step5" class="tabcontent">
                @include('theme::biodata.include.step5')
            </div>
            <div id="step6" class="tabcontent">
                @include('theme::biodata.include.step6')
            </div>
            <div id="step7" class="tabcontent">
                @include('theme::biodata.include.step7')
            </div>
            <div id="step8" class="tabcontent">
                @include('theme::biodata.include.step8')
            </div>
        </div>
    </div>
</div>


<script>
    // on open/click tabs
    function openTabs(evt, cityName) {
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

    // event on penerima kps change    
    // $('#penerima_kps').on('change', function() {   
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#div_nokps').addClass( "hidden" );
        $('.penerima_kps').change(function() {
            if(this.value==1){
                $('#div_nokps').removeClass( "hidden" );                
            }else{
                $('#div_nokps').addClass( "hidden" );
            }
        });

        // autocomplete kewarganegaraan
        var route = $('#citizenshipurl').val();
        $('#citizenship').typeahead({
            source: function (query, result) {
                $.ajax({
                    url:route,
                    method:"GET",
                    data:{query:query},
                    dataType: "json",
                    success:function(data){
                        result($.map(data, function(item) {
                            return item.id_negara+" - "+item.nama_negara;
                        }));
                    }
                })
            },
            updater:function (item) {
                //do your stuff.
                id_negara = item.split(" - ");
                $('#id_negara').val(id_negara[0]);
                return item;
            }
        }); 


        // autocomplete kecamatan/wilayah
        var route_2 = $('#wilayahurl').val();
        $('#kecamatan').typeahead({
            source: function (query, result) {
                $.ajax({
                    url:route_2,
                    method:"GET",
                    data:{query:query},
                    dataType: "json",
                    success:function(data){
                        result($.map(data, function(item) {
                            return item.code_lengkap+" - "+item.nama_lengkap;
                        }));
                    }
                })
            },
            updater:function (item) {
                //do your stuff.
                id_wilayah = item.split(" - ");
                $('#id_wilayah').val(id_wilayah[0]);
                return item;
            }
        }); 
    });

</script>
@endsection