<?php //include_once('../header.php'); ?>

<section id="main-content">
	<section class="wrapper">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<section class="panel">
					<header class="panel-heading">Add Group</header>
                    <div class="panel-body">
                    	<form method="POST" action="<?php echo site_url('group/GroupController/save'); ?>">
                    		<div class="form-group">
                            	<label for="role">Role Name</label>
                                <input type="text" class="form-control" name="role" id="role"
                                value="<?php if(!empty($fields['role'])) echo htmlentities($fields['role'],ENT_QUOTES,'UTF-8',false); ?>"
                                placeholder="Enter Role Name" required />
                            </div>
						    <div class="form-group">
                            	<label for="permissions">Permission(s)</label>
                            	<?php
                            		$group_perms = !empty($fields['group_perms']) ? explode(',',$fields['group_perms']) : array();
                            		if(!empty($permissions))
                            		{
                            			foreach($permissions as $perm)
                            			{
                            				$selected = in_array($perm['id'],$group_perms) ? ' checked="checked" ' : '';
                            	?>
                            	<div class="checkboxes">
									<label class="label_check checkbox-perm" for="permissions">
										<input type="checkbox" name="groupPerms[]" <?php echo $selected; ?> value="<?php echo $perm['id'] ?>" />
										<?php echo $perm['perm_desc']; ?>
									</label>
								</div>

								<?php
									if(!empty($subpermissions[$perm['id']]))
            						{
            						?>
                                    <div style="margin-bottom: -15px;" class="sub-perm-section col-lg-12s well well-sm <?php echo
                                    empty($selected) ? 'hidden' : ''; ?>">
            						<?php
										foreach($subpermissions[$perm['id']] as $key => $value)
										{
									?>
                                 	<label class="subperm-chkbox checkbox-inline" for="subPermissions">
                                    	<input type="checkbox" class="hidden" value="unchecked" checked="checked"
                                    	name="subPermss[<?php echo $perm['id'] ?>][<?php echo $value['sub_perm_id']; ?>]" />
                                    	<input type="checkbox" id="subPermss[<?php echo $perm['id'] ?>][<?php echo $value['sub_perm_id']; ?>]"
                                    	class="main-chkbox" <?php echo !empty($fields['id']) &&
                                    	!empty($blocklist[$fields['id']][$perm['id']][$value['sub_perm_id']]) ? '' : 'checked="checked"'; ?>
                                    	name="subPermss[<?php echo $perm['id'] ?>][<?php echo $value['sub_perm_id']; ?>]" value="1" >
                                    	<?php echo $value['sub_perm_label']; ?>
                                    </label>

								<?php } ?>
								</div><br>
								<?php } } } ?>
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

<script>
//function selectPermission()
//{

//}
//selectPermission();
</script>
