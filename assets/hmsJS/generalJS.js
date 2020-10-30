function deleteItem($item, event) {
	if (!confirm("Are you sure want to delete " + $item + "?"))
	{
		event.preventDefault();
		return false;
	}
}

$("#user_name").on('change', function(event) {
	let userName = $(this).val();
	$.ajax({
  		url  : 'check_dupilcate_user_name',
  		method: "post",
  		data: { userName : userName },
  		dataType: "text"
	}).done(function( data ) {
		if(data > 0)
		{
			event.preventDefault();
			$("#user_name").val('');
			alert("username already exists. Kindly try another one");
			return false;
		}
  	}).fail(function() {
    	alert( "error" );
  	});
});

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
		$('input[name^="room_types"]').each( function() {
        	if( room_type == $(this).val() )
        	{
        		alert(room_type+" already added. kindly add another one.");
        		$added = 1;
        	}
    	});
    	if($added == 0)
    	{
			for(i = 1; i <= cant; i++)
			{
				html += "<div class='room_row'><div class='onerow'>";
				html += "<input type='text' class='form-control' id='room_type_name' name='room_types[]' value='"+room_type+"' readonly style='border:none;width: 120px;' />&nbsp;";
				html += "</div>";
				html += "<div class='onerow'>";
				html += "<p>May</p>&nbsp;";
				html += "</div>";
				html += "<div class='onerow'>";
				html += "<input type='number' class='form-control' name='no_of_persons[]' min='0' value='0' style='width: 70px;' />&nbsp;";
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
				html += "<input class='form-control' id='room_no' name='room_nos[]' placeholder='room no' style='width: 120px;' />&nbsp;";
				html += "</div>";
				html += "<div class='onerow'>";
				html += "<div class='room_no_dropdown'>";
                html += "<ul>";
                html += "</ul>";
                html += "</div></div></div>";

				$("#room_details").append(html);
				html = "";
			}
		}
	}
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
			$('.room_no_dropdown ul').html(data);
			$('.room_no_dropdown ul li').css('cursor','pointer');
			$('.room_no_dropdown ul li').click(function(){
				let room = $(this).text();
				$('#room_no').val(room);
				$('.room_no_dropdown').hide();
			});
			$('.room_no_dropdown').show();
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

$(document).ready(function() {
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
});

$(document).ready(function() {
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
});





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
			console.log(someFormattedDate);
			//var someFormattedDate = y + '-' + mm + '-' + dd;
			var checkoutField = $('#checkout_date');
			checkoutField.datepicker('setDate',new Date(someFormattedDate));
		}
	}
});


























