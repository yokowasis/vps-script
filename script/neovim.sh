#!/bin/bash

sudo apt-get install ninja-build gettext cmake curl build-essential git

git clone https://github.com/neovim/neovim.git
cd neovim
git checkout stable
make CMAKE_BUILD_TYPE=Release
sudo make install
