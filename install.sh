#!/usr/bin/env bash
cd ~/Repos
python dotfiles/installPackages.py
python dotfiles/installRepos.py
cd ~
python Repos/dotfiles/shellSetup.py
mkdir ~/.vim
mkdir ~/.vim/bundle
mv Repos/Vundle.vim ~/.vim/bundle/Vundle.vim


echo "Vim is about to open. When it does, run :PluginInstall, let it do its thing, and then quit out when it's done. Probably don't wanna save this random file, but feel free if you want."

vim installVimPlugins
cd ~/.vim/bundle/YouCompleteMe
git submodule update --init --recursive
./install.sh

cd ../../../Repos/cool-retro-term
qmake && make
