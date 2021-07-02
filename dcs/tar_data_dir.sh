#/usr/bin/env bash

set -e
set -x

if [[ ! -e data ]]; then
  echo "There is no data directory to work with"
  exit 1
fi

if [[ ! "$(ls -A data/git/repositories/unfoldingword/*.git)" ]]; then
  echo "There are no repos in data/git/repositories/unfoldingword"
  exit 1
fi 

rm -rf repos/*.git.tar.gz

for repo in data/git/repositories/unfoldingword/*.git; do tar -czf repos/$(basename $repo).tar.gz $repo; done

rm -rf data/git/repositories/unfoldingword/*.git

rm -rf data.tar.gz

tar -czf data.tar.gz data

cp data/gitea/conf/app.ini ./app.ini

rm -rf data

