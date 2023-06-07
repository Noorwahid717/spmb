<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamabaDataPernyataan extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'camaba_data_pernyataan';
    protected $appends = array(
        'url_surat_pernyataan_b64',
    );

    public function getUrlSuratPernyataanB64Attribute()
    {
        // asset("storage").
        if($this->url_surat_pernyataan!=null){
            $path = 'storage/'.$this->url_surat_pernyataan;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            if($type=="pdf"){
                $base64 = 'data:application/' . $type . ';base64,' . base64_encode($data);
            }else{
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
            return $base64;  
        }else{
            return null;
        }
    }

}
