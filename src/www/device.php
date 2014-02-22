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
 * Description: This file handles device functionality
 *
 */
namespace LastResortRecovery
{

    include_once 'config.php';

    class Device
    {

        public static function registerDevice($email, $deviceName, $connection)
        {
            // Get user's id
            $sql = "SELECT id FROM users WHERE email = ? LIMIT 1";
            
            // Prepare statement
            if ($result = $connection->prepare($sql)) {
                // Bind ID into query
                $result->bind_param('s', $email);
                // Execute query
                $result->execute();
                // Save results
                $result->store_result();
                
                // Check if user exists
                if ($result->num_rows == 1) {
                    // Get user's database password
                    $result->bind_result($id);
                    $result->fetch();
                } else {
                    return - 1;
                }
            } else {
                return - 1;
            }
            
            // Check if the user's devicename already exists
            $sql = "SELECT id FROM devices WHERE userid = ? AND name = ? LIMIT 1";
            
            // Prepare statement
            if ($result = $connection->prepare($sql)) {
                // Bind ID into query
                $result->bind_param('is', $id, $deviceName);
                // Execute query
                $result->execute();
                // Save results
                $result->store_result();
                
                // Device already exists
                if ($result->num_rows == 1) {
                    // Give them the existing id
                    $result->bind_result($id);
                    $result->fetch();
                    return $id;
                }                 

                // Create a new device entry
                else {
                    $sql = "INSERT INTO devices (userid, name) VALUES( ?, ?)";
                    
                    // Prepare statement
                    if ($result = $connection->prepare($sql)) {
                        // Bind parameters
                        $result->bind_param('is', $id, $deviceName);
                        
                        // Execute query
                        if (! $result->execute()) {
                            return - 1;
                        } else {
                            // Success
                            return $connection->insert_id;
                        }
                    } else {
                        return - 1;
                    }
                }
            }
        }
    }
}