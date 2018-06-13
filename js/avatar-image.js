function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
            $('#imagePreviewEdit').css('background-image', 'url('+e.target.result +')');
            $('#imagePreviewEdit').hide();
            $('#imagePreviewEdit').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#image").change(function() {
    readURL(this);
});
$("#imageEdit").change(function() {
    readURL(this);
});