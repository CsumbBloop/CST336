<?php

 $deck = array();

for ($i = 0; $i < 52; $i++) {
	$deck[] = $i;
}

shuffle($deck);

$people = array();
$points = array(0, 0, 0, 0);
$hands = array();
$winner = array("", "", "", "");


function getPlayer($pic) {
	global $people;

	
	if ($pic == 2) {
		$temp = "<img src= 'players/" . $pic . ".jpg'/>";
	} else {
		$temp = "<img src= 'players/" . $pic . ".jpg'/>";
	}
	
	array_push($people, $temp);
#	shuffle($people);
	#array_rand($people);
	

}

function getHand($player) {


	global $deck;
	global $hands;
	global $points;
	$total = rand(4, 6);

	for ($i = 0; $i < $total; $i++) {

		$lastCard = array_pop($deck);
		$suitArray = array("clubs", "diamonds", "hearts", "spades");
		$number = (($lastCard % 13) + 1);
		$points[$player] += $number;
		$temp = "<img src= 'cards/" . $suitArray[floor($lastCard / 13)] . "/" . $number . ".png'/>";
		
		array_push($hands, $temp);
		
	}
	array_push($hands, "0");

}


function draw() {
	global $points;
	global $hands;
	global $winner;
	global $people;

	$k = 0;
	echo "<table border = 1>";
	echo "<tr>";
	echo "<td>";
	echo "People";
	echo "</td>";
	
	for ($i = 0; $i < 6; $i++) {

		echo "<td>";
		echo $temp;
		echo "</td>";

	}
	echo "<td>";
	echo "Points";
	echo "</td>";
	echo "<td>";
	echo "Winner?";
	echo "</td>";
	echo "</tr>";
	
	for ($i = 0; $i < 4; $i++)
	{
		echo "<tr>";

		echo "<td>";
		
		echo $people[$i];
		echo "</td>";

		for ($j = 0; $j < 6; $j++) {

			while ($hands[$k] != "0") {
				echo "<td>";
				echo $hands[$k];
				echo "</td>";
				
				$k++;
				$j++;

			}
			if ($j < 6) {
				echo "<td>";

				echo "</td>";
			}

		}

		$k++;
		echo "<td>";
		echo $points[$i];
		echo "</td>";
		echo "<td>";
		echo $winner[$i];
		echo "</td>";
		echo "</tr>";

	}
	
	echo "</table>";

}
function deal() {

	for ($i = 0; $i < 4; $i++)
	{
		getPlayer($i);
		getHand($i);
	}
	
	getWinner();
	draw();
	

}

function getWinner() {
	global $points;
	global $hands;
	global $winner;
	global $people;
	global $randPlayers;

	$temp = "";
	$nameArray = array("Cartmen", "Kenny", "Kyle", "Stan");
	

	$max = 0;
	
	$index = 0;
	for ($i = 0; $i < 4; $i++) {
		if ($points[$i] <= 42 && $points[$i] > $max)
		{
			$max = $points[$i];
			$index = $i;
		}

	}
	if ($max != 0)
	{

		$temp .= $nameArray[$index] . " Wins!";
		$winner[$index] = $temp;
		
	} 
	else {
		$temp .= "No winner";
		$winner[3] = $temp;
	}

}
?>


<html>
    <head>
        <title> Lab 3 </title>
        <link rel="stylesheet" type="text/css" href="site.css">
    </head>
    <body>
        <div class="header">Lab 3</div><br><br>
       <div>
           <?php
           deal();
           ?>
       </div>
        <div class="footer">Created by Eric Haro</div>

    </body>
</html>