<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah_model extends CI_Model
{
    //Fungsi tambah data siswa
    var $table = 'sekolah';

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }
    public function json()
    {
        return $this->db->get('siswa')->result();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function count_siswa()
    {
       /* $this->db->select('SELECT b.id, b.sekolah as sekolah, count(a.id_jenjang) as count');
        $this->db->from('siswa2 a, sekolah b');
        $this->db->where('WHERE a.id_jenjang = b.id');
        $this->db->group_by('b.sekolah');
        $this->db->order_by('b.id DESC'); */
        return $this->db->query('SELECT b.id, b.sekolah as sekolah, count(a.id_jenjang) as count FROM siswa2 a, sekolah b WHERE a.id_jenjang = b.id GROUP BY sekolah ORDER BY b.id DESC')->result();        
    }
}
