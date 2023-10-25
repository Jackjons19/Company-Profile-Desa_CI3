<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_model {

//Ambil data pada table
	public function getData($table)
	{
		return $this->db->get($table);
	}

	public function getWhere($table, $where) {
		return $this->db->get_where($table, $where);
	  }

	  public function tambah_data($table, $data) {
		$data['created_at'] = date('Y-m-d H:i:s');
    $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($table, $data);
    }
    
    // Menghapus data kegiatan
    public function hapus_data($table, $where) {
        return $this->db->delete($table, $where);
    }


//update data
public function update_data($table, $data, $where)
{
	$data['updated_at'] = date('Y-m-d H:i:s');
	return $this->db->update($table, $data, $where);
}

public function get_berita_by_id($id_kegiatan)
{
    $query = $this->db->get_where('kegiatan', array('id_kegiatan' => $id_kegiatan));
    return $query->row();
}


//login
public function cekLogin($email, $password)
{
	$email = set_value('email');
	$password = set_value('password');

	$result = $this->db->where('email', $email)
					   ->where('password', $password)
					   ->limit(1)
					   ->get('admin');

	if($result->num_rows() > 0){
		return $result->row();
	}else{
		return array();
	}

}

}