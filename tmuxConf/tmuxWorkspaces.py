#!/usr/bin/python

import sys
import subprocess

tag_status = subprocess.check_output(["herbstclient", "tag_status"])
battery = subprocess.check_output(["acpi"])

#print tag_status

arr2 = list(tag_status)
flag = 0
for thing2 in arr2:
 #  print thing2
   if flag:
      current_workspace = "Current workspace: " + thing2
      break
   if thing2 == '#':
      flag = 1
#print current_workspace
#print battery

arr = battery.split(' ')

#for thing in arr:
 #  print thing
battery_percent = "Battery: " +  arr[3]
battery_percent = battery_percent.replace(",", "")
#print battery_percent

date = subprocess.check_output(["date", "+%H:%M %m/%d/%Y"])
#print date
date = date.rstrip('\n')
full_string = " | ".join([current_workspace, date, battery_percent])
#full_string = current_workspace + " | " + date + " | " + battery_percent
print full_string
