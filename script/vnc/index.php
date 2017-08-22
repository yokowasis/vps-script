#!/bin/sh

yum -y install epel-release;yum -y update;yum -y groups install Xfce;yum -y install tigervnc-server;cp /lib/systemd/system/vncserver@.service /etc/systemd/system/vncserver@:1.service;sed -i -e 's![<]USER[>]!'"${LOGNAME}"'!g' /etc/systemd/system/vncserver@:1.service;vncserver;systemctl enable vncserver@:1.service;systemctl daemon-reload;

echo '#!/bin/sh	                                                        '  > ~/.vnc/xstartup
echo '                                                                  ' >> ~/.vnc/xstartup
echo '[ -r /etc/sysconfig/i18n ] && . /etc/sysconfig/i18n               ' >> ~/.vnc/xstartup
echo 'export LANG                                                       ' >> ~/.vnc/xstartup
echo 'export SYSFONT                                                    ' >> ~/.vnc/xstartup
echo 'vncconfig -iconic &                                               ' >> ~/.vnc/xstartup
echo '# unset SESSION_MANAGER                                           ' >> ~/.vnc/xstartup
echo 'unset DBUS_SESSION_BUS_ADDRESS                                    ' >> ~/.vnc/xstartup
echo 'OS=`uname -s`                                                     ' >> ~/.vnc/xstartup
echo 'if [ $OS = 'Linux' ]; then                                        ' >> ~/.vnc/xstartup
echo '  case "$WINDOWMANAGER" in                                        ' >> ~/.vnc/xstartup
echo '    *gnome*)                                                      ' >> ~/.vnc/xstartup
echo '      if [ -e /etc/SuSE-release ]; then                           ' >> ~/.vnc/xstartup
echo '        PATH=$PATH:/opt/gnome/bin                                 ' >> ~/.vnc/xstartup
echo '        export PATH                                               ' >> ~/.vnc/xstartup
echo '      fi                                                          ' >> ~/.vnc/xstartup
echo '      ;;                                                          ' >> ~/.vnc/xstartup
echo '  esac                                                            ' >> ~/.vnc/xstartup
echo 'fi                                                                ' >> ~/.vnc/xstartup
echo '# if [ -x /etc/X11/xinit/xinitrc ]; then                          ' >> ~/.vnc/xstartup
echo '#   exec /etc/X11/xinit/xinitrc                                   ' >> ~/.vnc/xstartup
echo '# fi                                                              ' >> ~/.vnc/xstartup
echo '# if [ -f /etc/X11/xinit/xinitrc ]; then                          ' >> ~/.vnc/xstartup
echo '#   exec sh /etc/X11/xinit/xinitrc                                ' >> ~/.vnc/xstartup
echo '# fi                                                              ' >> ~/.vnc/xstartup
echo '[ -r $HOME/.Xresources ] && xrdb $HOME/.Xresources                ' >> ~/.vnc/xstartup
echo 'xsetroot -solid grey                                              ' >> ~/.vnc/xstartup
echo 'xterm -geometry 80x24+10+10 -ls -title "$VNCDESKTOP Desktop" &    ' >> ~/.vnc/xstartup
echo 'startxfce4 &                                                      ' >> ~/.vnc/xstartup

