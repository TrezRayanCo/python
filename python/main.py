import random
from restapi import restfulapi 
phonenumber = "9830008632000111"
groupId = random.randint(0, 99999999)
ws = restfulapi("user","psw")
# print("******Credit******")
# print(ws.GetCredit())
# print("*****Prices*******")
# print(ws.GetPrices())
#print("*****SendMessage*******")
# print(ws.SendMessage(PhoneNumber=phonenumber,Message="سلام به محمد رستمی از پایتون",Mobiles=['989398219817'],UserGroupID=str(groupId),SendDateInTimeStamp=1558298601))
# print("*****SendMessage*******")
# MessagesList= [{'Id':'10','Message':'سلام به مهران از پایتون','Mobile':'989112170848' },{'Id':'20','Message':'سلام به رستمی از پایتون','Mobile':'989116048697' }]
# print(ws.SendCorrespondingMessage(PhoneNumber=phonenumber,MessagesToNumbers=MessagesList,UserGroupID=str(groupId)))
# MessagesList= [{'Id':'10','Message':'سلام به مهران از پایتون','Mobile':'989112170848' },{'Id':'20','Message':'سلام به رستمی از پایتون','Mobile':'989116048697' }]
# print(ws.SendCorrespondingMessage(PhoneNumber=phonenumber,recievePortNumber=10,sendPortNumber=20,MessagesToNumbers=MessagesList,UserGroupID=str(groupId)))
# print("******GroupMessageStatus******")
# print(ws.GroupMessageStatus('5522009'))
# print("******CorrespondingMessageStatus******")
# print(ws.CorrespondingMessageStatus(['10','20']))
# print("******GetGroupMessageId******")
# print(ws.GetGroupMessageId('5522009')) #a52418c3-6a8f-432e-9002-a787bd556e0f
# print("******ReceiveMessages******")
# print(ws.ReceiveMessages('9830008632000111',1483228800,1558407631 ,1))
# print("******ShowWhiteList******")
#print(ws.ShowWhiteList(['989112170848','989116048697','9891116662206']))

#-------------------------احراز هویت پیامکی ---------------------------------
