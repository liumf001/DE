<?php

$fileId=$_GET['fileId'];
echo "fileId=".$fileId." ";
$targetId=$_GET['targetId'];
echo "targetId=".$targetId." ";

$serverName="localhost";
$userName="root";
$password="Liumf001";
$dbName="DIE";
$conn=new mysqli($serverName,$userName,$password,$dbName);
if($conn->connect_error){
    die("connect failed: ".$conn->connect_error);
}

$sql1="select fName from File where fID=".$fileId;
$res1=$conn->query($sql1);
if($res1->num_rows>0){
    while($row1=$res1->fetch_assoc()){
        $path1="./DOC/file_".$fileId."/".$row1['fName'];
        echo "delete path:".$path1."<br>";
        if(file_exists($path1)){
            if(!unlink($path1)){
                exit("delete error1\n");
            }
        }
        break;
    }
}

$sql2="delete from Fl where fID=".$fileId;
echo $sql2;
if(!$conn->query($sql2)){
    exit("delete error2\n");
}

$conn->close();

header("location:./index.php?targetID=".$targetId);