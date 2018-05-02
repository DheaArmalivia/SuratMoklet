<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Dashboard</h3>
							<!-- <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> -->
						</div>
						<div class="panel-body">
							<div class="row">
								<a href="<?php echo base_url(); ?>index.php/surat/inbox">
									<div class="col-md-6">
										<div class="metric">
											<span class="icon"><i class="fa fa-download"></i></span>
											<p>
												<span class="number"><?php echo $data_dashboard['surat_masuk'];?></span>
												<span class="title">Surat Masuk</span>
											</p>
										</div>
									</div>
								</a>
								<a href="<?php echo base_url(); ?>index.php/surat/outbox">
									<div class="col-md-6">
										<div class="metric">
											<span class="icon"><i class="fa fa-upload"></i></span>
											<p>
												<span class="number"><?php echo $data_dashboard['surat_keluar'];?></span>
												<span class="title">Surat Keluar</span>
											</p>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
					<!-- END OVERVIEW -->
			<!-- END MAIN CONTENT -->
		</div>