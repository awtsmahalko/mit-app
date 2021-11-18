<form action="" method='POST' id='frm_updatePassword'>				
	<div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel"><span class='fa fa-pencil'></span> Update Password</h4>
				</div>
				<div class="modal-body">
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Old Password:</strong></span>
						<input type="password" class="form-control" name="old_password" required autocomplete='off'>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>New Password:</strong></span>
						<input type="password" class="form-control" name="new_password" required autocomplete='off'>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Confirm New Password:</strong></span>
						<input type="password" class="form-control" name="confirm_new_password" required autocomplete='off'>
					</div>
				</div>
				<div class="modal-footer">
					<div class='btn-group'>
						<button type="submit" class="btn btn-primary btn-sm" id="btn_update_password"><span class='fa fa-check-circle'></span> Submit</button>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
