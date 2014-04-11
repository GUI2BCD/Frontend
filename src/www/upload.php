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

$uploaddir = realpath('./') . '/files/';
$uploadfile = $uploaddir . basename($_FILES['file_contents']['name']);
echo '<pre>';
if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}
echo 'Here is some more debugging info:';
print_r($_FILES);
echo "\n<hr />\n";
print_r($_POST);
print "</pr" . "e>\n";
?>