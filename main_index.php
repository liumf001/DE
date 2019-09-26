<?php
// echo $_GET['rootId'];
// echo "\n".$_GET['rootName'];

?>
<html>
<head>
    <title>输入密码</title>
</head>
<body style="background-image:  url(./img/bg1.jpeg);
    background-repeat: no-repeat;
    background-size: 100%,100%;
    background-attachment: fixed;">
    <div style="width: 520px;height:  200px; background: saddlebrown;
        position: absolute; top: 20%;left: 30%; opacity: 0.8; text-align: center;">
        <p style="font-size: 28px;">请输入密码：</p>
        <form name="psw_input_form" method="post" action="./psw_process.php<?php echo "?rootId=".$_GET['rootId']; ?>">
        <input type="password" name="psw_input" style="width:50%; opacity:0.7;" ><br><br>
        <input name="submit" type="submit" id="submit" value="确认密码" style="width:50%;"/>
        </form>
        
    </div>
</body>
</html>