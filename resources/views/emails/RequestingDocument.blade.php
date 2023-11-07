<!DOCTYPE html>
<html>

<head>
    <title>Welcome!, Mr/Ms: {{ $requester }}</title>
</head>

<body>
    <table style="width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border-collapse: collapse; ">
        <tr>
            <td style="text-align: center; background-color: green; padding: 20px;">
                Welcome!, Mr/Ms: {{ $requester }}
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <p>I hope this email finds you well. We appreciate your prompt action in reaching out to us.</p>
                <p>Your document request has been successfully processed, and we are in the final stages of preparing your requested documents.
                    We understand the significance of these documents for your Personal Usage,
                    and we are committed to ensuring a smooth and timely process.</p>
                <p>Here are the details regarding the document pickup:</p>
                <p>Document Pickup Date: {{ $date }}</p>
                <p>On {{ $date }}, your requested documents will be available for pickup at the
                    Can-avid National High School Registrar's Office, located at Barangay 4, Can-avid Eastern Samar.
                    Our office hours are <b>12:00 PM</b>, and you can visit us during this time to collect your documents.
                </p>
                <p>Please make sure to bring a valid photo ID with you for verification purposes when you come to pick up your documents. This is to ensure the security and confidentiality of your records.</p>
                <p>Additionally, we have attached a PDF file to this email that contains a document request confirmation letter. You may print and present this letter to the Registrar's Office at the time of document pickup to expedite the process. This letter will serve as proof of your request and will help streamline the pickup process.</p>
                <p>If you have any questions or need further assistance during this process, please do not hesitate to reach out to our office. You can contact us at [School's Contact Information], and our dedicated staff will be happy to assist you.</p>
                <p>We look forward to seeing you on {{ $date }} at the Registrar's Office. Your documents will be ready for your collection, and we hope this will be a convenient experience for you.</p>
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
