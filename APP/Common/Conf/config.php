<?php
return array(
    //'配置项'=>'配置值'
	'DB_TYPE'   => 'mysqli', // 数据库类型
	'DB_HOST'   => '127.0.0.1', // 服务器地址
	'DB_NAME'   => 'xiaqi_education', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => 'mysql0320',  // 密码
//		'DB_USER'   => 'fgy', // 用户名
//	'DB_PWD'    => 'gy123',  // 密码
	'DB_PORT'   => '3306', // 端口
	//'DB_PREFIX' => 'ip_', // 数据库表前缀
	'SHOW_PAGE_TRACE' =>false,  //
	'SHOW_ERROR_MSG' =>    false,
	'ERROR_MESSAGE'  =>    '发生错误！',
	'URL_HTML_SUFFIX'=>'html|shtml|xml',
	'URL_DENY_SUFFIX' => 'pdf|ico|png|gif|jpg',
	// 'URL_MODEL' => '2', //URL模式
	/* 缩短路径 */
	// 'URL_ROUTE_RULES' => array('/^index$/i' => 'Index/index'),   
	'HTML_CACHE_ON'     =>    true, 
	// 开启静态缓存
	'HTML_CACHE_TIME'   =>    60,   
	// 全局静态缓存有效期（秒）
	'HTML_FILE_SUFFIX'  =>    '.html',
	'DB_SQL_BUILD_CACHE' => true,//数据库缓存配置
    'DB_SQL_BUILD_QUEUE' => 'xcache',//数据库缓存配置
    'DB_SQL_BUILD_LENGTH' => 20, //数据库缓存配置
    'AUTH_KEY' =>'52c7dbxLOdpoJrz4',
);