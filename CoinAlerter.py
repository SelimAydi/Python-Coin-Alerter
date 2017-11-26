import urllib.request
import json
import time
import requests
import smtplib
import getpass
import string

# Coinalerter using coinmarketcap API
# Sends an email to users if set lower and/or upper boundaries are crossed
# Currently in USD

class Alerter:
    def __init__(self):
    	# Config for api requests/posts
		self.getListApi = 'http://localhost:8000/get.php'
		self.postchangesApi = 'http://localhost:8000/post.php'

		# Config for SMTP
		self.sender = 'example@gmail.com'
		self.server = smtplib.SMTP('smtp.gmail.com', 587)
		self.username = 'example@gmail.com'
		self.password = 'yourpassword'

    def getList(self):
        return json.loads(urllib.request.urlopen(self.getListApi).read().decode())

    def connect(self, URL):
        connection = urllib.request.urlopen(URL)
        return connection

    def sendMail(self, email, msg):
        try:
            self.server.ehlo()
            self.server.starttls()
            self.server.login(self.username, self.password)
            receivers = ['{}'.format(email)]

            message = """From: Coin Alert <{0}>
            To: To Person <{1}>
            Subject: Coinalert!

            {2}
            """.format(self.sender, email, msg)

            server.sendmail(self.sender, receivers, message)
            print("Mail has been sent to {}".format(email))
        except smtplib.SMTPAuthenticationError:
            server.quit()
            print("Authorization error")

    def run(self):
        while True:
            #occasionally refreshes list of users
            users = self.getList()
            for i in users:
                self.alert(i['email'], i['rowid'], i['coin_name'], i['low'], i['high'], i['alerted'])
            time.sleep(60)

    def alert(self, email, rowid, coin_name, low, high, alerted):
        URL = "https://api.coinmarketcap.com/v1/ticker/" + coin_name + "/"
        getdata = json.loads(self.connect(URL).read().decode())[0]['price_usd']
        if alerted != "True":
            if float(getdata) > float(high):
                msg = "Alarm, {0} ({1}) is higher than set alarm {2}".format(coin_name, float(getdata), float(high))
                print(msg)
                self.sendMail(email, msg)
                print("Message sent to {}".format(email))
                userdata = {"id": "{}".format(rowid)}
                resp = requests.post(self.postchangesApi, params=userdata)
            elif float(getdata) < float(low):
                msg = "Alarm, {0} ({1}) is lower than set alarm {2}".format(coin_name, float(getdata), float(low))
                print(msg)
                self.sendMail(email, msg)
                print("Message sent to {}".format(email))
                userdata = {"id": "{}".format(rowid)}
                resp = requests.post(self.postchangesApi, params=userdata)
            else:
                print("User: {0} - {1} ({2}) currently sits in between".format(email, coin_name, float(getdata)))
            print()
            print()


al1 = Alerter()
al1.run()
q = input("Quit?")
