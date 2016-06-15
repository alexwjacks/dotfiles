import subprocess
import sys

call = ["herbstclient", "tag_status", sys.argv[1]]
desktops = subprocess.check_output(call)
desktop_list = desktops.split("\t")
desktop_list = desktop_list[1:-1]
#print(desktop_list)

total_string = ""

for desktop in desktop_list:
    clickable = "%{A:herbstclient focus_monitor " + sys.argv[1] + " && herbstclient use " + desktop[1:] + ":}"
    endclick = "%{A}"
    #print desktop
    if desktop[0] == '#': # focused desktop right now
        # blue on yellow
        #total_string += "%{F#99002b36}%{B#ffB58900}" + desktop + "%{B-}%{F-} "
    
        # white on green, active focused tag
        total_string += clickable + "%{F#ffffffff}%{B#ff859900}" + " " + desktop[1:] + " " + "%{B-}%{F-} " + endclick
   
        # white on green, inactive focused tag
    elif desktop[0] == '+':
        total_string += clickable + "%{F#ffffffff}%{B#ff9CA668}" + " " + desktop[1:] + " " + "%{B-}%{F-} " + endclick
   
        # white on light blue green, unfocused inactive tag with content
    elif desktop[0] == ':':
        total_string += clickable + "%{F#ffffffff}%{B#ff018759}" + " " + desktop[1:] + " " + "%{B-}%{F-} " + endclick
   
        # white on pink, tag with a notification / activity
    elif desktop[0] == '!':
        total_string += clickable + "%{F#ffffffff}%{B#ffFF0675}" + " " + desktop[1:] + " " + "%{B-}%{F-} " + endclick
   
        # white on blue, nothing doing
    else:
        total_string += clickable + "%{F#ffffffff}%{B#ff045F70}" + " " + desktop[1:] + " " + "%{B-}%{F-} " + endclick
print total_string
