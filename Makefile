# NOTE: The following environment variables are optional:
#	REDIS_URL (can be omitted for testing if a local instance is running)
#	DEBUG_MODE (can be set to any non-blank string to run in debug mode for testing)
#	QUEUE_PREFIX (defaults to '', set to dev- for testing)
checkEnvVariables:
	@ if [ -z "${GOGS_USER_TOKEN}" ]; then \
		echo "Need to set GOGS_USER_TOKEN"; \
		exit 1; \
	fi

runDevDebug: checkEnvVariables
	docker run --name tx-dev --network tx-net -it --rm -v "${PWD}/ssh":/root/.ssh:ro -v ${PWD}:/scripts -v /var/run/docker.sock:/var/run/docker.sock python:3 /bin/bash -c "cd /scripts; source setENVs.sh; pip install -r requirements.txt; make testNetwork; make info; cd tests; bash"

runDcs: checkEnvVariables
	docker run --name dcs --rm -v "${PWD}/dcs/gitea:/data -v /etc/timezone:/etc/timezone:ro -v /etc/localtime:/etc/localtime:ro -e USER_UID=1000 -e USER_GID=1000 --network tx-net unfoldingword/dcs:latest /bin/bash -c "cd /app; ./gitea web"

testNetwork:
	# Making sure all containers are running
	bash testNetwork.sh

info:
	# rq workers info:
	rq info --config rq_settings
