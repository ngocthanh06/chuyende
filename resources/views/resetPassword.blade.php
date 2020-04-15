<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
  <meta content="width=device-width" name="viewport">
  <title>Yêu cầu lấy lại mật khẩu</title>
    <style type="text/css">
       @font-face {
       font-family: &#x27;Postmates Std&#x27;;
       font-weight: 600;
       font-style: normal;
       src: local(&#x27;Postmates Std Bold&#x27;), url(https://s3-us-west-1.amazonaws.com/buyer-static.postmates.com/assets/email/postmates-std-bold.woff) format(&#x27;woff&#x27;);
       }
       @font-face {
       font-family: &#x27;Postmates Std&#x27;;
       font-weight: 500;
       font-style: normal;
       src: local(&#x27;Postmates Std Medium&#x27;), url(https://s3-us-west-1.amazonaws.com/buyer-static.postmates.com/assets/email/postmates-std-medium.woff) format(&#x27;woff&#x27;);
       }
       @font-face {
       font-family: &#x27;Postmates Std&#x27;;
       font-weight: 400;
       font-style: normal;
       src: local(&#x27;Postmates Std Regular&#x27;), url(https://s3-us-west-1.amazonaws.com/buyer-static.postmates.com/assets/email/postmates-std-regular.woff) format(&#x27;woff&#x27;);
       }
    </style>
    <style media="screen and (max-width: 680px)">
       @media screen and (max-width: 680px) {
       .page-center {
         padding-left: 0 !important;
         padding-right: 0 !important;
       }
         .footer-center {
            padding-left: 20px !important;
            padding-right: 20px !important;
         }
       }
    </style>
</head>
<body>
 <body style="background-color: #f4f4f5; padding-top: 40px">
    <table cellpadding="0" cellspacing="0" style="width: 100%; height: 100%; background-color: #f4f4f5; text-align: center;">
       <tbody>
          <tr>
             <td style="text-align: center;">
                <table align="center" cellpadding="0" cellspacing="0" id="body" style="background-color: #fff; width: 100%; max-width: 680px; height: 100%;">
                   <tbody>
                      <tr>
                         <td>
                            <table align="center" cellpadding="0" cellspacing="0" class="page-center" style="text-align: left; padding-bottom: 88px; width: 100%; padding-left: 120px; padding-right: 120px;">
                               <tbody>
                                  <tr>
                                     <td style="padding-top: 24px;">
                                        <img src="https://d1pgqke3goo8l6.cloudfront.net/wRMe5oiRRqYamUFBvXEw_logo.png" style="width: 56px;">
                                     </td>
                                  </tr>
                                  <tr>
                                     <td colspan="2" style="padding-top: 72px; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #000000; font-family: 'Postmates Std', 'Helvetica', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 48px; font-smoothing: always; font-style: normal; font-weight: 600; letter-spacing: -2.6px; line-height: 52px; mso-line-height-rule: exactly; text-decoration: none;">Yêu cầu đặt lại mật khẩu</td>
                                  </tr>
                                  <tr>
                                     <td style="padding-top: 48px; padding-bottom: 48px;">
                                        <table cellpadding="0" cellspacing="0" style="width: 100%">
                                           <tbody>
                                              <tr>
                                                 <td style="width: 100%; height: 1px; max-height: 1px; background-color: #d9dbe0; opacity: 0.81"></td>
                                              </tr>
                                           </tbody>
                                        </table>
                                     </td>
                                  </tr>
                                  <tr>
                                     <td style="-ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #9095a2; font-family: 'Postmates Std', 'Helvetica', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 16px; font-smoothing: always; font-style: normal; font-weight: 400; letter-spacing: -0.18px; line-height: 24px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 100%;">
                                        Bạn nhận được e-mail này bởi vì bạn yêu cầu một thiết lập lại mật khẩu cho tài khoản của bạn. 
                                     </td>
                                  </tr>
                                  <tr>
                                     <td style="padding-top: 24px; -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #9095a2; font-family: 'Postmates Std', 'Helvetica', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 16px; font-smoothing: always; font-style: normal; font-weight: 400; letter-spacing: -0.18px; line-height: 24px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 100%;">
                                        {{-- Vui lòng nhập mã token xác nhận mật khẩu mới : <b>{{$token ?? ''}}</b> --}}
                                     <a href="{{asset("password_change/".$token)}}" style="text-decoration: none; color: #fff; display: inline-block; font-weight: 400;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;background-color: #007bff;border: 1px solid transparent; padding: .375rem .75rem;font-size: 1rem; line-height: 1.5; border-radius: .25rem; transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;" >
                                       Reset mật khẩu</a>
                                     </td>
                                    </tr>
                                  <tr>
                                     <td style="padding: 30px 0">
                                        <a style="ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #9095a2; font-family: 'Postmates Std', 'Helvetica', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 16px; font-smoothing: always; font-style: normal; font-weight: 400; letter-spacing: -0.18px; line-height: 24px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 100%;">
                                        Cảm ơn !
                                        </a>
                                     </td>
                                  </tr>
                               </tbody>
                            </table>
                         </td>
                      </tr>
                   </tbody>
                </table>
                <table align="center" cellpadding="0" cellspacing="0" id="footer" style="background-color: #000; width: 100%; max-width: 680px; height: 100%;">
                   <tbody>
                      <tr>
                         <td>
                            <table align="center" cellpadding="0" cellspacing="0" class="footer-center" style="text-align: left; width: 100%; padding-left: 120px; padding-right: 120px;">
                               <tbody>
                                  <tr>
                                     <td colspan="2" style="padding-top: 24px; padding-bottom: 24px; width: 100%;">
                                        <h2 style="color:#fff">NgocThanh06</h2>
                                     </td>
                                  </tr>
                                  <tr>
                                     <td colspan="2" style="padding-top: 24px; padding-bottom: 48px;">
                                        <table cellpadding="0" cellspacing="0" style="width: 100%">
                                           <tbody>
                                              <tr>
                                                 <td style="width: 100%; height: 1px; max-height: 1px; background-color: #EAECF2; opacity: 0.19"></td>
                                              </tr>
                                           </tbody>
                                        </table>
                                     </td>
                                  </tr>
                                  <tr>
                                     <td style="-ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #9095A2; font-family: 'Postmates Std', 'Helvetica', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif; font-size: 15px; font-smoothing: always; font-style: normal; font-weight: 400; letter-spacing: 0; line-height: 24px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 100%;">
                                        If you have any questions or concerns, we're here to help. Contact us via our <a data-click-track-id="1053" href="#" style="font-weight: 500; color: #ffffff" target="_blank">Help Center</a>.
                                     </td>
                                  </tr>
                                  <tr>
                                     <td style="height: 72px;"></td>
                                  </tr>
                               </tbody>
                            </table>
                         </td>
                      </tr>
                   </tbody>
                </table>
             </td>
          </tr>
       </tbody>
    </table>
 </body>
</body>
</html>