<?php 
$title="Каталог";
$color="#aaddff";

include('header.php');
include('connect.php');

$query1 = "SELECT * FROM издатели";
$query2 = "SELECT * FROM категории";
$result1 = $mysqli->query($query1);
$result2 = $mysqli->query($query2);
?>
<tr><td>
<table border=0 width=100%>
<tr><td width="50%"><center><h3>Издатели</h3></center><ul>
<?php
while ($row1 = $result1->fetch_assoc()) 
{ ?>
<li><a href="show.php?type=1&id_pub=
<?php print $row1["id_издатель"];?>">
<?php print $row1["издатель"];?></a>
<?php }?> 
</ul></td>
<td width="50%"><center><h3>Категории</h3></center><ul>
<?php
while ($row2 = $result2->fetch_assoc())
{ ?>
<li><a href="show.php?type=2&id_cat=
<?php print $row2["id_категория"];?>">
<?php print $row2["категория"];?></a>
<?php }?> 	
 
</ul></td>
</tr>
</table>
</td></tr>
<?php
include('footer.php');
include("disconnect.php");
?>
