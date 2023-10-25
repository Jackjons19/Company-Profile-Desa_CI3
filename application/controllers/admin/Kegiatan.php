<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {

	public function index()
	{
		$data['title'] = "Sistem Kegiatan";
		$data['kegiatan'] = $this->db->get('kegiatan')->result();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('template_admin/topbar');
		$this->load->view('admin/kegiatan', $data);
		$this->load->view('template_admin/footer');

	}
    

    public function tambah()
    {
      $data['title'] = "Tambah Kegiatan";
      $this->load->view('template_admin/header', $data);
      $this->load->view('template_admin/sidebar');
      $this->load->view('template_admin/topbar');
      $this->load->view('admin/tambah-kegiatan');
      $this->load->view('template_admin/footer');
    }
  
    public function tambah_aksi()
    {
      $judul = $this->input->post('judul');
      $isi = $this->input->post('isi');
  
      // Proses upload gambar
      $config['upload_path'] = './assets/user/img/';
      $config['allowed_types'] = 'jpg|jpeg|png|gif';
      $config['max_size'] = 2048; // 2MB
      $config['file_name'] = 'gambar_' . time();
  
      $this->load->library('upload', $config);
  
      if ($this->upload->do_upload('gambar')) {
        $gambar = $this->upload->data('file_name');
  
        // Data kegiatan yang akan ditambahkan
        $data = array(
          'judul' => $judul,
          'isi' => $isi,
          'gambar' => $gambar
        );
  
        // Menambahkan data kegiatan ke database
        $this->DataModel->tambah_data('kegiatan', $data);
  
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Success!</h4>
              Data kegiatan berhasil ditambahkan!
          </div>');
        redirect('admin/kegiatan');
      } else {
        $error = $this->upload->display_errors();
        echo $error;
      }
    }

	public function edit($id)
	{
		$data['title'] = "Edit Kegiatan";
		$where = array('id_kegiatan' => $id);

		$data['kegiatan'] = $this->db->get_where('kegiatan', $where)->row_array();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('template_admin/topbar');
		$this->load->view('admin/edit-kegiatan', $data);
		$this->load->view('template_admin/footer');
	}

	public function edit_aksi()
	{
		$id 		= $this->input->post('id_kegiatan');
		$judul	= htmlspecialchars($this->input->post('judul', true));
		$isi		= htmlspecialchars($this->input->post('isi', true));
		$photo		= $_FILES['gambar']['name'];
			if($photo){
				$config ['upload_path']		= './assets/user/img';
				$config ['allowed_types']	= 'jpeg|jpg|png|gif|tiff';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('gambar')){
					$photo = $this->upload->data('file_name');
					$this->db->set('gambar', $photo);
				}else{
					echo "Gagal upload";
				}
			}

		$data = array(
			'gambar' => $photo,
			'judul'  => $judul,
			'isi'	=> $isi,
		);

		$where = array(
			'id_kegiatan' => $id
		);

		$this->DataModel->update_data('kegiatan', $data, $where);
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Data berhasil diperbaharui!.
              </div>');
		redirect('admin/kegiatan');
	}
    
    public function hapus($id) {
        $where = array('id_kegiatan' => $id);
        
        // Memanggil model untuk menghapus data kegiatan
        $this->DataModel->hapus_data('kegiatan', $where);
        
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            Data kegiatan berhasil dihapus!
        </div>');
        
        redirect('admin/kegiatan');
    }

    public function detail_berita($id_kegiatan)
{
    $data['title'] = 'Judul Website'; // Ganti dengan judul website Anda
    $data['berita'] = $this->DataModel->get_berita_by_id($id_kegiatan); // Ganti dengan pemanggilan fungsi untuk mengambil detail berita berdasarkan ID

    $this->load->view('detail_berita', $data);
}

}