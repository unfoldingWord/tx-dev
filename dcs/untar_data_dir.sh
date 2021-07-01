#/usr/bin/env bash

set -e
set -x

rm -rf data

tar -xf data.tar.gz

for f in repos/*.tar.gz; do tar -xf "$f"; done

