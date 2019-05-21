from zeep import Client  #py -m pip install zeep
class soapapi:
    basePath = "https://raygansms.com/FastSend.asmx?WSDL"
    def __init__(self,username,password):
        self.username = username
        self.password = password
    def AutoSendCode(self,ReciptionNumber,Footer):
        client = Client(self.basePath)
        result = client.service.AutoSendCode(self.username,self.password,ReciptionNumber, Footer)
        return result
    def CheckSendCode(self,ReciptionNumber,Code):
        client = Client(self.basePath)
        result = client.service.AutoSendCode(self.username,self.password,ReciptionNumber, Code)
        return result
    def SendMessageWithCode(self,ReciptionNumber,Code):
        client = Client(self.basePath)
        result = client.service.AutoSendCode(self.username,self.password,ReciptionNumber, Code)
        return result

    
