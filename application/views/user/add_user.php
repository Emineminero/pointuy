

<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<section class="panel">
					<header class="panel-heading">Add User</header>
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
                    	<form method="POST" id="addUserForm" action="<?php echo site_url('user/UserController/save'); ?>">
                    		<div class="form-group">
                            	<label for="full_name">Full Name</label>
                                <input type="text" class="form-control" name="full_name" id="full_name" value="<?php echo !empty($fields['full_name']) ? $fields['full_name'] : ''; ?>" placeholder="Enter Full Name" required />
                            </div>
						    <div class="form-group">
                            	<label for="user_name">User Name</label>
                                <input type="text" class="form-control" name="user_name" id="user_name" value="<?php echo !empty($fields['user_name']) ? $fields['user_name'] : ''; ?>" placeholder="Enter User Name" required />
                            </div>
                            <div class="form-group">
                            	<label for="password">Password</label>
                                <input type="password" value="" autocomplete="off" id="pwd" name="password" class="form-control" placeholder="Enter Password" />
                            </div>
                            <div class="form-group">
                            	<label for="confirm_password">Confirm Password</label>
                                <input type="password" value="" autocomplete="off" id="pwd2" name="confirm_password" class="form-control" oninput="check(this)" placeholder="Re Enter Password"  />
                            </div>
                            <div class="form-group">
                            	<label for="sector">Sector</label>
                                <select class="form-control m-bot15" name="sector" id="sector" required>
									<option></option>
									<?php
										if(!empty($userRole))
										{
											foreach($userRole as $role)
											{
												$selected = "";
												if(!empty($fields['sector']) && $fields['sector'] == $role['id']) $selected = "selected";
									?>
									<option value="<?php echo $role['id']; ?>" <?php echo $selected; ?>><?php echo $role['role']; ?></option>
									<?php
											}
										}
									?>
							    </select>
                            </div>
                            <div class="form-group">
                            	<label for="site_login">Site Login</label>
                                <select class="form-control m-bot15" name="site_login" id="site_login" required>
									<option></option>
									<option value="1" <?php echo !empty($fields['site_login']) ? "selected" : "" ?>>Enabled</option>
									<option value="0" <?php echo empty($fields['site_login']) ? "selected" : "" ?>>Disabled</option>
							    </select>
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                            <input type="hidden" name="id" value="<?php if(!empty($fields['id'])) echo $fields['id']; ?>" />
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>

<?php // //include_once('footer.php'); ?>
