<?php
$host = "localhost";
$user="root";
$password="";
$dbName="school";
$conn = mysqli_connect($host,$user,$password,$dbName);

function testmessage($name,$masg){

     if($name){
         echo "<div class=' text-center alert alert-primary' role='alert'>
             $masg
       </div>";
     }else{
         echo "<div class=' alert alert-primary' role='alert'>
             error in $masg
       </div>";
     }

 }
 /* function to get the last id enter in the table */
 function getid($table,$cond){
 $host = "localhost";
 $user="root";
 $password="";
 $dbName="school";
 $conn = mysqli_connect($host,$user,$password,$dbName);
 $showData = "SELECT $cond as id FROM $table ORDER BY $cond DESC LIMIT 1";
 $i = mysqli_query($conn,$showData);
 $row = mysqli_fetch_assoc($i);
 return $row['id'] ;
 }
 /*===============================================*/
?>