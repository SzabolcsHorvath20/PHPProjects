<?php 

include ("classes.php");

$api = new site();
    $api->doctype();
    $api->html_start();
    $api->head_start();
    $api->title();
    $api->head_stop();
    $api->body_start();
        $time = new basic();
            $time->p_start();
            $time->ido();
            $time->p_stop();
    $api->body_stop();
    $api->html_stop();


 ?>