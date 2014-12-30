
function previewImage(input) {
    var url = input.val();
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    files = input.get(0).files;
    if (files && files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.img-preview img').attr('src', e.target.result);
        }

        reader.readAsDataURL(files[0]);
    }else{
         $('.img-preview img').attr('src', '/assets/img/avatar.png');
    }
}

$(document).ready( function() {
    
    $('.btn-confirm').click(function() {
    	$('#confirmModal .modal-body').html($(this).attr('title'));
    	$('#confirmModal .btn-danger').attr('href',$(this).attr('href'));
    	$('#confirmModal').modal('show');
    	return false;
    });
    
    $('.goto').click(function() {
    	window.location.href = $(this).attr('data-goto');
    });

});
