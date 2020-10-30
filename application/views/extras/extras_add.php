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
                                  CREATION OF EXTRAS
                              </header>
                          <div class="panel-body">

                            <!-----------Employee Form Start------>

                              <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>extras/ExtrasController/add">
                                  
                                  
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Extras Category</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15" name="extras_category">
                                              <option disable>Select Category</option>
                                              <option value="0">Cafeteria</option>
                                              <option value="1">Parking</option>
                                              <option value="2">Frigobar</option>
                                              <option value="3">Reception</option>
                                              <option value="4">Others</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 col-sm-2 control-label">Extra name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" name="extra_name" placeholder="cafeteria etc" autocomplete="off" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Currency</label>
                                      <div class="col-lg-10">
                                          <select class="form-control m-bot15" name="currency_mode">
                                              <option value="0">Pesos Uruguayos</option>
                                              <option value="1">USD</option>
                                              <option value="2">A$</option>
                                              <option value="3">R$</option>
                                              <option value="4">€</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Unit price</label>
                                        <div class="col-sm-10">
                                            <input type="number" placeholder="" class="form-control" name="unit_price" autocomplete="off" step="any">
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