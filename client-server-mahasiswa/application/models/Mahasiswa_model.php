<?php

use GuzzleHttp\Client;

class Mahasiswa_model extends CI_model
{

    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost/rest-api/create-restapi-mhs-ci3/api/',
            'auth' => ['admin', '1234']
        ]);
    }

    public function getAllMahasiswa()
    {
        // return $this->db->get('mahasiswa')->result_array();
        // Get with Guzzle Web Server
        $response = $this->_client->request('GET', 'Mahasiswa', [
            'query' => [
                'key' => 'yazidskey123'
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result['message'];
    }

    public function getMahasiswaById($id)
    {
        // return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
        // Get with Guzzle Web Server
        $response = $this->_client->request('GET', 'Mahasiswa', [
            'query' => [
                'key' => 'yazidskey123',
                'id' => $id
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result['message'][0];
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            'key' => 'yazidskey123',
        ];

        // $this->db->insert('mahasiswa', $data);
        // insert with guzzle api
        $response = $this->_client->request('POST', 'Mahasiswa', [
            'form_params' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function hapusDataMahasiswa($id)
    {
        // $this->db->delete('mahasiswa', ['id' => $id]);
        // delete with guzzle api
        $response = $this->_client->request('DELETE', 'Mahasiswa', [
            'form_params' => [
                'key' => 'yazidskey123',
                'id' => $id
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id" => $this->input->post('id', true),
            'key' => 'yazidskey123',
        ];

        // $this->db->where('id', $this->input->post('id'));
        // $this->db->update('mahasiswa', $data);
        // update (put) with guzzle api
        $response = $this->_client->request('PUT', 'Mahasiswa', [
            'form_params' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}
