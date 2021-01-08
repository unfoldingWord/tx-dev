#!/usr/bin/env bash

set -e

git submodule update --init --recursive

docker network create tx-net
