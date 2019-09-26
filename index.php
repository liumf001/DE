<?php
$serverName="localhost";
$userName="root";
$password="Liumf001";
$dbName="DIE";
$conn=new mysqli($serverName,$userName,$password,$dbName);
if($conn->connect_error){
    die("connect failed: ".$conn->connect_error);
}

//生成URL参数字符串
function gen_url($id,$name){
    $query_url=array(
        'rootId'=>$id,
        'rootName'=>"$name"
    );
    $url = './main_index.php?' . http_build_query($query_url); 
    return $url;
}

//当前目录id
$thisID=$_GET['targetID'];
if($thisID==NULL)
    $thisID=0;
echo "thisID: ".$thisID."\n";
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>DocumentsInEverywhere</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <!-- <link href="http://csdnimg.cn/www/images/favicon.ico" rel="SHORTCUT ICON"> -->
    <link href="css.css" type="text/css" rel="stylesheet">
    
</head>
<body>

        <div id="main_page">
            <ul>
                <!-- <li class="list_item">111</li> -->
                <?php
                    // 获取文件夹
                    $sql_s="select * from Dir where dFatherId=".$thisID;
                    $res_s=$conn->query($sql_s);
                    if($res_s->num_rows>0){
                        while($row=$res_s->fetch_assoc()){
                            // echo "<li class='list_item'><img class='icon' src='./img/dir_icon.png'> ".$row["dName"]."</li> ";
                            $dID=$row["dID"];
                            $dName=$row["dName"];
                            $dPassword=$row["dPassword"];
                            $dFatherId=$row["dFatherId"];
                            echo "<li class='list_item'><img class='icon' src='./img/dir_icon.png'> <a href='".
                            gen_url($dID,$dName)."'>".$dName."</a></li> ";
                        }
                    }

                    //获取当前文件，如果不是在根目录下
                    if($thisID){
                        $sql1="select fID,fName from Fl where fDirID =".$thisID;
                        $res1=$conn->query($sql1);
                        if($res1->num_rows>0){
                            while($row1=$res1->fetch_assoc()){
                                echo "<li class='list_item'><img class='icon' src='./img/file_icon.png'> <a href='./DOC/file_".$row1['fID']."/".$row1['fName']."'>".$row1['fName'] ."</a></li> ";
                            }
                        }
                    }
                ?>
            </ul>
        </div>
        <!-- 添加文件夹按钮 -->
        <a href="./create_dir.php<?php echo "?"."fatherId=".$thisID ?>">
        <img src="./img/add_dir.png" class="add_img">
        </a>
        <!-- 添加文件按钮 -->
        <a href="./upload_file.php<?php echo "?fatherId=".$thisID ?>">
                 <img src="./img/add_file.png" class="add_img1">   
        </a>
</body>
</html>

<?php
$conn->close();
?>