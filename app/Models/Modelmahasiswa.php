<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelmahasiswa extends Model
{
    protected $table = 'mahasiswa007';
    protected $primaryKey = 'id_mahasiswa007';

    protected $useAutoIncrement = true;

    //field yang wajib diisi
    protected $allowedFields =['nim007','nama007','tmplahir007','tgllahir007','jenkel007'];
}
?>