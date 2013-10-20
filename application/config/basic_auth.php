<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['tables']['users']           = 'users';
$config['tables']['groups']          = 'groups';

$config['salt_length'] = 10;
$config['store_salt']  = TRUE;

$config['site_title']                 = "www.6bey.com";       // Site Title, example.com
$config['admin_email']                = "admin@6bey.com"; // Admin Email, admin@example.com
$config['default_group']              = 'members';           // Default group, use name
$config['admin_group']                = 'admin';             // Default administrators group, use name
$config['identity']                   = 'email';             // A database column which is used to login with
$config['min_password_length']        = 8;                   // Minimum Required Length of Password
$config['max_password_length']        = 20;                  // Maximum Allowed Length of Password
$config['email_activation']           = TRUE;               // Email Activation for registration
$config['manual_activation']          = TRUE;               // How long to remember the user (seconds). Set to zero for no expiration
$config['maximum_login_attempts']     = 3;                   // The maximum number of failed login attempts.
