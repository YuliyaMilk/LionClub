<?php
include "config.php";
$conn = new mysqli("127.0.0.1", "root", "", "chat");
$response = array();
if($_POST['email'] && $_POST['password']){
    $email = $_POST['email'];
    $post_password = $_POST['password'];
    $stmt = $conn->prepare("SELECT username, password FROM users WHERE email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->bind_result($username, $db_password);
    $stmt->fetch();
    if(password_verify($post_password, $db_password)){
        $response['error'] = false;
        $response['message'] = "Login Successful!";
        $response['email'] = $email;
        $response['username'] = $username;
    } else{
        $response['error'] = false;
        $response['message'] = "Invalid Email or Password";
    }
} else {
    $response['error'] = true;
    $response['message'] = "Insufficient Parameters";
}
echo json_encode($response);
?>
