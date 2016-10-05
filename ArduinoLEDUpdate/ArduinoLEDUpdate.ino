//Robert Curran, Quick Arduino script to set RGB LED strip to the correct colour based upon a recived serial string.

const int redPin = 8;
const int greenPin = 9;
const int bluePin = 13;

int setRed = 0;
int setGreen = 0;
int setBlue = 0;

//Comms
String inputString = "";         // a string to hold incoming data
boolean stringComplete = false;  // whether the string is complete

void setup() {
  // Start off with the LED off.
  setColourRgb(0,0,0);
  Serial.begin(19200);
  inputString.reserve(600);
}


void loop() {
  
  unsigned int rgbColour[3];

  rgbColour[0] = 255;
  rgbColour[1] = 0;
  rgbColour[2] = 0;  
 
 int red = 255;
 int green = 0;
 int blue = 0;
 int start = 0;
 int finish = 0;
 
  if (stringComplete) {
    start = 0;
    finish = 2;
    
    red = inputString.substring(start, finish).toInt();
    start = start + 3;
    finish = finish + 3;
    green = inputString.substring(start, finish).toInt();
    start = start + 3;
    finish = finish + 3;
    blue = inputString.substring(start, finish).toInt();
//    while(true){
//     // fadeBetween(255,255, 0,46, 25, 255);
//      //delay(1600);
//    }
    //fadeBetween(setRed,setGreen, setBlue,red, green, blue);
    //setColourRgb(red, green, blue);
    setColourRgb(red, green, blue);
    
      // clear the string:
    inputString = "";
    stringComplete = false;
  }
 

}

////Fade between to supplied RGB values, where sr is start and red,  fr is finish and red.
//void fadeBetween(int sr, int sg, int sb,int fr, int fg, int fb){
//  //Number of steps to change over.
//  int steps = 200;
//  
//  //get the steps
//  int rstep = (fr - sr) / steps;
//  int gstep = (fg = sg) / steps;
//  int bstep = (fg - sg) / steps;
//  
//  int currentr = sr;
//  int currentg = sg;
//  int currentb = sg;
//  
//   for (int stepsTaken = 0; stepsTaken < steps; stepsTaken++) {
//   
//        currentr = currentr + rstep;
//        currentg = currentg + gstep;
//        currentb = currentb + bstep;
//        setColourRgb(currentr, currentg, currentb);
//        delay(5);
//        
//    }
//  
//   setColourRgb(fr, fg, fb);
//
//}




void serialEvent() {
  while (Serial.available()) {
    // get the new byte:
    char inChar = (char)Serial.read();
    // add it to the inputString:
    inputString += inChar;
    // if the incoming character is a newline, set a flag
    // so the main loop can do something about it:
    if (inChar == '!') {
      stringComplete = true;
    }
  }
}

void setColourRgb(unsigned int red, unsigned int green, unsigned int blue) {
  analogWrite(redPin, red);
  analogWrite(greenPin, green);
  analogWrite(bluePin, blue);
  
  setRed = red;
  setGreen = green;
  setBlue = blue;

 }
