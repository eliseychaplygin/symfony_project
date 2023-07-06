FROM nginx:alpine
WORKDIR /var/www/
COPY nginx.conf /etc/nginx/nginx.conf
COPY conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY sites-available/default.conf /etc/nginx/sites-available/default.conf
CMD ["nginx"]
EXPOSE 80