<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";
if (
    isset($_POST["user_id"])
    && is_numeric($_POST["user_id"])
    && isset($_POST["user_name"])
    && isset($_POST["user_pwd"])
    && isset($_POST["user_mobile"])
    && is_auth()
) {
    $use_name = $_POST["user_name"];
    $use_pwd = $_POST["usre_pwd"];
    $use_pwd = $_POST["user_email"];
    $use_mobile = $_POST["user_mobile"];
    $use_active = isset($_POST["user_isadmin"]) ? $_POST["user_isadmin"] : "0";
    $use_active = isset($_POST["user_isactive"]) ? $_POST["user_isactive"] : "0";
    $use_note = isset($_POST["user_note"]) ? $_POST["user_note"] : "";
    $use_id = $_POST["user_id"];

    $updateArray = array();
    array_push($updateArray, htmlspecialchars(strip_tags($user_name)));
    array_push($updateArray, htmlspecialchars(strip_tags($user_pwd)));
    array_push($updateArray, htmlspecialchars(strip_tags($user_email)));
    array_push($updateArray, htmlspecialchars(strip_tags($user_mobile)));
    array_push($updateArray, htmlspecialchars(strip_tags($user_isadmin)));
    array_push($updateArray, htmlspecialchars(strip_tags($user_isactive)));
    array_push($updateArray, htmlspecialchars(strip_tags($user_last_active)));
    array_push($updateArray, htmlspecialchars(strip_tags($user_note)));
    array_push($updateArray, htmlspecialchars(strip_tags($user_id)));

    $sql = "update users set user_name=?,user_pwd=?,user_email=?,
    user_mobile=?,user_isadmin=?,user_isactive=?,user_last_active=now(),user_note=?
                where user_id=?";
    $result = dbExec($sql, $updateArray);


    $resJson = array("result" => "success", "code" => "200", "message" => "done");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
} else {
    //bad request
    $resJson = array("result" => "fail", "code" => "400", "message" => "update error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}
