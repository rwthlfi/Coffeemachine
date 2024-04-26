from flask import Flask, render_template, request
import RPi.GPIO as GPIO
import time

GPIO.cleanup()

app = Flask(__name__)

relais_pins = [12, 1, 14, 7, 13, 21, 16, 20]

for pin in relais_pins:
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(pin, GPIO.OUT)
    GPIO.output(pin, GPIO.LOW)

def get_len(lst):
    return len(lst)


def relay_anschalten(relay_id):
    GPIO.output(relais_pins[relay_id - 1], GPIO.HIGH)  
    time.sleep(0.3)  
    GPIO.output(relais_pins[relay_id - 1], GPIO.LOW) 

@app.route('/')
def index():
    return render_template('index.html', relais_pins=relais_pins, get_len=get_len)  

@app.route('/toggle/<int:relay_id>', methods=['GET', 'POST'])
def toggle(relay_id):
    if request.method == 'POST':
        relay_anschalten(relay_id)
    return render_template('index.html', relais_pins=relais_pins, get_len=get_len)  

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8080)
