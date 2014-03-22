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
 * Description: This file handles ajax calls to the server side backend
 *
 */
namespace LastResortRecovery;

include_once 'db.php';
//var_dump($_REQUEST);

// Check operation

if (isset($_POST['action'])) {
    
    if ($_POST['action'] == "togglestatus") {
        
        // Toggle status check device ID
        if (isset($_POST['deviceid'])) {
            
            $sql = "SELECT status FROM devices WHERE id= ?";
            
            // Prepare statement
            if ($result = $connection->prepare($sql)) {
                // Bind ID into query
                $result->bind_param('i', $_POST['deviceid']);
                // Execute query
                $result->execute();
                // Save results
                $result->store_result();

                // Check if device exists
                if ($result->num_rows == 1) {
                    // Get device status
                    $result->bind_result($status);
                    $result->fetch();
                    
                    // Check device status
                    if ($status == "OK") {
                        $status = "LOST";
                    } else {
                        $status = "OK";
                    }
                    
                    
                    // Update query
                    $sql = "UPDATE devices SET status = ? WHERE id = ?";
                    // Prepare statement
                    if ($result = $connection->prepare($sql)) {
                        // Bind parameters
                        $result->bind_param('si', $status, $_POST['deviceid']);
                        
                        // Execute query
                        if (! $result->execute()) {
                            echo DATABASE_ERROR;
                        }
                        echo $status;
                    }
                }
            }
        } else {
            echo BAD_REQUEST;
        }
    }
} else {
    echo BAD_REQUEST;
}
