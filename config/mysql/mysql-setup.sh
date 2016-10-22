#!/bin/bash

# Start MySQL
/usr/bin/mysqld_safe > /dev/null 2>&1 &

# Wait until the MySQL server is available.
RET=1
while [[ RET -ne 0 ]]; do
    echo " ---> Waiting for MySQL"
    sleep 2
    mysql -uroot -e "status" > /dev/null 2>&1
    RET=$?
done

# Change the MySQL root password
echo "----> Setting root password"
mysql -uroot -e "SET PASSWORD = PASSWORD('root');"

mysql -uroot -proot -e "CREATE USER 'tuningfork'@'localhost' IDENTIFIED BY 'tuningfork';"
mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'tuningfork'@'localhost' WITH GRANT OPTION;"
mysql -uroot -proot -e "CREATE USER 'tuningfork'@'%' IDENTIFIED BY 'tuningfork';"
mysql -uroot -proot -e "GRANT ALL PRIVILEGES ON *.* TO 'tuningfork'@'%' WITH GRANT OPTION;"

# Setting app DB
mysql -uroot -proot -e "CREATE DATABASE tuningfork;"
mysql -uroot -proot tuningfork < /data/skeleton.sql

# Shutdown the server.
echo "----> Shutting down server"
mysqladmin -u root -proot shutdown

