<?php
//-----------------دریافت میزان اعتبار
function Get_Credit($username,$password)
{
  $url = "http://raygansms.com/api/smsAPI/GetCredit";
  
  $process = curl_init();
  curl_setopt($process,CURLOPT_URL,$url);
  curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
  curl_setopt($process, CURLOPT_TIMEOUT, 30);
  curl_setopt($process, CURLOPT_POST, 1);
  curl_setopt($process, CURLOPT_POSTFIELDS, "");
  curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
  $return = curl_exec($process);
  $httpcode = curl_getinfo($process, CURLINFO_HTTP_CODE);
  if($httpcode==401)
  {
    throw new exception("نام کاربری یا کلمه عبور صحیح نمی باشد");
  }
  curl_close($process);
  $decoded = json_decode($return);
  echo $httpcode;
  return $decoded;
}

//---------------ارسال پیام
function Send_Message($username,$password,$phone_number,$message,$mobiles_array)
{
  $url = "http://raygansms.com/api/smsAPI/SendMessage";
  $post_data = json_encode(array(
    'PhoneNumber' => $phone_number,
    'Message' => $message,
    'Mobiles' => $mobiles_array,
    'UserGroupID' => uniqid(),
    'SendDateInTimeStamp' => time(),
  ));
  
  $process = curl_init();
  curl_setopt($process,CURLOPT_URL,$url);
  curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
  curl_setopt($process, CURLOPT_TIMEOUT, 30);
  curl_setopt($process, CURLOPT_POST, 1);
  curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
  curl_setopt($process, CURLOPT_POSTFIELDS, $post_data);                                                                 
  curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($process, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json'));   
    
    $return = curl_exec($process);
    $httpcode = curl_getinfo($process, CURLINFO_HTTP_CODE);
    if($httpcode==401)
    {
      throw new exception("نام کاربری یا کلمه عبور صحیح نمی باشد");
    }
    curl_close($process);
    $decoded = json_decode($return);
    return $decoded;
  }
  
  //------------- ارسال پیام متناظر
  
  function SendCorrespondingMessage($username,$password,$phone_number,$recipientsmessage)
  {
    $url = "http://raygansms.com/api/smsAPI/SendCorrespondingMessage";
    $post_data = json_encode(array(
      'PhoneNumber' => $phone_number,
      'RecipientsMessage' => $recipientsmessage,
      'UserGroupID' => uniqid(),
    ));
    
    $process = curl_init();
    curl_setopt($process,CURLOPT_URL,$url);
    curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
    curl_setopt($process, CURLOPT_TIMEOUT, 30);
    curl_setopt($process, CURLOPT_POST, 1);
    curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($process, CURLOPT_POSTFIELDS, $post_data);                                                                 
    curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($process, CURLOPT_HTTPHEADER, array(                                                                          
      'Content-Type: application/json'));   
      
      $return = curl_exec($process);
      $httpcode = curl_getinfo($process, CURLINFO_HTTP_CODE);
      if($httpcode==401)
      {
        throw new exception("نام کاربری یا کلمه عبور صحیح نمی باشد");
      }
      curl_close($process);
      $decoded = json_decode($return);
      return $decoded;
    }
    
    //------------------- ارسال پیام به پورت خاص
    function SendMessageToPort($username,$password,$phone_number,$send_port_number,$recive_port_number,$recipientsmessage)
    {
      $url = "http://raygansms.com/api/smsAPI/SendMessageToPort";
      $post_data = json_encode(array(
        'PhoneNumber' => $phone_number,
        'recievePortNumber'=>$recive_port_number,
        'sendPortNumber'=>$send_port_number,
        'RecipientsMessage' => $recipientsmessage,
        'UserGroupID' => uniqid(),
      ));
      
      $process = curl_init();
      curl_setopt($process,CURLOPT_URL,$url);
      curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
      curl_setopt($process, CURLOPT_TIMEOUT, 30);
      curl_setopt($process, CURLOPT_POST, 1);
      curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
      curl_setopt($process, CURLOPT_POSTFIELDS, $post_data);                                                                 
      curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($process, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json'));   
        
        $return = curl_exec($process);
        $httpcode = curl_getinfo($process, CURLINFO_HTTP_CODE);
        if($httpcode==401)
        {
          throw new exception("نام کاربری یا کلمه عبور صحیح نمی باشد");
        }
        curl_close($process);
        $decoded = json_decode($return);
        return $decoded;
        
      }
      
      //--------------------- پیام های دریافتی
      function ReceiveMessages($username,$password,$phone_number,$start_date,$end_date,$page)
      {
        $url = "http://raygansms.com/api/smsAPI/ReceiveMessages";
        $post_data = json_encode(array(
          'PhoneNumber' => $phone_number,
          'StartDate'=>strtotime($start_date),
          'EndDate'=>strtotime($end_date),
          'Page' => $page
        ));
        $process = curl_init();
        curl_setopt($process,CURLOPT_URL,$url);
        curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($process, CURLOPT_TIMEOUT, 30);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($process, CURLOPT_POSTFIELDS, $post_data);                                                                 
        curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($process, CURLOPT_HTTPHEADER, array(                                                                          
          'Content-Type: application/json'));   
          
          $return = curl_exec($process);
          $httpcode = curl_getinfo($process, CURLINFO_HTTP_CODE);
          if($httpcode==401)
          {
            throw new exception("نام کاربری یا کلمه عبور صحیح نمی باشد");
          }
          curl_close($process);
          $decoded = json_decode($return);
          return $decoded;
        }
        //--------------- دریافت قیمت پیامک ---------
        function Get_Prices($username,$password)
        {
          $url = "http://raygansms.com/api/smsAPI/GetPrices";
          
          $process = curl_init();
          curl_setopt($process,CURLOPT_URL,$url);
          curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
          curl_setopt($process, CURLOPT_TIMEOUT, 30);
          curl_setopt($process, CURLOPT_POST, 1);
          curl_setopt($process, CURLOPT_POSTFIELDS, "");
          curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
          $return = curl_exec($process);
          $httpcode = curl_getinfo($process, CURLINFO_HTTP_CODE);
          if($httpcode==401)
          {
            throw new exception("نام کاربری یا کلمه عبور صحیح نمی باشد");
          }
          curl_close($process);
          
          $decoded = json_decode($return);
          if(isset($decoded->Result))
          {
            return $decoded->Result;
          }
          else
          {
            return $decoded->Message;
          }
        }
        
        //---------------- بررسی بلک لیست -----------------
        // این تابع لیست شماره ها را دریافت می کند و شماره هایی که عضو بلک لیست نباشند را برگشت می دهد
        function ShowWhiteList($username,$password,$mobiles_list)
        {
          $url = "http://raygansms.com/api/smsAPI/ShowWhiteList";
          $post_data = json_encode(array(
            'MobilesList' => $mobiles_list
          ));
          $process = curl_init();
          curl_setopt($process,CURLOPT_URL,$url);
          curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
          curl_setopt($process, CURLOPT_TIMEOUT, 30);
          curl_setopt($process, CURLOPT_POST, 1);
          curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
          curl_setopt($process, CURLOPT_POSTFIELDS, $post_data);                                                                 
          curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
          curl_setopt($process, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json'));   
            
            $return = curl_exec($process);
            $httpcode = curl_getinfo($process, CURLINFO_HTTP_CODE);
            if($httpcode==401)
            {
              throw new exception("نام کاربری یا کلمه عبور صحیح نمی باشد");
            }
            curl_close($process);
            $decoded = json_decode($return);
            return $decoded;
          }
          
          //----------------- دریافت شناسه پیام گروهی ---------------------
          
          function GetGroupMessageId($username,$password,$groupid)
          {
            $url = "http://raygansms.com/api/smsAPI/GetGroupMessageId";
            $post_data = json_encode(array(
              'groupId' => $groupid
            ));
            $process = curl_init();
            curl_setopt($process,CURLOPT_URL,$url);
            curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
            curl_setopt($process, CURLOPT_TIMEOUT, 30);
            curl_setopt($process, CURLOPT_POST, 1);
            curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($process, CURLOPT_POSTFIELDS, $post_data);                                                                 
            curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($process, CURLOPT_HTTPHEADER, array(                                                                          
              'Content-Type: application/json'));   
              
              $return = curl_exec($process);
              $httpcode = curl_getinfo($process, CURLINFO_HTTP_CODE);
              if($httpcode==401)
              {
                throw new exception("نام کاربری یا کلمه عبور صحیح نمی باشد");
              }
              curl_close($process);
              $decoded = json_decode($return);
              return $decoded;
            }
            
            //--------------------------- دریافت وضعیت پیام های گروهی -------------------
            function GroupMessageStatus($username,$password,$group_message_id)
            {
              $url = "http://raygansms.com/api/smsAPI/GroupMessageStatus";
              $post_data = json_encode(array(
                'GroupMessageId' => $group_message_id
              ));
              $process = curl_init();
              curl_setopt($process,CURLOPT_URL,$url);
              curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
              curl_setopt($process, CURLOPT_TIMEOUT, 30);
              curl_setopt($process, CURLOPT_POST, 1);
              curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
              curl_setopt($process, CURLOPT_POSTFIELDS, $post_data);                                                                 
              curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
              curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
              curl_setopt($process, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json'));   
                
                $return = curl_exec($process);
                $httpcode = curl_getinfo($process, CURLINFO_HTTP_CODE);
                if($httpcode==401)
                {
                  throw new exception("نام کاربری یا کلمه عبور صحیح نمی باشد");
                }
                curl_close($process);
                $decoded = json_decode($return);
                return $decoded;
              }
              
              
              //--------------------------- دریافت وضعیت پیام متناظر --------------------
              function CorrespondingMessageStatus($username,$password,$message_id_list)
              {
                $url = "http://raygansms.com/api/smsAPI/CorrespondingMessageStatus";
                $post_data = json_encode(array(
                  'messageId' => $message_id_list
                ));
                $process = curl_init();
                curl_setopt($process,CURLOPT_URL,$url);
                curl_setopt($process, CURLOPT_USERPWD, $username . ":" . $password);
                curl_setopt($process, CURLOPT_TIMEOUT, 30);
                curl_setopt($process, CURLOPT_POST, 1);
                curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($process, CURLOPT_POSTFIELDS, $post_data);                                                                 
                curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($process, CURLOPT_HTTPHEADER, array(                                                                          
                  'Content-Type: application/json'));   
                  
                  $return = curl_exec($process);
                  $httpcode = curl_getinfo($process, CURLINFO_HTTP_CODE);
                  if($httpcode==401)
                  {
                    throw new exception("نام کاربری یا کلمه عبور صحیح نمی باشد");
                  }
                  curl_close($process);
                  $decoded = json_decode($return);
                  return $decoded;
                }
                ?>
                
                <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fa-ir" lang="fa-ir" >
                <head>
                <meta http-equiv="content-type" content="text/html;charset=utf-8" />
                </head>
                <body style="background-color: #e0e0e0; direction: rtl;">
                <!--///////////////////////////////////// اعتبار -->
                <i style="color:blue;font-size:30px;font-family:calibri;float: right;">
                دریافت اعتبار </i>
                <br>
                <hr>
                <br>
                
                <!-- <div style="width: 900px; height: 20px; margin: 0 auto;"> </div> -->
                <div style="width: 900px; margin: 0 auto; font-family: Tahoma; background-clip: padding-box;
                background-color: #fff; border-radius: 4px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
                overflow: hidden; font-size: 10px;">
                <div style="background-color: #f5f5f5; width: 100%; border-bottom: 2px solid #ebebeb;
                height: 38px; padding-right: 10px; text-align: right;"> <span style="border-bottom: 2px solid #0091ff; color: #666; display: inline-block;
                font-size: 12px; height: 38px; line-height: 42px;">اطلاعات کاربری </span> </div>
                <br />
                <table cellpadding="0" cellspacing="0" style="width: 850px; margin: 0 auto; font-size: 12px;">
                <tr>
                <td><table cellpadding="0" cellspacing="0" style="width: 800px">
                <tr style="height: 40px">
                <form method="POST">
                <td style="width: 80px; font-size:10px" > نام کاربری : </td>
                <form method="post" action="">
                
                <td style="width: 200px"><input name="username" type="text" id="username" style="text-align: center" />
                </td>
                <td style="width: 80px ; font-size:10px"> رمز عبور : </td>
                <td style="width: 200px"><input  type="password" type="password" name="password" type="text" id="password" style="text-align: center" />
                </td>
                </tr>
                
                </table>
                </td>
                </tr>
                </table>
                <br />
                <tr>
                <td><table cellpadding="0" cellspacing="0" style="width: 621px">
                <tr style="height: 40px">
                <td style="width: 120px"> میزان اعتبار : </td>
                <td><span id="lblcredit" class="label-testing" style="color:#A0A0A0;">
                <?php '.$crdt.' ?>
                </span> </td>
                </tr>
                <tr>
                <td class="style6"></td>
                <td class="style2"><input type="submit" name="get_credit" value="دریافت میزان اعتبار" id="Button1" style="background-color: #dbecf6;                       border:2px solid #79b7e8; border-radius: 5px; color: #1d5987; cursor: pointer; float: none; font: 12px Tahoma;
                padding-bottom: 3px; padding-top: 3px; text-align: center;" />
                </td>
                </form>
                </tr>
                </table></td>
                </div>
                <br />
                <?php
                if (isset($_POST['get_credit']) && $_POST["username"]  && $_POST["password"])
                {
                  $username=$_POST["username"];
                  $password= $_POST["password"];
                  try{
                    $result=Get_Credit($username,$password);
                    print_r($result);
                    if(isset($result->Result))
                    {
                      $crdt=$result->Result;
                    }else if(isset($result->Message)){
                      $crdt=$result->Message;
                    }
                    else{
                      $crdt="خطا در انجام عملیات";
                    }
                  }
                  catch(exception $ex)
                  {
                    $crdt=$ex->getMessage();
                  }
                  ?>
                  <script>
                  var qu = "<?php echo $crdt; ?>";
                  document.getElementById("lblcredit").innerHTML = this.qu;
                  qu.style.color = "red"; 
                  </script>
                  <?php
                }
                else{
                  ?>
                  <script>
                  document.getElementById("Label1").innerHTML = "لطفا تمامی اطلاعات را تکمیل نمایید";
                  </script>
                  <?php
                }
                ?>
                
                
                <!--///////////////////////////////////// چک کردن بلک لیست -->
                <i style="color:blue;font-size:30px;font-family:calibri;float: right;">
                چک کردن شماره های بلک لیست </i>
                <br>
                <hr>
                <br>
                
                <!-- <div style="width: 900px; height: 20px; margin: 0 auto;"> </div> -->
                <div style="width: 900px; margin: 0 auto; font-family: Tahoma; background-clip: padding-box;
                background-color: #fff; border-radius: 4px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
                overflow: hidden; font-size: 10px;">
                <div style="background-color: #f5f5f5; width: 100%; border-bottom: 2px solid #ebebeb;
                height: 38px; padding-right: 10px; text-align: right;"> <span style="border-bottom: 2px solid #0091ff; color: #666; display: inline-block;
                font-size: 12px; height: 38px; line-height: 42px;">اطلاعات کاربری </span> </div>
                <br />
                <table cellpadding="0" cellspacing="0" style="width: 850px; margin: 0 auto; font-size: 12px;">
                <tr>
                <td><table cellpadding="0" cellspacing="0" style="width: 800px">
                <tr style="height: 40px">
                
                <td style="width: 80px; font-size:10px" > نام کاربری : </td>
                <form method="post" action="">
                
                <td style="width: 200px"><input name="username" type="text" id="username" style="text-align: center" />
                </td>
                <td style="width: 80px ; font-size:10px"> رمز عبور : </td>
                <td style="width: 200px"><input  type="password" type="password" name="password" type="text" id="password" style="text-align: center" />
                </td>
                <td style="width: 120px ; font-size:10px"> لیست شماره ها: </td>
                <td><textarea name="numbers" id="number" style="text-align: center"></textarea>
                </td>
                </tr>
                
                </table>
                </td>
                </tr>
                </table>
                <br />
                <tr>
                <td><table cellpadding="0" cellspacing="0" style="width: 621px">
                <tr style="height: 40px">
                <td style="width: 120px"> شماره های لیست سفید : </td>
                <td><span id="Label1" class="label-testing" style="color:#A0A0A0;">
                <?php '.$crdt.' ?>
                </span> </td>
                </tr>
                <tr>
                <td class="style6"></td>
                <td class="style2"><input type="submit" name="check_blacklist" value="دریافت میزان اعتبار" id="Button1" style="background-color: #dbecf6;                       border:2px solid #79b7e8; border-radius: 5px; color: #1d5987; cursor: pointer; float: none; font: 12px Tahoma;
                padding-bottom: 3px; padding-top: 3px; text-align: center;" />
                <form method="post" action="">
                </form></td>
                </tr>
                </table></td>
                </div>
                <br />
                <?php
                if (isset($_POST['check_blacklist']) && $_POST["username"]  && $_POST["password"] && $_POST["numbers"] )
                {
                  $username=$_POST["username"];
                  $password= $_POST["password"];
                  $nums = explode("<br />",nl2br($_POST['numbers']));
                  
                  $crdt=ShowWhiteList($username,$password,$nums);
                  print_r($crdt);
                  ?>
                  
                  <?php
                }
                else{
                  ?>
                  <script>
                  document.getElementById("Label1").innerHTML = "لطفا تمامی اطلاعات را تکمیل نمایید";
                  </script>
                  <?php
                }
                ?>
                
                
                <!--///////////////////////////////////// دریافت وضعیت پیام ها -->
                <i style="color:blue;font-size:30px;font-family:calibri;float: right;">
                دریافت وضعیت پیام ها</i>
                <br>
                <hr>
                <br>
                
                <!-- <div style="width: 900px; height: 20px; margin: 0 auto;"> </div> -->
                <div style="width: 900px; margin: 0 auto; font-family: Tahoma; background-clip: padding-box;
                background-color: #fff; border-radius: 4px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
                overflow: hidden; font-size: 10px;">
                <div style="background-color: #f5f5f5; width: 100%; border-bottom: 2px solid #ebebeb;
                height: 38px; padding-right: 10px; text-align: right;"> <span style="border-bottom: 2px solid #0091ff; color: #666; display: inline-block;
                font-size: 12px; height: 38px; line-height: 42px;">اطلاعات کاربری </span> </div>
                <br />
                <table cellpadding="0" cellspacing="0" style="width: 850px; margin: 0 auto; font-size: 12px;">
                <tr>
                <td><table cellpadding="0" cellspacing="0" style="width: 800px">
                <tr style="height: 40px">
                
                <td style="width: 80px; font-size:10px" > نام کاربری : </td>
                <form method="post" action="">
                
                <td style="width: 200px"><input name="username" type="text" id="username" style="text-align: center" />
                </td>
                <td style="width: 80px ; font-size:10px"> رمز عبور : </td>
                <td style="width: 200px"><input  type="password" type="password" name="password" type="text" id="password" style="text-align: center" />
                </td>
                <td style="width: 120px ; font-size:10px"> شناسه پیام ها: </td>
                <td><textarea name="messages_id" id="number" style="text-align: center"></textarea>
                </td>
                </tr>
                
                </table>
                </td>
                </tr>
                </table>
                <br />
                <tr>
                <td><table cellpadding="0" cellspacing="0" style="width: 621px">
                <tr style="height: 40px">
                <td style="width: 120px"> شماره های لیست سفید : </td>
                <td><span id="Label1" class="label-testing" style="color:#A0A0A0;">
                <?php '.$crdt.' ?>
                </span> </td>
                </tr>
                <tr>
                <td class="style6"></td>
                <td class="style2"><input type="submit" name="get_message_status" value="دریافت میزان اعتبار" id="Button1" style="background-color: #dbecf6;                       border:2px solid #79b7e8; border-radius: 5px; color: #1d5987; cursor: pointer; float: none; font: 12px Tahoma;
                padding-bottom: 3px; padding-top: 3px; text-align: center;" />
                <form method="post" action="">
                </form></td>
                </tr>
                </table></td>
                </div>
                <br />
                <?php
                if (isset($_POST['get_message_status']) && $_POST["username"]  && $_POST["password"] && $_POST["messages_id"] )
                {
                  $username=$_POST["username"];
                  $password= $_POST["password"];
                  $messages_id = explode("<br />",nl2br($_POST['message_ids']));
                  
                  $crdt=CorrespondingMessageStatus($username,$password,$messages_id);
                  print_r($crdt);
                  ?>
                  
                  <?php
                }
                else{
                  ?>
                  <script>
                  document.getElementById("Label1").innerHTML = "لطفا تمامی اطلاعات را تکمیل نمایید";
                  </script>
                  <?php
                }
                ?>
                
                
                
                <!--///////////////////////////////////// تعرفه پیامک -->
                <i style="color:blue;font-size:30px;font-family:calibri;float: right;">
                تعرفه پیامک ها </i>
                <br>
                <hr>
                <br>
                
                <!-- <div style="width: 900px; height: 20px; margin: 0 auto;"> </div> -->
                <div style="width: 900px; margin: 0 auto; font-family: Tahoma; background-clip: padding-box;
                background-color: #fff; border-radius: 4px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
                overflow: hidden; font-size: 10px;">
                <div style="background-color: #f5f5f5; width: 100%; border-bottom: 2px solid #ebebeb;
                height: 38px; padding-right: 10px; text-align: right;"> <span style="border-bottom: 2px solid #0091ff; color: #666; display: inline-block;
                font-size: 12px; height: 38px; line-height: 42px;">اطلاعات کاربری </span> </div>
                <br />
                <table cellpadding="0" cellspacing="0" style="width: 850px; margin: 0 auto; font-size: 12px;">
                <tr>
                <td><table cellpadding="0" cellspacing="0" style="width: 800px">
                <tr style="height: 40px">
                
                <td style="width: 80px; font-size:10px" > نام کاربری : </td>
                <form method="post" action="">
                
                <td style="width: 200px"><input name="username" type="text" id="username" style="text-align: center" />
                </td>
                <td style="width: 80px ; font-size:10px"> رمز عبور : </td>
                <td style="width: 200px"><input  type="password" type="password" name="password" type="text" id="password" style="text-align: center" />
                </td>
                </tr>
                
                </table>
                </tr>
                </table>
                <br />
                <tr>
                <td><table cellpadding="0" cellspacing="0" style="width: 621px">
                <tr style="height: 40px">
                <td style="width: 120px"> تعرفه پیامک ها : </td>
                <td><span id="lblprices" class="label-testing" style="color:#A0A0A0;">
                <?php '.$crdt.' ?>
                </span> </td>
                </tr>
                <tr>
                <td class="style6"></td>
                <td class="style2"><input type="submit" name="get_prices" value="دریافت میزان اعتبار" id="Button1" style="background-color: #dbecf6;                       border:2px solid #79b7e8; border-radius: 5px; color: #1d5987; cursor: pointer; float: none; font: 12px Tahoma;
                padding-bottom: 3px; padding-top: 3px; text-align: center;" />
                <form method="post" action="">
                </form></td>
                </tr>
                </table></td>
                </div>
                <br />
                <?php
                if (isset($_POST['get_prices']) && $_POST["username"]  && $_POST["password"]  )
                {
                  $username=$_POST["username"];
                  $password= $_POST["password"];
                  $prices=Get_Prices($username,$password);
                  ?>
                  <script>
                  var qu = 'تعرفه پیامک فارسی: '+ "<?php echo($prices->Fa_Price) ?>" +' -- تعرفه پیامک لاتین: '+ "<?php echo($prices->En_Price) ?>";
                  document.getElementById("lblprices").innerHTML = this.qu ;
                  qu.style.color = "red"; 
                  </script>
                  <?php
                }
                else{
                  ?>
                  <script>
                  document.getElementById("lblprices").innerHTML = "لطفا تمامی اطلاعات را تکمیل نمایید";
                  </script>
                  <?php
                }
                ?>
                
                
                <!-- //////////////////////////////////////////////جهت ارسال پیام///////////////////////////////////////////////////////////////////////////////////////// -->
                <br>
                <br>
                <br>
                
                <i style="color:blue;font-size:30px;font-family:calibri;float: right;">
                ارسال پیام </i> 
                <br>
                <hr>
                <br>
                
                <div style="width: 900px; margin: 0 auto; font-family: Tahoma; background-clip: padding-box;
                background-color: #fff; border-radius: 4px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
                overflow: hidden; font-size: 10px;">
                <div style="background-color: #f5f5f5; width: 100%; border-bottom: 2px solid #ebebeb;
                height: 38px; padding-right: 10px; text-align: right;"> <span style="border-bottom: 2px solid #0091ff; color: #666; display: inline-block;
                font-size: 12px; height: 38px; line-height: 42px;">ارسال پیامک </span> </div>
                <br />
                <table cellpadding="0" cellspacing="0" style="width: 850px; margin: 0 auto; font-size: 12px;">
                <tr>
                <td><table cellpadding="0" cellspacing="0" style="width: 800px">
                <tr style="height: 40px"> </tr>
                <td style="width: 80px; font-size:10px" > نام کاربری : </td>
                <form method="post" action="">
                <td style="width: 200px"><input name="username" type="text" id="username" style="text-align: center"/>
                </td>
                </tr>
                <td style="width: 80px ; font-size:10px"> رمز عبور : </td>
                <td style="width: 200px"><input  type="password" type="password" name="password" type="text" id="password" style="text-align: center" />
                </td>
                </tr>
                <td style="width: 120px ; font-size:10px"> شماره اختصاصی: </td>
                <td><input name="number" type="text" id="number" style="text-align: center" />
                </td>
                </tr>
                <td style="width: 120px ; font-size:10px"> شماره گیرنده: </td>
                <td><input name="mobile" type="text" id="mobile" style="text-align: center" />
                </td>
                </tr>
                <td style="width: 120px ; font-size:10px"> متن پیام: </td>
                <td><input name="matnepayam" type="text" id="matnepayam" style="text-align: center" />
                </td>
                </tr>
                <td style="width: 120px ; font-size:10px"> شناسه پیام ارسالی: </td>
                <td><input name="usergroupid" type="text" id="usergroupid" style="text-align: center" />
                </td>
                </tr>
                <td style="width: 120px ; font-size:10px"> زمان ارسال پیام: </td>
                <td><input name="dodate" type="text" id="dodate" style="text-align: center" />
                </td>
                </tr>
                </table>
                <ul>
                <li style="color: Red;">در صورتی که شماره اختصاصی شما با 3000 شروع می شود 98 را به ابتدای
                آن اضافه نمایید </li>
                </ul>
                <ul>
                <li style="color: Red;">اگر تمایل به ارسال پیام آنی دارید لطفا مقدار زمان ارسال را خالی بگذارید </li>
                </ul>
                <ul>
                <li style="color: Red;">در صورت ارسال پیام زمانبندی لطفا تاریخ را مشابه (1395/03/11 15:45:36)قرار دهید. </li>
                </ul>
                <ul>
                <li style="color: Red;">مقدار برگشتی  ( شناسه پیام ) از این متد را برای دریافت وضعیت ذخیره نمایید </li>
                </ul></td>
                </tr>
                </table>
                <br />
                <tr>
                <td><table cellpadding="0" cellspacing="0" style="width: 621px">
                <tr style="height: 40px">
                <td style="width: 120px"> ارسال پیام : </td>
                <td><span id="lblsendresult" class="sendmess" style="color:#A0A0A0;">
                <?php '.$sendmsg.' ?>
                </span> </td>
                </tr>
                <tr>
                <td class="style6"></td>
                <td class="style2"><input type="submit" name="send_msg" value="ارسال پیام" id="Button1" style="background-color: #dbecf6;border:2px solid #79b7e8; border-radius: 5px; color: #1d5987; cursor: pointer; float: none; font: 12px Tahoma;
                padding-bottom: 3px; padding-top: 3px; text-align: center;" />
                </form>
                </td>
                </tr>
                </table></td>
                </div>
                <br />
                
                <?php
                if (isset($_POST['send_msg']) && $_POST["username"]  && $_POST["password"] && $_POST["number"] && $_POST["matnepayam"] && $_POST["usergroupid"] &&  $_POST["mobile"])
                {
                  $username=$_POST["username"];
                  $password= $_POST["password"];
                  $number= $_POST["number"];
                  $message=$_POST["matnepayam"];
                  $mobile=$_POST["mobile"];
                  
                  
                  $result=Send_Message($username,$password,$number,$message,explode(",",$mobile));
                  $sendmsg=$result->Message;
                  ?>
                  <script>
                  var qu = "<?php echo $sendmsg; ?>";
                  document.getElementById("lblsendresult").innerHTML =this.qu ;
                  qu.style.color = "red"; 
                  </script>
                  <?php
                }
                
                else{
                  ?>
                  <script>
                  document.getElementById("Label2").innerHTML = "لطفا تمامی اطلاعات را تکمیل نمایید";
                  </script>
                  <?php
                }
                ?>
                
                
                <!-- ////////////////////////جهت ارسال پیام متناظر///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                
                
                <i style="color:blue;font-size:30px;font-family:calibri;float: right;">
                ارسال پیام متناظر </i>
                <br>
                <hr>
                <br>
                
                
                <div style="width: 900px; margin: 0 auto; font-family: Tahoma; background-clip: padding-box;
                background-color: #fff; border-radius: 4px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
                overflow: hidden; font-size: 10px;">
                <div style="background-color: #f5f5f5; width: 100%; border-bottom: 2px solid #ebebeb;
                height: 38px; padding-right: 10px; text-align: right;"> <span style="border-bottom: 2px solid #0091ff; color: #666; display: inline-block;
                font-size: 12px; height: 38px; line-height: 42px;">ارسال پیامک </span> </div>
                <br />
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <table>
                <tr>
                <td> نام کاربری: </td>
                <td><input type="text" name="username">
                </td>
                </tr>
                <tr>
                <td> رمز عبور: </td>
                <td><input  type="password" type="text" name="password"  >
                </td>
                </tr>
                <tr>
                <td> شماره اختصاصی: </td>
                <td><input type="text" name="number" >
                </td>
                </tr>
                
                <tr>
                <td>گیرندگان:</td>
                <td><textarea name="nums" rows="20" cols="50"></textarea>
                </td>
                </tr>
                <tr>
                <td>متن ها: </td>
                <td><textarea name="txts" rows="20" cols="50"></textarea>
                </td>
                </tr>
                </table>
                <ul>
                <li style="color: Red;">در صورتی که شماره اختصاصی شما با 3000 شروع می شود 98 را به ابتدای
                آن اضافه نمایید </li>
                </ul>
                <ul>
                <li style="color: Red;">در قسمت گیرنده و متن هر ENTER بعنوان یک جداکننده میباشد </li>
                </ul>
                <ul>
                <li style="color: Red;">مقدار برگشتی  ( شناسه پیام ) از این متد را برای دریافت وضعیت ذخیره نمایید </li>
                </ul>
                </tr>
                <br />
                <tr>
                <td>
                <table cellpadding="0" cellspacing="0" style="width: 621px">
                <tr style="height: 40px">
                <td style="width: 120px">
                ارسال پیام :
                </td>
                <td>
                <span id="Label3" class="send_motenaz" style="color:#A0A0A0;"><?php '.$smotenazer.' ?> </span>
                </td>
                </tr>
                <tr>
                <td class="style6">
                </td>
                <td class="style2">
                <input type="submit" name="send_motenazer"  value="ارسال پیام"  
                style="background-color: #dbecf6;    border:2px solid #79b7e8; border-radius: 5px; color: #1d5987; cursor: pointer; 
                float: none; font: 12px Tahoma;  padding-bottom: 3px; padding-top: 3px; text-align: center;"/>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </form>
                </div>
                <br/>   
                
                <?php
                if	(isset($_POST['send_motenazer']) &&  $_POST["username"]  && $_POST["password"] && $_POST["number"])
                {
                  $username=$_POST["username"];
                  $password= $_POST["password"];
                  $number=  $_POST["number"];
                  $message = '';
                  $mobile='';
                  
                  
                  
                  $nums = explode("<br />",nl2br($_POST['nums']));
                  $text = explode("<br />",nl2br($_POST['txts']));
                  
                  $RecipientsMessage=array();
                  for	($i=0;$i<count($nums);$i++)
                  {
                    $object = new stdClass();
                    $object->Id = $i;
                    $object->Message=$text[$i];
                    $object->Mobile=$nums[$i];
                    array_push($RecipientsMessage,$object);
                  }
                  
                  $result= SendCorrespondingMessage($username,$password,$number,$RecipientsMessage);
                  
                  ?>
                  <script>
                  var qu = "<?php echo $smotenazer; ?>";
                  document.getElementById("Label3").innerHTML ="<?php echo $result->Message ?>" ;
                  qu.style.color = "red"; 
                  </script>
                  <?php
                }
                
                else{
                  ?>
                  <script>
                  document.getElementById("Label3").innerHTML = "لطفا تمامی اطلاعات را تکمیل نمایید";
                  </script>
                  <?php
                }	
                ?>
                
                
                
                <!-- ////////////////////////ارسال پیام به پورت خاص///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                
                
                <i style="color:blue;font-size:30px;font-family:calibri;float: right;">
                ارسال پیام به پورت خاص </i>
                <br>
                <hr>
                <br>
                
                
                <div style="width: 900px; margin: 0 auto; font-family: Tahoma; background-clip: padding-box;
                background-color: #fff; border-radius: 4px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
                overflow: hidden; font-size: 10px;">
                <div style="background-color: #f5f5f5; width: 100%; border-bottom: 2px solid #ebebeb;
                height: 38px; padding-right: 10px; text-align: right;"> <span style="border-bottom: 2px solid #0091ff; color: #666; display: inline-block;
                font-size: 12px; height: 38px; line-height: 42px;">ارسال پیامک </span> </div>
                <br />
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <table>
                <tr>
                <td> نام کاربری: </td>
                <td><input type="text" name="username">
                </td>
                </tr>
                <tr>
                <td> رمز عبور: </td>
                <td><input  type="password" type="text" name="password"  >
                </td>
                </tr>
                <tr>
                <td> شماره اختصاصی: </td>
                <td><input type="text" name="number" >
                </td>
                </tr>
                
                
                <tr>
                <td>شماره پورت ارسال پیام: </td>
                <td><input type="text" name="sendport" rows="20" cols="50"></textarea>
                </td>
                </tr>   
                
                <tr>
                <td>شماره پورت دریافت پیام: </td>
                <td><input type="text" name="reciveport" rows="20" cols="50"></textarea>
                </td>
                </tr> 
                
                <tr>
                <td>گیرندگان:</td>
                <td><textarea name="nums" rows="20" cols="50"></textarea>
                </td>
                </tr>
                <tr>
                <td>متن ها: </td>
                <td><textarea name="txts" rows="20" cols="50"></textarea>
                </td>
                </tr>
                
                
                
                </table>
                <ul>
                <li style="color: Red;">در صورتی که شماره اختصاصی شما با 3000 شروع می شود 98 را به ابتدای
                آن اضافه نمایید </li>
                </ul>
                <ul>
                <li style="color: Red;">در قسمت گیرنده و متن هر ENTER بعنوان یک جداکننده میباشد </li>
                </ul>
                <ul>
                <li style="color: Red;">مقدار برگشتی  ( شناسه پیام ) از این متد را برای دریافت وضعیت ذخیره نمایید </li>
                </ul>
                </tr>
                <br />
                <tr>
                <td>
                <table cellpadding="0" cellspacing="0" style="width: 621px">
                <tr style="height: 40px">
                <td style="width: 120px">
                ارسال پیام :
                </td>
                <td>
                <span id="Label3" class="send_motenaz" style="color:#A0A0A0;"><?php '.$smotenazer.' ?> </span>
                </td>
                </tr>
                <tr>
                <td class="style6">
                </td>
                <td class="style2">
                <input type="submit" name="send_to_port"  value="ارسال پیام"  
                style="background-color: #dbecf6;    border:2px solid #79b7e8; border-radius: 5px; color: #1d5987; cursor: pointer; 
                float: none; font: 12px Tahoma;  padding-bottom: 3px; padding-top: 3px; text-align: center;"/>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </form>
                </div>
                <br/>   
                
                <?php
                if	(isset($_POST['send_to_port']) &&  $_POST["username"]  && $_POST["password"] && $_POST["number"]&& $_POST["sendport"]&& $_POST["reciveport"])
                {
                  $username=$_POST["username"];
                  $password= $_POST["password"];
                  $number=  $_POST["number"];
                  $send_port_number=$_POST["sendport"];
                  $recive_port_number=$_POST["reciveport"];
                  $message = '';
                  $mobile='';
                  
                  
                  
                  $nums = explode("<br />",nl2br($_POST['nums']));
                  $text = explode("<br />",nl2br($_POST['txts']));
                  
                  $RecipientsMessage=array();
                  for	($i=0;$i<count($nums);$i++)
                  {
                    $object = new stdClass();
                    $object->Id = $i;
                    $object->Message=$text[$i];
                    $object->Mobile=$nums[$i];
                    array_push($RecipientsMessage,$object);
                  }
                  
                  $result= SendMessageToPort($username,$password,$number,$send_port_number,$recive_port_number,$RecipientsMessage);
                  print_r($result);
                  ?>
                  <script>
                  var qu = "<?php echo $smotenazer; ?>";
                  document.getElementById("Label3").innerHTML ="<?php echo $result->Message ?>" ;
                  qu.style.color = "red"; 
                  </script>
                  <?php
                }
                
                else{
                  ?>
                  <script>
                  document.getElementById("Label3").innerHTML = "لطفا تمامی اطلاعات را تکمیل نمایید";
                  </script>
                  <?php
                }	
                ?>
                
                
                <!-- ////////////////////////////////////////////////دریافت پیام  -->
                
                
                <i style="color:blue;font-size:30px;font-family:calibri;float: right;">
                دریافت پیام ها </i>
                <br>
                <hr>
                <br>
                
                
                <div style="width: 900px; margin: 0 auto; font-family: Tahoma; background-clip: padding-box;
                background-color: #fff; border-radius: 4px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
                overflow: hidden; font-size: 10px;">
                <div style="background-color: #f5f5f5; width: 100%; border-bottom: 2px solid #ebebeb;
                height: 38px; padding-right: 10px; text-align: right;"> <span style="border-bottom: 2px solid #0091ff; color: #666; display: inline-block;
                font-size: 12px; height: 38px; line-height: 42px;">ارسال پیامک </span> </div>
                <br />
                <form action="" method="post">
                <table>
                <tr>
                <td> نام کاربری: </td>
                <td><input type="text" name="username">
                </td>
                </tr>
                <tr>
                <td> رمز عبور: </td>
                <td><input  type="password" name="password"  >
                </td>
                </tr>
                <tr>
                <td> شماره اختصاصی: </td>
                <td><input type="text" name="number" >
                </td>
                </tr>
                
                <tr>
                <td> از تاریخ: </td>
                <td><input type="text" name="fromdate" >  مثال: 2017-05-06 21:26:30
                </td>
                </tr>
                
                <tr>
                <td> تا تاریخ: </td>
                <td><input type="text" name="todate" > مثال: 2017-05-06 21:26:30
                </td>
                </tr>
                
                <tr>
                <td> شماره صفحه: </td>
                <td><input type="text" name="pagenumber" >
                </td>
                </tr>
                
                
                </table>
                
                </tr>
                <br />
                <tr>
                <td>
                <table cellpadding="0" cellspacing="0" style="width: 621px">
                <tr style="height: 40px">
                <td style="width: 120px">
                پیام های دریافتی :
                </td>
                <td>
                </td>
                </tr>
                <tr>
                <td class="style6">
                </td>
                <td class="style2">
                <input type="submit" name="receive_message"  value="دریافت پیام ها"  
                style="background-color: #dbecf6;    border:2px solid #79b7e8; border-radius: 5px; color: #1d5987; cursor: pointer; 
                float: none; font: 12px Tahoma;  padding-bottom: 3px; padding-top: 3px; text-align: center;"/>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </form>
                </div>
                <br/>   
                
                <?php
                if	(isset($_POST['receive_message']) &&  $_POST["username"]  && $_POST["password"] && $_POST["number"] && $_POST["fromdate"] && $_POST["todate"] && isset($_POST["pagenumber"]))
                {
                  $username=$_POST["username"];
                  $password= $_POST["password"];
                  $number=  $_POST["number"];
                  $from_date=$_POST["fromdate"];
                  $to_date=$_POST["todate"];
                  $page_number=$_POST["pagenumber"];
                  
                  $result= ReceiveMessages($username,$password,$number,$from_date,$to_date,$page_number);
                  print_r($result);
                  
                  ?>
                  <script>
                  var qu = "<?php echo $smotenazer; ?>";
                  document.getElementById("Label3").innerHTML ="<?php echo $result->Message ?>" ;
                  qu.style.color = "red"; 
                  </script>
                  <?php
                }
                
                else{
                  ?>
                  <script>
                  document.getElementById("Label3").innerHTML = "لطفا تمامی اطلاعات را تکمیل نمایید";
                  </script>
                  <?php
                }	
                ?>
                
                
                <!-- //////////////////////////////////////////////// دریافت شناسه پیام گروهی  -->
                
                
                <i style="color:blue;font-size:30px;font-family:calibri;float: right;">
                دریافت شناسه پیام گروهی </i>
                <br>
                <hr>
                <br>
                
                
                <div style="width: 900px; margin: 0 auto; font-family: Tahoma; background-clip: padding-box;
                background-color: #fff; border-radius: 4px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
                overflow: hidden; font-size: 10px;">
                <div style="background-color: #f5f5f5; width: 100%; border-bottom: 2px solid #ebebeb;
                height: 38px; padding-right: 10px; text-align: right;"> <span style="border-bottom: 2px solid #0091ff; color: #666; display: inline-block;
                font-size: 12px; height: 38px; line-height: 42px;">ارسال پیامک </span> </div>
                <br />
                <form action="" method="post">
                <table>
                <tr>
                <td> نام کاربری: </td>
                <td><input type="text" name="username">
                </td>
                </tr>
                <tr>
                <td> رمز عبور: </td>
                <td><input  type="password" name="password"  >
                </td>
                </tr>
                
                <tr>
                <td> شناسه گروه : </td>
                <td><input  type="groupid" name="password"  >
                </td>
                </tr>
                
                </table>
                
                </tr>
                <br />
                <tr>
                <td>
                <table cellpadding="0" cellspacing="0" style="width: 621px">
                <tr style="height: 40px">
                <td style="width: 120px">
                شناسه پیام :
                </td>
                <td>
                </td>
                </tr>
                <tr>
                <td class="style6">
                </td>
                <td class="style2">
                <input type="submit" name="receive_message"  value="دریافت شناسه پیام گروهی"  
                style="background-color: #dbecf6;    border:2px solid #79b7e8; border-radius: 5px; color: #1d5987; cursor: pointer; 
                float: none; font: 12px Tahoma;  padding-bottom: 3px; padding-top: 3px; text-align: center;"/>
                </td>
                </tr>
                </table>
                </td>
                </tr>
                </form>
                </div>
                <br/>   
                
                <?php
                if	(isset($_POST['receive_message']) &&  $_POST["username"]&&  $_POST["groupid"])
                {
                  $username=$_POST["username"];
                  $password= $_POST["password"];
                  $groupid=$_POST["groupid"];
                  
                  $result= GetGroupMessageId($username,$password,$groupid);
                  print_r($result);
                  
                  ?>
                  <script>
                  var qu = "<?php echo $smotenazer; ?>";
                  document.getElementById("Label3").innerHTML ="<?php echo $result->Message ?>" ;
                  qu.style.color = "red"; 
                  </script>
                  <?php
                }
                
                else{
                  ?>
                  <script>
                  document.getElementById("Label3").innerHTML = "لطفا تمامی اطلاعات را تکمیل نمایید";
                  </script>
                  <?php
                }	
                ?>
                
                
                <!-- ////////////////////////////////////////////////دریافت وضعیت  -->
                <i style="color:blue;font-size:30px;font-family:calibri;float: right;">
                وضعیت پیام </i> 
                <br>
                <hr>
                <br>
                
                
                <div style="width: 900px; margin: 0 auto; font-family: Tahoma; background-clip: padding-box;
                background-color: #fff; border-radius: 4px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
                overflow: hidden; font-size: 10px;">
                <div style="background-color: #f5f5f5; width: 100%; border-bottom: 2px solid #ebebeb;
                height: 38px; padding-right: 10px; text-align: right;">
                <span style="border-bottom: 2px solid #0091ff; color: #666; display: inline-block;
                font-size: 12px; height: 38px; line-height: 42px;">وضعیت پیام </span>
                </div>
                <br />
                <table cellpadding="0" cellspacing="0" style="width: 850px; margin: 0 auto; font-size: 12px;">
                <tr>
                <td>
                <table cellpadding="0" cellspacing="0" style="width: 800px">
                <tr style="height: 40px">
                </tr>
                <td style="width: 80px; font-size:10px" >
                نام کاربری :
                </td>
                <form method="post" action="">
                <td style="width: 200px">
                <input name="username" type="text" id="username" style="text-align: center" />
                </td>
                </tr>
                <td style="width: 80px ; font-size:10px">
                رمز عبور :
                </td>
                <td style="width: 200px">
                <input  type="password" name="password" type="text" id="password" style="text-align: center" />
                </td>
                </tr>
                <td style="width: 120px ; font-size:10px">
                شماره اختصاصی:
                </td>
                <td>
                <input name="number" type="text" id="number" style="text-align: center" />
                </td>
                </tr>
                <td style="width: 120px ; font-size:10px">
                شناسه پیام:
                </td>
                <td>
                <input name="usergroupid" type="text" id="usergroupid" style="text-align: center" />
                </td>
                </tr>
                <td style="width: 120px ; font-size:10px">
                شماره موبایل:
                </td>
                <td>
                <input name="mobile" type="text" id="mobile" style="text-align: center" />
                </td>
                
                </table>
                <ul>
                <li style="color: Red;">در صورتی که شماره اختصاصی شما با 3000 شروع می شود 98 را به ابتدای
                آن اضافه نمایید </li>
                </ul>
                </td>
                </tr>
                </table>
                <br />
                <tr>
                <td>
                <table cellpadding="0" cellspacing="0" style="width: 621px">
                <tr style="height: 40px">
                <td style="width: 120px">
                وضعیت پیام :
                </td>
                <td>
                <span id="Label4" class="label-testing" style="color:#A0A0A0;"><?php '.$getstatus.' ?></span>
                </td>
                </tr>
                
                
                <tr>
                <td class="style6">
                </td>
                <td class="style2">
                <input type="submit" name="get_status" value="دریافت وضعیت پیام" id="Button1" style="background-color: #dbecf6;                       border:2px solid #79b7e8; border-radius: 5px; color: #1d5987; cursor: pointer; float: none; font: 12px Tahoma;
                padding-bottom: 3px; padding-top: 3px; text-align: center;" />
                </form>
                <form method="post" action="">
                </form>
                </td>
                </tr>
                </table>
                </td>
                
                </div>
                <br />
                
                <?php
                
                if (isset($_POST['get_status']) && $_POST["usergroupid"] && $_POST["username"]  && $_POST["password"] && $_POST["number"] && $_POST["mobile"])
                {
                  $client = new soapclient('http://sms.trez.ir/XmlForSMS.asmx?WSDL');
                  $username=$_POST["username"];
                  $password= $_POST["password"];
                  $number= $_POST["number"];
                  $mobile=$_POST["mobile"];
                  $action='status';
                  $type='0';
                  $status='';
                  $usergroupid= $_POST["usergroupid"];
                  
                  
                  $xmlreq='<?xml version="1.0" encoding="UTF-8"?>
                  <xmlrequest>
                  
                  <username>'.$username.'</username>
                  <password>'.$password.'</password>
                  <number>'.$number.'</number>
                  <action>'.$action.'</action>
                  <type>'.$type.'</type>
                  <usergroupid>'.$usergroupid.'</usergroupid>
                  <body status="1">
                  <recipient mobile="'.$mobile.'">"'.$status.'"</recipient>
                  </body>
                  </xmlrequest>';
                  
                  $xmlres=$client->getxml(array('xmlString'=>$xmlreq));
                  $xml=simplexml_load_string($xmlres->getxmlResult);
                  $getstatus=$xml->body->recipient;
                  ?>
                  
                  <script>
                  var qu = "<?php echo $getstatus; ?>";
                  document.getElementById("Label4").innerHTML = this.qu ; 
                  </script>
                  
                  <?php
                }
                else{
                  ?>
                  
                  <script>
                  document.getElementById("Label4").innerHTML = "لطفا تمامی اطلاعات را تکمیل نمایید";
                  </script>
                  
                  <?php
                }
                /////////////////////////////////////////FOOOOTER/////////////////////////////////////////////////////////////////////////////////////////////////////
                ?>
                <div id="footer" style="color:#00CCFF" align="center">
                <p> <span style="color: #663333">&copy; 2018</span> <a href="/index.aspx" target="_blank"><strong>WWW.TREZ.IR</strong></a> | <span style="color:       #660099"><span style="color: #993333">Design by:</span> </span><strong><a target="_blank" href="http://trez.ir">Aida Tadayyon</a></strong> </p>
                </div>
                </html>
                