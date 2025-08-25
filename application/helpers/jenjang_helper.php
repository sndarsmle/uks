<?php
    function formatJenjang($jenjang){
        $name = "";
        switch ($jenjang) {
            case 00:
                $name = "DC";
            break;
            case 11:
                $name = "KB";
            break;
            case 22:
                $name = "TK";
            break;
            case 33:
                $name = "SD";
            break;
            case 44:
                $name = "SMP";
            break;
            case 55:
                $name = "SMA";
            break;
            default:
                $name = "-";
        }
        return $name;
    }
