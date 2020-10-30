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

            <?php 

      /*          echo "</pre>";
                print_r($fields);
                echo "</pre>";*/
               

            ?>

              <div class="row">
                  <div class="col-lg-8 col-lg-offset-2">
                      <section class="panel">
                              <header class="panel-heading">
                                  EDIT EMPLOYEE PROFILE
                              </header>
                          <div class="panel-body">

                            <!-----------Employee Form Start------>

                              <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>employee/EmployeeController/updateEmployee" enctype="multipart/form-data" id="employe_form">
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Profile Image</label>
                                      <div class="col-sm-10">
                                        <img src="<?php echo base_url().'uploads/'.$fields[0]['profile_pic']; ?>" style="max-width:85px;width:100%;border: 1px solid #b5b1b1;">
                                        <input type="file" id="profile_pic" name="profile_pic" accept="image/*" autocomplete="off">
                                        <input type="hidden" name="old_profile" value="<?php echo !empty($fields[0]['profile_pic'])?$fields[0]['profile_pic']:""; ?>">
                                        <p class="help-block">Upload Profile Photo.</p>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Full name</label>
                                      <div class="col-sm-10">
                                        <input type="hidden" name="id" value="<?php echo $fields[0]['id']; ?>">
                                          <input type="text" class="form-control" name="full_name" value="<?php echo !empty($fields[0]['full_name'])?$fields[0]['full_name']:""; ?>"  autocomplete="off">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Sex</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15" name="sex" required>
                                              <option value="0" <?php echo empty($fields[0]['sex'])?"selected":""; ?>>Male</option>
                                              <option value="1" <?php echo !empty($fields[0]['sex'])?"selected":""; ?>>Female</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Date of birth</label>
                                        <div class="col-sm-10">
                                            <input type="date" placeholder="" value="<?php echo date('Y-m-d',strtotime($fields[0]['dob'])); ?>" class="form-control default-date-picker" name="dob"  autocomplete="off" required>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">I.D number</label>
                                          <div class="col-sm-10">
                                              <input type="text" placeholder=""  class="form-control" name="id_nos" maxlength="11" value="<?php echo !empty($fields[0]['id_no'])?$fields[0]['id_no']:""; ?>"  autocomplete="off" required>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Telephone 1</label>
                                       <div class="col-sm-10">
                                          <input type="number" placeholder="03301234567"  class="form-control" name="telephone_1" value="<?php echo !empty($fields[0]['telephone_no'])?$fields[0]['telephone_no']:""; ?>"  autocomplete="off" required>
                                           <!--  <span class="help-inline">03301234567</span> -->
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Telephone 2</label>
                                       <div class="col-sm-10">
                                          <input type="number" placeholder="03301234567"  class="form-control" name="telephone_2" value="<?php echo !empty($fields[0]['telephone_no2'])?$fields[0]['telephone_no2']:""; ?>"  autocomplete="off">
                                           <!--  <span class="help-inline">03301234567</span> -->
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Medical Coverage</label>
                                       <div class="col-sm-10">
                                          <input type="text" placeholder="Medical Coverage"  class="form-control" name="med_covrg" value="<?php echo !empty($fields[0]['medical_coverage'])?$fields[0]['medical_coverage']:""; ?>"  autocomplete="off" required>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="johndoe@email.com"  class="form-control" name="emp_email" value="<?php echo !empty($fields[0]['mail'])?$fields[0]['mail']:""; ?>"  autocomplete="off" required>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Physical Address</label>
                                        <div class="col-sm-10">
                                            <textarea name="physical_address" class="form-control" rows="5" required><?php echo !empty($fields[0]['physical_address'])?$fields[0]['physical_address']:""; ?></textarea>
                                        </div>
                                  </div>
                                  <?php $data=json_decode($fields[0]['document_type']);
                                        $data2=json_decode($fields[0]['document_expiration']);
                                        $data3=json_decode($fields[0]['document_name']); 
                                        
                                        ?>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Document One</label>
                                        <div class="col-sm-3">
                                              <select class="form-control m-bot15" name="doc_type">
                                                  <option value="0" <?php if($data->doc_type==0){echo "selected";}else{echo "";} ?>>Health document</option>
                                                  <option value="1" <?php if($data->doc_type==1){echo "selected";}else{echo "";} ?>>Food Handling certificate</option>
                                                  <option value="2" <?php if($data->doc_type==2){echo "selected";}else{echo "";}?>>Identity Card</option>
                                          </select>
                                             <p class="help-block">Document Type</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="date" placeholder="Expire date"  class="form-control" name="expire_date"  value="<?php echo date('Y-m-d',strtotime($data2->expire_date)); ?>">
                                            <p class="help-block">Expiration Date</p>
                                        </div>
                                        <div class="col-sm-3">
                                           <img src="<?php echo base_url().'uploads/'.$data3->doc_type; ?>" style="max-width:85px;width:100%;border: 1px solid #b5b1b1;">
                                            <input type="file" id="profile_pic" name="doc_pic" value="<?php echo $data3->doc_type; ?>">
                                            <input type="hidden" name="old_doc1" value="<?php echo $data3->doc_type; ?>">
                                            <!--<p class="help-block1">Upload Dacument Photo.</p>-->
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Document Two</label>
                                        <div class="col-sm-3">
                                              <select class="form-control m-bot15" name="doc_type_2">
                                                  <option value="0" <?php if($data->doc_type2==0){echo "selected";}else{echo "";} ?>>Health document</option>
                                                  <option value="1" <?php if($data->doc_type2==1){echo "selected";}else{echo "";} ?>>Food Handling certificate</option>
                                                  <option value="2" <?php if($data->doc_type2==2){echo "selected";}else{echo "";}?>>Identity Card</option>
                                          </select>
                                             <p class="help-block">Document Type</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="date" placeholder="Expire date"  class="form-control" name="expire_date2" value="<?php echo date('Y-m-d',strtotime($data2->expire_date2)); ?>">
                                            <p class="help-block">Expiration Date</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <img src="<?php echo base_url().'uploads/'.$data3->doc_type2; ?>" style="max-width:85px;width:100%;border: 1px solid #b5b1b1;">
                                            <input type="file" id="profile_pic" name="doc_pic2" value="<?php echo $data3->doc_type2; ?>">
                                            <input type="hidden" name="old_doc2" value="<?php echo $data3->doc_type2; ?>">
                                            <!--<p class="help-block3">Upload Dacument Photo.</p>-->
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Document Three</label>
                                        <div class="col-sm-3">
                                              <select class="form-control m-bot15" name="doc_type_3">
                                                   <option value="0" <?php if($data->doc_type3==0){echo "selected";}else{echo "";} ?>>Health document</option>
                                                  <option value="1" <?php if($data->doc_type3==1){echo "selected";}else{echo "";} ?>>Food Handling certificate</option>
                                                  <option value="2" <?php if($data->doc_type3==2){echo "selected";}else{echo "";}?>>Identity Card</option>
                                          </select>
                                             <p class="help-block">Document Type</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="date" placeholder="Expire date" class="form-control" name="expire_date3" value="<?php echo date('Y-m-d',strtotime($data2->expire_date3)); ?>">
                                            <p class="help-block">Expiration Date</p>
                                        </div>
                                        <div class="col-sm-3">
                                           <img src="<?php echo base_url().'uploads/'.$data3->doc_type3; ?>" style="max-width:85px;width:100%;border: 1px solid #b5b1b1;">
                                            <input type="file" id="profile_pic" name="doc_pic3">
                                            <input type="hidden" name="old_doc3" value="<?php echo $data3->doc_type3; ?>">
                                            <!--<p class="help-block2">Upload Dacument Photo.</p>-->
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
