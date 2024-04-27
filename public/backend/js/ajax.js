
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('body').on('submit', '#ajsuformreloads', function(e){
    e.preventDefault(); // Prevent the default form submission
    var formData = new FormData($(this)[0]); // Create FormData from the form
    var action = $(this).attr('action'); // Get the form action
    $.ajax({
        type: 'POST',
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        processData: false,
        url: action,
        error: function (jqXHR, textStatus, errorThrown) {
            const response = jqXHR.responseJSON;
            if (response && response.errors) {
                // Ensure you are accessing 'errors' correctly
                $.each(response.errors, function (key, value) {
                    $('#ajsuform_yu').html('<div class="alert alert-danger">' + value + '</div>');
                });
            } else {
                $('#ajsuform_yu').html('<div class="alert alert-danger">An unexpected error occurred.</div>');
            }
            $('#ajsuformreloads button').prop('disabled', false); // Ensure this ID is correct
        },
        success: function (data) {
            if (data.success) {
                location.reload(); // Reloads the page on success
            } else {
                // Show general error if 'errors' is not defined
                const errors = data.errors || 'An error occurred while processing your request.';
                $('#ajsuform_yu').html('<div class="alert alert-danger">' + errors + '</div>');
                $('#ajsuformreloads button').prop('disabled', false); // Ensure this ID is correct
            }
        }
    });

});

$('body').on('submit', '.ajsuformreloadedit', function(e){
    e.preventDefault();
    var num = $(this).attr('data-num');
    $('#ajsuform_yu_'+num).empty();
    $('#ajsuform_yu_'+num).html('<div class="fa-2x"><i class="fas fa-spinner fa-spin"></i></div>');
    var action = $(this).attr('action');
    var formData = new FormData($(this)[0]);
    $.ajax({
        type: 'POST',
        data: formData,
        async: true,
        cache: false,
        contentType: false,
        processData: false,
        url: action,
        error: function(data) {
            jQuery.each(data.errors, function(key, value){
                $('#ajsuform_yu_'+num).html('<div class="alert alert-danger">'+value+'</div>');
            });
        },
        success: function(data)
        {
            if(data.statusType)
            {
                location.reload();
            }
            else
            {
                $('#ajsuform_yu_'+num).html('<div class="alert alert-danger">'+data.errors+'</div>');
            }
        }
    });
    return false;
});

// image preview
$(".image").change(function() {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.image-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});
