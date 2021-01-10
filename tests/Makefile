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
	docker run -e GOGS_USER_TOKEN -e REDIS_URL --name "tx-dev" --network tx-net -it --rm -v ${PWD}:/scripts -v /var/run/docker.sock:/var/run/docker.sock python:3 sh -c "pip install rq; cd /scripts; make testNetwork; make info; bash"

testNetwork:
	# Making sure all containers are running
	bash testNetwork.sh

info:
	# rq workers info:
	rq info --config rq_settings
