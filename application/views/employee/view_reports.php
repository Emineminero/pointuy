<style>
.drop-down {
	 border: 1px solid #e2e2e4;
    box-shadow: none;
    color: #000;
    font-size: 14px;
    line-height: 1.428571429;
    vertical-align: middle;
    background-color: #fff;
    background-image: none;
    border-radius: 4px;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    margin-top: 70px;
    margin-bottom: -50px;
    margin-right: 15px;
    width: 26%;
    z-index: 1;
    position: relative;
}
</style>

<section id="main-content">
	<section class="wrapper">

		<!-- page start-->
        <div class="row">
        	<div class="col-lg-12">
					<select class="drop-down dataTables_filter" name="select1" id="dropDown">
					  <option value="1">All</option>
					  <option value="30">Next 30 days</option>
					</select>
					<input type="hidden" name="selectedItem" id="selectedItem"/>
            	<section class="panel">
            		<header class="panel-heading">Employees Documents</header>
					<div class="panel-body">
						<div class="adv-table">
							<table id="documents_table" class="display table table-bordered table-striped" style="width:100%">
								<thead>
									<tr>
										<!--<th>S.No#</th>-->
										<th class="nosort">Employee</th>
										<th class="nosort">Document</th>
										<th class="nosort">Expiration date</th>
										<th class="nosort">Days remaining </th>
									</tr>
								</thead>
								<tbody>
									<?php   
									if(!empty($employees)) {
										foreach($employees as $employee){ 
										$document_name_arr = json_decode($employee['document_type'], true);
										$tmp = array_filter($document_name_arr);
										if(!empty($tmp)){
											$current_date = date("Y-m-d");
											$document_types = json_decode($employee['document_type'], true);
											$doc_type_name = array("Health document"=>0,"Food Handling certificate"=>1,"Identity Card"=>2);
											foreach($document_types as $key => $document_type){ 
										?>
									<tr class="">
										<!--<td><?php //echo $i++; ?></td>-->
										<td><?php echo $employee['full_name']; ?></td>
										<?php
											$filter =array_search($document_type,$doc_type_name);
											if($filter){
												echo "<td>".$filter."</td>";
											} else{
												echo "<td>You did not select a file to upload</td>";
											}
										?>
										<?php 
										
												$document_expiration_arr = json_decode($employee['document_expiration'], true);
												if(!empty($document_expiration_arr)){
													$after_replc = str_replace("doc_type","expire_date",$key);
													echo"<td>";
														$document_expiration = date('d/m/Y', strtotime($document_expiration_arr[$after_replc]));
														echo $document_expiration;
													echo"</td>";
													echo"<td>";
														$exp = date('Y-m-d', strtotime($document_expiration_arr[$after_replc]));
														$call = dateDiff($current_date,$exp);
														echo $call;
													echo"</td>";
												} else{
													echo"<td>";
														echo $document_expiration = "N/A";
													echo"</td>";
													echo"<td>";
														echo $document_expiration = "N/A";
													echo"</td>";
												}
										?>
									</tr>
										<?php }}
										}
								}  else {?>
											<tr><td colspan="11">There are no records.</td></tr>
								<?php }?>
								</tbody>
							</table>
						</div>
					</div>
				</section>
			</div>
		</div>
		
	</section>
</section>

<?php

function dateDiff($start, $end) {
	$start_ts = strtotime($start);
	$end_ts = strtotime($end);
	$diff = $end_ts - $start_ts;
	$day = abs(round($diff / 86400));
	if( $start > $end){
		$pre_fix = "Endded ";
		$post_fix = "ago";
	}else{
		$pre_fix= "";
		$post_fix= " remain";
	}
	if($day > 1){
		$text = " days ";
	} else{
		$text = " day ";
	}
	$day_text = $pre_fix.$day.$text.$post_fix;
	return $day_text;
}

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript">  
// $(document).ready(function(){	
	// $('#documents_table_filter').css('display','none');
// });

 var  table =$('#documents_table').dataTable({
	'aoColumnDefs': [{
        'bSortable': false,
        'aTargets': ['nosort']
    }],
 });
 $('#dropDown').on('change',function(){
	var selectedValue = $(this).val();
	$('#selectedItem').val(selectedValue);
	 if(selectedValue == "30"){
		 var dt =getFutureDate( 30 );
		  // table.draw();
		   table.fnFilter('');
		  table.fnDraw();
	  } 
	  else{
		   // table.fnDestroy();
		    // table.fnDraw();
			location.reload(true);
	  }
});
// $(document).ready(function(){
	$('#documents_table_filter').css('display','none');
	// $('#dropDown').val(1).change();
	// $("#Status").val(2).change();
	// $('#dropDown [value=1]').attr('selected', 'true');
// });
$.fn.dataTableExt.afnFiltering.push(
	function( oSettings, aData, iDataIndex ) {
		var myselectedValue = $('#selectedItem').val();
		// debugger;
		if(myselectedValue == "30"){
			var dtMin = getFutureDateFor( -1 );
			var dtMax = getFutureDateFor( 30 );
		// } 
		// else{
			// var dtMin = getFutureDateFor( -365 );
			// var dtMax = getFutureDateFor( 365 );
		// }
			// dateMin = dtMin.substring(0,2) + dtMin.substring(3,5) + dtMin.substring( 6,10 );
			// dateMax = dtMax.substring(0,2) + dtMax.substring(3,5) + dtMax.substring( 6,10 );

			dateMin = new Date(dtMin);
			dateMax = new Date(dtMax);

			// 4 here is the column where my dates are.
			var date = aData[2];
			var mydd = date.substring(0,2);
			var myMM = date.substring(3,5);
			var myYY = date.substring( 6,10 );
			var custom = myMM +"-"+ mydd +"-"+ myYY;
			date = new Date(custom);
			if (
			(dateMin == "" || dateMax == "") ||
			(moment(date).isSameOrAfter(dateMin) && moment(date).isSameOrBefore(dateMax))
			) {
			return true;
			}
			return false;
		}
	}
);

function getFutureDate( days ) {
    var millies = 1000 * 60 * 60 * 24 * days;
    var todaysDate = new Date();
    var futureMillies = todaysDate.getTime() + millies;
	var dt = new Date( futureMillies );
	var dd = dt.getDate();
	var mm = dt.getMonth()+1; 
	var yyyy = dt.getFullYear();
	if(dd<10) {
		dd='0'+dd;
	} 
	if(mm<10) {
		mm='0'+mm;
	} 
	var formated_date = dd+'/'+mm+'/'+yyyy;
    return formated_date;
}


function getFutureDateFor( days ) {
    var millies = 1000 * 60 * 60 * 24 * days;
    var todaysDate = new Date();
    var futureMillies = todaysDate.getTime() + millies;
	var dt = new Date( futureMillies );
	var dd = dt.getDate();
	var mm = dt.getMonth()+1; 
	var yyyy = dt.getFullYear();
	if(dd<10) {
		dd='0'+dd;
	} 
	if(mm<10) {
		mm='0'+mm;
	} 
	var formated_date = mm+'-'+dd+'-'+yyyy;
    return formated_date;
}
</script> 