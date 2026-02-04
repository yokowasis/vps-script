#!/bin/bash

sudo apt-get install -y ninja-build gettext cmake curl build-essential git

git clone https://github.com/neovim/neovim.git
cd neovim
git checkout stable
git pull
make CMAKE_BUILD_TYPE=Release
sudo make install
