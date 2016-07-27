import subprocess
import sys

total_string = ""
call= ["mpc", "current"]
 
song = subprocess.check_output(call)
call = ["mpc", "--format", '""']
formatOutput = subprocess.check_output(call)
total_string += song + "  "

if "[paused]" in formatOutput:
    # play button
    total_string += "%{A:mpc play:} \uf04b  %{A}"
elif "[playing]" in formatOutput:
    # paused button
    total_string += "%{A:mpc pause:} \uf04c %{A}"
print total_string
