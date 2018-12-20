<?php



function admin_Url(){
    $ci = &get_instance();
    $temp_admin_Url = base_url("systemaccess");
    return $temp_admin_Url;
}
function student_Url(){
    $ci = &get_instance();
    $temp_student_Url = base_url("e_student");
    return $temp_student_Url;
}
function teacher_Url(){
    $ci = &get_instance();
    $temp_teacher_Url = base_url("e_teacher");
    return $temp_teacher_Url;
}

function acc_Url(){
    $ci = &get_instance();
    $temp_crs_Url = base_url("accounts_admin");
    return $temp_crs_Url;
}

function parents_Url(){
    $ci = &get_instance();
    $temp_parents_Url = base_url("parents");
    return $temp_parents_Url;
}
function register_Url(){
    $ci = &get_instance();
    $temp_register_Url = base_url("register");
    return $temp_register_Url;
}
function accountant_Url(){
    $ci = &get_instance();
    $temp_accountant_Url = base_url("accountant");
    return $temp_accountant_Url;
}
function adminaccountant_Url(){
    $ci = &get_instance();
    $temp_adminaccountant_Url = base_url("adminaccountant");
    return $temp_adminaccountant_Url;
}
function adminteacher_Url(){
    $ci = &get_instance();
    $temp_adminteacher_Url = base_url()."adminteacher";
    return $temp_adminteacher_Url;
}

