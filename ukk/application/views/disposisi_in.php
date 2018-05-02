
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Disposisi Masuk</h3>
					<div class="row">
					<?php 
	                    $notif = $this->session->flashdata('notif');
	                    if($notif != NULL){
	                        echo '
	                            <div class="alert alert-info">'.$notif.'</div>
	                        ';
	                    }
	                ?>
					</div>
					<div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Disposisi Masuk</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Pengirim</th>
												<th>Nama Pengirim</th>
												<th>Tanggal Disposisi</th>
												<th>Keterangan</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$no = 0;
											foreach ($data_disposisi as $disposisi) {
												echo '
													<tr>
														<td>'.++$no.'</td>
														<td>'.$disposisi->nama_jabatan.'</td>
														<td>'.$disposisi->nama.'</td>
														<td>'.$disposisi->tgl_disposisi.'</td>
														<td>'.$disposisi->keterangan.'</td>
														<td>';
														if ($this->session->userdata('level') < '4') {
															echo '
															<a href="'.base_url('uploads/'.$disposisi->file_surat).'" class="btn btn-info btn-sm btn-block" target="_blank">Lihat Surat</a>
															<a href="'.base_url('index.php/disposisi/disposisi_out/'. $disposisi->id_surat_masuk).'" class="btn btn-primary btn-sm btn-block" target="_blank">Disposisi</a>
															';
														} else {
															echo '
																<a href="#" class="btn btn-info btn-sm btn-block" target="_blank">Lihat Surat</a>
															';
														}

														echo '</td>
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
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->