#!/bin/bash
I_AM=`whoami`
WWW_DIR="/var/www/html/test"
sudo mkdir $WWW_DIR
sudo chown $I_AM:$I_AM $WWW_DIR

cp ./*.php $WWW_DIR

printf "\nEnter your SQL password!\n"
mysql -p$1 << EOS

create database crud;
use crud;
create table tasks (
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
task VARCHAR(1000) NOT NULL,
create_time TIMESTAMP default current_timestamp,
update_time TIMESTAMP default current_timestamp on update current_timestamp
);

EOS

sudo echo "DirectoryIndex index.php" >> /var/www/html/.htaccess

clear
printf "To-Do:\tvisit http://localhost/crud/ to manage your to-do list\n\n"
