     <!--main content start-->
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
                                  CREATION OF EMPLOYEE PROFILE
                              </header>
                          <div class="panel-body">

                            <!-----------Employee Form Start------>

                              <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>employee/EmployeeController/add" enctype="multipart/form-data" id="employe_form">
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Profile Image</label>
                                      <div class="col-sm-10">
                                        <input type="file" id="profile_pic" name="profile_pic" accept="image/*" >
                                        <p class="help-block">Upload Profile Photo.</p>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Full name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="full_name"  autocomplete="off">
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
                                            <input type="date" placeholder=""  class="form-control" name="dob" required>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">I.D number</label>
                                          <div class="col-sm-10">
                                              <input type="text" placeholder=""  class="form-control" name="id_nos" maxlength="11"  autocomplete="off" required>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Telephone 1</label>
                                       <div class="col-sm-10">
                                          <input type="number" placeholder="03301234567"  class="form-control" name="telephone_1"  autocomplete="off" required>
                                           <!--  <span class="help-inline">03301234567</span> -->
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Telephone 2</label>
                                       <div class="col-sm-10">
                                          <input type="number" placeholder="03301234567"  class="form-control" name="telephone_2"  autocomplete="off">
                                           <!--  <span class="help-inline">03301234567</span> -->
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Medical Coverage</label>
                                       <div class="col-sm-10">
                                          <input type="text" placeholder="Medical Coverage"  class="form-control" name="med_covrg"  autocomplete="off">
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" placeholder="johndoe@email.com"  class="form-control" name="emp_email"  autocomplete="off">
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Physical Address</label>
                                        <div class="col-sm-10">
                                            <textarea name="physical_address" class="form-control" rows="5" required>Employee Address</textarea>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Document One</label>
                                        <div class="col-sm-3">
                                              <select class="form-control m-bot15" name="doc_type">
                                                  <option value="0">Health document</option>
                                                  <option value="1">Food Handling certificate</option>
                                                  <option value="2">Identity Card</option>
                                          </select>
                                             <p class="help-block">Document Type</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="date" placeholder="Expire date"  class="form-control" name="expire_date">
                                            <p class="help-block">Expiration Date</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="file" id="profile_pic" name="doc_pic">
                                            <p class="help-block">Upload Dacument Photo</p>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Document Two</label>
                                        <div class="col-sm-3">
                                              <select class="form-control m-bot15" name="doc_type_2">
                                                  <option value="0">Health document</option>
                                                  <option value="1">Food Handling certificate</option>
                                                  <option value="2">Identity Card</option>
                                          </select>
                                             <p class="help-block">Document Type</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="date" placeholder=""  class="form-control" name="expire_date2">
                                            <p class="help-block">Expiration Date</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="file" id="profile_pic" name="doc_pic2">
                                            <p class="help-block">Upload Dacument Photo.</p>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Document Three</label>
                                        <div class="col-sm-3">
                                              <select class="form-control m-bot15" name="doc_type_3">
                                                  <option value="0">Health document</option>
                                                  <option value="1">Food Handling certificate</option>
                                                  <option value="2">Identity Card</option>
                                          </select>
                                             <p class="help-block">Document Type</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="date" placeholder="Expire date"  class="form-control" name="expire_date3">
                                            <p class="help-block">Expiration Date</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="file" id="profile_pic" name="doc_pic3">
                                            <p class="help-block">Upload Dacument Photo.</p>
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

                                <!-----------Employee Form End------>

                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->