#!/bin/bash

	yum install -y wget nano vim epel-release git

	wget https://dev.mysql.com/get/mysql57-community-release-el7-11.noarch.rpm
	rpm -ivh mysql57-community-release-el7-11.noarch.rpm

	yum update -y

	yum install -y httpd php mysql-server php-mysql phpmyadmin msmtp

	firewall-cmd --permanent --add-port=80/tcp
	firewall-cmd --permanent --add-port=443/tcp
	firewall-cmd --reload

	systemctl enable httpd
	systemctl enable mysqld
	systemctl start httpd
	systemctl start mysqld

