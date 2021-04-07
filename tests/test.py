import subprocess

long_prefix = 'develop'
webhook = 'http://tx-enqueue-job_proxy_1:80'
print( f"\n\n(dev) ta to {webhook}:" )
jsonFilename = f'@./payloads/ida_obs.json'

# Use curl to actually POST the JSON to the given webhook URL
parameters = ['curl', webhook, '-d', jsonFilename, '--header', "Content-Type: application/json", '--header', "X-Gogs-Event: push",]
print(parameters)
myProcess = subprocess.Popen( parameters, stdout=subprocess.PIPE, stderr=subprocess.PIPE )
programOutputBytes, programErrorOutputBytes = myProcess.communicate()
