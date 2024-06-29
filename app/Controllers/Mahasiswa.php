<?php

namespace App\Controllers;

use App\Models\Modelmahasiswa;

class Mahasiswa extends BaseController
{
    public function index()
    {
        return view('Mahasiswa/v_Tampildata');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()){
            $mhs = new Modelmahasiswa();
            $data = [
                'tampildata' => $mhs->findAll()
            ];
            $msg = [
                'data' => view('Mahasiswa/datamahasiswa', $data) // Tambahkan $ sebelum data
            ];
            echo json_encode($msg);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }

    public function formtambah()
    {
        if($this->request->isAJAX()){
            $msg = [
                'data' => view('Mahasiswa/modeltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('maaf tidak dapat diproses');
        }
    }

    public function simpandata()
{
    if ($this->request->isAJAX()) {
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'nim' => [
                'label' => 'NIM',
                'rules' => 'required|is_unique[mahasiswa007.nim007]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Tidak boleh ada yang sama, silahkan coba yang lain',
                ]
            ],
            'nama' => [
                'label' => 'NAMA',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                ]
            ],
            'tmplahir' => [
                'label' => 'Tempat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                ]
            ],
            'tgllahir' => [
                'label' => 'Tanggal lahir',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                ]
            ],
            'jenkel' => [
                'label' => 'Jenis Kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                ]
            ],
        ]);

        if (!$valid) {
            $msg = [
                'error' => [
                    'nim' => $validation->getError('nim'),
                    'nama' => $validation->getError('nama'),
                    'tmplahir' => $validation->getError('tmplahir'),
                    'tgllahir' => $validation->getError('tgllahir'),
                    'jenkel' => $validation->getError('jenkel'),
                ]
            ];
          
        } else {
            // Tambahkan logika untuk menyimpan data di sini
            $simpandata = [
                'nim007' => $this->request->getPost('nim'),
                'nama007' => $this->request->getPost('nama'),
                'tmplahir007' => $this->request->getPost('tmplahir'),
                'tgllahir007' => $this->request->getPost('tgllahir'),
                'jenkel007' => $this->request->getPost('jenkel'),
            ];
            $mhs = new Modelmahasiswa;
            $mhs->insert($simpandata);

            $msg = [
                'sukses' => 'Data mahasiswa berhasil disimpan'
            ];
        }
            echo json_encode($msg);
        
    } else {
        exit('Maaf tidak dapat diproses');
    }
}
public function formedit()
{
    if($this->request->isAJAX()){
        $id_mahasiswa007 = $this->request->getVar('id_mahasiswa007');

        $mhs = new Modelmahasiswa;
        $row = $mhs->find($id_mahasiswa007);
        $data = [
            'id_mahasiswa007' => $row['id_mahasiswa007'],
            'nim007' => $row['nim007'],
            'nama007' => $row['nama007'],
            'tmplahir007' => $row['tmplahir007'],
            'tgllahir007' => $row['tgllahir007'],
            'jenkel007' => $row['jenkel007'],
        ];
        $msg = [
            'sukses' => view('Mahasiswa/modeledit', $data)
        ];
        echo json_encode($msg);
    } 
}
public function updatedata()
{
    if($this->request->isAJAX()){
      
        $simpandata = [
            'nim007' => $this->request->getPost('nim'),
            'nama007' => $this->request->getPost('nama'),
            'tmplahir007' => $this->request->getPost('tmplahir'),
            'tgllahir007' => $this->request->getPost('tgllahir'),
            'jenkel007' => $this->request->getPost('jenkel'),
        ];
        $mhs = new Modelmahasiswa;
        $id_mahasiswa007 = $this->request->getVar('id_mahasiswa007');
        $mhs->update($id_mahasiswa007, $simpandata);

        $msg = [
            'sukses' => 'Data mahasiswa berhasil diupdate !!!'
        ];
    
        echo json_encode($msg);
    
} else {
    exit('Maaf tidak dapat diproses');
}

}
 public function hapus()
{
    if($this->request->isAJAX()){
      $id_mahasiswa007=$this->request->getVar('id_mahasiswa007');
      $mhs= new Modelmahasiswa;

      $mhs->delete($id_mahasiswa007);

      $msg=[
        'sukses'=>"mahasiswa berhasil di hapus !!"
      ];
      echo json_encode($msg);
}

}
    

}
