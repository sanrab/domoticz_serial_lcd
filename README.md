# domoticz_serial-lcd
display domoticz data on 4x20 serial lcd

php script to display Domoticz weather data on 4x20 lcd display

NOTES:
on raspberry put /tmp in RAM to minimize SD writing

serial lcd (Netmedia) connections
5V --> GPIO 2
GND --> GPIO 6
RXD --> GPIO 8 (TXD)


#!/usr/bin/php
<?php

        $device=("/dev/ttyAMA0");
        $lcd=fopen($device,"wb+");
        fputs($lcd,chr(20));
        fputs($lcd,chr(200));
        fputs($lcd,chr(12));

while (1) {
        $json_string = file_get_contents("http://192.168.1.134:8080/json.htm?type=devices");
        $parsed_json = json_decode($json_string, true);
        $test_link = "/var/tmp/temp_data.txt";
        $test_data = fopen ($test_link, "w+");
        fwrite ($test_data, print_R($parsed_json, TRUE));
        fclose ($test_data);
        echo date('h:i:s')."\n";
        $parsed_json = $parsed_json['result'][1];
        $temp = $parsed_json['Temp'];
        echo "Temperature ".$temp." C"."\n";
        fputs($lcd,"Temp = ".$temp." C"."\n");
        $parsed_json = json_decode($json_string, true);
        $parsed_json = $parsed_json['result'][1];
        $hum = $parsed_json['Humidity'];
        echo "Humidity ".$hum." %"."\n";
        fputs($lcd,"Hum  = ".$hum." %"."\n");
        $parsed_json = json_decode($json_string, true);
        $parsed_json = $parsed_json['result'][0];
        $bar = $parsed_json['Barometer'];
        echo "Barometer ".$bar." mBar"."\n";
        fputs($lcd,"Bar  = ".$bar." mBar"."\n");
        echo  date("H:i d-m-Y")."\n";
        fputs($lcd,date("H:i     d-m-Y"."\n"));
        sleep(30);
        fputs($lcd,chr(12));
}
?>
