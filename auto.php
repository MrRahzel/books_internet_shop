<?php
$title="Авторизация";
$color="#aaaaff";

include("connect.php");
//include("header.php");

$login=$_POST["login"]; 
$pass=$_POST["pass"];

function session_register()
{
	$args = func_get_args();
	foreach ($args as $key)
	{
		if (!isset($GLOBALS[$key])) 
		{
			$GLOBALS[$key] = NULL;
		}
	$_SESSION[$key] =& $GLOBALS[$key];
	}
}
	
$strSQL1="SELECT * FROM покупатель WHERE логин='".$login. "' AND пароль='".$pass."'";
	//print_r($strSQL1);
	//die();
$result1=$mysqli->query($strSQL1) or die("Не могу выполнить запрос: " .$strSQL1); 

if($row=mysqli_fetch_array($result1))
{

	//$start=session_start(); 
	
	session_register("log");
	//$HTTP_SESSION_VARS["log"]=$row["fam"]." ".$row["im"]; 
	$_SESSION["log"]=$row["фамилия"]." ".$row["имя"]; 

	session_register("id");
	//$HTTP_SESSION_VARS["id"]=$row["id_cust"];
	$_SESSION["id"]=$row["id_покупатель"];

	$message="<tr><td bgcolor='#66cc66' align='center'>
	<b>Вы успешно авторизованы</b></td></tr>";
	$success=true;
	//print $message;
}
else
{
	include("header.php");
	$message="<tr><td bgcolor='#ff9999' align='center'>
	<b>Таких логина/ пароля не существует!!!</b></td></tr>";
	$success=false;
	print $message;
}
include("disconnect.php");

if($success)
{
	include ("cabinet.php"); 
}

//include("footer.php");

?>
