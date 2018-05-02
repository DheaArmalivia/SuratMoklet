<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function user_check()
	{
		$query = $this->db->join('jabatan','jabatan.id_jabatan = pegawai.id_jabatan')
						  ->where('nik', $this->input->post('nik'))
				 		  ->where('password', md5($this->input->post('password')))
				 		  ->get('pegawai');

		if ($query->num_rows() == 1) {
			$data_pegawai = $query->row();
			$session = array(
				'logged_in' => TRUE,
				'id_pegawai'=> $data_pegawai->id_pegawai,
				'nik' 		=> $data_pegawai->nik,
				'nama' 		=> $data_pegawai->nama,
				'password' 	=> $data_pegawai->password,
				'jabatan' 	=> $data_pegawai->nama_jabatan,
				'level' 	=> $data_pegawai->level
				 );

			$this->session->set_userdata($session);

		return TRUE;

		} else {
			return FALSE;
		}


	}

	public function get_data_pegawai()
	{
		$this->db->select('pegawai.nik, pegawai.nama, pegawai.password, jabatan.nama_jabatan, jabatan.level');
		$this->db->from('pegawai');
		$this->db->join('jabatan','pegawai.id_jabatan = jabatan.id_jabatan');
		$query = $this->db->get();
		return $query->result();
	}

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */