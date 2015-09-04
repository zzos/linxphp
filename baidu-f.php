<!DOCTYPE html>
<!--这是百度搜索结果参数分析工具 PHP 源码，若不知如何在浏览器打开，可加入百度参数QQ交流群(255363059)-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="cmn-Hans" xml:lang="cmn-Hans">
<head>
<meta charset="UTF-8"/>
<?php

// 自动生成标题 v2.3

// 请手动修改 url 对应网址、标题后缀
$url = 'http://'.$_SERVER['HTTP_HOST'].'/baidu-f.php';
$pt = '百度搜索结果参数';

// 取得搜索词
$s = @$_GET['s'];
$pn = @$_GET['pn'];
$rn = @$_GET['rn'];

if (preg_match('/(.*)(ed2k)(.*)/', $s)) {
    echo '<p>根据相关法律法规和政策，部分搜索结果未予显示, <a href="'.$url.'">回首页</a>或者到别处看看吧。</p>';
    exit;
}
elseif ($s == 'win8.1 64位英文版下载') {
    echo '<p>根据相关法律法规和政策，部分搜索结果未予显示, <a href="'.$url.'">回首页</a>或者到别处看看吧。</p>';
    exit;
}
elseif ($s == 'ましろちゃんのひみと道具') {
    echo '<p>根据相关法律法规和政策，部分搜索结果未予显示, <a href="'.$url.'">回首页</a>或者到别处看看吧。</p>';
    exit;
}
elseif (preg_match('/(?<=<script\>alert\()(.*)(?=\)<\/script\>)/', $s)) {
    echo '<p>已过滤跨站脚本攻击漏洞, <a href="'.$url.'">回首页</a>或者到别处看看吧。</p>';
    exit;
}
elseif (preg_match('/(?<=<script\>alert\()(.*)(?=\)<\/script\>)/', $rn)) {
    echo '<p>已过滤跨站脚本攻击漏洞, <a href="'.$url.'">回首页</a>或者到别处看看吧。</p>';
    exit;
}
elseif (preg_match('/(?<=<img src\=1 onerror\=alert\()(.*)(?=\)\>)/', $s)) {
    echo '<p>已过滤跨站脚本攻击漏洞, <a href="'.$url.'">回首页</a>或者到别处看看吧。</p>';
    exit;
}

// 过滤字符串
if (strlen($s) > 0) {
    $p = array (
        '/(\s+)/',
        '/(http:\/\/)/',
    );
    $r = array (
        '%20',
        '',
    );
    $z = preg_replace($p[1], $r[1], $s);
    $query = htmlspecialchars(preg_replace($p, $r, $s));
}
echo '<title>';
if (strlen($s) > 0) {

    // 缓存
    class FCache {
        public $cache_path = 'stock/';
        public $cache_time = 86400;
        public $cache_extension = '.stk';

        public function __construct($cache_path = 'stock/', $cache_time = 86400, $cache_exttension = '.stk') {
            $this->cache_path = $cache_path;
            $this->cache_time = $cache_time;
            $this->cache_exttension = $cache_exttension;
            if (!file_exists($this->cache_path)) {
                mkdir($this->cache_path, 0777);
            }
        }

        public function add($key, $value) {
            $filename = $this->_get_cache_file($key);
            file_put_contents($filename, serialize($value), LOCK_EX);
        }

        public function delete($key) {
            $filename = $this->_get_cache_file($key);
            unlink($filename);
        }

        public function get($key) {
            if ($this->_has_cache($key)) {
                $filename = $this->_get_cache_file($key);
                $value = file_get_contents($filename);
                if (empty($value)) {
                    return false;
                }
                return unserialize($value);
            }
        }

        public function flush() {
            $fp = opendir($this->cache_path);
            while(!false == ($fn = readdir($fp))) {
                if($fn == '.' || $fn =='..') {
                    continue;
                }
                unlink($this->cache_path . $fn);
            }
        }

        private function _has_cache($key) {
            $filename = $this->_get_cache_file($key);
            if(file_exists($filename) && (filemtime($filename) + $this->cache_time >= time())) {
                return true;
            }
            return false;
        }

        private function _is_valid_key($key) {
            if ($key != null) {
                return true;
            }
            return false;
        }

        private function _safe_filename($key) {
            if ($this->_is_valid_key($key)) {
                return md5($key);
            }
            return 'unvalid_cache_key';
        }

        private function _get_cache_file($key) {
            return $this->cache_path . $this->_safe_filename($key) . $this->cache_extension;
        }
    }

    $cache = new FCache();

    if (strlen($cache->get(urlencode($query))) > 0) {
        echo $cache->get(urlencode($query)).'_';
    }
    else {

        // 下拉框提示模式 I 第 1 位查询扩展作为主标题
        $sugip = array (
            '115.239.211.11',
            '115.239.211.12',
            '180.97.33.72',
            '180.97.33.73',
        );
        shuffle ($sugip);

        // 1. 初始化
        $ch = curl_init();

        // 2. 设置选项，包括 URL
        curl_setopt($ch, CURLOPT_URL, 'http://'.$sugip[0].'/su?action=opensearch&ie=UTF-8&wd='.$query);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器

        // 3. 执行并获取 HTML 文档内容
        $output = curl_exec ($ch);
        if ($output === FALSE) {
            echo "cURL Error: " . curl_error($ch);
        }
        $sug1 = json_decode($output);

        // 4. 释放 curl 句柄
        curl_close ($ch);
        $sug = @$sug1[1][0];

        if (strlen($sug) > 0) {
            echo $sug.'_';
            $cache->add(urlencode($query), $sug);
        }
    }

    // 引号转换为 HTML 实体的查询词作为副标题
    echo htmlspecialchars($z, ENT_QUOTES).'_';
}

// 标题后缀，品牌名
echo $pt.'</title>
<meta content="还你一个没有百度推广、产品的搜索结果页。" name="description" />
';

// 下拉框提示词第 1 位，查询词作为 meta keywords
echo '<meta content="';
if (strlen($s) > 0) {
    if (strlen($cache->get(urlencode($query))) > 0) {
        echo $cache->get(urlencode($query)).',';
    }
    elseif (strlen($sug) > 0) {
        echo $sug.',';
    }
    echo htmlspecialchars($z, ENT_QUOTES).',';
}
?>
百度搜索结果参数,F,F1,F2,F3" name="keywords" />
<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0,minimal-ui" />
<meta name="apple-mobile-web-app-title" content="百度搜索结果参数" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta name="author" content="吴星, maasdruck@gmail.com" />
<link rel="alternate" type="application/rss+xml" title="百度搜索结果参数 RSS Feed" href="http://www.weixingon.com/feed.xml" />

<!--css-->

<style type="text/css">
body,div,h1    {
    margin: 0;
}

body {
    color: #222222;
    background-color: #F8F7F5;
    font-family:
        "STHeiti STXihei",
        "Lucida Grande",
        "Microsoft JhengHei",
        "Microsoft Yahei",
        Helvetica,
        Tohoma,
        Arial,
        Verdana,
        sans-serif;
    height: 100%;
}

img {
    height: auto!important;
}

table {
    width: 46.25em;
    border-collapse: collapse;
    border: .0625em solid #DDDDDD;
    margin-bottom: 1.75em;
    width: 100%!important;
}

thead {
    color: #0080FF;
    background-color: #F2F2F2;
}

th,td {
    border: .0625em solid #DDDDDD;
    padding: .1875em;
}

a {
    color: #607FA6;
    font-size: 1em;
    text-decoration: none;
}

.noa {
    color: #FFD700;
    font-size: 1em;
    font-weight: bold;
    text-decoration: none;
}

input {
    font: normal 100%
        "STHeiti STXihei",
        "Lucida Grande",
        "Microsoft JhengHei",
        "Microsoft Yahei",
        Helvetica,
        Tohoma,
        Arial,
        Verdana,
        sans-serif;
}

.text {
    padding: .125em .3125em .25em .3125em;
    height: 2em;
    width: 20em;
    outline: none;
}

.other {
    padding: .125em .3125em .25em .3125em;
    height: 2em;
    width: 5em;
    outline: none;
}

.submit {
    height: 2em;
    width: 5.9375em;
    border: none;
}

.center {
    text-align: center;
}

.bold {
    font-size: 1.5em;
    font-weight: bold;
    word-break: normal;
    word-wrap: break-word;
}

@media screen and (min-width: 1024px) {
    .detail {
        width: 46.25em;
        margin: 0 auto;
        padding: 1.25em;
        padding-top: 0;
        border-left: .0625em solid #CCCCCC;
        border-bottom: .0625em solid #CCCCCC;
        border-right: .0625em solid #CCCCCC;
    }
}

.detail {
        background-color: #373737;
}

.header {
    padding-top: 1.25em;
    padding-bottom: .625em;
    border-bottom: .0625em dotted #CCCCCC;
}

.red {
    color: #F5DEB3;
}

.white {
    color: #FFFAF0;
}

.back-white {
    background-color: #FFFFFF;
    opacity: 0.85;
}

.back-egg {
    background-color: #FFFFBB;
    opacity: 0.85;
}

.back-pink {
    background-color: #FFB7DD;
    opacity: 0.85;
}

.back-yellow {
    background-color: #FFDDAA;
    opacity: 0.85;
}

.back-orange {
    background-color: #FFDDAA;
    opacity: 0.85;
}

.back-gold {
    background-color: #FFEE99;
    opacity: 0.85;
}

.back-green {
    background-color: #EEFFBB;
    opacity: 0.85;
}

.back-blue {
    background-color: #CCDDFF;
    opacity: 0.85;
}

.back-sky {
    background-color: #CCEEFF;
    opacity: 0.85;
}

.back-baidu {
    background-color: #77BBEF;
    opacity: 0.85;
}

.back-wheat {
    background-color: #F5DEB3;
    opacity: 0.85;
}

.back-azure {
    background-color: #F0FFFF;
    opacity: 0.85;
}

.unit-honeydew {
    background-color: #F0FFF0;
    opacity: 0.85;
}

.unit-gold {
    background-color: #FFD700;
    opacity: 0.85;
}

.unit-orange {
    background-color: #FFA500;
    opacity: 0.85;
}

.unit-violet {
    background-color: #EE82EE;
    opacity: 0.85;
}

.unit-tomato {
    background-color: #FF6347;
    opacity: 0.85;
}

.unit-lavender {
    background-color: #E6E6FA;
    opacity: 0.85;
}

.unit-silver {
    background-color: #C0C0C0;
    opacity: 0.85;
}

.unit-darkseagreen {
    background-color: #8FBC8F;
    opacity: 0.85;
}

.unit-mediumpurple {
    background-color: #9370DB;
    opacity: 0.85;
}

.unit-burlywood {
    background-color: #DEB887;
    opacity: 0.85;
}

.unit-aquamarine {
    background-color: #7FFFD4;
    opacity: 0.85;
}

.unit-springgreen {
    background-color: #00FF7F;
    opacity: 0.85;
}

.unit-darkturquoise {
    background-color: #00CED1;
    opacity: 0.85;
}

.unit-mediumseagreen {
    background-color: #3CB371;
    opacity: 0.85;
}

.unit-deepskyblue {
    background-color: #00BFFF;
    opacity: 0.85;
}

.unit-lightskyblue {
    background-color: #87CEFA;
    opacity: 0.85;
}

@media screen and (min-width: 1024px) {
    a#go-top {
        opacity: 0.6;
        background-color: #E6E6E6;
        width: 6.25em;
        height: 3.125em;
        line-height: 3.125em;
        text-align: center;
        text-decoration: none;
        color: #999999;
    }

    a#go-top:hover {
        background-color: #CCCCCC;
        color: #333333;
    }

    .dustbin {
        margin-top: 3em;
        width: 5em;
        height: 19.25em;
        background-color: #E6E6E6;
        font-size: 1.3em;
        text-shadow: -0.0625em -0.0625em #BBBBBB;
        float: left;
    }

    .draglist:hover {
    border-color: #FFFFBB;
    background-color: #FFDDAA;
    }
}

</style>
</head>
<body>

<!--拖放-->
<div class="dustbin center"><br>按住表格<br>拖曳到这</div>

<div class="detail">

<!--搜索框-->
<div class="header center">
<?php
echo '    <form method="get" action="'.$url.'">
';
echo '        <input class="text" type="text" value="'.htmlspecialchars(@$_GET['s'] ,ENT_QUOTES).'" name="s" title="解析" autocomplete="off" maxlength="76" id="sug" autofocus="autofocus" placeholder="请输入查询词">
';
echo '        <input class="other" type="number" name="pn" title="从第几位开始取结果" min="0" max="750" value="'.@$_GET['pn'].'" placeholder="取第几位">
';
echo '        <input class="other" type="number" name="rn" title="搜索结果数量" min="0" max="50" value="'.@$_GET['rn'].'" placeholder="返回数量">
';
echo '        <select title="搜索结果时间限制" name="gpc">
';
echo '            <option value="">全部时间</option>
';
echo '            <option value="stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1"';
if (@$_GET['gpc'] == 'stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1') {
    echo 'selected';
}
echo '>最近1天</option>
';
echo '            <option value="stf%3D'.(time() - 604800).'%2C'.time().'%7Cstftype%3D1"';
if (@$_GET['gpc'] == 'stf%3D'.(time() - 604800).'%2C'.time().'%7Cstftype%3D1') {
    echo 'selected"';
}
echo '>最近1週</option>
';
echo '            <option value="stf%3D'.(time() - 2678400).'%2C'.time().'%7Cstftype%3D1"';
if (@$_GET['gpc'] == 'stf%3D'.(time() - 2678400).'%2C'.time().'%7Cstftype%3D1') {
    echo 'selected"';
}
echo '>最近1月</option>
';
echo '            <option value="stf%3D'.(time() - 31536000).'%2C'.time().'%7Cstftype%3D1"';
if (@$_GET['gpc'] == 'stf%3D'.(time() - 31536000).'%2C'.time().'%7Cstftype%3D1') {
    echo 'selected"';
}
echo '>最近1年</option>
        </select>
        <input class="submit" type="submit" value="百度一下">
    </form>
</div>
';

$startTime = microtime(true);
$gpc = @$_GET['gpc'];
$connectpn = "&pn=";
$connectrn = "&rn=";
$connectgpc = "&gpc=";
$p = array (
    '/(\s+)/',
    '/(http:\/\/)/',
);
$r = array (
    '%20',
    '',
);
$z = preg_replace($p[1], $r[1], $s);
$query = htmlspecialchars(preg_replace($p, $r, $s));
$srcid1 = '<a href="http://ask.seowhy.com/question/8677" target="_blank" rel="external nofollow noreferrer" title="搜索结果页源代码 F - F3、Srcid 的问题">as&nbsp;结果</a>';
$srcid2 = '<a href="http://ask.seowhy.com/question/8111" target="_blank" rel="external nofollow noreferrer" title="百度搜索产品、合作伙伴">sp&nbsp;阿拉丁</a>';
$srcid3 = '<a href="http://ask.seowhy.com/question/9186" target="_blank" rel="external nofollow noreferrer" title="为什么有的搜索结果会没有百度参数，这样的现象原因是什么">ecom 知心商业&nbsp;|&nbsp;时效性</a>';
$nofk = '<a href="http://ask.seowhy.com/question/9486" target="_blank" rel="external nofollow noreferrer" title="净水器百度排名175，能做上去吗？">无&nbsp;F,&nbsp;fk&nbsp;(百度汇、实时、面包屑导航条)</a>';
$openapi = '<a href="http://www.weixingon.com/baidusp-srcid.php" target="_blank">百度开放平台&nbsp;api</a>';
$F[1] = '<span title="搜索结果标题|摘要与查询词的语义关联度">语义关联</span>';
$F[2] = '同音词';
$F[3] = '[猜]正规性';
$F[4] = '[猜]更新';
$F[5] = '[猜]实时度';
$F[6] = '<a href="http://ask.seowhy.com/article/121" target="_blank" rel="external nofollow noreferrer" title="百度搜索结果参数F第6位基于IP位置">基于IP位置</a>';
$F[7] = '<a href="http://ask.seowhy.com/question/9058" target="_blank" rel="external nofollow noreferrer" title="搜索文章url能够搜索出来，但是site网站域名的时候却没有，什么原因造成的呢？">网址</a>';
$F[8] = '标题|网址|摘要';
$F1[1] = '第1位';
$F1[2] = '第2位';
$F1[3] = '<a href="http://ask.seowhy.com/question/8958" target="_blank" rel="external nofollow noreferrer" title="快照时间显示，以小时为单位">时间限制</a>';
$F1[4] = '[猜]实时动态';
$F1[5] = '[猜]匹配率';
$F1[6] = '热门度';
$F1[7] = '[猜]网址权重';
$F1[8] = '第8位';
$F2[1] = '[猜]相关';
$F2[2] = '第2位';
$F2[3] = '第3位';
$F2[4] = '第4位';
$F2[5] = '第5位';
$F2[6] = '<span title="仅是这一刻的搜索结果目标页相对查询词的权重">[猜]内链数量</span>';
$F2[7] = '<a href="http://seo.qiankoo.com/813" target="_blank" rel="external nofollow noreferrer" title="百度搜索结果参数F2与搜索结果标题的关系">前标题</a>';
$F2[8] = '<a href="http://ask.seowhy.com/question/8411" target="_blank" rel="external nofollow noreferrer" title="百度搜索结果参数F2">后标题</a>';
$F3[1] = '第1位';
$F3[2] = '第2位';
$F3[3] = '第3位';
$F3[4] = '<a href="http://ask.seowhy.com/article/30" target="_blank" rel="external nofollow noreferrer" title="百度搜索结果参数F3 - 域名选择与原创内容时效性">[猜]时效性</a>';
$F3[5] = '<a href="http://ask.seowhy.com/article/46" target="_blank" rel="external nofollow noreferrer" title="百度搜索结果参数F3 - 超越域名选择的含义">[猜]网址形式</a>';
$F3[6] = '第6位';
$F3[7] = '第7位';
$F3[8] = '[猜]相似度';
$y = '<a href="http://ask.seowhy.com/article/53" target="_blank" rel="external nofollow noreferrer" title="百度搜索结果页参数y - 验证码与工具">y&nbsp;验证码&nbsp;nonce</a>';

if (strlen($s) > 0) {
// 随机更换 IP
$ip = array (
    '58.217.200.13',
    '58.217.200.15',
    '58.217.200.37',
    '58.217.200.39',
    '61.135.185.31',
    '61.135.185.32',
    '61.135.169.103',
    '61.135.169.107',
    '61.135.169.113',
    '61.135.169.114',
    '61.135.169.115',
    '61.135.169.121',
    '61.135.169.125',
    '111.13.12.139',
    '111.13.12.142',
    '111.13.100.91',
    '111.13.100.92',
    '115.239.210.25',
    '115.239.210.26',
    '115.239.210.27',
    '115.239.210.28',
    '115.239.211.109',
    '115.239.211.112',
    '115.239.211.113',
    '115.239.211.114',
    '119.75.213.50',
    '119.75.213.51',
    '119.75.213.61',
    '119.75.216.20',
    '119.75.217.11',
    '119.75.217.26',
    '119.75.217.56',
    '119.75.217.63',
    '119.75.217.109',
    '119.75.218.11',
    '119.75.218.45',
    '119.75.218.70',
    '119.75.218.77',
    '119.75.218.143',
    '123.125.114.107',
    '123.125.114.220',
    '123.125.114.238',
    '123.125.115.140',
    '123.125.115.165',
    '123.125.65.78',
    '123.125.65.82',
    '123.125.65.88',
    '123.125.65.90',
    '180.149.131.98',
    '180.149.132.151',
    '180.149.132.166',
    '180.149.132.168',
    '180.97.33.67',
    '180.97.33.71',
    '180.97.33.107',
    '180.97.33.108',
    '202.108.22.5',
    '202.108.22.142',
    '220.181.111.111',
    '220.181.111.149',
    '220.181.111.188',
    '220.181.111.22',
    '220.181.111.37',
    '220.181.111.83',
    '220.181.112.12',
    '220.181.112.18',
    '220.181.112.147',
    '220.181.112.195',
    '220.181.112.21',
    '220.181.112.244',
    '220.181.112.76',
    '220.181.112.89',
    '220.181.37.55',
    '220.181.6.6',
    '220.181.6.18',
    '220.181.6.19',
    '220.181.6.175',
    );
shuffle ($ip);
$baidu = 'http://'.$ip[0].'/s?wd=';
    if (strlen($pn) > 0) {
        if (strlen($rn) > 0) {
            if (strlen($gpc) > 0) {
                $baiduserp = file_get_contents($baidu.$query.$connectpn.$pn.$connectrn.$rn.$connectgpc.$gpc);
            }
            else {
                $baiduserp = file_get_contents($baidu.$query.$connectpn.$pn.$connectrn.$rn);
            }
        }
        elseif (strlen($gpc) > 0) {
            $baiduserp = file_get_contents($baidu.$query.$connectpn.$pn.$connectgpc.$gpc);
        }
        else {
            $baiduserp = file_get_contents($baidu.$query.$connectpn.$pn);
        }
    }
    elseif (strlen($rn) > 0) {
        if (strlen($gpc) > 0) {
            $baiduserp = file_get_contents($baidu.$query.$connectrn.$rn.$connectgpc.$gpc);
        }
        else {
            $baiduserp = file_get_contents($baidu.$query.$connectrn.$rn);
        }
    }
    elseif (strlen($gpc) > 0) {
        $baiduserp = file_get_contents($baidu.$query.$connectgpc.$gpc);
    }
    else
        $baiduserp = file_get_contents($baidu.$query);
}

// 打开网页显示相关资料

if (strlen($s) == 0) {
    echo '
<h1 class="center bold white">相关资料</h1>
<p class="center"><a class="noa" href="http://www.weixingon.com/feed.xml" target="_blank" rel="nofollow noreferrer">订阅更新RSS</a></p>
<p class="center"><a class="noa" href="http://www.weixingon.com/baiduip.php" target="_blank">百度的IP地址是多少</a></p>
<p class="center"><a class="noa" href="http://www.weixingon.com/wordcount/" target="_blank">百度搜索结果标题长度研究</a></p>
<p class="center"><a class="noa" href="http://www.weixingon.com/par.html" target="_blank">百度 HTTP 接口参数</a></p>
<p class="center"><a class="noa" href="http://www.weixingon.com/chaolianfenxi.html" target="_blank">超链分析</a></p>
';
}

// 确定时间

date_default_timezone_set('PRC');
clearstatcache();

// 搜索结果数量

if (preg_match('/(?<=百度为您找到相关结果)([\x80-\xff]{0,3})([0-9,]{1,11})(?=个<\/div>)/', @$baiduserp, $matchnumbers))

// 百度服务器返回的 Unix 时间戳

if (preg_match("/(?<='T':')(\d{10})(?=',)/", $baiduserp, $matchservertime))

// 百度搜索结果展现耗时

if (preg_match('/([\d\.]+)(?=;<\/script><\/html>)/', $baiduserp, $matchsrvt))

// 搜索结果链接，数量，查询时间

if (strlen($s) > 0) {
    // 随机下载壁纸
    $wallpapers = array (
        'dlsw.br.baidu.com/original/201406/qianxun_wallpage_620.zip',
        'www.smashingmagazine.com/tag/wallpapers/',
        );
    shuffle ($wallpapers);
    echo '    <p class="center white">
        <a class="noa" href="https://www.baidu.com/s?wd='.$query;
    if (strlen($pn) > 0) {
        if (strlen($rn) > 0) {
            if (strlen($gpc) > 0) {
                echo $connectpn.$pn.$connectrn.$rn.$connectgpc.$gpc;
            }
            else {
                echo $connectpn.$pn.$connectrn.$rn;
            }
        }
        elseif (strlen($gpc) > 0) {
            echo $connectpn.$pn.$connectgpc.$gpc;
        }
        else {
            echo $connectpn.$pn;
        }
    }
    elseif (strlen($rn) > 0) {
        if (strlen($gpc) > 0) {
            echo $connectrn.$rn.$connectgpc.$gpc;
        }
        else {
            echo $connectrn.$rn;
        }
    }
    elseif (strlen($gpc) > 0) {
        echo $connectgpc.$gpc;
    }
    echo '" target="_blank" rel="external nofollow noreferrer">
            点击查看“<span class="red">'.$s.'</span>”的百度搜索结果页
        </a>
        '.$matchnumbers[2].'&nbsp;个
        <a class="noa" href="http://ask.seowhy.com/question/8376" rel="external nofollow noreferrer" target="_blank" title="百度搜索结果onmousedown事件对排名有什么影响？">
            结果
        </a>
        <a class="noa" href="http://open.baidu.com/special/time/" target="_blank" rel="external nofollow noreferrer" title="现在几点？">
            '.date('Y-m-d H:i:s', $matchservertime[1])
        .'</a>
        <a class="noa" href="http://www.weixingon.com/feed.xml" target="_blank" rel="nofollow noreferrer">
            更新日志
        </a>
    </p>';
}
// '</a>
//         <a class="noa" href="http://'.$wallpapers[0].'" rel="external nofollow noreferrer" target="_blank">
//             下载壁纸
//         </a>
//     </p>'
// 冇收录

if (preg_match('/(?<=<p>很抱歉，没有找到与<span style="font-family:宋体">“<\/span><em>)(.+)(?=<\/em><span style="font-family:宋体">”<\/span>相关的网页。<\/p>)/', @$baiduserp, $matchno))
    echo '
<p>
    <a class="noa" href="http://'.$matchno[1].'" target="_blank" rel="external nofollow noreferrer" title="直接访问&nbsp;'.@$matchno[2].'">
        很抱歉，没有找到与“<span class="red">'.$matchno[1].'</span>”相关的网页。
    </a>
</p>
<p class="white">
    如网页存在，请<a class="noa" href="http://zhanzhang.baidu.com/sitesubmit/index?sitename=http%3A%2F%2F'.$matchno[1].'" target="_blank" rel="external nofollow noreferrer" title="您可以提交想被百度收录的url">提交网址</a>给我们
</p>';

// 冇收录，但有其他搜索结果

if (preg_match('/(?<=<font class="c-gray">没有找到该URL。您可以直接访问&nbsp;<\/font><a href=")(.+)(?=" target="_blank" onmousedown)/', @$baiduserp, $matchno2))
echo '
<p class="white">
    没有找到该URL。您可以直接访问&nbsp;<span class="red"><a class="noa" href="'.$matchno2[1].'" target="_blank" rel="external nofollow noreferrer" title="直接访问 '.$matchno2[1].'">'.$matchno2[1].'</a></span>，还可<a class="noa" href="http://zhanzhang.baidu.com/sitesubmit/index?sitename=http%3A%2F%2F'.$matchno2[1].'" target="_blank" rel="external nofollow noreferrer" title="您可以提交想被百度收录的url">提交网址</a>给我们。
</p>';

// 字数限制

if (preg_match('/(?<=<font class=f14><b>)(.+)(?=&nbsp;及其后面的字词均被忽略，因为百度的查询限制在38个汉字以内。<\/b><\/font>)/', @$baiduserp, $matchlimit))
echo '<p class="white">'.$matchlimit[1].'&nbsp;及其后面的字词均被忽略，因为百度的查询限制在38个汉字以内。</p>';

// 屏蔽词

if (preg_match('/(?<=<div class="boldline se_common_hint c-gap-bottom c-container" data-id="40400" data-tpl="hint_boldline"><strong>)(.+)(?=<\/strong><\/div>)/', @$baiduserp, $matchcensor))
echo '<p class="white">'.$matchcensor[1].'</p>';

// 推销电话

if (preg_match('/(?<=<div class="op_liarphone2_word">被)(\d+)(?=个&nbsp;<a href="http:\/\/shoujiweishi.baidu.com\/" target="_blank">百度手机卫士<\/a>&nbsp;用户标记为<strong>"广告推销"<\/strong>,供您参考。<\/div>)/', @$baiduserp, $matchliarphone))
echo '<p class="white">被'.$matchliarphone[1].'个<a class="noa" href="http://shoujiweishi.baidu.com/" rel="external nofollow noreferrer" target="_blank">百度手机卫士</a>用户标记为<strong>"骚扰电话"</strong>,供您参考。</p>';

// 诈骗电话

if (preg_match('/(?<=<div class="op_liarphone2_word">被)(\d+)(?=个&nbsp;<a href="http:\/\/haoma.sogou.com" target="_blank">搜狗号码通<\/a>&nbsp;用户标记为<strong>"诈骗"<\/strong>,请谨防受骗。<\/div>)/', @$baiduserp, $matchliarphone2))
echo '<p class="noa">被'.$matchliarphone2[1].'个<a class="white" href="http://haoma.sogou.com" rel="external nofollow noreferrer" target="_blank">搜狗号码通</a>用户标记为<strong>"诈骗"</strong>,请谨防受骗。</p>';

// site 特型
$indextime = date('Y-m-d',strtotime('-1 day'));

if (preg_match('/(?<=该网站共有)(\s{16})(<b style="color:#333">)([0-9,\x80-\xff]{1,32})(?=<\/b>)/', @$baiduserp, $matchsite))
    echo '
<p class="white">'.$indextime.'&nbsp;百度索引量&nbsp;'.$matchsite[3].'&nbsp;(site&nbsp;&divide;&nbsp;索引量)&nbsp;=&nbsp;'.sprintf('%.3f',((str_replace(',', '', $matchnumbers[2]) / str_replace(',' ,'' ,$matchsite[3])) * 100)).'%</p>';

// 搜索结果
if (preg_match_all("/(?<=\" data\-tools=\'{\"title\":\")([^\"]+)(\",\"url\":\"http:)(\/\/www.baidu.com\/link\?url=[a-zA-Z0-9_\-]{43,299})(?=\"}'><a class=\"c-tip-icon\"><i class=\"c-icon c-icon-triangle-down-g\"><\/i><\/a><\/div>)/", @$baiduserp, $matchserp))

// 搜索结果页资源

if (preg_match_all('/(?<=<div class="result c-container)( ?)(" id=")(\d{1,3})(" srcid="15)(\d{2})(?=" tpl=")/', @$baiduserp, $matchsrcid))

// 搜索结果，字节，来源，排名

if (strlen($s) > 0) {
    echo '
<div class="draglist" draggable="true">
    <table>
        <thead>
            <tr>
                <th>
                    <a href="http://ask.seowhy.com/question/8396" rel="external nofollow" target="_blank" title="真心不喜欢百度搜索页中的框和排版">
                        标题
                    </a>
                </th>
                <th>
                    <a href="http://www.weixingon.com/wordcount/" target="_blank" title="百度搜索结果标题长度 <= 64 字节">
                        字节
                    </a>
                </th>
                <th>
                    <a href="http://ask.seowhy.com/article/79" target="_blank" rel="external nofollow noreferrer" title="百度左侧搜索结果来源分类srcid - 教你精准区分百度搜索产品">
                    </a>
                    '.$srcid1.'
                </th>
                <th>
                    <span title="排名为百度服务器缓存结果，可能因实时或地域而不同，刷新后返回最新结果">排名</span>
                </th>
            </tr>
        </thead>
        <tbody>';

// 字数统计函数
function smarty_modifier_wordcount($str,$encoding = 'UTF-8') {

    if(strtolower($encoding) == 'gbk') {
        $encoding = 'gb18030';
    }
    
    if(!is_string($str)||$str === '')
        return false;

    $mbLen = iconv_strlen($str, $encoding);
    $subLen = 0;

    for ($i = 0; $i < $mbLen; $i++) {
        $mbChr = iconv_substr($str, $i, 1, $encoding);

        if (1 == strlen($mbChr)) {
            $subLen += 1;
        }
        else {
            $subLen += 2;
        }
    }
    return $subLen;
}

// seo 可控资源号
$srcidas = array (
    array(99, '普通结果', '模版名2数据策略', ''),
    array(81, '更多同站相关结果&gt;&gt;', '201412添加', ''),
    // 2015-06-23 如何在中国办理留学生学历认证 RED SCARF http://www.honglingjin.co.uk/3023.html
    array(51, '列表－模版', '201411添加', 'QQ&nbsp;751476'),
    array(50, '未知', '', ''),
    array(49, '未知', '', ''),
    array(48, '评分－结构化数据', '201408添加', ''),
    array(47, '百度百科', '201407添加', ''),
    array(46, '未知', '', ''),
    array(45, '非正规相册', '201412添加', 'QQ&nbsp;1724102740'),
    array(44, '未知', '', ''),
    array(43, '面包屑导航－结构化数据', '', ''),
    array(42, '百度学术&nbsp;查看更多相关论文', '', ''),
    array(41, '未知', '', ''),
    array(40, '未知', '', ''),
    // 2015-01-08 搜外 搜外网 http://www.seowhy.com/
    array(39, '[官网]&nbsp;0－6&nbsp;个子链结果', '201405添加', ''),
    array(38, '摘要－结构化数据', '', ''),
    array(37, '组图&nbsp;百度经验', '无F参数', ''),
    array(36, '一般答案&nbsp;百度知道', '', ''),
    array(35, '未知，模版采用&nbsp;se_com_image_s', '模版', ''),
    array(34, '未知，模版采用&nbsp;se_com_default', '模版', ''),
    array(33, '论坛帖子', '', ''),
    array(32, '最佳答案&nbsp;百度知道', '', ''),
    // 在原用户查询词的基础上，通过一定的方法和策略把与原查询词相关的词、词组添加到原查询中，组成新的、更能准确表达用户查询意图的查询词序列，然后用新查询对文档重新检索，从而提高信息检索中的查全率和查准率。 李晓明; 闫宏飞; 王继民. 附录 术语//搜索引擎——原理、技术与系统(第二版). 2013年5月第9次印刷. 北京: 科学. 2012.5: 第322–323页 ISBN 7-03-034258-4 (简体中文)
    array(31, '查询扩展', '', ''),
    array(30, '百度贴吧&nbsp;更多贴吧相关帖子', '', ''),
    // 百度知道|搜狗问问(搜搜问问)|爱问知识人|39问医生|寻医问药网有问必答
    array(29, '权威问答网站', '', ''),
    array(28, '更多知道相关问题', '', ''),
    array(27, '更多文库相关文档&gt;&gt;', '', ''),
    array(26, '更多文库相关文档', '', ''),
    array(25, '百度文库', '', ''),
    array(24, '缩略图结果', '但非每个查询词展现图片', ''),
    array(23, 'robots.txt&nbsp;文件存在限制指令的结果', '', ''),
    array(22, '百度经验带相册', '', ''),
    array(21, '图片&nbsp;百度百科(可能与查询词内容相关度较高)', '', ''),
    // 2015-01-08 无序的新世界 维普网 http://www.cqvip.com/qk/95355X/200106/15044983.html
    array(20, '期刊文献', '', ''),
    array(19, '维基百科&nbsp;国际化', '', ''),
    array(18, '软件下载&nbsp;国际化', '', ''),
    array(17, '[图文]', '但并非每个查询词显示&nbsp;[图文]', ''),
    array(16, '宗教&nbsp;国际化', '', ''),
    array(15, '电影&nbsp;国际化', '', ''),
    array(14, '在线文档－结构化数据', '', ''),
    array(13, '软件下载－结构化数据', '', ''),
    array(12, '单视频&nbsp;国际化', '', ''),
    array(11, '[原创]&nbsp;星火计划', '', ''),
    array(10, '子链&nbsp;国际化', '', ''),
    array('09', '[官网]', '', ''),
    array('08', '单视频&nbsp;站点', '', ''),
    array('07', '微博', '', ''),
    array('06', '单视频', '', ''),
    array('05', '百度知道&nbsp;高品质(知道达人|权威专家|官方机构)', '', ''),
    array('04', '自动问答', '', ''),
    array('03', '图片&nbsp;单视频', '', ''),
    array('02', '百度百科', '', ''),
    array('01', '评分－结构化数据', '', ''),
    array('00', '无', '', '')
    );

    foreach ($matchsrcid[3] as $i => $position) {
        echo '
            <tr class="back-white">
                <td>
                    <a href="'.@$matchserp[3][$i].'" rel="external nofollow noreferrer" target="_blank">'
                        .stripslashes(@$matchserp[1][$i])
                    .'</a>
                </td>
                <td class="center">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode(@$matchserp[1][$i], ENT_QUOTES))).'</td>
                <td>';

        foreach ($srcidas as $ii => $positioni) {
            if ($matchsrcid[5][$i] == $srcidas[$ii][0]) {
                echo $srcidas[$ii][1];
            }
        }
        echo '
                </td>
                <td class="center">'.$matchsrcid[3][$i].'</td>
            </tr>';
    }
    echo '
        </tbody>
    </table>
</div>';
}

// fetch key
if (preg_match_all('/(?<="  srcid=")(\d{1,5})("  fk=")([\d_]{0,6}?)([^_]{1,32})(" id=")(\d{1,2})(?=" tpl=")/', @$baiduserp, $matchfk))
// 抓取键名，键值，来源，排名

if (strlen($s) > 0) {
    echo '
<div class="draglist" draggable="true">
    <table>
        <thead>
            <tr>
                <th>'.$srcid2.'</th>
                <th>'.$openapi.'</th>
                <th>排名</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($matchfk[6] as $i => $position) {
        $fk = explode('.',$matchfk[4][$i],5);
        echo '
            <tr class="back-egg center">
                <td>';

 $srcidspa = array (
    array(20840, '', '', '', '', '', '报价|图片|参数配置|口碑-汽车之家', '', '', ''),
    array(20776, '', '', '', '', '', '[猜]&nbsp;百度百科', '', '', ''),
    array(20679, '<a target="_blank" href="', 'http://help.alipay.com/lab/234578-236168/0-236168.htm', '', '" rel="external nofollow noreferrer', '">', '余额宝相关问题&nbsp;支付宝个人帮助中心', '</a>', '', ''),
    array(20631, '', '', '', '', '', '教育考试&nbsp;百度知心文库', '', '', ''),
    array(20548, '', '', '', '', '', '系列&nbsp;百度视频', '', '', ''),
    array(20546, '', '', '', '', '', '分集剧情&nbsp;电视猫', '', '', ''),
    array(20535, '', '', '', '', '', '[猜]&nbsp;2014年火车票购票日历', '', '', ''),
    array(20528, '', '', '', '', '', '电视剧情介绍&nbsp;电视猫', '', '', ''),
    array(20527, '', '', '', '', '', '百度左侧知心同系列电影&nbsp;百度视频', '', '', ''),
    array(20458, '', '', '', '', '', '官方微博(原知心左侧卡片框)', '', '', ''),
    array(20457, '', '', '', '', '', '电视剧&nbsp;百度视频', '', '', ''),
    array(20451, '', '', '', '', '', '分集剧情&nbsp;电视猫', '', '', ''),
    array(20426, '<a target="_blank" href="', 'http://s.weibo.com/user/', $matchfk[4][$i], '&amp;auth=vip" rel="external nofollow noreferrer', '">', '新浪官微', '</a>', '', ''),
    array(20423, '', '', '', '', '', '[猜]&nbsp;百度知道&nbsp;医疗健康&nbsp;更多知道相关问题', '', '', ''),
    array(20422, '', '', '', '', '', '[猜]&nbsp;百度知道&nbsp;医疗&nbsp;更多知道相关问题', '', '', ''),
    array(20408, '百度百科(由<a target="_blank" href="', 'http://www.baikemy.com', '', '&amp;auth=vip" rel="external nofollow noreferrer', '">', '卫生部临床医生科普平台/百科名医网', '</a>权威认证', '', ''),
    array(20407, '百度百科(由<a target="_blank" href="', 'http://www.baikemy.com', '', '&amp;auth=vip" rel="external nofollow noreferrer', '">', '卫生部临床医生科普平台/百科名医网', '</a>权威认证', '', ''),
    array(20406, '', '', '', '', '', '百度视频', '', '', ''),
    array(20387, '', '', '', '', '', '易车网', '', '', ''),
    array(20376, '', '', '', '', '', '百度百科&nbsp;汽车之家阿拉丁', '', '', ''),
    array(20375, '', '', '', '', '', '官网&nbsp;汽车之家阿拉丁', '', '', ''),
    array(20324, '', '', '', '', '', '百度百科(原知心左侧卡片框)', '', '', ''),
    array(20323, '', '', '', '', '', '百度图片(原知心左侧卡片框)', '', '', ''),
    array(20322, '', '', '', '', '', '百度音乐(原知心左侧卡片框)', '', '', ''),
    array(20321, '', '', '', '', '', '百度视频(原知心左侧卡片框)', '', '', ''),
    array(20319, '', '', '', '', '', '百度贴吧(原知心左侧卡片框)', '', '', ''),
    array(20315, '', '', '', '', '', '付费观看&nbsp;百度视频', '', '', ''),
    array(20294, '', '', '', '', '', '[猜]&nbsp;热映电影&nbsp;百度视频&nbsp;-&nbsp;百度左侧知心结果', '', '', ''),
    array(20289, '', '', '', '', '', '知乎&nbsp;-&nbsp;百度阿拉丁', '', '', ''),
    array(20172, '', '', '', '', '', '知心旅游介绍&nbsp;百度旅游', '', '', ''),
    array(20135, '', '', '', '', '', 'topik&nbsp;网上报名', '', '', ''),
    array(20124, '', '', '', '', '', '百度左侧知心视频电视剧', '', '', ''),
    array(20080, '', '', '', '', '', '北京市预约挂号统一平台', '', '', ''),
    array(20071, '', '', '', '', '', '医院科室&nbsp;好大夫在线', '', '', ''),
    array(20070, '', '', '', '', '', '挂号网', '', '', ''),
    array(20006, '', '', '', '', '', '医院网站', '', '', ''),
    array(20005, '', '', '', '', '', '医院科室', '', '', ''),
    array(18577, '', '', '', '', '', '【携程攻略】', '', '', ''),
    array(18521, '<a target="_blank" href="', 'http://s.hc360.com/?w=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '慧聪网&nbsp;导购', '</a>', '', ''),
    array(18258, '', '', '', '', '', '91论坛', '', '', ''),
    array(16932, '', '', '', '', '', '美食/营养&nbsp;百度经验【组图】', '', '', ''),
    array(16852, '', '', '', '', '', '[猜]&nbsp;腾讯科技', '', '', ''),
    array(16847, '', '', '', '', '', '[猜]&nbsp;热点话题', '', '', ''),
    array(16821, '', '', '', '', '', '[猜]&nbsp;体育直播&nbsp;新浪网', '', '', ''),
    array(16809, '', '', '', '', '', '电视猫', '', '', ''),
    array(16796, '', '', '', '', '', '综艺&nbsp;腾讯视频', '', '', ''),
    array(16790, '', '', '', '', '', '美食美客&nbsp;爱奇艺', '', '', ''),
    array(16758, '', '', '', '', '', '悦美网&nbsp;子链&nbsp;缩略图', '', '', ''),
    array(16743, '', '', '', '', '', '软件下载&nbsp;中关村在线', '', '', ''),
    array(16724, '', '', '', '', '', '[猜]&nbsp;中国好系统', '', '', ''),
    array(16689, '', '', '', '', '', '走势图表&nbsp;百度乐彩', '', '', ''),
    array(16653, '', '', '', '', '', '女子拒搭讪被打死&nbsp;百度贴吧直播', '', '', ''),
    array(16641, '', '', '', '', '', '百度加速乐', '', '', ''),
    array(16634, '', '', '', '', '', '[猜]&nbsp;蘑菇系统之家', '', '', ''),
    array(16633, '', '', '', '', '', '[猜]&nbsp;系统吧', '', '', ''),
    array(16590, '', '', '', '', '', '开放式基金&nbsp;天天基金网', '', '', ''),
    array(16545, '', '', '', '', '', '面包屑导航新闻时间轴', '', '', ''),
    array(16524, '', '', '', '', '', '疑似推销', '', '', ''),
    array(16499, '', '', '', '', '', '[猜]&nbsp;港股实时行情&nbsp;-&nbsp;东方财富网', '', '', ''),
    array(16498, '', '', '', '', '', '[猜]&nbsp;股票实时行情&nbsp;-&nbsp;东方财富网', '', '', ''),
    array(16488, '', '', '', '', '', '百度知道问律师', '', '', ''),
    array(16450, '', '', '', '', '', '百度阿拉丁&nbsp;robots&nbsp;禁止抓取', '', '', ''),
    array(16448, '', '', '', '', '', '性病科&nbsp;挂号网', '', '', ''),
    array(16411, '', '', '', '', '', '百度软件中心', '', '', ''),
    array(16391, '<a target="_blank" href="', 'http://search.jd.com/Search?keyword=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '京东', '</a>|<a href="http://search.dangdang.com/?key='.$matchfk[4][$i].'" rel="external nofollow noreferrer" target="_blank">当当</a>', '', ''),
    array(16387, '', '', '', '', '', '手机&nbsp;太平洋电脑网', '', '', ''),
    array(16355, '', '', '', '', '', '[猜]&nbsp;系统之家', '', '', ''),
    array(16345, '', '', '', '', '', '[猜]&nbsp;世界杯&nbsp;网易体育', '', '', ''),
    array(16343, '', '', '', '', '', '[猜]&nbsp;NBA赛季&nbsp;新浪体育', '', '', ''),
    array(16312, '', '', '', '', '', '[猜]&nbsp;百度贴吧访谈直播', '', '', ''),
    array(16311, '<a target="_blank" href="', 'http://open.baidu.com/data/ms/nav/somesources/tag/imgu/', '', '" rel="external nofollow noreferrer', '">', '股票代码&nbsp;美股实时行情&nbsp;新浪财经', '</a>', '', ''),
    array(16309, '<a target="_blank" href="', 'http://open.baidu.com/data/ms/nav/somesources/tag/imgu/', '', '" rel="external nofollow noreferrer', '">', '股票代码&nbsp;美股实时行情&nbsp;新浪财经', '</a>', '', ''),
    array(16277, '<a target="_blank" href="', 'http://sports.sina.com.cn/g/seriea/', '', '" rel="external nofollow noreferrer', '">', '意甲&nbsp;新浪体育', '</a>', '', ''),
    array(16262, '', '', '', '', '', '带子链&nbsp;寻医问药网', '', '', ''),
    array(16228, '', '', '', '', '', '[猜]&nbsp;非中国内地明星&nbsp;伊秀娱乐&nbsp;伊秀女性网', '', '', ''),
    array(16198, '', '', '', '', '', '[猜]&nbsp;百度经验【组图】', '', '', ''),
    array(16189, '', '', '', '', '', '股票实时行情&nbsp;东方财富网', '', '', ''),
    array(16188, '', '', '', '', '', '新浪财经', '', '', ''),
    array(16184, '', '', '', '', '', '股票实时行情&nbsp;东方财富网', '', '', ''),
    array(16163, '', '', '', '', '', '[猜]&nbsp;欧冠新闻时间轴', '', '', ''),
    array(16140, '<a target="_blank" href="', 'http://www.guahao.com', '', '" rel="external nofollow noreferrer', '">', '挂号网', '</a>', '', ''),
    array(16049, '', '', '', '', '', '诈骗', '', '', ''),
    array(16048, '', '', '', '', '', '寻医问药网', '', '', ''),
    array(16047, '', '', '', '', '', '百度在线翻译', '', '', ''),
    array(16035, '', '', '', '', '', '[猜]&nbsp;旅游目的地推荐&nbsp;-&nbsp;百度旅游', '', '', ''),
    array(15988, '', '', '', '', '', '动漫&nbsp;腾讯视频', '', '', ''),
    array(15964, '', '', '', '', '', '专辑&nbsp;百度音乐', '', '', ''),
    array(15958, '', '', '', '', '', '电视剧&nbsp;腾讯视频', '', '', ''),
    array(15940, '<a target="_blank" href="', 'http://sports.sina.com.cn/g/laliga/', '', '" rel="external nofollow noreferrer', '">', '西甲&nbsp;新浪体育', '</a>', '', ''),
    array(15929, '', '', '', '', '', '[猜]&nbsp;软件下载&nbsp;太平洋电脑网', '', '', ''),
    array(15883, '<a target="_blank" href="', 'http://ask.seowhy.com/question/8497', '', '" rel="external nofollow noreferrer" title="百度搜索结果页，都什么情况下会出现直链？', '">', '代名词 百度快照在2013年09月-2013年10月间', '</a>', '', ''),
    array(15863, '', '', '', '', '', '小道消息&nbsp;手机中国', '', '', ''),
    array(15858, '', '', '', '', '', '单机游戏网', '', '', ''),
    array(15820, '', '', '', '', '', '速尔快递客服电话', '', '', ''),
    array(15817, '', '', '', '', '', '普通官网', '', '', ''),
    array(15791, '', '', '', '', '', '[猜]&nbsp;快递电话', '', '', ''),
    array(15785, '', '', '', '', '', '口袋巴士', '', '', ''),
    array(15772, '', '', '', '', '', '逗游', '', '', ''),
    array(15765, '', '', '', '', '', '世界杯新闻轴', '', '', ''),
    array(15758, '<a target="_blank" href="', 'http://ask.seowhy.com/question/14936', '', '" rel="external nofollow noreferrer', '">', '慧聪网B2B', '</a>', '', ''),
    array(15751, '', '', '', '', '', '齐家网', '', '百度收购', ''),
    array(15728, '', '', '', '', '', '起点中文网', '', '', ''),
    array(15726, '', '', '', '', '', '起点中文网', '', '', ''),
    array(15720, '', '', '', '', '', '百度经验', '', '', ''),
    array(15678, '', '', '', '', '', '巴西队赛程&nbsp;网易体育', '', '', ''),
    array(15648, '', '', '', '', '', '[猜]&nbsp;旅游攻略&nbsp;百度旅游', '', '', ''),
    array(15623, '', '', '', '', '', '报价及图片_太平洋汽车网', '', '', ''),
    array(15584, '<a target="_blank" href="', 'http://zhanzhang.baidu.com/', '', '" rel="external nofollow noreferrer', '">', '百度站长平台', '</a>', '', ''),
    array(15560, '', '', '', '', '', '中关村在线', '', '', ''),
    array(15557, '', '', '', '', '', '[猜]&nbsp;中公教育', '', '', ''),
    array(15547, '<a target="_blank" href="', 'http://www.yuemei.com/', '', '" rel="external nofollow noreferrer', '">', '整形美容&nbsp;-&nbsp;悦美网', '</a>', '', ''),
    array(15516, '<a target="_blank" href="', 'http://name.renren.com/', '', '" rel="external nofollow noreferrer', '">', '人人网同名搜索', '</a>', '', ''),
    array(15515, '', '', '', '', '', '人人网同名搜索', '', '', ''),
    array(15460, '', '', '', '', '', '中国足彩网', '', '', ''),
    array(15442, '', '', '', '', '', '疾病百科&nbsp;39健康网', '', '', ''),
    array(15388, '', '', '', '', '', '手机中国', '', '', ''),
    array(15357, '', '', '', '', '', 'hao123汽车|hao123头条', '', '', ''),
    array(15295, '', '', '', '', '', '畛域_百度视频', '', '', ''),
    array(15279, '', '', '', '', '', '客服电话', '', '', ''),
    array(15232, '', '', '', '', '', '百度轻应用', '', '', ''),
    array(15213, '<a target="_blank" href="', 'http://www.yuemei.com/parts_price.html', '', '" rel="external nofollow noreferrer', '">', '整形报价大全&nbsp;悦美整形网', '</a>', '', ''),
    array(15200, '<a target="_blank" href="', 'http://movie.douban.com/subject_search?search_text=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '豆瓣电影', '</a>', '', ''),
    array(15198, '', '', '', '', '', '考研时间安排&nbsp;新浪教育', '', '', ''),
    array(15195, '', '', '', '', '', '不凡游戏网', '', '', ''),
    array(15110, '', '', '', '', '', '好大夫在线', '', '', ''),
    array(15109, '', '', '', '', '', '[猜]&nbsp;疾病&nbsp;好大夫在线', '', '', ''),
    array(15056, '', '', '', '', '', '天极下载', '', '', ''),
    array(15017, '', '', '', '', '', '热点&nbsp;网易体育', '', '', ''),
    array(14994, '', '', '', '', '', '伊秀娱乐明星库', '', '', ''),
    array(14966, '<a target="_blank" href="', 'http://v.baidu.com/v?ie=utf-8&amp;word=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '百度视频&nbsp;相关视频', '</a>', '', ''),
    array(14955, '', '', '', '', '', '实物价格&nbsp;和讯黄金', '', '', ''),
    array(14907, '', '', '', '', '', '分集剧情介绍&nbsp;电视猫', '', '', ''),
    array(14861, '', '', '', '', '', '[猜]&nbsp;选手&nbsp;乐视网', '', '', ''),
    array(14726, '', '', '', '', '', '热点&nbsp;网易娱乐', '', '', ''),
    array(14713, '', '', '', '', '', '[猜]&nbsp;目的地指南&nbsp;百度旅游', '', '', ''),
    array(14664, '', '', '', '', '', '爱卡汽车网', '', '', ''),
    array(14611, '', '', '', '', '', 'hao123小游戏', '', '', ''),
    array(14584, '', '', '', '', '', '[猜]&nbsp;百度团购官网', '', '', ''),
    array(14580, '', '', '', '', '', 'Zinch', '', '', ''),
    array(14545, '', '', '', '', '', '品牌词', '', '', ''),
    array(14515, '', '', '', '', '', '[猜]&nbsp;新浪微博|58同城|百度卫士|百度影音|铁路客户服务中心', '', '', ''),
    array(14510, '', '', '', '', '', '[猜]&nbsp;58同城|淘宝网', '', '', ''),
    array(14480, '<a target="_blank" href="', 'http://sports.sohu.com/s2004/zhongjia.shtml', '', '" rel="external nofollow noreferrer', '">', '中甲&nbsp;搜狐体育', '</a>', '', ''),
    array(14474, '', '', '', '', '', '百度投诉中心', '', '', ''),
    array(14466, '', '', '', '', '', '汽车点评', '', '百度收购', ''),
    array(14452, '<a target="_blank" href="', 'http://tousu.baidu.com/webmaster/add', '', '" rel="external nofollow noreferrer', '">', '快照删除与更新&nbsp;百度投诉', '</a>', '', ''),
    array(14435, '', '', '', '', '', '[猜]&nbsp;聊天通讯&nbsp;-&nbsp;百度软件中心', '', '', ''),
    array(14421, '', '', '', '', '', '时刻表&nbsp;发车间隔&nbsp;同程网', '', '', ''),
    array(14331, '', '', '', '', '', '百度经验【图文】', '', '', ''),
    array(14305, '', '', '', '', '', '百度网盘', '', '', ''),
    array(14287, '', '', '', '', '', '股吧&nbsp;-&nbsp;东方财富网', '', '', ''),
    array(14283, '', '', '', '', '', '股吧&nbsp;-&nbsp;东方财富网', '', '', ''),
    array(14181, '', '', '', '', '', '[猜]社交网络&nbsp;-&nbsp;ipush', '', '', ''),
    array(14175, '<a target="_blank" href="', 'http://euro2012.sina.com.cn/', '', '" rel="external nofollow noreferrer', '">', '欧洲杯', '</a>', '', ''),
    array(14142, '', '', '', '', '', '[猜]&nbsp;系统吧', '', '', ''),
    array(14134, '', '', '', '', '', '[猜]&nbsp;百度图片 医疗健康', '', '', ''),
    array(14110, '', '', '', '', '', '中国天气网', '', '', ''),
    array(14098, '<a target="_blank" href="', 'http://yz.chsi.com.cn/', '', '" rel="external nofollow noreferrer', '">', '中国研究生招生信息网', '</a>', '', ''),
    array(14062, '', '', '', '', '', 'hao123折扣导航', '', '', ''),
    array(14060, '<a target="_blank" href="', 'http://yingjian.baidu.com/', '', '" rel="external nofollow noreferrer', '">', '百度硬件', '</a>', '', ''),
    array(14059, '', '', '', '', '', '[猜]&nbsp;马槽&nbsp;百度经验', '', '', ''),
    array(14058, '', '', '', '', '', '电影&nbsp;百度团购', '', '', ''),
    array(14022, '', '', '', '', '', '旅游景点&nbsp;百度经验【组图】', '', '', ''),
    array(14004, '', '', '', '', '', '挂号网', '', '', ''),
    array(13932, '', '', '', '', '', '企业官方贴吧', '', '', ''),
    array(13920, '', '', '', '', '', '产品报价&nbsp;中关村在线', '', '', ''),
    array(13911, '', '', '', '', '', '手机&nbsp;天极网', '', '', ''),
    array(13885, '', '', '', '', '', '[猜]&nbsp;百度卫士&nbsp;更多知道相关问题&gt;&gt;百度知道', '', '', ''),
    array(13863, '', '', '', '', '', '百度火车票', '', '', ''),
    array(13854, '', '', '', '', '', '电影&nbsp;-&nbsp;腾讯视频', '', '', ''),
    array(13842, '', '', '', '', '', '旅游攻略&nbsp;百度旅游', '', '', ''),
    array(13841, '', '', '', '', '', '英语四六级考试查分&nbsp;考试吧', '', '', ''),
    array(13823, '', '', '', '', '', 'hao123下载站', '', '', ''),
    array(13806, '', '', '', '', '', '附近电影院&nbsp;时光网', '', '', ''),
    array(13798, '', '', '', '', '', '支付宝客服电话|百度用户服务中心', '', '', ''),
    array(13750, '', '', '', '', '', '7k7k小游戏', '', '', ''),
    array(13747, '', '', '', '', '', '网页游戏&nbsp;7k7k小游戏', '', '', ''),
    array(13741, '', '', '', '', '', '实时路况', '', '', ''),
    array(13717, '', '', '', '', '', '左侧知心&nbsp;电视剧&nbsp;爱奇艺', '', '', ''),
    array(13706, '', '', '', '', '', '[猜]&nbsp;腾讯彩票', '', '', ''),
    array(13679, '', '', '', '', '', '现货价格&nbsp;和讯黄金', '', '', ''),
    array(13631, '', '', '', '', '', '比赛进程&nbsp;乐视网', '', '', ''),
    array(13630, '', '', '', '', '', '[猜]&nbsp;中国内地明星&nbsp;伊秀娱乐&nbsp;伊秀女性网', '', '', ''),
    array(13627, '', '', '', '', '', '亚冠赛程结果&nbsp;新浪体育', '', '', ''),
    array(13620, '<a target="_blank" href="', 'http://www.baidu.com/aladdin/js/iknow/iknowask.html', '', '" rel="external nofollow noreferrer', '">', '百度知道&nbsp;ipush', '</a>', '', ''),
    array(13616, '', '', '', '', '', '二手房&nbsp;百度乐居', '', '', ''),
    array(13598, '', '', '', '', '', '猎聘网', '', '', ''),
    array(13580, '', '', '', '', '', '嫣然天使基金', '', '', ''),
    array(13466, '', '', '', '', '', '逗游网', '', '', ''),
    array(13445, '', '', '', '', '', '供应信息&nbsp;慧聪网', '', '', ''),
    array(13390, '', '', '', '', '', '腾讯动漫', '', '', ''),
    array(13369, '', '', '', '', '', '一听音乐', '', '', ''),
    array(13360, '<a target="_blank" href="', 'http://tieba.baidu.com/f?kw=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '[猜]&nbsp;百度贴吧', '</a>', '', ''),
    array(13355, '', '', '', '', '', '短信&nbsp;爱祝福', '', '', ''),
    array(13336, '', '', '', '', '', '墨迹天气', '', '', ''),
    array(13310, '', '', '', '', '', '手机品牌&nbsp;太平洋电脑网', '', '', ''),
    array(13264, '<a target="_blank" href="', 'http://open.baidu.com/data/ms/nav/somesources/tag/ctw/', '', '" rel="external nofollow noreferrer', '">', '畅途网&nbsp;百度数据开放平台合作伙伴', '</a>', '', ''),
    array(13260, '', '', '', '', '', '汽车百科知识&nbsp;汽车点评', '', '', ''),
    array(13255, '', '', '', '', '', '1', '', '', ''),
    array(13231, '<a target="_blank" href="', 'http://sports.sina.com.cn/g/ucl/fixtures.html', '', '" rel="external nofollow noreferrer', '">', '欧洲冠军联赛&nbsp;-&nbsp;新浪体育', '</a>', '', ''),
    array(13216, '', '', '', '', '', '影讯&nbsp;最近上映电影&nbsp;Mtime时光网', '', '', ''),
    array(13174, '', '', '', '', '', '列车时刻表查询及在线预订&nbsp;去哪儿', '', '', ''),
    array(13118, '', '', '', '', '', '比赛进程&nbsp;百度视频', '', '', ''),
    array(13111, '', '', '', '', '', '中国红十字基金会', '', '', ''),
    array(13096, '', '', '', '', '', '百度团购', '', '', ''),
    array(13039, '', '', '', '', '', '客服电话&nbsp;去哪儿', '', '', ''),
    array(13031, '<a target="_blank" href="', 'http://open.baidu.com/data/ms/nav/somesources/tag/zgtq/', '', '" rel="external nofollow noreferrer', '">', '城市天气预报&nbsp;中国天气网', '</a>', '', ''),
    array(12967, '', '', '', '', '', '百度软件', '', '', ''),
    array(12965, '<a target="_blank" href="', 'http://www.abab.com/', '', '" rel="external nofollow noreferrer', '">', 'ABAB小游戏', '</a>', '', ''),
    array(12946, '', '', '', '', '', '动漫&nbsp;爱奇艺', '', '', ''),
    array(12926, '', '', '', '', '', '[猜]&nbsp;亚信峰会直播&nbsp;凤凰网', '', '', ''),
    array(12906, '', '', '', '', '', '[猜]城市&nbsp;-&nbsp;百度团购', '', '', ''),
    array(12904, '', '', '', '', '', '[猜]&nbsp;中国网络电视台', '', '', ''),
    array(12903, '', '', '', '', '', '[猜]&nbsp;百度团购导航', '', '', ''),
    array(12901, '', '', '', '', '', '旅游攻略&nbsp;-&nbsp;百度旅游', '', '', ''),
    array(12880, '', '', '', '', '', '[猜]&nbsp;国内省市级|国外国家级目的地&nbsp;百度旅游', '', '', ''),
    array(12840, '', '', '', '', '', '百度乐居', '', '', ''),
    array(12839, '', '', '', '', '', '招远麦当劳&nbsp;新闻直播', '', '', ''),
    array(12809, '', '', '', '', '', '综艺&nbsp;爱奇艺', '', '', ''),
    array(12729, '<a target="_blank" href="', 'http://piao.baidu.com/s?wd=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '百度票务', '</a>', '', ''),
    array(12726, '', '', '', '', '', '医院&nbsp;好大夫在线', '', '', ''),
    array(12645, '', '', '', '', '', '[猜]&nbsp;轿车&nbsp;易车网', '', '', ''),
    array(12644, '', '', '', '', '', '软件排行榜&nbsp;太平洋下载', '', '', ''),
    array(12643, '', '', '', '', '', '百度团购第&nbsp;2&nbsp;种起点', '', '', ''),
    array(12616, '', '', '', '', '', '开奖查询&nbsp;百度乐彩', '', '', ''),
    array(12610, '', '', '', '', '', '汽车点评', '', '', ''),
    array(12605, '', '', '', '', '', '百度乐彩', '', '', ''),
    array(12594, '', '', '', '', '', '[猜]&nbsp;腾讯视频', '', '', ''),
    array(12558, '', '', '', '', '', '说明书&nbsp;寻医问药网', '', '', ''),
    array(12542, '', '', '', '', '', '英语四六级真题试卷&nbsp;新浪教育', '', '', ''),
    array(12521, '', '', '', '', '', '开心网会员登录', '', '', ''),
    array(12512, '', '', '', '', '', '录取分数线&nbsp;高考招生&nbsp;中国教育在线', '', '', ''),
    array(12501, '', '', '', '', '', '育儿&nbsp;太平洋亲子网', '', '', ''),
    array(12500, '', '', '', '', '', '育儿检测&nbsp;太平洋亲子网', '', '', ''),
    array(12403, '', '', '', '', '', '壹基金', '', '', ''),
    array(12391, '', '', '', '', '', '装修&nbsp;齐家网', '', '', ''),
    array(12347, '', '', '', '', '', '产品导航&nbsp;手机&nbsp;太平洋电脑网', '', '', ''),
    array(12346, '', '', '', '', '', '商户&nbsp;大众点评网', '', '', ''),
    array(12345, '', '', '', '', '', '食品营养价值&nbsp;美食天下', '', '', ''),
    array(12342, '', '', '', '', '', '[猜]&nbsp;NBA决赛&nbsp;热点直播&nbsp;网易体育', '', '', ''),
    array(12270, '', '', '', '', '', '18183&nbsp;手游网', '', '', ''),
    array(12220, '', '', '', '', '', '排行榜&nbsp;百度搜索风云榜', '', '', ''),
    array(12215, '', '', '', '', '', '今日游戏排行榜&nbsp;百度搜索风云榜', '', '', ''),
    array(12185, '', '', '', '', '', '有妖气', '', '', ''),
    array(12123, '', '', '', '', '', '专题&nbsp;百度音乐', '', '', ''),
    array(12121, '', '', '', '', '', '综艺&nbsp;风行网', '', '', ''),
    array(12118, '', '', '', '', '', '百度相册', '', '', ''),
    array(12114, '', '', '', '', '', '百度经验【组图】', '', '', ''),
    array(12102, '', '', '', '', '', '自学考试&nbsp;考试吧', '', '', ''),
    array(12097, '', '', '', '', '', '京东商城品牌', '', '', ''),
    array(12049, '', '', '', '', '', '百度推广投诉客服电话', '', '', ''),
    array(12048, '', '', '', '', '', '客服电话', '', '', ''),
    array(12021, '', '', '', '', '', '新闻时间轴', '', '', ''),
    array(11952, '', '', '', '', '', '百度口碑', '', '', ''),
    array(11940, '<a target="_blank" href="', 'http://open.baidu.com/data/ms/nav/somesources/tag/zgtq/', '', '" rel="external nofollow noreferrer', '">', '全国省份天气预报&nbsp;中国天气网', '</a>', '', ''),
    array(11939, '', '', '', '', '', '网页游戏开服表&nbsp;07073游戏网', '', '', ''),
    array(11933, '', '', '', '', '', '健身&nbsp;中国易登网', '', '', ''),
    array(11899, '', '', '', '', '', '[猜]&nbsp;维基百科|百度团购|百度杀毒', '', '', ''),
    array(11898, '', '', '', '', '', '知名网站', '', '', ''),
    array(11852, '<a target="_blank" href="', 'http://sports.sina.com.cn/global/france2/', '', '" rel="external nofollow noreferrer', '">', '法甲&nbsp;新浪体育', '</a>', '', ''),
    array(11838, '', '', '', '', '', '[猜]&nbsp;客服电话表', '', '', ''),
    array(11830, '', '', '', '', '', '百度软件中心', '', '', ''),
    array(11828, '', '', '', '', '', '融360', '', '', ''),
    array(11810, '', '', '', '', '', '区号查询', '', '', ''),
    array(11803, '', '', '', '', '', '爱漫画', '', '', ''),
    array(11782, '', '', '', '', '', '手机大全&nbsp;-&nbsp;手机中国', '', '百度收购', ''),
    array(11757, '', '', '', '', '', '爱漫画', '', '', ''),
    array(11708, '', '', '', '', '', '组图&nbsp;美食天下', '', '', ''),
    array(11692, '', '', '', '', '', '地铁&nbsp;百度地图', '', '', ''),
    array(11677, '', '', '', '', '', '网易163邮箱登录', '', '', ''),
    array(11675, '', '', '', '', '', '五笔编码汉语拼音查询&nbsp;ip138', '', '', ''),
    array(11640, '', '', '', '', '', '考试吧', '', '', ''),
    array(11620, '', '', '', '', '', '公益咨询电话', '', '', ''),
    array(11610, '', '', '', '', '', '成人高考报名时间_考试吧', '', '', ''),
    array(11582, '<a target="_blank" href="', 'http://sports.sina.com.cn/csl/', '', '" rel="external nofollow noreferrer', '">', '中超&nbsp;新浪体育', '</a>', '', ''),
    array(11547, '', '', '', '', '', '求医网', '', '', ''),
    array(11539, '', '', '', '', '', '足球联赛对战表&nbsp;新浪体育', '', '', ''),
    array(11520, '', '', '', '', '', '观后感、评论&nbsp;豆瓣电影', '', '', ''),
    array(11519, '', '', '', '', '', '影评、简介及基本信息&nbsp;豆瓣电影', '', '', ''),
    array(11490, '', '', '', '', '', '国际原油期货价格&nbsp;国际石油网', '', '', ''),
    array(11471, '', '', '', '', '', '国家授时中心标准时间', '', '', ''),
    array(11463, '<a target="_blank" href="', 'http://open.baidu.com/data/ms/nav/somesources/tag/ctw/', '', '" rel="external nofollow noreferrer', '">', '畅途网&nbsp;百度数据开放平台合作伙伴', '</a>', '', ''),
    array(11462, '', '', '', '', '', '[猜]&nbsp;官方订票电话', '', '', ''),
    array(11443, '<a target="_blank" href="', 'http://info.sports.sina.com.cn/rank/', '', '" rel="external nofollow noreferrer', '">', '国际足联排名&nbsp;新浪体育', '</a>', '', ''),
    array(11442, '', '', '', '', '', '网球世界排名&nbsp;新浪体育', '', '', ''),
    array(11439, '', '', '', '', '', '乒乓球世界排名&nbsp;新浪体育', '', '', ''),
    array(11437, '', '', '', '', '', '羽毛球世界排名&nbsp;新浪体育', '', '', ''),
    array(11436, '', '', '', '', '', '233网校', '', '', ''),
    array(11409, '', '', '', '', '', '公益咨询电话', '', '', ''),
    array(11386, '', '', '', '', '', '百度贴吧&nbsp;查看更多贴子&gt;&gt;', '', '', ''),
    array(11353, '', '', '', '', '', '[猜]&nbsp;铁路客户服务中心官网', '', '', ''),
    array(11301, '', '', '', '', '', '人民网宏观经济数据库', '', '', ''),
    array(11263, '', '', '', '', '', '中国妇女发展基金会', '', '', ''),
    array(11260, '', '', '', '', '', '百度文库认证机构', '', '', ''),
    array(11252, '', '', '', '', '', '百度文库认证作者', '', '', ''),
    array(11239, '', '', '', '', '', '中国宋庆龄基金会', '', '', ''),
    array(11228, '', '', '', '', '', '综艺节目联系方式&nbsp;爱奇艺', '', '', ''),
    array(11205, '', '', '', '', '', '新浪星座查询', '', '', ''),
    array(11196, '', '', '', '', '', '12306&nbsp;官网', '', '', ''),
    array(11175, '', '', '', '', '', '[猜]&nbsp;百度贴吧直播', '', '', ''),
    array(11170, '', '', '', '', '', '太平洋下载中心', '', '', ''),
    array(11129, '', '', '', '', '', '[猜]&nbsp;综艺节目联系方式', '', '', ''),
    array(10936, '', '', '', '', '', '英语四六级&nbsp;新浪教育', '', '', ''),
    array(10927, '', '', '', '', '', '电视节目表', '', '', ''),
    array(10904, '<a target="_blank" href="', 'http://cet.99sushe.com/', '', '" rel="external nofollow noreferrer', '">', '全国大学英语四六级考试(CET)官方成绩查询', '</a>', '', ''),
    array(10858, '', '', '', '', '', '高考分数线&nbsp;新浪高考', '', '', ''),
    array(10827, '', '', '', '', '', '高考各省市录取分数线汇总&nbsp;新浪高考', '', '', ''),
    array(10806, '', '', '', '', '', '手机中国', '', '百度收购', ''),
    array(10797, '', '', '', '', '', '装软件&nbsp;-&nbsp;hao123下载站', '', '', ''),
    array(10794, '', '', '', '', '', '电影&nbsp;爱奇艺', '', '', ''),
    array(10792, '', '', '', '', '', '快速查询&nbsp;求医网', '', '', ''),
    array(10789, '', '', '', '', '', '宜家|百度云图|世界知识产权组织|英雄联盟', '', '', ''),
    array(10788, '', '', '', '', '', '亲子百科&nbsp;太平洋亲子网', '', '', ''),
    array(10776, '', '', '', '', '', 'Mtime时光网', '', '', ''),
    array(10775, '', '', '', '', '', '影评、简介及放映时间查询&nbsp;Mtime时光网', '', '', ''),
    array(10764, '', '', '', '', '', '高考查分&nbsp;新浪高考', '', '', ''),
    array(10744, '', '', '', '', '', '考研分数线查询&nbsp;新浪教育', '', '', ''),
    array(10723, '', '', '', '', '', '考研真题试卷&nbsp;新浪教育', '', '', ''),
    array(10693, '', '', '', '', '', '世界时间&nbsp;百度开放平台', '', '', ''),
    array(10678, '', '', '', '', '', '基金吧&nbsp;天天基金网', '', '', ''),
    array(10652, '', '', '', '', '', '团体&nbsp;百度百科', '', '', ''),
    array(10646, '', '', '', '', '', '[猜]&nbsp;客船沉没', '', '', ''),
    array(10639, '', '', '', '', '', '[猜]&nbsp;中国移动客服电话', '', '', ''),
    array(10610, '', '', '', '', '', '百度招聘', '', '', ''),
    array(10594, '', '', '', '', '', '飞翔游戏', '', '', ''),
    array(10577, '', '', '', '', '', '网页游戏&nbsp;百度游戏', '', '', ''),
    array(10530, '', '', '', '', '', '药品通&nbsp;39健康网', '', '', ''),
    array(10501, '', '', '', '', '', '[猜]&nbsp;直播热点话题&nbsp;新浪娱乐', '', '', ''),
    array(10500, '', '', '', '', '', '[猜]&nbsp;微信客服&nbsp;百度知道&nbsp;更多知道相关问题&gt;&gt;', '', '', ''),
    array(10422, '', '', '', '', '', '[猜]时间轴新闻', '', '', ''),
    array(10396, '', '', '', '', '', '[猜]&nbsp;搜狐健康', '', '', ''),
    array(10393, '', '', '', '', '', '[猜]&nbsp;基于&nbsp;IP&nbsp;地理位置回答', '', '', ''),
    array(10385, '', '', '', '', '', '有道翻译', '', '', ''),
    array(10382, '', '', '', '', '', '尾号限行', '', '', ''),
    array(10319, '', '', '', '', '', '热门视频&nbsp;太平洋游戏网', '', '', ''),
    array(10317, '', '', '', '', '', '网易彩票', '', '', ''),
    array(10315, '', '', '', '', '', '开奖详情查询&nbsp;网易彩票', '', '', ''),
    array(10306, '', '', '', '', '', '资讯&nbsp;网易彩票', '', '', ''),
    array(10298, '<a target="_blank" href="', 'http://www.gov.cn/zwgk/2013-12/11/content_2546204.htm', '', '" rel="external nofollow noreferrer', '">', '2014年全年公休假放假安排&nbsp;中国政府网', '</a>', '放假通知', ''),
    array(10268, '', '', '', '', '', '百度经验【组图】', '', '', ''),
    array(10254, '', '', '', '', '', '全国猎聘网', '', '', ''),
    array(10249, '<a target="_blank" href="', 'http://drugs.dxy.cn/search/drug.htm?keyword=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '药品搜索&nbsp;丁香园', '</a>', '', ''),
    array(10244, '', '', '', '', '', '第&nbsp;2&nbsp;种百度经验', '', '', ''),
    array(10240, '', '', '', '', '', '[猜]&nbsp;开奖&nbsp;新浪彩票', '', '', ''),
    array(10239, '', '', '', '', '', '乐游网', '', '', ''),
    array(10219, '', '', '', '', '', '第&nbsp;2&nbsp;种客服电话', '', '', ''),
    array(10213, '', '', '', '', '', '易登网', '', '', ''),
    array(10210, '<a target="_blank" href="', 'http://www.showji.com/', '', '" rel="external nofollow noreferrer', '">', '手机号码归属地查询', '</a>', '', ''),
    array(10201, '', '', '', '', '', '货币基金&nbsp;天天基金网', '', '', ''),
    array(10199, '', '', '', '', '', '[猜]&nbsp;医院&nbsp;-&nbsp;悦美整形网', '', '', ''),
    array(10197, '', '', '', '', '', '[猜]&nbsp;转诊预约&nbsp;-&nbsp;好大夫在线', '', '', ''),
    array(10183, '', '', '', '', '', '时刻表&nbsp;票价&nbsp;同程网', '', '', ''),
    array(10178, '', '', '', '', '', '展现多方观点&nbsp;百度知道', '', '', ''),
    array(10175, '', '', '', '', '', '找好医院&nbsp;家庭医生在线', '', '', ''),
    array(10162, '', '', '', '', '', '装修效果图大全&nbsp;齐家网', '', '', ''),
    array(10161, '', '', '', '', '', '[猜]疾病&nbsp;寻医问药专家网', '', '', ''),
    array(10139, '', '', '', '', '', '人民币利率&nbsp;和讯网', '', '', ''),
    array(10118, '', '', '', '', '', '[猜]&nbsp;开奖&nbsp;hao123彩票', '', '', ''),
    array(10094, '', '', '', '', '', '[猜]&nbsp;开奖结果&nbsp;体坛网', '', '', ''),
    array(10077, '', '', '', '', '', '公务员考试真题试卷&nbsp;中公教育', '', '', ''),
    array(10023, '<a target="_blank" href="', 'http://sports.sina.com.cn/g/premierleague/', '', '" rel="external nofollow noreferrer', '">', '英超&nbsp;新浪体育', '</a>', '', ''),
    array(10015, '', '', '', '', '', '[猜]&nbsp;时间轴新闻&nbsp;腾讯网|新浪网', '', '', ''),
    array(8041, '<a target="_blank" href="', 'http://music.baidu.com/search?key=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '百度音乐&nbsp;歌手', '</a>', '', ''),
    array(7136, '', '', '', '', '', '就医助手&nbsp;39健康网', '', '', ''),
    array(7127, '<a target="_blank" href="', 'http://opendata.baidu.com/yaopin/s?ie=utf-8&amp;oe=utf-8&amp;wd=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '百度药品', '</a>', '', ''),
    array(7123, '', '', '', '', '', '[猜]&nbsp;好大夫在线 推荐医院', '', '', ''),
    array(7092, '', '', '', '', '', '航班信息', '', '', ''),
    array(7086, '', '', '', '', '', '4399小游戏', '', '', ''),
    array(7084, '', '', '', '', '', '点评&nbsp;中关村在线', '', '', ''),
    array(7079, '', '', '', '', '', '数码系列&nbsp;-&nbsp;中关村在线', '', '', ''),
    array(7076, '', '', '', '', '', '详情页&nbsp;-&nbsp;中关村在线', '', '', ''),
    array(7074, '', '', '', '', '', '菜谱优质结果', '', '', ''),
    array(7072, '', '', '', '', '', '[猜]&nbsp;洛克王国&nbsp;4399', '', '', ''),
    array(7032, '', '', '', '', '', '车次查询&nbsp;去哪儿', '', '', ''),
    array(7027, '', '', '', '', '', '物品&nbsp;178游戏网', '', '', ''),
    array(6869, '', '', '', '', '', '爱奇艺&nbsp;影视新生态', '', '', ''),
    array(6845, '', '', '', '', '', '小说', '', '', ''),
    array(6835, '<a target="_blank" href="', 'http://rj.baidu.com/', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', $matchfk[4][$i], '</a>', '', ''),
    array(6833, '', '', '', '', '', '百度百科&nbsp;多义词', '', '', ''),
    array(6832, '', '', '', '', '', '旅游景点大全', '', '', ''),
    array(6827, '<a target="_blank" href="', 'http://www.baidu.com/#wd=', $query.' 失信被执行人', '" rel="external nofollow noreferrer', '">', $query.'由于失信已被列入国家失信被执行人名单', '</a>', '', ''),
    array(6826, '<a target="_blank" href="', 'http://shixin.court.gov.cn/', '', '" rel="external nofollow noreferrer', '">', '该企业已被列入全国失信被执行人名单中！', '</a>', '', ''),
    array(6819, '<a target="_blank" href="', 'http://shixin.court.gov.cn/', '', '" rel="external nofollow noreferrer', '">', '全国法院失信被执行人名单', '</a>', '', ''),
    array(6817, '', '', '', '', '', '百度视频', '', '', ''),
    array(6811, '', '', '', '', '', '百度音乐', '', '', ''),
    array(6804, '', '', '', '', '', '最新报价&nbsp;配置&nbsp;图片&nbsp;口碑&nbsp;油耗&nbsp;易车网', '', '', ''),
    array(6801, '', '', '', '', '', '车型&nbsp;-&nbsp;易车网', '', '', ''),
    array(6735, '<a target="_blank" href="', 'http://zhanzhang.baidu.com/wiki/256', '', '" rel="external nofollow noreferrer', '">', 'site特型', '</a>', '', ''),
    array(6727, '', '', '', '', '', '[猜]&nbsp;左侧动漫作品', '', '', ''),
    array(6714, '', '', '', '', '', '最佳答案', '', '', ''),
    array(6705, '', '', '', '', '', '电视剧榜单', '', '', ''),
    array(6700, '', '', '', '', '', '电影&nbsp;-&nbsp;百度团购', '', '', ''),
    array(6691, '', '', '', '', '', '歌曲&nbsp;-&nbsp;百度音乐', '', '', ''),
    array(6690, '', '', '', '', '', '电影&nbsp;-&nbsp;百度视频', '', '', ''),
    array(6680, '', '', '', '', '', '百度购物搜索', '', '', ''),
    array(6677, '', '', '', '', '', '网页应用&nbsp;百度阿拉丁', '', '', ''),
    array(6670, '', '', '', '', '', '百度团购', '', '', ''),
    array(6666, '', '', '', '', '', '百度招聘搜索', '', '', ''),
    array(6665, '', '', '', '', '', '百度招聘会搜索', '', '', ''),
    array(6653, '', '', '', '', '', '[猜]&nbsp;百度知心最佳答案', '', '', ''),
    array(6112, '', '', '', '', '', '[猜]&nbsp;电视剧&nbsp;百度视频', '', '', ''),
    array(6018, '', '', '', '', '', '日历', '', '', ''),
    array(6017, '', '', '', '', '', '最新汇率', '', '', ''),
    array(6014, '<a target="_blank" href="', 'http://www.baidu.com/aladdin/js/iknow/iknowask.html', '', '" rel="external nofollow noreferrer', '">', '提问到百度知道', '</a>', '', ''),
    array(6009, '', '', '', '', '', '万年历', '', '', ''),
    array(6007, '', '', '', '', '', '计算器', '', '', ''),
    array(6006, '<a target="_blank" href="', 'http://www.ip138.com/ips138.asp?ip=', $query, '" rel="external nofollow noreferrer', '">', 'IP地址查询', '</a>', '', ''),
    array(6004, '<a target="_blank" href="', 'http://www.showji.com/search.htm?m=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '手机归属地', '</a>', '', ''),
    array(91, '<a target="_blank" href="', 'http://baike.baidu.com/search?word=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '百度百科_多义词', '</a>', '', ''),
    array(85, '<a target="_blank" href="', 'http://fanyi.baidu.com/#en/zh/', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '百度翻译', '</a>|<a href="http://dict.baidu.com/s?wd='.$matchfk[4][$i].'" rel="external nofollow noreferrer" target="_blank">百度词典</a>', '', ''),
    array(81, '<a target="_blank" href="', 'http://baike.baidu.com/search?word=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '百度百科_多义词', '</a>', '', ''),
    array(80, '<a target="_blank" href="', 'http://baike.baidu.com/search?word=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '百度百科专有名词', '</a>', '', ''),
    array(10, '<a target="_blank" href="', 'http://tieba.baidu.com/f?kw=', $matchfk[4][$i], '" rel="external nofollow noreferrer', '">', '百度贴吧', '</a>', '', ''),
    );

        foreach ($srcidspa as $ii => $positioni) {
            if ($matchfk[1][$i] == $srcidspa[$ii][0]) {
                echo $srcidspa[$ii][1].$srcidspa[$ii][2].$srcidspa[$ii][3].$srcidspa[$ii][4].$srcidspa[$ii][5].$srcidspa[$ii][6].$srcidspa[$ii][7];
            }
        }

        echo '
                </td>
                <td>
                    <a href="http://www.weixingon.com/baidusp-op.php?srcid='.$matchfk[1][$i].'&amp;s='.$matchfk[4][$i].'" target="_blank" rel="external nofollow noreferrer">'
                        .$matchfk[1][$i]
                    .'</a>
                </td>
                <td>
                    '.$matchfk[6][$i].'
                </td>
            </tr>';
    }
    echo '
        </tbody>
    </table>
</div>';
}

// search product

if (preg_match_all('/(?<="  srcid=")(\d{1,5})("  id=")(\d{1,2})(?=" tpl=")/', @$baiduserp, $matchsp))

// 百度搜索产品，来源，排名

if (strlen($s) > 0) {
    echo '
<div class="draglist" draggable="true">
    <table>
        <thead>
            <tr>
                <th>'.$srcid3.'</th>
                <th>'.$nofk.'</th>
                <th>排名</th>
            </tr>
        </thead>
        <tbody>';

$srcidsp = array (
    array(29250, '<a target="_blank" href="', 'http://jiankang.baidu.com/healthStar/index?wd=', $query, '" rel="external nofollow noreferrer', '">', '十二星座健康运势&nbsp;百度健康', '</a>', '', ''),
    array(29205, '<a target="_blank" href="', 'http://jiaoyu.baidu.com/query/exam?classId=2007&amp;originQuery=', $query, '" rel="external nofollow noreferrer', '">', '高等教育自学考试&nbsp;百度教育', '</a>', '', ''),
    array(29204, '<a target="_blank" href="', 'http://jiaoyu.baidu.com/query/exam?originQuery=', $query, '" rel="external nofollow noreferrer', '">', '考试&nbsp;百度教育', '</a>', '', ''),
    array(29200, '<a target="_blank" href="', 'http://jiaoyu.baidu.com/query/exam?originQuery=', $query, '" rel="external nofollow noreferrer', '">', '考试&nbsp;百度教育', '</a>', '', ''),
    array(29181, '', '', '', '', '', '产品大全&nbsp;百度财富', '', '', ''),
    array(29166, '<a target="_blank" href="', 'http://iwan.baidu.com/search?query=', $query, '" rel="external nofollow noreferrer', '">', '页游&nbsp;开始游戏&nbsp;百度爱玩', '</a>', '', ''),
    array(29152, '', '', '', '', '', '游戏专区&nbsp;17173', '', '', ''),
    array(29140, '', '', '', '', '', '二手车&nbsp;百度汽车', '', '', ''),
    array(29129, '', '', '', '', '', '开始游戏&nbsp;百度爱玩', '', '', ''),
    array(29127, '<a target="_blank" href="', 'http://iwan.baidu.com/search?searchquery=', $query, '" rel="external nofollow noreferrer', '">', '百度爱玩', '</a>', '', ''),
    array(29120, '<a target="_blank" href="', 'http://iwan.baidu.com/yeyou?query=', $query, '" rel="external nofollow noreferrer', '">', '热门网页游戏平台&nbsp;百度爱玩', '</a>', '', ''),
    array(29118, '', '', '', '', '', '百度品牌特卖', '', '', ''),
    array(29116, '', '', '', '', '', '百度品牌特卖', '', '', ''),
    array(29114, '', '', '', '', '', '百度品牌特卖', '', '', ''),
    array(29099, '', '', '', '', '', '百度教育考试', '', '', ''),
    array(29096, '<a target="_blank" href="', 'http://jiaoyu.baidu.com/query/abroad?originQuery=', $query, '" rel="external nofollow noreferrer', '">', '留学图片资讯&nbsp;百度教育', '</a>', '', ''),
    array(29094, '', '', '', '', '', '百度教育迷你相关课程', '', '', ''),
    array(29093, '', '', '', '', '', '机构&nbsp;百度教育', '', '', ''),
    array(29090, '', '', '', '', '', '课程&nbsp;百度教育', '', '', ''),
    array(29089, '<a target="_blank" href="', 'http://jiankang.baidu.com/juhe/index?aType=1&amp;wd=', $query, '" rel="external nofollow noreferrer', '">', '百度健康', '</a>', '', ''),
    array(29088, '', '', '', '', '', '混合&nbsp;-&nbsp;百度健康', '', '', ''),
    array(29087, '', '', '', '', '', '[猜]&nbsp;百度知心_健康_知识_图片', '', '', ''),
    array(29083, '<a target="_blank" href="', 'http://yao.xywy.com/so/?q=', $query, '" rel="external nofollow noreferrer', '">', '药品频道&nbsp;寻医问药网&nbsp;百度健康', '</a>', '', ''),
    array(29081, '<a target="_blank" href="', 'http://jiankang.baidu.com/shoushu/base?wd=', $query, '" rel="external nofollow noreferrer', '">', '手术&nbsp;百度健康', '</a>', '', ''),
    array(29080, '', '', '', '', '', '知识图片&nbsp;-&nbsp;百度健康', '', '', ''),
    array(29070, '<a target="_blank" href="', 'http://iwan.baidu.com/yeyou?query=', $query, '" rel="external nofollow noreferrer', '">', '网页游戏&nbsp;百度爱玩', '</a>', '', ''),
    array(29051, '<a target="_blank" href="', 'http://weigou.baidu.com/search?q=', $query, '" rel="external nofollow noreferrer', '">', '百度微购', '</a>', '', ''),
    array(28093, '', '', '', '', '', '去哪儿网门票频道', '', '', ''),
    array(28092, '', '', '', '', '', '去哪儿网门票频道', '', '', ''),
    array(28072, '', '', '', '', '', '去哪儿网酒店预定查询频道', '', '', ''),
    array(28057, '', '', '', '', '', '去哪儿度假频道', '', '', ''),
    array(28056, '', '', '', '', '', '[猜]&nbsp;去哪儿度假频道', '', '', ''),
    array(28054, '', '', '', '', '', '机票查询&nbsp;去哪儿', '', '', ''),
    array(28050, '<a target="_blank" href="', 'http://zhidao.baidu.com/search?word=', $query, '" rel="external nofollow noreferrer', '">', '疾病&nbsp;百度知道', '</a>', '', ''),
    array(28042, '', '', '', '', '', '地图&nbsp;第&nbsp;2&nbsp;版&nbsp;百度旅游', '', '', ''),
    array(28041, '', '', '', '', '', '地图&nbsp;第&nbsp;2&nbsp;版&nbsp;百度旅游', '', '', ''),
    array(28040, '', '', '', '', '', '景点介绍&nbsp;第&nbsp;2&nbsp;版&nbsp;百度旅游', '', '', ''),
    array(28025, '', '', '', '', '', '[猜]&nbsp;百度团购首页格', '', '', ''),
    array(28022, '<a target="_blank" href="', 'http://map.baidu.com/?newmap=1&amp;ie=utf-8&amp;s=s%26wd%3D', $query, '" rel="external nofollow noreferrer', '">', '百度地图', '</a>', '', ''),
    array(28010, '<a target="_blank" href="', 'http://map.baidu.com/?newmap=1&amp;ie=utf-8&amp;s=s%26wd%3D', $query, '" rel="external nofollow noreferrer', '">', '百度地图&nbsp;城市', '</a>', '', ''),
    array(28002, '<a target="_blank" href="', 'http://map.baidu.com/?newmap=1&amp;ie=utf-8&amp;s=s%26wd%3D', $query, '" rel="external nofollow noreferrer', '">', '百度地图', '</a>', '', ''),
    array(27994, '<a target="_blank" href="', 'http://zhidao.baidu.com/qiye', '', '" rel="external nofollow noreferrer', '">', '【企业问答】', '</a>', '', ''),
    array(27003, '', '', '', '', '', '携程攻略', '', '', ''),
    array(27002, '', '', '', '', '', '携程攻略', '', '', ''),
    array(6680, '<a target="_blank" href="', 'http://gouwu.baidu.com/s?wd=', $query, '" rel="external nofollow noreferrer', '">', '百度购物搜索', '</a>', '', ''),
    array(4004, '', '', '', '', '', '快递查询&nbsp;快递100', '', '', ''),
    array(4002, '', '', '', '', '', '单位换算&nbsp;百度阿拉丁', '', '', ''),
    array(4001, '', '', '', '', '', '快递查询&nbsp;快递100', '', '', ''),
    array(1547, '', '', '', '', '', '百度百科[201407添加]', '', '', ''),
    array(1542, '', '', '', '', '', '百度学术&nbsp;查看更多相关论文', '', '', ''),
    array(1537, '', '', '', '', '', '组图&nbsp;百度经验', '', '', ''),
    array(1536, '', '', '', '', '', '一般答案&nbsp;百度知道', '', '', ''),
    array(1532, '', '', '', '', '', '最佳答案&nbsp;百度知道', '', '', ''),
    array(1527, '', '', '', '', '', '百度文库标签&nbsp;更多文库相关文档&gt;&gt;', '', '', ''),
    array(1521, '<a target="_blank" href="', 'http://baike.baidu.com/search?word=', $query, '" rel="external nofollow noreferrer', '">', '图片&nbsp;百度百科(可能与查询词内容相关度较高)', '</a>', '', ''),
    array(101, '', '', '', '', '', '[猜]&nbsp;沙盒保护', '', '', ''),
    array(43, '<a target="_blank" href="', 'http://zhidao.baidu.com/new?ie=utf8&word=', $query, '" rel="external nofollow noreferrer', '">', '去百度知道提问', '</a>', '', ''),
    array(37, '', '', '', '', '', '最新图片', '', '', ''),
    array(34, '<a target="_blank" href="', 'http://www.baidu.com/s?rtt=2&tn=baiduwb&cl=2&wd=', $query, '" rel="external nofollow noreferrer', '">', '最新微博结果', '</a>', '', ''),
    array(23, '<a target="_blank" href="', 'http://fanyi.baidu.com/#en/zh/', $query, '" rel="external nofollow noreferrer', '">', '百度翻译', '</a>', '', ''),
    array(19, '<a target="_blank" href="', 'http://www.baidu.com/s?tn=baidurt&amp;rtt=1&amp;bsst=1&amp;wd=', $query, '" rel="external nofollow noreferrer', '">', '最新相关消息', '</a>', '', ''),
    array(5, '<a target="_blank" href="', 'http://music.baidu.com/search?key=', $query, '" rel="external nofollow noreferrer', '">', '百度音乐', '</a>', '', ''),
    array(4, '<a target="_blank" href="', 'http://image.baidu.com/i?ie=utf-8&amp;tn=baiduimage&amp;ct=201326592&amp;word=', $query, '" rel="external nofollow noreferrer', '">', '百度图片', '</a>', '', ''),
    array(1, '<a target="_blank" href="', 'http://v.baidu.com/v?ie=utf-8&amp;word=', $query, '" rel="external nofollow noreferrer', '">', '百度视频', '</a>', '', ''),
    );

    foreach ($matchsp[3] as $i => $position) {
        echo '
            <tr class="back-orange center">
                <td>';

        foreach ($srcidsp as $ii => $positioni) {
            if ($matchsp[1][$i] == $srcidsp[$ii][0]) {
                echo $srcidsp[$ii][1].$srcidsp[$ii][2].$srcidsp[$ii][3].$srcidsp[$ii][4].$srcidsp[$ii][5].$srcidsp[$ii][6].$srcidsp[$ii][7];
            }
        }
        echo '
                </td>
                <td>'.$matchsp[1][$i].'</td>
                <td>'.$matchsp[3][$i].'</td>
            </tr>';
    }
    echo '
        </tbody>
    </table>
</div>';
}

// 相关搜索

if (strlen($s) > 0) {

    if (preg_match_all("/(?<=&rs_src=)([01]{1}&rsv_pq=[a-z0-9]{16}&rsv_t=[\w\%]{50,64}\">)([\x80-\xff\w\s\.#\:\/]{0,32})(?=<\/a><\/th><)/", $baiduserp, $matchrelated)) {

        // 随机更换下拉框提示 IP
        $sugip = array (
            'http://115.239.211.11',
            'http://115.239.211.12',
            'http://180.97.33.72',
            'http://180.97.33.73',
            );
        shuffle ($sugip);

        // 匹配百度搜索3种下拉框提示词
        $p3 = array (
            '/window\.baidu\.sug\({q:/',
            '/p:false,s:\[/',
            '/}\);/',
            );
        $r3 = array (
            '[',
            '',
            '',
        );
        $sug1 = json_decode(file_get_contents($sugip[0].'/su?action=opensearch&ie=UTF-8&wd='.$query));
        $sug2 = json_decode(file_get_contents($sugip[0].'/su?action=opensearch&ie=UTF-8&sugmode=2&wd='.$query));
        $sug3 = json_decode(preg_replace($p3, $r3, file_get_contents($sugip[0].'/su?ie=UTF-8&sugmode=3&p=1&wd='.$query)));

        echo '
<div class="draglist" draggable="true">
<table>
        <thead>
                <tr>
                    <th>相关搜索</th>
                    <th>下拉框提示模式&nbsp;I</th>
                    <th>下拉框提示模式&nbsp;II</th>
                    <th><a href="http://ask.seowhy.com/article/109" rel="external nofollow noreferrer" target="_blank" title="百度相关提示与搜索结果标题">下拉框提示模式&nbsp;III</a></th>
                    <th>排名</th>
                </tr>
        </thead>
        <tbody>';

        for ($i = 0; $i <= 9; $i++) {
            echo '
            <tr class="back-azure">
                <td>
                    <a href="'.$url.'?s='.@$matchrelated[2][$i].'" target="_blank">'
                        .@$matchrelated[2][$i].'
                    </a>
                </td>
                <td>';
            if (strlen(@$sug1[1][$i]) > 0) {
                echo '
                    <a href="'.$url.'?s='.preg_replace('/(\s+)/', '%20', @$sug1[1][$i]).'" target="_blank">'
                        .@$sug1[1][$i].'
                    </a>';
            }
            echo '
                </td>
                <td>';
            if (strlen(@$sug2[1][$i]) > 0) {
                echo '
                    <a href="'.$url.'?s='.preg_replace('/(\s+)/', '%20', @$sug2[1][$i]).'" target="_blank">'
                        .@$sug2[1][$i].'
                    </a>';
            }
            echo '
                </td>
                <td>';
            if (strlen(@$sug3[1][$i]) > 0) {
                echo '
                    <a href="'.$url.'?s='.preg_replace('/(\s+)/', '%20', @$sug3[$i+1]).'" target="_blank">'
                        .@$sug3[$i+1].'
                    </a>';
            }
            echo '
                </td>
                <td class="center">'
                    .($i+1)
                .'</td>
            </tr>';
        }
        echo '
        </tbody>
    </table>
</div>';
    }
}

// 为您推荐

if (strlen($s) > 0) {

    if (preg_match_all('/(?<=&p1=)(\d{1,2})("\s\n\s+target="_blank"\s\n\s+class="m">)(.+)(<\/div><div class="c-gap-top c-recommend" style="display:none;" data-extquery=")(.+)(?="><i class="c-icon c-icon-bear-circle c-gap-right-small">)/', $baiduserp, $mcrq)) {

        if (!is_null(@$mcrq)) {
            echo '
<div class="draglist" draggable="true">
    <table>
        <thead>
                <tr>
                    <th>为您推荐</th>
                    <th>排名</th>
                </tr>
        </thead>
        <tbody>';

            foreach ($mcrq[1] as $g => $position) {
                echo '
            <tr class="back-azure">
                <td>';
                foreach ($mcrq[1] as $f => $position) {
                    $kz = (explode('&nbsp;', $mcrq[5][$g]));
                    array_pop($kz);
                    echo '
                    <a href="'.$url.'?s='.preg_replace('/(\s+)/', '%20', @$kz[$f]).'" target="_blank">'
                        .@$kz[$f]
                    .'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
                echo '</td>
                <td class="center">'
                    .@$mcrq[1][$g]
                .'</td>
            </tr>';
            }
            echo '
        </tbody>
    </table>
</div>';
        }
    }
}

if (strlen($s) > 0) {

    // F

    if (preg_match_all("/(?<=F':)(\s?)(')([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})(?=',)/", $baiduserp, $matchf)) {
        echo '
<div class="draglist" draggable="true">
    <table>
        <thead>
            <tr>
                <th>'.$F[1].'</th>
                <th>'.$F[2].'</th>
                <th>'.$F[3].'</th>
                <th>'.$F[4].'</th>
                <th>'.$F[5].'</th>
                <th>'.$F[6].'</th>
                <th>'.$F[7].'</th>
                <th>'.$F[8].'</th>
                <th>F0</th>
            </tr>
        </thead>
        <tbody class="center">';

        foreach ($matchf[3] as $i => $position) {
            $fvalue1 = $matchf[3][$i];
            $fvalue2 = $matchf[4][$i];
            $fvalue3 = $matchf[5][$i];
            $fvalue4 = $matchf[6][$i];
            $fvalue5 = $matchf[7][$i];
            $fvalue6 = $matchf[8][$i];
            $fvalue7 = $matchf[9][$i];
            $fvalue8 = $matchf[10][$i];
            echo '
            <tr>';

            if ($fvalue1 == '7') {
                echo '
                <td class="unit-darkseagreen">默认<br>7</td>';
            }
            elseif ($fvalue1 == 'F') {
                echo '
                <td class="unit-lightskyblue">低<br>F</td>';
            }
            elseif ($fvalue1 == '5') {
                echo '
                <td class="unit-lavender">中<br>5</td>';
            }
            elseif ($fvalue1 == '3') {
                echo '
                <td class="unit-violet">高<br>3</td>';
            }
            else {
                echo '
                <td>'.$fvalue1.'</td>';
            }

            if ($fvalue2 == '7') {
                echo '
                <td class="unit-darkseagreen">默认<br>7</td>';
            }
            elseif ($fvalue2 == 'F') {
                echo '
                <td class="unit-lightskyblue">
                    <span title="百度搜索302">[猜]&nbsp;多义词</span><br>F
                </td>';
            }
            elseif ($fvalue2 == '3') {
                echo '
                <td class="unit-violet">显示纠正搜索结果<br>3</td>';
            }
            else {
                echo '
                <td>'.$fvalue2.'</td>';
            }

            if ($fvalue3 == '8') {
                echo '
                <td class="unit-mediumpurple">默认<br>8</td>';
            }
            elseif ($fvalue3 == 'A') {
                echo '
                <td class="unit-aquamarine">
                    1.&nbsp;分类信息<br>
                    2.&nbsp;[猜]&nbsp;非正规<br>A
                </td>';
            }
            elseif ($fvalue3 == '0') {
                echo '
                <td class="unit-honeydew">影音书籍游戏软件资源<br>0</td>';
            }
            else {
                echo '
                <td>'.$fvalue3.'</td>';
            }

            if ($fvalue4 == '3') {
                echo '
                <td class="unit-violet">默认<br>3</td>';
            }
            elseif ($fvalue4 == 'F') {
                echo '
                <td class="unit-lightskyblue">快<br>F</td>';
            }
            elseif ($fvalue4 == 'B') {
                echo '
                <td class="unit-springgreen">较快<br>B</td>';
            }
            elseif ($fvalue4 == '7') {
                echo '
                <td class="unit-darkseagreen">中<br>7</td>';
            }
            else {
                echo '
                <td>'.$fvalue4.'</td>';
            }

            if ($fvalue5 == '1') {
                echo '
                <td class="unit-gold">默认<br>1</td>';
            }
            elseif ($fvalue5 == '3') {
                echo '
                <td class="unit-violet">最新资讯<br>3</td>';
            }
            else {
                echo '
                <td>'.$fvalue5.'</td>';
            }

            if ($fvalue6 == '7') {
                echo '
                <td class="unit-darkseagreen">默认<br>7</td>';
            }
            elseif ($fvalue6 == '5') {
                echo '
                <td class="unit-lavender">基于&nbsp;IP&nbsp;地理位置<br>5</td>';
            }
            elseif ($fvalue6 == '3')
                echo '
                <td class="unit-violet">
                    [猜]&nbsp;不基于&nbsp;IP&nbsp;地理位置更换结果<br>
                    但进入目标网站自会选择地域<br>3
                </td>';
            else {
                echo '
                <td>'.$fvalue6.'</td>';
            }

            if ($fvalue7 == 'E') {
                echo '
                <td class="unit-deepskyblue">默认<br>E</td>';
            }
            elseif ($fvalue7 == 'F') {
                echo '
                <td class="unit-lightskyblue">
                    <span title="“以下是网页中包含'.$s.'的结果”之上的结果">精确匹配</span><br>F
                </td>';
            }
            elseif ($fvalue7 == 'A') {
                echo '
                <td class="unit-aquamarine">A</td>';
                }
            else {
                echo '
                <td>'.$fvalue7.'</td>';
            }

            if ($fvalue8 == 'A') {
                echo '
                <td class="unit-aquamarine">精确匹配<br>A</td>';
            }
            elseif ($fvalue8 == 'B') {
                echo '
                <td class="unit-springgreen">近义词匹配<br>B</td>';
            }
            elseif ($fvalue8 == '9') {
                echo '
                <td class="unit-burlywood">9</td>';
            }
            elseif ($fvalue8 == '8') {
                echo '
                <td class="unit-mediumpurple">部分匹配<br>8</td>';
            }
            else {
                echo '
                <td>'.$fvalue8.'</td>';
            }

            echo '
                <td class="back-pink">'.@$matchsrcid[3][$i].'</td>
            </tr>';
        }
        echo '
        </tbody>
    </table>
</div>';
    }

    // F1

    if (preg_match_all("/(?<=F1':)(\s?)(')([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})(?=',)/", $baiduserp, $matchf1)) {
        echo '
<div class="draglist" draggable="true">
    <table>
        <thead>
            <tr>
                <th>'.$F1[1].'</th>
                <th>'.$F1[2].'</th>
                <th>'.$F1[3].'</th>
                <th>'.$F1[4].'</th>
                <th>'.$F1[5].'</th>
                <th>'.$F1[6].'</th>
                <th>'.$F1[7].'</th>
                <th>'.$F1[8].'</th>
                <th>F1</th>
            </tr>
        </thead>
        <tbody class="center">';

        foreach ($matchf1[3] as $i => $position) {
            $f1value1 = $matchf1[3][$i];
            $f1value2 = $matchf1[4][$i];
            $f1value3 = $matchf1[5][$i];
            $f1value4 = $matchf1[6][$i];
            $f1value5 = $matchf1[7][$i];
            $f1value6 = $matchf1[8][$i];
            $f1value7 = $matchf1[9][$i];
            $f1value8 = $matchf1[10][$i];
            echo '
        <tr>';

            if ($f1value1 == '9') {
                echo '
                <td class="unit-burlywood">默认<br>9</td>';
            }
            elseif ($f1value1 == 'D') {
                echo '
                <td class="unit-mediumseagreen">D</td>';
            }
            elseif ($f1value1 == 'B') {
                echo '
                <td class="unit-springgreen">更多文库相关文档<br>B</td>';
            }
            else {
                echo '
                <td>'.$f1value1.'</td>';
            }

            if ($f1value2 == 'D') {
                echo '
                <td class="unit-mediumseagreen">默认<br>D</td>';
            }
            elseif ($f1value2 == '9') {
                echo '
                <td class="unit-burlywood">[猜]&nbsp;匹配多个关键词<br>9</td>';
            }
            elseif ($f1value2 == '5') {
                echo '
                <td class="unit-lavender">[猜]&nbsp;布尔匹配<br>5</td>';
            }
            else {
                echo '
                <td>'.$f1value2.'</td>';
            }

            if ($f1value3 == '7') {
                echo '
                <td class="unit-darkseagreen">默认<br>7</td>';
            }
            elseif ($f1value3 == '6') {
                echo '
                <td class="unit-silver">
                    <a href="http://www.weixingon.com/baidusp-lm.php?s='.$query.'&rn=50&lm=7" target="_blank" title="yyyy年MM月dd日|hh小时前|mm分钟前|ss秒前">0-24小时前更新快照</a><br>6
                </td>';
            }
            elseif ($f1value3 == '5') {
                echo '
                <td class="unit-lavender">
                    <a href="http://www.weixingon.com/baidusp-lm.php?s='.$query.'&rn=50&lm=7" target="_blank" title="yyyy年MM月dd日">24-48小时前更新快照</a><br>5
                </td>';
            }
            elseif ($f1value3 == '4') {
                echo '
                <td class="unit-tomato">
                    <a href="http://www.weixingon.com/baidusp-lm.php?s='.$query.'&rn=50&lm=7" target="_blank" title="yyyy年MM月dd日">2-7天前更新快照</a><br>4
                </td>';
            }
            else {
                echo '
                <td>'.$f1value3.'</td>';
            }

            if ($f1value4 == '3') {
                echo '
                <td class="unit-violet">默认<br>3</td>';
            }
            elseif ($f1value4 == '2') {
                echo '
                <td class="unit-orange">24小时内多家同时报道<br>2</td>';
            }
            elseif ($f1value4 == '0') {
                echo '
                <td class="unit-honeydew">24小时内独家<br>0</td>';
            }
            else {
                echo '
                <td>'.$f1value4.'</td>';
            }

            if ($f1value5 == 'F') {
                echo '
                <td class="unit-lightskyblue">默认<br>F</td>';
            }
            elseif ($f1value5 == 'E') {
                echo '
                <td class="unit-deepskyblue">低<br>E</td>';
            }
            elseif ($f1value5 == 'B') {
                echo '
                <td class="unit-springgreen">更多知道相关问题<br>B</td>';
            }
            else {
                echo '
                <td>'.$f1value5.'</td>';
            }

            if ($f1value6 == '1') {
                echo '
                <td class="unit-gold">默认<br>1</td>';
            }
            elseif ($f1value6 == '5') {
                echo '
                <td class="unit-lavender">
                    <a href="http://www.weixingon.com/baidusp-hot.php?s='.$query.'" target="_blank" title="百度搜索热门词">新热门</a><br>5
                </td>';
            }
            elseif ($f1value6 == '3') {
                echo '
                <td class="unit-violet">
                    <a href="http://www.weixingon.com/baidusp-hot.php?s='.$query.'" target="_blank" title="百度搜索热门词">中热门</a><br>3
                </td>';
            }
            elseif ($f1value6 == '0') {
                echo '
                <td class="unit-honeydew">
                    <a href="http://www.weixingon.com/baidusp-hot.php?s='.$query.'" target="_blank" title="百度搜索热门词">老热门</a><br>0
                </td>';
            }
            else {
                echo '
                <td>'.$f1value6.'</td>';
            }

            if ($f1value7 == 'E') {
                echo '
                <td class="unit-deepskyblue">默认<br>E</td>';
            }
            elseif ($f1value7 == 'C') {
                echo '
                <td class="unit-darkturquoise">中<br>C</td>';
            }
            elseif ($f1value7 == '6') {
                echo '
                <td class="unit-silver">低<br>6</td>';
            }
            elseif ($f1value7 == '4') {
                echo '
                <td class="unit-tomato">
                    <span title="百度搜索最新权威实物微信营销指南书：微信营销出现">较低</span><br>4
                </td>';
            }
            else {
                echo '
                <td>'.$f1value7.'</td>';
            }

            if ($f1value8 == '4') {
                echo '
                <td class="unit-tomato">默认<br>4</td>';
            }
            elseif ($f1value8 == '6') {
                echo '
                <td class="unit-silver" title="搜索百度卫士出现，估计是网页内容一致，但多1个无意义参数">6</td>';
            }
            else {
                echo '
                <td>'.$f1value8.'</td>';
            }

            echo '
                <td class="back-yellow">'.@$matchsrcid[3][$i].'</td>
            </tr>';
        }
        echo '
        </tbody>
    </table>
</div>';
    }

    // F2

    if (preg_match_all("/(?<=F2':)(\s?)(')([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})(?=',)/", $baiduserp, $matchf2)) {
        echo '
<div class="draglist" draggable="true">
<table>
        <thead>
            <tr>
                <th>'.$F2[1].'</th>
                <th>'.$F2[2].'</th>
                <th>'.$F2[3].'</th>
                <th>'.$F2[4].'</th>
                <th>'.$F2[5].'</th>
                <th>'.$F2[6].'</th>
                <th>'.$F2[7].'</th>
                <th>'.$F2[8].'</th>
                <th><a href="http://ask.seowhy.com/question/8709" rel="external nofollow noreferrer" target="_blank" title="百度搜索结果参数 F2 和 rsv_sug9 探讨">F2</a></th>
            </tr>
        </thead>
        <tbody class="center">';
    
        foreach ($matchf2[3] as $i => $position) {
            $f2value1 = $matchf2[3][$i];
            $f2value2 = $matchf2[4][$i];
            $f2value3 = $matchf2[5][$i];
            $f2value4 = $matchf2[6][$i];
            $f2value5 = $matchf2[7][$i];
            $f2value6 = $matchf2[8][$i];
            $f2value7 = $matchf2[9][$i];
            $f2value8 = $matchf2[10][$i];
            echo '
            <tr>';

            if ($f2value1 == '4') {
                echo '
                <td class="unit-tomato">默认<br>4</td>';
            }
            elseif ($f2value1 == 'C') {
                echo '
                <td class="unit-darkturquoise">搜索结果与查询词深度相关<br>C</td>';
            }
            elseif ($f2value1 == '8') {
                echo '
                <td class="unit-mediumpurple">
                    <span title="只在百度搜索小米出现过">中</span><br>8
                </td>';
            }
            elseif ($f2value1 == '6') {
                echo '
                <td class="unit-silver">搜索结果与查询词广度相关<br>6</td>';
            }
            else {
                echo '
                <td>'.$f2value1.'</td>';
            }

            if ($f2value2 == 'C') {
                echo '
                <td class="unit-darkturquoise">默认<br>C</td>';
            }
            elseif ($f2value2 == 'E') {
                echo '
                <td class="unit-deepskyblue">
                    <span title="百度搜索百度贴吧，nba出现">[猜]&nbsp;搜索结果展现网址与目标网址不同</span><br>E
                </td>';
            }
            elseif ($f2value2 == 'D') {
                echo '
                <td class="unit-mediumseagreen">
                    <span title="百度搜索淘出现">D</span>
                </td>';
            }
            elseif ($f2value2 == '8') {
                echo '
                <td class="unit-darkseagreen">
                    1.&nbsp;更多贴吧相关帖子&gt;&gt;<br>
                    2.&nbsp;未知<br>8
                </td>';
            }
            else {
                echo '
                <td>'.$f2value2.'</td>';
            }

            if ($f2value3 == 'A') {
                echo '
                <td class="unit-aquamarine">默认<br>A</td>';
            }
            elseif ($f2value3 == 'E') {
                echo '
                <td class="unit-deepskyblue">
                    <span title="百度搜索淘宝|淘宝网|当当网出现">E</span>
                </td>';
            }
            elseif ($f2value3 == '8') {
                echo '
                <td class="unit-mediumpurple">8</td>';
            }
            elseif ($f2value3 == '2') {
                echo '
                <td class="unit-gold">
                    标语<br>
                    slogan<br>2
                </td>';
            }
            else {
                echo '
                <td>'.$f2value3.'</td>';
            }

            if ($f2value4 == '6') {
                echo '
                <td class="unit-silver">默认<br>6</td>';
            }
            elseif ($f2value4 == '7') {
                echo '
                <td class="unit-darkseagreen">
                    [猜]&nbsp;使用百度排名点击器(搜easy)出现<br>7
                </td>';
            }
            else {
                echo '
                <td>'.$f2value4.'</td>';
            }

            if ($f2value5 == 'D') {
                echo '
                <td class="unit-mediumseagreen">默认<br>D</td>';
            }
            elseif ($f2value5 == 'C') {
                echo '
                <td class="unit-darkturquoise">C</td>';
            }
            else {
                echo '
                <td>'.$f2value5.'</td>';
            }

            if ($f2value6 == 'D') {
                echo '
                <td class="unit-mediumseagreen">默认<br>D</td>';
            }
            elseif ($f2value6 == 'F') {
                echo '
                <td class="unit-lightskyblue">无<br>F</td>';
            }
            elseif ($f2value6 == 'E') {
                echo '
                <td class="unit-deepskyblue">少<br>E</td>';
            }
            elseif ($f2value6 == 'C') {
                echo '
                <td class="unit-darkturquoise">多<br>C</td>';
            }
            else {
                echo '
                <td>'.$f2value6.'</td>';
            }

            if ($f2value7 == '6') {
                echo '
                <td class="unit-silver">
                    无<br>
                    no<br>6
                </td>';
            }
            elseif ($f2value7 == 'E') {
                echo '
                <td class="unit-deepskyblue">
                    链接锚文本<br>
                    anchor_text<br>E
                </td>';
            }
            else {
                echo '
                <td>'.$f2value7.'</td>';
            }

            if ($f2value8 == 'B') {
                echo '
                <td class="unit-springgreen">
                    网页标题<br>
                    title<br>B
                </td>';
            }
            elseif ($f2value8 == 'F') {
                echo '
                <td class="unit-lightskyblue">
                    <a href="http://www.weixingon.com/wordcount/#exp" target="_blank" title="名词解释">权值标签里的文本&nbsp;(-)&nbsp;网页标题</a><br>F
                </td>';
            }
            elseif ($f2value8 == 'E') {
                echo '
                <td class="unit-deepskyblue">
                    权值标签<br>
                    tag<br>E
                </td>';
            }
            elseif ($f2value8 == 'A') {
                echo '
                <td class="unit-aquamarine">
                    无<br>
                    no<br>A
                </td>';
            }
            elseif ($f2value8 == '8') {
                echo '
                <td class="unit-mediumpurple">
                    网址<br>
                    url<br>8
                </td>';
            }
            else {
            echo '
                <td>'.$f2value8.'</td>';
            }

            echo '
                <td class="back-green">'.@$matchsrcid[3][$i].'</td>
            </tr>';
        }
        echo'
        </tbody>
    </table>
</div>';
    }

    // F3

    if (preg_match_all("/(?<=F3':)(\s?)(')([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})(?=',)/", $baiduserp, $matchf3)) {
        echo '
<div class="draglist" draggable="true">
    <table>
        <thead>
            <tr>
                <th>'.$F3[1].'</th>
                <th>'.$F3[2].'</th>
                <th>'.$F3[3].'</th>
                <th>'.$F3[4].'</th>
                <th>'.$F3[5].'</th>
                <th>'.$F3[6].'</th>
                <th>'.$F3[7].'</th>
                <th>'.$F3[8].'</th>
                <th><a href="http://ask.seowhy.com/article/41" rel="external nofollow noreferrer" target="_blank" title="对吴星关于“F系列”参数研究的看法">F3</a></th>
            </tr>
        </thead>
        <tbody class="center">';

        foreach ($matchf3[3] as $i => $position) {
            $f3value1 = $matchf3[3][$i];
            $f3value2 = $matchf3[4][$i];
            $f3value3 = $matchf3[5][$i];
            $f3value4 = $matchf3[6][$i];
            $f3value5 = $matchf3[7][$i];
            $f3value6 = $matchf3[8][$i];
            $f3value7 = $matchf3[9][$i];
            $f3value8 = $matchf3[10][$i];
            echo '
            <tr>';

            if ($f3value1 == '5') {
                echo '
                <td class="unit-lavender">默认<br>5</td>';
            }
            elseif ($f3value1 == 'D') {
                echo '
                <td class="unit-mediumseagreen">D</td>';
            }
            else {
                echo '
                <td>'.$f3value1.'</td>';
            }

            if ($f3value2 == '4') {
                echo '
                <td class="unit-tomato">默认<br>4</td>';
            }
            else {
                echo '
                <td>'.$f3value2.'</td>';
            }

            if ($f3value3 == 'E') {
                echo '
                <td class="unit-deepskyblue">默认<br>E</td>';
            }
            elseif ($f3value3 == 'F') {
                echo '
                <td class="unit-lightskyblue">
                    <span title="百度搜索合肥SEO出现">F</span><br>F
                </td>';
            }
            else {
                echo '
                <td>'.$f3value3.'</td>';
            }

            if ($f3value4 == '5') {
                echo '
                <td class="unit-lavender">默认<br>5</td>';
            }
            elseif ($f3value4 == '7') {
                echo '
                <td class="unit-darkseagreen">最低<br>7</td>';
            }
            elseif ($f3value4 == '6') {
                echo '
                <td class="unit-silver">6</td>';
            }
            elseif ($f3value4 == '3') {
                echo '
                <td class="unit-violet">星火计划 [原创]<br>3</td>';
            }
            elseif ($f3value4 == '2') {
                echo '
                <td class="unit-orange">星火计划 [原创]<br>2</td>';
            }
            elseif ($f3value4 == '1') {
                echo '
                <td class="unit-gold">星火计划 [原创]<br>1</td>';
            }
            elseif ($f3value4 == '0') {
                echo '
                <td class="unit-honeydew">
                    星火计划 [原创]<br>
                    最高<br>0
                </td>';
            }
            else {
                echo '
                <td>'.$f3value4.'</td>';
            }

            if ($f3value5 == '2') {
                echo '
                <td class="unit-orange">
                    主域名、子域名<br>
                    优先级较低<br>
                    或内容相对充实的目录、详情页<br>2
                </td>';
            }
            elseif ($f3value5 == 'B') {
                echo '
                <td class="unit-springgreen">
                    目录|详情页<br>
                    优先级较高<br>B
                </td>';
            }
            elseif ($f3value5 == 'A') {
                echo '
                <td class="unit-aquamarine">
                    主域名、子域名<br>
                    优先级较高<br>
                    或内容相对充实的目录、详情页<br>A
                </td>';
            }
            elseif ($f3value5 == '6') {
                echo '
                <td class="unit-violet">6</td>';
            }
            elseif ($f3value5 == '3') {
                echo '
                <td class="unit-violet">
                    目录|详情页<br>
                    优先级较低<br>3
                </td>';
            }
            elseif ($f3value5 == '1') {
                echo '
                <td class="unit-gold">1</td>';
            }
            elseif ($f3value5 == '0') {
                echo '
                <td class="unit-honeydew">0</td>';
            }
            else {
                echo '
                <td>'.$f3value5.'</td>';
            }

            if ($f3value6 == '4') {
                echo '
                <td class="unit-tomato">默认<br>4</td>';
            }
            elseif ($f3value6 == 'C') {
                echo '
                <td class="unit-darkturquoise">C</td>';
            }
            elseif ($f3value6 == '6') {
                echo '
                <td class="unit-silver">6</td>';
            }
            elseif ($f3value6 == '2') {
                echo '
                <td class="unit-orange">2</td>';
            }
            elseif ($f3value6 == '0') {
                echo '
                <td class="unit-honeydew">
                    <span title="百度搜索杨澜爸爸|第一女神出现">有同义词的搜索结果页<br>完全匹配查询词</span><br>0
                </td>';
            }
            else {
                echo '
                <td>'.$f3value6.'</td>';
            }

            if ($f3value7 == '3') {
                echo '
                <td class="unit-violet">默认<br>3</td>';
            }
            elseif ($f3value7 == '2') {
                echo '
                <td class="unit-orange">2</td>';
            }
            elseif ($f3value7 == '1') {
                echo '
                <td class="unit-gold">
                    <span title="搜索微信开发源代码出现">1</span>
                </td>';
            }
            else {
                echo '
                <td>'.$f3value7.'</td>';
            }

            if ($f3value8 == 'F') {
                echo '
                <td class="unit-lightskyblue">精确匹配<br>F</td>';
            }
            elseif ($f3value8 == 'E') {
                echo '
                <td class="unit-deepskyblue">近义词匹配<br>E</td>';
            }
            elseif ($f3value8 == 'D') {
                echo '
                <td class="unit-mediumseagreen">D</td>';
            }
            elseif ($f3value8 == 'C') {
                echo '
                <td class="unit-darkturquoise">C</td>';
            }
            elseif ($f3value8 == '7') {
                echo '
                <td class="unit-darkseagreen">匹配网址<br>7</td>';
            }
            elseif ($f3value8 == '6') {
                echo '
                <td class="unit-silver">6</td>';
            }
            elseif ($f3value8 == '5') {
                echo '
                <td class="unit-lavender">近似匹配<br>5</td>';
            }
            elseif ($f3value8 == '4') {
                echo '
                <td class="unit-tomato">
                    <span title="百度搜索bj.baidu后台维护出现">4</span>
                </td>';
            }
            else {
                echo '
                <td>'.$f3value8.'</td>';
            }

            echo '
                <td class="back-blue">'.@$matchsrcid[3][$i].'</td>
            </tr>';
        }
        echo '
        </tbody>
    </table>
</div>';
    }

}

// 摘要

if (strlen($s) > 0) {

    if (preg_match_all('/(?<=<div class="c-abstract">)(.*)(?=<\/div><div class="f13">)/', $baiduserp, $matchabstract)) {
        echo '
<div class="draglist" draggable="true">
    <table>
        <thead>
            <tr>
                <th>摘要<br>abstract</th>
                <th>排序</th>
            </tr>
        </thead>
        <tbody>';

        foreach ($matchabstract[1] as $i => $position) {
            echo '
            <tr class="back-gold">
                <td>'.strip_tags($matchabstract[1][$i]).'</td>
                <td class="center">'.($i+1).'</td>
            </tr>';
        }
        echo '
        </tbody>
    </table>
</div>';
    }
}

if (strlen($s) > 0) {

    // template

    if (preg_match_all('/(?<=" tpl=")([0-9a-z_]{3,28})(?=")/', $baiduserp, $matchtemplate)) {

        // y

        if (preg_match_all("/(?<='y':')([0-9A-F]{8})(?=')/", $baiduserp, $matchy)) {

            echo '
<div class="draglist" draggable="true">
    <table>
        <thead>
            <tr>
                <th>模版 template</th>
                <th>'.$y.'</th>
                <th>排序</th>
            </tr>
        </thead>
        <tbody>';

            foreach ($matchtemplate[1] as $i => $position) {
                echo '
            <tr class="back-sky">
                <td>'.$matchtemplate[1][$i].'</td>
                <td class="center">'.@$matchy[1][$i].'</td>
                <td class="center">'.($i+1).'</td>
            </tr>';
            }
        echo '
        </tbody>
    </table>
</div>';    
        }
    }
}

// 右侧知心打分

if (strlen($s) > 0) {

    $score = json_decode(file_get_contents
    ('http://opendata.baidu.com/api.php?resource_id=21028&format=json&ie=utf-8&oe=utf-8&query='.$query), true);

    if (is_array(@$score['data'][0]['card'][0]['unit'])) {
        echo '
<div class="draglist" draggable="true">
    <table>
        <thead>
            <tr>
                <th>右侧知心推荐词</th>
                <th>打分</th>
                <th>排名</th>
            </tr>
        </thead>
        <tbody>';

        foreach ($score['data'][0]['card'] as $i => $position) {

            foreach ($score['data'][0]['card'][$i]['unit'] as $j => $position) {
                echo '
        <tr class="back-egg">
            <td class="center">
                <a href="'.$url.'?s='.$score['data'][0]['card'][$i]['unit'][$j]['name'].'" target="_blank">'
                    .$score['data'][0]['card'][$i]['unit'][$j]['name']
                .'</a>
            </td>
            <td class="center">';

                // 对齐分值
                $scores = ((preg_replace('/(score=)/', '', $score['data'][0]['card'][$i]['unit'][$j]['uri_drsv'])) * 10000);

                if (preg_match('/(\d){4}/', $scores)) {
                echo $scores;
                }
                elseif (preg_match('/(\d){3}/', $scores)) {
                echo '0'.$scores;
                }
                elseif (preg_match('/(\d){2}/', $scores)) {
                echo '00'.$scores;
                }
                elseif (preg_match('/(\d){1}/', $scores)) {
                echo '000'.$scores;
                }
                else {
                echo $scores;
                }
            echo '</td>
            <td class="center">'.($j+1).'</td>
        </tr>';
            }
        }
        echo '
        </tbody>
    </table>
</div>';
    }
}

// 周围人都在搜

if (strlen($s) > 0) {

    if (preg_match_all('/(?<=&r_type=text&r_key=hot-1&r_wd=)(.{1,50})(?=" class=link data-type=hl-mod-link target=)/', file_get_contents("http://entry.baidu.com/ur/scun?di=contentunion4170"), $maround)) {
        echo '
<div class="draglist" draggable="true">
    <table>
        <thead>
            <tr>
                <th>周围人都在搜</th>
            </tr>
        </thead>
        <tbody>
            <tr class="back-azure">
                <td>';

        foreach ($maround[0] as $i => $position) {
            echo '
                    <a href="'.$url.'?s='.$maround[0][$i].'" target="_blank">'
                        .$maround[0][$i]
                    .'</a>&nbsp;&nbsp;&nbsp;&nbsp;';
        }
    echo '
                </td>
            </tr>
        </tbody>
    </table>
</div>';
    }
}
if (strlen($s) > 0) {
    echo '
<p>
    <a class="noa" href="http://www.weixingon.com/baiduip.php" target="_blank">百度的IP地址是多少</a>
    <a class="noa" href="https://github.com/ausdruck/baidu-prm/blob/master/baidu-f.php" target="_blank" rel="external nofollow noreferrer">百度参数分析工具v1.22</a>
</p>';
}

    $costTime = microtime(true) - $startTime;
    echo '
<p class="white">本次查询耗时&nbsp;'.sprintf('%.2f', ($costTime * 1000)).'&nbsp;毫秒，
其中百度查询耗时&nbsp;'.@$matchsrvt[1].'&nbsp;毫秒</p>
';

?>
</div>
<script charset="gbk" src="http://www.baidu.com/js/opensug.js"></script>
<script src="http://www.weixingon.com/javascript/j.js"></script>
<script>
(new GoTop()).init( {
    pageWidth: 1022,
    nodeId: 'go-top',
    nodeWidth: 100,
    distanceToBottom: 200,
    distanceToPage: 0,
    hideRegionHeight: 130,
    text: '&nbsp;&nbsp;顶&nbsp;部&nbsp;&nbsp;'
    }
)

// 拖放功能
var $ = function (selector) {

    if (!selector) {
        return [];
    }

    var arrEle = [];

    if (document.querySelectorAll) {
        arrEle = document.querySelectorAll(selector);
    }

    else {
        var oAll = document.getElementsByTagName('div'), lAll = oAll.length;

        if (lAll) {
            var i = 0;

            for (i; i < lAll; i += 1) {

                if (/^\./.test(selector)) {

                    if (oAll[i].className === selector.replace(".", "")) {
                        arrEle.push(oAll[i]);
                    }

                }

                else if(/^#/.test(selector)) {

                    if (oAll[i].id === selector.replace('#', '')) {
                        arrEle.push(oAll[i]);
                    }
                }
            }
        }
    }

    return arrEle;
};

var eleDustbin = $('.dustbin')[0],
    eleDrags = $('.draglist'),
    lDrags = eleDrags.length,
    eleDrag = null;

for (var i = 0; i < lDrags; i += 1) {

    eleDrags[i].onselectstart = function() {
        return false;
    };

    eleDrags[i].ondragstart = function(ev) {
        ev.dataTransfer.effectAllowed = 'move';
        ev.dataTransfer.setData('text', ev.target.innerHTML);
        ev.dataTransfer.setDragImage(ev.target, 0, 0);
        eleDrag = ev.target;
        return true;
    };

    eleDrags[i].ondragend = function(ev) {
        ev.dataTransfer.clearData('text');
        eleDrag = null;
        return false
    };

}

eleDustbin.ondragover = function(ev) {
    ev.preventDefault();
    return true;
};

eleDustbin.ondragenter = function(ev) {
    this.style.color = '#FFDDAA';
    return true;
};

eleDustbin.ondrop = function(ev) {

    if (eleDrag) {
        eleDrag.parentNode.removeChild(eleDrag);
    }

    this.style.color = '#000000';
    return false;
};

// 百度下拉框提示

//回调函数，用于获取用户当前选择的文字
function show(str) {
    txtObj.innerHTML = str;
}

var params = {
//  'XOffset': 0,               // 提示框位置横向偏移量,单位 px
//  'YOffset': 0,               // 提示框位置纵向偏移量,单位 px
//  'width': 204,               // 提示框宽度，单位 px
//  'fontColor': '#f70',        // 提示框文字颜色
    'fontColorHI': '#000000',   // 提示框高亮选择时文字颜色
    'fontSize': '16px',         // 文字大小
    'fontFamily': 'Helvetica',  // 文字字体
    'borderColor': '#DDDDDD',   // 提示框的边框颜色
    'bgcolorHI': '#DDDDDD',     // 提示框高亮选择的颜色
    'sugSubmit': true           // 在选择提示词条是是否提交表单
};

BaiduSuggestion.bind('sug', params, show);
</script>
</body>
</html>