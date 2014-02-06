#!/bin/bash
# solarized dark
echo -ne '\e]4;0;#073642\a'   # black
echo -ne '\e]4;1;#dc322f\a'   # red
echo -ne '\e]4;2;#859900\a'   # green
echo -ne '\e]4;3;#b58900\a'   # yellow
echo -ne '\e]4;4;#268bd2\a'   # blue
echo -ne '\e]4;5;#d33682\a'   # magenta
echo -ne '\e]4;6;#2aa198\a'   # cyan
echo -ne '\e]4;7;#fdf6e3\a'   # white (light grey really)
echo -ne '\e]4;8;#002b36\a'   # bold black (i.e. dark grey)
echo -ne '\e]4;9;#cb4b16\a'   # bold red
echo -ne '\e]4;10;#586e75\a'  # bold green
echo -ne '\e]4;11;#657b83\a'  # bold yellow
echo -ne '\e]4;12;#839496\a'  # bold blue
echo -ne '\e]4;13;#6c71c4\a'  # bold magenta
echo -ne '\e]4;14;#93a1a1\a'  # bold cyan
echo -ne '\e]4;15;#fdf6e3\a'  # bold white

echo -ne '\e]10;#fdf6e3\a'  # foreground
echo -ne '\e]11;#002b36\a'  # background
echo -ne '\e]12;#859900\a'  # cursor
alias ajacks='cd /cygdrive/c/Users/ajacks/'
alias workspace='cd /cygdrive/c/Users/ajacks/TSK'
alias cdtsk='cd /cygdrive/c/Users/ajacks/TSK/sleuthkit'
alias cdautopsy='cd /cygdrive/c/Users/ajacks/TSK/autopsy'
alias branding='git checkout branding'
alias ls='ls --color'
tmux
tmux unbind C-b
tmux set -g prefix C-a
#bind a send-prefix
tmux set -g mouse-select-pane on
tmux set -g mode-mouse on
tmux set -g mouse-select-window on
tmux set -g base-index 1
tmux setw -g monitor-activity on
tmux set -g visual-activity on
workspace
