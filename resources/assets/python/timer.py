#& /usr//bin/python2.7

import wiringpi as wiringpi
import time

# SET PIN NUMBERS
# DATA_H1  = 80
# LATCH_H1 = 81
# CLOCK_H1 = 82

DATA_H2  = 77
LATCH_H2 = 78
CLOCK_H2 = 79

DATA_M1  = 74
LATCH_M1 = 75
CLOCK_M1 = 76

DATA_M2  = 71
LATCH_M2 = 72
CLOCK_M2 = 73

DATA_S2  = 68
LATCH_S2 = 69
CLOCK_S2 = 70

DATA_S1  = 65
LATCH_S1 = 66
CLOCK_S1 = 67

MSBFIRST = 1
LSBFIRST = 0

OFF = 83
PAUSE = 84
PENALTY = 85

# WIRINGPI SETUP
wiringpi.wiringPiSetup()

wiringpi.mcp23017Setup(65, 0x20)
wiringpi.mcp23017Setup(81, 0x27)

# SET PINS AS OUTPUTS
wiringpi.pinMode(DATA_S1,1)
wiringpi.pinMode(LATCH_S1,1)
wiringpi.pinMode(CLOCK_S1,1)

wiringpi.pinMode(DATA_S2,1)
wiringpi.pinMode(LATCH_S2,1)
wiringpi.pinMode(CLOCK_S2,1)


duration = 60
end = int(time.time() + duration)

def padZero(number):
	if len(str(number)) == 1:
		number = "0" + str(number)
	else:
		number = str(number)
	return number

def countdown():
	
	remaining = int(end - time.time())

	while remaining > 0:
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

		# if minutes == 59:
		#	writeNo(h1, LATCH_H1, DATA_H1, CLOCK_H1)
		#	writeNo(h2, LATCH_H2, DATA_H2, CLOCK_H2)
		
		# if seconds == 59:
		#	writeNo(m1, LATCH_M1, DATA_M1, CLOCK_M1)
		#	writeNo(m2, LATCH_M2, DATA_M2, CLOCK_M2)


		writeNo(int(s1), LATCH_S1, DATA_S1, CLOCK_S1)
#		writeNo(OFF, LATCH_S1, DATA_S1, CLOCK_S1)

		writeNo(int(s2), LATCH_S2, DATA_S2, CLOCK_S2)
#		writeNo(OFF, LATCH_S2, DATA_S2, CLOCK_S2)
		
		if wiringPi.digitalRead(PENALTY) == 1 && (end - time.time() > 300):
                	end -= 300
			wiringpi.digitalWrite(PENALTY, 0)

		if wiringPi.digitalRead(PAUSE) == 1:
			end = time.time() + remaining


		if wiringPi.digitalRead(OFF) == 1:
			wiringpi.digitalWrite(OFF, 0)
			turnOff()

		remaining = int(end - time.time())
		pass
	

	writeNo(10, LATCH_S2, DATA_S2, CLOCK_S2)
	writeNo(10, LATCH_S1, DATA_S1, CLOCK_S1)
	print "Virus verspreiden..."
	time.sleep(2.5)
	print "Apocalypse gestart"

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
	wiringpi.digitalWrite(LATCH_S1, 0)
	wiringpi.shiftOut(DATA_S1, CLOCK_S1, MSBFIRST, 0)
	wiringpi.digitalWrite(LATCH_S1, 1)

	wiringpi.digitalWrite(LATCH_S2, 0)
        wiringpi.shiftOut(DATA_S2, CLOCK_S2, MSBFIRST, 0)
        wiringpi.digitalWrite(LATCH_S2, 1)

	wiringpi.digitalWrite(LATCH_M1, 0)
        wiringpi.shiftOut(DATA_M1, CLOCK_M1, MSBFIRST, 0)
        wiringpi.digitalWrite(LATCH_M1, 1)

	wiringpi.digitalWrite(LATCH_M2, 0)
        wiringpi.shiftOut(DATA_M2, CLOCK_M2, MSBFIRST, 0)
        wiringpi.digitalWrite(LATCH_M2, 1)

	wiringpi.digitalWrite(LATCH_H1, 0)
        wiringpi.shiftOut(DATA_H1, CLOCK_H1, MSBFIRST, 0)
        wiringpi.digitalWrite(LATCH_H1, 1)

	wiringpi.digitalWrite(LATCH_H2, 0)
        wiringpi.shiftOut(DATA_H2, CLOCK_H2, MSBFIRST, 0)
        wiringpi.digitalWrite(LATCH_H2, 1)

countdown()
