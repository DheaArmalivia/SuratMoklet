
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Disposisi Surat</h3>
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
                        			<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_disp"><span class="fa fa-plus"></span> Tambah Disposisi</a>
                    			</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>No.</th>
												<th>Pengirim</th>
												<th>Tujuan Pegawai</th>
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
														<td>
															<a href="'.base_url('uploads/'.$disposisi->file_surat).'" class="btn btn-info btn-sm btn-block" target="_blank">Lihat Surat</a>
															<a href="#" class="btn btn-danger btn-sm btn-block" target="_blank">Hapus Surat</a>
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
			<!-- END MAIN CONTENT -->

			<!--  MODAL tambah surat -->
		    <div class="modal fade" id="add_disp" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <form action="<?php echo base_url('index.php/disposisi/add_disp/'.$this->uri->segment(3)); ?>" method="post" enctype="multipart/form-data">
		                    <div class="modal-header">
		                        <h4 class="modal-title" id="modal_addLabel">Tambah Disposisi SUrat</h4>
		                    </div>
		                    <div>
		                    	<label><?php echo $this->session->userdata('id_pegawai'); ?></label>
		                    </div>
		                    <div class="modal-body">
		                        <div class="form-group">
		                            <label>Tujuan Pegawai</label>
		                            <select class="form-control" name="tujuan_pegawai" id="tujuan_pegawai">
		                                <option value="">-- Pilih Nama Pegawai --</option>
		                                <?php
		                                    foreach ($drop_down_jabatan as $jabatan) {
		                                        if($jabatan->id_jabatan != $this->session->userdata('id_jabatan') && $jabatan->id_jabatan > $this->session->userdata('id_jabatan')){
		                                            echo '
		                                                <option value="'.$jabatan->id_jabatan.'">'.$jabatan->nama_jabatan.'</option>
		                                            ';
		                                        }
		                                    }
		                                ?>
		                            </select>
		                        </div>
		                        <div class="form-group">
		                            <label>Keterangan</label>
		                            <textarea class="form-control" name="keterangan" rows="10"></textarea>
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

		</div>
		<!-- END MAIN -->

	<script type="text/javascript">
        function get_pegawai_by_jabatan(id_jabatan)
        {
            $('#tujuan_pegawai').empty();

            $.getJSON('<?php echo base_url() ?>index.php/disposisi/get_pegawai_by_jabatan/'+id_jabatan, function(data){
                $.each(data, function(index,value){
                    $('#tujuan_pegawai').append('<option value="'+value.id_pegawai+'">'+value.nama+'</option>');
                })
            });
        }
    </script>