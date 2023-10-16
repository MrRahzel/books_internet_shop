<?php
$type=$_GET['type']; 
if ($type == 1)
{ $id_pub=$_GET['id_pub']; }
if ($type == 2)
{ $id_cat=$_GET['id_cat']; }

$mysqli = new mysqli("localhost","root","","books");
$mysqli->query("SET NAMES 'utf8'");

if ($type == 1)
{	$query3 = "SELECT id_книга, автор, название, издатели.издатель, страницы, цена, год_издания, обложка FROM книги, издатели where id_издатель = FK_издатель and книги.FK_издатель=".$id_pub; 
  } 
//else
if ($type == 2)
{   $query3 = "SELECT id_книга, автор, название, издатели.издатель, страницы, цена, год_издания, обложка FROM книги, издатели where id_издатель = FK_издатель and книги.FK_категория=".$id_cat;
  } 

$result3 = $mysqli->query($query3);
include("header.php");
?>

<tr><td>
<table border=1 width=100% align="right" >	
<?php
while ($row3 = $result3->fetch_assoc()) 
{ ?>
<tr>
<td align="center"><img  width = "200" src="images/<?php print $row3['обложка'];?>" alt="<?php print $row3["название"];?>" border="0">

<!--    -->
<center><a href="dobasket.php?type=1&id_книга=<?php print $row3['id_книга'];?>"><font size=-1> положить в корзину</font></a></center>  

</td>

<td>
<table>
<tr><td align="right"><i>Автор: </i></td>
<td><?php print $row3["автор"];?></td></tr>
<tr><td align="right"><i>Название: </i></td>
<td><?php print $row3["название"];?></td></tr>
<tr><td align="right"><i>Издательство: </i></td>
<td><?php print $row3["издатель"];?></td></tr>	
<tr><td align="right"><i>Количество страниц: </i></td>
<td><?php print $row3["страницы"];?></td></tr>
<tr><td align="right"><i>Цена: </i></td>
<td><?php print $row3["цена"];?></td></tr>
<tr><td align="right"><i>Год издания: </i></td>
<td><?php print $row3["год_издания"];?></td></tr>
</tr>
</table>

</td></tr>
<?php }?>
</table>
</td></tr>
<?php
include("footer.php");
?>
