import time
import serial
import urllib2

ser = serial.Serial('/dev/tty.usbserial-AM01SILY', 19200)#/dev/cu.usbmodem1411'
time.sleep(1)
savedReponse = '';

while(1):
	response = urllib2.urlopen("https://webaddressgoeshere.com/ajax/getcolour?elementid=0").read()

	response = response + "!";

	
	if(response == savedReponse):
		print('No Change')
	else:
		print(response)
		ser.write(response)
		ser.flushOutput()
		savedReponse = response

	
	# ser.write('!')

	
	time.sleep(0.3)    



#ser.write('000000255!')


#ser.close()
