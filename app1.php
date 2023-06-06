<?php

//database connection..
$host='localhost';
$user='root';
$password='';
$database='mas';
$conn=mysqli_connect($host,$user,$password,$database);
if(!$conn)
{
die('Error:'.mysqli_connect_error());
}
// echo "established";
//take data from form
if($_SERVER['REQUEST_METHOD']=='POST')
{
   
    $userid=$_POST['userid'];
    $password=$_POST['password'];
    $hpassword=hash_hmac('sha512',$password,$userid);
}

$sql2='select * from user';
$dd=mysqli_query($conn, $sql2);
$f=0;
foreach($dd as $i)
{
    if($i['userid']==$userid and $i['password']==$hpassword)
    {
        $message='Login Sucessfully!!!';
        $f=1;
        break;
    }
}
if($f==0)
{
    $message='User not avilable - Please register!!!';
}

include "two.html";

?>