    <section id="main-content">
          <section class="wrapper">

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

              <div class="row">
                  <div class="col-lg-8 col-lg-offset-2">
                      <section class="panel">
                              <header class="panel-heading">
                                  CREATION OF GUEST PROFILE
                              </header>
                          <div class="panel-body">

                            <!-----------Guest Form Start------>

                              <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>guest/GuestController/add">
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="guest_name" autocomplete="off" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Surname</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="guest_surname" autocomplete="off" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Sex</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15" name="sex" required>
                                              <option value="0">Male</option>
                                              <option value="1">Female</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Date of birth</label>
                                        <div class="col-sm-10">
                                            <input type="date" placeholder="" class="form-control" name="guest_dob" required>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Marital Status:(<span class="text-danger">*</span>)</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15" name="martial_status" required>
                                              <option value="0">SINGLE</option>
                                              <option value="1">MARRIED</option>
                                              <option value="2">DIVORCED</option>
                                              <option value="3">A-Viudo</option>
                                              <!--<option value="4">A</option>-->
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Nationality</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Uruguayo" class="form-control" name="nationality" autocomplete="off" id="country_select" required>
                                        </div>
                                  </div>

                                  <div class="form-group">
                                     <label class="col-sm-2 control-label"></label>
                                     <div class="col-sm-10">
                                        <div class="country_dropdown">
                                          <ul>
                                            
                                          </ul>
                                        </div>
                                     </div>
                                  </div>


                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Document Type</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15" name="guest_doc_type" required>
                                              <option value="0">CI</option>
                                              <option value="1">DCI PASSPORT</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Number</label>
                                          <div class="col-sm-10">
                                              <input type="text" placeholder="" data-mask="99999999999" class="form-control" name="number" autocomplete="off" required>
                                              <span class="help-inline">99999999999</span>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Country of expedition</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Uruguay" class="form-control" name="country_expedition" id="country_select_2" autocomplete="off" required>
                                        </div>
                                  </div>
                                  
                                   <div class="form-group">
                                     <label class="col-sm-2 control-label"></label>
                                     <div class="col-sm-10">
                                        <div class="country_dropdown_2">
                                          <ul>
                                            
                                          </ul>
                                        </div>
                                     </div>
                                  </div>
                                 <!--          <div class="form-group">
                                     <label class="col-sm-2 control-label"></label>
                                     <div class="col-sm-10">
                                        <div class="country_dropdown">
                                          <ul>
                                            
                                          </ul>
                                        </div>
                                     </div>
                                  </div> -->
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">City</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="New York" class="form-control" name="city" autocomplete="off">
                                        </div>
                                  </div>
                                   <div class="form-group">
                                      <label class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="address" rows="3"></textarea>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Telephone 1</label>
                                       <div class="col-sm-10">
                                          <input type="number" placeholder=""  class="form-control" name="telephone_1" autocomplete="off">
                                            <span class="help-inline">99999999999</span>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Telephone 2</label>
                                       <div class="col-sm-10">
                                          <input type="number" placeholder="" class="form-control" name="telephone_2" autocomplete="off">
                                            <span class="help-inline">99999999999</span>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="Email" placeholder="johndoe@email.com"  class="form-control" name="email" autocomplete="off">
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Company</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Microsoft"  class="form-control" name="company"autocomplete="off">
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Position</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Software Engineer"  class="form-control" name="position" autocomplete="off">
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Vehicle</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="BMW"  class="form-control" name="vehicle" autocomplete="off">
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Registration</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="BMW-1244"  class="form-control" name="registration" autocomplete="off">
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Observations</label>
                                        <div class="col-sm-10">
                                             <textarea class="form-control" cols="5" name="observations"></textarea>
                                        </div>
                                  </div>
                                 
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info btn" name="submit">Submit</button>
                                        <button type="cancel" class="btn btn-danger btn">Cancel</button>
                                    </div>
                                </div>
                              </form>

                                <!-----------Guesy Form End------>

                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>