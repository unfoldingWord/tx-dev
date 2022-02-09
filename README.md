# tX Dev

Purpose of this repo is to have an easy way to setup and run the tX system architecture locally as a dev environment, including a local instance of DCS and a Door43 Preview website.

See https://forum.door43.org/t/door43-org-tx-development-architecture/65 which describes the system architecture.

## Repos Involved

These are the submodules which can also be seen in by viewing this repo on Github](https://git.)

* https://github.com/unfoldingWord-dev/tx-dev (this repo)
* https://github.com/unfoldingWord-dev/door43-enqueue-job
* https://github.com/unfoldingWord-dev/door43-job-handler
* https://github.com/unfoldingWord-dev/door43-catalog-job-handler
* https://github.com/unfoldingWord-dev/tx-enqueue-job
* https://github.com/unfoldingWord-dev/tx-job-handler
* https://github.com/unfoldingWord-dev/tx-pdf
* https://github.com/unfoldingWord-dev/tx-dev-dcs
* https://github.com/unfoldingword-dev/door43.org

## Prereqs

* Have Python v3.8 or newer installed
* Have Docker installed and running


## Initial Setup (only need to do once)

1. Run: `setup.sh`
	This will:
	* Copy env_sample to .env if it doens't exist
	* Installs needed node modules
	* Install all the submodules (the other GitHub repositories listed above in "Repos involved")
	* Clones all the repos listed in above *Repos Involved* section, excluding tx-dev

2. `vi .env` - Set the AWS_ACCESS_KEY and AWS_SECRET_ACCESS_KEY to yours to use with unfoldingWord's xsni AWS account


## Start Docker Containers

`docker compose up`

Use the Docker Dashboard on your machine to watch each container's output

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