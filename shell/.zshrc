
ZSH=$HOME/.oh-my-zsh

export PATH="/usr/bin:/bin:/usr/sbin:/sbin:/usr/local/bin:/Library/Frameworks/Python.framework/Versions/2.7/bin:/usr/X11/bin:/Users/alexjacks/.rvm/bin"

export PATH="$HOME/.linuxbrew/bin:$PATH"
export MANPATH="$HOME/.linuxbrew/share/man:$MANPATH"
export INFOPATH="$HOME/.linuxbrew/share/info:$INFOPATH"

export TERM=rxvt-unicode
export PATH="$PATH:$HOME/Repos/dotfiles"
alias urxvt="xrdb ~/.Xdefaults && urxvt"
alias tmux="tmux -2"
alias cddot="cd ~/dotfiles"

source ~/antigen.zsh
antigen use oh-my-zsh
antigen bundle git
antigen bundle command-not-found
antigen bundle pip
antigen bundle brew
antigen bundle zsh-users/zsh-syntax-highlighting
antigen bundle aliases
antigen bundle colored-man-pages
antigen bundle tmux
antigen bundle themes
antigen bundle web-search
antigen bundle vindle
antigen apply



PROMPT="%F{green}%n%F{white}@%F{green}%m%F{white} in%F{yellow} %~ : %F{blue}"
