// $(function () {
	$("#resrvation_form").validate({
		rules: {
			"checkout_date": {
				required: function(element) {return ($("#checkout_date").val()!="");},
				checkout: "#checkin_date"
			},
			"checkin_date": {
				required: function(element) {return ($("#checkin_date").val()!="");},
				checkin: "#checkout_date"
			}, 
			submitHandler: function (form) { 
				alert('valid form submitted'); 
				return false; 
			}
		}
	});//validate()

	jQuery.validator.addMethod("checkout", function (value, element, params) {
		var start = $(params);
		if (!start.data('validation.running')) {
			$(element).data('validation.running', true);
			setTimeout($.proxy(
				function () {
				this.element(start);
			}, this), 0);
			setTimeout(function () {
				$(element).data('validation.running', false);
			}, 0);
		}
		return this.optional(element) || new Date(value) >= new Date(start.val());
	},'checkout date must be after the chech in date.');

	jQuery.validator.addMethod("checkin", function (value, element, params) {
		var end = $(params);
		if (!end.data('validation.running')) {
			$(element).data('validation.running', true);
			setTimeout($.proxy(
				function () {
				this.element(end);
			}, this), 0);
			setTimeout(function () {
				$(element).data('validation.running', false);
			}, 0);
		}
		return this.optional(element) || new Date(value) <= new Date(end.val());
	},'check in date must be before the checkout date.');
// });