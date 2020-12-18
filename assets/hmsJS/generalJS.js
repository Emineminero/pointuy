function deleteItem($item, event) {
	if (!confirm("Are you sure want to delete " + $item + "?"))
	{
		event.preventDefault();
		return false;
	}
}

$("#user_name").on('change', function(event) {
	let userName = $(this).val();
	let sitebaseurl = $( "#sitebaseurl" ).val();
	let url = sitebaseurl + '/user/UserController/check_dupilcate_user_name';
	$.ajax({
  		url  : url,
  		method: "post",
  		data: { userName : userName },
  		dataType: "text"
	}).done(function( data ) {
		if(data > 0)
		{
			event.preventDefault();
			$("#user_name").val('');
			alert("username already exists. Kindly try another one.");
			return false;
		}
  	}).fail(function() {
    	alert( "something went wrong." );
  	});
});

var count = 0;
$( "#add_room" ).click(function()
{
	let html = "";
	let room_type = $( "#room_type" ).val();
	
	let cant = $( "#cant" ).val();
	let pax = $( "#pax" ).val();
	let field = (room_type == "") ? "room type" : (cant <= 0) ? " cant" : (pax <= 0) ? " pax" : "";
	if(field)
	{
		alert(field+" can't be empty kindly select value");
		return false;
	}
	else
	{
		var $added = 0;
		// count++;
		// $('input[name^="room_types"]').each( function() {
        	// if( room_type == $(this).val() )
        	// {
        		// alert(room_type+" already added. kindly add another one.");
        		// $added = 1;
        	// }
    	// });
    	if($added == 0)
    	{
			// alert(pax);
			$("#no_of_persons").attr({
			   "max" : pax,        // substitute your own
			   "min" : 0          // values (or variables) here
			});
			for(i = 1; i <= cant; i++)
			{
				count++;
				get_rooms(room_type,count);
				html += "<div class='room_row'>";
				html += "<div class='onerow'>";
				html += "<input type='text' class='form-control' id='room_type_name' name='room_type[]' value='"+room_type+"' readonly style='border:none;width: 120px;' />&nbsp;";
				html += "</div>";
				html += "<div class='onerow'>";
				html += "<p>May</p>&nbsp;";
				html += "</div>";
				html += "<div class='onerow'>";
				html += "<input type='number' class='form-control' id='no_of_persons' name='no_of_persons[]' min='0' max='"+ pax +"' value='0' style='width: 70px;' />&nbsp;";
				html += "</div>";
				html += "<div class='onerow'>";
				html += "<p>Bebe</p>&nbsp;";
				html += "</div>";
				html += "<div class='onerow'>";
				html += "<input type='number' class='form-control' name='no_of_bebe[]' min='0' value='0' style='width: 70px;' />&nbsp;";
				html += "</div>";
				html += "<div class='onerow'>";
				html += "<p>Cuna</p>&nbsp;";
				html += "</div>";
				html += "<div class='onerow'>";
				html += "<input type='number' class='form-control' name='no_of_cuna[]' min='0' value='0' style='width: 70px;' />&nbsp;";
				html += "</div>";
				html += "<div class='onerow'>";
				html += "<select class='' id='room_no"+count+"' name='room_nos[]' style='width: 180px;border: 1px solid #e2e2e4;box-shadow: none;color: #000;vertical-align: middle;border-radius: 4px;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;margin-top: -56px;z-index: 1;position: relative;height: 34px;'>";
				// html += "<option value=''>select room type</option>";
				html += "</select>";
				html += "</div>";
				// html += "<div class='onerow'>";
				// html += "<div class='room_no_dropdown'>";
                // html += "<ul>";
                // html += "</ul>";
                // html += "</div></div>";
				
				html += "<div class='onerow'>";
				html += "<i data-id='"+ count +"'  class='icon-trash delete' style='font-size: 24px;position: absolute;margin-top: -30px;color: red;'></i>&nbsp;";
				html += "</div>";
				
                html += "</div>";

				$("#room_details").append(html);
				html = "";
				// $( "#room_type" ).val('');
				// $( "#cant" ).val(0);
				// $( "#pax" ).val(0);
			}
		}
	}
});

$(document).on('click', '.delete', function(e) {
var val = $(this).data("id");
 // $('.room_row').remove();
 $(this).closest('.room_row').remove();
// alert(val);
});

$(document).on( 'keyup', "#room_no", function(){
	let room_no = $(this).val();
	let room_type = $(this).parents("div.room_row").find("#room_type_name").val();

	if(room_type == "" && room_no == "")
	{
		$('.country_dropdown_2 ul').html('');
	}
	else
	{
		$.ajax({
			url  : 'load_rooms_by_type',
			method: "post",
			data: { room_type : room_type, room_no : room_no },
			dataType: "text"
		}).done(function( data ) {
			if(data){
				$('.room_no_dropdown ul').html(data);
			$('.room_no_dropdown ul li').css('cursor','pointer');
			$('.room_no_dropdown ul li').click(function(){
				let room = $(this).text();
				$('#room_no').val(room);
				$('.room_no_dropdown').hide();
			});
			$('.room_no_dropdown').show();
			}
  		}).fail(function() {
    		alert( "error" );
  		});
	}
});

$("#charge_to, #bill_to, #extra_expense_to").change(function() {
	let bill = $(this).val();
	if(bill == 0)
	{
		alert("Select Charge Type.");
	}
	else
	{
		let bill_name = $(this).attr("name");
		if(bill == 3)
		{
			$("#"+bill_name+"_client").parent('div.form-group').show();
			$("#"+bill_name+"_company").parent('div.form-group').hide();
		}
		else if(bill == 4)
		{
			$("#"+bill_name+"_company").parent('div.form-group').show();
			$("#"+bill_name+"_client").parent('div.form-group').hide();
		}
	}
});

$("#check_duplicate_room_exist").on('change', function(event) {
	let room_nmber = $(this).val();
	console.log(room_nmber);
	$.ajax({
  		url  : 'check_dupilcate_room_no',
  		method: "post",
  		data: {room_nmber:room_nmber},
  		dataType: "text"
	}).done(function( data ) {
		//console.log(data);
		if(data > 0)
		{
			event.preventDefault();
			$("#check_duplicate_room_exist").val('');
			alert(room_nmber+" Room no already exists. Kindly try another one");
			return false;
		}
  	}).fail(function() {
    	alert( "error" );
  	});
});



$(document).on('input','#checkout_date',function(){
	let checkout_date = $(this).val();
	if(checkout_date != '')
	{
		let checkin_date = $('#checkin_date').val();
		if(checkin_date == '')
		{
			alert("kindly select checkin date");
			$(this).val('');
			return false;
		}
		else
		{
			const cin_date = new Date(checkin_date);
			const cout_date = new Date(checkout_date);
			const diffTime = Math.abs(cout_date - cin_date);
			const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
			$('#no_of_days').val(diffDays);
		}
	}
});

$(function () {
    $('#checkin_date').datepicker({
        onSelect: function(dateText, inst) {
          
            var today = new Date();
            today = Date.parse(today.getMonth()+1+'/'+today.getDate()+'/'+today.getFullYear());
            alert(today);
            
            var selDate = Date.parse(dateText);
            
            if(selDate < today) {
            
                $('#checkin_date').val('');
                $(inst).datepicker('show');
            }
        }
    });
	
	 $('#checkout_date').datepicker({
        onSelect: function(dateText, inst) {
          
            var today = new Date();
            today = Date.parse(today.getMonth()+1+'/'+today.getDate()+'/'+today.getFullYear());
            
            var selDate = Date.parse(dateText);
            
            if(selDate < today) {
            
                $('#checkout_date').val('');
                $(inst).datepicker('show');
            }
        }
    });
	
	 // $('#room_type_name')
});

// $(document).ready(function() {
   
// });

$(document).on('input','#no_of_days',function(){
	let no_of_days = $(this).val();
	if(no_of_days != '')
	{
		let checkin_date = $('#checkin_date').val();
		if(checkin_date == '')
		{
			alert("kindly select checkin date");
			$(this).val('');
			return false;
		}
		else
		{
			var newdate = new Date(checkin_date);
			newdate.setDate(newdate.getDate() + parseInt(no_of_days));
			var dd = newdate.getDate();
			var mm = newdate.getMonth() + 1;
			var y = newdate.getFullYear();
			var someFormattedDate = mm+'-'+dd+'-'+y;

			var someFormattedDate = y + '-' + mm + '-' + dd;
			$('#checkout_date').val(someFormattedDate);
		}
	}
});

function get_rooms(room_type,count){
	if(room_type){
		let baseurl = $( "#baseurl" ).val();
		let url = baseurl + 'reservation/ReservationController/loadRoom';
		$.ajax({
			type: "post",
			url: url,
			data: {room_type:room_type},
			success: function (response) {
				var htmlOptions = [];
				var toAppend = '';
				var data = JSON.parse(response);
				if( data.length >0){
					for( item in data ) {
						toAppend+='<option value="'+data[item].room_number +'">'+ data[item].room_number +'</option>';
						
						// html = '<option value="' + data[item].room_number + '">' + data[item].room_number + '</option>';
						// htmlOptions[htmlOptions.length] = html;
					}
					$("#room_no"+count).append(toAppend)
					// select.empty().append( htmlOptions.join('') );
				} else{
					toAppend+='<option value="-1">no item found</option>';
					$("#room_no"+count).append(toAppend)
				}
			},
			error: function(error) {
				alert('no data found.');
			}
		});
	}
}
$(document).on('click', '#charge_to', function(e) {
var val = $( this ).val();
if(val == '3'){
	$('#charge_to_clients').css("display", "block");
	$('#charge_to_companys').css("display", "none");
} else if(val == '4'){
	$('#charge_to_companys').css("display", "block");
	$('#charge_to_clients').css("display", "none");
} else {
	$('#charge_to_companys').css("display", "none");
	$('#charge_to_clients').css("display", "none");
}
});
$(document).on('click', '#bill_to', function(e) {
var val = $( this ).val();
if(val == '3'){
	$('#bill_to_clients').css("display", "block");
	$('#bill_to_companys').css("display", "none");
} else if(val == '4'){
	$('#bill_to_clients').css("display", "none");
	$('#bill_to_companys').css("display", "block");
} else {
	$('#bill_to_clients').css("display", "none");
	$('#bill_to_companys').css("display", "none");
}
});
