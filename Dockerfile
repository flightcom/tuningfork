# Docker LAMP Developer
FROM debian:jessie

# Environment Variables
ENV DEBIAN_FRONTEND noninteractive
# ENV MYSQL_ROOT_PASSWORD tooroot

# Base Packages
RUN apt-get update -y
#RUN apt-get upgrade -y
RUN apt-get install -y supervisor git debconf-utils
RUN mkdir -p /var/log/supervisor

# SSH
RUN apt-get install -y openssh-server
ADD config/ssh/supervisor.conf /etc/supervisor/conf.d/ssh.conf
RUN mkdir -p /var/run/sshd

# Apache
# RUN apt-get install -y apache2
# ADD config/apache2/apache2-service.sh /apache2-service.sh
# ADD config/apache2/apache2-setup.sh /apache2-setup.sh
# RUN chmod +x /*.sh
# ADD config/apache2/apache_default /etc/apache2/sites-available/000-default.conf
# ADD config/apache2/supervisor.conf /etc/supervisor/conf.d/apache2.conf
# RUN /apache2-setup.sh

# Nginx
RUN apt-get install -y nginx
ADD config/nginx/default /etc/nginx/sites-enabled/tuningfork
# ADD config/nginx/nginx-setup.sh /nginx-setup.sh
# RUN chmod +x /nginx-setup.sh
# RUN /nginx-setup.sh

# PHP
# RUN apt-get install -y libapache2-mod-php5 php5 php5-json php5-cli php5-curl curl php5-mcrypt php5-xdebug mcrypt libmcrypt-dev
RUN apt-get install -y php5 php5-fpm
# ADD config/php/php.ini /etc/php5/apache2/conf.d/30-docker.ini
ADD config/php/php-setup.sh /php-setup.sh
RUN chmod +x /php-setup.sh
RUN /php-setup.sh

# MySQL
RUN mkdir /data
ADD data/skeleton.sql /data/skeleton.sql
RUN apt-get install -y mysql-server mysql-client php5-mysql
ADD config/mysql/mysql-setup.sh /mysql-setup.sh
RUN chmod +x /*.sh
ADD config/mysql/my.cnf /etc/mysql/conf.d/my.cnf
ADD config/mysql/supervisor.conf /etc/supervisor/conf.d/mysql.conf
RUN /mysql-setup.sh
CMD "mysql" "-uroot" "-proot" "-e" "CREATE DATABASE tuningfork;"
CMD "mysql" "-uroot" "-proot" "<" "/data/skeleton.sql"

CMD "service" "php5-fpm" "start"
CMD "service" "nginx" "start"

# Start
# VOLUME ["/var/www/html"]
EXPOSE 22 80 3306
CMD ["supervisord", "-n"]