<?php
/************************************************
*                                              *
* MÃ NGUỒN ĐƯỢC CUNG CẤP BỞI TUANORI           *
* LIÊN HỆ QUA ZALO : 0812.665.001              *
* FACEBOOK : FB.COM/PHAMHOANGTUAN.YTB          *
* CODE BỞI TUẤN ORI IT                         *
* WEBSITE : TUANORI.VN OR TUANORI.COM          *
*                                              *
************************************************/
/* NHẬN LÀM THUÊ WEB TẠI TUANORI.VN - MUA HOSTING GIÁ RẺ TẠI HOSTING2W.COM | MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI IT */
require $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/ajax/Facebook/autoload.php';
$fb = new Facebook\Facebook ([
  'app_id' => id, // ID ứng dụng
  'app_secret' => 'khóa bảo mật', // Khóa bí mật của ứng dụng
  'default_graph_version' => 'v12.0', // UPDATE V MỚI NHẤT
  ]);
  
$domain = $base_url.'facebook_login'; // LINK CALLBACK GỬI LÊN PHẢI TRÙNG VỚI LINK ĐÃ CẬP NHẬP TRONG FACEBOOK
$helper = $fb->getRedirectLoginHelper();
if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
/* NHẬN LÀM THUÊ WEB TẠI TUANORI.VN - MUA HOSTING GIÁ RẺ TẠI HOSTING2W.COM | MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI IT */
try {
$accessToken = $helper->getAccessToken($domain);
//$accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
/* NHẬN LÀM THUÊ WEB TẠI TUANORI.VN - MUA HOSTING GIÁ RẺ TẠI HOSTING2W.COM | MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI IT */
if (! isset($accessToken)) {
    /* NHẬN LÀM THUÊ WEB TẠI TUANORI.VN - MUA HOSTING GIÁ RẺ TẠI HOSTING2W.COM | MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI IT */
    $permissions = array('public_profile','email'); // Optional permissions
    $loginUrl = $helper->getLoginUrl($domain,$permissions);
    header("Location: ".$loginUrl);  
  exit;
}
/* NHẬN LÀM THUÊ WEB TẠI TUANORI.VN - MUA HOSTING GIÁ RẺ TẠI HOSTING2W.COM | MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI IT */
try {
  // Returns a `Facebook\FacebookResponse` object
  $fields = array('id', 'name', 'email');
//  $response = $fb->get('/me?fields='.implode(',', $fields).'', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$response = $fb->get('/me?fields=id,name,email,gender', $accessToken);
$fb_name = $response->getGraphUser()['name'];
$email = $response->getGraphUser()['email'];
$fb_id = $response->getGraphUser()['id'];
$sex = $response->getGraphUser()['sex'];

$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$api = mt_rand(10000, 99999).random($chars, 8);
$api = sha1($api);
$time = time();
$passmd5 = md5($fb_id);
/* NHẬN LÀM THUÊ WEB TẠI TUANORI.VN - MUA HOSTING GIÁ RẺ TẠI HOSTING2W.COM | MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI IT */

if($check_number == '1'){
    // nếu user tồn tại - tạo session
}
else{
// ko tồn tại - thêm vô sql + tạo session
}
/* NHẬN LÀM THUÊ WEB TẠI TUANORI.VN - MUA HOSTING GIÁ RẺ TẠI HOSTING2W.COM | MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI IT */
/*TÁC QUYỀN : TUANORIIT*/

?>