<?php
class EmailConfig {

    public $default = array(
        'transport' => 'Smtp',
        'from' => array('cj.garayhello@gmail.com' => 'CRUDS WEBSITE'),
        'host' => 'smtp.gmail.com', // Replace with your SMTP server
        'port' => 587,  // Adjust the port if needed
        'username' => 'christianjoygaray123@gmail.com',
        'password' => 'rxdc ybhl shvw pjzi', //app password? or gmail account password?
        'tls' => true,
        'timeout' => 30,
        'emailFormat' => 'html',
        'log' => false,
    );

}


// 'transport' => 'Smtp',
// 'from' => array('noreply@yourdomain.com' => 'Your App Name'),
// 'host' => 'smtp.your-email-provider.com',
// 'port' => 587,
// 'username' => 'your-email@yourdomain.com',
// 'password' => 'your-email-password',
// 'timeout' => 30,
// 'emailFormat' => 'html',
// 'log' => false,