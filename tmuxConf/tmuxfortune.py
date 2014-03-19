#!/usr/bin/python
import subprocess

call = ['fortune']

# get a value of the appropriate length
fortune = subprocess.check_output(call) 
while (len(fortune) > 50):
   fortune = subprocess.check_output(call)

# decode it into a string
fortune = fortune.decode()

# replace whitespace, tabs, newlines, etc"
fortune = fortune.strip()
fortune = fortune.replace("\n", " ")
print(fortune)
