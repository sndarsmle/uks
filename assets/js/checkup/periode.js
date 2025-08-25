$(document).on("click", ".tambah_periode_button", function(){
    $(".typeLabel").text("Tambah");
    $(".typeSubmit").val("insert");

    $("#name").val("");
    $("#date").val("");
});

$(document).on("click", ".ubah_periode_button", function(){
    var id = $(this).data('id');
    var name = $(this).data('name');
    var date = $(this).data('date');

    $(".typeLabel").text("Ubah");
    $(".typeSubmit").val("update");
    $("#id").val(id);
    $("#name").val(name);
    $("#date").val(date);
});

$(document).on("click", ".hapus_periode_button", function(){
    $(".typeSubmit").val("delete");

    var id = $(this).data('id');
    $("#id-delete").val(id);
});
