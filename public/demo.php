<?php
$salt = md5('salt');
$uuid = 'abcdefg12345';
$uriArr = [
    'user/sigin',
    'user/create',
    'user/info',
    'user/avatar',
    'user/update',
    'trades',
    'user/pwd',
    'sms/send',
    'sms/check',
    'feedbacks',
    'feedbacks/1',
    'feedbacks/create',
    'trades/create',
    ];
foreach($uriArr as $uri) {
    $serverSign = md5($salt . $uri . $uuid . $salt);
    echo $uri . '=>' . $serverSign . '<br />';
}
/*user/sigin=>0cceb741f82e754e858501e1352de534
user/create=>a61d376eff2669c48e86de7a31622578
user/info=>bd1f4e613cc462e48e577a33fa2d769d
user/avatar=>408a224bd03de53f8b5e9978dfe52a26
user/update=>39646cd6e7b7073f6ebe107eb283e0a2
trades=>57efe13d050b4046744c5fe50a3748c8
user/pwd=>8fd3f885d7c6865bd488cd71fcb326c7
sms/send=>dbec2b37769f6bae4bb176cfba7a0ed0
sms/check=>b23b97a7b49e178d3db2824f986c220b
feedbacks=>0c8c3024334131f441f631ab3d0acb13
feedbacks/1=>e2db2eba80bbab35778dca51c0b5dc55
feedbacks/create=>4f43810ca39fee7c4f7d4debd213a997
trades/create=>8020981f134cddeac91ea9d10fa51132*/