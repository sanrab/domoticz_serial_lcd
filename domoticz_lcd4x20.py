#!/usr/bin/python

import urllib
import json
import time

#read domoticz data from my_station

while 1:
    url="http://raspi-meteo.local:8080/json.htm?type=devices&used=true&filter=all&favorite=1"

    data = json.load(urllib.urlopen(url))

    #print(json.dumps(data, indent=4, sort_keys=True))

    parsed_json = data['result'][1]
    temp= parsed_json['Temp']

    parsed_json = data['result'][1]
    hum = parsed_json['Humidity']

    parsed_json = data['result'][2]
    dir = parsed_json['Direction']

    parsed_json = data['result'][2]
    speed = parsed_json['Speed']

    parsed_json = data['result'][0]
    rain = parsed_json['Rain']

    print 'Temp: ',temp,'Hum: ',hum,'Wind dir: ',dir,'Wind speed: ',speed,'Rain: ',rain

    time.sleep(5)
