
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/sha512.min.js"></script>


<script>
function hash() {
  const hash = CryptoJS.SHA512(message).toString();
  return hash;
}
</script>


<?php

//registration->ine.html
//login->two.html
//home->ex.html

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

//data from form...

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $userid=$_POST['userid'];
    $email=$_POST['email'];
    
    $answer=$_POST['answer'];
    $password=$_POST['password'];
    $contact=$_POST['contact'];

    $owq=$_POST['owq'];

    //printf("%s %s %s %s %s %s %s %d",$fname,$lname,$userid,$email,$owq,$answer,$password,$contact);

    //hashing by use key:userid,message:password

    $hpassword=hash_hmac('sha512',$password,$userid);

    //if user not registered before then only into database table
    $sql2='select * from user';
    $dd=mysqli_query($conn, $sql2);
    $f=0;
    foreach($dd as $i)
    {
        if($i['userid']==$userid){
            $message='User already registered!!!...Login now!!!';
            $f=1;
            break;
        }
    }
    if($f!=1)
    {
        
             // Insert data into user table
            $sql = "INSERT INTO user (fname, lname, userid, email, owqn, answer, password, contact) VALUES ('$fname', '$lname', '$userid', '$email', '$owq', '$answer', '$hpassword', '$contact')";

            // Execute the query
            $r = mysqli_query($conn, $sql);

             if ($r){
                echo "<script>alert('Successfully registered!!!Then Login Now!!')</script>";

                //  $message = "Successfully registered!!!Then Login Now!!";
             } 
             else{
                 echo"<br>Something went wrong. Error: " . mysqli_error($conn);
             }
            
            
    }
   
}

include "two.html";

?>