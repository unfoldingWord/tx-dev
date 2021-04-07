runDcsTest:
	docker run --name dcs-test --rm -v dcs-data:/data -v /etc/timezone:/etc/timezone:ro -v /etc/localtime:/etc/localtime:ro -e USER_UID=1000 -e USER_GID=1000 --network tx-net -p 3000:3000 unfoldingword/dcs:latest

