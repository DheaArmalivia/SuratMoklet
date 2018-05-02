<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));
	}

	public function get_dashboard()
	{
		$inbox = $this->db->select('count(*) as totali')
						  ->get('surat_masuk')
						  ->row();
		$outbox = $this->db->select('count(*) as totalo')
						   ->get('surat_keluar')
						   ->row();
		$disposition = $this->db->select('count(*) as totald')
								->get('disposisi')
								->row();
		return array(
			'surat_masuk' => $inbox->totali,
			'surat_keluar' => $outbox->totalo,
			'disposisi' => $disposition->totald
			);
	}

	public function get_inbox()
	{
		return $this->db->get('surat_masuk')
						->result();
	}

	public function insert_inbox($file_surat)
	{
		$data = array(
				'nomor_surat' 	=> $this->input->post('no_surat'),
				'tgl_kirim' 	=> $this->input->post('tgl_kirim'),
				'tgl_terima' 	=> $this->input->post('tgl_terima'),
				'pengirim' 		=> $this->input->post('pengirim'),
				'penerima' 		=> $this->input->post('penerima'),
				'perihal' 		=> $this->input->post('perihal'),
				'status' 		=> $this->input->post('status'),
				'file_surat' 	=> $file_surat['file_name']
				 );

		$this->db->insert('surat_masuk', $data);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_inbox_by_id($id_surat_masuk)
	{
		return $this->db->where('id_surat_masuk', $id_surat_masuk)
						->get('surat_masuk')
						->row();
	}

	public function update_inbox()
	{
		$data = array(
				'nomor_surat' 	=> $this->input->post('edit_no_surat'),
				'tgl_kirim' 	=> $this->input->post('edit_tgl_kirim'),
				'tgl_terima' 	=> $this->input->post('edit_tgl_terima'),
				'pengirim' 		=> $this->input->post('edit_pengirim'),
				'penerima' 		=> $this->input->post('edit_penerima'),
				'perihal' 		=> $this->input->post('edit_perihal'),
				'status' 		=> $this->input->post('edit_status'),
				 );

		$this->db->where('id_surat_masuk', $this->input->post('edit_id_inbox'))
				 ->update('surat_masuk', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}

	}

	public function delete_inbox($id_inbox)
	{
		$this->db->where('id_surat_masuk', $id_inbox)
				 ->delete('surat_masuk');

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function update_file_inbox($file_surat)
	{
		$data = array(
				'file_surat' => $file_surat['file_name'] );

		$this->db->where('id_surat_masuk', $this->input->post('edit_file_surat'))
				 ->update('surat_masuk', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file inbox_model.php */
/* Location: ./application/models/inbox_model.php */