
<?php
require "SiteController.php";

error_reporting(E_ALL);
ini_set("display_errors", 1);

$siteController = new SiteController();


if (isset($_GET["user_id"])){
    $userid = $_GET["user_id"];
    $res = $siteController->db->query("select email from users where user_id = $1;", $userid);
    echo json_encode($res);
}
else {
    echo json_encode(['error' => 'Invalid parameters']);
}
include('templates/welcome.php');


?>