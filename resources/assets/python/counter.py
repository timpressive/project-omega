import RPi.GPIO as GPIO
import time

GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
STROBE=27
DATA=17
CLOCK=4
OE=25

GPIO.setup(STROBE, GPIO.OUT)
GPIO.setup(DATA, GPIO.OUT)
GPIO.setup(CLOCK, GPIO.OUT)
GPIO.setup(OE, GPIO.OUT)

#Enable output
GPIO.output(OE, True)

def strb():

        GPIO.output(STROBE, False)
        GPIO.output(STROBE, True)
        return

while True:
        for n in range(16):
                GPIO.output(DATA, 1)
                GPIO.output(CLOCK, True)
                GPIO.output(CLOCK, False)

        strb()
        time.sleep(1)

        for n in range(16):
                GPIO.output(DATA, 0)
                GPIO.output(CLOCK, True)
                GPIO.output(CLOCK, False)

        strb()
        time.sleep(1)
