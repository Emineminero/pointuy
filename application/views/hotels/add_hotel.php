<?php
// echo"<pre>";
// print_r($fields);
// exit;

?>

<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<section class="panel">
					<header class="panel-heading"><?php echo !empty($fields['hotel_id']) ? 'Edit Hotel' : 'Add Hotel'; ?></header>
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
                    	<form method="POST" id="addHotelForm" action="<?php echo site_url('hotels/HotelsController/save_hotel'); ?>">
                    		<div class="form-group">
                            	<label for="hotel_name">Hotel Name</label>
                                <input type="text" class="form-control" name="hotel_name" id="hotel_name" value="<?php echo !empty($fields['hotel_name']) ? $fields['hotel_name'] : ''; ?>" placeholder="Enter Hotel Name" required />
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                            <input type="hidden" name="id" value="<?php if(!empty($fields['hotel_id'])){echo $fields['hotel_id']; }else{echo 0; } ?>" />
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>

<?php // //include_once('footer.php'); ?>
