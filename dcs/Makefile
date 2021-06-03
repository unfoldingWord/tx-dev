DCS_PORT ?= 3000

runDcsDocker: 
	docker run --name dcs --rm -v ${PWD}/data:/data -v /etc/timezone:/etc/timezone:ro -v /etc/localtime:/etc/localtime:ro -e USER_UID=1000 -e USER_GID=1000 --network tx-net -p ${DCS_PORT}:80 unfoldingword/dcs:latest
	
runDcsDockerCompose:
	docker compose up --build
