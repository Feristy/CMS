$(document).ready(function(){
	$('.reply').click(function(){
		var id = $(this).attr('data-id');
		$('.parent-comment').val(id);
	});
});