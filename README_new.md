# Draft: Running and Using tx-dev with populdated local instance of DCS

Install Docker & git

```
git clone git@github.com:unfoldingword-dev/tx-dev.git

cd tx-dev

./setup.sh

vi setENVs.sh
```

set the AWS_ACCESS_KEY and AWS_SECRET_ACCESS_KEY to yours to use with unfoldingWord's xsni AWS account. Set the TX_DATABASE_PW to the one used on AWS (obtain from another tX developer). All else can stay the same (No need for GOGS_USER_TOKEN)

```
npm start
```

Go to http://localhost:3000/user/login

DCS should already be populated with a root user, a unfoldingWord organization and two resources, en_ta and en_obs. When you go to http://localhsot:3000 (or whatever you set the port to in setENVs.sh) you should already be logged in as username "root" (but if you need it, the password is "DCS@test123"). Go to http://localhost:3000/unfoldingWord/en_obs/settings/hooks/1 for OBS or http://localhost:3000/unfoldingWord/en_obs/settings/hooks/1  UTA (see section at bottom of how to migrate other resources over from production DCS). This webhook was also already set up, calling http://proxy which is th process running in Tab 1

Scroll down to bottom and click `Test Delivery`. Watch Tab 1 of terminal to see it get the job and that there is a worker waiting. See Tab 2 do its preprocessing and then send the job to Tab 3 (http://txproxy). See Tab 3 queue the job and a worker is available. See Tab 4 (tx-job-handler) do the conversion and then send a callback to http://proxy (Tab 1). See Tab 1 queue a callback job for Tab 2. See Tab 2 deploy the converted files.

----

# Migrating Resources from Produciton DCS

If you want to add another resource from production:

Click the `+` at the top right, `New Migration`, selected `Gitea`, set repo to a uW resource on production, such as "https://git.door43.org/unfoldingword/en_ta". No need for access token as it is pubilc. Change owner to `unfoldingWord`. Repo name should be filled from the URL you posted above. Click `Migrate Repository`. Wait we fill up your tea cup...

Click `Settings` (for the repo, right tab), click `Webhooks`, click `Add Webhook`, click `Gitea`. Enter "http://proxy" as the Target URL. Select `All Events` for `Trigger On`. Click `Add Webhook`.


