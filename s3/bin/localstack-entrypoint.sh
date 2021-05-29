#!/usr/bin/env bash
printf "Configuring localstack components..."

readonly LOCALSTACK_S3_URL=http://s3:4566

sleep 5;

set -x

aws configure set aws_access_key_id foo
aws configure set aws_secret_access_key bar
echo "[default]" > ~/.aws/config
echo "region = us-east-1" >> ~/.aws/config
echo "output = json" >> ~/.aws/config

aws --endpoint-url=$LOCALSTACK_S3_URL s3api create-bucket --bucket local-tx-webhook-client
aws --endpoint-url=$LOCALSTACK_S3_URL s3api create-bucket --bucket local-cdn.door43.org
aws --endpoint-url=$LOCALSTACK_S3_URL s3api create-bucket --bucket local-door43.org

set +x

printf "Use the aws CLI to do the follwoing:"
printf "To list buckets: aws --endpoint-url=http://localhost:4566 s3 ls"
printf "To list within a bucket: aws --endpoint-url=http://localhost:4566 s3 ls <bucket>"
printf "To sync a local directory with a bucket: aws --endpoint-url=http://localhost:4566 s3 sync . s3://<bucket>/<key> --acl public-read"
