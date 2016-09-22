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

# Create the phpmyadmin storage configuration database.
echo "----> Creating phpmyadmin DB"
mysql -uroot -p$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE phpmyadmin; GRANT ALL PRIVILEGES ON phpmyadmin.* TO 'root'@'localhost' IDENTIFIED BY 'root'; FLUSH PRIVILEGES;"

# Import the configuration storage database.
echo "----> Hydrating phpmyadmin DB"
gunzip < /usr/share/doc/phpmyadmin/examples/create_tables.sql.gz | mysql -u root -p$MYSQL_ROOT_PASSWORD phpmyadmin

# Shutdown the server.
echo "----> Shutting down server"
mysqladmin -uroot -p$MYSQL_ROOT_PASSWORD shutdown
