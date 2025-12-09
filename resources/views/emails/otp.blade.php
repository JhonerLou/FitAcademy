<!DOCTYPE html>
<html>
<head>
    <title>Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 20px; border-radius: 8px;">
        <h2 style="color: #10b981;">Welcome to FitAcademy!</h2>
        <p>Please use the following code to verify your account:</p>
        <div style="background: #f3f4f6; padding: 15px; font-size: 24px; font-weight: bold; text-align: center; letter-spacing: 5px; border-radius: 5px; margin: 20px 0;">
            {{ $otp }}
        </div>
        <p>This code will expire in 10 minutes.</p>
        <p>If you didn't request this, please ignore this email.</p>
    </div>
</body>
</html>
