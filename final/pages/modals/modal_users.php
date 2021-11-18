<form action="" method='POST' id='frm_submit' class="users">
	<div class="modal fade" id="modalEntry" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Update Entry</h4>
					<input type="hidden" name="hidden_id" id="hidden_id" required>
					<input type="hidden" name="module" id="module" required>
				</div>
				<div class="modal-body">
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>First Name:</strong></span>
						<input type="text" class="form-control" name="user_fname" id="user_fname" required autocomplete='off'>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Middle Name:</strong></span>
						<input type="text" class="form-control" name="user_mname" id="user_mname" required autocomplete='off'>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Last Name:</strong></span>
						<input type="text" class="form-control" name="user_lname" id="user_lname" required autocomplete='off'>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Category:</strong></span>
						<select class='form-control' name='user_category' id='user_category' required>
							<option value="">-- Please select --</option>
							<!--<option value="S">Super admin</option>-->
							<option value="AA">Administrative Assistant</option>
							<option value="BAC">BAC</option>
							<option value="IO">Inspection Officer</option>
							<option value="PC">Property Custodian</option>
						</select>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Email:</strong></span>
						<input type="email" class="form-control" name="user_email" id="user_email" required autocomplete='off'>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Contact No:</strong></span>
						<input type="text" class="form-control" name="user_contact_no" id="user_contact_no" required autocomplete='off'>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Username:</strong></span>
						<input type="text" class="form-control" name="username" id='username' required autocomplete='off'>
					</div>
					<div class="input-group" style="padding:5px;" id='div_password'>
						<span class="input-group-addon"><strong>Password:</strong></span>
						<input type="password" class="form-control" id='password' name="password" required>
					</div>
				</div>
				<div class="modal-footer">
					<div class='btn-group'>
						<button type="submit" class="btn btn-primary btn-sm" id="btn_submit"><span class='fa fa-check-circle'></span> Submit</button>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<form action="" method='POST' id='frm_submit2' class="users">
	<div class="modal fade" id="modalEntry2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Assign Custodian</h4>
					<input type="hidden" name="module" value="assign-pc" required>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>ELEMENTARY</label>
						<select class='form-control select2' style="width: 100%;" name='cat[ELEM]' id='cat_elem' required>
						</select>
					</div>
					<div class="form-group">
						<label>JUNIOR HIGH SCHOOL</label>
						<select class='form-control select2' style="width: 100%;" name='cat[JHS]' id='cat_jhs' required>
						</select>
					</div>
					<div class="form-group">
						<label>SENIOR HIGH SCHOOL</label>
						<select class='form-control select2' style="width: 100%;" name='cat[SHS]' id='cat_shs' required>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<div class='btn-group'>
						<button type="submit" class="btn btn-primary btn-sm" id="btn_submit2"><span class='fa fa-check-circle'></span> Submit</button>
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>