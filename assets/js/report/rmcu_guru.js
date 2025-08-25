$(document).on("click", ".export_rmcu_guru_button", function(){
    let url = window.location.href;
    if (/detailMCUSCR2/.test(url)) {
        url = url.replace(/detailMCUSCR2/i, "exportRMCU2")
    } else {
        url = url.replace(/detailMCUSCR/i, "exportRMCU")
    }
    window.location.replace(url);
});