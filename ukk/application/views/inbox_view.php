
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Surat Masuk</h3>
					<?php 
                    $notif = $this->session->flashdata('notif');
                    if($notif != NULL){
                        echo '
                            <div class="alert alert-info">'.$notif.'</div>
                        ';
                    }
                ?>
					<div class="row">
					</div>
					<div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Surat Masuk</h3>
								</div>
									<div class="panel-heading">
                        				<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_inbox"><span class="fa fa-plus"></span> Tambah Surat</a>
                    				</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>No. Surat</th>
												<th>Tanggal Kirim</th>
												<th>Tanggal Terima</th>
												<th>Pengirim</th>
												<th>Penerima</th>
												<th>Perihal</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$no = 0;
											foreach ($data_inbox as $inbox) {
												echo '
													<tr>
														<td>'.++$no.'</td>
														<td>'.$inbox->nomor_surat.'</td>
														<td>'.$inbox->tgl_kirim.'</td>
														<td>'.$inbox->tgl_terima.'</td>
														<td>'.$inbox->pengirim.'</td>
														<td>'.$inbox->penerima.'</td>
														<td>'.$inbox->perihal.'</td>
														<td>'.$inbox->status.'</td>
														<td>
															<a href="'.base_url('uploads/'.$inbox->file_surat).'" class="btn btn-info btn-sm" target="_blank">Lihat</a>
															<a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit" onclick="prepare_update_inbox('.$inbox->id_surat_masuk.')">Edit</a>
															<a href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal_ubah_surat" onclick="prepare_update_inbox('.$inbox->id_surat_masuk.')">Edit Surat</a>
															<a href="'.base_url('index.php/disposisi/disposisi/'. $inbox->id_surat_masuk).'" class="btn btn-primary btn-sm" target="_blank">Disposisi</a>
															<a href="'.base_url('index.php/surat/delete_in/'.$inbox->id_surat_masuk).'" class="btn btn-danger btn-sm" target="_blank">Hapus</a>
														</td>
													</tr>
												';
											}
										?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- END TABLE STRIPED -->
						</div>
							<!-- END CONDENSED TABLE -->
						</div>
					</div>
				</div>
			</div>

			<!--  MODAL tambah surat -->
		    <div class="modal fade" id="add_inbox" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <form action="<?php echo base_url('index.php/surat/insert_in'); ?>" method="post" enctype="multipart/form-data">
		                    <div class="modal-header">
		                        <h4 class="modal-title" id="modal_addLabel">Tambah Surat Masuk</h4>
		                    </div>
		                    <div class="modal-body">
		                        <div class="form-group">
		                            <label>Nomor Surat</label>
		                            <input type="text" name="no_surat" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Tanggal Kirim</label>
		                            <input type="date" name="tgl_kirim" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Tanggal Terima</label>
		                            <input type="date" name="tgl_terima" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Pengirim</label>
		                            <input type="text" name="pengirim" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Penerima</label>
		                            <input type="text" name="penerima" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Perihal</label>
		                            <input type="text" name="perihal" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Status</label>
		                            <select class="form-control" name="status">
		                                <option value="">-- Pilih Statust --</option>
		                                <option value="proses">Proses</option>
		                                <option value="selesai">Selesai</option>
		                            </select>
		                        </div>
		                        <div class="form-group">
		                            <label>Unggah Surat (*.pdf)</label>
		                            <input type="file" name="file_surat" class="form-control">
		                        </div>
		                    </div>
		                    <div class="modal-footer">
		                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
		                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
		                    </div>
		                </form>
		            </div>
		            <!-- /.modal-content -->
		        </div>
					<!-- END MAIN CONTENT -->
			</div>
		<!-- END MAIN -->

		<!--  MODAL edit surat -->
		    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal_editLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <form action="<?php echo base_url('index.php/surat/update_in'); ?>" method="post" enctype="multipart/form-data" > 
		                    <div class="modal-header">
		                        <h4 class="modal-title" id="modal_editLabel">Edit Surat Masuk</h4>
		                    </div>
		                    <div class="modal-body">
		                    	<input type="hidden" name="edit_id_inbox" id="edit_id_inbox">
		                        <div class="form-group">
		                            <label>Nomor Surat</label>
		                            <input type="text" name="edit_no_surat" id="edit_no_surat" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Tanggal Kirim</label>
		                            <input type="date" name="edit_tgl_kirim" id="edit_tgl_kirim" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Tanggal Terima</label>
		                            <input type="date" name="edit_tgl_terima" id="edit_tgl_terima" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Pengirim</label>
		                            <input type="text" name="edit_pengirim" id="edit_pengirim" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Penerima</label>
		                            <input type="text" name="edit_penerima" id="edit_penerima" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Perihal</label>
		                            <input type="text" name="edit_perihal" id="edit_perihal" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>file s</label>
		                            <input type="text" name="edit_file_surat" id="edit_file_surat" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Status</label>
		                            <select class="form-control" name="edit_status" id="edit_status">
		                                <option value="">-- Pilih Status --</option>
		                                <option value="proses">Proses</option>
		                                <option value="selesai">Selesai</option>
		                            </select>
		                        </div>
		                    </div>
		                    <div class="modal-footer">
		                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
		                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
		                    </div>
		                </form>
		            </div>
		            <!-- /.modal-content -->
		        </div>
					<!-- END MAIN CONTENT -->
			</div>
		<!-- END MAIN -->

			<!--  MODAL ubah surat -->
		    <div class="modal fade" id="modal_ubah_surat" tabindex="-1" role="dialog" aria-labelledby="modal_ubah_suratLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <form action="<?php echo base_url('index.php/surat/update_file_in'); ?>" method="post" enctype="multipart/form-data">
		                    <div class="modal-header">
		                        <h4 class="modal-title" id="modal_ubahsuratLabel">Ubah File Surat</h4>
		                    </div>
		                    <div class="modal-body">
		                        <input type="hidden" name="edit_file_surat" id="edit_file_surat">
		                        <div class="form-group">
		                            <label>Unggah Surat (*.pdf)</label>
		                            <input type="file" name="edit_file_surat" class="form-control">
		                        </div>
		                    </div>
		                    <div class="modal-footer">
		                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
		                        <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
		                    </div>
		                </form>
		            </div>
		            <!-- /.modal-content -->
		        </div>
		        <!-- /.modal-dialog -->
		    </div>


		    <script type="text/javascript">
	        function prepare_update_inbox(id_surat_masuk)
	        {
	            $('#edit_file_surat').empty();
	            $('#edit_id_inbox').empty();
	            $('#edit_no_surat').empty();
	            $('#edit_tgl_terima').empty();
	            $('#edit_tgl_kirim').empty();
	            $('#edit_penerima').empty();
	            $('#edit_pengirim').empty();
	            $('#edit_perihal').empty();

	            $.getJSON('<?php echo base_url(); ?>index.php/surat/get_inbox_by_id/' + id_surat_masuk, function(data){
	                $('#edit_file_surat').val(data.id_surat_masuk);
	                $('#edit_id_inbox').val(data.id_surat_masuk);
	                $('#edit_no_surat').val(data.nomor_surat);
	                $('#edit_tgl_terima').val(data.tgl_terima);
	                $('#edit_tgl_kirim').val(data.tgl_kirim);
	                $('#edit_penerima').val(data.penerima);
	                $('#edit_pengirim').val(data.pengirim);
	                $('#edit_perihal').val(data.perihal);
	                $('#edit_status').val(data.status);
	            });
	        }

    </script>