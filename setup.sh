#!/usr/bin/env bash

set -e

npm ci

git submodule update --init --recursive

docker network create tx-net
