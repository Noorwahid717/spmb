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
                <button class="tablinks" id="tablinks4" onclick="openTabs(event, 'step4')">Wali & Perlindungan
                    Sosial</button>
                <button class="tablinks" id="tablinks5" onclick="openTabs(event, 'step5')">Riwayat Pendidikan</button>
                <button class="tablinks" id="tablinks6" onclick="openTabs(event, 'step6')">Prodi Dipilih</button>
                <button class="tablinks" id="tablinks7" onclick="openTabs(event, 'step7')">Dokumen</button>
                <button class="tablinks" id="tablinks8" onclick="openTabs(event, 'step8')">Pernyataan</button>
            </div>

            <!-- Tab content -->
            <div id="step1" class="tabcontent">
                @include('theme::camaba.biodata.include.step1')
            </div>
            <div id="step2" class="tabcontent">
                @include('theme::camaba.biodata.include.step2')
            </div>
            <div id="step3" class="tabcontent">
                @include('theme::camaba.biodata.include.step3')
            </div>
            <div id="step4" class="tabcontent">
                @include('theme::camaba.biodata.include.step4')
            </div>
            <div id="step5" class="tabcontent">
                @include('theme::camaba.biodata.include.step5')
            </div>
            <div id="step6" class="tabcontent">
                @include('theme::camaba.biodata.include.step6')
            </div>
            <div id="step7" class="tabcontent">
                @include('theme::camaba.biodata.include.step7')
            </div>
            <div id="step8" class="tabcontent">
                @include('theme::camaba.biodata.include.step8')
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

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}
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
<script type="text/javascript">
    $(document).ready(function(event){
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
        updateValueStep2();
        disabledAyahStep3();
        disabledIbuStep3();
        $('.kondisi_ayah').change(function() {
            if(this.value==1){
                disabledAyahStep3();
                enabledAyahStep3();
            }else{
                disabledAyahStep3();
                clearAyahData();
            }
        });
        $('.kondisi_ibu').change(function() {
            if(this.value==1){
                disabledIbuStep3();
                enabledIbuStep3();
            }else if(this.value==0){
                disabledIbuStep3();
                enableNamaIbuOnlyStep3();     
                clearIbuData();       
            }else{
                disabledIbuStep3();
                clearIbuData();       
            }
        });
        updateValueStep3();        
        $('.penerima_kps').change(function() {
            if(this.value==1){
                $('#div_nokps').removeClass( "hidden" );                
            }else{
                $('#div_nokps').addClass( "hidden" );
            }
        });
        $('.pilihan_wali').change(function() {
            clear_wali();
            if(this.value!=-1){
                if(this.value==0){
                    sama_dengan_ibu();
                }else if(this.value==1){
                    sama_dengan_ayah();
                }
                $('#form_wali').removeClass( "hidden" );                                
            }else{
                $('#form_wali').addClass( "hidden" );
            }
        });
        updateValueStep4();
        updateValueStep5();
        updateValueStep6();
        updateValueStep7();
        $('.sanggup_mondok').change(function() {
            if(this.value==0){
                $('#tidak_mondok').removeClass( "hidden" );                                
            }else{
                $('#tidak_mondok').addClass( "hidden" );
            }
        });
        updateValueStep8();

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
        
        if(nkk!=""){
            if(nik!=""){
                if(nama!=""){
                    if(gender!=-1){
                        if(tmplhr!=""){
                            if(tgllhr!=""){
                                if(id_agama!=-1){
                                    if(id_negara!=""){
                                        saveOrUpdateStep1(nkk,nik,nama,gender,tmplhr,tgllhr,id_agama,agama,negara,id_negara);
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
    function saveOrUpdateStep1(nkk,nik,nama,gender,tmplhr,tgllhr,id_agama,agama,negara,id_negara) {
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

    // TAB STEP 2
    $('#edit_step_2').on('click',function() {
        $('#update_step_2').removeClass("hidden");
        $('#edit_step_2').addClass("hidden");  
        enabledStep2();      
    });
    function batalUpdateStep2(){
        updateValueStep2();
        $('#update_step_2').addClass("hidden");
        $('#edit_step_2').removeClass("hidden");  
        disabledStep2()
    }
    function updateValueStep2(){
        var step_2 = @json($step_2);
        if(step_2!=null){
            $('#jalan').val(step_2['jalan']);
            $('#dusun').val(step_2['dusun']);
            $('#rt').val(step_2['rt']);
            $('#rw').val(step_2['rw']);
            $('#kelurahan').val(step_2['kelurahan']);
            $('#kodepos').val(step_2['kodepos']);
            $('#kecamatan').val(step_2['id_wilayah']+" - "+step_2['kecamatan']
            +" - "+step_2['kota_kabupaten']+" - "+step_2['provinsi']);            
            $('#id_wilayah').val(step_2['id_wilayah']);        
            $('#email').val(step_2['email']);
            $('#wa_camaba').val(step_2['no_hp_camaba']);
            $('#wa_wali').val(step_2['no_hp_ortu']);
            disabledStep2();
        }
    }
    function disabledStep2(){
        $('#jalan').attr('disabled',true);
        $('#jalan').addClass('read_only');
        $('#dusun').attr('disabled',true);
        $('#dusun').addClass('read_only');
        $('#rt').attr('disabled',true);
        $('#rt').addClass('read_only');
        $('#rw').attr('disabled',true);
        $('#rw').addClass('read_only');
        $('#kelurahan').attr('disabled',true);
        $('#kelurahan').addClass('read_only');
        $('#kodepos').attr('disabled',true);
        $('#kodepos').addClass('read_only');
        $('#kecamatan').attr('disabled',true);
        $('#kecamatan').addClass('read_only');
        $('#email').attr('disabled',true);
        $('#email').addClass('read_only');
        $('#wa_camaba').attr('disabled',true);
        $('#wa_camaba').addClass('read_only');
        $('#wa_wali').attr('disabled',true);
        $('#wa_wali').addClass('read_only');
    }
    function enabledStep2(){
        $('#jalan').attr('disabled',false);
        $('#jalan').removeClass('read_only');
        $('#dusun').attr('disabled',false);
        $('#dusun').removeClass('read_only');
        $('#rt').attr('disabled',false);
        $('#rt').removeClass('read_only');
        $('#rw').attr('disabled',false);
        $('#rw').removeClass('read_only');
        $('#kelurahan').attr('disabled',false);
        $('#kelurahan').removeClass('read_only');
        $('#kodepos').attr('disabled',false);
        $('#kodepos').removeClass('read_only');
        $('#kecamatan').attr('disabled',false);
        $('#kecamatan').removeClass('read_only');
        $('#email').attr('disabled',false);
        $('#email').removeClass('read_only');
        $('#wa_camaba').attr('disabled',false);
        $('#wa_camaba').removeClass('read_only');
        $('#wa_wali').attr('disabled',false);
        $('#wa_wali').removeClass('read_only');
    }
    function ValidateStep2() {
        var jalan = $('#jalan').val();
        var dusun = $('#dusun').val();
        var rt = $('#rt').val();
        var rw = $('#rw').val();
        var kelurahan = $('#kelurahan').val();
        var kodepos = $('#kodepos').val();
        var kecamatan = $('#kecamatan').val();            
        var id_wilayah = $('#id_wilayah').val();        
        var email = $('#email').val();
        var wa_camaba = $('#wa_camaba').val();
        var wa_wali = $('#wa_wali').val();

        if(kelurahan!=""){
            if(id_wilayah!=""){
                if(email!=""){
                    if(wa_camaba!=""){
                        if(wa_wali!=""){                            
                            saveOrUpdateStep2(
                                jalan,dusun,rt,rw,kelurahan,
                                kodepos,kecamatan,id_wilayah,
                                email,wa_camaba,wa_wali
                            );
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "Isi nomor handphone wali (whatsapp) dahulu!",
                            });
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Isi nomor handphone camaba (whatsapp) dahulu!",
                        });
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Isi email dahulu!",
                    });
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Pilih kecamatan dahulu!",
                });
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi kelurahan dahulu!",
            });
        }
    }
    function saveOrUpdateStep2(jalan,dusun,rt,rw,kelurahan,kodepos,kecamatan,id_wilayah,email,wa_camaba,wa_wali) {
        $('.containerr').show();
        var kec_split = kecamatan.split(' - ');
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['jalan'] = jalan;
        datar['dusun'] = dusun;
        datar['rt'] = rt;
        datar['rw'] = rw;
        datar['kelurahan'] = kelurahan;
        datar['kodepos'] = kodepos;
        datar['kecamatan'] = kec_split[1];
        datar['kota_kabupaten'] = kec_split[2];
        datar['provinsi'] = kec_split[3];
        datar['id_wilayah'] = id_wilayah;        
        datar['email'] = email;
        datar['wa_camaba'] = wa_camaba;
        datar['wa_wali'] = wa_wali;        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#saveOrUpdateUrlStep2").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    // location.reload();
                    window.location.href = window.location.href.replace( /[\?#].*|$/, "?tab=2" );
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

    // TAB STEP 3
    $('#edit_step_3').on('click',function() {
        $('#update_step_3').removeClass("hidden");
        $('#edit_step_3').addClass("hidden");  
        enabledStep3();      
        // triger onclick
        $('#kondisi_ayah').val($('#kondisi_ayah option:selected').val()).trigger('change');
        $('#kondisi_ibu').val($('#kondisi_ibu option:selected').val()).trigger('change');
    });
    function batalUpdateStep3(){
        updateValueStep3();
        $('#update_step_3').addClass("hidden");
        $('#edit_step_3').removeClass("hidden");  
        disabledStep3();
    }
    function clearAyahData() {
        $('#nik_ayah').val(null);            
        $('#nama_ayah').val(null);            
        $('#tgllhr_ayah').val(null);
        $('#pendidikan_ayah').val(-1);
        $('#pekerjaan_ayah').val(-1);
        $('#penghasilan_ayah').val(-1);            
    }
    function clearIbuData() {
        $('#nik_ibu').val(null);                    
        $('#tgllhr_ibu').val(null);
        $('#pendidikan_ibu').val(-1);
        $('#pekerjaan_ibu').val(-1);
        $('#penghasilan_ibu').val(-1);            
    }
    function updateValueStep3(){
        var step_3 = @json($step_3);
        if(step_3!=null){
            $('#kondisi_ayah').val(step_3['kondisi_ayah']);            
            $('#nik_ayah').val(step_3['nik_ayah']);            
            $('#nama_ayah').val(step_3['nama_ayah']);            
            $('#tgllhr_ayah').val(step_3['tanggal_lahir_ayah']);
            $('#pendidikan_ayah').val(step_3['id_jenjang_pendidikan_ayah']);
            $('#pekerjaan_ayah').val(step_3['id_pekerjaan_ayah']);
            $('#penghasilan_ayah').val(step_3['id_penghasilan_ayah']);            
            $('#kondisi_ibu').val(step_3['kondisi_ibu']);            
            $('#nik_ibu').val(step_3['nik_ibu']);            
            $('#nama_ibu').val(step_3['nama_ibu']);            
            $('#tgllhr_ibu').val(step_3['tanggal_lahir_ibu']);            
            $('#pendidikan_ibu').val(step_3['id_jenjang_pendidikan_ibu']);
            $('#pekerjaan_ibu').val(step_3['id_pekerjaan_ibu']);
            $('#penghasilan_ibu').val(step_3['id_penghasilan_ibu']);      
            disabledStep3();            
        }
    }
    function disabledStep3(){
        $('#kondisi_ayah').attr('disabled',true);
        $('#kondisi_ayah').addClass('read_only');
        $('#nik_ayah').attr('disabled',true);
        $('#nik_ayah').addClass('read_only');
        $('#nama_ayah').attr('disabled',true);
        $('#nama_ayah').addClass('read_only');
        $('#tgllhr_ayah').attr('disabled',true);
        $('#tgllhr_ayah').addClass('read_only');
        $('#pendidikan_ayah').attr('disabled',true);
        $('#pendidikan_ayah').addClass('read_only');
        $('#pekerjaan_ayah').attr('disabled',true);
        $('#pekerjaan_ayah').addClass('read_only');
        $('#penghasilan_ayah').attr('disabled',true);
        $('#penghasilan_ayah').addClass('read_only');
        $('#kondisi_ibu').attr('disabled',true);
        $('#kondisi_ibu').addClass('read_only');
        $('#nik_ibu').attr('disabled',true);
        $('#nik_ibu').addClass('read_only');
        $('#nama_ibu').attr('disabled',true);
        $('#nama_ibu').addClass('read_only');
        $('#tgllhr_ibu').attr('disabled',true);
        $('#tgllhr_ibu').addClass('read_only');
        $('#pendidikan_ibu').attr('disabled',true);
        $('#pendidikan_ibu').addClass('read_only');
        $('#pekerjaan_ibu').attr('disabled',true);
        $('#pekerjaan_ibu').addClass('read_only');
        $('#penghasilan_ibu').attr('disabled',true);
        $('#penghasilan_ibu').addClass('read_only');
    }
    function disabledAyahStep3(){
        $('#nik_ayah').attr('disabled',true);
        $('#nik_ayah').addClass('read_only');
        $('#nama_ayah').attr('disabled',true);
        $('#nama_ayah').addClass('read_only');
        $('#tgllhr_ayah').attr('disabled',true);
        $('#tgllhr_ayah').addClass('read_only');
        $('#pendidikan_ayah').attr('disabled',true);
        $('#pendidikan_ayah').addClass('read_only');
        $('#pekerjaan_ayah').attr('disabled',true);
        $('#pekerjaan_ayah').addClass('read_only');
        $('#penghasilan_ayah').attr('disabled',true);
        $('#penghasilan_ayah').addClass('read_only');
    }
    function disabledIbuStep3(){        
        $('#nik_ibu').attr('disabled',true);
        $('#nik_ibu').addClass('read_only');
        $('#nama_ibu').attr('disabled',true);
        $('#nama_ibu').addClass('read_only');
        $('#tgllhr_ibu').attr('disabled',true);
        $('#tgllhr_ibu').addClass('read_only');
        $('#pendidikan_ibu').attr('disabled',true);
        $('#pendidikan_ibu').addClass('read_only');
        $('#pekerjaan_ibu').attr('disabled',true);
        $('#pekerjaan_ibu').addClass('read_only');
        $('#penghasilan_ibu').attr('disabled',true);
        $('#penghasilan_ibu').addClass('read_only');
    }
    function enabledStep3(){
        $('#kondisi_ayah').attr('disabled',false);
        $('#kondisi_ayah').removeClass('read_only');
        $('#nik_ayah').attr('disabled',false);
        $('#nik_ayah').removeClass('read_only');
        $('#nama_ayah').attr('disabled',false);
        $('#nama_ayah').removeClass('read_only');
        $('#tgllhr_ayah').attr('disabled',false);
        $('#tgllhr_ayah').removeClass('read_only');
        $('#pendidikan_ayah').attr('disabled',false);
        $('#pendidikan_ayah').removeClass('read_only');
        $('#pekerjaan_ayah').attr('disabled',false);
        $('#pekerjaan_ayah').removeClass('read_only');
        $('#penghasilan_ayah').attr('disabled',false);
        $('#penghasilan_ayah').removeClass('read_only');
        $('#kondisi_ibu').attr('disabled',false);
        $('#kondisi_ibu').removeClass('read_only');
        $('#nik_ibu').attr('disabled',false);
        $('#nik_ibu').removeClass('read_only');
        $('#nama_ibu').attr('disabled',false);
        $('#nama_ibu').removeClass('read_only');
        $('#tgllhr_ibu').attr('disabled',false);
        $('#tgllhr_ibu').removeClass('read_only');
        $('#pendidikan_ibu').attr('disabled',false);
        $('#pendidikan_ibu').removeClass('read_only');
        $('#pekerjaan_ibu').attr('disabled',false);
        $('#pekerjaan_ibu').removeClass('read_only');
        $('#penghasilan_ibu').attr('disabled',false);
        $('#penghasilan_ibu').removeClass('read_only');
    }
    function enabledAyahStep3(){
        $('#nik_ayah').attr('disabled',false);
        $('#nik_ayah').removeClass('read_only');
        $('#nama_ayah').attr('disabled',false);
        $('#nama_ayah').removeClass('read_only');
        $('#tgllhr_ayah').attr('disabled',false);
        $('#tgllhr_ayah').removeClass('read_only');
        $('#pendidikan_ayah').attr('disabled',false);
        $('#pendidikan_ayah').removeClass('read_only');
        $('#pekerjaan_ayah').attr('disabled',false);
        $('#pekerjaan_ayah').removeClass('read_only');
        $('#penghasilan_ayah').attr('disabled',false);
        $('#penghasilan_ayah').removeClass('read_only');
    }    
    function enableNamaIbuOnlyStep3(){
        $('#nama_ibu').attr('disabled',false);
        $('#nama_ibu').removeClass('read_only');
    }
    function enabledIbuStep3(){
        $('#nik_ibu').attr('disabled',false);
        $('#nik_ibu').removeClass('read_only');
        $('#nama_ibu').attr('disabled',false);
        $('#nama_ibu').removeClass('read_only');
        $('#tgllhr_ibu').attr('disabled',false);
        $('#tgllhr_ibu').removeClass('read_only');
        $('#pendidikan_ibu').attr('disabled',false);
        $('#pendidikan_ibu').removeClass('read_only');
        $('#pekerjaan_ibu').attr('disabled',false);
        $('#pekerjaan_ibu').removeClass('read_only');
        $('#penghasilan_ibu').attr('disabled',false);
        $('#penghasilan_ibu').removeClass('read_only');
    }
    function ValidateStep3() {
        var kondisi_ayah = $('#kondisi_ayah option:selected').val(); 
        var nik_ayah = $('#nik_ayah').val();            
        var nama_ayah = $('#nama_ayah').val();            
        var tgllhr_ayah = $('#tgllhr_ayah').val();
        var id_jenjang_pendidikan_ayah = $('#pendidikan_ayah option:selected').val();
        var pendidikan_ayah = $('#pendidikan_ayah option:selected').text();
        var id_pekerjaan_ayah = $('#pekerjaan_ayah option:selected').val();
        var pekerjaan_ayah = $('#pekerjaan_ayah option:selected').text();
        var id_penghasilan_ayah = $('#penghasilan_ayah option:selected').val();            
        var penghasilan_ayah = $('#penghasilan_ayah option:selected').text();                                     
        var kondisi_ibu = $('#kondisi_ibu option:selected').val();      
        var nik_ibu = $('#nik_ibu').val();            
        var nama_ibu = $('#nama_ibu').val();            
        var tgllhr_ibu = $('#tgllhr_ibu').val();            
        var id_jenjang_pendidikan_ibu = $('#pendidikan_ibu option:selected').val();
        var pendidikan_ibu = $('#pendidikan_ibu option:selected').text();
        var id_pekerjaan_ibu = $('#pekerjaan_ibu option:selected').val();
        var pekerjaan_ibu = $('#pekerjaan_ibu option:selected').text();
        var id_penghasilan_ibu = $('#penghasilan_ibu option:selected').val();
        var penghasilan_ibu = $('#penghasilan_ibu option:selected').text();

        if(kondisi_ayah!=-1){
            if(kondisi_ayah==1){
                // cek kelengkapan data ayah
                // ayah masih hidup, lanjut ibu
                cekDataAyahLanjutDataIbu(
                    kondisi_ayah,nik_ayah,nama_ayah,tgllhr_ayah,pendidikan_ayah,
                    pekerjaan_ayah,penghasilan_ayah,kondisi_ibu,nik_ibu,nama_ibu,
                    tgllhr_ibu,pendidikan_ibu,pekerjaan_ibu,penghasilan_ibu,
                    id_jenjang_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,
                    id_jenjang_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah
                );
            }else{
                if(kondisi_ibu!=-1){
                    if(kondisi_ibu==1){
                        // cek kelengkapan data ibu
                        // ayah meninggal, ibu masih hidup
                        cekDataIbuAndSave(
                            kondisi_ayah,nik_ayah,nama_ayah,tgllhr_ayah,pendidikan_ayah,
                            pekerjaan_ayah,penghasilan_ayah,kondisi_ibu,nik_ibu,nama_ibu,
                            tgllhr_ibu,pendidikan_ibu,pekerjaan_ibu,penghasilan_ibu,
                            id_jenjang_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,
                            id_jenjang_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah
                        );
                    }else{
                        if(nama_ibu!=""){                            
                            // ayah meninggal, ibu meninggal
                            saveOrUpdateStep3(
                                kondisi_ayah,null,null,null,null,null,null,
                                kondisi_ibu,null,nama_ibu,null,null,null,
                                null,-1,-1,-1,-1,-1,-1
                            )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "Isi nama ibu dahulu!",
                            });
                        }
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Pilih kondisi ibu dahulu!",
                    });
                }
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih kondisi ayah dahulu!",
            });
        }
    }    
    function cekDataAyahLanjutDataIbu(
        kondisi_ayah,nik_ayah,nama_ayah,tgllhr_ayah,pendidikan_ayah,
        pekerjaan_ayah,penghasilan_ayah,kondisi_ibu,nik_ibu,nama_ibu,
        tgllhr_ibu,pendidikan_ibu,pekerjaan_ibu,penghasilan_ibu,
        id_jenjang_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,
        id_jenjang_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah
    ) {
        if(nik_ayah!=""){
        if(nama_ayah!=""){
        if(tgllhr_ayah!=""){
        if(id_jenjang_pendidikan_ayah!=-1){
        if(id_pekerjaan_ayah!=-1){
        if(id_penghasilan_ayah!=-1){
            cekDataIbuAndSaveWithDataAyah(
                kondisi_ayah,nik_ayah,nama_ayah,tgllhr_ayah,pendidikan_ayah,
                pekerjaan_ayah,penghasilan_ayah,kondisi_ibu,nik_ibu,nama_ibu,
                tgllhr_ibu,pendidikan_ibu,pekerjaan_ibu,penghasilan_ibu,
                id_jenjang_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,
                id_jenjang_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah
            );
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih penghasilan ayah dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih pekerjaan ayah dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih pendidikan ayah dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi tanggal lahir ayah dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi nama ayah dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi nomor induk kependudukan ayah dahulu!",
            });
        }
    }
    function cekDataIbuAndSaveWithDataAyah(
        kondisi_ayah,nik_ayah,nama_ayah,tgllhr_ayah,pendidikan_ayah,
        pekerjaan_ayah,penghasilan_ayah,kondisi_ibu,nik_ibu,nama_ibu,
        tgllhr_ibu,pendidikan_ibu,pekerjaan_ibu,penghasilan_ibu,
        id_jenjang_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,
        id_jenjang_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah
    ) {
        if(kondisi_ibu!=-1){
                    if(kondisi_ibu==1){
                        // cek kelengkapan data ibu
                        // ayah meninggal, ibu masih hidup
                        if(nik_ibu!=""){
                        if(nama_ibu!=""){
                        if(tgllhr_ibu!=""){
                        if(id_jenjang_pendidikan_ibu!=-1){
                        if(id_pekerjaan_ibu!=-1){
                        if(id_penghasilan_ibu!=-1){ 
                            saveOrUpdateStep3(
                                kondisi_ayah,nik_ayah,nama_ayah,tgllhr_ayah,pendidikan_ayah,
                                pekerjaan_ayah,penghasilan_ayah,kondisi_ibu,nik_ibu,nama_ibu,
                                tgllhr_ibu,pendidikan_ibu,pekerjaan_ibu,penghasilan_ibu,
                                id_jenjang_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,
                                id_jenjang_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah
                            );
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "Pilih penghasilan ibu dahulu!",
                            });
                        }
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "Pilih pekerjaan ibu dahulu!",
                            });
                        }
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "Pilih pendidikan ibu dahulu!",
                            });
                        }
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "Isi tanggal lahir ibu dahulu!",
                            });
                        }
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "Isi nama ibu (sesuai KTP) dahulu!",
                            });
                        }
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "Isi nomor induk kependudukan ibu dahulu!",
                            });
                        }        
                    }else{
                        if(nama_ibu!=""){                            
                            // ayah meninggal, ibu meninggal
                            saveOrUpdateStep3(
                                kondisi_ayah,nik_ayah,nama_ayah,tgllhr_ayah,pendidikan_ayah,
                                pekerjaan_ayah,penghasilan_ayah,kondisi_ibu,null,nama_ibu,null,null,null,
                                null,-1,-1,-1,id_jenjang_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah
                            )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: "Isi nama ibu dahulu!",
                            });
                        }
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Pilih kondisi ibu dahulu!",
                    });
                }        
    }
    function cekDataIbuAndSave(
        kondisi_ayah,nik_ayah,nama_ayah,tgllhr_ayah,pendidikan_ayah,
        pekerjaan_ayah,penghasilan_ayah,kondisi_ibu,nik_ibu,nama_ibu,
        tgllhr_ibu,pendidikan_ibu,pekerjaan_ibu,penghasilan_ibu,
        id_jenjang_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,
        id_jenjang_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah
    ) {
        if(nik_ibu!=""){
        if(nama_ibu!=""){
        if(tgllhr_ibu!=""){
        if(id_jenjang_pendidikan_ibu!=-1){
        if(id_pekerjaan_ibu!=-1){
        if(id_penghasilan_ibu!=-1){ 
            saveOrUpdateStep3(
            kondisi_ayah,null,null,null,null,
            null,null,kondisi_ibu,nik_ibu,nama_ibu,
            tgllhr_ibu,pendidikan_ibu,pekerjaan_ibu,penghasilan_ibu,
            id_jenjang_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,
            -1,-1,-1
        );
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih penghasilan ibu dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih pekerjaan ibu dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih pendidikan ibu dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi tanggal lahir ibu dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi nama ibu (sesuai KTP) dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi nomor induk kependudukan ibu dahulu!",
            });
        }
    }
    function saveOrUpdateStep3(
        kondisi_ayah,nik_ayah,nama_ayah,tgllhr_ayah,pendidikan_ayah,
        pekerjaan_ayah,penghasilan_ayah,kondisi_ibu,nik_ibu,nama_ibu,
        tgllhr_ibu,pendidikan_ibu,pekerjaan_ibu,penghasilan_ibu,
        id_jenjang_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,
        id_jenjang_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah
    ) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['kondisi_ayah'] = kondisi_ayah;        
        datar['nik_ayah'] = nik_ayah;
        datar['nama_ayah'] = nama_ayah;
        datar['tanggal_lahir_ayah'] = tgllhr_ayah;
        datar['id_jenjang_pendidikan_ayah'] = id_jenjang_pendidikan_ayah;        
        datar['pendidikan_ayah'] = pendidikan_ayah;        
        datar['id_pekerjaan_ayah'] = id_pekerjaan_ayah;
        datar['pekerjaan_ayah'] = pekerjaan_ayah;
        datar['id_penghasilan_ayah'] = id_penghasilan_ayah;
        datar['penghasilan_ayah'] = penghasilan_ayah;
        datar['kondisi_ibu'] = kondisi_ibu;
        datar['nik_ibu'] = nik_ibu;
        datar['nama_ibu'] = nama_ibu;
        datar['tanggal_lahir_ibu'] = tgllhr_ibu;
        datar['id_jenjang_pendidikan_ibu'] = id_jenjang_pendidikan_ibu;
        datar['pendidikan_ibu'] = pendidikan_ibu;
        datar['id_pekerjaan_ibu'] = id_pekerjaan_ibu;
        datar['pekerjaan_ibu'] = pekerjaan_ibu;
        datar['id_penghasilan_ibu'] = id_penghasilan_ibu;
        datar['penghasilan_ibu'] = penghasilan_ibu;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#saveOrUpdateUrlStep3").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    // location.reload();
                    window.location.href = window.location.href.replace( /[\?#].*|$/, "?tab=3" );
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

    // TAB STEP 4
    $('#edit_step_4').on('click',function() {
        $('#update_step_4').removeClass("hidden");
        $('#edit_step_4').addClass("hidden");  
        enabledStep4();      
    });
    function batalUpdateStep4(){
        updateValueStep4();
        $('#update_step_4').addClass("hidden");
        $('#edit_step_4').removeClass("hidden");  
        disabledStep4()
    }
    function updateValueStep4(){
        var step_4 = @json($step_4);
        if(step_4!=null){
            $("#pilihan_wali").val(step_4['opsi_wali']);
            $("#nik_wali").val(step_4['nik_wali']);
            $("#nama_wali").val(step_4['nama_wali']);
            $("#tgllhr_wali").val(step_4['tanggal_lahir_wali']);
            $("#pendidikan_wali").val(step_4['id_jenjang_pendidikan_wali']);
            $("#pekerjaan_wali").val(step_4['id_pekerjaan_wali']);
            $("#penghasilan_wali").val(step_4['id_penghasilan_wali']);
            $("#penerima_kps").val(step_4['is_kps']);
            $("#nomor_kps").val(step_4['no_kps']);                    
            if(step_4['is_kps']==1){
                $('#div_nokps').removeClass( "hidden" );                
            }else{
                $('#div_nokps').addClass( "hidden" );
            }
            if(step_4['opsi_wali']!=-1){
                $('#form_wali').removeClass( "hidden" );                                
            }else{
                $('#form_wali').addClass( "hidden" );
            }
            disabledStep4();
        }
    }
    function clear_wali() {
        $("#nik_wali").val("");
        $('#nik_wali').removeClass( "read_only" );
        $('#nik_wali').attr('readonly', false);

        $("#nama_wali").val("");
        $('#nama_wali').removeClass( "read_only" );
        $('#nama_wali').attr('readonly', false);

        $("#tgllhr_wali").val("");
        $('#tgllhr_wali').removeClass( "read_only" );
        $('#tgllhr_wali').attr('readonly', false);
        
        $("#pendidikan_wali").val("-1");
        $('#pendidikan_wali').removeClass( "read_only" );
        $("#pendidikan_wali").attr('disabled', false);
        
        $("#pekerjaan_wali").val("-1");
        $('#pekerjaan_wali').removeClass( "read_only" );
        $("#pekerjaan_wali").attr('disabled', false);
        
        $("#penghasilan_wali").val("-1");
        $('#penghasilan_wali').removeClass( "read_only" );
        $('#penghasilan_wali').attr('disabled', false);
    }
    function sama_dengan_ibu() {
        $("#nik_wali").val($("#nik_ibu").val());
        $('#nik_wali').addClass( "read_only" );
        $('#nik_wali').attr('readonly', true);

        $("#nama_wali").val($("#nama_ibu").val());
        $('#nama_wali').addClass( "read_only" );
        $('#nama_wali').attr('readonly', true);

        $("#tgllhr_wali").val($("#tgllhr_ibu").val());
        $('#tgllhr_wali').addClass( "read_only" );
        $('#tgllhr_wali').attr('readonly', true);

        $("#pendidikan_wali").val($("#pendidikan_ibu  option:selected").val());
        $('#pendidikan_wali').addClass( "read_only" );
        $('#pendidikan_wali').attr('disabled', true);

        $("#pekerjaan_wali").val($("#pekerjaan_ibu  option:selected").val());
        $('#pekerjaan_wali').addClass( "read_only" );
        $('#pekerjaan_wali').attr('disabled', true);

        $("#penghasilan_wali").val($("#penghasilan_ibu  option:selected").val());
        $('#penghasilan_wali').addClass( "read_only" );
        $('#penghasilan_wali').attr('disabled', true);
    }
    function sama_dengan_ayah() {
        $("#nik_wali").val($("#nik_ayah").val());
        $('#nik_wali').addClass( "read_only" );
        $('#nik_wali').attr('readonly', true);

        $("#nama_wali").val($("#nama_ayah").val());
        $('#nama_wali').addClass( "read_only" );
        $('#nama_wali').attr('readonly', true);

        $("#tgllhr_wali").val($("#tgllhr_ayah").val());
        $('#tgllhr_wali').addClass( "read_only" );
        $('#tgllhr_wali').attr('readonly', true);

        $("#pendidikan_wali").val($("#pendidikan_ayah  option:selected").val());
        $('#pendidikan_wali').addClass( "read_only" );
        $('#pendidikan_wali').attr('disabled', true);

        $("#pekerjaan_wali").val($("#pekerjaan_ayah  option:selected").val());
        $('#pekerjaan_wali').addClass( "read_only" );
        $('#pekerjaan_wali').attr('disabled', true);

        $("#penghasilan_wali").val($("#penghasilan_ayah  option:selected").val());
        $('#penghasilan_wali').addClass( "read_only" );
        $('#penghasilan_wali').attr('disabled', true);
    }
    function disabledStep4(){
        $("#pilihan_wali").attr('disabled',true);
        $("#pilihan_wali").addClass('read_only');
        $("#nik_wali").attr('disabled',true);
        $("#nik_wali").addClass('read_only');
        $("#nama_wali").attr('disabled',true);
        $("#nama_wali").addClass('read_only');
        $("#tgllhr_wali").attr('disabled',true);
        $("#tgllhr_wali").addClass('read_only');
        $("#pendidikan_wali").attr('disabled',true);
        $("#pendidikan_wali").addClass('read_only');
        $("#pekerjaan_wali").attr('disabled',true);
        $("#pekerjaan_wali").addClass('read_only');
        $("#penghasilan_wali").attr('disabled',true);
        $("#penghasilan_wali").addClass('read_only');
        $("#penerima_kps").attr('disabled',true);
        $("#penerima_kps").addClass('read_only');
        $("#nomor_kps").attr('disabled',true);
        $("#nomor_kps").addClass('read_only');
    }
    function enabledStep4(){
        $("#pilihan_wali").attr('disabled',false);
        $("#pilihan_wali").removeClass('read_only');
        $("#nik_wali").attr('disabled',false);
        $("#nik_wali").removeClass('read_only');
        $("#nama_wali").attr('disabled',false);
        $("#nama_wali").removeClass('read_only');
        $("#tgllhr_wali").attr('disabled',false);
        $("#tgllhr_wali").removeClass('read_only');
        $("#pendidikan_wali").attr('disabled',false);
        $("#pendidikan_wali").removeClass('read_only');
        $("#pekerjaan_wali").attr('disabled',false);
        $("#pekerjaan_wali").removeClass('read_only');
        $("#penghasilan_wali").attr('disabled',false);
        $("#penghasilan_wali").removeClass('read_only');
        $("#penerima_kps").attr('disabled',false);
        $("#penerima_kps").removeClass('read_only');
        $("#nomor_kps").attr('disabled',false);
        $("#nomor_kps").removeClass('read_only');
    }
    function ValidateStep4() {
        var pilihan_wali = $("#pilihan_wali option:selected").val();
        var nik_wali = $("#nik_wali").val();
        var nama_wali = $("#nama_wali").val();
        var tgllhr_wali = $("#tgllhr_wali").val();
        var id_jenjang_pendidikan_wali = $("#pendidikan_wali option:selected").val();
        var pendidikan_wali = $("#pendidikan_wali option:selected").text();
        var id_pekerjaan_wali = $("#pekerjaan_wali option:selected").val();
        var pekerjaan_wali = $("#pekerjaan_wali option:selected").text();
        var id_penghasilan_wali = $("#penghasilan_wali option:selected").val();
        var penghasilan_wali = $("#penghasilan_wali option:selected").text();
        var penerima_kps = $("#penerima_kps option:selected").val();
        var nomor_kps = $("#nomor_kps").val();  

        if(pilihan_wali!=-1){
        if(nik_wali!=""){
        if(nama_wali!=""){
        if(tgllhr_wali!=""){
        if(id_jenjang_pendidikan_wali!=-1){
        if(id_pekerjaan_wali!=-1){
        if(id_penghasilan_wali!=-1){
        if(penerima_kps!=-1){
            if(penerima_kps==1){
                if(nomor_kps!=""){                          
                saveOrUpdateStep4(
                    pilihan_wali,nik_wali,nama_wali,tgllhr_wali,
                    id_jenjang_pendidikan_wali,pendidikan_wali,
                    id_pekerjaan_wali,pekerjaan_wali,id_penghasilan_wali,
                    penghasilan_wali,penerima_kps,nomor_kps  
                );        
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Isi nomor kps dahulu!",
                    });
                }
            }else{
                saveOrUpdateStep4(
                    pilihan_wali,nik_wali,nama_wali,tgllhr_wali,
                    id_jenjang_pendidikan_wali,pendidikan_wali,
                    id_pekerjaan_wali,pekerjaan_wali,id_penghasilan_wali,
                    penghasilan_wali,penerima_kps,nomor_kps
                );   
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih pilihan penerima kps dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih penghasilan wali dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih pekerjaan wali dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih pendidikan wali dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi tanggal lahir wali dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi nama wali dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi nomor induk kependudukan wali dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih data wali mahasiswa dahulu!",
            });
        }
    }
    function saveOrUpdateStep4(
        pilihan_wali,nik_wali,nama_wali,tgllhr_wali,
        id_jenjang_pendidikan_wali,pendidikan_wali,
        id_pekerjaan_wali,pekerjaan_wali,id_penghasilan_wali,
        penghasilan_wali,penerima_kps,nomor_kps
    ) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['opsi_wali'] = pilihan_wali;        
        datar['nik_wali'] = nik_wali;
        datar['nama_wali'] = nama_wali;
        datar['tanggal_lahir_wali'] = tgllhr_wali;        
        datar['id_jenjang_pendidikan_wali'] = id_jenjang_pendidikan_wali;
        datar['pendidikan_wali'] = pendidikan_wali;
        datar['id_pekerjaan_wali'] = id_pekerjaan_wali;
        datar['pekerjaan_wali'] = pekerjaan_wali;
        datar['id_penghasilan_wali'] = id_penghasilan_wali;
        datar['penghasilan_wali'] = penghasilan_wali;
        datar['is_kps'] = penerima_kps;
        datar['no_kps'] = nomor_kps;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#saveOrUpdateUrlStep4").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    // location.reload();
                    window.location.href = window.location.href.replace( /[\?#].*|$/, "?tab=4" );
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

    // TAB STEP 5
    $('#edit_step_5').on('click',function() {
        $('#update_step_5').removeClass("hidden");
        $('#edit_step_5').addClass("hidden");  
        enabledStep5();      
    });
    function batalUpdateStep5(){
        updateValueStep5();
        $('#update_step_5').addClass("hidden");
        $('#edit_step_5').removeClass("hidden");  
        disabledStep5()
    }
    function updateValueStep5(){
        var step_5 = @json($step_5);
        if(step_5!=null){
            $("#alumni_smawa").val(step_5['is_alumni']);
            $("#pendidikan_asal").val(step_5['pendidikan_asal']);
            $("#jenis_pendidikan_asal").val(step_5['jenis_pendidikan_asal']);
            $("#nama_pendidikan_asal").val(step_5['nama_pendidikan_asal']);
            $("#nisn").val(step_5['nisn']);
            $("#alamat_pendidikan_asal").val(step_5['alamat_pendidikan_asal']);            
            disabledStep5();
        }
    }
    function disabledStep5(){
        $("#alumni_smawa").attr('disabled',true);
        $("#alumni_smawa").addClass('read_only');
        $("#pendidikan_asal").attr('disabled',true);
        $("#pendidikan_asal").addClass('read_only');
        $("#jenis_pendidikan_asal").attr('disabled',true);
        $("#jenis_pendidikan_asal").addClass('read_only');
        $("#nama_pendidikan_asal").attr('disabled',true);
        $("#nama_pendidikan_asal").addClass('read_only');
        $("#nisn").attr('disabled',true);
        $("#nisn").addClass('read_only');
        $("#alamat_pendidikan_asal").attr('disabled',true);
        $("#alamat_pendidikan_asal").addClass('read_only');        
    }
    function enabledStep5(){
        $("#alumni_smawa").attr('disabled',false);
        $("#alumni_smawa").removeClass('read_only');
        $("#pendidikan_asal").attr('disabled',false);
        $("#pendidikan_asal").removeClass('read_only');
        $("#jenis_pendidikan_asal").attr('disabled',false);
        $("#jenis_pendidikan_asal").removeClass('read_only');
        $("#nama_pendidikan_asal").attr('disabled',false);
        $("#nama_pendidikan_asal").removeClass('read_only');
        $("#nisn").attr('disabled',false);
        $("#nisn").removeClass('read_only');
        $("#alamat_pendidikan_asal").attr('disabled',false);
        $("#alamat_pendidikan_asal").removeClass('read_only');
    }
    function ValidateStep5() {
        var is_alumni = $("#alumni_smawa option:selected").val();
        var pendidikan_asal = $("#pendidikan_asal option:selected").val();
        var jenis_pendidikan_asal = $("#jenis_pendidikan_asal option:selected").val();
        var nama_pendidikan_asal = $("#nama_pendidikan_asal").val();
        var nisn = $("#nisn").val();
        var alamat_pendidikan_asal = $("#alamat_pendidikan_asal").val();        

        if(is_alumni!=-1){
        if(pendidikan_asal!=-1){
        if(jenis_pendidikan_asal!=-1){
        if(nama_pendidikan_asal!=""){
        if(nisn!=""){
        if(alamat_pendidikan_asal!=""){
            saveOrUpdateStep5(
                is_alumni,pendidikan_asal,jenis_pendidikan_asal,nama_pendidikan_asal,
                nisn,alamat_pendidikan_asal                    
            );                
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi alamat sekolah asal dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi nisn dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi nama pendidikan asal dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih jenis pendidikan asal dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih pendidikan asal dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih jawaban atas pertanyaan terkait alumni dahulu!",
            });
        }
    }
    function saveOrUpdateStep5(
        is_alumni,pendidikan_asal,jenis_pendidikan_asal,
        nama_pendidikan_asal,nisn,alamat_pendidikan_asal
    ) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['is_alumni'] = is_alumni;
        datar['pendidikan_asal'] = pendidikan_asal;
        datar['jenis_pendidikan_asal'] = jenis_pendidikan_asal;
        datar['nama_pendidikan_asal'] = nama_pendidikan_asal;
        datar['nisn'] = nisn;
        datar['alamat_pendidikan_asal'] = alamat_pendidikan_asal;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#saveOrUpdateUrlStep5").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    // location.reload();
                    window.location.href = window.location.href.replace( /[\?#].*|$/, "?tab=5" );
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

    // TAB STEP 6
    $('#edit_step_6').on('click',function() {
        $('#update_step_6').removeClass("hidden");
        $('#edit_step_6').addClass("hidden");  
        enabledStep6();      
    });
    function batalUpdateStep6(){
        updateValueStep6();
        $('#update_step_6').addClass("hidden");
        $('#edit_step_6').removeClass("hidden");  
        disabledStep6()
    }
    function updateValueStep6(){
        var step_6 = @json($step_6);
        if(step_6!=null){
            $("#ta").val(step_6['tahun_akademik_registrasi']);
            $("#prodi_1").val(step_6['id_program_studi_1']);
            $("#prodi_2").val(step_6['id_program_studi_2']);
            disabledStep6();
        }
    }
    function disabledStep6(){
        $("#ta").attr('disabled',true);
        $("#ta").addClass('read_only');
        $("#prodi_1").attr('disabled',true);
        $("#prodi_1").addClass('read_only');
        $("#prodi_2").attr('disabled',true);
        $("#prodi_2").addClass('read_only');
    }
    function enabledStep6(){
        $("#ta").attr('disabled',false);
        $("#ta").removeClass('read_only');
        $("#prodi_1").attr('disabled',false);
        $("#prodi_1").removeClass('read_only');
        $("#prodi_2").attr('disabled',false);
        $("#prodi_2").removeClass('read_only');
    }
    function ValidateStep6() {
        var tahun_akademik_registrasi = $("#ta").val();
        var id_program_studi_1 = $("#prodi_1 option:selected").val();
        var id_program_studi_2 = $("#prodi_2 option:selected").val();

        if(id_program_studi_1!=-1){
        if(id_program_studi_2!=-1){
            saveOrUpdateStep6(
                tahun_akademik_registrasi,
                id_program_studi_1,
                id_program_studi_2                                    
            );                        
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih pilihan program studi 2 dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih pilihan program studi 1 dahulu!",
            });
        }
    }
    function saveOrUpdateStep6(
        tahun_akademik_registrasi,
        id_program_studi_1,
        id_program_studi_2 
    ) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['tahun_akademik_registrasi'] = tahun_akademik_registrasi;
        datar['id_program_studi_1'] = id_program_studi_1;
        datar['id_program_studi_2'] = id_program_studi_2;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#saveOrUpdateUrlStep6").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    // location.reload();
                    window.location.href = window.location.href.replace( /[\?#].*|$/, "?tab=6" );
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

    // TAB STEP 7
    $('#edit_step_7').on('click',function() {
        $('#update_step_7').removeClass("hidden");
        $('#edit_step_7').addClass("hidden");  
        enabledStep7();      
    });
    function batalUpdateStep7(){
        updateValueStep7();
        $('#update_step_7').addClass("hidden");
        $('#edit_step_7').removeClass("hidden");  
        disabledStep7()
    }
    function updateValueStep7(){
        var step_7 = @json($step_7);
        if(step_7!=null){
            $("#link_ktp_camaba").attr('href',`{{ asset('') }}`+'storage/'+step_7["url_ktp"]);
            $("#link_foto_camaba").attr('href',`{{ asset('') }}`+'storage/'+step_7["url_foto"]);
            $("#link_ktp_ayah").attr('href',`{{ asset('') }}`+'storage/'+step_7["url_ktp_ayah"]);
            $("#link_ktp_ibu").attr('href',`{{ asset('') }}`+'storage/'+step_7["url_ktp_ibu"]);
            $("#link_ktp_wali").attr('href',`{{ asset('') }}`+'storage/'+step_7["url_ktp_wali"]);
            $("#link_kk").attr('href',`{{ asset('') }}`+'storage/'+step_7["url_kk"]);
            $("#link_akta").attr('href',`{{ asset('') }}`+'storage/'+step_7["url_akta"]);
            $("#link_ijasah").attr('href',`{{ asset('') }}`+'storage/'+step_7["url_ijasah"]);
            $("#link_nilai_rapor").attr('href',`{{ asset('') }}`+'storage/'+step_7["url_nilai_rapor"]);
            $("#link_nilai_ujian_sekolah").attr('href',`{{ asset('') }}`+'storage/'+step_7["url_nilai_ujian_sekolah"]);
            $("#imgVal_dok_ktp_camaba").val(step_7["url_ktp_b64"]);    
            $("#thumb_ktp_camaba").attr('src',step_7["url_ktp_b64"]);    

            $("#imgVal_dok_foto_camaba").val(step_7["url_foto_b64"]);        
            $("#thumb_foto_camaba").attr('src',step_7["url_foto_b64"]);    
            
            $("#imgVal_dok_ktp_ayah").val(step_7["url_ktp_ayah_b64"]);        
            $("#thumb_ktp_ayah").attr('src',step_7["url_ktp_ayah_b64"]);    

            $("#imgVal_dok_ktp_ibu").val(step_7["url_ktp_ibu_b64"]);        
            $("#thumb_ktp_ibu").attr('src',step_7["url_ktp_ibu_b64"]);    

            $("#imgVal_dok_kk").val(step_7["url_kk_b64"]);        
            $("#thumb_kk").attr('src',step_7["url_kk_b64"]);    
           
            $("#imgVal_dok_ktp_wali").val(step_7["url_ktp_wali_b64"]);        
            $("#thumb_ktp_wali").attr('src',step_7["url_ktp_wali_b64"]);

            $("#imgVal_dok_akta").val(step_7["url_akta_b64"]);        
            $("#thumb_akta").attr('src',step_7["url_akta_b64"]);

            $("#imgVal_dok_ijasah").val(step_7["url_ijasah_b64"]);        
            $("#thumb_ijasah").attr('src',step_7["url_ijasah_b64"]);

            $("#imgVal_dok_nilai_ujian_sekolah").val(step_7["url_nilai_ujian_sekolah_b64"]);        
            $("#thumb_nilai_ujian_sekolah").attr('src',step_7["url_nilai_ujian_sekolah_b64"]);

            $("#imgVal_dok_nilai_rapor").val(step_7["url_nilai_rapor_b64"]);
            $("#thumb_nilai_rapor").attr('src',step_7["url_nilai_rapor_b64"]);

            disabledStep7();
        }else{
            $("#link_ktp_camaba").removeAttr("href").css({'cursor': 'not-allowed', 'pointer-events' : 'default'});
            $("#link_foto_camaba").removeAttr("href").css({'cursor': 'not-allowed', 'pointer-events' : 'default'});
            $("#link_ktp_ayah").removeAttr("href").css({'cursor': 'not-allowed', 'pointer-events' : 'default'});
            $("#link_ktp_ibu").removeAttr("href").css({'cursor': 'not-allowed', 'pointer-events' : 'default'});
            $("#link_ktp_wali").removeAttr("href").css({'cursor': 'not-allowed', 'pointer-events' : 'default'});
            $("#link_kk").removeAttr("href").css({'cursor': 'not-allowed', 'pointer-events' : 'default'});
            $("#link_akta").removeAttr("href").css({'cursor': 'not-allowed', 'pointer-events' : 'default'});
            $("#link_ijasah").removeAttr("href").css({'cursor': 'not-allowed', 'pointer-events' : 'default'});
            $("#link_nilai_rapor").removeAttr("href").css({'cursor': 'not-allowed', 'pointer-events' : 'default'});
            $("#link_nilai_ujian_sekolah").removeAttr("href").css({'cursor': 'not-allowed', 'pointer-events' : 'default'});
            $("#imgVal_dok_ktp_camaba").val("");        
            $("#imgVal_dok_foto_camaba").val("");        
            $("#imgVal_dok_ktp_ayah").val("");        
            $("#imgVal_dok_ktp_ibu").val("");        
            $("#imgVal_dok_kk").val("");        
            $("#imgVal_dok_ktp_wali").val("");        
            $("#imgVal_dok_akta").val("");        
            $("#imgVal_dok_ijasah").val("");        
            $("#imgVal_dok_nilai_ujian_sekolah").val("");        
            $("#imgVal_dok_nilai_rapor").val("");
        }
        $("#dok_ktp_camaba").val("");
        $("#pas_foto_camaba").val("");
        $("#dok_ktp_ayah").val("");
        $("#dok_ktp_ibu").val("");
        $("#dok_kk").val("");
        $("#dok_ktp_wali").val("");
        $("#dok_ktp_akta").val("");
        $("#dok_ktp_ijasah").val("");
        $("#dok_ktp_nilai_ujian_sekolah").val("");
        $("#dok_nilai_rapor").val("");       
    }
    function disabledStep7(){
        $("#dok_ktp_camaba").attr('disabled',true);
        $("#dok_ktp_camaba").addClass('read_only');
        $("#pas_foto_camaba").attr('disabled',true);
        $("#pas_foto_camaba").addClass('read_only');
        $("#dok_ktp_ayah").attr('disabled',true);
        $("#dok_ktp_ayah").addClass('read_only');
        $("#dok_ktp_ibu").attr('disabled',true);
        $("#dok_ktp_ibu").addClass('read_only');
        $("#dok_kk").attr('disabled',true);
        $("#dok_kk").addClass('read_only');
        $("#dok_ktp_wali").attr('disabled',true);
        $("#dok_ktp_wali").addClass('read_only');
        $("#dok_akta").attr('disabled',true);
        $("#dok_akta").addClass('read_only');
        $("#dok_ijasah").attr('disabled',true);
        $("#dok_ijasah").addClass('read_only');
        $("#dok_nilai_ujian_sekolah").attr('disabled',true);
        $("#dok_nilai_ujian_sekolah").addClass('read_only');
        $("#dok_nilai_rapor").attr('disabled',true);
        $("#dok_nilai_rapor").addClass('read_only');
    }
    function enabledStep7(){
        $("#dok_ktp_camaba").attr('disabled',false);
        $("#dok_ktp_camaba").removeClass('read_only');
        $("#pas_foto_camaba").attr('disabled',false);
        $("#pas_foto_camaba").removeClass('read_only');
        $("#dok_ktp_ayah").attr('disabled',false);
        $("#dok_ktp_ayah").removeClass('read_only');
        $("#dok_ktp_ibu").attr('disabled',false);
        $("#dok_ktp_ibu").removeClass('read_only');
        $("#dok_kk").attr('disabled',false);
        $("#dok_kk").removeClass('read_only');
        $("#dok_ktp_wali").attr('disabled',false);
        $("#dok_ktp_wali").removeClass('read_only');
        $("#dok_akta").attr('disabled',false);
        $("#dok_akta").removeClass('read_only');
        $("#dok_ijasah").attr('disabled',false);
        $("#dok_ijasah").removeClass('read_only');
        $("#dok_nilai_ujian_sekolah").attr('disabled',false);
        $("#dok_nilai_ujian_sekolah").removeClass('read_only');
        $("#dok_nilai_rapor").attr('disabled',false);
        $("#dok_nilai_rapor").removeClass('read_only');
    }
    function readDokKTPCamaba() {
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                document.getElementById("imgVal_dok_ktp_camaba").value = e.target.result;                
            });
            FR.readAsDataURL( this.files[0] );
        }
    }
    document.getElementById("dok_ktp_camaba").addEventListener("change", readDokKTPCamaba);
    function readDokFotoCamaba() {
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                document.getElementById("imgVal_dok_foto_camaba").value = e.target.result;                
            });
            FR.readAsDataURL( this.files[0] );
        }
    }
    document.getElementById("pas_foto_camaba").addEventListener("change", readDokFotoCamaba);
    function readDokKTPAyah() {
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                document.getElementById("imgVal_dok_ktp_ayah").value = e.target.result;                
            });
            FR.readAsDataURL( this.files[0] );
        }
    }
    document.getElementById("dok_ktp_ayah").addEventListener("change", readDokKTPAyah);
    function readDokKTPIbu() {
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                document.getElementById("imgVal_dok_ktp_ibu").value = e.target.result;                
            });
            FR.readAsDataURL( this.files[0] );
        }
    }
    document.getElementById("dok_ktp_ibu").addEventListener("change", readDokKTPIbu);
    function readDokKK() {
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                document.getElementById("imgVal_dok_kk").value = e.target.result;                
            });
            FR.readAsDataURL( this.files[0] );
        }
    }
    document.getElementById("dok_kk").addEventListener("change", readDokKK);
    function readDokKTPWali() {
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                document.getElementById("imgVal_dok_ktp_wali").value = e.target.result;                
            });
            FR.readAsDataURL( this.files[0] );
        }
    }
    document.getElementById("dok_ktp_wali").addEventListener("change", readDokKTPWali);
    function readDokAkta() {
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                document.getElementById("imgVal_dok_akta").value = e.target.result;                
            });
            FR.readAsDataURL( this.files[0] );
        }
    }
    document.getElementById("dok_akta").addEventListener("change", readDokAkta);
    function readDokIjasah() {
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                document.getElementById("imgVal_dok_ijasah").value = e.target.result;                
            });
            FR.readAsDataURL( this.files[0] );
        }
    }
    document.getElementById("dok_ijasah").addEventListener("change", readDokIjasah);
    function readDokNilaiUjianSekolah() {
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                document.getElementById("imgVal_dok_nilai_ujian_sekolah").value = e.target.result;                
            });
            FR.readAsDataURL( this.files[0] );
        }
    }
    document.getElementById("dok_nilai_ujian_sekolah").addEventListener("change", readDokNilaiUjianSekolah);    
    function readDokNilaiRapor() {
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                document.getElementById("imgVal_dok_nilai_rapor").value = e.target.result;                
            });
            FR.readAsDataURL( this.files[0] );
        }
    }
    document.getElementById("dok_nilai_rapor").addEventListener("change", readDokNilaiRapor);
    function ValidateStep7() {
        var dok_ktp_camaba = $("#imgVal_dok_ktp_camaba").val();
        var dok_pas_foto_camaba = $("#imgVal_dok_foto_camaba").val();
        var dok_ktp_ayah = $("#imgVal_dok_ktp_ayah").val();
        var dok_ktp_ibu = $("#imgVal_dok_ktp_ibu").val();
        var dok_kk = $("#imgVal_dok_kk").val();
        var dok_ktp_wali = $("#imgVal_dok_ktp_wali").val();
        var dok_akta = $("#imgVal_dok_akta").val();
        var dok_ijasah = $("#imgVal_dok_ijasah").val();
        var dok_nilai_ujian_sekolah = $("#imgVal_dok_nilai_ujian_sekolah").val();
        var dok_nilai_rapor = $("#imgVal_dok_nilai_rapor").val();

        if(dok_ktp_camaba!=""){
        if(calc_image_size(dok_ktp_camaba)<=3000){                        
        if(dok_pas_foto_camaba!=""){
        if(calc_image_size(dok_pas_foto_camaba)<=3000){                        
        if(dok_ktp_ayah!=""){
        if(calc_image_size(dok_ktp_ayah)<=3000){                        
        if(dok_ktp_ibu!=""){
        if(calc_image_size(dok_ktp_ibu)<=3000){                        
        if(dok_kk!=""){
        if(calc_image_size(dok_kk)<=3000){                        
        if(dok_ktp_wali!=""){
        if(calc_image_size(dok_ktp_wali)<=3000){                        
        if(dok_akta!=""){
        if(calc_image_size(dok_akta)<=3000){                        
        if(dok_ijasah!=""){
        if(calc_image_size(dok_ijasah)<=3000){                        
        if(dok_nilai_ujian_sekolah!=""){
        if(calc_image_size(dok_nilai_ujian_sekolah)<=3000){                        
        if(dok_nilai_rapor!=""){
        if(calc_image_size(dok_nilai_rapor)<=3000){                        
            saveOrUpdateStep7(
                dok_ktp_camaba,dok_pas_foto_camaba,dok_ktp_ayah,dok_ktp_ibu,dok_kk,
                dok_ktp_wali,dok_akta,dok_ijasah,dok_nilai_ujian_sekolah,dok_nilai_rapor
            );
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ukuran dokumen nilai rapor melebihi 3 MB!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih dokumen nilai rapor dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ukuran dokumen nilai ujian sekolah melebihi 3 MB!",
            });
        }        
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih dokumen nilai ujian sekolah dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ukuran dokumen ijasah melebihi 3 MB!",
            });
        }                
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih dokumen ijasah dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ukuran dokumen akta kelahiran melebihi 3 MB!",
            });
        } 
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih dokumen akta kelahiran dahulu!",
            });
        } 
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ukuran dokumen ktp wali melebihi 3 MB!",
            });
        }   
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih dokumen ktp wali dahulu!",
            });
        }  
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ukuran dokumen kartu keluarga melebihi 3 MB!",
            });
        }    
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih dokumen kartu keluarga dahulu!",
            });
        }   
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ukuran dokumen ktp ibu melebihi 3 MB!",
            });
        }  
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih dokumen ktp ibu dahulu!",
            });
        }   
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ukuran dokumen ktp ayah melebihi 3 MB!",
            });
        }                           
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih dokumen ktp ayah dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ukuran pas foto camaba melebihi 3 MB!",
            });
        } 
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih pas foto camaba dahulu!",
            });
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Ukuran dokumen ktp camaba melebihi 3 MB!",
            });
        } 
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pilih dokumen ktp camaba dahulu!",
            });
        }
    }
    function saveOrUpdateStep7(
        dok_ktp_camaba,dok_pas_foto_camaba,dok_ktp_ayah,dok_ktp_ibu,dok_kk,
        dok_ktp_wali,dok_akta,dok_ijasah,dok_nilai_ujian_sekolah,dok_nilai_rapor
    ) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['dok_ktp_camaba'] = dok_ktp_camaba;
        datar['dok_pas_foto_camaba'] = dok_pas_foto_camaba;
        datar['dok_ktp_ayah'] = dok_ktp_ayah;
        datar['dok_ktp_ibu'] = dok_ktp_ibu;
        datar['dok_kk'] = dok_kk;
        datar['dok_ktp_wali'] = dok_ktp_wali;
        datar['dok_akta'] = dok_akta;
        datar['dok_ijasah'] = dok_ijasah;
        datar['dok_nilai_ujian_sekolah'] = dok_nilai_ujian_sekolah;
        datar['dok_nilai_rapor'] = dok_nilai_rapor;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#saveOrUpdateUrlStep7").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    window.location.href = window.location.href.replace( /[\?#].*|$/, "?tab=7" );
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

    // TAB STEP 8
    $('#edit_step_8').on('click',function() {
        $('#update_step_8').removeClass("hidden");
        $('#edit_step_8').addClass("hidden");  
        enabledStep8();      
    });
    function batalUpdateStep8(){
        updateValueStep8();
        $('#update_step_8').addClass("hidden");
        $('#edit_step_8').removeClass("hidden");  
        disabledStep8()
    }
    function updateValueStep8(){
        var step_8 = @json($step_8);
        if(step_8!=null){
            $("#sanggup_mondok").val(step_8["sanggup_mondok"]);
            $("#sanggup_tidak_menikah").val(step_8["sanggup_tidak_menikah"]); 
            if(step_8['url_surat_pernyataan']!=null&&step_8['url_surat_pernyataan']!=""){
                $("#link_pernyataan").attr('href',`{{ asset('') }}`+'storage/'+step_8["url_surat_pernyataan"]);            
            }else{
                $("#link_pernyataan").removeAttr("href").css({'cursor': 'not-allowed', 'pointer-events' : 'default'});
            }
            $("#imgVal_dok_pernyataan").val(step_8["url_surat_pernyataan_b64"]);    
            $("#thumb_pernyataan").attr('src',step_8["url_surat_pernyataan_b64"]); 
            disabledStep8();
        }else{
            $("#link_pernyataan").removeAttr("href").css({'cursor': 'not-allowed', 'pointer-events' : 'default'});
            $("#imgVal_dok_pernyataan").val("");  
        }
        $("#dok_pernyataan").val("");
    }
    function disabledStep8(){
        $("#sanggup_mondok").attr('disabled',true);
        $("#sanggup_mondok").addClass('read_only');
        $("#dok_pernyataan").attr('disabled',true);
        $("#dok_pernyataan").addClass('read_only');
    }
    function enabledStep8(){
        $("#sanggup_mondok").attr('disabled',false);
        $("#sanggup_mondok").removeClass('read_only');
        $("#dok_pernyataan").attr('disabled',false);
        $("#dok_pernyataan").removeClass('read_only');
    }
    function readDokPernyataan() {
        if (this.files && this.files[0]) {
            var FR= new FileReader();
            FR.addEventListener("load", function(e) {
                document.getElementById("imgVal_dok_pernyataan").value = e.target.result;                
            });
            FR.readAsDataURL( this.files[0] );
        }
    }
    document.getElementById("dok_pernyataan").addEventListener("change", readDokPernyataan);
    function ValidateStep8() {
        var step_1 = @json($step_1);
        var step_2 = @json($step_2);
        var step_3 = @json($step_3);
        var step_4 = @json($step_4);
        var step_5 = @json($step_5);
        var step_6 = @json($step_6);
        var step_7 = @json($step_7);

        var sanggup_mondok = $("#sanggup_mondok option:selected").val();
        var sanggup_tidak_menikah = $("#sanggup_tidak_menikah option:selected").val();
        var dok_pernyataan = $("#imgVal_dok_pernyataan").val();
        
        if(step_1!=null&&step_1['status_step']==1
        &&step_2!=null&&step_2['status_step']==1
        &&step_3!=null&&step_3['status_step']==1
        &&step_4!=null&&step_4['status_step']==1
        &&step_5!=null&&step_5['status_step']==1
        &&step_6!=null&&step_6['status_step']==1
        &&step_7!=null&&step_7['status_step']==1
        ){
            if(sanggup_mondok!=-1){
                if(dok_pernyataan!=""){
                    if(calc_image_size(dok_pernyataan)<=3000){                        
                        saveOrUpdateStep8(
                            sanggup_mondok,sanggup_tidak_menikah,dok_pernyataan                                    
                        );
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Ukuran file yang diunggah melebihi 3 MB!",
                        });
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "Unggah surat pernyataan dahulu!",
                    });
                } 
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Pilih pilihan sanggup tinggal dipondok dahulu!",
                });
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pastikan semua data pada step 1 sampai step 7 sudah diisi dan divalidasi oleh admin pendaftaran dahulu!",
            });
        }
        
    }
    function saveOrUpdateStep8(
        sanggup_mondok,sanggup_tidak_menikah,dok_pernyataan
    ) {
        $('.containerr').show();
        let datar = {};
        datar['_method']='POST';
        datar['_token']=$('._token').data('token');
        datar['sanggup_mondok'] = sanggup_mondok;
        datar['sanggup_tidak_menikah'] = sanggup_tidak_menikah;
        datar['dok_pernyataan'] = dok_pernyataan;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: $("#saveOrUpdateUrlStep8").val(),
            data:datar,
            success: function(data) {
                if (data.error==false) {
                    $('.containerr').hide();                    
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    // location.reload();
                    window.location.href = window.location.href.replace( /[\?#].*|$/, "?tab=8" );
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
    
    function calc_image_size(image) {
        let y =1;
        if(image.endsWith('==')){
            y = 2
        }
        const x_size = (image.length * (3/4)) - y
        return Math.round(x_size / 1024)
    }

    function downloadSuratPernyataan() {
        var step_1 = @json($step_1);
        var step_2 = @json($step_2);
        var step_3 = @json($step_3);
        var step_4 = @json($step_4);
        var step_5 = @json($step_5);
        var step_6 = @json($step_6);
        var step_7 = @json($step_7);

        var sanggup_mondok = $("#sanggup_mondok option:selected").val();
        var sanggup_tidak_menikah = $("#sanggup_tidak_menikah option:selected").val();
        var dok_pernyataan = $("#imgVal_dok_pernyataan").val();

        if(step_1!=null&&step_1['status_step']==1
        &&step_2!=null&&step_2['status_step']==1
        &&step_3!=null&&step_3['status_step']==1
        &&step_4!=null&&step_4['status_step']==1
        &&step_5!=null&&step_5['status_step']==1
        &&step_6!=null&&step_6['status_step']==1
        &&step_7!=null&&step_7['status_step']==1
        ){
            if(sanggup_mondok!=-1){
                approveDownloadSuratPernyataan(sanggup_mondok,sanggup_tidak_menikah,dok_pernyataan);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Pilih jawaban sanggup tinggal dipondok dahulu!",
                });
            }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Pastikan semua data pada step 1 sampai step 7 sudah diisi dan divalidasi oleh admin pendaftaran dahulu!",
            });
        }
    }

    function approveDownloadSuratPernyataan(sanggup_mondok,sanggup_tidak_menikah,dok_pernyataan) {
        var contents = null;
        if(sanggup_mondok==0){
            contents = 'Dengan ini saya menyatakan <strong>tinggal bersama orang tua kandung/wali dalam area karisidenan kediri dan tidak tinggal ditempat lain, selain bersama orang tua kandung/wali</strong>, serta sanggup untuk tidak menikah selama kuliah!';            
        }else{
            contents = 'Dengan ini saya menyatakan <strong>sanggup tinggal di pondok dan tidak tinggal ditempat lain, selain di asrama pondok</strong>, serta sanggup untuk tidak menikah selama kuliah!';
        }
        Swal.fire({
                title: 'Apakah anda yakin!',
                // text: texts,
                html: contents,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, saya sanggup, download surat pernyataan sekarang!',
                cancelButtonText: 'Batal',
                reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {  
                        saveOrUpdateStep8(
                            sanggup_mondok,sanggup_tidak_menikah,dok_pernyataan                                    
                        ); 
                        window.open($('#urlDownloadSuratPernyataan').val(), '_blank');           
                    } 
            });
    }
</script>
@endsection