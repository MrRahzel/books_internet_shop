<?php
$title="Регистрация";
$color="#aaaaff";

include("connect.php");

$success = "";
$message = "";

if (isset($_POST["type"])) {
	$type = $_POST["type"];
} else {
	$type = 0;
}


if($type==1)
{
	$fam=$_POST["fam"];
	$im=$_POST['im'];
	$addr=$_POST["addr"];
	$mail=$_POST["mail"];
	$pass=$_POST["pass"];
	$pass2=$_POST["pass2"];
	$login=$_POST["login"];

	if (isset($_POST["subscribe"])) 
	{
		$subscribe = $_POST["subscribe"];
	} 
	else 
	{
		$subscribe = 0;
	}

	if($fam!="" && $im!="" && $addr!="" && $mail!="" && $login!="" && $pass!="" && $pass2!="")
	{
		if($pass!=$pass2)
		{
			$message="<tr><td bgcolor='#ff9999' align='center'><b>
			Поля пароля и повтора пароля не совпадают!!!</b></td></tr>";
		}
		else
		{	
			$strSQL1="SELECT id_покупатель FROM покупатель WHERE логин='".$login."'";
			$result1=$mysqli->query($strSQL1) or die("Не могу выполнить запрос1!: " .$strSQL1);

			if ($row=mysqli_fetch_array($result1))
			{
				$message = "<tr><td bgcolor='#ff9999' align='center'><b>Такой логин уже существует!!! Выберите другой логин</b></td></tr>";
			} else {
				$strSQL1 = "INSERT INTO покупатель(фамилия, имя, адрес, mail, логин, пароль, рассылка) VALUES('".$fam."','".$im."','".$addr."','".$mail."','".$login."','".$pass."','".$subscribe."')";
				$result1 = $mysqli->query($strSQL1) or die("Не могу выполнить запрос2!: " .$strSQL1);
				$message = "<tr><td bgcolor='#66cc66' align='center'><b>Вы успешно зарегистрированы</b></td></tr>";
				$success = true;
			}
		}
	} else {
		$message="<tr><td bgcolor='#ff9999' align='center'>
		<b>Не все поля заполнены!!!</b></td></tr>";
	}
}

include("header.php"); 

print $message;

if(!$success)
	{
?>

<form action="reg.php" method="post">
<tr><td align="center">
<small>Звездочками отмечены обязательные поля</small>
<table border="0" width="100%" align="right">
	<tr>
		<td align="right" width="50%"><i>Фамилия: </i></td>
		<td><input type=text name=fam value="">*</td>
	</tr>
	<tr>
		<td align="right"><i>Имя: </i></td>
		<td><input type=text name=im value="">*</td>
	</tr>
	<tr>
		<td align="right"><i>Адрес: </i></td>
		<td><input type=text name=addr value="">*</td>
	</tr>
	<tr>
		<td align="right"><i>E-mail: </i></td>
		<td><input type=text name=mail value="">*</td>
	</tr>
	<tr>
		<td align="right"><i>Логин: </i></td>
		<td><input type=text name=login value="">*</td>
	</tr>
	<tr>
		<td align="right"><i>Пароль: </i></td>
		<td><input type=password name=pass value="">*</td>
	</tr>
	<tr>
		<td align="right"><i>Повтор пароля: </i></td>
		<td><input type=password name=pass2 value="">*</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="checkbox" value="1" name="subscribe">
			<i>Подписаться на рассылку новостей</i>
		</td>
	</tr>
	<input type=hidden value=1 name=type>
	<tr>
		<td align="right"></td>
		<td>
			<input type=submit value="отправить">
		</td>
	</tr>
</table>
</form>
</td></tr>

<?php
	}
include("footer.php");
include("disconnect.php");
?>
