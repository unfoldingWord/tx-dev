# tX Dev

Purpose of this repo is to have an easy way to setup and run the tX system architecture locally as a dev environment, including a local instance of DCS and a Door43 Preview website.

See https://forum.door43.org/t/door43-org-tx-development-architecture/65 which describes the system architecture.

## Repos involved:

The individual repos are here:

* https://github.com/unfoldingWord-dev/tx-dev (this repo)
* https://github.com/unfoldingWord-dev/door43-enqueue-job
* https://github.com/unfoldingWord-dev/door43-job-handler
* https://github.com/unfoldingWord-dev/tx-enqueue-job
* https://github.com/unfoldingWord-dev/tx-job-handler
* https://github.com/unfoldingword-dev/door43.org

## Prereqs

* Have Python v3.8 or newer installed
* Have node v12 or newer installed and npm 6.14 or newer installed
* Have Docker installed and running


## Initial Setup (only need to do once):

1. Run: `setup.sh`
	This will:
	* Copy setENVs_sample.sh to setENVs.sh if it doens't exist
	* Installs needed node modules
	* Install all the submodules (other GitHub repositories)
	* Clones all the repos listed in above *Repos Involved* section, excluding tx-dev

2. `vi ./setENVs.sh` - Set the AWS_ACCESS_KEY and AWS_SECRET_ACCESS_KEY to yours to use with unfoldingWord's xsni AWS account. Set the TX_DATABASE_PW to the one used on AWS (obtain from another tX developer). All else can stay the same (No need for GOGS_USER_TOKEN)


## To Start Up Everything in 6 Tabs:

`npm start`

The following happens when you run the above command:
1. Opens five (5) tabs in a terminal window.
1. In each tab it:
	1. Sources the setENVs.sh file to set environment variables
	1. Changes directory to the appropriate cloned repo, e.g., `cd tx-dev/door43-enqueue-job` for tab 1
	1. Runs the proper Makefile command to run the docker container(s) locally in develop mode, setting them up to run on the same Docker network

**Here's a detailed explanation of what's happening in each tab:**

### TAB 1 ([door43-enqueue-job](https://github.com/unfoldingWord-dev/door43-enqueue-job) repo):

**In terminal tab 1:**
* Starts 3 docker containers: a frontend webserver (proxy) to handle webhook & callback calls, a flask app to handle enqueues (enqueue), and redis service (redis)
* The (dev-)door43-enqueue-job process:
	* handles JSON payloads from Door43 webhooks and adds them to the webhook queue for door43-job-handler to preprocess (TAB 2)
	* which then handless callbacks from door43-job-handler (TAB 2) with preprocessed files and makes a job request to tx-enqueue-job (TAB 3)
	* which then handles callbacks from tx-job-handler when job is done (TAB 4), adding a job to the callback queue for door43-job-handler (TAB 2) to deploy files to the door43.org bucket

### TAB 2 ([door43-job-handler](https://github.com/unfoldingWord-dev/door43-job-handler) repo): 

**In terminal tab 2:**
* Starts the (dev-)door43-job-handler process in a Docker container on the tx-net network
* which then connects to the Door43 Redis service and watches the queue for "webhook" and "callback" jobs
	* with "webhook" job: does preprocessing of Door43 repos, uploads the files to the CDN (AWS) and does a call back to door43-enqueue-job (TAB 1)
    * with "callback" job: postprocesses the HTML files to deploy to the door43.org bucket (AWS) [END OF JOB LIFESPAN]

### TAB 3 ([tx-enqueue-job](https://github.com/unfoldingWord-dev/tx-enqueue-job) repo):

**In terminal tab 3:**
* Starts 3 docker containers: a frontend webserver (proxy) to handle tx requests, a flask app to handle enqueues (enqueue), and redis service (redis)
* The (dev-)tx-enqueue-job process:
	* handles JSON payloads from door43-enqueue-job (TAB 1) to request a tX job


### TAB 4 ([tx-job-handler](https://github.com/unfoldingWord-dev/tx-job-handler) repo)
### In terminal tab 4:
* Starts the (dev-)tx-job-handler process in a Docker container on the tx-net network
* which then connects to tX Redis service and watches the queue for jobs
* which then translates preprocessed repos to HTML and PDF files
* which then enqueues a door43-callback (TAB 1)

### TAB 5

**In terminal tab 5:**
* Waits for all the containers to start up. If one isn't starting, check its tab.
* Once all containers have started, shows the rq info on how many workers have been created (should be 3)
* Puts you in the tx-dev/tests directory so you can run some python scripts to simulate generating HTML and PDF content in the tx-net Docker network

## Docker check

While terminal tab 7 above should check a few things for you (e.g. all containers running; # of workers is 3), you should make sure that all these docker processes are communicating properly. You can do this by running the following:

### In another terminal on your machine run:

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
	                "Name": "tX_Dev_Job_Handler",
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
	        },
	        "Options": {},
	        "Labels": {}
	    }
	]
	```

Now it's all set-up.


## Simulate Triggering the Generation of HTML or a PDF

### In terminal tab 7:

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


## Notes About Job Queues Involved

tX has these 1 job queue:

1. tX_webhook: makes HTML or PDF pages based on  output format in job request

## Notes about Making an RQ app

To make a RQ app:

1. include [RQ](https://pypi.org/project/rq/) and change queue name in your copy of https://github.com/unfoldingWord-dev/tx-job-handler/blob/develop/public/rq_settings.py.
1. create a function for rq to call named job as in https://github.com/unfoldingWord-dev/tx-job-handler/blob/develop/public/webhook.py.
1. job(...) should receive a JSON dict as described in https://forum.door43.org/t/door43-org-tx-development-architecture/65 section 4.
1. The worker should create the file(s) and upload them as a zip file to `(dev-)cdn.door43.org/u/<repo_owner_username>/<repo_name>/<branch_or_tag_name>/`.