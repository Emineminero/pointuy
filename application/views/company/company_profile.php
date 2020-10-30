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
                                 CREATING COMPANY PROFILE
                              </header>
                          <div class="panel-body">

                            <!-----------CREATING COMPANY PROFILE Form Start------>

                              <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>company/CompanyController/add">
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="name" autocomplete="off" required>
                                      </div>
                                  </div>
                                   <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Company name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="company_name" autocomplete="off" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">RUT</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="rut" minlength="12"  autocomplete="off" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Country</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Uruguay" id="country_select" class="form-control"  autocomplete="off" name="country" required>
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
                                            <input type="text" placeholder="" class="form-control" name="town"  autocomplete="off" required>
                                        </div>
                                  </div>
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label">Postal code</label>
                                        <div class="col-sm-10">
                                            <input type="number" placeholder="" class="form-control" name="postal_code"  autocomplete="off">
                                        </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Telephone 1</label>
                                       <div class="col-sm-10">
                                          <input type="text" placeholder="" data-mask="(999) 999-9999" class="form-control" name="telephone"  autocomplete="off" required>
                                            <span class="help-inline">(999) 999-9999</span>
                                        </div>
                                  </div>
                                <!--   <div class="form-group">
                                      <label class="col-sm-2 control-label"></label>
                                       <div class="col-sm-10">
                                          <select name="contact_in_company" class="form-control" required>
                                            <option value="0">Yes</option>
                                            <option value="1">No</option>
                                          </select>
                                        </div>
                                  </div> -->
                                  <input type="hidden" id="count" value='0' />
                                  <div id="company_person">
                                    <div class="form-group" id="company_contact">
                                        <label class="col-sm-2 control-label label_contact">Contact in company</label>
                                        <div class="col-sm-2">

                                            <span class="help-inline">Contact Name</span>
                                            <input type="text" placeholder="John Doe"  class="form-control"  autocomplete="off" name="contact_name[]">
                                        </div>
                                        <div class="col-sm-2">
                                            <span class="help-inline">Contact Rank</span>
                                            <input type="text" placeholder="Rank"  class="form-control" name="contact_rank[]"  autocomplete="off">
                                        </div>
                                        <div class="col-sm-3">
                                              <span class="help-inline">Contact Email</span>
                                              <input type="email" placeholder="johndoe@email.com"  class="form-control" name="contact_email[]"  autocomplete="off">
                                        </div>
                                        <div class="col-sm-2">
                                          <span class="help-inline">Telephone</span>
                                          <input type="text" placeholder="(999) 999-999" data-mask="(999) 999-9999" class="form-control" name="contact_telephone[]"  autocomplete="off">
                                        </div>
                                        <div class="col-sm-1">

                                          <br>
                                          <a class="btn btn-primary btn-sm clone_btn">
                                             <i class="icon-expand-alt" style="font-size: 20px;"></i>
                                          </a> 
                                        </div>
                                    </div>
                                </div>
                                  <div class="form-group">
                               <!--        <label class="col-sm-2 control-label">Telephone / Internal</label>
                                       <div class="col-sm-10">
                                          <input type="text" placeholder="" data-mask="(999) 999-9999" class="form-control" name="contact_telephone">
                                            <span class="help-inline">(999) 999-9999</span>
                                        </div>
                                  </div> -->
                                <div class="form-group">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info btn" name="submit">Submit</button>
                                        <button type="reset" class="btn btn-danger btn">Cancel</button>
                                    </div>
                                </div>
                              </form>

                                <!-----------CREATING COMPANY PROFILE Form End------>

                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
