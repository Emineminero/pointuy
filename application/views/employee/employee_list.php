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

		<!-- page start-->

        <div class="row">

        	<div class="col-lg-12">

            	<section class="panel">
            			<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search here" style="float: right; margin-right: 20px; margin-top: 5px; width: 250px;">
            		<header class="panel-heading">Employees</header>
            		

					<div class="panel-body">

						<div class="adv-table">

							<table  class="display table table-bordered table-striped" id="example">

								<thead>

									<tr>

										<!--<th>S.No#</th>-->

										<th>Profile Pic</th>

										<th>Full Name</th>

										<th>Telephone</th>

										<th>Email</th>

										<th>Address</th>

										<th>Action</th>

									</tr>

								</thead>

								<tbody>

								<?php





									if(!empty($fields))



									{



										$i=1;

										foreach($fields as $field)

										{



											$edit_url='employee/EmployeeController/editEmploye?id='.$field['id'];

											$delete_url='employee/EmployeeController/deleteEmploye?id='.$field['id'];

								?>

								<tr class="">

									<!--<td><?php //echo $i++; ?></td>-->

									<td><img src="<?php echo base_url().'uploads/'.$field['profile_pic']; ?>" style="max-width:60px;width:100%;border: 1px solid #b5b1b1;"></td>

									<td><?php echo $field['full_name']; ?></td>

									<td><?php echo $field['telephone_no']; ?></td>

									<td><?php echo $field['mail']; ?></td>

									<td><?php echo $field['physical_address']; ?></td>

									<td class="center">

										<a  href="<?php echo site_url($edit_url) ?>">

											<button type="button" class="btn btn-primary"><i class="icon-pencil"></i></button>

										</a>

										<a  href="<?php echo site_url($delete_url) ?>" class="deleteClass">

											<button type="button" class="btn btn-danger"><i class="icon-trash"></i></button>

										</a>
										<a  href="<?php echo base_url(); ?>index.php/employee/EmployeeController/add_new" class="deleteClass">

											<button type="button" class="btn btn-success"><i class="icon-plus"></i></button>

										</a>

									</td>

								</tr>

								<?php

										}

									}

								?>

								</tbody>

							</table>

						</div>

					</div>

				</section>

			</div>

		</div>

	</section>

</section>

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("example");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>