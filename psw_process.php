<?php
$serverName="localhost";
$userName="root";
$password="Liumf001";
$dbName="DIE";
$conn=new mysqli($serverName,$userName,$password,$dbName);
if($conn->connect_error){
    die("connect failed: ".$conn->connect_error);
}


if($_POST["submit"]="确认密码"){
    $psw=$_POST['psw_input'];
    $sql1="select dPassword from Dir where dID=".$_GET['rootId'];

    $res1=$conn->query($sql1);
    if($res1->num_rows>0){
        while($row1=$res1->fetch_assoc()){
            if($row1['dPassword']!=$psw&&$psw!=NULL){
                //密码错误
                echo "密码错误";
            }
            else{
                //密码正确的操作
                header("location:index.php?targetID=".$_GET['rootId']);
                // echo "1";
                break;
            }
        }
    }
    else{
        //密码正确的操作
                header("location:index.php?targetID=".$_GET['rootId']);
                // echo "2";
    }
}