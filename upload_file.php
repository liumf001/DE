<?php
$thisID=$_GET['fatherId'];
echo "thisID:".$thisID;
if($thisID==0){
    exit("不能在根目录下创建文件，请先创建文件夹");
}
?>

<html>
<head>
<title>上传文件</title>

</head>
<body style="background-image:  url(./img/bg1.jpeg);
    background-repeat: no-repeat;
    background-size: 100%,100%;
    background-attachment: fixed;">

<div style="width: 520px;height:  200px; background: saddlebrown;
        position: absolute; top: 20%;left: 30%; opacity: 0.8; text-align: center;">
        <p style="font-size: 28px;">上传文件</p>
        
<form method="post" action="update_process.php<?php echo "?fatherId=".$thisID; ?>" enctype="multipart/form-data">  
    <input type="file" name="file" id="file">  
    <input type="submit" name="submit" value="Submit">  
</form>  
        
    </div>
    
</body>

</html>