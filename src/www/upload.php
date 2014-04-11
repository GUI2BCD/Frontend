<?php
/**
 * University of Massachusetts Lowell
 * GUI Programming II, Prof. Jesse Heines
 *
 * Last Resort Recovery
 * Authors - David Jelley, Jr.
 *           Cameron Morris
 *           Benjamin Cao
 *
 * Description: This file contains the functionality for the agent uploading files to the server
 */
namespace LastResortRecovery;

include 'config.php';

if( isset($_FILES['filename'])) {

if ($_FILES['filename']['error'] == 0) {
    
    $uploaddir = realpath('./') . '/files/';
    $uploadfile = $uploaddir . basename($_FILES['filename']['name']);
    echo '<pre>';
    if (move_uploaded_file($_FILES['filename']['tmp_name'], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.";
    } else {
        echo "Bad upload";
    }
}
else {
    echo BAD_REQUEST;
}
}
else {
    echo BAD_REQUEST;
}
?>