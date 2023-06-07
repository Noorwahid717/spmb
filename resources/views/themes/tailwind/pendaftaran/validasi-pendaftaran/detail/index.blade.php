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
                    Data Pendaftaran Calon Mahasiswa Baru
                </h3>
                <p class="text-sm leading-5 text-gray-500 mt">
                    cek data sesuai dengan dokumen yang terlampir dan lakukan validasi data pendaftaran calon mahasiswa
                    baru.
                </p>
            </div>

        </div>
        <div class="relative p-5">
            <!-- Tab links -->
            <div class="tab">
                <button class="tablinks" id="tablinks1" onclick="openTabs(event, 'step1')">Data Pokok</button>
                <button class="tablinks" id="tablinks2" onclick="openTabs(event, 'step2')">Alamat & Kontak</button>
                <button class="tablinks" id="tablinks3" onclick="openTabs(event, 'step3')">Orang Tua</button>
                <button class="tablinks" id="tablinks4" onclick="openTabs(event, 'step4')">Wali & Perlindungan
                    Sosial</button>
                <button class="tablinks" id="tablinks5" onclick="openTabs(event, 'step5')">Riwayat Pendidikan</button>
                <button class="tablinks" id="tablinks6" onclick="openTabs(event, 'step6')">Prodi Dipilih</button>
                <button class="tablinks" id="tablinks7" onclick="openTabs(event, 'step7')">Dokumen</button>
                <button class="tablinks" id="tablinks8" onclick="openTabs(event, 'step8')">Pernyataan</button>
            </div>

            <!-- Tab content -->
            <div id="step1" class="tabcontent">
                @include('theme::pendaftaran.validasi-pendaftaran.detail.include.step1')
            </div>
            <div id="step2" class="tabcontent">
                @include('theme::pendaftaran.validasi-pendaftaran.detail.include.step2')
            </div>
            <div id="step3" class="tabcontent">
                @include('theme::pendaftaran.validasi-pendaftaran.detail.include.step3')
            </div>
            <div id="step4" class="tabcontent">
                @include('theme::pendaftaran.validasi-pendaftaran.detail.include.step4')
            </div>
            <div id="step5" class="tabcontent">
                @include('theme::pendaftaran.validasi-pendaftaran.detail.include.step5')
            </div>
            <div id="step6" class="tabcontent">
                @include('theme::pendaftaran.validasi-pendaftaran.detail.include.step6')
            </div>
            <div id="step7" class="tabcontent">
                @include('theme::pendaftaran.validasi-pendaftaran.detail.include.step7')
            </div>
            <div id="step8" class="tabcontent">
                @include('theme::pendaftaran.validasi-pendaftaran.detail.include.step8')
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })
</script>
<script src="{{ asset('themes/' . $theme->folder . '/js/Magnifier.js') }}"></script>
<script src="{{ asset('themes/' . $theme->folder . '/js/Event.js') }}"></script>
<script>
    $(document).ready( function () {
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }
        if(getUrlParameter('tab')==1){
            document.getElementById('tablinks1').click();
        }else if(getUrlParameter('tab')==2){
            document.getElementById('tablinks2').click();
        }else if(getUrlParameter('tab')==3){
            document.getElementById('tablinks3').click();
        }else if(getUrlParameter('tab')==4){
            document.getElementById('tablinks4').click();
        }else if(getUrlParameter('tab')==5){
            document.getElementById('tablinks5').click();
        }else if(getUrlParameter('tab')==6){
            document.getElementById('tablinks6').click();
        }else if(getUrlParameter('tab')==7){
            document.getElementById('tablinks7').click();
        }else if(getUrlParameter('tab')==8){
            document.getElementById('tablinks8').click();
        }else{
            document.getElementById('tablinks1').click();
        }

        // hide edit button tabs
        $('#update_step_1').addClass("hidden");
        $('#update_step_2').addClass("hidden");
        $('#update_step_3').addClass("hidden");
        $('#update_step_4').addClass("hidden");
        $('#update_step_5').addClass("hidden");
        $('#update_step_6').addClass("hidden");
        $('#update_step_7').addClass("hidden");
        $('#update_step_8').addClass("hidden");

        $('#div_nokps').addClass( "hidden" );
        $('#form_wali').addClass( "hidden" );
        $('#tidak_mondok').addClass( "hidden" );

        // update value tabs
        updateValueStep1();

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
    } );

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

    // Restricts input for the given textbox to the given inputFilter function.
    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
            });
        });        
    }
    setInputFilter(document.getElementById("nik"), function(value) {
        return  /^\d*$/.test(value) && (value === "" || parseInt(value) > 0);
    });
    setInputFilter(document.getElementById("nkk"), function(value) {
        return  /^\d*$/.test(value) && (value === "" || parseInt(value) > 0);
    });
    setInputFilter(document.getElementById("nik_ayah"), function(value) {
        return  /^\d*$/.test(value) && (value === "" || parseInt(value) > 0);
    });
    setInputFilter(document.getElementById("nik_ibu"), function(value) {
        return  /^\d*$/.test(value) && (value === "" || parseInt(value) > 0);
    });
    setInputFilter(document.getElementById("nik_wali"), function(value) {
        return  /^\d*$/.test(value) && (value === "" || parseInt(value) > 0);
    });
    setInputFilter(document.getElementById("kodepos"), function(value) {
        return  /^\d*$/.test(value) && (value === "" || parseInt(value) > 0);
    });
    setInputFilter(document.getElementById("nisn"), function(value) {
        return  /^\d*$/.test(value) ;
        // && (value === "" || parseInt(value) > 0);
    });

    // TAB STEP 1
    $('#edit_step_1').on('click',function() {
        $('#update_step_1').removeClass("hidden");
        $('#edit_step_1').addClass("hidden");  
        enabledStep1();      
    });
    function batalUpdateStep1(){
        updateValueStep1();
        $('#update_step_1').addClass("hidden");
        $('#edit_step_1').removeClass("hidden");  
        disabledStep1()
    }
    function updateValueStep1(){
        var step_1 = @json($step_1); 
        if(step_1!=null){
            $('#nkk').val(step_1['nkk']);
            $('#nik').val(step_1['nik']);
            $('#nama').val(step_1['nama']);
            $('#gender').val(step_1['gender']);
            $('#tmplhr').val(step_1['tempat_lahir']);
            $('#tgllhr').val(step_1['tanggal_lahir']);
            $('#agama').val(step_1['id_agama']);            
            $('#citizenship').val(step_1['id_negara']+" - "+step_1['negara']);        
            $('#id_negara').val(step_1['id_negara']);  
            $('#lock_step_1').val(step_1['status_step']);  
            disabledStep1();
        }
    }
    function disabledStep1(){
        $('#nkk').attr('disabled',true);
        $('#nkk').addClass('read_only');
        $('#nik').attr('disabled',true);
        $('#nik').addClass('read_only');
        $('#nama').attr('disabled',true);
        $('#nama').addClass('read_only');
        $('#gender').attr('disabled',true);
        $('#gender').addClass('read_only');
        $('#tmplhr').attr('disabled',true);
        $('#tmplhr').addClass('read_only');
        $('#tgllhr').attr('disabled',true);
        $('#tgllhr').addClass('read_only');
        $('#agama').attr('disabled',true);
        $('#agama').addClass('read_only');
        $('#citizenship').attr('disabled',true);
        $('#citizenship').addClass('read_only');
        $('#lock_step_1').attr('disabled',true);  
        $('#lock_step_1').addClass('read_only');  
    }
    function enabledStep1(){
        $('#nkk').attr('disabled',false);
        $('#nkk').removeClass('read_only');
        $('#nik').attr('disabled',false);
        $('#nik').removeClass('read_only');
        $('#nama').attr('disabled',false);
        $('#nama').removeClass('read_only');
        $('#gender').attr('disabled',false);
        $('#gender').removeClass('read_only');
        $('#tmplhr').attr('disabled',false);
        $('#tmplhr').removeClass('read_only');
        $('#tgllhr').attr('disabled',false);
        $('#tgllhr').removeClass('read_only');
        $('#agama').attr('disabled',false);
        $('#agama').removeClass('read_only');
        $('#citizenship').attr('disabled',false);
        $('#citizenship').removeClass('read_only');
        $('#lock_step_1').attr('disabled',false);  
        $('#lock_step_1').removeClass('read_only');  
    }
    function ValidateStep1() {
        var nkk = $('#nkk').val();
        var nik = $('#nik').val();
        var nama = $('#nama').val();
        var gender = $('#gender option:selected').val();
        var tmplhr = $('#tmplhr').val();
        var tgllhr = $('#tgllhr').val();
        var id_agama = $('#agama option:selected').val();        
        var agama = $('#agama option:selected').text();        
        var negara = $('#citizenship').val().split(" - ")[1];        
        var id_negara = $('#id_negara').val();       
        var status_step = $('#lock_step_1').val();       
        
        if(nkk!=""){
            if(nik!=""){
                if(nama!=""){
                    if(gender!=-1){
                        if(tmplhr!=""){
                            if(tgllhr!=""){
                                if(id_agama!=-1){
                                    if(id_negara!=""){
                                        // saveOrUpdateStep1(nkk,nik,nama,gender,tmplhr,tgllhr,id_agama,agama,negara,id_negara,status_step);
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: "Pilih kewarganegaraan dahulu!",
                                        });
                                    }
                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: "Pilih agama dahulu!",
                                    });
                                }
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: "Isi tanggal lahir dahulu!",
                                });
                            }
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "Isi tempat lahir dahulu!",
                            });
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Pilih jenis kelamin dahulu!",
                        });
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Isi nama lengkap sesuai KTP dahulu!",
                    });
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Isi nomor induk kependudukan dahulu!",
                });
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi nomor kartu keluarga dahulu!",
            });
        }
    }
    function saveOrUpdateStep1(nkk,nik,nama,gender,tmplhr,tgllhr,id_agama,agama,negara,id_negara,status_step) {
        $('.containerr').show();
        console.log("dd");
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['nkk']=nkk;
        datar['nik']=nik;        
        datar['nama']=nama;
        datar['gender']=gender;
        datar['tempat_lahir']=tmplhr;
        datar['tanggal_lahir']=tgllhr;
        datar['id_agama']=id_agama;
        datar['agama']=agama;
        datar['negara']=negara;
        datar['id_negara']=id_negara;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#saveOrUpdateUrlStep1").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    // location.reload();
                    window.location.href = window.location.href.replace( /[\?#].*|$/, "?tab=1" );
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                    });
                    $('.containerr').hide();
                }
            },
        }); 
    }
</script>
@endsection