using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Text;
using System.Web;
using System.Web.Script.Serialization;


public class trezSMS_Service
{
	// برای دریافت اعتبار کاربر
    public static string GetCredit()
    {
        return PostData("GetCredit","[]");
    }
	// برای دریافت تعرفه ارسال پیام فارسی و لاتین
    public static string GetPrices()
    {
        return PostData("GetPrices", "[]");
    }

	// مشاهده لیست شماره هایی که در لیست سیاه قرار ندارند یا به عبارت دیگر لیست سفید می باشند 
    public static string ShowWhiteList()
    {
        List<string> MobilesListvar = new List<string>() {"09112170848","09116662206","09119043011" }; 
        object input = new
        {
            MobilesList = MobilesListvar  // لیست شماره موبایل ها برای بررسی
        };
        string inputJson = (new JavaScriptSerializer()).Serialize(input);
        return PostData("ShowWhiteList", inputJson);
    }
	
	// مشاهده پیام های دریافتی در یک بازه زمانی
    public static string ReceiveMessages()
    {
        long StartDate = GetTimeStamp(DateTime.Now.AddDays(-10),DateTimeKind.Local);

        long EndDate = GetTimeStamp(DateTime.Now,DateTimeKind.Local);

        object input = new
        {
            PhoneNumber = "9830008632000111" , // شماره اختصاصی
            StartDate = StartDate , // تاریخ شروع
            EndDate = EndDate, // تاریخ پایان
            Page = 1 // شماره صفحه
        };
        string inputJson = (new JavaScriptSerializer()).Serialize(input);
        return PostData("ReceiveMessages", inputJson);
    }

	// ارسال پیام متناظر 
    public static string SendCorrespondingMessage()
    {
        List<MessageToNumber> RecipientsMessage = new List<MessageToNumber>() { new MessageToNumber() { Id = "1", Message = "سلام مهران احمدی ", Mobile = "09112170848" } , new MessageToNumber() { Id = "2", Message = "سلام محمد گلی خطیر", Mobile = "09116662206" }  }; 
        object input = new
        {
            PhoneNumber = "9830008632000111", // شماره اختصاصی
            RecipientsMessage, // پیام ارسالی به فرمت شماره ؛ متن
            UserGroupID = "0848" // شماره پیگیری 
        };
        string inputJson = (new JavaScriptSerializer()).Serialize(input);
        return PostData("SendCorrespondingMessage", inputJson);
    }
	// دریافت وضعیت پیام ارسالیبه صورت گروهی
    public static string GroupMessageStatus()
    {
        object input = new
        {
            GroupMessageId = "1e5c27bf-7483-416d-94c0-1271990b3b16" // شماره پیگیری
        };
        string inputJson = (new JavaScriptSerializer()).Serialize(input);
        return PostData("GroupMessageStatus", inputJson);
    }

	// دریافت وضعیت پیام ارسالی متناظر
    public static string CorrespondingMessageStatus()
    {
        List<string> messageId2 = new List<string>(){"0848","0849"}; 
        object input = new
        {
            messageId = messageId2 // لیست شماره های پیگیری
        };
        string inputJson = (new JavaScriptSerializer()).Serialize(input);
        return PostData("CorrespondingMessageStatus", inputJson);
    }
 
	// ارسال پیام 
    public static string SendMessage()
    {
        List<string> MobilesListvar = new List<string>() {"09112170848","09333152378"};

        object input = new
        {
            PhoneNumber = "9830008632000111", // شماره اختصاصی
            Message = "سلام این یک پیام دیگری برای تست می باشد", // متن پیام ارساالی
            UserGroupID = "849", // شماره پیگیری
            Mobiles = MobilesListvar, // لیست شماره موبایل ها
            SenDateInTimeStamp = GetTimeStamp(DateTime.Now, DateTimeKind.Local) // تاریخ ارسال به صورت timestamp
        };

        string inputJson = (new JavaScriptSerializer()).Serialize(input);
        return PostData("SendMessage", inputJson);
    }
	
	// متد اصلی برای ارسال درخواست به سمت سرور
    private static string PostData(string method,string inputJson)
    {
        try
        {
            string apiUrl = "http://raygansms.com/api/smsAPI/"; // آدرس پایه سرویس دهنده
            MyWebClient client = new MyWebClient(); 
            client.Headers["Content-type"] = "application/json"; // درخواست در قالب جی سون ارسال می گردد
            string token = Base64Encode("username:psw"); // نام کاربر ی ورمز عبور 
            client.Headers.Add("Authorization", string.Format("Basic {0}", token)); // استفاده از مدل احراز هویت بیسیک 
            client.Encoding = Encoding.UTF8;  // پشتبانی از یو تی اف 8
            string json = client.UploadString(apiUrl + method, "POST", inputJson); // ارسال اطلاعات به صورت پست
            return json;

        }
        catch (Exception ex)
        {
            return ex.Message;
        }
    }
	// انکد کردن به بیس 64
    private static string Base64Encode(string plainText)
    {
        var plainTextBytes = System.Text.Encoding.UTF8.GetBytes(plainText);
        return System.Convert.ToBase64String(plainTextBytes);
    }
	
    public static  long GetTimeStamp(DateTime dt , DateTimeKind dtk)
    {
        Int64 unixTimestamp = (Int64)(dt.Subtract(new DateTime(1970, 1, 1,0,0,0,dtk))).TotalSeconds;
        return unixTimestamp; 
    }
}

// کلاس های کمکی
public class MyWebClient : WebClient
{
    protected override WebRequest GetWebRequest(Uri uri)
    {
        WebRequest w = base.GetWebRequest(uri);
        w.Timeout = 5 * 60 * 1000; // مدت زمان تایم اوت شدن درخواست
        return w;
    }
}
public class MessageToNumber
{
    public string Id { get; set; }
    public string Message { get; set; }
    public string Mobile { get; set; }
}