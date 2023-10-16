<?php

//$id_bask=$_COOKIE["id_bask"];
//$id_bask=$_COOKIE["id_cookies"];
$id_bask=$_COOKIE["id_bask"];

$title="Ваша корзина";
$color="#ddaaff"; 
include("header.php");
include("connect.php");

$strSQL1="SELECT COUNT(*) as count FROM корзина WHERE id_cookies='".$id_bask."'";
//print_r($strSQL1);
	//die();
//$strSQL1="SELECT COUNT(*) as count FROM корзина WHERE id_cookies='ID5f5f288d6c304'";
$result1=$mysqli->query($strSQL1) or die("Не могу выполнить запрос1!");
$row=$result1->fetch_assoc(); 
	//print_r($strSQL1);
	//die();
if($row["count"]==0)
	
{ ?>


<tr>
	<td bgcolor='#ff9999' align='center'><b>Ваша корзина пуста!</b></td>
</tr>

<?php

}
else
{
$strSQL1="SELECT обложка, автор, название, страницы, цена, количество, id_cookies, id_книга FROM книги, корзина WHERE книги.id_книга=корзина.FK_книги AND id_cookies='".$id_bask."'";
$result1=$mysqli->query($strSQL1) or die("Не могу выполнить запрос2!");
} ?>
<tr>
	<td>
		<table border="1" width="100%" align="right" >
<tr>
	<td align="right"><i>Автор: </i></td>
	<td align="right"><i>Название: </i></td>
	<td align="right"><i>Цена: </i></td>
	<td align="right"><i>Количество: </i></td>
	<td></td>
</tr>
<?php
$sum=0; while($row=$result1->fetch_assoc())
 { ?>
<tr>
	<td><?php print $row["автор"];?></td>
	<td><b><?php print $row["название"];?></b></td>
	<td><?php print $row["цена"];?></td>
	<td><?php print $row["количество"];?>
	<a href="dobasket.php?type=1&id_книга=<?php print $row["id_книга"];?>" title="Увеличить">[ + ]</a>
	<a href="dobasket.php?type=2&id_книга=<?php print $row["id_книга"];?>" title="Уменьшить">[ - ]</a></td>
	<td> <a href="dobasket.php?type=3&id_книга=<?php print $row["id_книга"];?>">Удалить</a></td>
</tr>
<?php 
$sum=$sum+$row["цена"]*$row["количество"];
}
?>
<tr><td align="right"></td><td align="right"><i>ИТОГО:
</i></td><td align="right"><?php print $sum;?></td><td align="right"></td></tr>
</table>
<tr><td><center><a href=dobasket.php?type=4>
<b>Очистить корзину</b></a></center></td></tr>
<tr><td><center><a href="order.php">
<b>Оформить заказ</b></a></center></td></tr>

<?php

include("footer.php");
?>
