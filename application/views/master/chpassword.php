<div class="modal fade" id="modal-chpassword" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content b-0">
			<div class="modal-header r-0 bg-primary">
				<h6 class="modal-title text-white" id="exampleModalLabel">Ganti Kata Sandi</h6>
				<a href="#" data-dismiss="modal" aria-label="Close" class="paper-nav-toggle paper-nav-white active"><i></i></a>
			</div>
			<div class="modal-body no-p no-b">
				<form role="form" method="post" action="<?= base_url('auth/chpassword'); ?>" id="modalform">
					<div class="card">
						<div class="card-body b-b">
							<div class="row pb-4">
								<label class="col-md-3 col-form-label">Kata Sandi Baru</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="pass_baru" placeholder="********" required>
								</div>
							</div>
							<div class="row pb-4">
								<label class="col-md-3 col-form-label">Konfirmasi Kata Sandi Baru</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="pass_confirm" placeholder="********" required>
									<p id="notif_confirm_false" style="color:red;font-size:10pt;"></p>
									<p id="notif_confirm_true" style="color:green;font-size:10pt;"></p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
								<i class="icon-times" aria-hidden="true"></i>
								Batal
							</button>
							<button type="submit" id="btnsubmit" class="btn btn-sm btn-primary">
								<i class="icon-save" aria-hidden="true"></i>
								Simpan
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="https://assets.zerotion.com/ndonik/paper/js/jquery.min.js"></script>
<script type="text/javascript">
	$("input[name='pass_confirm']").keyup(function() {
		var pass_lama = $("input[name='pass_baru']").val();
		var pass_baru = $("input[name='pass_confirm']").val();
		if (pass_lama == pass_baru) {
			$("button[name='button']").show();
			$('#notif_confirm_true').text('Password Sama');
			$('#notif_confirm_false').text('');
		} else {
			$("button[name='button']").hide();
			$('#notif_confirm_false').text('Password Tidak Sama');
			$('#notif_confirm_true').text('');
		}
	});
</script>