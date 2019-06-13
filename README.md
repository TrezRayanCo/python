ارسال اس‌ام‌اس ترز
در پایتون

## وب سرویس پیامک به صورت restful

## نصب و تنظیمات
نیاز به اقدام خاصی برای استفاده از بخش پیامک ندارید 

## ارسال پیام
برای ارسال پیام میتوانید از متد `sendMessage` استفاده کنید:

 | توضیحات  |  نوع پارامتر | نام پارامتر  |
 | ------------ | ------------ | ------------ |
|شماره اختصاصی برای ارسال پیام  |  string |  PhoneNumber |
 |متن پیام ارسالی به کاربر   |  string |  Message |
 |آرایه ای از شماره موبایل |  string[] |  Mobiles |
 |شناسه کاربر برای پیگیری وضعیت ارسال پیام|string|UserGroupID|
 |زمان ارسال پیام به صورت یونیکس|long|SendDateInTimeStamp|
 
```python
import random
from restapi import restfulapi 
phonenumber = "9830008632000111"
groupId = random.randint(0, 99999999)
ws = restfulapi("mehran67","a14267")
ws.SendMessage(PhoneNumber=phonenumber,Message="سلام به محمد رستمی از پایتون",Mobiles=['989398219817'],UserGroupID=str(groupId),SendDateInTimeStamp=1558298601)
```
## ارسال پیام دسته ای یا متناظر
از این متد برای ارسال پیام نظیر به نظیر استفاده میشود و هر پیام به شماره متناظر خود ارسال خواهد شد. با استفاده از این قابلیت میتوانید پیام متفاوتی را برای هر شماره بصورت اختصاصی تنها با یک بار فراخوانی ارسال کتید.

 | توضیحات  |  نوع پارامتر | نام پارامتر  |
 | ------------ | ------------ | ------------ |
|شماره اختصاصی برای ارسال پیام  |  string |  PhoneNumber |
 |متن پیام ارسالی به کاربر مورد نظر  |  object[] |  MessagesToNumbers |
 |آرایه ای از شماره موبایل |  string[] |  Mobiles |
 |شناسه کاربر برای پیگیری وضعیت ارسال پیام|string|UserGroupID|
```python
import random
from restapi import restfulapi 
phonenumber = "9830008632000111"
groupId = random.randint(0, 99999999)
ws = restfulapi("mehran67","a14267")
MessagesList= [{'Id':'10','Message':'سلام به مهران از پایتون','Mobile':'989112170848' },{'Id':'20','Message':'سلام به رستمی از پایتون','Mobile':'989116048697' }]
ws.SendCorrespondingMessage(PhoneNumber=phonenumber,MessagesToNumbers=MessagesList,UserGroupID=str(groupId))
```
 | توضیحات  |  نوع پارامتر | نام پارامتر  |
 | ------------ | ------------ | ------------ |
 |شناسه کاربر برای پیگیری وضعیت ارسال پیام|string|UserGroupID|
## وضعیت پیام
از این متند برای مشاهده وضعیت پیام های ارسالی در مراحل قبل میتوان استفاده کرد.
   ```python
from restapi import restfulapi 
ws = restfulapi("usr","psw")
print(ws.GroupMessageStatus('5522009'))
```
## وضعیت پیام دسته ای یا متناظر
از این متند برای مشاهده وضعیت پیام هایی که در مراحل قبل بصورت دسته ای یا نظیر به نظیر ارسال شده اند میتوان استفاده کرد.

 | توضیحات  |  نوع پارامتر | نام پارامتر  |
 | ------------ | ------------ | ------------ |
 |شناسه کاربر برای پیگیری وضعیت ارسال پیام|array of string|UserGroupID|
 
```python
from restapi import restfulapi 
ws = restfulapi("###","###")
print(ws.CorrespondingMessageStatus(['10','20']))
```
## پیام های دریافتی
با استفاده از این متد میتوانید به پیام های دریافتی خط مورد نظر دسترسی داشته باشید:

 | توضیحات  |  نوع پارامتر | نام پارامتر  |
 | ------------ | ------------ | ------------ |
 |شماره اختصاصی |string|PhoneNumber|
 |تاریخ شروع بازه زمانی دریافت پیام |long|startDate|
 |تاریخ پایان بازه زمانی دریافت پیام |long|endDate|
 |شماره صفحه در لیست صفحه بندی شده پیام ها|int|page|
```python
from restapi import restfulapi 
ws = restfulapi("usr","psw")
ws.ReceiveMessages('9830008632000111',1483228800,1558407631 ,1)
```
## موجودی حساب
از طریق این متد میتوانید موجودی حال حاضر حساب خود را به ریال محاسبه کنید:
```python
from restapi import restfulapi 
ws = restfulapi("usr","psw")
print(ws.GetCredit())
```
## قیمت ها
جهت دریافت تعرفه ارسال پیامک از این متد استفاده کنید
```python
from restapi import restfulapi 
ws = restfulapi("usr","psw")
print(ws.GetPrices())
```
## لیست سفید
این متد ورودی ارسال را بررسی کرده و از آن لیست شماره هایی که در لیست سفید هستند را بر می گرداند
 
 | توضیحات  |  نوع پارامتر | نام پارامتر  |
 | ------------ | ------------ | ------------ |
|لیست شماره موبایل ها برای بررسی لیست سفید  |array of  string|  PhoneNumber |

```python
from restapi import restfulapi 
ws = restfulapi("usr","psw")
ws.ShowWhiteList(['989112170848','989116048697','9891116662206'])
```



