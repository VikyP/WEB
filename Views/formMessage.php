<?php

function myAlert($message)
{
	if($message=="")
		return;
	echo "<form name ='frame'>";
	echo "<div class='testForm' >";
	echo "<img class='buttonT' src='./Site_Images/remove.png' title='Отменить' onclick='Cancel(); return false;' /> ";
	echo "<table class='tableL'  >";
	echo "<tr><td>";
	echo $message;
	echo "</td></tr>";
	echo "<tr><td>";
	echo "<input  class='button button-gray' type='submit' onclick='Cancel(); return false;' value ='Закрыть'/>";
	echo "</td></tr>";
	echo "</table>";
	echo "</div>";
	echo "</form>";
}