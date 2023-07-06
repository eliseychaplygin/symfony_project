FROM mysql:5.6
#ADD docker-entrypoint-initdb.d/dump.sql /docker-entrypoint-initdb.d
ADD my.cnf /etc/mysql
CMD ["mysqld"]
EXPOSE 3306