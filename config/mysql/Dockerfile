FROM mysql:latest

COPY my.cnf /etc/mysql/my.cnf
# RUN deluser mysql
# RUN useradd mysql
RUN chown mysql:mysql -R /var/run/mysqld
# RUN mkdir -p /var/run/mysqld
# RUN chmod -R 777 /var/run/mysqld


# ADD data/tuningfork.sql /docker-entrypoint-initdb.d/
# ENV MYSQL_ROOT_PASSWORD ${MYSQL_ROOT_PASSWORD}
# COPY mysql-setup.sh /tmp/mysql-setup.sh
# RUN /bin/bash /tmp/mysql-setup.sh
# RUN /bin/bash -c "/usr/bin/mysqld_safe &" && \
#   sleep 5 && \
#   mysql -u root -e "CREATE DATABASE tuningfork" && \
#   mysql -u root < /tmp/skeleton.sql
