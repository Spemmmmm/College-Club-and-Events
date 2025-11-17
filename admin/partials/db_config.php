<?php

$hostname = 'localhost';
$username = 'root';
$pass = '';
$db = 'club';

$con = mysqli_connect($hostname, $username, $pass, $db,3307);

if (!$con) {
    exit("Couldn't Connect to Database".mysqli_connect_error());
}

function filteration($data)
{
    foreach ($data as $key => $value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        $value = strip_tags($value);
        $data[$key] = $value;
    }

    return $data;
}

function select($query, $values = [], $types = '') {
    global $con;
    $stmt = mysqli_prepare($con, $query);

    // Only bind if $values is not empty
    if(!empty($values)) {
        mysqli_stmt_bind_param($stmt, $types, ...$values);
    }

    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}


function selectAll($table) {
    global $con;
    $query = "SELECT * FROM `$table`";
    $result = mysqli_query($con, $query);
    return $result;
}

function update($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);

            return $res;
        } else {
            mysqli_stmt_close($stmt);
            exit('Query cannot be executed - Update');
        }
    } else {
        exit('Query cannot be prepared - Update');
    }
}

function insert($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);

            return $res;
        } else {
            mysqli_stmt_close($stmt);
            exit('Query cannot be executed - Insert');
        }
    } else {
        exit('Query cannot be prepared - Insert');
    }
}

function delete($sql,$values, $datatypes)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes,...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);

            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die('Query cannot be executed - Update');
        }
    } else {
        die('Query cannot be prepared - Update');
    }
}



