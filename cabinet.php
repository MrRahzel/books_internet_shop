<?php

$title="Личный кабинет";
$color="#aaaaff";
include("header.php");  
//$_SESSION["log"]=$row["фамилия"]." ".$row["имя"]; 
//$_SESSION["id"]=$row["id_покупатель"];
$id=$_SESSION["id"];
$log=$_SESSION["log"];

//print_r($id);
//die();

if(!isset($log))
{
	$success=false;
	$message="<tr><td bgcolor='#ff9999' align='center'>
	<b>Вы не авторизованы!!!</b></td></tr>";

}
else
{
	$success=true;
	$message="<tr><td bgcolor='#66cc66' align='center'>
	<b>Вы успешно авторизованы</b></td></tr>";
	$success=true;
	print $message;
	//include("header.php");
	//print $message;
}

if($success)
{
	include("connect.php");
	$strSQL="SELECT * FROM покупатель WHERE id_покупатель='".$id."'";
	$result=$mysqli->query($strSQL)	or die("Не могу выполнить запрос: " .$strSQL); 
	if($row=mysqli_fetch_array($result))
	{
?>
	<form action=change.php method=post>	
	<tr>
		<td><h2>Ваши личные данные</h2>
		<table border="0" width="100%" align="right" >
		<tr>
			<td align="right"><i>Фамилия: </i></td>
			<td><input type=text name=fam value="<?php print $row["фамилия"]?>"></td>
			<td align="right"><i>Имя: </i></td>
			<td><input type=text name=im value="<?php print $row["имя"]?>"></td>
		</tr>
		<tr>
			<td align="right"><i>Адрес: </i></td>
			<td><input type=text name=addr value="<?php print $row["адрес"]?>"></td>
			<td align="right"><i>E-mail: </i></td>
			<td><input type=text name=mail value="<?php print $row["mail"]?>"></td>
		</tr>
		<tr>
			<td align="right" colspan=3><i><input type="checkbox" value="1" name="subscribe"<?php if($row["рассылка"]==1) print "checked"; ?> >
				<tr>
					<td align="center" colspan="4"><input type="submit" value="сохранить изменения"></td>
				</tr>
		</table>
	</form>
			</td>
	</tr>
	<tr>
		<td><h2>Ваши заказы</h2>
			<?php
			$strSQL1="SELECT id_заказ, date_заказ FROM заказ WHERE FK_покупатель='".$id."' ORDER BY date_заказ DESC";
			$result1=$mysqli->query($strSQL1) or die("Не могу выполнить запрос1: " .$strSQL1);
			while($row1=mysqli_fetch_array($result1))
			{
				$order=$row1["id_заказ"];
				$strSQL2="SELECT автор, название, страницы, цена, количество, FK_заказ, книги.id_книга FROM книги,	состав_заказа WHERE книги.id_книга=состав_заказа.FK_книги
				and FK_заказ='".$order."'";
				$result2=$mysqli->query($strSQL2) or die("Не могу выполнить запрос2: " .$strSQL2);
				?>
				<tr>
					<tr>
						<table border="1" width="100%" align="right" >
						<td style="background: #ff6600;"><b>Заказ № <?php print($order)?> от <?php print $row1["date_заказ"]?></span><br></b>
							
							<tr>
								<td align="right" width="20%"><i>Автор: </i></td>
								<td align="right" width="50%"><i>Название: </i></td>
								<td align="right" width="15%"><i>Цена: </i></td>
								<td align="right" width="15%"><i>Количество: </i></td>
							</tr>
						</td>	
					</tr>
					<?php
					$sum=0; while($row2=mysqli_fetch_array($result2))
					{
						?>
						<tr>
							<td style="background: #008000;"><?php print $row2["автор"];?></td>
							<td><b><?php print $row2["название"];?></b></td>
							<td><?php print $row2["цена"];?></td>
							<td><?php print $row2["количество"];?></td>
						</tr>
						<?php 
						$sum=$sum+$row2["цена"]*$row2["количество"];
					}
					$strSQL3="SELECT категория FROM категории, заказ WHERE категории.id_категория=заказ.бонус AND
					id_заказ='".$order."'";
					$result3=$mysqli->query($strSQL3) or die("Не могу выполнить запрос3: " .$strSQL3); 

					if($row3=mysqli_fetch_array($result3))
					{?>

						<tr>
							<td colspan=2><span style="background-color: #00BFFF;">Бесплатный каталог по теме</span> <b>
							<span style="background-color: #008080;"><?php print $row3["категория"];?></span></b></td>
							<td>0</td>
							<td>1</td>
						</tr>
					<?}
					?>
						<tr>
							<td></td>
							<td align="right"><i>ИТОГО: </i></td>
							<td><?php print $sum;?></td>
							<td></td>
						</tr>
							</table>
				</tr>			
		</td>
	</tr>

	<?php
		}
	}
//mysql_close();
include("disconnect.php");
	}
}

?>
