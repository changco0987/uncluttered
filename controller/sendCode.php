<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script type="text/javascript">
        //to send email
        function sendCode(reciever)
        {
            
            Email.send({
                SecureToken : "92421880-7d41-4516-b5ce-fd3066b4416b",
                To : reciever,
                From : "uncluttered.webapp@gmail.com",
                Subject : "Request for reset password",
                Body : "This is your requested reset password code: "+ getCode(11111111, 99999999)
            });
            setTimeout(redirect,2000)
        }

        //To get randomize code
        function getCode(min, max)
        {
            return Math.floor(Math.random() * (max - min + 1) ) + min;
        }

        function redirect()
        {
            window.location = '../index.php';
        }

        sendCode(<?php echo json_encode($_SESSION['email']); ?>, <?php echo json_encode($_SESSION['code']); ?>);
    </script>
</head>
<body>
    
</body>
</html>

