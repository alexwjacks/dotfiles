#!/usr/bin/env bash

echo
echo "Generating ssh key for github."
echo

# generate ssh keys for github
ssh-keygen -t rsa -C $1 
ssh-agent -s
ssh-add ~/.ssh/id_rsa

echo "Go add ssh key to your github. See help.github.com/articles/generating-ssh-keys."
echo "Press any key to continue."
echo

read -n 1 -s


# install packages from packages.txt, and pull down repos from repoURLs.txt

echo 
echo "Installing packages listed in packaget.txt."
echo
cd ~/Repos
python dotfiles/installPackages.py

echo
echo "Installing repos listed in repoURLs.txt."
echo
python dotfiles/installRepos.py

# add shell links for dotfiles
echo
echo "Setting up links for dotfiles."
echo
cd ~
python Repos/dotfiles/shellSetup.py

# get Vundle ready for VIM setup
echo
echo "Setting up Vundle."
echo
mkdir ~/.vim
mkdir ~/.vim/bundle
mv Repos/Vundle.vim ~/.vim/bundle/Vundle.vim

echo
echo "Vim is about to open. When it does, run :PluginInstall, let it do its thing, and then quit out when it's done. Probably don't wanna save this random file, but feel free if you want."
echo
echo "Press any key to continue."
read -n 1 -s

vim installVimPlugins
echo
echo "Setting up YouCompleteMe plugin."
echo
cd ~/.vim/bundle/YouCompleteMe
git submodule update --init --recursive
./install.sh


echo
echo "Installing all the repos."
echo

# install repos. each has it's own way of installation, so verbosity is essential.
cd ../../../Repos/cool-retro-term
qmake && make

echo
echo "Set up is complete."
echo
