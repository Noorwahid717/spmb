<html>

<head>
    <title>SURAT PERNYATAAN CALON MAHASISWA BARU</title>
    <style>
        @page {
            margin-bottom: 0px;
        }

        /* * {
            box-sizing: border-box;
        } */

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 50%;
            padding: 10px;
            height: 300px;
            /* Should be removed. Only for demonstration */
        }

        .column25 {
            float: left;
            width: 25%;
            padding: 5px;
            height: 7px;
            /* Should be removed. Only for demonstration */
        }

        .column5 {
            float: left;
            width: 5%;
            padding: 5px;
            height: 7px;
            /* Should be removed. Only for demonstration */
        }

        .column20 {
            float: left;
            width: 20%;
            padding: 5px;
            height: 7px;
            /* Should be removed. Only for demonstration */
        }

        .column15 {
            float: left;
            width: 15%;
            padding: 5px;
            height: 7px;
            /* Should be removed. Only for demonstration */
        }

        .column35 {
            float: left;
            width: 35%;
            padding: 5px;
            height: 7px;
            /* Should be removed. Only for demonstration */
        }

        .column40 {
            float: left;
            width: 40%;
            padding: 5px;
            height: 7px;
            /* Should be removed. Only for demonstration */
        }

        .column75 {
            float: left;
            width: 75%;
            padding: 5px;
            height: 7px;
            /* Should be removed. Only for demonstration */
        }

        .column10 {
            float: left;
            width: 10%;
            padding: 5px;
            height: 7px;
            /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        #rtable {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 10px;
        }

        .bold {
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }

        #rtable td,
        #rtable th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #rtable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #rtable tr:hover {
            background-color: #ddd;
        }

        #rtable th {
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: center;
            background-color: #ffffff;
            color: rgb(0, 0, 0);
        }

        hr {
            background-color: white;
            margin: 0 0 45px 0;
            /* max-width: 600px; */
            border-width: 0;
        }

        hr.s1 {
            height: 2px;
            border-top: 1px solid black;
            border-bottom: 2px solid black;
        }

        .column1 {
            padding-top: 5px;
            float: left;
            width: 15%;
            height: 100px;
            /* Should be removed. Only for demonstration */
        }

        .column2 {
            float: left;
            width: 82%;
            padding: 10px;
            height: 100px;
            padding-right: -140px;
            /* Should be removed. Only for demonstration */
        }

        .page_break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    {{-- KOP SURAT UNIWA --}}
    <div class="row">
        <div class="column1">
            <img src="{{ public_path('img/logo-uniwa.png') }}" alt="spmb uniwa" height="100px" style="margin-top:-10px">
        </div>
        <div class="column2" style="text-align: center">
            <h4 style="font-size: 11.5pt;margin-top:-25px!important">
                YAYASAN PERJUANGAN WAHIDIYAH DAN PONDOK PESANTREN KEDUNGLO
            </h4>
            <h3 style="margin-top: -15px!important">
                PANITIA PENERIMAAN MAHASISWA BARU
            </h3>
            <h3 style="margin-top: -15px!important">
                UNIVERSITAS WAHIDIYAH
            </h3>
            <h4 style="margin-top: -15px!important">
                SK Mendikbud RI Nomor 608/E/O/2014 Tanggal 17 Oktober 2014
            </h4>
            <p style="margin-top: -15px!important;font-size:12px;">JL. KH. Wachid Hasyim Ponpes Kedunglo, Mojoroto Telp.
                (0354) 771018
                Fax. (0354) 772179 Kediri 64114</p>
            <p style="margin-top: -10px!important;font-size:12px;">Email: rektorat@uniwa.ac.id</p>
        </div>
    </div>
    <hr class="s1">

    {{-- JUDUL LAPORAN --}}
    <div style="text-align: center;line-height: 1.4;margin-top:-30px;margin-bottom:-7px;">
        <strong style="font-size: 14pt">SURAT PERNYATAAN</strong>
        <hr style="width:30%;
        margin:0 auto;border-bottom:solid 1.5px black">
        <span style="margin-top:-15px!important;font-size:14px;">
            Nomor:&nbsp;{{$pernyataan->nomor_surat}}/UNIWA/SP/{{numberToRomanRepresentation(date('m'))}}/{{date('Y')}}
        </span>
    </div>

    <p style="font-size:14px;line-height: 1.5rem;text-align: justify;text-indent:5%">
        Dengan taufik hidayah Allah SWT, syafa’at Rosululloh SAW, barokah
        nadzroh Ghoutsu Hadzaz Zaman RA, serta do’a restu Hadrotul Mukarrom Kanjeng Kyai Abdul Majid Ali Fikri RA,
        Pengasuh Perjuangan Wahidiyah dan Pondok Pesantren Kedunglo Al-Munadhdhoroh.
        Yang bertanda tangan di bawah ini :
    </p>

    {{-- BIODATA --}}
    <div class="row" style="margin-left:-5px;font-size:14px;margin-top:-10px">
        <div class="column25">Nama Wali Mahasiswa</div>
        <div class="column75">: {{$wali->nama_wali}}
        </div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;">
        <div class="column25">Alamat</div>
        <div class="column75">: {{
            // $alamat->jalan.
            // ", Dsn.".$alamat->dusun.
            // ", RT.".$alamat->rt.
            // ", RW.".$alamat->rw.
            "Kel. ".ucwords(strtolower($alamat->kelurahan)).
            ", ".$alamat->kecamatan.
            ", ".$alamat->kota_kabupaten.
            ", ".$alamat->provinsi
            }}
        </div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;">
        <div class="column25">No.HP/No.WA</div>
        <div class="column75">: {{$alamat->no_hp_ortu}}
        </div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;margin-top:10px">
        <div class="column25">Selaku Orang Tua Wali dari,</div>
        <div class="column35">
        </div>
        <div class="column10"></div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;">
        <div class="column25">Nama Mahasiswa</div>
        <div class="column75">: {{$pokok->nama}}
        </div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;">
        <div class="column25">Fakultas / Prodi</div>
        <div class="column75">:
            {{$fakultas->nama_fakultas}} / {{$prodi->getProdiFakultas1->nama_program_studi}}
        </div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;">
        <div class="column25">Semester</div>
        <div class="column75">: I
        </div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;">
        <div class="column25">Jenis Tinggal</div>
        <div class="column75">: {{$mondok==false?"Tinggal bersama orang tua kandung/wali (area karisidenan
            kediri)":"Mondok"}}
        </div>
        <div class="column10"></div>
    </div>

    <p style="font-size:14px;line-height: 1.5rem;text-align: justify;text-indent:5%;margin-top:5px">
        Dengan ini <strong>SIAP</strong> dan <strong>SANGGUP</strong> bertanggung jawab di Universitas Wahidiyah dengan
        ketentuan sebagai berikut :
    </p>

    <?php $i=1; $j = 0;
    $len = count($poin_pernyataan);?>
    <ol
        style="list-style-position: outside;list-style-type:decimal;line-height: 1.5rem;margin-top:-15px;margin-left:-20px">
        @foreach ($poin_pernyataan as $item)
        <li style="font-size:14px;">
            @if($mondok){{$item->pernyataan_santri}}@if($j == $len -
            1).@else;@endif @else{{$item->pernyataan_karisidenan}}@if($j == $len -
            1).@else;@endif @endif
        </li>
        <?php $i++; $j++;?>
        @endforeach
    </ol>

    <p style="font-size:14px;line-height: 1.5rem;text-align: justify;text-indent:5%;margin-top:-10px">
        Apabila di kemudian hari ada perubahan tata tertib dan biaya, siap mengikuti dengan
        ketentuan yang ada berdasarkan pemberitahuan secara resmi dari pihak universitas maupun
        pondok.
    </p>
    <p style="font-size:14px;line-height: 1.5rem;text-align: justify;text-indent:5%;margin-top:-15px">
        Demikian surat pernyataan ini kami buat tanpa paksaan dari pihak manapun. Atas kesempatan yang diberikan kami
        sampaikan terima kasih teriring do'a: “Jazaakumullohu
        Khoirooti wa Sa’aadaatid Dunya wal Akhiroh”. Amin.
    </p>

    {{-- TANDA TANGAN --}}
    <div style="margin-top:-40px"><br><br>
        <div style="width: 240px;margin-left:40px;float:left;display:block;font-size:14px;">
            <span style="text-align: left">Kedunglo,
                <?php 
                if($sign_date!=null){
                    $sign_date = explode(" ", $sign_date);
                    echo tgl_indo($sign_date[0]);
                }else{
                    echo tgl_indo(date('Y-m-d'));
                }
                ?>
            </span><br>
            <span style="text-align: left">Wali Mahasiswa,</span>
            <br><br>
            <br>
            <div style="border: 0px solid black;width:65px;padding-left:10px;padding-top:10px;padding-bottom:10px">
                &nbsp;<br>&nbsp;

            </div>
            <br>
            <span style="text-align: right">{{ucwords(strtolower($wali->nama_wali))}}</span>
        </div>
        <div style="width: 240px;float: right;display:block;font-size:14px;margin-right:-30px;">
            <span style="text-align: left">
            </span><br>
            <span style="text-align: left">Yang bersangkutan,</span>
            <br><br>
            <br>
            <div style="border: 1px solid black;width:65px;padding-left:10px;padding-top:10px;padding-bottom:10px">
                Materai<br>
                Rp 10.000
            </div>
            <br>
            <span style="text-align: right">{{ucwords(strtolower($pokok->nama))}}</span>
        </div>
    </div>
    <div style="margin-top: 160px;text-align:center;">
        <div style="width:100%;display:block;font-size:14px;">
            <span style="text-align: left">Menyetujui dan Mengesahkan
            </span><br>
            <span style="text-align: left">Pengasuh Perjuangan Wahidiyah dan Pon.Pes. Kedunglo,</span>
            <br><br>
            <br><br>
            <br><br>
            <span style="text-align: right">Kanjeng Kyai Abdul Majid Ali Fikri RA.</span>
        </div>
    </div>

    {{-- FOOTER --}}
    <div style="font-size: 14px;padding-top:5px;">
        <span>Keterangan:</span><br>
        <ol style="margin-top:5px">
            <li>Jika mahasiswa tidak mondok (tinggal dengan orang tua di Kediri, Nganjuk
                Tulungagung, Jombang).</li>
            <li>Pembayaran pondok untuk biaya syahriyah dan katering.</li>
            <li>Biaya kuliah dan pondok sebagaimana terlampir.</li>
        </ol>
    </div>


    @if($mondok==false)
    <div class="page_break"></div>
    {{-- KOP SURAT UNIWA --}}
    <div class="row">
        <div class="column1">
            <img src="{{ public_path('img/logo-uniwa.png') }}" alt="spmb uniwa" height="100px" style="margin-top:-10px">
        </div>
        <div class="column2" style="text-align: center">
            <h4 style="font-size: 11.5pt;margin-top:-25px!important">
                YAYASAN PERJUANGAN WAHIDIYAH DAN PONDOK PESANTREN KEDUNGLO
            </h4>
            <h3 style="margin-top: -15px!important">
                PANITIA PENERIMAAN MAHASISWA BARU
            </h3>
            <h3 style="margin-top: -15px!important">
                UNIVERSITAS WAHIDIYAH
            </h3>
            <h4 style="margin-top: -15px!important">
                SK Mendikbud RI Nomor 608/E/O/2014 Tanggal 17 Oktober 2014
            </h4>
            <p style="margin-top: -15px!important;font-size:12px;">JL. KH. Wachid Hasyim Ponpes Kedunglo, Mojoroto Telp.
                (0354) 771018
                Fax. (0354) 772179 Kediri 64114</p>
            <p style="margin-top: -10px!important;font-size:12px;">Email: rektorat@uniwa.ac.id</p>
        </div>
    </div>
    <hr class="s1">

    {{-- JUDUL LAPORAN --}}
    <div style="text-align: center;line-height: 1.4;margin-top:-30px;margin-bottom:-7px;">
        <strong style="font-size: 14pt">SURAT PERNYATAAN</strong>
        <hr style="width:30%;
        margin:0 auto;border-bottom:solid 1.5px black">
        <span style="margin-top:-15px!important;font-size:14px;">
            Nomor:&nbsp;{{$pernyataan->nomor_surat}}/UNIWA/SP-T/{{numberToRomanRepresentation(date('m'))}}/{{date('Y')}}
        </span>
    </div>

    <p style="font-size:14px;line-height: 1.5rem;text-align: justify;text-indent:5%">
        Dengan taufik hidayah Allah SWT, syafa’at Rosululloh SAW, barokah
        nadzroh Ghoutsu Hadzaz Zaman RA, serta do’a restu Hadrotul Mukarrom Kanjeng Kyai Abdul Majid Ali Fikri RA,
        Pengasuh Perjuangan Wahidiyah dan Pondok Pesantren Kedunglo Al-Munadhdhoroh.
        Yang bertanda tangan di bawah ini :
    </p>

    {{-- BIODATA --}}
    <div class="row" style="margin-left:-5px;font-size:14px;margin-top:-10px">
        <div class="column25">Nama Wali Mahasiswa</div>
        <div class="column75">: {{$wali->nama_wali}}
        </div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;">
        <div class="column25">Alamat</div>
        <div class="column75">: {{
            // $alamat->jalan.
            // ", Dsn.".$alamat->dusun.
            // ", RT.".$alamat->rt.
            // ", RW.".$alamat->rw.
            "Kel. ".ucwords(strtolower($alamat->kelurahan)).
            ", ".$alamat->kecamatan.
            ", ".$alamat->kota_kabupaten.
            ", ".$alamat->provinsi
            }}
        </div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;">
        <div class="column25">No.HP/No.WA</div>
        <div class="column75">: {{$alamat->no_hp_ortu}}
        </div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;margin-top:10px">
        <div class="column25">Selaku Orang Tua Wali dari,</div>
        <div class="column35">
        </div>
        <div class="column10"></div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;">
        <div class="column25">Nama Mahasiswa</div>
        <div class="column75">: {{$pokok->nama}}
        </div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;">
        <div class="column25">Fakultas / Prodi</div>
        <div class="column75">:
            {{$fakultas->nama_fakultas}} / {{$prodi->getProdiFakultas1->nama_program_studi}}
        </div>
    </div>
    <div class="row" style="margin-left:-5px;font-size:14px;">
        <div class="column25">Semester</div>
        <div class="column75">: I
        </div>
    </div>

    <p style="font-weight:bold;font-size:14px;line-height: 1.5rem;text-align: justify;text-indent:5%;margin-top:10px">
        Menyatakan dengan sesungguhnya bahwa anak kami yang tersebut diatas benar-benar tinggal bersama dengan kami dan
        tidak tinggal (dikamar kos/rumah saudara/rumah teman/rumah kerabat diarea sekitar pondok pesantren Kedunglo
        Al-Munadhdhoroh).
    </p>
    <p style="font-size:14px;line-height: 1.5rem;text-align: justify;text-indent:5%;margin-top:-15px">
        Demikian surat pernyataan ini kami buat tanpa paksaan dari pihak manapun. Atas kesempatan yang diberikan kami
        sampaikan terima kasih teriring do'a: “Jazaakumullohu
        Khoirooti wa Sa’aadaatid Dunya wal Akhiroh”. Amin.
    </p>

    {{-- TANDA TANGAN --}}
    <div style="margin-top:-40px"><br><br>
        <div style="width: 240px;margin-left:40px;float:left;display:block;font-size:14px;">
            <span style="text-align: left">Kedunglo,
                <?php 
                if($sign_date!=null){
                    // $sign_date = explode(" ", $sign_date);
                    echo tgl_indo($sign_date[0]);
                }else{
                    echo tgl_indo(date('Y-m-d'));
                }
                ?>
            </span><br>
            <span style="text-align: left">Wali Mahasiswa,</span>
            <br><br><br>
            <div style="border: 1px solid black;width:65px;padding-left:10px;padding-top:10px;padding-bottom:10px">
                Materai<br>
                Rp 10.000
            </div>
            <br>
            <span style="text-align: right">{{ucwords(strtolower($wali->nama_wali))}}</span>
        </div>
    </div>
    @endif
</body>

</html>
<?php
    function numberToRomanRepresentation($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
        
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
?>