$(function() {
	$('#singleFieldTags').tagit({
		availableTags: sampleTags,
	    singleField: true,
	    singleFieldNode: $('#mySingleField')
	});
});