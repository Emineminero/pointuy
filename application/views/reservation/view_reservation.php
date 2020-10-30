<section id="main-content">
	<section class="wrapper">
		<!-- page start-->
        <div class="row">
        	<div class="col-lg-12">
            	<section class="panel">
            		<header class="panel-heading">Groups</header>
					<div class="panel-body">
						<div class="adv-table">
							<table  class="display table table-bordered table-striped" id="example">
								<thead>
									<tr>
										<th>Id</th>
										<th>Reservation Number</th>
										<th>Reservation Name</th>
										<th>CheckIn Date</th>
										<th>CheckOut Date</th>
										<th>No of Days</th>
										<th>Sale Channel</th>
										<th>No of Rooms</th>
										<th>No of Persons</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if(!empty($fields))
									{
										foreach($fields as $field)
										{
											$url = 'reservation/ReservationController/add_reservation/'.$field['id'];
											$delete_url = 'reservation/ReservationController/delete_reservation/'.$field['id'];
								?>
								<tr class="">
									<td><?php echo $field['id'] ?></td>
									<td><?php echo $field['reservation_no'] ?></td>
									<td><?php echo $field['reservation_name'] ?></td>
									<td><?php echo $field['checkin_date'] ?></td>
									<td><?php echo $field['checkout_date'] ?></td>
									<td><?php echo $field['no_of_days'] ?></td>
									<td><?php echo $field['sale_channel'] ?></td>
									<td><?php echo $field['no_of_rooms'] ?></td>
									<td><?php echo $field['no_of_persons'] ?></td>
									<td class="center">
										<a  href="<?php echo site_url($url) ?>">
											<button type="button" class="btn btn-primary"><i class="icon-pencil"></i></button>
										</a>
										<a  href="<?php echo site_url($delete_url) ?>">
											<button type="button" class="btn btn-danger" onclick="deleteItem('group', event)"><i class="icon-trash"></i></button>
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
