from flask import Flask, render_template, request
from gpiozero import LED
import time

app = Flask(__name__)

# Define GPIO pins
pins = [12, 1, 7, 13, 20, 16, 21]

# Initialize LEDs (outputs) using gpiozero
leds = [LED(pin) for pin in pins]

for led in leds:
    led.off()

def get_len(lst):
    return len(lst)

def pin_anschalten(id):
    leds[id - 1].on()
    time.sleep(0.3)
    leds[id - 1].off()

@app.route('/')
def index():
    return render_template('index.html', pins=pins, get_len=get_len)

@app.route('/toggle/<int:id>', methods=['GET', 'POST'])
def toggle(id):
    if request.method == 'POST':
        pin_anschalten(id)
    return render_template('index.html', pins=pins, get_len=get_len)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8080)
