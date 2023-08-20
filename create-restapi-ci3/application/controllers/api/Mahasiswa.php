<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mhs');
        // limit usage
        $this->methods['index_get']['limit'] = 100;
        $this->methods['index_delete']['limit'] = 100;
        $this->methods['index_post']['limit'] = 100;
        $this->methods['index_put']['limit'] = 100;
    }

    // read data
    public function index_get()
    {
        $id = $this->get('id');
        if ($id == NULL) {
            $mahasiswa = $this->mhs->getMahasiswa();
        } else {
            $mahasiswa = $this->mhs->getMahasiswa($id);
        }
        if ($mahasiswa) {
            $this->response([
                'status' => true,
                'message' => $mahasiswa,
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found',
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    // delete data
    public function index_delete()
    {
        $id = $this->delete('id');
        if ($id === NULL) {
            $this->response([
                'status' => false,
                'message' => 'provide an id',
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->mhs->deleteMahasiswa($id) > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'deleted',
                ], null, 204);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found',
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }

    // create data
    public function index_post()
    {
        $data =  [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan'),
        ];
        if ($this->mhs->createMahasiswa($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new mahasiswa has been created',
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to created new mahasiswa',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // update data
    public function index_put()
    {
        $id = $this->put('id');
        $data =  [
            'nrp' => $this->put('nrp'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jurusan' => $this->put('jurusan'),
        ];
        if ($this->mhs->updateMahasiswa($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'mahasiswa has been updated',
            ], null, 204);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update mahasiswa',
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
