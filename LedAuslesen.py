from gpiozero import DigitalInputDevice
import time

LED_GPIO_PIN = 25

led_input = DigitalInputDevice(LED_GPIO_PIN)

try:
    while True:
        if led_input.is_active:
            print("LED ist eingeschaltet")
        else:
            print("LED ist ausgeschaltet")

        time.sleep(1)

except KeyboardInterrupt:
    print("Programm beendet")
