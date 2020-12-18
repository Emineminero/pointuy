

<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<section class="panel">
					<header class="panel-heading"><?php echo !empty($fields['id']) ? 'Edit' : 'Add'; ?> Task</header>
                    <div class="panel-body">
                        <?php
                        	if ($this->session->flashdata('errors'))
    						{
    							echo '<div class="alert alert-danger fade in">';
    							echo '<button data-dismiss="alert" class="close close-sm" type="button">';
    							echo '<i class="icon-remove"></i>';
    							echo '</button>';
    							echo '<strong>'.$this->session->flashdata('errors').'</strong>';
    							echo '</div>';
    						}
					    ?>
                    	<form method="POST" id="addmaintenceForm" action="<?php echo site_url('maintenance/MaintenanceController/save_task'); ?>">
						
                    		 <div class="form-group">
								  <label class="col-sm-2 col-sm-2 control-label">Rooms</label>
								  <div class="col-sm-10">
									  <select class="form-control m-bot15" name="room">
										  <option disabled>Select Room</option>
										  <?php if(empty($fields['id'])){?>
											  <?php if(!empty($rooms)){
												foreach($rooms as $r_type){?>
												<option value="<?php echo $r_type['id']; ?>"><?php echo $r_type['room_number']; ?></option>
												<?php
														}
													}
												?>
											<?php } else{?>
											 <?php if(!empty($rooms)){
												foreach($rooms as $r_type){?>
												<option value="<?php echo $r_type['id']; ?>" <?php if($r_type['id'] == $fields['room_no']){echo "selected"; }else{echo ""; } ?>><?php echo $r_type['room_number']; ?></option>
												<?php
														}
													}
												?>
											<?php }?>
									  </select>
								  </div>
							  </div>
								
						    <div class="form-group">
							   <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Task To Do</label>
								<div class="col-lg-10">
								  <input type="text" class="form-control" name="task_to_do" placeholder="" value="<?php echo !empty($fields['task'])? $fields['task']:""; ?>" autocomplete="off">
								</div>
							 </div>
							<div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Status</label>
                                      <div class="col-sm-10" style="margin-top: 15px;">
                                          <select class="form-control m-bot15" name="status">
                                              <option disabled>Select Maintenance status</option>
											  <?php
											   if(empty($fields['id'])){?>
												  <option value="0" selected>Processing</option>
											 <?php } else {?>
											  <option value="0" <?php if($fields['status']==0){echo "selected"; }else{echo ""; } ?>>Processing</option>
                                              <option value="1" <?php if($fields['status']==1){echo "selected"; }else{echo ""; } ?>>Fixed</option>
											 <?php }?>
                                          </select>
                                      </div>
                                  </div>
                            <button type="submit" class="btn btn-info">Submit</button>
							<input type="hidden" name="id" value="<?php if(!empty($fields['id'])){echo $fields['id']; }else{echo 0; } ?>" />
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
