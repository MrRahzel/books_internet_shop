<?php 

$fam=$_POST["fam"];
$im=$_POST['im'];
$addr=$_POST["addr"];
$mail=$_POST["mail"];
//$id=$_SESSION["id"];
if (isset($_SESSION["id"])) 
{
	$id = $_SESSION["id"];
}

if (isset($_POST["subscribe"])) 
{
	$subscribe = $_POST["subscribe"];
} 
else 
{
	$subscribe = 0;
}

//print_r($id);
//die();

$title="Регистрация";
$color="#aaaaff";
include("connect.php");
//$id = $_GET['id_покупатель'];
if($fam!="" && $im!="" && $addr!="" && $mail!="")
{
	$strSQL1="UPDATE покупатель SET фамилия='".$fam."', имя='".$im."',адрес='".$addr."', mail='".$mail."', рассылка='".$subscribe."' WHERE id_покупатель=".$id;
	$result1=$mysqli->query($strSQL1) or die("Не могу выполнить запрос: " .$strSQL1);
	$_SESSION["log"]=$fam." ".$im;
	// обновили значение сеансовой переменной
	$message="<tr><td bgcolor='#66cc66' align='center'>
	<b>Изменения данных выполнены</b></td></tr>";
}
else
{	
	$message="<tr><td bgcolor='#ff9999' align='center'>
	<b>Не все поля заполнены!!!</b></td></tr>";
	print $message;
}

include("header.php");
include("footer.php");
?>
