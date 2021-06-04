#!/usr/bin/env bash

# OPTIONAL
export DCS_PORT=5555
export DOOR43_PREIVEW_PORT=5556

# DO NOT CHANGE
export AWS_ACCESS_KEY_ID="123"
export AWS_SECRET_ACCESS_KEY="123"
export DB_ENDPOINT="sqlite:///:memory:"
export TX_DATABASE_PW="123"
#export DB_ENDPOINT="door43.cluster-ccidwldijq9p.us-west-2.rds.amazonaws.com"
#export TX_DATABASE_PW="fxt......bv1"
export GOGS_USER_TOKEN="123"
export GITEA_URL="http://dcs"
export RESTRICT_GITEA_URL="false"
export QUEUE_PREFIX="dev-"
export REDIS_URL="redis://redis:6379"
export DEBUG_MODE="true"
export TEST_MODE="true"
export AWS_ENDPOINT_URL="http://localstack:4566"
