# Bibliotheken laden
from gpiozero import Button, LED
from time import sleep
import random

led_1 = LED(17)
led_2 = LED(10)
led_3 = LED(9)

taste_1 = Button(27)
taste_2 = Button(22)

def spiel_start():
    led_1.off()
    led_2.off()
    led_3.off()
    # Zufällige Zeit 
    time = random.uniform(3, 8)
    sleep(time)
    led_3.on()

def taste1_gedrückt():
    if led_1.is_lit:
        spiel_start()
        return
    if led_3.is_lit:
        led_1.on()
        led_3.off()

def taste2_gedrückt():
    if led_2.is_lit:
        spiel_start()
        return
    if led_3.is_lit:
        led_2.on()
        led_3.off()

taste_1.when_pressed = taste1_gedrückt
taste_2.when_pressed = taste2_gedrückt

spiel_start()
