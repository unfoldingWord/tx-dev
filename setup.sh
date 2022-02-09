#!/usr/bin/env bash

set -e
set -x

if [[ ! -e .env ]]; then
  cp env_sample .env
fi

git submodule update --init --recursive

cd tx-dev-dcs
bash ./untar_data.sh

