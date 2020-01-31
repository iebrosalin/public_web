<?php
function p ($data, $bAdmin = false)
{
    global $USER;
    if ($USER->IsAdmin() || $bAdmin)
    {
        echo "<pre data-entity=\"debug\">";
        print_r($data);
        echo "</pre>";
    }
}
function _p ($data, $bAdmin = false)
{

        echo "<pre data-entity=\"debug\">";
        print_r($data);
        echo "</pre>";

}
function p_f ($data, $type = "w+")
{
    $fp = fopen($_SERVER["DOCUMENT_ROOT"].'/data.txt', $type);
    ob_start();

    print_r($data);

    $out = ob_get_clean();
    fwrite($fp, $out );
    fclose($fp);
}

