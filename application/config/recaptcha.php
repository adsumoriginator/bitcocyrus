<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// To use reCAPTCHA, you need to sign up for an API key pair for your site.
// link: http://www.google.com/recaptcha/admin
//$config['recaptcha_site_key'] = '6Lcea1gUAAAAAFu4ajnNTNaf4DOI3qV0wz5nUZfJ';
//// reCAPTCHA supported 40+ languages listed here:
// https://developers.google.com/recaptcha/docs/language
//$config['recaptcha_lang'] = 'en';
/* End of file recaptcha.php */
/* Location: ./application/config/recaptcha.php */

// ------------------------------------------------------------------------
// Recaptcha class config
// ------------------------------------------------------------------------

// The reCaptcha server keys and API locations
// Obtain your own keys from: http://www.recaptcha.net

$config['recaptcha'] = array(
  							'public'						=> '6Lcea1gUAAAAAFu4ajnNTNaf4DOI3qV0wz5nUZfJ',
  							'private'						=> '6Lcea1gUAAAAADjDbk20sQKOXEx6wXyUfVBi16yt',
  							'RECAPTCHA_API_SERVER' 			=> 'http://www.google.com/recaptcha/api',
  							'RECAPTCHA_API_SECURE_SERVER'	=> 'https://www.google.com/recaptcha/api',
  							'RECAPTCHA_VERIFY_SERVER' 		=> 'www.google.com',
  							'RECAPTCHA_SIGNUP_URL' 			=> 'https://www.google.com/recaptcha/admin/create',
  							'theme' 						=> 'red'
							);