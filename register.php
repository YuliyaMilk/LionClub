<?php
include "config.php";
$conn = new mysqli("127.0.0.1", "root", "", "chat");
$response = array();
if($_POST['email'] && $_POST['password'] && $_POST['username']){
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $username = $_POST['username'];
    $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $sql->bind_param("s",$email);
    $sql->execute();
    $sql->store_result();

    if($sql->num_rows > 0){
        $response['error'] = false;
        $response['message'] = "User already registered";
    } else{
        $stmt = $conn->prepare("INSERT INTO `users` (`username`, `email`, `password`) VALUES(?,?,?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $result = $stmt->execute();
        if($result){
            $response['error'] = false;
            $response['message'] = "User Registered Successfully";
        } else {
            $response['error'] = false;
            $response['message'] = "Cannot complete user registration";
        }
    }
} else{
    $response['error'] = true;
    $response['message'] = "Insufficient Parameters";
}
echo json_encode($response);
?>
