<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {
  public function index()
  {
      $data['title'] = 'Pesan Masuk';
      $data['pesan'] = $this->DataModel->getData('message')->result();

      $this->load->view('template_admin/header', $data);
      $this->load->view('template_admin/sidebar');
      $this->load->view('template_admin/topbar');
      $this->load->view('admin/pesan', $data);
      $this->load->view('template_admin/footer');
  }

  public function detailPesan($id)
  {
      $data['title'] = 'Detail Pesan';
  
      $this->load->model('PesanModel'); // Memuat model PesanModel
      $this->load->model('DataModel', 'dataModel');
  
      $where = array('id' => $id);
      $data['pesan'] = $this->dataModel->getWhere('message', $where)->row();
  
      // Setel tanggal_dikirim hanya jika belum ada nilai sebelumnya
      if (empty($data['pesan']->tanggal_dikirim)) {
          $tanggal_dikirim = date('Y-m-d H:i:s');
          $this->db->where('id', $id);
          $this->db->update('message', array('tanggal_dikirim' => $tanggal_dikirim));
          $data['pesan']->tanggal_dikirim = $tanggal_dikirim;
      } else {
          $tanggal_dikirim = date('Y-m-d H:i:s', strtotime($data['pesan']->tanggal_dikirim));
          $data['pesan']->tanggal_dikirim = $tanggal_dikirim;
      }
  
      // Mengubah format waktu menjadi "H:i:s"
      $tanggal_dikirim = date('Y-m-d H:i:s', strtotime($tanggal_dikirim));
      $data['pesan']->tanggal_dikirim = $tanggal_dikirim;
  
      // Simpan ID pesan yang sudah dibaca ke dalam session
      $pesan_dibaca = $this->session->userdata('pesan_dibaca');
      if (empty($pesan_dibaca)) {
          $pesan_dibaca = array();
      }
      $pesan_dibaca[] = $id;
      $this->session->set_userdata('pesan_dibaca', $pesan_dibaca);
  
      // Mengirimkan data pesan_dibaca ke view
      $data['pesan_dibaca'] = $pesan_dibaca;
  
      $this->load->view('template_admin/header', $data);
      $this->load->view('template_admin/sidebar');
      $this->load->view('template_admin/topbar');
      $this->load->view('admin/detailPesan', $data);
      $this->load->view('template_admin/footer');
  }
   
  public function delete($id)
  {
      $where = array('id' => $id);
      $this->db->delete('message', $where);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Success!</h4>
          Berhasil dihapus!.
      </div>');
      redirect('admin/pesan');
  }
  public function pdf(){
    $this->load->library('dompdf_gen');

    $data['pesan'] = $this->DataModel->getData('message')->result();

    $this->load->view('admin/laporan_pdf',$data);

    $paper_size = 'A4';
    $orientation = 'portrait';
    $html = $this->output->get_output();
    $this->dompdf->set_paper($paper_size, $orientation);

    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream("laporankontak.pdf", array('Attachment' =>0));
  } 

}
