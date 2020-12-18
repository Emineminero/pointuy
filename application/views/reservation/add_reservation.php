<style>
.col-lg-2{
	width:auto !important;
}
</style>

<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">Add Reservation</header>
                    <div class="panel-body">
                    	<form method="POST" action="<?php echo site_url('reservation/ReservationController/save'); ?>" id="resrvation_form" novalidate="novalidate" enctype="multipart/form-data">
                    		<?php
                    			if(!empty($fields['id'])) {
                    		?>
                    		<div class="row">
                            	<label for="role" class="col-lg-2 control-label">Reservation Number</label>
                            	<div class="col-lg-4">
                                	<input type="text" class="form-control" name="reservation_no" value="<?php echo !empty($fields['reservation_no']) ?
                                	$fields['reservation_no'] : ''; ?>" readonly />
                                </div>
                            </div><br>
                            <?php } ?>
                    		<div class="row">
                            	<label for="role" class="col-lg-2 control-label">Reservation By Name</label>
                            	<div class="col-lg-4">
                                	<input type="text" class="form-control" name="reservation_name" value="<?php echo !empty($fields['reservation_name']) ?
                                	$fields['reservation_name'] : ''; ?>" placeholder="Enter Reservation Name" required />
                                </div>

                            	<label for="checkin_date" class="col-lg-2 control-label">checkIn Date</label>
                            	<div class="col-lg-4">
                                	<input type="date" class="form-control" id="checkin_date" name="checkin_date" value="<?php echo !empty($fields['checkin_date']) ?
                                	$fields['checkin_date'] : ''; ?>" required />
                                </div>
                            </div><br>
                            <div class="row">
                            	<label for="no_of_days" class="col-lg-2 control-label">No of Days</label>
                            	<div class="col-lg-4">
                                	<input type="number" class="form-control" id="no_of_days" name="no_of_days" min="0" value="<?php echo !empty($fields['no_of_days']) ?
                                	$fields['no_of_days'] : 0; ?>" required />
                                </div>

                            	<label for="checkout_date" class="col-lg-2 control-label">checkOut Date</label>
                            	<div class="col-lg-4">
                                	<input type="date" class="form-control" id="checkout_date" name="checkout_date" value="<?php echo !empty($fields['checkout_date']) ?
                                	$fields['checkout_date'] : ''; ?>" required />
                                </div>
                            </div><br>
                            <div class="row">
                            	<label for="sale_channel" class="col-lg-2 control-label">Sales Channel</label>
                            	<div class="col-lg-4">
									<select class="form-control m-bot15" name="sale_channel">
										<option value=""></option>
										<option value="Walk In" <?php echo (!empty($fields[0]['sale_channel']) && $fields[0]['sale_channel'] == "Walk In") ? "selected" : ''; ?> >Walk In</option>
										<option value="Mail" <?php echo (!empty($fields[1]['sale_channel']) && $fields[1]['sale_channel'] == "Mail") ? "selected" : ''; ?> >Mail</option>
										<option value="Telephone" <?php echo (!empty($fields[2]['sale_channel']) && $fields[2]['sale_channel'] == "Telephone") ? "selected" : ''; ?>>Telephone</option>
									</select>
								</div>

								<label for="extras" class="col-lg-2 control-label">Extras Included</label>
								<div class="col-lg-4">
									<label class="checkbox-inline" style="padding-left: 15px;">
										<input type="checkbox" name="extras[]" value="1" <?php echo (!empty($fields['extras']) && preg_match('/\b' . '1' . '\b/', $fields['extras'])) ? "checked" : ''; ?> > Breakfast
									</label>
									<label class="checkbox-inline" style="padding-left: 15px;">
										<input type="checkbox" name="extras[]" value="2" <?php echo (!empty($fields['extras']) && preg_match('/\b' . '2' . '\b/', $fields['extras'])) ? "checked" : ''; ?>>Lunch
									</label>
									<label class="checkbox-inline" style="padding-left: 15px;">
										<input type="checkbox" name="extras[]" value="3" <?php echo (!empty($fields['extras']) && preg_match('/\b' . '3' . '\b/', $fields['extras'])) ? "checked" : ''; ?>>Snack
									</label>
									<label class="checkbox-inline" style="padding-left: 15px;">
										<input type="checkbox" name="extras[]" value="4" <?php echo (!empty($fields['extras']) && preg_match('/\b' . '4' . '\b/', $fields['extras'])) ? "checked" : ''; ?>>Dinner
									</label>
									<label class="checkbox-inline" style="padding-left: 15px;">
										<input type="checkbox" name="extras[]" value="5" <?php echo (!empty($fields['extras']) && preg_match('/\b' . '5' . '\b/', $fields['extras'])) ? "checked" : ''; ?>>Parking
									</label>
								</div>
                            </div><br>

                            <div class="row">
                            	<label for="room_type" class="col-lg-2 control-label">Room Type</label>
                            	<div class="col-lg-2">
									<select class="form-control m-bot15" id="room_type" name="room_type">
										<option value="">select room type</option>
										<?php
											if(!empty($room_types))
											{
												foreach($room_types as $r_type)
												{
										?>
										<option value="<?php echo $r_type['room_type']; ?>"><?php echo $r_type['room_type']; ?></option>
										<?php
												}
											}
										?>
									</select>
								</div>

								<label for="cant" class="col-lg-1 control-label">Cant</label>
								<div class="col-lg-2">
									<input type="number" class="form-control" id="cant" name="cant" min="0" value="0" required />
								</div>

								<label for="pax" class="col-lg-1 control-label">Pax</label>
								<div class="col-lg-2">
									<input type="number" class="form-control" id="pax" name="pax" min="0" value="0" required />
								</div>
								<div class="col-lg-2">
									<input type="button" class="btn btn-success" id="add_room" value="Add" />
								</div>
                            </div><br>
                            <div id="room_details">
                            	<?php
                            		if(!empty($fields['reservation_details']))
                            		{
                            			$reservation_details = explode("@@",$fields['reservation_details']);
                            			foreach($reservation_details as $key=>$reservation)
                            			{
                            				$rooms = explode(",",$reservation);
                            	?>
                            	<div class='room_row'>
                            		<div class='onerow'>
										<input type='text' class='form-control' id='room_type_name' name='room_types[]' value="<?php echo
										!empty($rooms[0]) ? $rooms[0] : ''; ?>" readonly style='border:none;width: 120px;' />&nbsp;
									</div>
									<div class='onerow'>
										<p>May</p>&nbsp;
									</div>
									<div class='onerow'>
										<input type='number' class='form-control' id='no_of_persons' name='no_of_persons[]' min='0' value="<?php echo
										!empty($fields['no_of_persons']) ? $fields['no_of_persons'] : 0; ?>" style='width: 70px;' />&nbsp;
									</div>
									<div class='onerow'>
										<p>Bebe</p>&nbsp;
									</div>
									<div class='onerow'>
										<input type='number' class='form-control' name='no_of_bebe[]' min='0' value="<?php echo
										!empty($rooms[1]) ? $rooms[1] : 0; ?>" style='width: 70px;' />&nbsp;
									</div>
									<div class='onerow'>
										<p>Cuna</p>&nbsp;
									</div>
									<div class='onerow'>
									<input type='number' class='form-control' name='no_of_cuna[]' min='0' value="<?php echo
										!empty($rooms[2]) ? $rooms[2] : 0; ?>" style='width: 70px;' />&nbsp;
									</div>
									<div class='onerow'>
										<!--<input class='form-control' id='room_no' name='room_nos[]' value="<?php //echo !empty($rooms[4]) ? $rooms[4] : ''; ?>" placeholder='room no' style='width:
										120px;' />&nbsp;-->
										<select class='' id='room_no' name='room_nos[]' style='width: 180px;border: 1px solid #e2e2e4;box-shadow: none;color: #000;vertical-align: middle;border-radius: 4px;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;margin-top: -56px;z-index: 1;position: relative;height: 34px;'>
										<!--<script type='text/javascript'>get_rooms("<?php //echo $rooms[0];?>");</script>-->
										<option value='<?php echo !empty($rooms[4]) ? $rooms[4] : ''; ?>'><?php echo !empty($rooms[4]) ? $rooms[4] : ''; ?></option>
										</select>
									</div>
									<div class='onerow'>
											<i data-id='<?php echo $key;?>'  class='icon-trash delete' style='font-size: 24px;position: absolute;margin-top: -45px;color: red;'></i>
									</div>
                            	<?php
                            			}
                            		}
                            	?>
                            </div><br>

                            <div class="row">
                            	<label for="sale_channel" class="col-lg-2 control-label">Charge To</label>
                            	<div class="col-lg-4">
									<?php
										if(!empty($fields['charge_to']))
										{
											$charge_to = explode(",",$fields['charge_to']);
										}
										if(!empty($fields['bill_to']))
										{
											$bill_to = explode(",",$fields['bill_to']);
										}
										if(!empty($fields['extra_expense_to']))
										{
											$extra_expense_to = explode(",",$fields['extra_expense_to']);
										}
									?>
									<select class="form-control m-bot15" name="charge_to" id="charge_to">
										<option value=""></option>
										<option value="1" <?php echo (!empty($charge_to[0]) && $charge_to[0] == 1) ? 'selected' : ''; ?> >Main Guest</option>
										<option value="2" <?php echo (!empty($charge_to[0]) && $charge_to[0] == 2) ? 'selected' : ''; ?>>All Guest</option>
										<option value="3" <?php echo (!empty($charge_to[0]) && $charge_to[0] == 3) ? 'selected' : ''; ?>>Client</option>
										<option value="4" <?php echo (!empty($charge_to[0]) && $charge_to[0] == 4) ? 'selected' : ''; ?>>Company</option>
									</select>
								</div>
                            	<label for="sale_channel" class="col-lg-2 control-label">Bill To</label>
                            	<div class="col-lg-4">
									<select class="form-control m-bot15" name="bill_to" id="bill_to">
										<option value=""></option>
										<option value="1" <?php echo (!empty($bill_to[0]) && $bill_to[0] == 1) ? 'selected' : ''; ?> >Main Guest</option>
										<option value="2" <?php echo (!empty($bill_to[0]) && $bill_to[0] == 2) ? 'selected' : ''; ?>>All Guest</option>
										<option value="3" <?php echo (!empty($bill_to[0]) && $bill_to[0] == 3) ? 'selected' : ''; ?>>Client</option>
										<option value="4" <?php echo (!empty($bill_to[0]) && $bill_to[0] == 4) ? 'selected' : ''; ?>>Company</option>
									</select>
								</div>
                            </div><br>

                            <div class="row">
                            	<div id="charge_to_clients" style="display:none">
									<label for="charge_to_client" class="col-lg-2 control-label">Client Name</label>
									<div class="col-lg-4">
										<input type="text" class="form-control" name="charge_to_client" id="charge_to_client" value="" placeholder="Enter Client Name" />
									</div>
								</div>
								<div id="charge_to_companys" style="display:none">
									<label for="charge_to_company" class="col-lg-2 control-label">Company Name</label>
									<div class="col-lg-4">
										<input type="text" class="form-control" name="charge_to_company" id="charge_to_company" value="" placeholder="Enter Company Name" />
									</div>
								</div>

								<div id="bill_to_clients" style="display:none">
									<label for="bill_to_client" class="col-lg-2 control-label">Client Name</label>
									<div class="col-lg-4">
										<input type="text" class="form-control" name="bill_to_client" id="bill_to_client" value="" placeholder="Enter Client Name" />
									</div>
								</div>
								<div id="bill_to_companys" style="display:none">
									<label for="bill_to_company" class="col-lg-2 control-label">Company Name</label>
									<div class="col-lg-4">
										<input type="text" class="form-control" name="bill_to_company" id="bill_to_company" value="" placeholder="Enter Company Name" />
									</div>
								</div>
                            </div><br>

                            <div class="row">
                            	<label for="extra_expense_to" class="col-lg-2 control-label">Extra Expenses To</label>
                            	<div class="col-lg-4">
									<select class="form-control m-bot15" name="extra_expense_to" id="extra_expense_to">
										<option value=""></option>
										<option value="1" <?php echo (!empty($extra_expense_to[0]) && $extra_expense_to[0] == 1) ? 'selected' : ''; ?> >Main Guest</option>
										<option value="2" <?php echo (!empty($extra_expense_to[0]) && $extra_expense_to[0] == 2) ? 'selected' : ''; ?>>All Guest</option>
										<option value="3" <?php echo (!empty($extra_expense_to[0]) && $extra_expense_to[0] == 3) ? 'selected' : ''; ?>>Client</option>
										<option value="4" <?php echo (!empty($extra_expense_to[0]) && $extra_expense_to[0] == 4) ? 'selected' : ''; ?>>Company</option>
									</select>
								</div>
                            	<label for="deadline_date" class="col-lg-2 control-label">Deadline Date</label>
                            	<div class="col-lg-4">
                                	<input type="date" class="form-control" name="deadline_date" value="<?php echo !empty($fields['deadline_date']) ? $fields['deadline_date'] : ''; ?>" />
                            	</div>
                            </div><br>

                            <div class="row">
                            	<div id="extra_expenses_to_clients" style="display:none">
									<label for="extra_expenses_client" class="col-lg-2 control-label">Client Name</label>
									<div class="col-lg-4">
										<input type="text" class="form-control" name="extra_expense_to_client" id="extra_expense_to_client" value="" placeholder="Enter Client Name" />
									</div>
								</div>
								<div id="extra_expenses_to_companys" style="display:none">
									<label for="extra_expense_company" class="col-lg-2 control-label">Company Name</label>
									<div class="col-lg-4">
										<input type="text" class="form-control" name="extra_expense_to_company" id="extra_expense_to_company" value="" placeholder="Enter Company Name" />
									</div>
								</div>
                            </div><br>

                            <div class="row">
                            	<label for="time_of_arrival" class="col-lg-2 col-sm-2 control-label">Time of Arrival</label>
                            	<div class="col-lg-4">
                                	<input type="time" class="form-control" name="arrival_time" value="<?php echo !empty($fields['arrival_time']) ? $fields['arrival_time'] : ''; ?>" />
                            	</div>

                            	<label for="time_of_arrival" class="col-lg-2 control-label">Observation</label>
                            	<div class="col-lg-4">
                                	<textarea class="form-control" name="observation" rows="4"  ><?php echo !empty($fields['observation']) ? $fields['observation'] : ''; ?></textarea>
                            	</div>
                            </div><br>
                            <button type="submit" class="btn btn-info">Submit</button>
                            <input type="hidden" name="id" value="<?php if(!empty($fields['id'])) echo $fields['id']; ?>" />
                            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>" />
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>

<script>
//function selectPermission()
//{

//}
//selectPermission();
</script>
