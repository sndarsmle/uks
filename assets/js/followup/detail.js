$(document).on("click", ".tambah_followup_detail_button", function(){
    $(".typeLabel").text("Tambah");
    $(".typeSubmit").val("insert");

    $("#id").val("");
    $("#tgl_followup").val("");
    $("#respon").val("");
    $("input:radio[name=isfinish]").prop('checked', false);
});

$(document).on("click", ".ubah_followup_detail_button", function(){
    var id = $(this).data('id');
    var tgl_followup = $(this).data('tgl_followup');
    var respon = $(this).data('respon');
    var isfinish = $(this).data('isfinish');

    $(".typeLabel").text("Ubah");
    $(".typeSubmit").val("update");
    $("#id").val(id);
    $("#tgl_followup").val(tgl_followup);
    $("#respon").val(respon);
    $("input:radio[name=isfinish]").val([isfinish]);
});

$(document).on("click", ".hapus_followup_detail_button", function(){
    $(".typeSubmit").val("delete");

    var id = $(this).data('id');
    $("#id-delete").val(id);
});
