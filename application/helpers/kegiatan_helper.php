<?php
    function formatKegiatan($kegiatan){
        $name = "";
        switch ($kegiatan) {
            case 'MCU':
                $name = "Medical Check Up";
            break;
            case 'DCU':
                $name = "Dental Check Up";
            break;
            case 'SCR':
                $name = "Screening";
            break;
        }
        return "$name";
    }
?>
