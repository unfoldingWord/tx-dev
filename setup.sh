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

#tar -xf dcs/data.tar.gz -C dcs

