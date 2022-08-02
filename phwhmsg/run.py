import csv
import pywhatkit
import pyautogui as pg

msg = input("Enter Mssage")

with open('data/list.csv', newline='') as f:
    reader = csv.reader(f)
    data = list(reader)
    
for x in data: 
    pywhatkit.sendwhatmsg_instantly(x[0], msg)
    for i in range(10):
        pg.press("tab")
    pg.press("enter")