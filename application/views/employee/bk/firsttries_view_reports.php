<section id="main-content">
	<section class="wrapper">

		<!-- page start-->
        <div class="row">
        	<div class="col-lg-12">
            	<section class="panel">
            		<header class="panel-heading">Employees Documents</header>
					<select name="select1" id="dropDown" oninput="filterTable()">
					  <option value="All">All</option>
					  <option value="30">Last 30 days</option>
					  <option value="31">Next 30 dyays</option>
					</select>
					<div class="panel-body">
						<div class="adv-table">
							<table  class="display table table-bordered table-striped" id="table2" >
								<!--<thead>-->
									<tr>
										<!--<th>S.No#</th>-->
										<th>Employee</th>
										<th>Document</th>
										<th>Expiration date</th>
										<th>Days remaining </th>
									</tr>
								<!--</thead>
								<tbody>-->
								<?php   
									if(!empty($employees)) {
										foreach($employees as $employee){ 
										$document_name_arr = json_decode($employee['document_type'], true);
										$tmp = array_filter($document_name_arr);
										if(!empty($tmp)){
										?>
									<tr class="">
										<!--<td><?php //echo $i++; ?></td>-->
										<td><?php echo $employee['full_name']; ?></td>
										<td><?php 
												$doc_type_name = array("Health document"=>0,"Food Handling certificate"=>1,"Identity Card"=>2);
												// $document_name_arr = json_decode($employee['document_name'], true);
												$document_name_arr = json_decode($employee['document_type'], true);
												if(!empty($document_name_arr)){
													// $document_name = implode('</br>',$document_name_arr);
													$doc_type =   $document_name_arr['doc_type'];
													// echo $doc_type;echo"<br>";
													echo array_search($doc_type,$doc_type_name);echo"<br>";
													$doc_type2 = $document_name_arr['doc_type2'];
													echo array_search($doc_type2,$doc_type_name);echo"<br>";
													$doc_type3 = $document_name_arr['doc_type3'];
													echo array_search($doc_type3,$doc_type_name);echo"<br>";
												} else{
													echo $document_name = "You did not select a file to upload.";
												}
										?></td>
										<?php 
										
												$document_expiration_arr = json_decode($employee['document_expiration'], true);
												// echo"<pre>";
												// print_r($document_expiration_arr);
												
												if(!empty($document_expiration_arr)){
													echo"<td>";
														// $document_expiration = implode('</br>',$document_expiration_arr);
														if($document_expiration_arr['expire_date']){
															$document_expiration = date('d/m/Y', strtotime($document_expiration_arr['expire_date']));
														} else{
															$document_expiration = 'N/A';
														}		
														// $document_expiration = date('d/m/Y', strtotime($document_expiration_arr['expire_date']));
														echo $document_expiration;echo"<br>";
														
														if($document_expiration_arr['expire_date2']){
															$document_expiration2 = date('d/m/Y', strtotime($document_expiration_arr['expire_date2']));
														} else{
															$document_expiration2 = '';
														}
														// $document_expiration2 = date('d/m/Y', strtotime($document_expiration_arr['expire_date2']));
														echo $document_expiration2; echo"<br>";
														
														if($document_expiration_arr['expire_date3']){
															$document_expiration3 = date('d/m/Y', strtotime($document_expiration_arr['expire_date3']));
														} else{
															$document_expiration3 = '';
														}																
														// $document_expiration3 = date('d/m/Y', strtotime($document_expiration_arr['expire_date3']));
														echo $document_expiration3;echo"<br>";
														
													echo"</td>";
													echo"<td>";
														 $current_date = date("Y-m-d");
														if($document_expiration_arr['expire_date']){
															$exp1 = date('Y-m-d', strtotime($document_expiration_arr['expire_date']));
															$call = dateDiff($current_date,$exp1);
														} else{
															$call = 'N/A';
														}
														echo $call."<br>";  
														if($document_expiration_arr['expire_date2']){
															$exp2 = date('Y-m-d', strtotime($document_expiration_arr['expire_date2']));
															$call2 = dateDiff($current_date,$exp2);
														} else{
															$call2 = '';
														}
														echo $call2."<br>";  
														if($document_expiration_arr['expire_date3']){
															$exp3 = date('Y-m-d', strtotime($document_expiration_arr['expire_date3']));
															$call3 = dateDiff($current_date,$exp3);
														} else{
															$call3 = '';
														}
														echo $call3."<br>";  
														 
														 // $exp2 = date('Y-m-d', strtotime($document_expiration_arr['expire_date2']));
														 // $exp3 = date('Y-m-d', strtotime($document_expiration_arr['expire_date3']));
														// echo dateDiff($current_date,"2020-10-23")."<br>";  
														
														// echo dateDiff($current_date,$exp2)."<br>";  
														// echo dateDiff($current_date,$exp3)."<br>";  
														
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
										<?php }
										}
								}  else {?>
											<tr><td colspan="11">There are no records.</td></tr>
								<?php }?>
								<!--</tbody>-->
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

<script language="javascript" type="text/javascript">  
//<![CDATA[  
    // var table2_Props =  {  
                    // col_0: "select",  
                    // col_4: "none",  
                    // display_all_text: " [ Show all ] ",  
                    // sort_select: true  
                // };  
    // var tf2 = setFilterGrid( "table2",table2_Props );  
//]]>  
function filterTable() {
  // Variables
  let dropdown, table, rows, cells, country, filter;
  dropdown = document.getElementById("dropDown");
  table = document.getElementById("table2");
  rows = table.getElementsByTagName("tr");
  filter = dropdown.value;

  // Loops through rows and hides those with countries that don't match the filter
  for (let row of rows) { // `for...of` loops through the NodeList
    cells = row.getElementsByTagName("td");
    country = cells[1] || null; // gets the 2nd `td` or nothing
    // if the filter is set to 'All', or this is the header row, or 2nd `td` text matches filter
    if (filter === "All" || !country || (filter === country.textContent)) {
      row.style.display = ""; // shows this row
    }
    else {
      row.style.display = "none"; // hides this row
    }
  }
}
</script> 