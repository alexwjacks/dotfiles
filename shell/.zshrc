
ZSH=$HOME/.oh-my-zsh

export PATH="/usr/bin:/bin:/usr/sbin:/sbin:/usr/local/bin:/Library/Frameworks/Python.framework/Versions/2.7/bin:/usr/X11/bin:/Users/alexjacks/.rvm/bin"

export PATH="$HOME/.linuxbrew/bin:$PATH"
export MANPATH="$HOME/.linuxbrew/share/man:$MANPATH"
export INFOPATH="$HOME/.linuxbrew/share/info:$INFOPATH"

export TERM=rxvt-unicode
export PATH="$PATH:$HOME/Repos/dotfiles"
alias urxvt="xrdb ~/.Xdefaults && urxvt"
alias cddot="cd ~/dotfiles"
alias cdaut="cd ~/git/anywhere-server/automation"
alias cdbots="cd ~/git/auto-bots"
alias cdsuites="cd ~/git/anywhere-server/automation/src/main/python/suitedefs"

source ~/antigen.zsh
antigen use oh-my-zsh
antigen bundle git
antigen bundle command-not-found
antigen bundle pip
antigen bundle brew
antigen bundle zsh-users/zsh-syntax-highlighting
antigen apply


PROMPT="%F{green}%n%F{white}@%F{green}%m%F{white} in%F{yellow} %~ : %F{blue}"
ssh-add ~/.ssh/id_dsa.archivas_weak
ssh-add ~/.ssh/id_rsa.hds_weak
ssh-add ~/.ssh/id_rsa_ajacks
