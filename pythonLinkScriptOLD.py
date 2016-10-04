import time
import serial

ser = serial.Serial('/dev/cu.usbmodem1411', 9600)

#ser.open()
time.sleep(5)

ser.write('000000255!')    

ser.write('255000000!')
ser.flushOutput()

time.sleep(10)
ser.write('000255000!')

ser.flushOutput()
time.sleep(10)
ser.write('000000255!')

ser.flushOutput()
time.sleep(10)
while(1):
	ser.write('255000000!')
	ser.flushOutput()
	time.sleep(1)


	time.sleep(1)


	ser.write('255020033!')
	ser.flushOutput()

	time.sleep(1)


	ser.write('255000111!')
	ser.flushOutput()

	time.sleep(1)


	ser.write('000255000!')
	ser.flushOutput()


#ser.close()
