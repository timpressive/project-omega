import wiringpi as wiringpi
from time import sleep

# SET I2C ADDRESS AND BASE PIN NUMBER FOR I/O EXPANDER
pin_base = 65
i2c_addr = 0x20

# SET PIN NUMBERS
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

def writeNo(number):
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


	wiringpi.digitalWrite(LATCH_S2, 0)
	wiringpi.shiftOut(DATA_S2, CLOCK_S2, MSBFIRST, number)
	wiringpi.digitalWrite(LATCH_S2, 1)

def loop():
	for i in range(0,10):
		writeNo(i)
		sleep(1.0)
		pass

loop()
