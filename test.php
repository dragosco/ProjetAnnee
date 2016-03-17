<?php
require("LoiProbabilite.php");
require("LoiTriangulaire.php");
require("LoiNormale.php");
require("LoiNormaleTronquee.php");
require("LoiBeta.php");
require("LoiRand.php");

$nbEchantillons = 10000;

$lb = new LoiBeta(0,60,1.5,2);
$lnt = new LoiNormaleTronquee(0,50,25,5);
$lt = new LoiTriangulaire(0,55,1.5);
$lr = new LoiRand(0,45);

$nbCat = 22;
for($cc = 0; $cc <= $nbCat; $cc++)
	$distrib[$cc] = 0;

for($i=0; $i<$nbEchantillons; $i++)
{
	$ech1 = $lb->generate();
	$ech2 = $lnt->generate();
	$ech3 = $lt->generate();
	$ech4 = $lr->generate();
	$ech = $ech1 + $ech2 + $ech3 + $ech4;
	$index = floor($ech/10);
	$distrib[$index] ++;
}

for($cc = 0; $cc < $nbCat; $cc++)
{
	for($ll = 0; $ll < ($distrib[$cc]); $ll++)
		echo('X');
	echo("<br>");
}
?>