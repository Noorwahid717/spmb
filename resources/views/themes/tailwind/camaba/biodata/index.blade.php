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
        document.getElementById('tablinks1').click()

        // hide edit button tabs
        $('#update_step_1').addClass("hidden");
        $('#update_step_2').addClass("hidden");
        $('#update_step_3').addClass("hidden");
        $('#update_step_4').addClass("hidden");
        $('#update_step_5').addClass("hidden");
        $('#update_step_6').addClass("hidden");
        $('#update_step_7').addClass("hidden");
        $('#update_step_8').addClass("hidden");

        // update value tabs
        updateValueStep1();
        updateValueStep2();
        updateValueStep3();

        $('#div_nokps').addClass( "hidden" );
        $('#form_wali').addClass( "hidden" );
        
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
                    location.reload();
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
                    location.reload();
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
    });
    function batalUpdateStep3(){
        $('#update_step_3').addClass("hidden");
        $('#edit_step_3').removeClass("hidden");  
        disabledStep3()
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
    function ValidateStep3() {
        var kondisi_ayah = $('#kondisi_ayah').val();            
        var nik_ayah = $('#nik_ayah').val();            
        var nama_ayah = $('#nama_ayah').val();            
        var tgllhr_ayah = $('#tgllhr_ayah').val();
        var id_jenjang_pendidikan_ayah = $('#pendidikan_ayah option:selected').val();
        var pendidikan_ayah = $('#pendidikan_ayah option:selected').text();
        var id_pekerjaan_ayah = $('#pekerjaan_ayah option:selected').val();
        var pekerjaan_ayah = $('#pekerjaan_ayah option:selected').text();
        var id_penghasilan_ayah = $('#penghasilan_ayah option:selected').val();            
        var penghasilan_ayah = $('#penghasilan_ayah option:selected').text();            
        var kondisi_ibu = $('#kondisi_ibu').val();            
        var nik_ibu = $('#nik_ibu').val();            
        var nama_ibu = $('#nama_ibu').val();            
        var tgllhr_ibu = $('#tgllhr_ibu').val();            
        var id_jenjang_pendidikan_ibu = $('#pendidikan_ibu option:selected').val();
        var pendidikan_ibu = $('#pendidikan_ibu option:selected').text();
        var id_pekerjaan_ibu = $('#pekerjaan_ibu option:selected').val();
        var pekerjaan_ibu = $('#pekerjaan_ibu option:selected').text();
        var id_penghasilan_ibu = $('#penghasilan_ibu option:selected').val();
        var penghasilan_ibu = $('#penghasilan_ibu option:selected').text();

        if(kondisi_ayah!=""){
        if(nik_ayah!=""){
        if(nama_ayah!=""){
        if(tgllhr_ayah!=""){
        if(id_jenjang_pendidikan_ayah!=-1){
        if(id_pekerjaan_ayah!=-1){
        if(id_penghasilan_ayah!=-1){
        if(kondisi_ibu!=""){
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
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi kondisi ibu dahulu!",
            });
        }
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
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Isi kondisi ayah dahulu!",
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
        console.log(pendidikan_ayah);
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
                    location.reload();
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
    
    function downloadSuratPernyataan() {
        // window.open($('#urlDownloadSuratPernyataan').val(), '_blank');           
    }
</script>
@endsection