
$(document).ready( function() {
	$('.btn-file :file').change(function() {
		previewImage($(this));
    });
});