<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect('surat');
		} else {
			$this->load->view('page-login');
		}
	}

	public function do_login()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect('surat');
		} else {
			$this->form_validation->set_rules('nik', 'nik', 'trim|required|numeric');
			$this->form_validation->set_rules('password', 'password', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if ($this->user_model->user_check() == TRUE) {
					$this->session->set_flashdata('notif','Login Berhasil');
					redirect('surat');
				} else {
					$this->session->set_flashdata('notif', 'NIK atau password salah!');
					redirect('login');
				}
			} else {
				$this->session->set_flashdata('notif', validadtion_errors());
				redirect('login');
			}

		}
	}

	public function logout()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$this->session->sess_destroy();
			redirect('login');
		}
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */