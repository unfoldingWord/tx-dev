#!/usr/bin/env bash

set -e

if [[ ! -e setENVs.sh ]]; then
  cp setENVs_sample.sh setENVs.sh
fi

if [[ ! -e .env ]]; then
  cp env_sample .env
fi

npm ci

git submodule update --init --recursive

docker network create --driver bridge tx-net >/dev/null 2>&1
