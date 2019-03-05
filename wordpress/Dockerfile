FROM wordpress:5.0.3-apache

RUN apt-get update
RUN apt-get install -y ssmtp

COPY ssmtp.conf /etc/ssmtp/ssmtp.conf

RUN echo "sendmail_path = /usr/sbin/ssmtp -t" >> /usr/local/etc/php/conf.d/sendmail.ini
