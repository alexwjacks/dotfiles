import subprocess

call = ["bspc", "query", "-D"]
desktops = subprocess.check_output(call)
desktop_list = desktops.split("\n")
desktop_list = desktop_list[:-1]
#print(desktop_list)

call = ["bspc", "query", "--desktops", "--desktop", "focused"]
focused = subprocess.check_output(call)
focused = focused[:-1]
#print(focused)


total_string = ""

for desktop in desktop_list:
    if desktop == focused:
        # blue on yellow
        #total_string += "%{F#99002b36}%{B#ffB58900}" + desktop + "%{B-}%{F-} "
    
        # blue on green
        total_string += "%{F#99002b36}%{B#ff859900}" + desktop + "%{B-}%{F-} "

    
    else:
        #total_string += "\xE2\x97\xA6 "
        total_string += desktop
        total_string += " "
print total_string
