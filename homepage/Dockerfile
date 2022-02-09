FROM nginx:latest

COPY ./default.conf /etc/nginx/conf.d/default.conf 
COPY ./public /public

CMD nginx; sleep 2; echo "You can view all tX URLs and POST forms at http://${LISTEN_IP}:${HOMEPAGE_PORT}"; sleep infinity;
