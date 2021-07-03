# Draft: Running and Using tx-dev with populdated local instance of DCS

Install latest Docker & git

Then setup with:

```
git clone git@github.com:unfoldingword-dev/tx-dev.git

cd tx-dev

./setup.sh

vi .env
```

Enter your AWS credentials here (while everything runs locally, it uses AWS CloudWatch and S3 for logs and files respectively. You will find your files generated in the dev-* buckets). You don't have to change the ports for websites that will be acessable on your machine, unless they conflict with other ports.

Run with

```
docker compose up
```
(latest version of docker includes compose)

Go to your local copy of DCS running at http://localhost:5555

DCS should already be populated with a root user, a unfoldingWord organization and two resources, en_ta and en_obs. Go to http://localhsot:5555 (or whatever you set the port to in the .env file) and log in with username "root", password "DCS@test123" (without quotes). Then go to http://localhost:5555/unfoldingWord/en_obs/settings/hooks/1 for OBS or http://localhost:5555/unfoldingWord/en_obs/settings/hooks/1 for UTA (see section at bottom of how to migrate other resources over from production DCS). This webhook was also already set up, calling http://d43proxy.

Scroll down to bottom and click `Test Delivery`. Watch the output for d43proxy in the terminal to see it get the job queue it with d43enqueue and that there is a worker waiting. Then you'll see door43-job-handler do its preprocessing and then send the job to txproxy. txenqueue then queues the job and a worker is available. tx-job-handler is then envoked to do the conversion and then send a callback to 43proxy. See d43enqueue then enqueues a callback job for door43-job-handler to put the converted files in the dev-door43.org bucket. You can then view them by clicking the "Preview" at http://localhost:5555/unfoldingWord/en_obs/ (or en_ta).

---

# DCS Credentials

Here are the users, the passwords, and their Application Tokens for the API:

user: root
password: DCS@test123
API token: 84f6fc16baf206fe9f4812e10546dd0f64096f64
description: super user, full admin access

user: uwuser
password: DCS@test123
API token: 67ce2ee6f83d0f350f165233843babf940cc6a97
descriptoin: User, owner of unfoldingWord org

user: door43user
password: DCS@test123
API token: 6a3419a11b9379ab5c8c734ef67100f7f7f90a66
description: User, owner of Door43-Catalog org

----

# Migrating Resources from Produciton DCS

If you want to add another resource from production:

Click the `+` at the top right, `New Migration`, selected `Gitea`, set repo to a uW resource on production, such as "https://git.door43.org/unfoldingword/en_ta". No need for access token as it is pubilc. Change owner to `unfoldingWord`. Repo name should be filled from the URL you posted above. Click `Migrate Repository`. Wait we fill up your tea cup...

Click `Settings` (for the repo, right tab), click `Webhooks`, click `Add Webhook`, click `Gitea`. Enter "http://proxy" as the Target URL. Select `All Events` for `Trigger On`. Click `Add Webhook`.


