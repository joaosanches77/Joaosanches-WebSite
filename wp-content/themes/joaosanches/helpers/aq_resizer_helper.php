<?php

function get_image_details($field_name,$post_id){
    $img_data = get_field($field_name,$post_id);
    return  wp_get_attachment_image_src($img_data['id'],'full');
}

function get_image_url($field_name,$post_id){
    $img_data = get_field($field_name,$post_id);
    $img = wp_get_attachment_image_src($img_data['id'],'full');
    return $img[0];
}