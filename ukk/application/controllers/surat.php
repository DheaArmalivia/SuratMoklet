<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('inbox_model');
		$this->load->model('outbox_model');
		$this->load->model('disposisi_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {

			redirect('disposisi','refresh');

		} else {
			redirect('login');
		}
	}

	//INBOX

	public function inbox()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level') == '0') {
				$data['main_view'] = 'inbox_view';
				$data['data_inbox'] = $this->inbox_model->get_inbox();
				$this->load->view('template_view', $data);
			} else {
			}
		} else {
			redirect('login');
		}
	}

	public function insert_in()
	{
		if($this->session->userdata('logged_in') == TRUE){

			if($this->session->userdata('level') == '0'){

				//
				$this->form_validation->set_rules('no_surat', 'nomor_surat', 'trim|required');
				$this->form_validation->set_rules('tgl_kirim', 'tgl_kirim', 'trim|required|date');
				$this->form_validation->set_rules('tgl_terima', 'tgl_terima', 'trim|required|date');
				$this->form_validation->set_rules('pengirim', 'pengirim', 'trim|required');
				$this->form_validation->set_rules('penerima', 'penerima', 'trim|required');
				$this->form_validation->set_rules('perihal', 'perihal', 'trim|required');

				if ($this->form_validation->run() == TRUE) {
					//konfigurasi upload file
					$config['upload_path'] 		= './uploads/';
					$config['allowed_types']	= 'pdf';
					$config['max_size']			= 2000;
					$this->load->library('upload', $config);
					
					if ($this->upload->do_upload('file_surat')){
						
						if($this->inbox_model->insert_inbox($this->upload->data()) == TRUE ){
							$this->session->set_flashdata('notif', 'Tambah surat berhasil!');
							redirect('surat/inbox');			
						} else {
							$this->session->set_flashdata('notif', 'Tambah surat gagal!');
							redirect('surat/inbox');			
						}

					} else {
						$this->session->set_flashdata('notif', $this->upload->display_errors());
						redirect('surat/inbox');	
					}

				} else {
					$this->session->set_flashdata('notif', validation_errors());
					redirect('surat/inbox');			
				}
			}
		} else {
			redirect('login');
		}
	}

	public function get_inbox_by_id($id_surat_masuk)
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level') == '0') {
				$data_inbox_by_id = $this->inbox_model->get_inbox_by_id($id_surat_masuk);
				echo json_encode($data_inbox_by_id);
			} 
		} else {
			redirect('login');
		}
	}

	public function update_in()
	{
		if ($this->session->userdata('logged_in') == TRUE) {

			if ($this->session->userdata('level') == '0') {

				$this->form_validation->set_rules('edit_no_surat', 'nomor_surat', 'trim|required');
				$this->form_validation->set_rules('edit_no_surat', 'tgl_kirim', 'trim|required|date');
				$this->form_validation->set_rules('edit_no_surat', 'tgl_terima', 'trim|required|date');
				$this->form_validation->set_rules('edit_no_surat', 'pengirim', 'trim|required');
				$this->form_validation->set_rules('edit_no_surat', 'penerima', 'trim|required');
				$this->form_validation->set_rules('edit_no_surat', 'perihal', 'trim|required');

				if ($this->form_validation->run() == TRUE) {
					
					if ($this->inbox_model->update_inbox() == TRUE) {
						$this->session->set_flashdata('notif', 'Edit Surat berhasil');
						redirect('surat/inbox');
					} else {
						$this->session->set_flashdata('notif', 'edit surat gagal');
						redirect('surat/inbox');
					}

				} else {
					$this->session->set_flashdata('notif', validation_errors());
					redirect('surat/inbox');
				}

			} else {
				redirect('login');
			}
		} else {
			redirect('login');
		}
	}

	public function delete_in($id_inbox)
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level') == '0') {
				if ($this->inbox_model->delete_inbox($id_inbox) == TRUE) {
					$this->session->set_flashdata('notif', 'hapus sukses');
					redirect('surat/inbox');
				} else {
					$this->session->set_flashdata('notif', 'hapus gagal');
					redirect('surat/inbox');
				}
			} else {
				redirect('login');
			}
		} else {
			redirect('login');
		}
	}

	public function update_file_in()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			
			if ($this->session->userdata('level') == '0') {
				
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'pdf';
				$config['max_size']  = 2000;
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('edit_file_surat')){
					
					if ($this->inbox_model->update_file_inbox($this->upload->data()) == TRUE) {
						$this->session->set_flashdata('notif', 'edit file sukses');
						redirect('surat/inbox');
					} else {
						$this->session->set_flashdata('notif', 'edit gagal');
						redirect('surat/inbox');
					}
				} else {
					$this->session->set_flashdata('notif', $this->upload->display_errors());
					redirect('surat/inbox');
				}

			} else {
				redirect('login');
			}

		} else {
			redirect('login');
		}
	}


	//OUTBOX
	public function outbox()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level') == '0') {
				$data['main_view'] = 'outbox_view';
				$data['data_outbox'] = $this->outbox_model->get_outbox();
				$this->load->view('template_view', $data);
			} else {
			}
		} else {
			redirect('login');
		}
	}

	public function insert_out()
	{
		if($this->session->userdata('logged_in') == TRUE){

			if($this->session->userdata('level') == '0'){

				//
				$this->form_validation->set_rules('no_surat', 'nomor_surat', 'trim|required');
				$this->form_validation->set_rules('tgl_kirim', 'tgl_kirim', 'trim|required|date');
				$this->form_validation->set_rules('penerima', 'penerima', 'trim|required');
				$this->form_validation->set_rules('perihal', 'perihal', 'trim|required');

				if ($this->form_validation->run() == TRUE) {
					//konfigurasi upload file
					$config['upload_path'] 		= './uploads/';
					$config['allowed_types']	= 'pdf';
					$config['max_size']			= 2000;
					$this->load->library('upload', $config);
					
					if ($this->upload->do_upload('file_surat')){
						
						if($this->outbox_model->insert_outbox($this->upload->data()) == TRUE ){
							$this->session->set_flashdata('notif', 'Tambah surat berhasil!');
							redirect('surat/outbox');			
						} else {
							$this->session->set_flashdata('notif', 'Tambah surat gagal!');
							redirect('surat/outbox');			
						}

					} else {
						$this->session->set_flashdata('notif', $this->upload->display_errors());
						redirect('surat/outbox');	
					}

				} else {
					$this->session->set_flashdata('notif', validation_errors());
					redirect('surat/outbox');			
				}
			}
		} else {
			redirect('login');
		}
	}

	public function get_outbox_by_id($id_surat_keluar)
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level') == '0') {
				$data_outbox_by_id = $this->outbox_model->get_outbox_by_id($id_surat_keluar);
				echo json_encode($data_outbox_by_id);
			} 
		} else {
			redirect('login');
		}
	}

	public function delete_out($id_outbox)
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level') == '0') {
				if ($this->outbox_model->delete_outbox($id_outbox) == TRUE) {
					$this->session->set_flashdata('notif', 'hapus sukses');
					redirect('surat/outbox');
				} else {
					$this->session->set_flashdata('notif', 'hapus gagal');
					redirect('surat/outbox');
				}
			} else {
				redirect('login');
			}
		} else {
			redirect('login');
		}
	}

	public function update_file_out()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			
			if ($this->session->userdata('level') == '0') {
				
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'pdf';
				$config['max_size']  = 2000;
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('edit_file_surat')){
					
					if ($this->outbox_model->update_file_outbox($this->upload->data()) == TRUE) {
						$this->session->set_flashdata('notif', 'edit file sukses');
						redirect('surat/outbox');
					} else {
						$this->session->set_flashdata('notif', 'edit gagal');
						redirect('surat/outbox');
					}
				} else {
					$this->session->set_flashdata('notif', $this->upload->display_errors());
					redirect('surat/outbox');
				}

			} else {
				redirect('login');
			}

		} else {
			redirect('login');
		}
	}



}
/* End of file surat.php */
/* Location: ./application/controllers/surat.php */