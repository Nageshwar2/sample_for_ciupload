<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function is_image(string $file_name) {
    $f = explode(".", $file_name);
    $ext = strtolower(end($f));
    if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png") || ($ext == "svg")) 
        return true;
    return false;
}

function is_pdf(string $file_name) {
    $f = explode(".", $file_name);
    $ext = strtolower(end($f));
    if($ext == "pdf")
        return true;
    return false;
}

function getUploadedFilesIfValid(string $FileName, int $MaxSize) {
    if ($_FILES[$FileName]['name'] != '') {
        if(is_array($_FILES[$FileName]['name'])) {
            $file = array('file_name' => $_FILES[$FileName]['name'],
            'file_tmp_name' => $_FILES[$FileName]['tmp_name'],
            'file_type' => $_FILES[$FileName]['type'],
            'file_error' => $_FILES[$FileName]['error'],
            'file_size' => $_FILES[$FileName]['size'] );
        } else {
            $file = array();
            $file['file_name'][0] = $_FILES[$FileName]['name'];
            $file['file_tmp_name'][0] = $_FILES[$FileName]['tmp_name'];
            $file['file_type'][0] = $_FILES[$FileName]['type'];
            $file['file_error'][0] = $_FILES[$FileName]['error'];
            $file['file_size'][0] = $_FILES[$FileName]['size'];
        }
        $error = '';
        foreach($file['file_tmp_name'] as $i => $ftn) {
            if (is_image($file['file_name'][$i]) || is_pdf($file['file_name'][$i])) {
                if ($file['file_size'][$i] > $MaxSize) {
                    $error .=  '\n'.$file['file_name'][$i].' - File Size Is Not Valid !';
                }
                if($file['file_error'][$i] == 1) {
                    $error .= '\n'.$file['file_name'][$i].' - Something Is Wrong With The File !';
                }
            } else {
                $error .= '\n'.$file['file_name'][$i].' - File Format Not Supported !';
            }
        }
        if($error == '') {
            return $file;
        } else {
            $CI = get_instance();
            $CI->session->set_flashdata('FileError', $error);
            return FALSE;
        }
    }
}

function uploadFile(string $FileName, string $Path, int $MaxSize, $prefix = '') {
    $CI = get_instance();
    if ($_FILES[$FileName]['name'] != '') {
        if(!($file = getUploadedFilesIfValid($FileName, $MaxSize)))
        return FALSE;
        if(!file_exists($Path))
        mkdir($Path, 0777, true);
        $ret = array();
        foreach($file['file_tmp_name'] as $i => $ftn) {
            $f = explode(".", $file['file_name'][$i]);
            $ext = end($f);
            $new_image_name = '';
            if($prefix != '')
            $new_image_name = $prefix.'_';
            $new_image_name .= uniqid() . time() . '.' . $ext;
            if(move_uploaded_file($ftn, './'.$Path.$new_image_name))
            array_push($ret,$Path.$new_image_name);
        }
        return $ret;
    }
}

?>
