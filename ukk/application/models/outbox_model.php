<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outbox_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
	}

	public function get_outbox()
	{
		return $this->db->get('surat_keluar')
						->result();
	}

	public function insert_outbox($file_surat)
	{
		$data = array(
				'nomor_surat' 	=> $this->input->post('no_surat'),
				'tgl_kirim' 	=> $this->input->post('tgl_kirim'),
				'penerima' 		=> $this->input->post('penerima'),
				'perihal' 		=> $this->input->post('perihal'),
				'file_surat' 	=> $file_surat['file_name']
				 );

		$this->db->insert('surat_keluar', $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delete_outbox($id_outbox)
	{
		$this->db->where('id_surat_keluar', $id_outbox)
				 ->delete('surat_keluar');

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}


}

/* End of file outbox_model.php */
/* Location: ./application/models/outbox_model.php */