#!/bin/bash

printf "Waiting for all contaiers to finish initializing"
while true ; do 
  printf "."
  result=$(docker network inspect tx-net | grep '"Name":' | wc -l)
  if (( $result >= 7 )) ; then
    printf "\nAll containers running!\n"
    docker network inspect tx-net | grep '"Name":'
    break
  fi
  sleep 1
done
