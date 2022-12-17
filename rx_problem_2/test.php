<?php

//POST信息
$account = "admin_1";
$passwd = "admin_1_pass_wyywwi";
$salt = base_convert(strlen($passwd) * strlen($account) * 7, 10, 5);

//其他信息
$servername = 'localhost';
//For Server side
//$username = '43.142.12.69';
$username = 'DynamicFinishWork';
$password = 'dynamic';
$errorflag = 0;

//创建连接
$conn = new mysqli($servername, $username, $password);

//异常判断
if ($conn->connect_error) {
    $errorflag = 1;
    die("连接失败: " . $conn->connect_error);
} 
else {
    echo "连接成功";
}

if ($account == '' || $passwd == '')
    $errorflag = 2;

//比对账户
/*
if($errorflag == 0){
    mysqli_query($conn, "use dynamic_wyywwi");
    $output_sql = "select id, account, password from adminlist where account = '".$account."'";
    $asked_admin = mysqli_query($conn, $output_sql);
    if ($asked_admin == null)
        $errorflag = 3;
    elseif (mysqli_num_rows($asked_admin) != 1)
        $errorflag = 4;
    else{
        $row = mysqli_fetch_row($asked_admin);
        $enc_password = $row["password"];
        if (bin2hex(base64_decode(openssl_encrypt($passwd, 'aes-128-ecb', $salt))) == $enc_password)
            $errorflag = 0;
        else
            $errorflag = 5;
    }
}
*/
mysqli_query($conn, "use dynamic_wyywwi");
$input_sql = "INSERT INTO adminlist(account, password) VALUES ('".$account."', '".bin2hex(openssl_encrypt($passwd, 'aes-256-ecb', $salt))."')";
mysqli_query($conn, $input_sql);
$output_sql = "select * from adminlist";
$asked_admin = mysqli_query($conn, $output_sql);
//INSERT INTO `tablea`(`classID`, `stuName`) VALUES ('B', HEX(AES_ENCRYPT('huang','SecretKey')));
echo bin2hex(openssl_encrypt($passwd, 'aes-256-ecb', $salt));
?>