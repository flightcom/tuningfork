FROM debian:latest

# Environment Variables
ENV DEBIAN_FRONTEND noninteractive

# Base Packages
RUN apt-get update -y
RUN apt-get install -y vim supervisor git debconf-utils vim
RUN mkdir -p /var/log/supervisor

# SSH
RUN apt-get install -y openssh-server
ADD config/ssh/supervisor.conf /etc/supervisor/conf.d/ssh.conf
RUN mkdir -p /var/run/sshd

# Nginx
RUN apt-get install -y nginx
ADD config/nginx/default /etc/nginx/sites-enabled/tuningfork
ADD config/nginx/nginx-setup.sh /nginx-setup.sh
RUN chmod +x /nginx-setup.sh
RUN /nginx-setup.sh
RUN echo "daemon off;" >> /etc/nginx/nginx.conf

# PHP
RUN apt-get install -y php5-fpm
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

# Start
ADD config/start.sh /start.sh
RUN chmod +x /start.sh
CMD bash /start.sh

