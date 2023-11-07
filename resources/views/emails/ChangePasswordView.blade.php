<!DOCTYPE html>
<html>

<head>
    <title>Welcome!, Mr/Mrs: {{ $email }}</title>
</head>

<body>
    <table style="width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border-collapse: collapse; ">
        <tr>
            <td style="text-align: center; background-color: green; padding: 20px;">
                @if ($profile->gender === 'Male')
                    <h1>Welcome!, Mr: {{ $profile->name }}!</h1>
                @else
                    <h1>Welcome!, Mrs: {{ $profile->name }}!</h1>
                @endif
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p>Hello {{ $profile->user->email }},</p>
                <p>Welcome to Can-avid National High School, We're excited to have you on board.</p>
                <p>We highly recommend you to change your password!, <br>Throught out the button below:</p>
                <p style="text-align: center;">
                    <a href="{{ route('change-password', ['profile' => $profile]) }}"
                        style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none;">
                        Change Password
                    </a>
                </p>
                <p>Best regards,</p>
                <p>CNHS Department</p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; background-color: #f0f0f0; padding: 20px;">
                <p>&copy; {{ date('Y') }} CNHS. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>

</html>
