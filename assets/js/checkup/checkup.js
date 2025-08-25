$(document).on("click", ".ubah_checkup_button", function () {
    var id = $(this).data('id');
    var kuku = $(this).data('kuku');
    var ket_kuku = $(this).data('ket_kuku');
    var telinga = $(this).data('telinga');
    var ket_telinga = $(this).data('ket_telinga');
    var mulut = $(this).data('mulut');
    var ket_mulut = $(this).data('ket_mulut');
    var hidung = $(this).data('hidung');
    var ket_hidung = $(this).data('ket_hidung');
    var kulit = $(this).data('kulit');
    var ket_kulit = $(this).data('ket_kulit');

    $(".typeSubmit").val("update");
    $("#id").val(id);
    $("input:radio[name=kuku]").val([kuku]);
    $("#ket_kuku").val(ket_kuku);
    $("input:radio[name=telinga]").val([telinga]);
    $("#ket_telinga").val(ket_telinga);
    $("input:radio[name=mulut]").val([mulut]);
    $("#ket_mulut").val(ket_mulut);
    $("input:radio[name=hidung]").val([hidung]);
    $("#ket_hidung").val(ket_hidung);
    $("input:radio[name=kulit]").val([kulit]);
    $("#ket_kulit").val(ket_kulit);
});
