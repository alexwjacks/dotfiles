import subprocess
import sys
import re

total_string = ""
callString = "amixer get Master" # | sed -n 'N;s/^.*\[\([0-9]\+%\).*$/\1/p'"
 
call = callString.split(" ")
volume = subprocess.check_output(call)

startIndex = volume.find("[")
endIndex = volume.find("]")
vol = int(volume[startIndex+1:endIndex-1])
if vol == 0:
    total_string += '\uf026'
elif vol < 50:
    total_string += '\uf027'
elif vol < 101:
    total_string += '\uf028'

total_string += " :"
total_string += str(vol)
total_string += "%"
print total_string

