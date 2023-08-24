<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CamabaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'tahun_akademik_registrasi'=>$this->tahun_akademik_registrasi,
            'nominal_pembayaran_registrasi'=>$this->nominal,
            'tanggal_bayar_registrasi'=>$this->tanggal_bayar,
            'status_pembayaran_registrasi' => $this->lunas,
            'status_administrasi' => $this->adm,
            'status_surat_pernyataan' =>$this->getCamabaDataPernyataan==null?null:$this->getCamabaDataPernyataan->status_step,
            'neo_id_mahasiswa' => $this->neo_id_mahasiswa,

            'nkk'=>$this->getCamabaDataPokok==null?null:$this->getCamabaDataPokok->nkk,
            'nik'=>$this->getCamabaDataPokok==null?null:$this->getCamabaDataPokok->nik,
            'nama'=>$this->getCamabaDataPokok==null?null:$this->getCamabaDataPokok->nama,
            'gender'=>$this->getCamabaDataPokok==null?null:$this->getCamabaDataPokok->gender,
            'tempat_lahir'=>$this->getCamabaDataPokok==null?null:$this->getCamabaDataPokok->tempat_lahir,
            'tanggal_lahir' => $this->getCamabaDataPokok==null?null:$this->getCamabaDataPokok->tanggal_lahir,
            'agama' => $this->getCamabaDataPokok==null?null:$this->getCamabaDataPokok->agama,
            'kewarganegaraan' => $this->getCamabaDataPokok==null?null:$this->getCamabaDataPokok->negara,

            'jalan' =>$this->getCamabaDataAlamat==null?null:$this->getCamabaDataAlamat->jalan,
            'dusun' =>$this->getCamabaDataAlamat==null?null:$this->getCamabaDataAlamat->dusun,
            'rt' =>$this->getCamabaDataAlamat==null?null:$this->getCamabaDataAlamat->rt,
            'rw' =>$this->getCamabaDataAlamat==null?null:$this->getCamabaDataAlamat->rw,
            'kelurahan' =>$this->getCamabaDataAlamat==null?null:$this->getCamabaDataAlamat->kelurahan,
            'kodepos' =>$this->getCamabaDataAlamat==null?null:$this->getCamabaDataAlamat->kodepos,
            'kecamatan' =>$this->getCamabaDataAlamat==null?null:$this->getCamabaDataAlamat->kecamatan,
            'kota_kabupaten' =>$this->getCamabaDataAlamat==null?null:$this->getCamabaDataAlamat->kota_kabupaten,
            'provinsi' =>$this->getCamabaDataAlamat==null?null:$this->getCamabaDataAlamat->provinsi,
            'email' =>$this->getCamabaDataAlamat==null?null:$this->getCamabaDataAlamat->email,
            'no_hp_camaba' =>$this->getCamabaDataAlamat==null?null:$this->getCamabaDataAlamat->no_hp_camaba,
            'no_hp_ortu' =>$this->getCamabaDataAlamat==null?null:$this->getCamabaDataAlamat->no_ho_ortu,

            'kondisi_ayah' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->kondisi_ayah,
            'nik_ayah' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->nik_ayah,
            'nama_ayah' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->nama_ayah,
            'tanggal_lahir_ayah' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->tanggal_lahir_ayah,
            'pendidikan_ayah' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->pendidikan_ayah,
            'pekerjaan_ayah' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->pekerjaan_ayah,
            'penghasilan_ayah' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->penghasilan_ayah,
            'kondisi_ibu' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->kondisi_ibu,
            'nik_ibu' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->nik_ibu,
            'nama_ibu' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->nama_ibu,
            'tanggal_lahir_ibu' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->tanggal_lahir_ibu,
            'pendidikan_ibu' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->pendidikan_ibu,
            'pekerjaan_ibu' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->pekerjaan_ibu,
            'penghasilan_ibu' =>$this->getCamabaDataOrtu==null?null:$this->getCamabaDataOrtu->penghasilan_ibu,

            'nik_wali' =>$this->getCamabaDataWaliPs==null?null:$this->getCamabaDataWaliPs->nik_wali,
            'nama_wali' =>$this->getCamabaDataWaliPs==null?null:$this->getCamabaDataWaliPs->nama_wali,
            'tanggal_lahir_wali' =>$this->getCamabaDataWaliPs==null?null:$this->getCamabaDataWaliPs->tanggal_lahir_wali,
            'pendidikan_wali' =>$this->getCamabaDataWaliPs==null?null:$this->getCamabaDataWaliPs->pendidikan_wali,
            'pekerjaan_wali' =>$this->getCamabaDataWaliPs==null?null:$this->getCamabaDataWaliPs->pekerjaan_wali,
            'penghasilan_wali' =>$this->getCamabaDataWaliPs==null?null:$this->getCamabaDataWaliPs->penghasilan_wali,
            'is_kps' =>$this->getCamabaDataWaliPs==null?null:$this->getCamabaDataWaliPs->is_kps,
            'no_kps' =>$this->getCamabaDataWaliPs==null?null:$this->getCamabaDataWaliPs->no_kps,

            'is_alumni' => $this->getCamabaDataRiwayatPendidikan==null?null:$this->getCamabaDataRiwayatPendidikan->is_alumni,
            'pendidikan_asal' => $this->getCamabaDataRiwayatPendidikan==null?null:$this->getCamabaDataRiwayatPendidikan->pendidikan_asal,
            'jenis_pendidikan_asal' => $this->getCamabaDataRiwayatPendidikan==null?null:$this->getCamabaDataRiwayatPendidikan->jenis_pendidikan_asal,
            'nama_pendidikan_asal' => $this->getCamabaDataRiwayatPendidikan==null?null:$this->getCamabaDataRiwayatPendidikan->nama_pendidikan_asal,
            'nisn' => $this->getCamabaDataRiwayatPendidikan==null?null:$this->getCamabaDataRiwayatPendidikan->nisn,
            'alamat_pendidikan_asal' => $this->getCamabaDataRiwayatPendidikan==null?null:$this->getCamabaDataRiwayatPendidikan->alamat_pendidikan_asal,

            'nomor_surat' =>$this->getCamabaDataPernyataan==null?null:$this->getCamabaDataPernyataan->nomor_surat,
            'sanggup_mondok' =>$this->getCamabaDataPernyataan==null?null:$this->getCamabaDataPernyataan->sanggup_mondok,
            'sanggup_tidak_menikah' =>$this->getCamabaDataPernyataan==null?null:$this->getCamabaDataPernyataan->sanggup_tidak_menikah,

            'akademik_tahun_akademik_seleksi' => $this->getExamAcademicMember==null?null:$this->getExamAcademicMember->tahun_akademik_seleksi,
            'akademik_catatan' => $this->getExamAcademicMember==null?null:$this->getExamAcademicMember->catatan,
            'akademik_status_lolos' => $this->getExamAcademicMember==null?null:$this->getExamAcademicMember->status_lolos,

            'interview_tahun_akademik_seleksi' => $this->getExamInterviewMember==null?null:$this->getExamInterviewMember->tahun_akademik_seleksi,
            'interview_catatan' => $this->getExamInterviewMember==null?null:$this->getExamInterviewMember->catatan,
            'interview_status_lolos' => $this->getExamInterviewMember==null?null:$this->getExamInterviewMember->status_lolos,

            'quran_tahun_akademik_seleksi'=>$this->getExamReadQuranMember==null?null:$this->getExamReadQuranMember->tahun_akademik_seleksi,
            'quran_catatan_penguji'=>$this->getExamReadQuranMember==null?null:$this->getExamReadQuranMember->catatan_penguji,
            'quran_status_lolos'=>$this->getExamReadQuranMember==null?null:$this->getExamReadQuranMember->status_lolos,
            'quran_nilai_lancar'=>$this->getExamReadQuranMember==null?null:$this->getExamReadQuranMember->nilai_lancar,
            'quran_nilai_tajwid'=>$this->getExamReadQuranMember==null?null:$this->getExamReadQuranMember->nilai_tajwid,
            'quran_nilai_makhraj'=>$this->getExamReadQuranMember==null?null:$this->getExamReadQuranMember->nilai_makhraj,

            'shalawat_tahun_akademik_seleksi'=>$this->getExamReadShalawatMember==null?null:$this->getExamReadShalawatMember->tahun_akademik_seleksi,
            'shalawat_catatan_penguji'=>$this->getExamReadShalawatMember==null?null:$this->getExamReadShalawatMember->catatan_penguji,
            'shalawat_status_lolos'=>$this->getExamReadShalawatMember==null?null:$this->getExamReadShalawatMember->status_lolos,
            'shalawat_nilai_lancar'=>$this->getExamReadShalawatMember==null?null:$this->getExamReadShalawatMember->nilai_lancar,
            'shalawat_nilai_tajwid'=>$this->getExamReadShalawatMember==null?null:$this->getExamReadShalawatMember->nilai_tajwid,
            'shalawat_nilai_makhraj'=>$this->getExamReadShalawatMember==null?null:$this->getExamReadShalawatMember->nilai_makhraj
        ];
    }
}
