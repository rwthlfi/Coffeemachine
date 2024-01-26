from gpiozero import DigitalInputDevice
import time

LED_GPIO_PIN = 25

led_input = DigitalInputDevice(LED_GPIO_PIN)

def is_blinking(pin, interval, num_changes):
    changes = 0
    previous_state = pin.value
    start_time = time.time()

    while changes < num_changes:
        current_state = pin.value
        if current_state != previous_state:
            changes += 1
            previous_state = current_state
        if time.time() - start_time > interval:
            break

    return changes >= num_changes

previous_led_state = None

try:
    while True:
        led_state = None

        if is_blinking(led_input, 2, 2):
            led_state = "LED blinkt"
        elif led_input.is_active:
            led_state = "LED ist ausgeschaltet"
        else:
            led_state = "LED ist eingeschaltet"

        if led_state != previous_led_state:
            print(led_state)
            previous_led_state = led_state
        
        time.sleep(1)

except KeyboardInterrupt:
    print("Programm beendet")
