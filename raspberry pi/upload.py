import requests

url = 'http://192.168.0.113/medical/save_image.php'
files = {'image' : open('preview.jpg', 'rb')}
try:
	response = requests.post(url, files=files, timeout=60)
	print(response)
except requests.exceptions.RequestException as e:
			print("Error: {}".format(e))
			print("time out error")