#!/usr/bin/php
<?php

	$device=("/dev/ttyAMA0");
	$lcd=fopen($device,"wb+");
	fputs($lcd,chr(20));
	fputs($lcd,chr(150));
	fputs($lcd,chr(12));
//	fputs($lcd,'test');
//	fclose($lcd);

while (1) {
	$json_string = file_get_contents("http://DOMOTICZ_URL:DOMOTICZ_PORT/json.htm?type=devices&used=true&filter=all&favorite=1");
	$parsed_json = json_decode($json_string, true);
	$link = "/var/tmp/data.json";
	$data = fopen ($link, "w+");
	fwrite ($data, print_R($parsed_json, TRUE));
	fclose ($data);
	echo date('h:i:s')."\n";

	// first screen
	$parsed_json = $parsed_json['result'][0];
	$temp_ext = $parsed_json['Temp'];
	echo "Ext temp ".$temp_ext." C"."\n";
	fputs($lcd,"Ext temp ".$temp_ext." C"."\n");
	$parsed_json = json_decode($json_string, true);
	$parsed_json = $parsed_json['result'][0];
	$hum = $parsed_json['Humidity'];
	echo "Humidity ".$hum." %"."\n";
	fputs($lcd,"Ext hum  ".$hum." %"."\n");
	$parsed_json = json_decode($json_string, true);
	$parsed_json = $parsed_json['result'][2];
	$bar = $parsed_json['Barometer'];
	echo "Barometer ".$bar." mBar"."\n";
	fputs($lcd,"Barom    ".$bar." mb"."\n");

	echo  date("H:i d-m-Y")."\n";
	fputs($lcd,date("H:i    d-m-Y"."\n"));
	sleep(10);

	// second screen
	fputs($lcd,chr(12));
	$parsed_json = json_decode($json_string, true);
	$parsed_json = $parsed_json['result'][2];
	$temp_int = $parsed_json['Temp'];
	echo "Int temp ".$temp_int." C"."\n";
	fputs($lcd,"Int temp ".$temp_int." C"."\n");
	$parsed_json = json_decode($json_string, true);
	$parsed_json = $parsed_json['result'][1];
	$rain = $parsed_json['Rain'];
	echo "Rain     ".$rain." mm"."\n";
	fputs($lcd,"Rain     ".$rain." mm"."\n\n");
	echo  date("H:i d-m-Y")."\n";
	fputs($lcd,date("H:i    d-m-Y"."\n"));
	sleep(10);

	fputs($lcd,chr(12));
}
?>
