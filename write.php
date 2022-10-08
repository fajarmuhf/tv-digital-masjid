<?php
	if(isset($_GET["subuh"]) && isset($_GET["dzuhur"]) &&
		isset($_GET["ashar"]) && isset($_GET["magrib"]) &&
		isset($_GET["isha"]) && isset($_GET["sholat"])){
		
		$subuh = $_GET["subuh"];
		$dzuhur = $_GET["dzuhur"];
		$ashar = $_GET["ashar"];
		$magrib = $_GET["magrib"];
		$isha = $_GET["isha"];
		$sholat = $_GET["sholat"];
		
		$myfile = fopen("waktu.json", "w") or die("Unable to open file!");
		$txt = "{\n";
		fwrite($myfile, $txt);
		$txt = "\"subuh\" : $subuh,\n";
		fwrite($myfile, $txt);
		$txt = "\"dzuhur\" : $dzuhur,\n";
		fwrite($myfile, $txt);
		$txt = "\"ashar\" : $ashar,\n";
		fwrite($myfile, $txt);
		$txt = "\"magrib\" : $magrib,\n";
		fwrite($myfile, $txt);
		$txt = "\"isha\" : $isha,\n";
		fwrite($myfile, $txt);
		$txt = "\"sholat\" : $sholat\n";
		fwrite($myfile, $txt);
		$txt = "}";
		fwrite($myfile, $txt);
		fclose($myfile);
	}
?>