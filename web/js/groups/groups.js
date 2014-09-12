$(document).ready(function(){
	$('#groupType, #groupLevel').change(function(){
		group.loadGroupsList();
	});
	
	$('#group').change(function(){
		if ($(this).val() == '0') {
			$('#btn_continue').attr('disabled', true);
		} else {
			$('#btn_continue').attr('disabled', false);
		}
	});

	$("#loading").ajaxStart(function(){
		$(this).addClass('loading');
	});
	$("#loading").ajaxStop(function(){
		$(this).removeClass('loading');
	});

	group.loadGroupsList();
});

group = {
	groupType : null,
	groupLevel: null,

	loadGroupsList: function() {
		group.groupType  = $('#groupType').val();
		group.groupLevel = $('#groupLevel').val();

		// disable submit
		$('#btn_continue').attr('disabled', true);

		// init group dropdown
		$('#group').empty();
		$('#group').prepend('<option value="0">Выберите группу...</option>');

		if (isNaN(group.groupType) || isNaN(group.groupLevel)) {
			return false;
		};

		// get groups
		$.ajax({
			method: 'POST',
			url: '/teacher/groups/getgroupsajax',
			data: 'groupType=' + group.groupType + '&groupLevel=' + group.groupLevel,
			dataType: 'json',
			success: function(data) {
				$.each(data, function(key, val) {
					$('#group').append('<option value="'+ key +'">'+ val +'</option>');
				});
			},
			error: function() {
				//alert('HTTP Request error');
			},
			beforeSend: function() {
				$('#group').attr('disabled', true);
			},
			complete: function() {
				$('#group').attr('disabled', false);
			}

		});
	}
	
};
