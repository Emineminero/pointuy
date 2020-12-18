<?php $this->load->view('header');?>

<section id="main-content">

	<section class="wrapper">

		<!-- page start-->

        <div class="row">

        	<div class="col-lg-12">

            	<section class="panel">
            		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search here" style="float: right; margin-right: 20px; margin-top: 5px; width: 250px;">

            		<header class="panel-heading">Maintenance</header>

					<div class="panel-body">

						<div class="adv-table">

							<table  class="display table table-bordered table-striped" id="example">

								<thead>

									<tr>

										<th>Id</th>

										<th>Room</th>

										<th>Task</th>

										<th>Status</th>

										<th>Creation Date</th>

										<th></th>

									</tr>

								</thead>

								<tbody>

								<?php

								$this->db->select('rooms.id as room_id,maintenance.id as main_id,maintenance.room_no,maintenance.hotel_id,maintenance.status,maintenance.task,maintenance.creation_date,rooms.room_number');

								$this->db->from('maintenance');

								$this->db->join('rooms', 'rooms.id = maintenance.room_no','left');

								// $this->db->order_by('id', 'ASC');

								$data=$this->db->get()->result_array();

								// echo"<pre>";

								// print_r($data);

								// exit;

									if(!empty($data)){

										foreach($data as $key => $field){

											$edit_url='maintenance/MaintenanceController/add_task?id='.$field['main_id'];

											$delete_url='maintenance/MaintenanceController/delete?id='.$field['main_id'].'&room_id='.$field['room_id'];

											$date = date_create($field['creation_date']);

								?>

								<tr class="">

									<td><?php echo $key+1;?></td>

									<td><?php echo $field['room_number']; ?></td>

									<td><?php echo $field['task'];?></td>

									<td><?php 

									if( $field['status'] == 0){

										$text = 'Processing';

									} else{

										$text = 'Fixed';

									}

									echo $text; ?></td>

									<td><?php echo date_format($date,"F d, Y");?></td>

									<td class="center">

										<a  href="<?php echo site_url($edit_url) ?>">

											<button type="button" class="btn btn-primary"><i class="icon-pencil"></i></button>

										</a>

										<a  href="<?php echo site_url($delete_url) ?>">

											<button type="button" class="btn btn-danger" onclick="deleteItem('user', event)"><i class="icon-trash"></i></button>

										</a>
										<a  href="<?php echo base_url(); ?>index.php/maintenance/MaintenanceController/add_task" class="deleteClass">

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