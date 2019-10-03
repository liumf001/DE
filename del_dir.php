<?php
function delThis($id){
    $serverName="localhost";
    $userName="root";
    $password="Liumf001";
    $dbName="DIE";
    $conn=new mysqli($serverName,$userName,$password,$dbName);
    if($conn->connect_error){
        die("connect failed: ".$conn->connect_error);
    }

    //删除此文件夹下的服务器上的文件
$sql1="select fID,fName from Fl where fDirID=".$id;
echo $sql1;
$res1=$conn->query($sql1);
if($res1->num_rows>0){
    while($row1=$res1->fetch_assoc()){
        $path1="./DOC/file_".$row1['fID']."/".$row1['fName'];
        echo "delete path:".$path1."\n";
        if(file_exists($path1)){
            if(!unlink($path1)){
                exit("delete error1\n");
            }
        }
    }
}

echo "1";

// 删除文件夹下的文件夹（递归）
$sql3="select dID from Dir where dFatherId=".$id;
$res3=$conn->query($sql3);
if($res3->num_rows>0){
    while($row3=$res3->fetch_assoc()){
        echo $row3['dID'];
        delThis($row3['dID']);
    }
}

echo "2";

//删除数据库中的文件夹数据和文件数据（级联）
$sql2="delete from Dir where dID=".$id;
if(!$conn->query($sql2)){
    exit("delete error2\n");
}

echo "3";
$conn->close();
}





$dirId=$_GET['dirId'];
echo "dirId=".$dirId."\n";
$targetId=$_GET['targetId'];
echo "targetId=".$targetId."\n";

delThis($dirId);


header("location:./index.php?targetID=".$targetId);

//两个问题，1，targetId没有传进来(solved)，2，删除文件时错误，怀疑是文件权限的问题
//有一个问题，没有删除文件夹下的文件夹，递归。。。
