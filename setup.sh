#!/usr/bin/env bash

set -e

npm ci

git submodule update --init --recursive

docker network create --driver bridge tx-net >/dev/null 2>&1
