<!DOCTYPE html>
<html>
<head>
    <title>Email Sending Example</title>
</head>
<body>

<button onclick="sendEmail()">Send Email</button>

<script>
    function sendEmail() {
        const sendGridUrl = 'https://api.sendgrid.com/v3/mail/send';
        const apiKey = '9bf0ae94941e353dcb2a9f42065f2590';

        const emailData = {
            personalizations: [
                {
                    to: [{ email: 'kewaltailor345@gmail.com' }],
                    subject: 'Test Email'
                }
            ],
            from: { email: 'kewaltailor999@gmail.com' },
            content: [{ type: 'text/plain', value: 'This is a test email sent using SendGrid API.' }]
        };

        fetch(sendGridUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + apiKey
            },
            body: JSON.stringify(emailData)
        })
        .then(response => {
            if (response.ok) {
                console.log('Email sent successfully.');
            } else {
                console.error('Failed to send email.');
            }
        })
        .catch(error => {
            console.error('Error occurred:', error);
        });
    }
</script>

</body>
</html>
