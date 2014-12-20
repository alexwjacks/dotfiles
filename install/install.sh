#!/usr/bin/env bash

# install packages from packages.txt

echo 
echo "Installing packages listed in packaget.txt."
echo
cd ~/Repos
python dotfiles/installPackages.py


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

vim ~/.ssh/id_rsa.pub

# pull down repos from repoURLs.txt
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

cd ../bspwm
make && sudo make install

mkdir ~/.config/sxhkd
ln -s ~/Repos/dotfiles/bspwm/bspwmrc ~/.config/bspwm/bspwmrc

cd ../sxhkd
make && sudo make install
ln -s ~/Repos/dotfiles/bspwm/sxhkdrc ~/.config/sxhkd/sxhkdrc

cd ../bar
make && sudo make install

cd ../sutils
make && sudo make install

cd ../xtitle
make && sudo make install

# set up slim to replace gdm
sudo rm /etc/slim.conf 
sudo ln -s ~/Repos/dotfiles/slim.conf /etc/slim.conf

sudo cp  ~/Repos/bspwm/contrib/lightdm/bspwm-session ~/Repos/dotfiles/bspwm/bspwm-session

sudo ln -s ~/Repos/dotfiles/bspwm/bspwm-session /usr/share/xsessions/bspwm-session

sudo ln -s ~/Pictures/geo.png ~/Repos/geo.png

echo
echo "Set up is complete."
echo
