# domoticz_serial-lcd

php and python scripts to display Domoticz weather data (temperature, humidity, pressure) on serial 4x20 (Netmedia) lcd display

NOTES:
on raspberry put /tmp in RAM to minimize SD writing

serial lcd (Netmedia) connections
5V --> GPIO 2 (5V)
GND --> GPIO 6 (GND)
RXD --> GPIO 8 (TXD)

display updated every 30 sec
