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
 * Description: This file contains the functionality for the agent interacting with the website
 */
namespace LastResortRecovery;

include_once 'db.php';
include_once 'session.php';
include_once 'device.php';

// Start a session
Session::startSecureSession();

if (isset($_GET['action'])) {
    
    // Agent checking credentials
    if ($_GET['action'] == 'auth') {
        
        // Check post variables
        if (isset($_POST['email'], $_POST['password'])) {
            
            // User
            $email = $_POST['email'];
            // Encrypted password
            $password = $_POST['password'];
            
            // Check if login valid
            $result = Session::login($email, $password, $connection);
            if ($result == LOGIN_SUCCESS) {
                echo LOGIN_SUCCESS;
            } else {
                echo $result;
            }
        } else {
            echo BAD_REQUEST;
        }
    } elseif ($_GET['action'] == 'status') {
        // Agent requesting status of device
        
        // Check post variables
        if (isset($_POST['email'], $_POST['password'], $_POST['deviceid'])) {
            
            // User
            $email = $_POST['email'];
            // Encrypted password
            $password = $_POST['password'];
            // Device
            $deviceid = $_POST['deviceid'];
            
            // Check if login valid
            $result = Session::login($email, $password, $connection);
            if ($result == LOGIN_SUCCESS) {
                // Check device status
                echo Device::status($deviceid, $connection);
            } else {
                echo $result;
            }
        } else {
            echo BAD_REQUEST;
        }
    } elseif ($_GET['action'] == 'register') {
        // Agent registering a new device
        
        // Check post variables
        if (isset($_POST['email'], $_POST['password'], $_POST['devicename'])) {
            
            // User
            $email = $_POST['email'];
            // Encrypted password
            $password = $_POST['password'];
            // Device
            $devicename = $_POST['devicename'];
            // Check if login valid
            $result = Session::login($email, $password, $connection);
            if ($result == LOGIN_SUCCESS) {
                // Register device
                echo Device::registerDevice($email, $devicename, $connection);
            } else {
                $result;
            }
        } else {
            echo BAD_REQUEST;
        }
    } elseif ($_GET['action'] == 'report') {
        // Agent submitting a report
        
        // Check post variables
        // TODO Make this a function please
        if (isset($_POST['email'], $_POST['password'], $_POST['deviceid'], $_POST['localip'], $_POST['wifi'], 
            $_POST['traceroute'])) {
            
            // User
            $email = $_POST['email'];
            // Encrypted password
            $password = $_POST['password'];
            // Check if login valid
            $result = Session::login($email, $password, $connection);
            
            // Add to database
            // TODO Make this a function please
            if ($result == LOGIN_SUCCESS) {
                
                $deviceid = $_POST['deviceid'];
                $localip = $_POST['localip'];
                $remoteip = $_SERVER['REMOTE_ADDR'];
                $wifi = $_POST['wifi'];
                $traceroute = $_POST['traceroute'];
                
                $sql = "INSERT INTO reports (deviceid, localip, remoteip, wifi, traceroute) VALUES(?,?,?,?,?)";
                
                // Prepare statement
                if ($result = $connection->prepare($sql)) {
                    // Bind parameters
                    $result->bind_param('issss', $deviceid, $localip, $remoteip, $wifi, $traceroute);
                    
                    // Execute query
                    if (! $result->execute()) {
                        echo DATABASE_ERROR;
                    } else {
                        // Success
                        echo $connection->insert_id;
                    }
                } else {
                    echo DATABASE_ERROR;
                }
            }
        } else {
            echo BAD_REQUEST;
        }
    } elseif ($_GET['action'] == 'upload') {
        if (isset($_FILES['webcam']) || isset($_FILES['screenshot'])) {
            
            
            ini_set("display_startup_errors", "1");
            ini_set("display_errors", "1");
            error_reporting(E_ALL);
            echo "<pre>";
            echo "POST:";
            print_r($_POST);
            echo "FILES:";
            print_r($_FILES);
            echo "</pre>";
            
            if ($_FILES['webcam']['error'] == 0) {
                
                $uploaddir = realpath('./') . '/files/';
                $uploadfile = $uploaddir . $_POST['reportid'] . "_webcam.png";
                echo '<pre>';
                if (move_uploaded_file($_FILES['webcam']['tmp_name'], $uploadfile)) {
                    echo "File is valid, and was successfully uploaded.";
                } else {
                    echo "Bad upload";
                }
            } else {
                echo BAD_REQUEST;
            }
            if ($_FILES['screenshot']['error'] == 0) {
                
                $uploaddir = realpath('./') . '/files/';
                $uploadfile = $uploaddir . $_POST['reportid'] . "_" . basename($_FILES['screenshot']['name']);
                echo '<pre>';
                if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $uploadfile)) {
                    echo "File is valid, and was successfully uploaded.";
                } else {
                    echo "Bad upload";
                }
            } else {
                echo BAD_REQUEST;
            }
        } else {
            echo BAD_REQUEST;
        }
    } else {
        echo BAD_REQUEST;
    }
} else {
    echo BAD_REQUEST;
}
