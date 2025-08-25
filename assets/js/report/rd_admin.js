$(document).on("click", ".export_rd_admin_button", function(){
    let url = window.location.href;
    url = url.replace(/detail/i, "exportRekapDokter")
    window.location.replace(url);
});