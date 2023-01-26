import subprocess
import sys

call = ["herbstclient", "tag_status", sys.argv[1]]
desktops = subprocess.check_output(call)
desktop_list = desktops.split("\t")
desktop_list = desktop_list[1:-1]



def getForegroundColor(tag):
    if tag == '#': # focused desktop right now
    
        # yellow green, active focused tag
        return "%{F#ff859900}"
                                                                                                        
        # white on green, inactive focused tag                                                          
    elif tag == '+':                                                                             
        return "%{F#ff9CA668}"
                                                                                                        
        # light blue green, unfocused inactive tag with content                                
    elif tag == ':':                                                                             
        return "%{F#ff018759}"                                                                                                        
        # blue, nothing doing                                                                  
    else:                                                                                               
        return "%{F#ff07778C}"
# note, pink for notifications taken care of by making background pink in the notification case below



total_string = ""
endclick = "%{A}"
endForeground = "%{F-}"
for desktop in desktop_list:
    clickable = "%{A:herbstclient focus_monitor " + sys.argv[1] + " && herbstclient use " + desktop[1:] + ":}"
    total_string += getForegroundColor(desktop[0])
    if desktop[1:] == "Dev":
        total_string += clickable + "            \uf121         " + "%{F-}"  + endclick
    elif desktop[1:] == "Term":
        total_string += clickable + "            \uf120         " + "%{F-}" + endclick
    elif desktop[1:] == "Chat":
        if desktop[0] == '!': #notification, make background pink
            total_string += clickable + "%{F#ffffffff}%{B#ffFF0675}" + " " + "\uf12a"+ " " + "%{B-}%{F-}" + endclick 
        else:
             total_string += clickable + "        \uf075            " + "%{F-}" + endclick
    else:
        total_string += clickable + "            \uf108         " + "%{F-}" + endclick


###########################################
# USE DESKTOP TITLES, NOT UNICODE SYMBOLS #
###########################################

#    if desktop[0] == '#': # focused desktop right now
#        # blue on yellow
#        #total_string += "%{F#99002b36}%{B#ffB58900}" + desktop + "%{B-}%{F-} "
#    
#        # white on green, active focused tag
#        total_string += clickable + "%{F#ffffffff}%{B#ff859900}" + " " + desktop[1:] + " " + "%{B-}%{F-}" + endclick
#                                                                                                        
#        # white on green, inactive focused tag                                                          
#    elif desktop[0] == '+':                                                                             
#        total_string += clickable + "%{F#ffffffff}%{B#ff9CA668}" + " " + desktop[1:] + " " + "%{B-}%{F-}" + endclick
#                                                                                                        
#        # white on light blue green, unfocused inactive tag with content                                
#    elif desktop[0] == ':':                                                                             
#        total_string += clickable + "%{F#ffffffff}%{B#ff018759}" + " " + desktop[1:] + " " + "%{B-}%{F-}" + endclick
#                                                                                                        
#        # white on pink, tag with a notification / activity                                             
#    elif desktop[0] == '!':                                                                             
#        total_string += clickable + "%{F#ffffffff}%{B#ffFF0675}" + " " + desktop[1:] + " " + "%{B-}%{F-}" + endclick
#                                                                                                        
#        # white on blue, nothing doing                                                                  
#    else:                                                                                               
#        total_string += clickable + "%{F#ffffffff}%{B#ff07778C}" + " " + desktop[1:] + " " + "%{B-}%{F-}" + endclick



print total_string
