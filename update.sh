#!/usr/bin/env bash

set -e

git submodule foreach --recursive git pull
