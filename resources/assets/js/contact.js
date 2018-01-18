$(document).ready(function () {

	let url = "/contact";


	$("#showCreateContactModal").click((e) => {
		e.preventDefault();
		$('#name').val('');
		$('#surname').val('');
		$('#email').val('');
		$('#phone').val('');
		$('#contact_id').val('');
		$('.custom-fields').remove();
		$("#myModal").modal('show');
	});

	$(document).on('click', '.edit', function (e) {
		e.preventDefault();

		$('#name').val($(this).data('name'));
		$('#surname').val($(this).data('surname'));
		$('#email').val($(this).data('email'));
		$('#phone').val($(this).data('phone'));
		$('#contact_id').val($(this).data('contact'));
		$('.custom-fields').remove();
		if ($(this).data('cf')) {
			let cf_id = 0;
			$.each($(this).data('cf'), function (i, item) {
				cf_id++;
				let field = '<div class="form-group custom-fields">\n' +
					'                                            <label for="inputCf' + cf_id + '" class="col-sm-3 control-label">Custom Field ' + cf_id + '</label>\n' +
					'                                            <div class="col-sm-7">\n' +
					'                                                <input  type="text" class="form-control custom-fields-input" id="cf' + cf_id + '" name="cf' + cf_id + '"\n' +
					'                                                       placeholder="" value="' + item + '">\n' +
					'                                            </div>\n' +
					'<div class="col-sm-2"><a class="btn btn-default remove-btn">Remove</a></div>'
				'                                        </div>';

				$("#frmTasks").append(field);
			});
		}


		$("#myModal").modal('show');
	});

	$(document).on('click', '.remove-btn', function (e) {
		e.preventDefault();
		$(this).closest('div.form-group').remove();
	});


	$(document).on('click', '.delete', function (e) {
		e.preventDefault();

		var contact_id = $(this).data('id');

		$.ajax({
			type: "DELETE",
			url: url + '/' + contact_id,
			beforeSend: function (request) {
				request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="_token"]').attr('content'));
			},
			success: function (data) {

				$(".contact" + contact_id).remove();
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});

	});

	$("#btn-save").click(function (e) {


		e.preventDefault();

		let formData = {
			fname: $('#name').val(),
			lname: $('#surname').val(),
			email: $('#email').val(),
			phone: $('#phone').val(),
		};

		if ($('.custom-fields-input').length) {
			let cfi = {};
			$('.custom-fields-input').each(function (index) {
				cfi[$(this).val()] = $(this).val();
			});

			formData.extra_fields = cfi;
		}


		let type = "POST";
		let contact_id = $('#contact_id').val();
		let my_url = url;

		if (contact_id>0) {
			type = "PUT";
			my_url += '/' + contact_id;
		}

		$.ajax({
			type: type,
			url: my_url,
			data: formData,
			dataType: 'json',
			beforeSend: function (request) {
				request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="_token"]').attr('content'));
			},
			success: function (data) {

				let contact = '<tr class="contact' + data.id + '">\n' +
					'                                    <td class="fname">' + data.fname + '</td>\n' +
					'                                    <td class="lname">' + data.lname + '</td>\n' +
					'                                    <td class="email">' + data.email + '</td>\n' +
					'                                    <td class="phone">' + data.phone + '</td>\n' +
					'                                    <td>\n' +
					'                                        <a href="javascript: void(0)" class="edit"\n' +
					'                                           data-contact="' + data.id + '"\n' +
					'                                           data-name="' + data.fname + '"\n' +
					'                                           data-surname="' + data.lname + '"\n' +
					'                                           data-email="' + data.email + '"\n' +
					'                                           data-phone="' + data.phone + '"\n' +
					'                                           data-cf=\'' + data.extra_fields + '\'"\n' +
					'                                        >Edit</a>\n' +
					'                                        <a href="javascript: void(0)" class="delete btn-delete " data-id="' + data.id + '">Delete</a>\n' +
					'                                    </td>\n' +
					'                                </tr>'

				if (contact_id>0) {
					$(".contact" + contact_id).replaceWith(contact);
				} else {
					$('#contact-list tbody').append(contact);
				}


				$('#myModal').modal('hide')
			},
			error: function (data) {
				console.log('Error:', data);
			}
		});


	});


	$(".search-btn").click(function (e) {
		location.replace('/home?search=' + $("#search-text").val())
	});


	$('#add-custom-field').click(function (e) {
		e.preventDefault();

		let cf_id = $(this).data("cf-count");
		cf_id++;

		if ($("div.custom-fields").length<5) {

			let field = '<div class="form-group custom-fields">\n' +
				'                                            <label for="inputCf' + cf_id + '" class="col-sm-3 control-label">Custom Field ' + cf_id + '</label>\n' +
				'                                            <div class="col-sm-7">\n' +
				'                                                <input  type="text" class="form-control custom-fields-input" id="cf' + cf_id + '" name="cf' + cf_id + '"\n' +
				'                                                       placeholder="" value="">\n' +
				'                                            </div>\n' +
				'<div class="col-sm-2"><a class="btn btn-default remove-btn">Remove</a></div>'
			'                                        </div>';

			$("#frmTasks").append(field);
			$(this).data("cf-count", cf_id);
		}

	});

});
