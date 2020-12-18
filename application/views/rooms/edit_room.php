      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">


              <div class="row">
                  <div class="col-lg-8 col-lg-offset-2">

                              <?php 
                              
            if($this->session->flashdata('success')){
            ?>

            <div class="alert alert-success alert-block fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="icon-remove"></i>
                </button>
                    <strong>Success: </strong><?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } elseif($this->session->flashdata('error')) { ?>
                <div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="icon-remove"></i>
                    </button>
                    <strong>Ooops!!! </strong><?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
                      <section class="panel">
                              <header class="panel-heading">
                                  EDIT ROOM
                              </header>
                          <div class="panel-body">

                            <!-----------Employee Form Start------>

                              <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>room/RoomsController/updateRooms">
                                  
                                  
                                    <div class="form-group">
                                       <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Room No</label>
                                        <div class="col-lg-10">
                                          <input type="text" class="form-control" name="room_number" placeholder="" value="<?php echo !empty($fields[0]['room_number'])? $fields[0]['room_number']:""; ?>" autocomplete="off" required="" id="check_duplicate_room_exist">
                                          <input type="hidden" name="id" value="<?php echo !empty($fields[0]['id'])? $fields[0]['id']:""; ?>">
                                        </div>
                                     </div>
                                       <div class="form-group">
                                       <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Type Of Room</label>
                                        <div class="col-lg-10">
                                          <input type="text" class="form-control" name="room_type" placeholder="" value="<?php echo !empty($fields[0]['room_type'])? $fields[0]['room_type']:""; ?>" autocomplete="off">
                                        </div>
                                     </div>
									 
								  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Condition</label>
                                      <div class="col-sm-10">
                                          <select class="form-control m-bot15" name="room_condition">
                                              <option disabled>Select Room Condition</option>
                                               <option value="1" <?php if($fields[0]['room_condition']==1){echo "selected"; }else{echo ""; } ?>>Clean</option>
                                              <option value="2" <?php if($fields[0]['room_condition']==2){echo "selected"; }else{echo ""; } ?>>Dirty</option>
                                              <option value="3" <?php if($fields[0]['room_condition']==3){echo "selected"; }else{echo ""; } ?>>Semi Dirty</option>
                                              <!--<option value="4" <?php //if($fields[0]['room_condition']==4){echo "selected"; }else{echo ""; } ?>>Maintaince</option>-->
                                          </select>
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Status</label>
                                      <div class="col-sm-10">
                                          <select class="form-control m-bot15" name="room_status">
                                              <option disabled>Select Room Status</option>
                                               <option value="1" <?php if($fields[0]['room_status']==1){echo "selected"; }else{echo ""; } ?>>Available</option>
                                              <option value="2" <?php if($fields[0]['room_status']==2){echo "selected"; }else{echo ""; } ?> >Reserved</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Icon</label>
                                      <div class="col-sm-1">
                                          <input type="text" class="form-control" name="single_size" placeholder="" value="<?php echo !empty($fields[0]['single_size'])? $fields[0]['single_size']:""; ?>" autocomplete="off">
                                           <p class="help-block"><b>Single</b></p>
                                      </div>
                                      <div class="col-sm-1">
                                         <img alt="" width="40px" src="<?php echo base_url('assets/img/beds/single-bed.png');?>">
                                      </div>
                                       <div class="col-sm-1">
                                          <input type="text" class="form-control" name="double_size" placeholder="" value="<?php echo !empty($fields[0]['double_size'])? $fields[0]['double_size']:""; ?>" autocomplete="off">
                                           <p class="help-block"><b>Double</b></p>
                                      </div>
                                      <div class="col-sm-1">
                                         <img alt="" width="40px" src="<?php echo base_url('assets/img/beds/bed.png');?>">
                                      </div>
                                       <div class="col-sm-1">
                                          <input type="text" class="form-control" name="king_size" placeholder="" value="<?php echo !empty($fields[0]['king_size'])? $fields[0]['king_size']:""; ?>" autocomplete="off">
                                           <p class="help-block"><b>King</b></p>
                                      </div>
                                      <div class="col-sm-1">
                                         <img alt="" width="40px" src="<?php echo base_url('assets/img/beds/bed.png');?>">
                                      </div>
                                       <div class="col-sm-1">
                                          <input type="text" class="form-control" name="queen_size" placeholder="" value="<?php echo !empty($fields[0]['queen_size'])? $fields[0]['queen_size']:""; ?>" autocomplete="off">
                                           <p class="help-block"><b>Queen</b></p>
                                      </div>
                                      <div class="col-sm-1">
                                         <img alt="" width="40px" src="<?php echo base_url('assets/img/beds/bed.png');?>">
                                      </div>
                                  </div>
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info btn" name="submit">Submit</button>
                                        <button type="reset" class="btn btn-danger btn">Cancel</button>
                                    </div>
                                </div>
                              </form>

                                <!-----------Employee Form End------>

                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->