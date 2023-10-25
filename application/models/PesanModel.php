<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PesanModel extends CI_Model {

    public function getPesanByID($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('message')->row();
    }

    public function updatePesan($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('message', $data);
        return $this->db->affected_rows();
    }
}
