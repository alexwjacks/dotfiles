#!/usr/bin/env bash

# generate ssh keys for github
ssh-keygen -t rsa -C $1 
ssh-agent -s
ssh-add ~/.ssh/id_rsa

echo "Go add ssh key to your github. See help.github.com/articles/generating-ssh-keys."

read -n 1 -s


# install packages from packages.txt, and pull down repos from repoURLs.txt
cd ~/Repos
python dotfiles/installPackages.py
python dotfiles/installRepos.py

# add shell links for dotfiles
cd ~
python Repos/dotfiles/shellSetup.py

# get Vundle ready for VIM setup
mkdir ~/.vim
mkdir ~/.vim/bundle
mv Repos/Vundle.vim ~/.vim/bundle/Vundle.vim


echo "Vim is about to open. When it does, run :PluginInstall, let it do its thing, and then quit out when it's done. Probably don't wanna save this random file, but feel free if you want."

vim installVimPlugins
cd ~/.vim/bundle/YouCompleteMe
git submodule update --init --recursive
./install.sh

# install repos. each has it's own way of installation.
cd ../../../Repos/cool-retro-term
qmake && make
