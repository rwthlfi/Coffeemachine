import smbus
import time

# ADS7830 I2C-Adresse
ADC_ADDRESS = 0x4b

# Erstelle ein SMBus-Objekt
bus = smbus.SMBus(1)

def read_voltage(channel):
    # Wähle den ADC-Kanal (0-7)
    channel = channel & 0x07

    # Sende das Befehlswort zum Lesen des ADC-Werts für den ausgewählten Kanal
    command = 0x84 | (channel << 4)
    bus.write_byte(ADC_ADDRESS, command)

    # Lese den ADC-Wert (12 Bit) von den zwei Bytes
    value = bus.read_word_data(ADC_ADDRESS, 0)

    # Tausche die Bytes und berechne die tatsächliche Spannung (0-4.096V)
    voltage = ((value & 0xFF) << 4) | ((value & 0xF00) >> 8)
    voltage = voltage * 4.096 / 4095.0

    return voltage

def main():
    try:
        while True:
            voltage = read_voltage(0)  # Lese den ADC-Wert für Kanal 0 (hier musst du den gewünschten Kanal angeben)
            if voltage >= 0.4:
                print(f"LED ist eingeschaltet (Spannung: {voltage:.2f} Volt)")
            else:
                print(f"LED ist ausgeschaltet (Spannung: {voltage:.2f} Volt)")
            
            time.sleep(1)  # Führe die Messung alle 1 Sekunde erneut aus.
    except KeyboardInterrupt:
        pass

if __name__ == '__main__':
    main()
