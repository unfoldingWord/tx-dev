#!/usr/bin/env bash
#
# setENVs.sh for Door43 Enqueue Job
#       Last modified: 2018-12-04 RJH
#

export DB_ENDPOINT="door43.cluster-ccidwldijq9p.us-west-2.rds.amazonaws.com"
export AWS_ACCESS_KEY_ID="AKJ.........QRF"
export AWS_SECRET_ACCESS_KEY="kxZ...................1bm"
export TX_DATABASE_PW="fxt......bv1"

# For Gitea
export GITEA_URL="http://dcs"
export RESTRICT_GITEA_URL=0
export GOGS_USER_TOKEN="918...c3d3"

# Added for rq version
export QUEUE_PREFIX="dev-"
export REDIS_URL="redis://door43-enqueue-job_redis_1:6379"

# To ensure Debug Mode is on
export DEBUG_MODE="true"
export TEST_MODE="true"
