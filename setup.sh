#!/usr/bin/env bash

set -e

if [[ ! -e .env ]]; then
  cp env_sample .env
fi

git submodule update --init --recursive

cd tx-dev-dcs
bash ./untar_data.sh

