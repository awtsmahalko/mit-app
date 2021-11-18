<form action="" method='POST' id='frm_updateProfile'>				
	<div class="modal fade" id="updateProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel"><span class='fa fa-pencil'></span> Update Account</h4>
				</div>
				<div class="modal-body">
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>First Name:</strong></span>
						<input type="text" class="form-control" name="user_fname" value="<?php echo $_SESSION['user_fname']; ?>" required autocomplete='off'>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Middle Name:</strong></span>
						<input type="text" class="form-control" name="user_mname" value="<?php echo $_SESSION['user_mname']; ?>" required autocomplete='off'>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Last Name:</strong></span>
						<input type="text" class="form-control" name="user_lname" value="<?php echo $_SESSION['user_lname']; ?>" required autocomplete='off'>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Username:</strong></span>
						<input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username']; ?>" required autocomplete='off'>
					</div>
				</div>
				<div class="modal-footer">
					<div class='btn-group'>
						<button type="submit" class="btn btn-primary btn-sm" id="btn_update_profile"><span class='fa fa-check-circle'></span> Submit</button>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
