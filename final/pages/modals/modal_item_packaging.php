<form action="" method='POST' id='frm_submit2' class="items_packaging">				
	<div class="modal fade" id="modalAssignPckaging" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Assign Unit</h4>
					<input type="hidden" name="item_id" id="item_id" required>
				</div>
				<div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type='checkbox' onchange="checkAll(this, 'ip_id')"></th>
                                    <th>Unit</th>
                                    <th>Actual Qty</th>
                                </tr>
                            </thead>
                            <tbody id="assigned_packaging">
                            </tbody>
                        </table>
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
