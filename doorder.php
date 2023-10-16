<?php

$log=$_SESSION["log"];
$id=$_SESSION["id"];
$id_bask=$_COOKIE["id_bask"];
//$dostavka=$_POST["dostavka"];
//$bonus=$_POST["bonus"];
if (isset($_POST["dostavka"])) 
{
	$dostavka = $_POST["dostavka"];
} 
else 
{
	$dostavka = 0;
}

if (isset($_POST["bonus"])) 
{
	$bonus = $_POST["bonus"];
} 
else 
{
	$bonus = 0;
}
$title="Ваш заказ";
$color="#ffaaff"; 

include("connect.php");

if(!isset($log))
{	
	$message="<tr><td bgcolor='#ff9999' align='center'>
	<b>Вы не авторизованы!!!</b></td></tr>";
} 
else
{ 
	$strSQL1="SELECT COUNT(*) as count FROM корзина WHERE id_cookies='".$id_bask."'";
	$result1=$mysqli->query($strSQL1) or die("Не могу выполнить запрос: " .$strSQL1);
	$row=mysqli_fetch_array($result1); 

	if($row["count"]==0)
	$message="<tr><td bgcolor='#ff9999' align='center'>
	<b>Ваша корзина пуста!</b></td></tr>"; 
	else
	{
		// создаем новый заказ
		$order=uniqid("OR");
		$strSQL="INSERT INTO заказ (id_заказ, date_заказ, FK_покупатель, доставка, бонус) VALUES ('".$order."',CURDATE(),".$id.",'".$dostavka."','".$bonus."')"; 
		$mysqli->query($strSQL) or die("Не могу выполнить запрос1: " .$strSQL);
		// читаем все из корзины покупателя
		$strSQL="SELECT * FROM корзина WHERE id_cookies='".$id_bask."'";
		$result=$mysqli->query($strSQL) or die("Не могу выполнить запрос2: " .$strSQL);
		while ($row=mysqli_fetch_array($result))
		{
			// и переписываем в состав заказа
			$strSQL="INSERT INTO состав_заказа (FK_заказ, FK_книги, количество) VALUES ('".$order."',".$row["FK_книги"].",".$row["количество"].")"; 
			$mysqli->query($strSQL)	or die("Не могу выполнить запрос3: " .$strSQL);
		}
		// очищаем корзину покупателя
		$strSQL="DELETE FROM корзина WHERE id_cookies='".$id_bask."'";
		$mysqli->query($strSQL) or die("Не могу выполнить запрос4: " .$strSQL);

		$uniq_ID=uniqid("ID");
		setcookie("id_bask", $uniq_ID, time()+60*60*24*14);
		$message="<tr><td bgcolor='#66cc66' align='center'>
		<b>Ваш заказ отправлен</b></td></tr>";
	}
}

include("header.php"); 
print $message; 
include("footer.php"); 
?>
