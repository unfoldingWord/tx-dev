#!/usr/bin/env bash

# REPLACE THESE WITH YOURS
export AWS_ACCESS_KEY_ID=AK...VY
export AWS_SECRET_ACCESS_KEY=OQ...AT

# OPTIONAL
export DCS_PORT=5555
export DOOR43_PREVIEW_PORT=7777

# DO NOT CHANGE
export DB_ENDPOINT="sqlite:///:memory:"
export TX_DATABASE_PW="123"
export GOGS_USER_TOKEN="123"
export TX_PROXY_URL="http://txproxy"
export QUEUE_PREFIX="dev-"
export REDIS_URL="redis://redis:6379"
export DEBUG_MODE="true"
export TEST_MODE="true"
export GITEA_URL="http://dcs"
export RESTRICT_GITEA_URL="false"
export AWS_ENDPOINT_URL="http://localstack:4566"
