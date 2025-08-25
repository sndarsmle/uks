<?php
function generateUUID() {
    $ci = &get_instance();
    return $ci->db->select('UUID() as uuid')->get()->row_object()->uuid;
}
?>
