<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";
/*$images = uploadCustomerImage("file", '../../images/customer/' , 400 , 600 );
	$img_image = $images['image'];
	$img_thumbnail  = $images['thumbnail'];*/
if (
    isset($_POST["user_name"])
    && isset($_POST["user_pwd"])
    && isset($_POST["user_mobile"])
    && is_auth()
) {
    $user_name = $_POST["user_name"];
    $user_pwd = $_POST["user_pwd"];
    $user_email = $_POST["user_email"];
    $user_mobile = $_POST["user_mobile"];
    $user_isadmin =isset($_POST["user_isadmin"]) ? $_POST["user_isadmin"] : "0";
    $user_isactive = isset($_POST["user_isactive"]) ? $_POST["user_isactive"] : "0";
    $user_token = $_POST["user_token"];
    $user_note = isset($_POST["user_note"]) ? $_POST["user_note"] : "";

    $insertArray = array();
    array_push($insertArray, htmlspecialchars(strip_tags($user_name)));
    array_push($insertArray, htmlspecialchars(strip_tags($user_pwd)));
    array_push($insertArray, htmlspecialchars(strip_tags($user_email)));
    array_push($insertArray, htmlspecialchars(strip_tags($user_mobile)));
    array_push($insertArray, htmlspecialchars(strip_tags($user_isadmin)));
    array_push($insertArray, htmlspecialchars(strip_tags($user_isactive)));
    array_push($insertArray, htmlspecialchars(strip_tags($user_token)));
    array_push($insertArray, htmlspecialchars(strip_tags($user_note)));

    $sql = "insert into users ( user_name, user_pwd, user_email, user_mobile,
                 user_isadmin, user_create_date, user_isactive, user_token, user_last_active, user_note) 
                 value (?, ?, ?, ?, ?, now(), ?, ?, now(), ?)";
    $result = dbExec($sql, $insertArray);

    $resJson = array("result" => "success", "code" => "200", "message" => "done");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
} else {
    //bad request
    $resJson = array("result" => "fail", "code" => "400", "message" => "insert error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}
