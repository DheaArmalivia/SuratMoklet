
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Surat Keluar</h3>
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
									<h3 class="panel-title">Data Surat Keluar</h3>
								</div>
								<div class="panel-heading">
                        				<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_outbox"><span class="fa fa-plus"></span> Tambah Surat Keluar</a>
                    				</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>No. Surat</th>
												<th>Tanggal Kirim</th>
												<th>Penerima</th>
												<th>Perihal</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$no = 0;
											foreach ($data_outbox as $outbox) {
												echo '
													<tr>
														<td>'.++$no.'</td>
														<td>'.$outbox->nomor_surat.'</td>
														<td>'.$outbox->tgl_kirim.'</td>
														<td>'.$outbox->penerima.'</td>
														<td>'.$outbox->perihal.'</td>
														<td>
															<a href="'.base_url('uploads/'.$outbox->file_surat).'" class="btn btn-info btn-sm" target="_blank">Lihat</a>
															<a href="'.base_url('index.php/surat/delete_out/'.$outbox->id_surat_keluar).'" class="btn btn-danger btn-sm" target="_blank">Hapus</a>
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
		    <div class="modal fade" id="add_outbox" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <form action="<?php echo base_url('index.php/surat/insert_out'); ?>" method="post" enctype="multipart/form-data">
		                    <div class="modal-header">
		                        <h4 class="modal-title" id="modal_addLabel">Tambah Surat Keluar</h4>
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
		                            <label>Penerima</label>
		                            <input type="text" name="penerima" class="form-control">
		                        </div>
		                        <div class="form-group">
		                            <label>Perihal</label>
		                            <input type="text" name="perihal" class="form-control">
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

			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->