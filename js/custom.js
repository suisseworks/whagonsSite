// header active js

jQuery(function($) {
	var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
	$(".brk-nav ul li").each(function() {
		if ($(this).children().attr("href") == pgurl || $(this).children().attr("href") == '#') {
			$(this).addClass("active");
		} else if (pgurl == '') {
			$('.brk-nav ul li.home-menu').addClass("active");
		}

	});
	$(document).on('input', '.subscribe_mail', function() {
		var sub_wha = $('.subscribe_whagons');
		if ($(this).val() != '') {
			if(isEmail($(this).val())) {
				sub_wha.prop('disabled',false);
			} else {
				sub_wha.prop('disabled',true);
			}
		} else {
			sub_wha.prop('disabled',true);
		}
	});
	$(document).on('click', '.subscribe_whagons', function(e) {
		var email = $('.subscribe_mail').val();
		$.ajax({
			url: 'php/subscribe.php',
			type: 'POST',
			data: {
				email: email, 
			},
			dataType: "json",
			success: function( response ) {
				$('.subscribe_whagons').attr('Value','Please Wait...').prop('disabled', true);
				$('.msg_contact').removeClass('d-none');
				$('.msg_contact').html(response.msg);
				setTimeout( function(){
					$('.msg_contact').addClass('d-none');
					$('.brk_subscribe_footer').trigger('reset');

				}, 2000);

			}

		});

	});
	$(document).on('input', '.whagons_contacts', function() {
		var count = 0;
		var contact_whagons = $('.contact_whagons');
		$('.whagons_contacts').each(function() {
			if ($(this).val() != '') {
				count++;
			}
		});
		if (count == 5) {
			if(isEmail($('.whmail').val())) {
				contact_whagons.prop('disabled',false);
			} else {
				contact_whagons.prop('disabled',true);
			}

		} else {
			contact_whagons.prop('disabled',true);
		}

	});
	$(document).on('click', '.contact_whagons', function(e) {
		var name = $('.whname').val();
		var email = $('.whmail').val();
		var organization = $('.wh_org').val();
		var phone = $('.whphone').val();
		var consultation = $('.whconsultation').val();
		var whformtype = $('.whformtype').val();

		$("#loader").show();
		$("#contact-form").hide();
		
		$.ajax({
			url: 'php/sendmail.php',
			type: 'POST',
			data: {
				name: name,
				email: email, 
				organization: organization, 
				phone: phone, 
				consultation: consultation, 
				whformtype: whformtype, 
			},
			dataType: "json",
			success: function( response ) {

				if (response.result) {
					$("#loader").hide();
					$("#resultMessage").fadeIn();
				} else {
					console.log("************* ERROR ERROR *************");
					console.log(response);
				}
				
				setTimeout( function(){
					$("#contact-form").show();
					$('.msg_contact_whagons').addClass('d-none');
					$('.btn_whagons .brk-form-wrap').removeClass('brk-form-wrap-active');
					$('.btn_whagons').trigger('reset');
				}, 2000);
			}
		});
	});
});




function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

