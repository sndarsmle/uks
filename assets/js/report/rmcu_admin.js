$(document).on("click", ".export_rmcu_admin_button", function(){
    let url = window.location.href;
    if (/detailMCUSCR/i.test(url)) {
        url = url.replace(/detailMCUSCR/i, "exportRMCU")
    } else {
        url = url.replace(/detail/i, "exportRMCUAll")
    }
    window.location.replace(url);
});