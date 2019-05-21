from http.client import HTTPSConnection
from base64 import b64encode
import json
class restfulapi:
    basePath = "smspanel.trez.ir"
    def __init__(self,username,password):
        self.username = username
        self.password = password

    def postData(self,url,data):
        try:
            c=HTTPSConnection(self.basePath)
            usr = self.username
            psw = self.password
            stuffInstt = f"{usr}:{psw}"
            bytestr = bytes(stuffInstt, encoding="ascii")
            userAndPass = b64encode(bytestr).decode("ascii")
            headers = { 'Authorization' : 'Basic %s' %  userAndPass , 'Content-type': 'application/json' , 'encoding':'utf-8'}
            c.request('POST', url, headers=headers , body=data)
            res = c.getresponse()
            data = res.read().decode('utf-8')  
            j=json.loads(data)
            if j['Code'] == 0: 
                return j['Result']
            else :
                return j['Message']
        except:
            print("خطایی رخ داده است")

    def GetCredit(self):
      url = "/api/smsAPI/GetCredit"
      return self.postData(url,"{}")

    def GetPrices(self):
        url = "/api/smsAPI/GetPrices"
        return self.postData(url,"{}")

    def SendMessage(self,PhoneNumber,Message,Mobiles,UserGroupID,SendDateInTimeStamp):
        url = "/api/smsAPI/SendMessage"
        jsonData = {'PhoneNumber':PhoneNumber,'Message':Message,'Mobiles':Mobiles,'UserGroupID':UserGroupID,'SendDateInTimeStamp':SendDateInTimeStamp }
        json_foo = json.dumps(jsonData)
        resultData = self.postData(url,json_foo)
        return resultData
    def SendCorrespondingMessage(self,PhoneNumber,MessagesToNumbers,UserGroupID):
        url = "/api/smsAPI/SendCorrespondingMessage"
        jsonData = {'PhoneNumber':PhoneNumber,'RecipientsMessage':MessagesToNumbers,'UserGroupID':UserGroupID }
        json_foo = json.dumps(jsonData)
        resultData = self.postData(url,json_foo)
        return resultData

    def SendMessageToPort(self,PhoneNumber,recievePortNumber,sendPortNumber,MessagesToNumbers,UserGroupID):
        url = "/api/smsAPI/SendMessageToPort"
        jsonData = {'PhoneNumber':PhoneNumber,'recievePortNumber':recievePortNumber,'sendPortNumber':sendPortNumber,'RecipientsMessage':MessagesToNumbers,'UserGroupID':UserGroupID }
        json_foo = json.dumps(jsonData)
        resultData = self.postData(url,json_foo)
        return resultData
    def GroupMessageStatus(self,GroupMessageId):
        url = "/api/smsAPI/GroupMessageStatus"
        jsonData = {'GroupMessageId':GroupMessageId}
        json_foo = json.dumps(jsonData)
        resultData = self.postData(url,json_foo)
        return resultData
    def CorrespondingMessageStatus(self,messageId):
        url = "/api/smsAPI/CorrespondingMessageStatus"
        jsonData = {'messageId':messageId}
        json_foo = json.dumps(jsonData)
        resultData = self.postData(url,json_foo)
        return resultData
    def GetGroupMessageId(self,groupId):
        url = "/api/smsAPI/GetGroupMessageId"
        jsonData = {'groupId':groupId}
        json_foo = json.dumps(jsonData)
        resultData = self.postData(url,json_foo)
        return resultData
    def ReceiveMessages(self,PhoneNumber,StartDate,EndDate,Page):
        url = "/api/smsAPI/ReceiveMessages"
        jsonData = {'PhoneNumber':PhoneNumber,'StartDate':StartDate,'EndDate':EndDate,'Page':Page}
        json_foo = json.dumps(jsonData)
        resultData = self.postData(url,json_foo)
        return resultData
    def ShowWhiteList(self,PhoneNumbers):
        url = "/api/smsAPI/ShowWhiteList"
        jsonData = {'MobilesList':PhoneNumbers}
        json_foo = json.dumps(jsonData)
        resultData = self.postData(url,json_foo)
        return resultData
    def TranslateMessageStatusCode(self,Code):
        result = "تعریف نشده"
        if Code == 1 :
            result = "پیام ارسال شد"
        elif Code == 2:
            result = "پیام در صف می باشد "
        elif Code == 3:
            result = "پیام فیلتر شده است . "
        return result

    def TranslateMessageStatus(self,Code):
        result = "تعریف نشده"
        if Code == 1 :
            result = "رسیده به گوشی"
        elif Code == 2:
            result = "نرسیده به گوشی "
        elif Code == 8:
            result = "رسیده به مخابرات"
        elif Code == 16:
            result = "نرسیده به مخابرات"
        elif Code == 27:
            result = "امکان ارسال پیام به شماره مورد نظر وجود ندارد . "
        elif Code == 23:
            result = "به دلیل ترافیک بالا سرور امکان دریافت پیام جدید را ندارد"
        else:
            result = "پیام در درست بررسی می باشد"
        return result