<?php

namespace App\Exports;

use App\Models\RegistrasiAwalUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CamabaResource;

class CamabaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $ta_reg;

    function __construct($ta_reg) {
            $this->ta_reg = $ta_reg;
    }

    public function collection()
    {
        $camaba = RegistrasiAwalUser::where('tahun_akademik_registrasi',$this->ta_reg)
        ->where('is_lunas','1')
        ->with([
            'getCamabaDataPokok','getCamabaDataAlamat','getCamabaDataOrtu','getCamabaDataWaliPs',
            'getCamabaDataRiwayatPendidikan','getCamabaDataPernyataan','getExamAcademicMember',
            'getExamInterviewMember','getExamReadQuranMember','getExamReadShalawatMember'
        ])
        ->get()
        ->each(function($row){
            $row->makeHidden([
                'url_bukti_bayar','created_at','updated_at','getUser','is_lunas','id_user_admin','keterangan',
                'id','id_user'                
            ]);
            if($row->getCamabaDataProgramStudi != null){
                $row->makeHidden([
                    'getCamabaDataProgramStudi'                    
                ]);
            }
            if($row->getCamabaDataDokumen != null){
                $row->makeHidden([
                    'getCamabaDataDokumen'                    
                ]);
            }
            if($row->getCamabaDataPokok != null){
                $row->getCamabaDataPokok->makeHidden([
                    'id','id_user','id_agama','id_negara','status_step','note','last_note','created_at','updated_at'
                ]);
            }
            if($row->getCamabaDataAlamat != null){
                $row->getCamabaDataAlamat->makeHidden([
                    'id','id_user','id_wilayah','status_step','note','last_note','created_at','updated_at'
                ]);
            }
            if($row->getCamabaDataOrtu != null){
                $row->getCamabaDataOrtu->makeHidden([
                    'id','id_user','id_jenjang_pendidikan_ayah','id_pekerjaan_ayah','id_penghasilan_ayah','id_jenjang_pendidikan_ibu','id_pekerjaan_ibu','id_penghasilan_ibu','status_step','note','last_note','created_at','updated_at'
                ]);
            }
            if($row->getCamabaDataWaliPs != null){
                $row->getCamabaDataWaliPs->makeHidden([
                    'id','id_user','opsi_wali','id_jenjang_pendidikan_wali','id_pekerjaan_wali','id_penghasilan_wali','status_step','note','last_note','created_at','updated_at'
                ]);
            }
            if($row->getCamabaDataRiwayatPendidikan != null){
                $row->getCamabaDataRiwayatPendidikan->makeHidden([
                    'id','id_user','status_step','note','last_note','created_at','updated_at'
                ]);
            }
            if($row->getCamabaDataPernyataan != null){
                $row->getCamabaDataPernyataan->makeHidden([
                    'id','id_user','url_surat_pernyataan','url_surat_pernyataan_b64','note','last_note','created_at','updated_at'
                ]);
            }
            if($row->getExamAcademicMember != null){
                $row->getExamAcademicMember->makeHidden([
                    'id','id_exam_academic','id_camaba','created_at','updated_at','nama','prodi','lunas','adm','getUsers','getPilihanProdi','getInfoLunas','getInfoAdm'
                ]);
            }
            if($row->getExamInterviewMember != null){
                $row->getExamInterviewMember->makeHidden([
                    'id','id_exam_interview','id_camaba','created_at','updated_at','nama','prodi','lunas','adm','getUsers','getPilihanProdi','getInfoLunas','getInfoAdm'
                ]);
            }
            if($row->getExamReadQuranMember != null){
                $row->getExamReadQuranMember->makeHidden([
                    'id','id_exam_read_quran','id_camaba','id_nilai_kelancaran','id_nilai_tajwid','id_nilai_makhraj','getNilaiKelancaran','getNilaiTajwid','getNilaiMakhraj','created_at','updated_at','nama','prodi','lunas','adm','getUsers','getPilihanProdi','getInfoLunas','getInfoAdm'
                ]);
            }
            if($row->getExamReadShalawatMember != null){
                $row->getExamReadShalawatMember->makeHidden([
                    'id','id_exam_read_shalawat','id_camaba','id_nilai_kelancaran','id_nilai_tajwid','id_nilai_makhraj','getNilaiKelancaran','getNilaiTajwid','getNilaiMakhraj','created_at','updated_at','nama','prodi','lunas','adm','getUsers','getPilihanProdi','getInfoLunas','getInfoAdm'
                ]);
            }
        });

        return CamabaResource::collection($camaba);
    }

    public function headings(): array
    {
        return [            
            'tahun_akademik_registrasi',
            'nominal_pembayaran_registrasi',
            'tanggal_bayar_registrasi',
            'status_pembayaran_registrasi',
            'status_administrasi',
            'status_surat_pernyataan',
            'neo_id_mahasiswa',
            'nkk',
            'nik',
            'nama',
            'gender',
            'tempat_lahir',
            'tanggal_lahir',
            'agama',
            'kewarganegaraan',
            'jalan',
            'dusun',
            'rt',
            'rw',
            'kelurahan',
            'kodepos',
            'kecamatan',
            'kota_kabupaten',
            'provinsi',
            'email',
            'no_hp_camaba',
            'no_hp_ortu',
            'kondisi_ayah',
            'nik_ayah',
            'nama_ayah',
            'tanggal_lahir_ayah',
            'pendidikan_ayah',
            'pekerjaan_ayah',
            'penghasilan_ayah',
            'kondisi_ibu',
            'nik_ibu',
            'nama_ibu',
            'tanggal_lahir_ibu',
            'pendidikan_ibu',
            'pekerjaan_ibu',
            'penghasilan_ibu',
            'nik_wali',
            'nama_wali',
            'tanggal_lahir_wali',
            'pendidikan_wali',
            'pekerjaan_wali',
            'penghasilan_wali',
            'is_kps',
            'no_kps',
            'is_alumni',
            'pendidikan_asal',
            'jenis_pendidikan_asal',
            'nama_pendidikan_asal',
            'nisn',
            'alamat_pendidikan_asal',
            'nomor_surat',
            'sanggup_mondok',
            'sanggup_tidak_menikah',
            'akademik_tahun_akademik_seleksi',
            'akademik_catatan',
            'akademik_status_lolos',
            'interview_tahun_akademik_seleksi',
            'interview_catatan',
            'interview_status_lolos',
            'quran_tahun_akademik_seleksi',
            'quran_catatan_penguji',
            'quran_status_lolos',
            'quran_nilai_lancar',
            'quran_nilai_tajwid',
            'quran_nilai_makhraj',
            'shalawat_tahun_akademik_seleksi',
            'shalawat_catatan_penguji',
            'shalawat_status_lolos',
            'shalawat_nilai_lancar',
            'shalawat_nilai_tajwid',
            'shalawat_nilai_makhraj'
        ];
    }
}
