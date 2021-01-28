<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class AuthModel extends CI_Model
{
    public function get($username)
    {
        $this->db->where('username', $username); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('akun_siswa')->row_array(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }
}
