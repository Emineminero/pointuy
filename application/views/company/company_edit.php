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

            <?php //print_r($fields); ?>
              <div class="row">
                  <div class="col-lg-8 col-lg-offset-2">
                      <section class="panel">
                              <header class="panel-heading">
                                 EDIT COMPANY PROFILE
                              </header>

                          <div class="panel-body">

                            <!-----------CREATING COMPANY PROFILE Form Start------>


                              <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>company/CompanyController/updateCompany">
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">name</label>
                                      <div class="col-sm-10">
                                        <input type="hidden" class="form-control" name="id" value="<?php echo !empty($fields[0]['id']) ? $fields[0]['id']:""; ?>" required>
                                          <input type="text" class="form-control" name="name" value="<?php echo !empty($fields[0]['name']) ? $fields[0]['name']:""; ?>"  autocomplete="off" required>
                                      </div>
                                  </div>
                                   <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Company name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="company_name" value="<?php echo !empty($fields[0]['company_name'])?$fields[0]['company_name']:""; ?>"  autocomplete="off" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">RUT</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="rut" value="<?php echo !empty($fields[0]['rut'])?$fields[0]['rut']:""; ?>" minlength="12"  autocomplete="off" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Country</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Argentino" id="country_select" class="form-control" name="country" value="<?php echo !empty($fields[0]['country'])?$fields[0]['country']:""; ?>"  autocomplete="off" required>
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
                                      <label class="col-sm-2 control-label">Town</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="" class="form-control" name="town" value="<?php echo !empty($fields[0]['town'])?$fields[0]['town']:""; ?>"  autocomplete="off"required>
                                        </div>
                                  </div>
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Postal code</label>
                                        <div class="col-sm-10">
                                            <input type="number" placeholder="" class="form-control" name="postal_code" value="<?php echo !empty($fields[0]['postal_code'])?$fields[0]['postal_code']:""; ?>"  autocomplete="off">
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Telephone 1</label>
                                       <div class="col-sm-10">
                                          <input type="text" placeholder="" data-mask="(999) 999-9999" class="form-control" value="<?php echo !empty($fields[0]['telephone'])?$fields[0]['telephone']:""; ?>" name="telephone"  autocomplete="off" required>
                                        </div>
                                  </div>
                             <!--      <div class="form-group">
                                      <label class="col-sm-2 control-label">Contact in company</label>
                                       <div class="col-sm-10">
                                          <select name="contact_in_company" class="form-control" required>
                                            <option value="0" <?php //echo !empty($fields[0]['contact_in_company']==0) ? "selected":""; ?>>Yes</option>
                                            <option value="1" <?php //echo !empty($fields[0]['contact_in_company']==1)? "selected":""; ?>>No</option>
                                          </select>
                                        </div>
                                  </div> -->
                                  <div id="company_person">
                                    <?php 

                                     $data1=json_decode($fields[0]['contact_name']);
                                     $data2=json_decode($fields[0]['Rank']);
                                     $data3=json_decode($fields[0]['email']);
                                     $data4=json_decode($fields[0]['contact_telephone']);
                                     $count=count($data1);

                                     $data=array_merge($data1,$data2,$data3,$data4);
                                    
                                     
                                     for($i=0;$i<$count;$i++){
                                       

                                    ?>


                                    <div class="form-group" id="<?php echo 'company_contact'; ?>">
                                        <label class="col-sm-2 control-label label_contact">Contact in company</label>
                                        <div class="col-sm-2">
                                          <span class="help-inline">Contact Name</span>
                                            <input type="text" placeholder="John Doe"  class="form-control" name="contact_name[]"  autocomplete="off" value="<?php if($count==1){echo $data[$i]; }elseif($count==2){ echo $data[$i];} elseif($count==3){ echo $data[$i];} else{echo "";}?>">
                                        </div>
                                        <div class="col-sm-2">
                                          <span class="help-inline">Contact Rank</span>
                                            <input type="text" placeholder="Rank"  class="form-control" name="contact_rank[]"  autocomplete="off" value="<?php if($count==1){echo $data[$i+3]; } elseif($count==2){echo $data[$i+4]; } elseif($count==3){echo $data[$i+3];}else{ echo "";}?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <span class="help-inline">Contact Email</span>
                                              <input type="email" placeholder="johndoe@email.com"  class="form-control" name="contact_email[]"  autocomplete="off" value="<?php if($count==1){echo $data[$i+2]; }elseif($count==2){echo $data[$i+4]; } elseif($count==3){echo $data[$i+6];}else{ echo "";}?>">
                                        </div>
                                        <div class="col-sm-2">
                                           <span class="help-inline">Telephone</span>
                                          <input type="text" placeholder="johndoe@email.com"  class="form-control" name="contact_telephone[]"  autocomplete="off" value="<?php if($count==1){echo $data[$i+3]; } elseif($count==2){echo $data[$i+6]; } elseif($count==3){echo $data[$i+9];}else{ echo $data[$i+9];}?>">
                                        </div>
                                        <div class="col-sm-1">
                                          <br>
                                          <a class="btn btn-primary btn-sm clone_btn" <?php if($count==1){echo "";}elseif($count==2){echo "";}elseif($count==3){echo "style='display:none;'";}else{echo "";} ?>>
                                             <i class="icon-expand-alt" style="font-size: 20px;"></i>
                                          </a> 
                                        </div>
                                    </div>
                                  <?php    /* } */
                                          } 
                                      ?>
                                </div>
                           
                                <!--   <div class="form-group">
                                      <label class="col-sm-2 control-label">Telephone / Internal</label>
                                       <div class="col-sm-10">
                                          <input type="text" placeholder="" data-mask="(999) 999-9999" class="form-control" name="contact_telephone" value="<?php //echo !empty($fields[0]['contact_telephone'])?$fields[0]['contact_telephone']:""; ?>">
                                        </div>
                                  </div> -->
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info btn" name="submit">Submit</button>
                                        <button type="cancel" class="btn btn-danger btn">Cancel</button>
                                    </div>
                                </div>
                              </form>

                                <!-----------EDIT COMPANY PROFILE------>

                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->