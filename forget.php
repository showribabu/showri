<?php

// database connection..
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'mas';
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die('Error: ' . mysqli_connect_error());
}

// take data from form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userid=$_POST['userid'];
    $owqn = $_POST['owq'];
    $answer = $_POST['answer'];
    $password = $_POST['password'];
    $hpassword=hash_hmac('sha512',$password,$userid);
}

//$sql = "UPDATE user SET password='" . $password . "' WHERE answer='" . $answer . "' AND owqn='" . $owqn. "' AND userid='" . $userid . "' ";
// echo $sql;
//$stmt = mysqli_prepare($conn, $sql);
//mysqli_stmt_execute($stmt);

/*another one.. place holder(?)*/

$sql = "UPDATE user SET password = ? WHERE answer = ? AND owqn = ? AND userid = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'ssss', $hpassword, $answer, $owqn, $userid);
mysqli_stmt_execute($stmt);


if (mysqli_stmt_affected_rows($stmt)> 0) 
{
    // $message="Successfully updated";
    echo"<script>alert('Successfully updated');</script>";
    include "two.html";
}
else{
    echo "<script>alert()</script>";

    $message="Failed to update!!! you have to try again >>!!";
    include "forget.html";
}
?>
