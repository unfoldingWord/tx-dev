#!/usr/bin/env bash

source ./setENVs.sh

declare -a DIRS
DIRS[1]=door43-enqueue-job
DIRS[2]=door43-job-handler
DIRS[3]=tx-enqueue-job
DIRS[4]=tx-job-handler
DIRS[5]=obs-pdf
DIRS[6]=uw-pdf
DIRS[7]=tests

declare -a COMMANDS
COMMANDS[1]="make composeEnqueueRedis"
COMMANDS[2]="make runDevDebug"
COMMANDS[3]="make composeEnqueue"
COMMANDS[4]="make runDevDebug"
COMMANDS[5]="make runDevDebug"
COMMANDS[6]="make runDevDebug"
COMMANDS[7]="make runDevDebug"

cd ${DIRS[$1]} && python3 -m venv venv/ && source venv/bin/activate && ${COMMANDS[$1]}
