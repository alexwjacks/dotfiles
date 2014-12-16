import subprocess

f = open("dotfiles/packages.txt")
for line in f:
	print
	print("**** NEXT PACKAGE: " + line[:-1] + " ****")
	print
	subprocess.call(["sudo", "apt-get", "install", line[:-1]])
print("done installing packages")
