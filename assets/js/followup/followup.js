
$(document).on("click", ".btn-upload", function(){
    var mcu_id = $(this).data('id');
    $("#form_id").val(mcu_id);
});

$(document).on("change", "#inputGroupFile02", function(){
    var fileName = $(this).val();
    var cleanFileName = fileName.replace('C:\\fakepath\\', " ");
    $(this).next('.custom-file-label').html(cleanFileName);
});

$("#withFileCheck").change(function() {
    if(this.checked) {
        $('#inputGroupFile02').prop('disabled', true);
    } else {
        $('#inputGroupFile02').prop('disabled', false);
    }
});