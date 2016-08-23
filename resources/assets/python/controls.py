import wiringpi as wiringpi
import sys
from time import sleep

function = sys.argv[1]

LOSE = 92
WIN = 93
ON = 94
OFF = 95
PAUSE = 96
PENALTY = 97

wiringpi.wiringPiSetup()

wiringpi.mcp23017Setup(82, 0x21)

wiringpi.pinMode(WIN, 1)
wiringpi.pinMode(LOSE, 1)
wiringpi.pinMode(LOSE, 1)
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

def getPaused():
	print wiringpi.digitalRead(PAUSE)

def getStarted():
	print wiringpi.digitalRead(ON)

def poll():
	if wiringpi.digitalRead(WIN):
		print 'win'
	elif wiringpi.digitalRead(LOSE):
		print 'lose'
	else:
		print 'playing'

def win():
	if wiringpi.digitalRead(LOSE) == 0 and wiringpi.digitalRead(ON) == 1:
		while wiringpi.digitalRead(ON):
			wiringpi.digitalWrite(WIN, 1)
		wiringpi.digitalWrite(WIN, 0)

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
elif function == 'poll':
	poll()
elif function == 'win':
	win()
