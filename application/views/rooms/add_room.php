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
                                  CREATION OF ROOMS
                              </header>
                          <div class="panel-body">

                            <!-----------Employee Form Start------>

                              <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>rooms/RoomsController/add">
                                  
                                  
                                    <div class="form-group">
                                       <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Room No</label>
                                        <div class="col-lg-10">
                                          <input type="text" class="form-control" name="room_number" placeholder="" autocomplete="off" required="" id="check_duplicate_room_exist">
                                        </div>
                                     </div>
                                       <div class="form-group">
                                       <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Type Of Room</label>
                                        <div class="col-lg-10">
                                          <input type="text" class="form-control" name="room_type" placeholder="" autocomplete="off">
                                        </div>
                                     </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Icon</label>
                                      <div class="col-sm-1">
                                          <input type="text" class="form-control" name="single_size" placeholder="" autocomplete="off">
                                           <p class="help-block"><b>Single</b></p>
                                      </div>
                                      <div class="col-sm-1">
                                         <i class="fa fa-bed" style="font-size:30px"></i>
                                      </div>
                                       <div class="col-sm-1">
                                          <input type="text" class="form-control" name="double_size" placeholder="" autocomplete="off">
                                           <p class="help-block"><b>Double</b></p>
                                      </div>
                                      <div class="col-sm-1">
                                         <i class="fa fa-bed" style="font-size:30px"></i>
                                      </div>
                                       <div class="col-sm-1">
                                          <input type="text" class="form-control" name="king_size" placeholder="" autocomplete="off">
                                           <p class="help-block"><b>King</b></p>
                                      </div>
                                      <div class="col-sm-1">
                                         <i class="fa fa-bed" style="font-size:30px"></i>
                                      </div>
                                       <div class="col-sm-1">
                                          <input type="text" class="form-control" name="queen_size" placeholder="" autocomplete="off">
                                           <p class="help-block"><b>Queen</b></p>
                                      </div>
                                      <div class="col-sm-1">
                                         <i class="fa fa-bed" style="font-size:30px"></i>
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