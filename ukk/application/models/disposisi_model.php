<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposisi_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	public function get_jabatan()
	{
		return $this->db->get('jabatan')
						->result();
	}

	public function get_disp()
	{
		return $this->db->get('disposisi')
						->result();
	}

	public function get_all_disposisi($id_surat_masuk)
	{
		return $this->db->join('disposisi', 'disposisi.id_surat_masuk = surat_masuk.id_surat_masuk')
						->join('pegawai AS pengirim', 'pengirim.id_pegawai = disposisi.id_pegawai_pengirim')
						->join('pegawai AS penerima', 'penerima.id_pegawai = disposisi.id_pegawai_penerima')
						->join('jabatan', 'pengirim.id_jabatan = jabatan.id_jabatan')
						->where('disposisi.id_surat_masuk', $id_surat_masuk)
						->get('surat_masuk')
						->result();
	}

	public function get_pegawai_by_jabatan($id_jabatan)
	{
		return $this->db->where('id_jabatan', $id_jabatan)
						->get('pegawai')
						->result();
	}

	public function add_disposisi($id_surat_masuk)
	{
		$data = array(
				'id_surat_masuk' 		=> $id_surat_masuk,
				'id_pegawai_pengirim' 	=> $this->session->userdata('id_pegawai'),
				'id_pegawai_penerima' 	=> $this->input->post('tujuan_pegawai'),
				'keterangan' 			=> $this->input->post('keterangan')
				 );

		$this->db->insert('disposisi', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}

	}

	public function get_all_disposisi_out($id_pegawai_pengirim)
	{
		return $this->db->join('disposisi', 'disposisi.id_surat_masuk = surat_masuk.id_surat_masuk')
						->join('pegawai', 'disposisi.id_pegawai_penerima = pegawai.id_pegawai')
						->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
						->where('disposisi.id_pegawai_pengirim', $this->session->userdata('id_pegawai'))
						->where('disposisi.id_surat_masuk', $this->uri->segment(3))
						->get('surat_masuk')
						->result();
	}

	public function get_all_disposisi_in($id_pegawai_penerima)
	{
		return $this->db->join('disposisi', 'disposisi.id_surat_masuk = surat_masuk.id_surat_masuk')
		->join('pegawai', 'disposisi.id_pegawai_pengirim = pegawai.id_pegawai')
		->join('jabatan', 'jabatan.id_jabatan = pegawai.id_jabatan')
		->where('id_pegawai_penerima', $id_pegawai_penerima)
		->where('disposisi.id_surat_masuk', $this->uri->segment(3))
		->get('surat_masuk')
		->result();
	}

	public function delete_disposisi($id_disposisi)
	{
		$this->db->where('id_disposisi', $id_disposisi)
				 ->delete('disposisi');

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file disposisi_model.php */
/* Location: ./application/models/disposisi_model.php */