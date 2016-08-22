import wiringpi as wiringpi
import sys
from time import sleep

function = sys.argv[1]
ON = 94
OFF = 95
PAUSE = 96
PENALTY = 97

wiringpi.wiringPiSetup()

wiringpi.mcp23017Setup(82, 0x21)
#wiringpi.pinMode(ON, 1)
#wiringpi.pinMode(OFF, 1)
#wiringpi.pinMode(PAUSE, 1)
#wiringpi.pinMode(PENALTY, 1)

def stopTimer() :
	wiringpi.digitalWrite(OFF, 1)

def togglePause():
	state = wiringpi.digitalRead(PAUSE)
	wiringpi.digitalWrite(PAUSE, not state)

def penalty():
	wiringpi.digitalWrite(PENALTY, 1)

def getPaused():
	print wiringpi.digitalRead(PAUSE)

def getStarted():
	print wiringpi.digitalRead(ON)


if function == "stop":
	stopTimer()
elif function == "pause":
	togglePause()
elif function == "penalty":
	penalty()
elif function == "paused":
	getPaused()
elif function == 'started':
	getStarted()
