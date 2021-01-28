<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    //Fungsi tambah data siswa
    var $tabel = 'siswa2';
    var $table2 = 'siswa2';
    var $column_order = ['nomor_induk_siswa', 'nama_siswa', 'tempat_lahir', 'tanggal_lahir', 'alamat'];
    var $order = ['nomor_induk_siswa', 'nama_siswa', 'tempat_lahir', 'tanggal_lahir', 'alamat'];


    public function tambah($data)
    {
        $this->db->insert($this->tabel, $data);
        return $this->db->affected_rows();
    }

    function kelas()
    {
        return $this->db->get('kelas')->result();
    }

    public function tambah_kelas($data)
    {
        $this->db->insert('kelas', $data);
        return $this->db->affected_rows();
    }

    function jurusan()
    {
        return $this->db->get('pk')->result();
    }

    public function tambah_jurusan($data)
    {
        $this->db->insert('pk', $data);
        return $this->db->affected_rows();
    }

    // Fungsi data siswa tabel edit dan lain-lain


    private function _json()
    {
        $this->db->from('siswa2');
        if (isset($_POST['search']['value'])) {
            $this->db->or_like('nomor_induk_siswa', $_POST['search']['value']);
            $this->db->or_like('nama_siswa', $_POST['search']['value']);
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_siswa', 'DESC');
        }
    }

    public function json()
    {
        return $this->db->get('siswa2')->result();
    }

    public function get_siswa()
    {
        $this->_json();
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filter()
    {
        $this->_json();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('siswa2');
        return $this->db->count_all_results();
    }

    public function delete_by_id($id)
    {
        $this->db->where('nomor_induk_siswa', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('siswa2', ['nomor_induk_siswa' => $id])->row_array();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    
}
