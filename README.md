Raspberry Pi thermostat
==========

With the [free] code in this repository, and less than $100, you can build your very own "WiFi Thermostat" that you can control with your smartphone or PC.

SEE DEMO IN ACTION: http://ericseastrand.com/thermostat/
 ** The current temperature readings will not change on the demo. You can still observe the cool/heat/fan components turn on and off when you set a higher or lower ideal temperature.


So how does this all work you might ask? It's REALLY simple!

The Pi already has an ambient-temperature sensor on it, which means we can use PHP to find thecurrent room temperature.

The web-interface tells you what the current room temperature is, and lets you set your ideal temperature.


Unlike traditional thermostats, there's no need to flip a "Cool | Off | Heat" switch whenever a cold front comes in.
The Pi automatically switches between Cooling and Heating modes, to maintain the ideal temperature you set.

It saves you a fortune -- not just on electricity -- but also on costly HVAC maintenance calls and repairs!

To prevent condensation from rusting and molding your evaporator coils:
  When the A/C turns off, the fan stays on to dry up any residual moisture. The default is 30 seconds, but the timer is fully configurable.


To prevent compressor burn-outs, and to prevent your system from "icing over", the Pi can (vaguely) monitor the refrigerant temperature by way of an (optional) thermistor, attached to the suction line (the large, cold, copper tube leaving your air-handler), or, ideally, to the evaporator coil itself.

If the refrigerant gets too cold, it will turn the condenser off until the coils warm up again, and suggest checking your filters for obstructions to air-flow.

If too hot, the condenser turns off, and your phone tells you "Contact a licensed professional immediately! Your A/C system has excessive superheating and has been shut down to protect it from breakage!"


Connect the Raspberry Pi to your network, and you can access the thermostat from any device on your network.
By setting up port-forwarding and dynamic-DNS, you can use ANY device with internet, from anywhere, even if you aren't at home!

Raspberry Pi itself : ~$40
SD card             : ~$15
SolidState Relays   : ~$15
MicroUSB charger    : ~$5

**** Don't use regular relays!! At worst, you will irreversibly fry your Pi. At best, your A/C won't work. ****
The Pi's 3.3v GPIO pins can't provide the current to operate a coil-relay. You can get a pre-built 4-relay board for about $10 bucks.
http://www.sainsmart.com/4-channel-5v-relay-module-for-pic-arm-avr-dsp-arduino-msp430-ttl-logic.html?___store=en
