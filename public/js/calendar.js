$(function(){
	$('button[name="delete_date"]').on('click', function() {
		const reserveDate = $(this).attr('data-date');
		$('#cancelDate').text(reserveDate);
		$('#deleteDate').val(reserveDate);
		const reservePart = $(this).text().trim();
		const reservePartId = $(this).attr('data-part');
		$('#cancelPart').text(reservePart);
		$('#deletePart').val(reservePartId);
		});

});
