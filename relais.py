import RPi.GPIO as GPIO
import time

GPIO.setmode(GPIO.BCM)

# GPIO-Pins

pinList = [5, 6, 13, 19, 16, 26, 20, 21]

# durch Pins durchlaufen

for i in pinList:
    GPIO.setup(i, GPIO.OUT)
    GPIO.output(i, GPIO.HIGH)

SleepTimeL = 0.2

# Loop

try:
  while True:

    for i in pinList:
        
        GPIO.output(i, GPIO.HIGH)
        time.sleep(SleepTimeL);
        GPIO.output(i, GPIO.LOW)

    pinList.reverse()

    for i in pinList:
        GPIO.output(i, GPIO.HIGH)
        time.sleep(SleepTimeL);
        GPIO.output(i, GPIO.LOW)

    pinList.reverse()

# End
except KeyboardInterrupt:
  print("Ende")

  GPIO.cleanup()