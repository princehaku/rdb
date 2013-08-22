<?php
/**
 * 完全按照ups2.0的规范模拟了一个ups出来。
 * 后端使用redis
 *
 * @author bzw
 */
require 'config.php';

function die_json($arr) {
    echo json_encode($arr);
    die;
}

$client = new Predis\Client($single_server);

if (empty($_GET["app"]) || empty($_GET["table"]) || empty($_GET["key"])) {

    die_json(array(
        "result" => array(),
        "msg" => "You Must Define app and table and key",
        "status" => "RDB_ERROR"
    ));
}
$app = $_GET["app"];
$table = $_GET["table"];
$key = $_GET["key"];


if (isset($_GET["value"])) {
    $client->set($app . $table . $key, $_GET["value"]);

    die_json(array(
        "msg" => "save ok",
        "status" => "RDB_OK"
    ));
} else {
    $record = $client->get($app . $table . $key);

    die_json(array(
        "result" => array(
            $key => $record
        ),
        "msg" => "get ok",
        "status" => "RDB_OK"
    ));
}

