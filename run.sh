#!/usr/bin/env bash

if test -f "./.env"; then
  source .env
fi

docker compose up -d

echo "You can view all tX URLs and POST forms at http://${LISTEN_IP-127.0.0.1}:${HOMEPAGE_PORT-8080}"

