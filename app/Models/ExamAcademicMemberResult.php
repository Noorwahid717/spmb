<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAcademicMemberResult extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'exam_academic_member_results';
    protected $appends = ['pertanyaan','ans_a','ans_b','ans_c','ans_d','ans_e','poin'];

    public function getBankSoal()
    {
        return $this->hasOne('App\Models\BankSoal','id','id_bank_soal');
    }

    public function getPertanyaanAttribute()
    {
        return $this->getBankSoal->pertanyaan;    
    }

    public function getPoinAttribute()
    {
        return $this->getBankSoal->nilai_poin_pengali;    
    }

    public function getAnsAAttribute()
    {
        switch ($this->rand_idx_ans_a) {
            case 1:
                return $this->getBankSoal->kunci_jawaban;
                break;
                case 2:
                    return $this->getBankSoal->jawaban_pelengkap_1;
                    break;
                    case 3:
                        return $this->getBankSoal->jawaban_pelengkap_2;
                        break;
                        case 4:
                            return $this->getBankSoal->jawaban_pelengkap_3;
                            break;            
            default:
                return $this->getBankSoal->jawaban_pelengkap_4;
                break;
        }
    }

    public function getAnsBAttribute()
    {
        switch ($this->rand_idx_ans_b) {
            case 1:
                return $this->getBankSoal->kunci_jawaban;
                break;
                case 2:
                    return $this->getBankSoal->jawaban_pelengkap_1;
                    break;
                    case 3:
                        return $this->getBankSoal->jawaban_pelengkap_2;
                        break;
                        case 4:
                            return $this->getBankSoal->jawaban_pelengkap_3;
                            break;            
            default:
                return $this->getBankSoal->jawaban_pelengkap_4;
                break;
        }    
    }

    public function getAnsCAttribute()
    {
        switch ($this->rand_idx_ans_c) {
            case 1:
                return $this->getBankSoal->kunci_jawaban;
                break;
                case 2:
                    return $this->getBankSoal->jawaban_pelengkap_1;
                    break;
                    case 3:
                        return $this->getBankSoal->jawaban_pelengkap_2;
                        break;
                        case 4:
                            return $this->getBankSoal->jawaban_pelengkap_3;
                            break;            
            default:
                return $this->getBankSoal->jawaban_pelengkap_4;
                break;
        }  
    }

    public function getAnsDAttribute()
    {
        switch ($this->rand_idx_ans_d) {
            case 1:
                return $this->getBankSoal->kunci_jawaban;
                break;
                case 2:
                    return $this->getBankSoal->jawaban_pelengkap_1;
                    break;
                    case 3:
                        return $this->getBankSoal->jawaban_pelengkap_2;
                        break;
                        case 4:
                            return $this->getBankSoal->jawaban_pelengkap_3;
                            break;            
            default:
                return $this->getBankSoal->jawaban_pelengkap_4;
                break;
        }  
    }

    public function getAnsEAttribute()
    {
        switch ($this->rand_idx_ans_e) {
            case 1:
                return $this->getBankSoal->kunci_jawaban;
                break;
                case 2:
                    return $this->getBankSoal->jawaban_pelengkap_1;
                    break;
                    case 3:
                        return $this->getBankSoal->jawaban_pelengkap_2;
                        break;
                        case 4:
                            return $this->getBankSoal->jawaban_pelengkap_3;
                            break;            
            default:
                return $this->getBankSoal->jawaban_pelengkap_4;
                break;
        }    
    }
}
