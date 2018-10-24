#!/usr/bin/php
<?php

        $device=("/dev/ttyAMA0");
        $lcd=fopen($device,"wb+");
        fputs($lcd,chr(20));
        fputs($lcd,chr(200));
        fputs($lcd,chr(12));
//      fputs($lcd,'test');
//      fclose($lcd);

while (1) {
        $json_string = file_get_contents("http://192.168.1.134:8080/json.htm?type=devices");
        $parsed_json = json_decode($json_string, true);
        $test_link = "/var/tmp/test_1.txt";
        $test_data = fopen ($test_link, "w+");
        fwrite ($test_data, print_R($parsed_json, TRUE));
        fclose ($test_data);
        echo date('h:i:s')."\n";
        $parsed_json = $parsed_json['result'][1];
        $temp = $parsed_json['Temp'];
        echo "Temperature ".$temp." C"."\n";
        fputs($lcd,"Ext temp ".$temp." C"."\n");
        $parsed_json = json_decode($json_string, true);
        $parsed_json = $parsed_json['result'][1];
        $hum = $parsed_json['Humidity'];
        echo "Humidity ".$hum." %"."\n";
        fputs($lcd,"Ext hum  ".$hum." %"."\n");
        $parsed_json = json_decode($json_string, true);
        $parsed_json = $parsed_json['result'][0];
        $bar = $parsed_json['Barometer'];
        echo "Barometer ".$bar." mBar"."\n";
        fputs($lcd,"Barom    ".$bar." mb"."\n");
        echo  date("H:i d-m-Y")."\n";
        fputs($lcd,date("H:i    d-m-Y"."\n"));
        sleep(30);
        fputs($lcd,chr(12));
}
?>

   
