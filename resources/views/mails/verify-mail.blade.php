<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP</title>
    <style>
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
            }
            .content {
                padding: 20px !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, sans-serif;">
<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="padding: 20px 0;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" class="email-container" align="center">
                <tr>
                    <td style="background-color: #ffffff; border-radius: 4px; overflow: hidden; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="padding: 30px 30px 20px; text-align: center;" class="content">
                                    <h1 style="color: #1E87FA; font-size: 24px; margin: 0; line-height: 30px;">Email Verify!</h1>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0 30px 30px;" class="content">
                                    <p style="color: #333333; font-size: 16px; line-height: 24px; margin: 0 0 20px;">We received a request to verify your e-mail. Use the following One-Time Password (OTP) to complete the process:</p>
                                    <div style="background-color: #f0f7ff; border: 1px solid #1E87FA; border-radius: 4px; padding: 15px; margin-bottom: 20px; text-align: center;">
                                        <p style="color: #1E87FA; font-size: 18px; font-weight: bold; margin: 0;"><span style="font-size: 24px;">{{$otp}}</span></p>
                                    </div>
                                    <p style="color: #333333; font-size: 16px; line-height: 24px; margin: 0 0 20px;">This OTP will expire in <strong>{{$expiration_time}} minutes</strong>.</p>
                                    <p style="color: #333333; font-size: 16px; line-height: 24px; margin: 0;">If you didn't request a email verify, please ignore this email or contact support if you have concerns.</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: #f4f4f4; padding: 20px; text-align: center;" class="content">
                                    <p style="color: #888888; font-size: 14px; margin: 0;">&copy; {{date('Y')}} AURA PURA. All rights reserved.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
