<?php

if (isset($_GET["id_книга"]))
{
	$id_book = $_GET["id_книга"];
} 

$int= rand(1262055681,1262055681);
$data = date("Y-m-d",$int);

include("connect.php"); 

if (isset($_GET["type"])) 
{
	$type = $_GET["type"];
} 
else 
{
	$type = 0;
}

$id_bask=$_COOKIE["id_bask"];
//die($id_bask);
//$id_bask=uniqid("ID");
// положить в корзину
if ($type == 1) 
{
	
	$strSQL2 = "SELECT * FROM корзина WHERE FK_книги=".$id_book." AND id_cookies='".$id_bask."'";
	//print_r($strSQL2);
	//die();
	$booksDeleted = $mysqli->query($strSQL2) or die("Не могу выполнить запрос1!: " .$strSQL2); 
	$num_rows = mysqli_num_rows($booksDeleted);

	if ($num_rows == 0)
	{

		$strSQL2 = "INSERT INTO корзина (id_cookies, FK_книги, количество, дата_корзина) VALUES ('".$id_bask."',".$id_book.",1, '".$data."')";
		
	}
	else
	{
		$strSQL2 = "UPDATE корзина SET количество=количество+1 WHERE FK_книги=".$id_book." AND id_cookies='".$id_bask."'";
		
	}

	$result2 = $mysqli->query($strSQL2) or die("Не могу выполнить запрос2!: " .$strSQL2);
}

// уменьшить количество
if ($type == 2) 
{
	$strSQL2 = "SELECT * FROM корзина WHERE FK_книги=".$id_book." AND id_cookies='".$id_bask."'";
	$result2=$mysqli->query($strSQL2) or die("Не могу выполнить запрос3!: " .$strSQL2);

	if ($row=$result2->fetch_assoc())
	{
		if ($row["количество"]>1)
		{
			$strSQL2="UPDATE корзина SET количество=количество-1 WHERE FK_книги=".$id_book." AND id_cookies='".$id_bask."'";
		}
	}
	else
	{
		$strSQL2="DELETE FROM корзина WHERE FK_книги=".$id_book." AND id_cookies='".$id_bask."'";
	}

	$result2 = $mysqli->query($strSQL2) or die("Не могу выполнить запрос4!: " .$strSQL2);	
}

// удалить из корзины
if ($type == 3) 
{
	$strSQL2="DELETE FROM корзина WHERE FK_книги=".$id_book." AND id_cookies='".$id_bask."'";
	$result2=$mysqli->query($strSQL2) or die("Не могу выполнить запрос5!: " .$strSQL2);
}

// очистить корзину
if ($type == 4) 
{
	$strSQL2="DELETE FROM корзина WHERE id_cookies='".$id_bask."'";
	$result2=$mysqli->query($strSQL2) or die("Не могу выполнить запрос6!: " .$strSQL2);
}
include("basket.php");
?>
