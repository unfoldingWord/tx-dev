# tX Dev

Purpose of this repo is to have an easy way to setup and run the tX system architecture locally as a dev environment. 

See https://forum.door43.org/t/door43-org-tx-development-architecture/65 which describes the system architecture.

## Repos involved:

The individual repos are here:

* https://github.com/unfoldingWord-dev/tx-dev (this repo)
* https://github.com/unfoldingWord-dev/door43-enqueue-job
* https://github.com/unfoldingWord-dev/door43-job-handler
* https://github.com/unfoldingWord-dev/tx-enqueue-job
* https://gitcd hub.com/unfoldingWord-dev/tx-job-handler
* https://github.com/unfoldingWord-dev/obs-pdf
* https://github.com/unfoldingWord-dev/uw-pdf

## Prereqs

* Have Python v3.8 or newer installed
* Have node and npm installed
* Have Docker installed

## Notes About Job Queues Involved

tX has these 3 job queues: 

1. tX_webhook: makes HTML pages
1. tX_OBS_PDF_webhook: makes OBS PDFs
1. tXmake other PDFs
   
The queue for #1 is called tX_webhook
The queue for #2 is called tX_OBS_PDF_webhook.
The queue for #3 is called tX_other_PDF_webhook. 


## Notes About the Docker Containers Involved:

### obs-pdf

The OBS PDF container is based on https://hub.docker.com/repository/docker/unfoldingword/obs-stretch-base (slim version of Debian stretch with Python 3.8.1 built from https://github.com/unfoldingWord-dev/obs-pdf/blob/develop/resources/docker-slim-python3.8-base/Dockerfile).


## Notes about Making an RQ app

To make a RQ app:

1. include [RQ](https://pypi.org/project/rq/) and change queue name in your copy of https://github.com/unfoldingWord-dev/obs-pdf/blob/develop/public/rq_settings.py.
1. create a function for rq to call named job as in https://github.com/unfoldingWord-dev/obs-pdf/blob/develop/public/webhook.py.
1. job(...) should receive a JSON dict as described in https://forum.door43.org/t/door43-org-tx-development-architecture/65 section 4.
1. The worker should create the PDF file and upload it to `(dev-)cdn.door43.org/u/<repo_owner_username>/<repo_name>/<branch_or_tag_name>/`. The PDF file must be called either `<repo_owner_username>–<repo_name>–<tag_name>.pdf` or `<repo_owner_username>–<repo_name>–<branch_name>–<commit_hash>.pdf`.


## Overview of Running/Testing the tX System Architecture Locally

How to run tX on Ubuntu Linux:

1. Open seven (7) tabs in a terminal window.
1. Change directory to the appropriate cloned repos, e.g., `cd <your_repos_dir>/door43-enqueue-job`
1. Set up a Python 3.8 or newer (currently 3.8.6) virtual environment and activate it
1. Run a batch file to setup environment variables
1. Run the tX process from the Makefile in debug mode
1. Simulate the sending of a JSON payload and watch everything happen -- debug mode prints more on the terminal screen


### Initial setup (only need to do once):

1. `cp ./setENVs_sample.sh ./setENVs.sh`
1. `vi ./setENVs.sh` - set all masked values to your AWS & DCS keys
1. `./setup.sh`


### To Start Up Everything in 6 tabs:

`npm start`

## Here's what's happening in each tab:

### In terminal ab 1:

* Starts a Redis server in the local tx-net Docker network
* which then starts the (dev-)door43-enqueue-job process
	* which handles JSON payloads from Door43 webhooks
	* which also handles callbacks from tx-job-handler and uploads the converted files to Door43
	
### In terminal tab 2:

* Starts the (dev-)door43-job-handler process
* which then connects to the local tx-net network Redis server 
* which then does preprocessing of Door43 repos
	
### In terminal tab 3:

* Starts the (dev-)tx-enqueue-job process
* which then handles JSON payloads from door43-job-handler and from door43.org PDF button
   
### In terminal tab 4:

* Starts the (dev-)tx-job-handler process
* which then connects to the local tx-net network Redis server
* which then translates preprocessed repos to HTML
* which then enqueues a door43-callback
	
### In terminal tab 5:

* Starts the (dev-)obs-pdf creator process
* which then connects to the local Redis server
* which then translates preprocessed OBS repos to a PDF
* which then enqueues a door43-callback

### Docker check

You have to make sure that all these docker processes are communicating properly:

#### In another terminal:

1. `docker network ls`  
	Should see something like:
   ```
   $ docker network ls
	NETWORK ID     NAME      DRIVER    SCOPE
	0f186fa937e6   bridge    bridge    local
	aadf73e7d13f   host      host      local
	2f67f4a0af1f   none      null      local
	c618e4b60d55   tx-net    bridge    local
   ```
1. `docker network inspect tx-net`  
	Should see something like:
   ```
   $ docker network inspect tx-net
	[
	    {
	        "Name": "tx-net",
	        "Id": "c618e4b60d556b749571698381c30a5c6bb7470f48b2d8b5f3dade7551a740ce",
	        "Created": "2021-01-08T13:12:05.322605255Z",
	        "Scope": "local",
	        "Driver": "bridge",
	        "EnableIPv6": false,
	        "IPAM": {
	            "Driver": "default",
	            "Options": {},
	            "Config": [
	                {
	                    "Subnet": "172.18.0.0/16",
	                    "Gateway": "172.18.0.1"
	                }
	            ]
	        },
	        "Internal": false,
	        "Attachable": false,
	        "Ingress": false,
	        "ConfigFrom": {
	            "Network": ""
	        },
	        "ConfigOnly": false,
	        "Containers": {
	            "32ebc67b1c11d4a61cd282bedc8ab06138a4feca2fc643966cf73e6a1b983cc5": {
	                "Name": "D43_DevJob_Handler",
	                "EndpointID": "13c52f972e33e819f0cb1c927dcaaaaadb4522f42d38ab2f51ee16c36047b718",
	                "MacAddress": "02:42:ac:12:00:05",
	                "IPv4Address": "172.18.0.5/16",
	                "IPv6Address": ""
	            },
	            "4db7d6efef0cac91898512bab22a2aecfa914814d6c5dfc51f7f1166a94cd632": {
	                "Name": "tX_Dev_HTML_Job_Handler",
	                "EndpointID": "b5e734f2c029414bba893191813ec23f1dbd75ac80b91eea2adef629c0d534c6",
	                "MacAddress": "02:42:ac:12:00:08",
	                "IPv4Address": "172.18.0.8/16",
	                "IPv6Address": ""
	            },
	            "545aa018501c3a1826bdad5d0bc9fc2c96df18a7651bf4406e8b33db55a0f9a1": {
	                "Name": "door43-enqueue-job_redis_1",
	                "EndpointID": "a184d98eaf4a38e913b7e4d2971e40e9cf41ced0541f9a1cdaa6d9d581c7f7a2",
	                "MacAddress": "02:42:ac:12:00:02",
	                "IPv4Address": "172.18.0.2/16",
	                "IPv6Address": ""
	            },
	            "5e14126ed4c78338bb292a46b13b6a174b6e06ee926237cb1f7d4e859d2d3879": {
	                "Name": "door43-enqueue-job_proxy_1",
	                "EndpointID": "c5b721e33307d2dbe05122b361595d257dc0868090671f820a4085591aeee558",
	                "MacAddress": "02:42:ac:12:00:04",
	                "IPv4Address": "172.18.0.4/16",
	                "IPv6Address": ""
	            },
	            "a868728f1ba73b56a65bd372e6bd4961d121ca2a02b9103059cbc5f59b71c01e": {
	                "Name": "tx-enqueue-job_txenqueue_1",
	                "EndpointID": "752e78e426443caca7a851409c34f78f2ddc2454c00305ad3194c7383d0fd6e8",
	                "MacAddress": "02:42:ac:12:00:06",
	                "IPv4Address": "172.18.0.6/16",
	                "IPv6Address": ""
	            },
	            "bcce633e0ea7754d371332172fba0bc23b6d33aeb0abe5bdf159b71026fe2ec8": {
	                "Name": "tx-enqueue-job_proxy_1",
	                "EndpointID": "2ae4068a174bce2ef3566beda86e0e0e6b7022922c0b845d7a0bdcf6c06d200f",
	                "MacAddress": "02:42:ac:12:00:07",
	                "IPv4Address": "172.18.0.7/16",
	                "IPv6Address": ""
	            },
	            "e45153588d78b63a2abaa9b06ff9831b0b15371c6076f933761b9550cf5f9d0c": {
	                "Name": "door43-enqueue-job_enqueue_1",
	                "EndpointID": "2f0ace607dcf748efcf85d64974ec1c1793cdf3b9b49f91fd4c122ac3bebeb35",
	                "MacAddress": "02:42:ac:12:00:03",
	                "IPv4Address": "172.18.0.3/16",
	                "IPv6Address": ""
	            },
	            "e5869b0558a7a6e9b0f610408575406fa07b96f85b650fdf9f81660198b2f367": {
	                "Name": "obs-pdf",
	                "EndpointID": "66e618f5e29eecb18c49c20cad7e6db46b3a743badf52d4f3379d96fc093eb45",
	                "MacAddress": "02:42:ac:12:00:09",
	                "IPv4Address": "172.18.0.9/16",
	                "IPv6Address": ""
	            }
	        },
	        "Options": {},
	        "Labels": {}
	    }
	]
	   ```



Now it's all set-up.


## Generating a PDF

### In another terminal:

1. `cd <your_repos_dir>/tools/tx`
1. 
   `./submit_tX_tests.py`
   with this in the JSON file it loads:
	```
	{
	    "job_id": "OBS-PDF.test-1.en",
	    "identifier": "unfoldingWord--en_obs--master",
	    "user_token": "682...............................842",
	    "resource_type": "Open_Bible_Stories",
	    "input_format": "md",
	    "output_format": "pdf",
	    "source": "https://git.door43.org/unfoldingWord/en_obs/archive/master.zip"
	}
	```
