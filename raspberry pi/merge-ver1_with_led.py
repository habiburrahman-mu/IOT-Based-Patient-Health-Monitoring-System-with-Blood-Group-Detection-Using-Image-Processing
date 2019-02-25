import RPi.GPIO as GPIO
import requests
import cv2
import numpy as np
import warnings

warnings.filterwarnings("ignore")

def cap_pic():
    #windowName = "Live Video Feed"
    #cv2.namedWindow(windowName)
    cap = cv2.VideoCapture(0)
    
    if cap.isOpened():
        ret, frame = cap.read()
        cv2.imwrite("img.jpg",frame)
        #output = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        #cv2.imshow("Gray", output)
        #cv2.imshow(windowName, frame)
        #cv2.waitKey(0)
        #cv2.destroyAllWindows()
    cap.release();

def know_grp():
    cap_pic()
    path = "img.jpg"
    
    img2 = cv2.imread(path)
    
    img = cv2.resize(img2, (280,313), interpolation = cv2.INTER_AREA)
    
    hsv = cv2.cvtColor(img, cv2.COLOR_BGR2HSV)
    low = np.array([100, 50, 50])
    high = np.array([140, 255, 255])
    mask = cv2.inRange(hsv, low, high)
    
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    
    H,W,y = img.shape
    
    
    blur = cv2.GaussianBlur(gray,(5,5),0)
    ret3,binary = cv2.threshold(blur,120,255,cv2.THRESH_BINARY)
    #ret3,binary = cv2.threshold(blur,0,255,cv2.THRESH_BINARY+cv2.THRESH_OTSU)
    
    list1 = []
    list2 = []
    list3 = []
    
    count = 0
    
    for i in range(H):
        count = 0
        for j in range(W):
            if j < W-1:
                a = abs(mask[i,j] - mask[i,(j+1)])
                if a > 0:
                   count += 1
        
        j = 0
        
        if count > 2:
            new_count = 0
            for j in range(W):
                b = 0
                if j < W-1:
                   b = abs(mask[i,j] - mask[i,(j+1)])
                if b > 0:
                   new_count += 1
                if new_count == 2 and binary[i,j] == 0:
                   list1.append(gray[i,j])
                elif new_count == 4 and binary[i,j] == 0:
                   list2.append(gray[i,j])
                elif new_count == 6 and binary[i,j] == 0:
                   list3.append(gray[i,j])
                else:
                   continue    
    
    #print('list1 = ',len(list1))
    #print('list2 = ',len(list2))
    #print('list3 = ',len(list3))
    
    if (len(list1) <= 2000) and (len(list2) <= 2000) and (len(list3) <= 2000):
        return("AB Positive")
    
    
    elif (len(list1) <= 2000) and (len(list2) <= 2000):
        return("AB Negative")
    
    
    elif (len(list2) <= 2000) and (len(list3) <= 2000):
        return("B Positive")
    
    
    elif (len(list1) <= 2000) and (len(list3) <= 2000):
        return("A Positive")
    
    
    elif len(list1) <= 2000:
        return("A Negative")
    
    
    elif len(list2) <= 2000:
        return("B Negative")
    
    
    elif len(list3) <= 2000:
        return("O Positive")
    
    
    elif (len(list1) >= 2000) and (len(list2) >= 2000) and (len(list3) >= 2000):
        return("O Negative")   
    
    #cv2.imshow('main image',img2)
    #cv2.imshow('resize image',img)
    #cv2.imshow('mask image',mask)
    #cv2.imshow('gray image',gray)
    #cv2.imshow('binary image',binary)
    #cv2.imshow('blur image',blur)


pin_serial_up = 2
pin_serial_up_led=3
state_serial_up = 1

pin_blood = 4
pin_blood_led = 14
state_blood = 1

GPIO.setmode(GPIO.BCM)
GPIO.setup(pin_serial_up, GPIO.IN)
GPIO.setup(pin_serial_up_led, GPIO.OUT, initial=GPIO.LOW)
GPIO.setup(pin_blood, GPIO.IN)
GPIO.setup(pin_blood_led, GPIO.OUT, initial=GPIO.LOW)
id = ""
while True:
    #print(GPIO.input(pin_serial_up)," ",GPIO.input(pin_serial_up) )
    if GPIO.input(pin_serial_up)==0:
		GPIO.output(pin_serial_up_led, GPIO.HIGH)
        print("Serial Start")
        url = 'http://192.168.0.113/medical/serial_up.php'
        req = requests.get(url)
        id = req.text
        print("Serial Next!")
		GPIO.output(pin_serial_up_led, GPIO.LOW)
    
    if GPIO.input(pin_blood)==0:
		GPIO.output(pin_blood_led, GPIO.HIGH)
        print("Blood Start")
        blood = know_grp()
        url = "http://192.168.0.113/medical/get_blood.php?id="+id+"&blood="+blood
        req = requests.get(url)
        print("Blood Done")
		GPIO.output(pin_blood_led, GPIO.LOW)
        
        
