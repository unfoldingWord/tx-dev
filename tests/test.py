import subprocess

long_prefix = 'develop'
webhook = 'http://127.0.0.1:8090/'
print( f"\n\n(dev) obs to {webhook}:" )
jsonFilename = f'@./payloads/obs.json'

# Use curl to actually POST the JSON to the given webhook URL
parameters = ['curl', webhook, '-d', jsonFilename, '--header', "Content-Type: application/json", '--header', "X-Gogs-Event: push",]
print(parameters)
myProcess = subprocess.Popen( parameters, stdout=subprocess.PIPE, stderr=subprocess.PIPE )
programOutputBytes, programErrorOutputBytes = myProcess.communicate()

