import subprocess
import os

for filename in os.listdir('Repos/dotfiles/shell'):
    print(filename)
    call = ['ln', '-s', "Repos/dotfiles/shell/"+filename, filename]
    print(call)
    subprocess.call(call)

subprocess.call(['ln', '-s', "Repos/dotfiles/tmuxConf/.tmux.conf", ".tmux.conf"])
