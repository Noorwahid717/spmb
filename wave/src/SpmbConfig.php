<?php
namespace Wave;

use Illuminate\Database\Eloquent\Model;
// namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class SpmbConfig extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'spmb_config';
}
