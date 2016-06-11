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
	
	# WRITE 0
	wiringpi.digitalWrite(LATCH_S2, 0)
	wiringpi.shiftOut(DATA_S2, CLOCK_S2, MSBFIRST, 63)
	wiringpi.digitalWrite(LATCH_S2, 1)
	sleep(1.0)


	# WRITE 1
	wiringpi.digitalWrite(LATCH_S2, 0)
	wiringpi.shiftOut(DATA_S2, CLOCK_S2, MSBFIRST, 6)
	wiringpi.digitalWrite(LATCH_S2, 1)
	sleep(1.0)


	# WRITE 2
	wiringpi.digitalWrite(LATCH_S2, 0)
	wiringpi.shiftOut(DATA_S2, CLOCK_S2, MSBFIRST, 91)
	wiringpi.digitalWrite(LATCH_S2, 1)
	sleep(1.0)

writeNo(0)
