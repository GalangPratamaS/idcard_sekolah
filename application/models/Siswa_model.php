<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

	var $table = 'siswa2';
	var $column_order = array(null, 'nomor_induk_siswa', 'nama_siswa', 'tempat_lahir', 'tanggal_lahir', 'alamat');
	var $column_search = array('nomor_induk_siswa', 'nama_siswa', 'tempat_lahir', 'tanggal_lahir', 'alamat'); 
	var $order = array('nomor_induk_siswa' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatable_siswa($id)
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		$this->db->where('id_jenjang', $id);
		$this->db->where('cetak', '');
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables($id)
	{
		$this->_get_datatable_siswa($id);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($id)
	{
		$this->_get_datatable_siswa($id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($id)
	{
		$this->db->from($this->table);
        $this->db->where('id_jenjang', $id);
		return $this->db->count_all_results();
	}

	// selain data table 

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

	public function getSiswaDanKartu($nis)
	{
		$this->db->select('siswa.*, nk.*');
        $this->db->from('siswa2 as siswa');
        $this->db->join('nomor_kartu_parkir as nk', 'siswa.nomor_induk_siswa = nk.nomor_induk_siswa', 'left');
        $this->db->where('siswa.nomor_induk_siswa', $nis);
        $query = $this->db->get()->row_array();
        return $query;
	}

	 public function get_siswa_id($id)
    {
        return $this->db->get_where('siswa2', ['id_siswa' => $id])->row_array();
    }

    public function kartu_siswa($nis)
    {
        $this->db->select('siswa.*, jenjang.*');
        $this->db->from('siswa2 as siswa');
        $this->db->join('sekolah as jenjang', 'siswa.id_jenjang = jenjang.id', 'left');
        $this->db->where('siswa.nomor_induk_siswa', $nis);
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function update($where, $data)
    {
        $this->db->update('siswa2', $data, $where);
        return $this->db->affected_rows();
    }

	 public function count_all_siswa()
    {
        $this->db->from('siswa2');
        return $this->db->count_all_results();
    }

}
