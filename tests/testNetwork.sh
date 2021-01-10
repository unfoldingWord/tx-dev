#!/bin/bash

containers=("D43_DevJob_Handler" "tx-enqueue-job_txenqueue_1" "tx-enqueue-job_proxy_1" "obs-pdf" "door43-enqueue-job_proxy_1" "door43-enqueue-job_redis_1" "tX_Dev_HTML_Job_Handler" "door43-enqueue-job_enqueue_1")

for container in "${containers[@]}";
do
  printf "%s" "Waiting for container $container to start..."
  while ! ping -c 1 -n -w 1 $container &> /dev/null
  do
      printf "%c" "."
      sleep 1
  done
  printf " started.\n"
done
printf "\n%s\n\n"  "All containers are up and running."
