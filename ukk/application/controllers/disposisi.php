<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposisi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('disposisi_model');
		$this->load->model('inbox_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			
			if ($this->session->userdata('level') == '0') {
				$data['main_view'] = 'dashboard_view';
				$data['data_dashboard'] = $this->inbox_model->get_dashboard();
				$this->load->view('template_view', $data);
			} else {
				$data['main_view'] = 'disposisi_in';
				$data['data_disposisi'] = $this->disposisi_model->get_all_disposisi_in($this->session->userdata('id_pegawai'));
				$data['data_surat'] = $this->inbox_model->get_inbox_by_id($this->uri->segment(3));
				$this->load->view('template_view', $data);
			}

		} else {
			redirect('login');
		}
	}

	public function disposisi($id_surat_masuk)
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			
			if ($this->session->userdata('level') == '0') {

				$data['main_view'] 			= 'disposisi_sekretaris_in';
				$data['data_surat'] 		= $this->inbox_model->get_inbox_by_id($this->uri->segment(3));
				$data['drop_down_jabatan'] 	= $this->disposisi_model->get_jabatan();
				$data['data_disposisi'] 	= $this->disposisi_model->get_all_disposisi($id_surat_masuk);
				$this->load->view('template_view', $data);
			} else {
				$data['main_view'] = 'disposisi_pegawai_in';
				$this->load->view('template_view', $data);
			}

		} else {
			redirect('login');
		}
	}

	public function get_pegawai_by_jabatan($id_jabatan)
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data_pegawai = $this->disposisi_model->get_pegawai_by_jabatan($id_jabatan);
			echo json_encode($data_pegawai);
		} else {
			redirect('login');
		}
	}

	public function add_disp()
	{

		if($this->session->userdata('logged_in') == TRUE){
			$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if($this->disposisi_model->add_disposisi($this->uri->segment(3)) == TRUE ){
					$this->session->set_flashdata('notif', 'Tambah disposisi berhasil!');
					if($this->session->userdata('level') == '0'){
						redirect('disposisi/disposisi/'.$this->uri->segment(3));
					} else {
						redirect('disposisi/disposisi_out/'.$this->uri->segment(3));
					}			
				} else {
					$this->session->set_flashdata('notif', 'Tambah disposisi gagal!');
					if($this->session->userdata('level') == '0'){
						redirect('disposisi/disposisi/'.$this->uri->segment(3));
					} else {
						redirect('disposisi/disposisi_out/'.$this->uri->segment(3));
					}		
				}
			} else {
				$this->session->set_flashdata('notif', validation_errors());
				if($this->session->userdata('level') == '0'){
					redirect('disposisi/disposisi/'.$this->uri->segment(3));
				} else {
					redirect('disposisi/disposisi_keluar/'.$this->uri->segment(3));
				}			
			}
		} else {
			redirect('login');
		}
	}

	public function disposisi_out($id_surat_masuk)
	{
		if ($this->session->userdata('logged_in') == TRUE) 
		{
			$data['data_disposisi'] 	= $this->disposisi_model->get_all_disposisi_out($this->session->userdata('id_pegawai'));
			$data['data_surat'] 		= $this->inbox_model->get_inbox_by_id($id_surat_masuk);
			$data['drop_down_jabatan'] 	= $this->disposisi_model->get_jabatan();
			$data['main_view'] 			= 'disposisi_out';
			$this->load->view('template_view', $data);
		} else {
			redirect('login');
		}
	}

	public function disposisi_in($id_surat_masuk)
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['data_disposisi'] = $this->disposisi_model->get_all_disposisi_in($this->session->userdata('id_pegawai'));
			$data['data_surat'] = $this->inbox_model->get_inbox_by_id($this->uri->segment(3));
			$data['drop_down_jabatan'] = $this->disposisi_model->get_jabatan();
			$data['main_view'] = 'disposisi_in';
			$this->load->view('template_view', $data);
		}
	}

	public function delete_disp()
	{
		if($this->session->userdata('logged_in') == TRUE){
			if($this->disposisi_model->delete_disposisi($id_disposisi) == TRUE){
				$this->session->set_flashdata('notif', 'Hapus disposisi Berhasil!');
				redirect('disposisi/disposisi_out');
			} else {
				$this->session->set_flashdata('notif', 'Hapus disposisi Gagal!');
				redirect('disposisi/disposisi_out');
			}

		} else {
			redirect('login');
		}
	}

}

/* End of file disposisi.php */
/* Location: ./application/controllers/disposisi.php */