<?php
$serverName="localhost";
$userName="root";
$password="Liumf001";
$dbName="DIE";
$conn=new mysqli($serverName,$userName,$password,$dbName);
if($conn->connect_error){
    die("connect failed: ".$conn->connect_error);
}

$fatherId=$_GET['fatherId'];
echo "fatherId: ".$fatherId."\n";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>新建文件夹</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    </head>
    <body style="background-image:  url(./img/bg1.jpeg);
    background-repeat: no-repeat;
    background-size: 100%,100%;
    background-attachment: fixed;">

        <div style="width: 500px;height:  280px; background: saddlebrown;
        position: absolute; top: 20%;left: 30%; opacity: 0.8;">
        <br>
            <form name="new_dir" method="post" action="">
                <ul style="list-style: none;">
                    <li>
                        文件夹名：&nbsp;&nbsp;&nbsp;<input type="text" name="new_dir_name" style="width:78%;" ><br><br>
                    </li>
                    <li>
                        *密码：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="new_psw" style="width:78%;"  ><br><br>
                    </li>
                    <li>
                        *   确认密码：<input type="password" name="new_psw_check" style="width:78%;" ><br>
                    </li>
                    <li><br>
                    <input name="submit" type="submit" id="submit" value="确认" style="width:100%;"/>
                    </li>
                </ul>
            </form>
            <?php
        if($_POST["submit"]=="确认"){//$_POST['new_dir_name']
            //操作数据库
            $var1=$_POST['new_dir_name'];
            $var21=$_POST['new_psw'];
            $var22=$_POST['new_psw_check'];
            
            if($var1=="")
                exit("文件夹名不能为空阿啊啊啊啊啊\n");

            //密码不一致
            if($var21!=$var22){
                echo "????????????????";
            }

            else{
                //文件夹名为空
                if($var1==""){
                    echo ".........";
                }

                //文件夹名已存在
                $sql1="select dName from Dir where dFatherId=".$fatherId." and dName='".$var1."'";
                echo $sql1;
                $res1=$conn->query($sql1);
                if($res1->num_rows>0){
                    echo "!!!!!!!";
                }
                //插入
                else{
                    $sql2="insert into Dir(dName,dPassword,dFatherId) values('".$var1."','".$var21."',".$fatherId.")";
                    echo $sql2;
                    if ($conn->query($sql2) === TRUE) {
                        echo "新记录插入成功";
                        header("location:index.php?targetID=".$fatherId);
                    } else {
                        echo "Error: " . $sql2 . "<br>" . $conn->error;
                    }
                }

            }
        }
        ?>
        </div>
    </body>
</html>
<?php
$conn->close();
?>