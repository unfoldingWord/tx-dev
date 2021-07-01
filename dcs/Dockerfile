FROM  unfoldingword/dcs:latest-qa

ARG DCS_PORT=5555
ARG DOOR43_PREVIEW_PORT=5556
ENV DCS_PORT=$DCS_PORT
ENV DOOR43_PREVIEW_PORT=$DOOR43_PREVIEW_PORT

ADD data.tar.gz /
ADD repos/*.tar.gz /data/git/repositories/unfoldingword

RUN sed -i "s|ROOT_URL         = http://localhost:5555/|ROOT_URL         = http://localhost:${DCS_PORT}/|" /data/gitea/conf/app.ini
RUN sed -i "s|DOOR43_PREVIEW_URL = http://localhost:\d\+|DOOR43_PREVIEW_URL = http://localhost:${DOOR43_PREVIEW_PORT}|" /data/gitea/conf/app.ini
