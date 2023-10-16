<?php
header("Cache-control: no-cache");


if(!isset($_COOKIE['usename'])) 
{
// cookie с именем 'usename' еще не установлено, устанавливаем ее
/* задаем значение cookie, определяя для нее уникальный ID для каждого отдального пользователя */
$cookie_value = uniqid("ID");
// создаем cookie с именем 'usename' с установленным уникальным ID
setcookie("usename", $cookie_value, time() + 600*60*24*14); 
}
// эту строчку вывода cookie после отладки можно закомментировать
//else echo $_COOKIE['usename'];
/* теперь в ближайшие две недели данный пользователь будет идентифицироваться как ID… 
(установленный для него номер) */


?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>КНИЖНЫЙ МАГАЗИН</title>
</head>

<body background="EULA6.jpg" style="background-repeat:repeat-y" leftmargin="130" rightmargin="5" bgProperties=fixed>
<table border="0" align="right" width="90%" cellpadding="0" cellspacing="0">
<tr><td>

<table border="0" align="right" width="100%" >
<tr>
<td align="center" bgcolor="#cccccc">
<form action="auto.php" method="post">
<table>
<tr><td align="right"><font size=-2>Логин:</font></td>
<td align="left"><input type=text style="width:60; height:20;" name=login></td></tr>
<tr><td align="right"><font size=-2>Пароль:</font></td>
<td align="left"><input type=password style="width:60; height:20;" name=pass>
<input type=submit value=ok style="height:20;"></td></tr>
<?php
if(isset($_SESSION["log"]))
{
	print $_SESSION["log"];
	print "<br><a href='cabinet.php'>Личный кабинет</a>";
}
?>
</table>
</td>
</form>
<td colspan="4" align="center" bgcolor="#ccccff">
<font face="Arial" size="+3"><i><b>Книжный магазин</b></i></font></td></tr>
<tr><td align="center" bgcolor="#aaddff" width="20%">
<a href="catalog.php"><b>Каталог</b></a></td>
<td align="center" bgcolor="#ddaaff" width="20%">
<a href="basket.php"><b>Корзина</b></a></td>
<td align="center" bgcolor="#aaaaff" width="20%">
<a href="reg.php"><b>Регистрация</b></a></td>
<td align="center" bgcolor="#ffaaff" width="20%">
<a href="order.php"><b>Заказ</b></a></td>
<td align="center" bgcolor="#aaffee" width="20%">
<a href="exit.php"><b>Выход</b></a></td>
</tr>
</table>
</td></tr>
<tr><td align="center"
bgcolor=<?php print $color?>><font face="Arial" size="+2">
<i><?php print $title?></i></font><br>
</td></tr>
