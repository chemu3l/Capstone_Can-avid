<!DOCTYPE html>
<html>

<head>
    <title>Welcome!, Mr/Ms: {{ $email }}</title>
</head>

<body>
    <table style="width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border-collapse: collapse; ">
        <tr>
            <td style="text-align: center; background-color: green; padding: 20px;">
                <h1>Welcome!, Mr/Ms: <span style="color: white;">{{ $email }}</span>!</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p>Hello {{ $email }},</p>
                <p>Welcome to Can-avid National High School, We're excited to have you on board.</p>
                <p>We requested to change your password account, Please make it secure and don't share the password to other!, <br>Throught out the button below:</p>
                <p style="text-align: center;">
                    <a href="{{ route('forget-password', ['email' => $email]) }}"
                        style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none;">
                        Change Password
                    </a>
                </p>
                <p>Best regards,</p>
                <p>The {{ config('app.name') }} Team</p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; background-color: #f0f0f0; padding: 20px;">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>

</html>
