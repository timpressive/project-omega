#& /usr//bin/python2.7

from tendo import singleton
me = singleton.SingleInstance()

import wiringpi as wiringpi
import time
import sys

# SET PIN NUMBERS
DATA_H1  = 82
LATCH_H1 = 83
CLOCK_H1 = 84

DATA_H2  = 85
LATCH_H2 = 86
CLOCK_H2 = 87

DATA_M1  = 88
LATCH_M1 = 90
CLOCK_M1 = 89

DATA_M2  = 78
LATCH_M2 = 77
CLOCK_M2 = 76

DATA_S2  = 68
LATCH_S2 = 69
CLOCK_S2 = 70

DATA_S1  = 65
LATCH_S1 = 66
CLOCK_S1 = 67

MSBFIRST = 1

ON = 94
OFF = 95
PAUSE = 96
PENALTY = 97

# WIRINGPI SETUP
wiringpi.wiringPiSetup()

wiringpi.mcp23017Setup(65, 0x20)
wiringpi.mcp23017Setup(82, 0x21)

# SET PINS AS OUTPUTS
wiringpi.pinMode(DATA_S1,1)
wiringpi.pinMode(LATCH_S1,1)
wiringpi.pinMode(CLOCK_S1,1)

wiringpi.pinMode(DATA_S2,1)
wiringpi.pinMode(LATCH_S2,1)
wiringpi.pinMode(CLOCK_S2,1)

wiringpi.pinMode(DATA_M1,1)
wiringpi.pinMode(LATCH_M1,1)
wiringpi.pinMode(CLOCK_M1,1)

wiringpi.pinMode(DATA_M2,1)
wiringpi.pinMode(LATCH_M2,1)
wiringpi.pinMode(CLOCK_M2,1)

wiringpi.pinMode(DATA_H1,1)
wiringpi.pinMode(LATCH_H1,1)
wiringpi.pinMode(CLOCK_H1,1)

wiringpi.pinMode(DATA_H2,1)
wiringpi.pinMode(LATCH_H2,1)
wiringpi.pinMode(CLOCK_H2,1)

wiringpi.pinMode(ON, 1)
wiringpi.pinMode(OFF, 1)
wiringpi.pinMode(PAUSE, 1)
wiringpi.pinMode(PENALTY, 1)

wiringpi.digitalWrite(ON, 1)
wiringpi.digitalWrite(OFF, 0)
wiringpi.digitalWrite(PAUSE, 0)
wiringpi.digitalWrite(PENALTY, 0)

duration = int(sys.argv[1])
end = int(time.time() + duration)

def padZero(number):
	if len(str(number)) == 1:
		number = "0" + str(number)
	else:
		number = str(number)
	return number

def countdown():
	wiringpi.digitalWrite(ON, 1)

	global end
	remaining = int(end - time.time())

	while remaining > 0:

		doClock(remaining)

#		hours   = remaining / 3600
#		minutes = (remaining - (hours * 3600)) / 60 
#		seconds = (remaining - (hours * 3600)) % 60
#
#		hours = padZero(hours)
#		minutes = padZero(minutes)
#		seconds = padZero(seconds)
#
#		h1 = list(hours)[0]
#		h2 = list(hours)[1]
#
#		m1 = list(minutes)[0]
#		m2 = list(minutes)[1]
#
#		s1 = list(seconds)[0]
#		s2 = list(seconds)[1]
#
#		writeNo(int(h1), LATCH_H1, DATA_H1, CLOCK_H1)
#		writeNo(int(h2), LATCH_H2, DATA_H2, CLOCK_H2)
#		
#		writeNo(int(m1), LATCH_M1, DATA_M1, CLOCK_M1)
#		writeNo(int(m2), LATCH_M2, DATA_M2, CLOCK_M2)
#
#		writeNo(int(s1), LATCH_S1, DATA_S1, CLOCK_S1)
#		writeNo(int(s2), LATCH_S2, DATA_S2, CLOCK_S2)
		
		if wiringpi.digitalRead(PENALTY) and (end - time.time()) > 300:
                	end -= 300
			wiringpi.digitalWrite(PENALTY, 0)

		if wiringpi.digitalRead(PAUSE):
			while wiringpi.digitalRead(PAUSE):
				pass
			end = time.time() + remaining

		remaining = int(end - time.time())

		if wiringpi.digitalRead(OFF):
			wiringpi.digitalWrite(OFF, 0)
			remaining = 0

		pass
	

	turnOff()

# takes latch, clock and data pins and number to be written  for positions
# switches number to binary representation on 7-seg display and shifts it out
def writeNo(number, latch_pin, data_pin, clock_pin):
	if number == 0:
		number = 63
	elif number == 1:
		number = 6
	elif number == 2:
		number = 91
	elif number == 3:
		number = 79
	elif number == 4:
		number = 102
	elif number == 5:
		number = 109
	elif number == 6:
		number = 125
	elif number == 7:
		number = 7
	elif number == 8:
		number = 127
	elif number == 9:
		number = 103
	elif number == 10:
		number = 0
	else:
		number = 63


	wiringpi.digitalWrite(latch_pin, 0)
	wiringpi.shiftOut(data_pin, clock_pin, MSBFIRST, number)
	wiringpi.digitalWrite(latch_pin, 1)

# Remove all writing from 7-seg displays by setting all segments low
def turnOff():
	writeNo(10, LATCH_S1, DATA_S1, CLOCK_S1)
	writeNo(10, LATCH_S2, DATA_S2, CLOCK_S2)
	writeNo(10, LATCH_M1, DATA_M1, CLOCK_M1)
	writeNo(10, LATCH_M2, DATA_M2, CLOCK_M2)
	writeNo(10, LATCH_H1, DATA_H1, CLOCK_H1)
	writeNo(10, LATCH_H2, DATA_H2, CLOCK_H2)

	# indicate the game has stopped command	
	wiringpi.digitalWrite(ON, 0)

def doClock(remaining):
	hours   = remaining / 3600
        minutes = (remaining - (hours * 3600)) / 60
        seconds = (remaining - (hours * 3600)) % 60

        hours = padZero(hours)
        minutes = padZero(minutes)
        seconds = padZero(seconds)

        h1 = list(hours)[0]
        h2 = list(hours)[1]

        m1 = list(minutes)[0]
        m2 = list(minutes)[1]

        s1 = list(seconds)[0]
        s2 = list(seconds)[1]

        writeNo(int(h1), LATCH_H1, DATA_H1, CLOCK_H1)
        writeNo(int(h2), LATCH_H2, DATA_H2, CLOCK_H2)

        writeNo(int(m1), LATCH_M1, DATA_M1, CLOCK_M1)
        writeNo(int(m2), LATCH_M2, DATA_M2, CLOCK_M2)

	writeNo(int(s1), LATCH_S1, DATA_S1, CLOCK_S1)
	writeNo(int(s2), LATCH_S2, DATA_S2, CLOCK_S2)

countdown()
