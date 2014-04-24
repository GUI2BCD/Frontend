<?php
namespace LastResortRecovery;

include_once 'db.php';
include_once 'session.php';
/*
 * You will get 'pk', 'name' and 'value' in $_POST array.
 */
$pk = $_POST['pk'];
$name = $_POST['name'];
$value = $_POST['value'];

/*
 * Check submitted value
 */
if (! empty($value)) {
    
    if ($name == "username" && Session::checkUsername($value, $connection) != VALIDATION_OK) {
        header('HTTP 400 Bad Request', true, 400);
        echo 'Username in use';
    } elseif ($name == "email" && Session::checkEmail($value, $connection) != VALIDATION_OK) {
        header('HTTP 400 Bad Request', true, 400);
        echo 'Email in use';
    } else {
        $sql = "UPDATE users SET " . $name . " = ? WHERE id = ?;";
        
        // Prepare statement
        if ($result = $connection->prepare($sql)) {
            // Bind ID into query
            $result->bind_param('si', $value, $pk);
            // Execute query
            echo $result->execute();
        } else {
            echo 'bad';
        }
    }
} else {
    /*
     * In case of incorrect value or error you should return HTTP status != 200. Response body will be shown as error message in editable form.
     */
    
    header('HTTP 400 Bad Request', true, 400);
    echo "This field is required!";
}