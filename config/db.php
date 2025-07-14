<?php
$serverName = "192.168.10.131";
$connectionOptions = [
    "Database" => "LIBRARY",
    "Uid" => "sa",
    "PWD" => "2005"
];
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}
?>
