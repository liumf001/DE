<?php
$serverName="localhost";
$userName="root";
$password="Liumf001";
$dbName="DIE";
$conn=new mysqli($serverName,$userName,$password,$dbName);
if($conn->connect_error){
    die("connect failed: ".$conn->connect_error);
}

$thisID=$_GET['fatherId'];
echo "thisID:".$thisID."\n";
//不能在根目录下上传文件
//文件名不能空，可以重

if($_FILES["file"]["name"]==""){
    exit("文件为空！");
}

if ($_FILES["file"]["error"] > 0){
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else{
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  }


//   move_uploaded_file($_FILES["file"]["tmp_name"],
//       "upload/" . $_FILES["file"]["name"]);//把upload改成id
// echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
$sql1="insert into Fl(fName,fDirID) values('".$_FILES["file"]["name"]."',".$thisID.")";
echo $sql1;
if ($conn->query($sql1) === TRUE) {
    echo "文件插入成功";
    // header("location:index.php?targetID=".$thisID);
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

$sql2="select fID from Fl where fName='".$_FILES["file"]["name"]."'";
$res2=$conn->query($sql2);
if($res2->num_rows>0){
    while($row2=$res2->fetch_assoc()){
        $path="./DOC/file_".$row2['fID'];
        mkdir($path,0777);
        move_uploaded_file($_FILES["file"]["tmp_name"],
            $path."/" . $_FILES["file"]["name"]);//把upload改成id
            header("location:index.php?targetID=".$thisID);
    }
}

$conn->close();

