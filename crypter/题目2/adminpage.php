<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Crypeter's Adminpage</title>
	<link rel="stylesheet" type="text/css" href="../../normalize.css">
    <link rel="stylesheet" type="text/css" href="../../sakura.css">
</head>
<body>
<meta charset="utf-8">
<form name = "loginserver" method="post" action="adminlogin.php">
    <table align="center" border="3">
        <tr>
            <td>账号</td>
            <td><input name = "loginname" type="text" size ="30"></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input name = "password" type="text" size="30"></td>
        </tr>
        <td align="center" colspan="2">
            <input type="submit" value="登陆">
        </td>
    </table>
</form>
</body>