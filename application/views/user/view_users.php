<?php $this->load->view('header');?>

<section id="main-content">

	<section class="wrapper">

		<!-- page start-->

        <div class="row">

        	<div class="col-lg-12">

            	<section class="panel">
            		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search here" style="float: right; margin-right: 20px; margin-top: 5px; width: 250px;">

            		<header class="panel-heading">Groups</header>

					<div class="panel-body">

						<div class="adv-table">

							<table  class="display table table-bordered table-striped" id="example">

								<thead>

									<tr>

										<th>Id</th>

										<th>Full Name</th>

										<th>User Name</th>

										<th>Sector</th>

										<?php if($this->session->userdata['isSuperAdmin'] == 1){?>

										<th>Hotel Name</th>

									 <?php }?>

										<th></th>

									</tr>

								</thead>

								<tbody>

								<?php

								 $this->db->select('users.id,users.full_name,users.user_name,users.sector,users.deleted,user_role.id as roleId,user_role.role,hotels.hotel_name');

								$this->db->from('users');

								if($this->session->userdata['isSuperAdmin'] == 1){

									$this->db->where('users.sector',1);

								} else{

									$this->db->where('users.hotel_id', $this->session->userdata['hotel_id']);

								}

								$this->db->where('users.deleted',0);

								$this->db->join('user_role', 'user_role.id = users.sector','left');

								$this->db->join('hotels', 'hotels.hotel_id = users.hotel_id','left');

								$data=$this->db->get()->result_array();

								// echo"<pre>";

								// print_r($data);

								// exit;

									if(!empty($data))

									{

										foreach($data as $key=>$field)

										{

											$url = 'user/UserController/add_user/'.$field['id'];

											$delete_url = 'user/UserController/delete_user/'.$field['id'];

								?>

								<tr class="">

									<!--<td><?php //echo $field['id']; ?></td>-->

									<td><?php echo $key+1; ?></td>

									<td><?php echo $field['full_name']; ?></td>

									<td><?php echo $field['user_name']; ?></td>

									<td><?php echo $field['role']; ?></td>

									<?php if($this->session->userdata['isSuperAdmin'] == 1){?>

										<td><?php echo $field['hotel_name']; ?></td>

									 <?php }?>

									<td class="center">

									<?php if(($this->session->userdata['isSuperAdmin'] == 1 && $field['roleId'] == 1) || ($this->session->userdata['isSuperAdmin'] != 1 && $field['roleId'] != 1)){?>

										<a  href="<?php echo site_url($url) ?>">

											<button type="button" class="btn btn-primary"><i class="icon-pencil"></i></button>

										</a>

										<a  href="<?php echo site_url($delete_url) ?>">

											<button type="button" class="btn btn-danger" onclick="deleteItem('user', event)"><i class="icon-trash"></i></button>

										</a>

										<a  href="<?php echo base_url(); ?>index.php/user/UserController/add_user" class="deleteClass">

											<button type="button" class="btn btn-success"><i class="icon-plus"></i></button>
										</a>

										<?php }?>

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

<?php $this->load->view('footer');?>

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