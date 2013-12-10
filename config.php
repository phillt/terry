<?php

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', 'http://www.terrybrownmusic.com/');
define('ROOTS', '');
define('LIBS', 'libs/');
define('WEB_ID', 10);
define('DB_TYPE', 'mysql');
define('DB_HOST', '');
define('DB_NAME', 'phillly_controls');
define('DB_USER', 'phillly'); 
define('DB_PASS', 'phill3624');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');


//Social plugins, use the following to add social stuff

//FACEBOOK
define('FBPAGE', 'https://www.facebook.com/pages/terrybrownmusiccom/220080061252');
define('TITLE', 'Terry Brown Music');
define('TYPE', 'musician');
define('SITE_NAME', 'Terry Brown Music');
define('DEFAULT_DISC', 'Terry Brown western music singer');
define('DEFAULT_IMAGE',  URL . 'public/images/terrylogoembed.png');
define('ADMIN', "{100001344649748}");
define('APP_ID', '310405559058306');

//OTHER SOCIAL
define('YTPAGE', FALSE);
define('TWTPAGE', FALSE);