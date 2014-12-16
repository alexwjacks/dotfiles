import subprocess
import os

f = open("dotfiles/repoURLs.txt")
for line in f:
	print	
	print("**** NEXT REPO IS " + line[:-1]) + " ****")
	print
	subprocess.call(["git", "clone", line[:-1]])

	
