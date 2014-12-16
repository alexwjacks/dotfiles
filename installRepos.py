import subprocess
import os

f = open("dotfiles/repoURLs.txt")
for line in f:
	print()	
	print("**** NEXT REPO IS " + line[:-1] + " ****")
	print()
        subprocess.call(["git", "clone", "--recursive", line[:-1]])
subprocess.call(["mv", "Vundle.vim", "~/.vim/bundle/Vundle.vim"])
