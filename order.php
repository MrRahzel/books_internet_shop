<?php
$id_bask=$_COOKIE["id_bask"];

$title="Ваш заказ";
$color="#ffaaff";
include("header.php"); 
include("connect.php");

$strSQL1="SELECT COUNT(*) as count FROM корзина WHERE id_cookies='".$id_bask."'";
$result1=$mysqli->query($strSQL1) or die("Не могу выполнить запрос: " .$strSQL1);
$row=mysqli_fetch_array($result1); 

if($row["count"]==0)
{
	?>
	<tr>
		<td bgcolor='#ff9999' align='center'><b>Ваша корзина пуста!</b></td>
	</tr>
	<?php
}
else
{
	$strSQL1="SELECT обложка, автор, название, страницы, цена, количество, id_cookies, книги.id_книга FROM книги, корзина WHERE книги.id_книга=корзина.FK_книги AND id_cookies='".$id_bask."'";
	$result1=$mysqli->query($strSQL1) or die("Не могу выполнить запрос1: " .$strSQL1);

	?>
	<tr>
		<td>
		<table border="1" width="100%" align="right" >
			<tr>
				<td align="right"><i>Автор: </i></td>
				<td align="right"><i>Название: </i></td>
				<td align="right"><i>Цена: </i></td>
				<td align="right"><i>Количество: </i></td>
			</tr>
	<?php
	$sum=0; 
	while($row=mysqli_fetch_array($result1))
	{
	?>
			<tr>
				<td><?php print $row["автор"];?></td>
				<td><b><?php print $row["название"];?></b></td>
				<td><?php print $row["цена"];?></td>
				<td><?php print $row["количество"];?></td>
			</tr>
		<?php
		$sum=$sum+$row["цена"]*$row["количество"];
	}
	?>
			<tr>
				<td></td>
				<td align="right"><i>ИТОГО: </i></td>
				<td><?php print $sum;?></td>
				<td></td>
			</tr>
		</table>
		<form action="doorder.php" method="post">
	<tr>
		<td><br><b>Способ доставки:</b> 
		<input type="radio" name="dostavka" value=1> почта России
		<input type="radio" name="dostavka" value=2> курьер
		<input type="radio" name="dostavka" value=3> самовывоз
		</td>
	</tr>	
		<tr>
			<tr><td>Прислать бесплатный каталог по теме:
				<select name="bonus">
				<option value=0>			
	<?php
	$strSQL1="SELECT * FROM категории";
	$result1=$mysqli->query($strSQL1) or die("Не могу выполнить запрос2: " .$strSQL1);
	while($row=mysqli_fetch_array($result1))
	{?>
		<option value="<?php print $row["id_категория"]?>">
		<?php print $row["категория"];
	}
	?>
				</td>
				</option>
			</option>
		</tr>
		<tr>
			<td><center>
				<!-- <a href=doorder.php><b>Отправить заказ</b></a> -->
				<input type="submit" value="Отправить заказ" />
			</center></td>
		</tr>
		</form>
	<?php
}

include("footer.php");
?>
