<section id="main-content">
	<section class="wrapper">
		<!-- page start-->
        <div class="row">
        	<div class="col-lg-12">
            	<section class="panel">
            		<header class="panel-heading">Hotels</header>
					<div class="panel-body">
						<div class="adv-table">
							<table  class="display table table-bordered table-striped" id="example">
								<thead>
									<tr>
										<th>Id</th>
										<th>Hotel Name</th>
										<th>Creation Date</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php
								 $this->db->select('*');
								$this->db->from('hotels');
								$this->db->order_by('hotel_id', 'ASC');
								$data=$this->db->get()->result_array();
									if(!empty($data))
									{
										foreach($data as $key => $field)
										{
											$url = 'hotels/HotelsController/add_hotel/'.$field['hotel_id'];
											$delete_url = 'hotels/HotelsController/delete_hotel/'.$field['hotel_id'];
											$date = date_create($field['creation_date']);
								?>
								<tr class="">
									<td><?php echo $key+1; //$field['hotel_id']; ?></td>
									<td><?php echo $field['hotel_name']; ?></td>
									<td><?php echo date_format($date,"F d, Y"); ?></td>
									<td class="center">
										<a  href="<?php echo site_url($url) ?>">
											<button type="button" class="btn btn-primary"><i class="icon-pencil"></i></button>
										</a>
										<a  href="<?php echo site_url($delete_url) ?>">
											<button type="button" class="btn btn-danger" ><i class="icon-trash"></i></button>
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
