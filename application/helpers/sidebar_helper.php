<?php

function config_sidebar()
{
    $session = $_SESSION['data'];
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    $data = array(
        array(
            'title-group' => '',
            'title' => 'Activity',
            'icon' => 'far fa-calendar-check',
            'link' => 'Activity', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Activity"  ? 'true' : 'false'
        ),
        array(
            'title-group' => '',
            'title' => 'Internship Report',
            'icon' => 'fas fa-clipboard',
            'link' => 'Report', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Report"  ? 'true' : 'false'
        ),
        array(
            'title-group' => '',
            'title' => 'Certifikate',
            'icon' => 'fas fa-award',
            'link' => 'Certifikate', //Jika tidak menggunakan submenu Isi dengan Link , Jika memakai submenu isi dengan #
            'sub_menu' => '', // Jika tidak ada sub menu dikosongkan saja  , Jika pakai submenu isi dengan function 
            'id_collapse' => '',
            'condition' =>  $uri_segments[2] == "Certifikate"  ? 'true' : 'false'
        ),
    );
    return $data;
}

// function admin()
// {
//     $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//     $uri_segments = explode('/', $uri_path);
//     $data = array(
//         array(
//             'title'    => 'Data Karyawan',
//             'link'     => 'Karyawan',
//             'condition' =>  $uri_segments[2] == "Karyawan"  ? 'true' : 'false'
//         ),
//         array(
//             'title'    => 'Data User',
//             'link'     => 'User',
//             'condition' =>  $uri_segments[2] == "User"  ? 'true' : 'false'
//         ),
//         array(
//             'title'    => 'Data Dpartement',
//             'link'     => 'Dpartement',
//             'condition' =>  $uri_segments[2] == "Dpartement"  ? 'true' : 'false'
//         ),
//     );
//     return $data;
// }
