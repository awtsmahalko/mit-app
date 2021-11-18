<form action="" method='POST' id='frm_submit' class="items">				
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
						<span class="input-group-addon"><strong>Name:</strong></span>
						<input type="text" class="form-control" name="item_name" id="item_name" required autocomplete='off'>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Description:</strong></span>
                        <textarea class="form-control" name="item_desc" id='item_desc' required autocomplete='off'></textarea>
					</div>
					<div class="input-group" style="padding:5px;">
						<span class="input-group-addon"><strong>Serial #:</strong></span>
						<input type="text" class="form-control" name="item_serial_no" id="item_serial_no" required autocomplete='off'>
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
