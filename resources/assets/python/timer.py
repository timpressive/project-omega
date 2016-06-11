import wiringpi as wiringpi
from time import sleep

# SET I2C ADDRESS AND BASE PIN NUMBER FOR I/O EXPANDER
pin_base = 65
i2c_addr = 0x20

# SET PIN NUMBERS
# DATA_H1  = 65
# LATCH_H1 = 66
# CLOCK_H1 = 67

DATA_H2  = 77
LATCH_H2 = 78
CLOCK_H2 = 79

DATA_M1  = 74
LATCH_M1 = 75
CLOCK_M1 = 76

DATA_M2  = 71
LATCH_M2 = 72
CLOCK_M2 = 73

DATA_S1  = 68
LATCH_S1 = 69
CLOCK_S1 = 70

DATA_S2  = 65
LATCH_S2 = 66
CLOCK_S2 = 67

MSBFIRST = 1
LSBFIRST = 0

# WIRINGPI SETUP
wiringpi.wiringPiSetup()
wiringpi.mcp23017Setup(pin_base,i2c_addr)

# SET PINS AS OUTPUTS
wiringpi.pinMode(DATA_S2,1)
wiringpi.pinMode(LATCH_S2,1)
wiringpi.pinMode(CLOCK_S2,1)


duration = 59
end = int(time.time() + duration)

def padZero(number):
	if len(str(number) == 1):
		number = "0" + number
	else:
		number = str(number)
	return number

def countdown():
	remaining = int(end - time.time())

	while remaining >= 0:
		hours   = padZero(remaining / 3600)
		minutes = padZero((remaining - (hours * 3600)) / 60) 
		seconds = padZero((remaining - (hours * 3600)) % 60)

		h1 = list(str(hours))[0]
		h2 = list(str(hours))[1]

		m1 = list(str(minutes))[0]
		m2 = list(str(minutes))[1]

		s1 = list(str(seconds))[0]
		s2 = list(str(seconds))[1]

		# if minutes == 59:
		#	writeNo(h1, LATCH_H1, DATA_H1, CLOCK_H1)
		#	writeNo(h2, LATCH_H2, DATA_H2, CLOCK_H2)
		
		# if seconds == 59:
		#	writeNo(m1, LATCH_M1, DATA_M1, CLOCK_M1)
		#	writeNo(m2, LATCH_M2, DATA_M2, CLOCK_M2)

		# writeNo(s1, LATCH_S1, DATA_S1, CLOCK_S1)
		writeNo(s2, LATCH_S2, DATA_S2, CLOCK_S2)
			
		print "%d:%2d:%3d" % (hours,minutes,seconds)
		time.sleep(1.0)
		remaining = int(end - time.time())
		pass
	
	print "Virus verspreiden..."
	time.sleep(2.5)
	print "Apocalypse gestart"

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
	else:
		number = 63


	wiringpi.digitalWrite(latch, 0)
	wiringpi.shiftOut(data_pin, clock_pin, MSBFIRST, number)
	wiringpi.digitalWrite(latch_pin, 1)

countdown()
