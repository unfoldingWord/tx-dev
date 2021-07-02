FROM  unfoldingword/dcs:latest-qa

ARG DOOR43_PREVIEW_PORT=5556
ENV DOOR43_PREVIEW_PORT=$DOOR43_PREVIEW_PORT

ADD data.tar.gz /
ADD repos/*.tar.gz /
COPY app.ini /data/gitea/conf/app.ini

RUN sed -i "s|DOOR43_PREVIEW_URL = http://localhost:\d\+|DOOR43_PREVIEW_URL = http://localhost:${DOOR43_PREVIEW_PORT}|" /data/gitea/conf/app.ini
