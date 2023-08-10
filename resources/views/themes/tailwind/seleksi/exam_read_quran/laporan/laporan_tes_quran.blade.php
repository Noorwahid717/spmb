<html>

<head>
    <title>HASIL SELEKSI BACA AL-QURAN</title>
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
        <strong style="font-size: 14pt">HASIL SELEKSI BACA AL-QURAN</strong>
        <br>
        <strong style="font-size: 12pt">{{strtoupper($gelombang)}} - {{strtoupper($sesi)}}</strong>
        <br>
        <strong style="font-size: 12pt">TANGGAL {{strtoupper(tgl_indo($tanggal_ujian))}} PUKUL {{$waktu_ujian}}</strong>
        {{--
        <hr style="width:30%;
        margin:0 auto;border-bottom:solid 1.5px black"> --}}
        <span style="margin-top:-15px!important;font-size:14px;">
            {{--
            Nomor:&nbsp;{{$pernyataan->nomor_surat}}/UNIWA/SP/{{numberToRomanRepresentation(date('m'))}}/{{date('Y')}}
            --}}
        </span>
    </div>


    {{-- CONTENT --}}
    <table id="rtable" style="margin-top: 15px;">
        <tr>
            <th rowspan="2" style="width: 15px;">No</th>
            <th rowspan="2" style="width: 180px;">Nama</th>
            <th rowspan="2" style="width: 180px;">Program Studi</th>
            {{-- <th rowspan="2">Total Soal</th> --}}
            <th colspan="3">Nilai</th>
            {{-- <th rowspan="2">Nilai</th> --}}
            <th rowspan="2" style="width: 50px;">Status Ujian</th>
        </tr>
        <tr>
            <th>Kelancaran</th>
            <th>Tajwid</th>
            <th>Makhraj</th>
        </tr>
        <?php $i=1; ?>
        @foreach ($ujian as $data)
        <tr>
            <td class="center">{{$i}}</td>
            <td>{{$data['nama']}}</td>
            <td>{{$data['prodi']}}</td>
            {{-- <td class="center">{{$data['total']}}</td> --}}
            <td class="center">{{$data['nilai_lancar']}}</td>
            <td class="center">{{$data['nilai_tajwid']}}</td>
            <td class="center">{{$data['nilai_makhraj']}}</td>
            {{-- <td class="center">{{$data['nilai']}}</td> --}}
            <td class="center">{{$data['status_lolos']==1?'Lulus':($data['status_lolos']==-1?'Tidak Lulus':'-')}}</td>
        </tr>
        <?php $i=$i+1; ?>
        @endforeach
    </table>



    {{-- TANDA TANGAN --}}
    <div><br>
        <div style="width: 240px;float: right;display:block;font-size:13px;">
            <span style="text-align: left">Kediri,
                <?php echo tgl_indo(date('Y-m-d'));?>
            </span><br>
            <span style="text-align: left">Ketua Seksi Seleksi,</span>
            <br><br><br><br><br>
            <span style="text-align: right">{{$ttd_nama}}</span>
        </div>
    </div>

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