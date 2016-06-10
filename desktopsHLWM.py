import subprocess
import sys

call = ["herbstclient", "tag_status", sys.argv[1]]
desktops = subprocess.check_output(call)
desktop_list = desktops.split("\t")
desktop_list = desktop_list[1:-1]
#print(desktop_list)

total_string = ""

for desktop in desktop_list:
    #print desktop
    if desktop[0] == '#': # focused desktop right now
        # blue on yellow
        #total_string += "%{F#99002b36}%{B#ffB58900}" + desktop + "%{B-}%{F-} "
    
        # white on green
        total_string += "%{F#ffffffff}%{B#ff859900}" + " " + desktop[1:] + " " + "%{B-}%{F-} "
   
    elif desktop[0] == '+':
        total_string += "%{F#ffffffff}%{B#ff9CA668}" + " " + desktop[1:] + " " + "%{B-}%{F-} "
   
    elif desktop[0] == ':':
        total_string += "%{F#ffffffff}%{B#ff6A4100}" + " " + desktop[1:] + " " + "%{B-}%{F-} "
   
    elif desktop[0] == '!':
        total_string += "%{F#ffffffff}%{B#ffFF0675}" + " " + desktop[1:] + " " + "%{B-}%{F-} "
   
    else:
        total_string += "%{F#ffffffff}%{B#ff045F70}" + " " + desktop[1:] + " " + "%{B-}%{F-} "
print total_string
