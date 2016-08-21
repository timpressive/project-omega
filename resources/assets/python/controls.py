import sys
import wiringpi
import sleep from time

function = argv[1]
OFF = 83
PAUSE = 84
PENALTY = 84

wiringpi.mcp23017(81, 0x27)
wiringpi.pinMode(OFF, 1)
wiringpi.pinMode(PAUSE, 1)
wiringpi.pinMode(PENALTY, 1)

def stopTimer() :
	wiringpi.digitalWrite(OFF, 1)

def togglePause():
	state = wiringpi.digitalRead(PAUSE)
	wiringpi.digitalWrite(PAUSE, not state)

def penalty():
	wiringpi.digitalWrite(PENALTY, 1)
	
if function == "stop":
	stopTimer()
elif function == "pause":
	togglePause()
elif function == "penalty":
	penalty()
