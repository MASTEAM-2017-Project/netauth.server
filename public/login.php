<?php
/**
 * RADIUS client example using PAP password.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../private/config.php';

$radius = new \Dapphp\Radius\Radius();
$radius->setServer($radius_ip)         // IP or hostname of RADIUS server
       ->setSecret($radius_secret);     // RADIUS shared secret
//       ->setNasIpAddress('127.0.0.1')  // IP or hostname of NAS (device authenticating user)
//       ->setAttribute(32, 'vpn');      // NAS identifier

// Send access request for a user with username = 'username' and password = 'password!'
$response = $radius->accessRequest($_POST['username'], $_POST['password']);
if ($response === false) {
    // false returned on failure
    echo sprintf("Access-Request failed with error %d (%s).\n",
        $radius->getErrorCode(),
        $radius->getErrorMessage()
    );
} else {
    // access request was accepted - client authenticated successfully
    echo "Success!  Received Access-Accept response from RADIUS server.\n";
}
