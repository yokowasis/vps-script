#!/bin/sh

apt update -y && apt upgrade -y
apt install xfce4 xfce4-goodies tigervnc-standalone-server -y

mkdir ~/.vnc
echo '#!/bin/sh	                                                        '  > ~/.vnc/xstartup
echo 'unset SESSION_MANAGER                                             ' >> ~/.vnc/xstartup
echo 'unset DBUS_SESSION_BUS_ADDRESS                                    ' >> ~/.vnc/xstartup
echo 'startxfce4 &                                                      ' >> ~/.vnc/xstartup

chmod +x ~/.vnc/xstartup

mkdir /etc/systemd/service/
echo '[Unit]' > /etc/systemd/service/vncserver@.service
echo 'Description=Start TigerVNC server at startup' >> /etc/systemd/service/vncserver@.service
echo 'After=syslog.target network.target' >> /etc/systemd/service/vncserver@.service
echo '' >> /etc/systemd/service/vncserver@.service
echo '[Service]' >> /etc/systemd/service/vncserver@.service
echo 'Type=simple' >> /etc/systemd/service/vncserver@.service
echo 'User=someuser' >> /etc/systemd/service/vncserver@.service
echo 'Group=someuser' >> /etc/systemd/service/vncserver@.service
echo 'WorkingDirectory=/home/someuser' >> /etc/systemd/service/vncserver@.service
echo '' >> /etc/systemd/service/vncserver@.service
echo 'PIDFile=/home/someuser/.vnc/%H:590%i.pid' >> /etc/systemd/service/vncserver@.service
echo 'ExecStartPre=-/bin/sh -c "/usr/bin/vncserver -kill :%i > /dev/null 2>&1"' >> /etc/systemd/service/vncserver@.service
echo 'ExecStart=/usr/bin/vncserver -fg -depth 24 -geometry 1920x1080 -localhost no :%i' >> /etc/systemd/service/vncserver@.service
echo 'ExecStop=/usr/bin/vncserver -kill :%i' >> /etc/systemd/service/vncserver@.service
echo '' >> /etc/systemd/service/vncserver@.service
echo '[Install]' >> /etc/systemd/service/vncserver@.service
echo 'WantedBy=multi-user.target' >> /etc/systemd/service/vncserver@.service

chmod +x /etc/systemd/service/vncserver@.service
systemctl daemon-reload
systemctl enable tigervncserver@service

echo "RUN VNC Server with command vncserver"
