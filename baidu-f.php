<!DOCTYPE html>
<!--这是百度搜索结果参数分析工具 PHP 源码，若不知如何在浏览器打开，可加入百度参数QQ交流群(255363059)-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="cmn-Hans" xml:lang="cmn-Hans">
<head>
<meta charset="UTF-8">
<?php
// 自动生成标题 v2.6

// 请手动修改 url 对应网址、标题后缀、百度实时推送接口、伪静态、关于我
$url = 'http://'.$_SERVER['HTTP_HOST'].'/baidu-f.php';
$pt = '百度搜索结果参数';
$api = '';
// 百度实时推送接口示例 $api = 'http://data.zz.baidu.com/urls?site=www.weixingon.com&token=EzNWsyWaxYSUdtJO';
$l = '?s=';
$about = '
';

// 云体检通用漏洞防护补丁 v1.1

$url_arr = array (
    'xss' => "\\=\\+\\/v(?:8|9|\\+|\\/)|\\%0acontent\\-(?:id|location|type|transfer\\-encoding)",
);

$args_arr = array (
    'xss' => "[\\'\\\"\\;\\*\\<\\>].*\\bon[a-zA-Z]{3,15}[\\s\\r\\n\\v\\f]*\\=|\\b(?:expression)\\(|\\<script[\\s\\\\\\/]|\\<\\!\\[cdata\\[|\\b(?:eval|alert|prompt|msgbox)\\s*\\(|url\\((?:\\#|data|javascript)",
    'sql' => "[^\\{\\s]{1}(\\s|\\b)+(?:select\\b|update\\b|insert(?:(\\/\\*.*?\\*\\/)|(\\s)|(\\+))+into\\b).+?(?:from\\b|set\\b)|[^\\{\\s]{1}(\\s|\\b)+(?:create|delete|drop|truncate|rename|desc)(?:(\\/\\*.*?\\*\\/)|(\\s)|(\\+))+(?:table\\b|from\\b|database\\b)|into(?:(\\/\\*.*?\\*\\/)|\\s|\\+)+(?:dump|out)file\\b|\\bsleep\\([\\s]*[\\d]+[\\s]*\\)|benchmark\\(([^\\,]*)\\,([^\\,]*)\\)|(?:declare|set|select)\\b.*@|union\\b.*(?:select|all)\\b|(?:select|update|insert|create|delete|drop|grant|truncate|rename|exec|desc|from|table|database|set|where)\\b.*(charset|ascii|bin|char|uncompress|concat|concat_ws|conv|export_set|hex|instr|left|load_file|locate|mid|sub|substring|oct|reverse|right|unhex)\\(|(?:master\\.\\.sysdatabases|msysaccessobjects|msysqueries|sysmodules|mysql\\.db|sys\\.database_name|information_schema\\.|sysobjects|sp_makewebtask|xp_cmdshell|sp_oamethod|sp_addextendedproc|sp_oacreate|xp_regread|sys\\.dbms_export_extension)",
    'other' => "\\.\\.[\\\\\\/].*\\%00([^0-9a-fA-F]|$)|%00[\\'\\\"\\.]");

$referer = empty($_SERVER['HTTP_REFERER']) ? array() : array($_SERVER['HTTP_REFERER']);
$query_string = empty($_SERVER["QUERY_STRING"]) ? array() : array($_SERVER["QUERY_STRING"]);

check_data($query_string, $url_arr);
check_data($_GET, $args_arr);
check_data($_POST, $args_arr);
check_data($_COOKIE, $args_arr);
check_data($referer, $args_arr);

function W_log($log) {
    $logpath = $_SERVER["DOCUMENT_ROOT"]."/log.txt";
    $log_f = fopen($logpath, "a+");
    fputs($log_f, $log."\r\n");
    fclose($log_f);
}

function check_data($arr, $v) {
    foreach($arr as $key => $value) {
        if (!is_array($key)) {
            check($key, $v);
        }
        else {
            check_data($key, $v);
        }
        if (!is_array($value)) {
            check($value, $v);}
        else {
            check_data($value, $v);
        }
    }
}

function check($str, $v) {
    foreach($v as $key => $value) {
        if (preg_match("/".$value."/is", $str) == 1||preg_match("/".$value."/is", urlencode($str)) == 1) {
            echo '<title>已过滤跨站脚本攻击漏洞, 到别处看看罢</title>';
            exit();
        }
    }
}

echo '<title>';

// 取得搜索词
$s = @$_GET['s'];

// 过滤字符串
if (strlen($s) > 0) {
    $p = array ('/(\s+)/', '/(http:\/\/)/');
    $r = array ('%20', '');
    $z = preg_replace($p[1], $r[1], $s);
    $query = htmlspecialchars(preg_replace($p, $r, $s));

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
            '180.97.33.73'
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

        // 主动推送
        $ch = curl_init();
        $options = array (
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => 'http:'.$url.$l.$query,
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            echo "cURL Error: " . curl_error($ch);
        }
        curl_close ($ch);
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
echo $pt.',F,F1,F2,F3" name="keywords" />
<meta name="apple-mobile-web-app-title" content="';
if (strlen($s) > 0) {
    echo htmlspecialchars($z, ENT_QUOTES).'_'.$pt;
}
echo '" />
<link rel="canonical" href="http:'.$url.$l.$query.'" />
';
?>
<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0,minimal-ui" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta name="author" content="吴星, maasdruck@gmail.com" />
<link rel="alternate" type="application/rss+xml" title="百度搜索结果参数 RSS Feed" href="//www.weixingon.com/feed.xml" />

<!--css-->

<style type="text/css">
body,div,h1 {
    margin: 0;
}

body {
    color: #222222;
    background-color: #F8F7F5;
    font-family:
        "Helvetica Neue",
        Helvetica,
        "Hiragino Sans GB",
        "Microsoft YaHei",
        Arial,
        sans-serif;
    height: 100%;
}

h1 {
    font-size: 1.75em;
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

.pink {
    color: #FFC0CB;
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

.other {
    padding: .125em .3125em .25em .3125em;
    height: 2em;
    width: 5em;
    outline: none;
}

.submit {
    height: 2.625em;
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

.break {
    word-break: break-all;
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

.left_outer,.right_outer,.non,.dustbin {
    display: none!important;
}

@media screen and (min-width: 1024px) {
    .dustbin {
        display: block!important;
        margin-top: 3em;
        width: 5em;
        height: 19.25em;
        background-color: #E6E6E6;
        font-size: 1.3em;
        text-shadow: -0.0625em -0.0625em #BBBBBB;
        float: left;
    }

    .dustbin:after {
    content:'按住表格 拖曳到这';
    }

    .draglist:hover {
        border-color: #FFFFBB;
        background-color: #FFDDAA;
    }

    .non {
        display: block!important;
    }

    .text {
        padding: .125em .3125em .25em .3125em;
        height: 2em;
        width: 17em;
        outline: none;
    }

    .left_outer,.right_outer {
        display: block!important;
        position: fixed;
        left: 0;
        right: 0;
        top: 1.25em;
        color: #717375;
        text-align: center;
    }
    .left_inner,.right_inner {
        position: relative;
        width: 46.25em;
        margin-left: auto;
        margin-right: auto;
    }
    .left {
        position: absolute;
        left: -150px;
        top: 42px;
        padding: 8px;
        border: 0.0625em solid #d9dadc;
        background-color: #FFFFFF;
    }
    .left,.right p {
        font-size: 0.875em;
        line-height: 1.25em;
    }

    .right {
        position: absolute;
        right: -150px;
        top: 42px;
        padding: 8px;
        border: 0.0625em solid #d9dadc;
        background-color: #FFFFFF;
    }
}

.dis {
    display: none!important;
}

@media screen and (max-width: 1023px) {
    .dis {
        display: block!important;
   }

    .text {
        padding: .125em .3125em .25em .3125em;
        height: 2em;
        width: 12.5em;
        outline: none;
    }
}
</style>
</head>
<body>
<!--拖放-->
<div class="dustbin center" style="display: block;"></div>
<div class="detail">
<!--搜索框-->
    <div class="header center non">
<?php
echo '        <form method="get" action="'.$url.'">
            <a href="'.$url.'" rel="nofollow">
                <canvas id="myCanvas" width="52" height="26">
                    no canvas
                </canvas>
            </a>
            <script type="text/javascript">
            var canvas = document.getElementById("myCanvas");
                if(canvas.getContext) {  
                    var ctx = canvas.getContext("2d");
                    ctx.font = "24px Helvetica Neue";
                    ctx.fillStyle = "#FF6347";
                    ctx.fillText("百度", 0, 24);
                }
            </script>
';
echo '            <input class="text" type="text" value="'.htmlspecialchars(@$_GET['s'] ,ENT_QUOTES).'" name="s" title="解析" autocomplete="off" maxlength="76" id="sug" autofocus="autofocus" placeholder="请输入查询词" onmouseover="this.focus()" onfocus="this.select()">
';
echo '            <input class="other" type="number" name="pn" title="从第几位开始取结果" min="0" max="750" value="'.@$_GET['pn'].'" placeholder="取第几位">
';
echo '            <input class="other" type="number" name="rn" title="搜索结果数量" min="0" max="50" value="'.@$_GET['rn'].'" placeholder="返回数量">
';
echo '            <select title="搜索结果时间限制" name="gpc">
';
echo '                <option value="">全部时间</option>
';
echo '                <option value="stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1"';
if (@$_GET['gpc'] == 'stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1') {
    echo 'selected';
}
echo '>最近1天</option>
';
echo '                <option value="stf%3D'.(time() - 604800).'%2C'.time().'%7Cstftype%3D1"';
if (@$_GET['gpc'] == 'stf%3D'.(time() - 604800).'%2C'.time().'%7Cstftype%3D1') {
    echo 'selected"';
}
echo '>最近1週</option>
';
echo '                <option value="stf%3D'.(time() - 2678400).'%2C'.time().'%7Cstftype%3D1"';
if (@$_GET['gpc'] == 'stf%3D'.(time() - 2678400).'%2C'.time().'%7Cstftype%3D1') {
    echo 'selected"';
}
echo '>最近1月</option>
';
echo '                <option value="stf%3D'.(time() - 31536000).'%2C'.time().'%7Cstftype%3D1"';
if (@$_GET['gpc'] == 'stf%3D'.(time() - 31536000).'%2C'.time().'%7Cstftype%3D1') {
    echo 'selected"';
}
echo '>最近1年</option>
            </select>
            <input class="submit" type="submit" value="百度一下">
        </form>
    </div>
    <div class="header center dis">
        <form method="get" action="'.$url.'">
            <input class="text" type="text" value="'.htmlspecialchars(@$_GET['s'] ,ENT_QUOTES).'" name="s" title="解析" autocomplete="off" maxlength="76" baiduSug="1" placeholder="请输入查询词" onmouseover="this.focus()" onfocus="this.select()">
            <input class="submit" type="submit" value="百度一下">
        </form>
    </div>
';

// 打开网页显示相关资料

if (strlen($s) == 0) {
    echo '    <div class="back-yellow" style="padding: 1em;">
        <h1 class="center bold">百度搜索结果参数相关资料</h1>
        <hr>
        <p><a href="//www.weixingon.com/wordcount/" target="_blank">字数统计工具_百度搜索结果标题长度研究</a><br>
编著者 吴星 发布于 2014年10月10日，上海<br>
分类 百度参数<br>
使用主流的中文环境操作系统，浏览器等(字符编码为 UTF-8, GB2312, BIG5 等)，展示在百度中文搜索结果页(字符编码为 UTF-8, GB2312, BIG5 等)的网页型标题，长度限制为 3－63 字节(2 byte &lt; title 长度 &lt; 64 byte)，如果 F 参数所指的标题策略是 F2 = xxxxxx6B，短于 3 字节或超过 63 字节的非百度产品的普通结果(AS)会自动截断，并增加省略符号 "…"，截断后加上省略符号的 title 长度限制为 3－64 字节。</p>
        <hr>
        <p><a href="//www.weixingon.com/chaolianfenxi.html" target="_blank">超链文件检索系统和方法</a><br>
编著者 李彦宏 发布于 1999年07月06日，纽约<br>
分类 搜索引擎技术<br>
一个与根据超链指向的查询索引文档相关，用于检索文档的搜索引擎。它的索引器遍历超文本数据库并寻找包括超链指向的文档地址与每个超链锚文本在内的超文本信息。超文本信息是贮存在一个倒排索引文件里，这个倒排索引文件亦可用于计算对于各超链指向的特定文档链接向量。输入查询时候，搜索引擎找到锚文本里含有查询词的全部文档向量。与此同时计算了查询向量，然后算出查询向量跟每个文档链接向量的点积。锚文本里含有查询词的全部文档相关点积的加总决定了每一个文档的相关性排名。</p>
        <hr>
        <p><a href="//www.weixingon.com/par.html" target="_blank">百度 HTTP 接口参数</a><br>
编著者 吴星 发布于 2014年09月02日，上海<br>
分类 百度参数<br>
百度上线“全网寻人平台”。为了打通互联网全部寻人信息，百度随即启动全网寻人平台的开发和相关资源的协调，经过30多个小时的努力，“百度全网寻人平台”正式上线。用户登陆百度首页，搜索“雅安寻人”等热门关键词即可进入寻人平台。同时百度全网寻人平台同步对外开放，所有寻人平台的信息都可接入。</p>';
    echo $about.'    </div>';
}

if (strlen($s) > 0) {
    $pn = @$_GET['pn'];
    $rn = @$_GET['rn'];
    $gpc = @$_GET['gpc'];
    $cpn = "&pn=";
    $crn = "&rn=";
    $cgpc = "&gpc=";
    $p = array ('/(\s+)/', '/(http:\/\/)/');
    $r = array ('+', '');
    $z = preg_replace($p[1], $r[1], $s);
    $query = htmlspecialchars(preg_replace($p, $r, $s));
    $F[1] = '<span title="搜索结果标题|摘要与查询词的语义关联度">语义关联</span>';
    $F[2] = '同音词';
    $F[3] = '[猜]正规性';
    $F[4] = '[猜]更新';
    $F[5] = '[猜]实时度';
    $F[6] = '<a href="//ask.seowhy.com/article/121" target="_blank" rel="external nofollow noreferrer" title="百度搜索结果参数F第6位基于IP位置">基于IP位置</a>';
    $F[7] = '网址';
    $F[8] = '标题|网址|摘要';
    $F1[1] = '第1位';
    $F1[2] = '第2位';
    $F1[3] = '<a href="//ask.seowhy.com/question/8958" target="_blank" rel="external nofollow noreferrer" title="快照时间显示，以小时为单位">时间限制</a>';
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
    $F2[7] = '<a href="//seo.qiankoo.com/813" target="_blank" rel="external nofollow noreferrer" title="百度搜索结果参数F2与搜索结果标题的关系">前标题</a>';
    $F2[8] = '<a href="//ask.seowhy.com/question/8411" target="_blank" rel="external nofollow noreferrer" title="百度搜索结果参数F2">后标题</a>';
    $F3[1] = '第1位';
    $F3[2] = '第2位';
    $F3[3] = '第3位';
    $F3[4] = '<a href="//ask.seowhy.com/article/30" target="_blank" rel="external nofollow noreferrer" title="百度搜索结果参数F3 - 域名选择与原创内容时效性">[猜]时效性</a>';
    $F3[5] = '<a href="//ask.seowhy.com/article/46" target="_blank" rel="external nofollow noreferrer" title="百度搜索结果参数F3 - 超越域名选择的含义">[猜]网址形式</a>';
    $F3[6] = '第6位';
    $F3[7] = '第7位';
    $F3[8] = '[猜]相似度';
    $y = '<a href="//ask.seowhy.com/article/53" target="_blank" rel="external nofollow noreferrer" title="百度搜索结果页参数y - 验证码与工具">y&nbsp;验证码&nbsp;nonce</a>';

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
                $se = file_get_contents($baidu.$query.$cpn.$pn.$crn.$rn.$cgpc.$gpc);
            }
            else {
                $se = file_get_contents($baidu.$query.$cpn.$pn.$crn.$rn);
            }
        }
        elseif (strlen($gpc) > 0) {
            $se = file_get_contents($baidu.$query.$cpn.$pn.$cgpc.$gpc);
        }
        else {
            $se = file_get_contents($baidu.$query.$cpn.$pn);
        }
    }
    elseif (strlen($rn) > 0) {
        if (strlen($gpc) > 0) {
            $se = file_get_contents($baidu.$query.$crn.$rn.$cgpc.$gpc);
        }
        else {
            $se = file_get_contents($baidu.$query.$crn.$rn);
        }
    }
    elseif (strlen($gpc) > 0) {
        $se = file_get_contents($baidu.$query.$cgpc.$gpc);
    }
    else
        $se = file_get_contents($baidu.$query);

    // 确定时间

    date_default_timezone_set('PRC');
    clearstatcache();

    // 搜索结果数量

    if (preg_match('/(?<=百度为您找到相关结果)([\x80-\xff]{0,3})([0-9,]{1,11})(?=个<\/div>)/', @$se, $mnum))

    // 百度服务器返回的 Unix 时间戳

    if (preg_match("/(?<='T':')(\d{10})(?=',)/", $se, $mservertime))

    // 搜索结果链接，数量

    echo '    <h1 class="center white">
        <a class="noa" target="_blank" rel="external nofollow noreferrer" href="https://www.baidu.com/s?wd='.$query;

    if (strlen($se) > 0) {
        if (strlen($pn) > 0) {
            if (strlen($rn) > 0) {
                if (strlen($gpc) > 0) {
                    echo $cpn.$pn.$crn.$rn.$cgpc.$gpc;
                }
                else {
                    echo $cpn.$pn.$crn.$rn;
                }
            }
            elseif (strlen($gpc) > 0) {
                echo $cpn.$pn.$cgpc.$gpc;
            }
            else {
                echo $cpn.$pn;
            }
        }
        elseif (strlen($rn) > 0) {
            if (strlen($gpc) > 0) {
                echo $crn.$rn.$cgpc.$gpc;
            }
            else {
                echo $crn.$rn;
            }
        }
        elseif (strlen($gpc) > 0) {
            echo $cgpc.$gpc;
        }
        echo '">
            百度“<span class="red">'.$s.'</span>”的结果
        </a>
    </h1>
    <p class="white center">
        '.$mnum[2].'&nbsp;个结果
        <a class="noa" href="//open.baidu.com/special/time/" target="_blank" rel="external nofollow noreferrer" title="现在几点？">
            '.date('Y-m-d H:i:s', $mservertime[1])
        .'</a>
    </p>';
    }

    // 冇收录

    if (preg_match('/(?<=<p>很抱歉，没有找到与<span style="font-family:宋体">“<\/span><em>)(.+)(?=<\/em><span style="font-family:宋体">”<\/span>相关的网页。<\/p>)/', @$se, $mno)) {
        echo '
<p>
    <a class="noa" href="//'.$mno[1].'" target="_blank" rel="external nofollow noreferrer" title="直接访问&nbsp;'.@$mno[2].'">
        很抱歉，没有找到与“<span class="red">'.$mno[1].'</span>”相关的网页。
    </a>
</p>
<p class="white">
    如网页存在，请<a class="noa" href="//zhanzhang.baidu.com/sitesubmit/index?sitename=http%3A%2F%2F'.$mno[1].'" target="_blank" rel="external nofollow noreferrer" title="您可以提交想被百度收录的url">提交网址</a>给我们
</p>';
    }

    // 冇收录，但有其他搜索结果

    if (preg_match('/(?<=<font class="c-gray">没有找到该URL。您可以直接访问&nbsp;<\/font><a href=")(.+)(?=" target="_blank" onmousedown)/', @$se, $mno2)) {
        echo '
<p class="white">
    没有找到该URL。您可以直接访问&nbsp;<span class="red"><a class="noa" href="'.$mno2[1].'" target="_blank" rel="external nofollow noreferrer" title="直接访问 '.$mno2[1].'">'.$mno2[1].'</a></span>，还可<a class="noa" href="//zhanzhang.baidu.com/sitesubmit/index?sitename=http%3A%2F%2F'.$mno2[1].'" target="_blank" rel="external nofollow noreferrer" title="您可以提交想被百度收录的url">提交网址</a>给我们。
</p>';
    }

    // 字数限制

    if (preg_match('/(?<=<font class=f14><b>)(.+)(?=&nbsp;及其后面的字词均被忽略，因为百度的查询限制在38个汉字以内。<\/b><\/font>)/', @$se, $mlimit)) {
        echo '<p class="white">'.$mlimit[1].'&nbsp;及其后面的字词均被忽略，因为百度的查询限制在38个汉字以内。</p>';
    }

    // 屏蔽词

    if (preg_match('/(?<=<div class="boldline se_common_hint c-gap-bottom c-container" data-id="40400" data-tpl="hint_boldline"><strong>)(.+)(?=<\/strong><\/div>)/', @$se, $mcensor)) {
        echo '<p class="white">'.$mcensor[1].'</p>';
    }

    // 推销电话

    if (preg_match('/(?<=<div class="op_liarphone2_word">被)(\d+)(?=个&nbsp;<a href="http:\/\/shoujiweishi.baidu.com\/" target="_blank">百度手机卫士<\/a>&nbsp;用户标记为<strong>"广告推销"<\/strong>,供您参考。<\/div>)/', @$se, $mliarphone)) {
        echo '<p class="white">被'.$mliarphone[1].'个<a class="noa" href="//shoujiweishi.baidu.com/" rel="external nofollow noreferrer" target="_blank">百度手机卫士</a>用户标记为<strong>"骚扰电话"</strong>,供您参考。</p>';
    }

    // 诈骗电话

    if (preg_match('/(?<=<div class="op_liarphone2_word">被)(\d+)(?=个&nbsp;<a href="http:\/\/haoma.sogou.com" target="_blank">搜狗号码通<\/a>&nbsp;用户标记为<strong>"诈骗"<\/strong>,请谨防受骗。<\/div>)/', @$se, $mliarphone2)) {
        echo '<p class="noa">被'.$mliarphone2[1].'个<a class="white" href="//haoma.sogou.com" rel="external nofollow noreferrer" target="_blank">搜狗号码通</a>用户标记为<strong>"诈骗"</strong>,请谨防受骗。</p>';
    }

    // site 特型

    $indextime = date('Y-m-d',strtotime('-1 day'));

    if (preg_match('/(?<=该网站共有)(\s{16})(<b style="color:#333">)([0-9,\x80-\xff]{1,32})(?=<\/b>)/', @$se, $msite)) {
        echo '
<p class="white">'.$indextime.'&nbsp;百度索引量&nbsp;'.$msite[3].'&nbsp;(site&nbsp;&divide;&nbsp;索引量)&nbsp;=&nbsp;'.sprintf('%.3f',((str_replace(',', '', $mnum[2]) / str_replace(',' ,'' ,$msite[3])) * 100)).'%</p>';
    }

    // 搜索结果

    if (preg_match_all("/(?<=\" data\-tools=\'{\"title\":\")([^\"]+)(\",\"url\":\"http:)(\/\/www.baidu.com\/link\?url=[a-zA-Z0-9_\-]{43,320})(?=\"}'><a class=\"c-tip-icon\"><i class=\"c-icon c-icon-triangle-down-g\"><\/i><\/a><\/div>)/", @$se, $mserp))

    // 搜索结果页资源

    if (preg_match_all('/(?<=<div class="result c-container)( ?)(" id=")(\d{1,3})(" srcid=")(15\d{2})(?=" tpl=")/', @$se, $msrcid)) {
        foreach ($msrcid[3] as $i => $v) {
            $nsrcid[$i] = array ($msrcid[5][$i], $mserp[1][$i], $msrcid[3][$i], $mserp[3][$i]);
        }
    }

    // fetch key

    if (preg_match_all('/(?<="  srcid=")(\d{1,5})("  fk=")([\d_]{0,6}?)([^_]{1,32})(" id=")(\d{1,2})(?=" tpl=")/', @$se, $mfk)) {
        foreach ($mfk[6] as $i => $v) {
            $nfk[$i] = array ($mfk[1][$i], $mfk[4][$i], $mfk[6][$i], '');
        }
    }

    // search product

    if (preg_match_all('/(?<="  srcid=")(\d{1,5})("  id=")(\d{1,2})(" tpl="\w{2,32}" mu=")(.+)(?=" data\-op="\{\'y\':\'[a-zA-Z0-9]{8}\'\}")/', @$se, $msp)) {
        foreach ($msp[3] as $i => $v) {
            $nsp[$i] = array ($msp[1][$i], '', $msp[3][$i], $msp[5][$i]);
        }
    }

    // 三位一体

    if (strlen($nsrcid[0][0]) > 0) {
        if (strlen($nfk[0][0]) > 0) {
            if (strlen($nsp[0][0]) > 0) {
                $n = array_merge($nsrcid, $nfk, $nsp);
            }
            else {
                $n = array_merge($nsrcid, $nfk);
            }
        }
        elseif (strlen($nsp[0][0]) > 0) {
            $n = array_merge($nsrcid, $nsp);
        }
        else {
            $n = array_merge($nsrcid);
        }
    }
    elseif (strlen($nfk[0][0]) > 0) {
        if (strlen($nsp[0][0]) > 0) {
            $n = array_merge($nfk, $nsp);
        }
        else {
            $n = array_merge($nfk);
        }
    }
    elseif (strlen($nsp[0][0]) > 0) {
        $n = array_merge($nsp);
    }
    else
        $n = '';

    foreach ($n as $i => $v) {
        $i2[$i] = $v[2];
    }
    array_multisort($i2, $n);

    if (strlen($n[0][0]) > 0) {
        echo '
    <div class="draglist" draggable="true">
        <table>
            <thead>
                <tr>
                    <th>
                        <a href="//ask.seowhy.com/question/8396" rel="external nofollow" target="_blank" title="真心不喜欢百度搜索页中的框和排版">
                        标题
                        </a>
                    </th>
                    <th>
                        <span title="标题长度 &lt; 64">字节</span>
                    </th>
                    <th>
                        <a href="//ask.seowhy.com/article/79" target="_blank" rel="external nofollow noreferrer" title="百度左侧搜索结果来源分类srcid - 教你精准区分百度搜索产品">srcid
                        </a>
                    </th>
                    <th>
                        <span title="排名为百度服务器缓存结果，可能因实时或地域而不同，刷新后返回最新结果">排名</span>
                    </th>
                </tr>
            </thead>
            <tbody>';

        $srcid = array (
            array(29279, '<a target="_blank" href="', '//jiankang.baidu.com/wenda/mining?key=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '精选问答合集&nbsp;百度健康', '</a>', '', 'ec'),
            array(29250, '<a target="_blank" href="', '//jiankang.baidu.com/healthStar/index?wd=', $query, '" rel="external nofollow noreferrer', '">', '十二星座健康运势&nbsp;百度健康', '</a>', '', 'ec'),
            array(29256, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '饮食保健知识&nbsp;百度健康', '</a>', '', 'ec'),
            array(29228, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '百度品牌特卖', '</a>', '', 'ec'),
            array(29205, '<a target="_blank" href="', '//jiaoyu.baidu.com/query/exam?classId=2007&amp;originQuery=', $query, '" rel="external nofollow noreferrer', '">', '高等教育自学考试&nbsp;百度教育', '</a>', '', 'ec'),
            array(29204, '<a target="_blank" href="', '//jiaoyu.baidu.com/query/exam?originQuery=', $query, '" rel="external nofollow noreferrer', '">', '考试&nbsp;百度教育', '</a>', '', 'ec'),
            array(29200, '<a target="_blank" href="', '//jiaoyu.baidu.com/query/exam?originQuery=', $query, '" rel="external nofollow noreferrer', '">', '考试&nbsp;百度教育', '</a>', '', 'ec'),
            array(29181, '', '', '', '', '', '产品大全&nbsp;百度财富', '', '', 'ec'),
            array(29166, '<a target="_blank" href="', '//iwan.baidu.com/search?query=', $query, '" rel="external nofollow noreferrer', '">', '页游&nbsp;开始游戏&nbsp;百度爱玩', '</a>', '', 'ec'),
            array(29163, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '新专区&nbsp;百度爱玩', '</a>', '', 'ec'),
            array(29152, '', '', '', '', '', '游戏专区&nbsp;17173', '', '', 'ec'),
            array(29140, '', '', '', '', '', '二手车&nbsp;百度汽车', '', '', 'ec'),
            array(29129, '', '', '', '', '', '开始游戏&nbsp;百度爱玩', '', '', 'ec'),
            array(29127, '<a target="_blank" href="', '//iwan.baidu.com/search?searchquery=', $query, '" rel="external nofollow noreferrer', '">', '百度爱玩', '</a>', '', 'ec'),
            array(29120, '<a target="_blank" href="', '//iwan.baidu.com/yeyou?query=', $query, '" rel="external nofollow noreferrer', '">', '热门网页游戏平台&nbsp;百度爱玩', '</a>', '', 'ec'),
            array(29118, '', '', '', '', '', '百度品牌特卖', '', '', 'ec'),
            array(29116, '', '', '', '', '', '百度品牌特卖', '', '', 'ec'),
            array(29115, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '百度品牌特卖', '</a>', '', 'ec'),
            array(29114, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '百度品牌特卖', '</a>', '', 'ec'),
            array(29099, '', '', '', '', '', '百度教育考试', '', '', 'ec'),
            array(29096, '<a target="_blank" href="', '//jiaoyu.baidu.com/query/abroad?originQuery=', $query, '" rel="external nofollow noreferrer', '">', '留学图片资讯&nbsp;百度教育', '</a>', '', 'ec'),
            array(29094, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '找课程&nbsp;百度教育', '</a>', '', 'ec'),
            array(29093, '', '', '', '', '', '机构&nbsp;百度教育', '', '', 'ec'),
            array(29090, '', '', '', '', '', '课程&nbsp;百度教育', '', '', 'ec'),
            array(29089, '<a target="_blank" href="', '//jiankang.baidu.com/juhe/index?aType=1&amp;wd=', $query, '" rel="external nofollow noreferrer', '">', '百度健康', '</a>', '', 'ec'),
            array(29088, '', '', '', '', '', '混合&nbsp;-&nbsp;百度健康', '', '', 'ec'),
            array(29087, '', '', '', '', '', '[猜]&nbsp;百度知心_健康_知识_图片', '', '', 'ec'),
            array(29083, '<a target="_blank" href="', '//yao.xywy.com/so/?q=', $query, '" rel="external nofollow noreferrer', '">', '药品频道&nbsp;寻医问药网&nbsp;百度健康', '</a>', '', 'ec'),
            array(29081, '<a target="_blank" href="', '//jiankang.baidu.com/shoushu/base?wd=', $query, '" rel="external nofollow noreferrer', '">', '手术&nbsp;百度健康', '</a>', '', 'ec'),
            array(29080, '', '', '', '', '', '知识图片&nbsp;-&nbsp;百度健康', '', '', 'ec'),
            array(29070, '<a target="_blank" href="', '//iwan.baidu.com/yeyou?query=', $query, '" rel="external nofollow noreferrer', '">', '网页游戏&nbsp;百度爱玩', '</a>', '', 'ec'),
            array(29051, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '百度微购', '</a>', '', 'ec'),
            array(28299, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '精准问答', '</a>', '', 'ec'),
            array(28093, '', '', '', '', '', '去哪儿网门票频道', '', '', 'ec'),
            array(28092, '', '', '', '', '', '去哪儿网门票频道', '', '', 'ec'),
            array(28072, '', '', '', '', '', '去哪儿网酒店预定查询频道', '', '', 'ec'),
            array(28057, '', '', '', '', '', '去哪儿度假频道', '', '', 'ec'),
            array(28056, '', '', '', '', '', '[猜]&nbsp;去哪儿度假频道', '', '', 'ec'),
            array(28054, '', '', '', '', '', '机票查询&nbsp;去哪儿', '', '', 'ec'),
            array(28050, '<a target="_blank" href="', '//zhidao.baidu.com/search?word=', $query, '" rel="external nofollow noreferrer', '">', '疾病&nbsp;百度知道', '</a>', '', 'ec'),
            array(28042, '', '', '', '', '', '地图&nbsp;第&nbsp;2&nbsp;版&nbsp;百度旅游', '', '', 'ec'),
            array(28041, '', '', '', '', '', '地图&nbsp;第&nbsp;2&nbsp;版&nbsp;百度旅游', '', '', 'ec'),
            array(28040, '', '', '', '', '', '景点介绍&nbsp;第&nbsp;2&nbsp;版&nbsp;百度旅游', '', '', 'ec'),
            array(28026, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '团购&nbsp;百度糯米', '</a>', '', 'ec'),
            array(28025, '', '', '', '', '', '[猜]&nbsp;百度团购首页格', '', '', 'ec'),
            array(28022, '<a target="_blank" href="', '//map.baidu.com/?newmap=1&amp;ie=utf-8&amp;s=s%26wd%3D', $query, '" rel="external nofollow noreferrer', '">', '百度地图', '</a>', '', 'ec'),
            array(28010, '<a target="_blank" href="', '//map.baidu.com/?newmap=1&amp;ie=utf-8&amp;s=s%26wd%3D', $query, '" rel="external nofollow noreferrer', '">', '百度地图&nbsp;城市', '</a>', '', 'ec'),
            array(28002, '<a target="_blank" href="', '//map.baidu.com/?newmap=1&amp;ie=utf-8&amp;s=s%26wd%3D', $query, '" rel="external nofollow noreferrer', '">', '百度地图', '</a>', '', 'ec'),
            array(27994, '<a target="_blank" href="', '//zhidao.baidu.com/qiye', '', '" rel="external nofollow noreferrer', '">', '【企业问答】', '</a>', '', 'ec'),
            array(27003, '', '', '', '', '', '携程攻略', '', '', 'ec'),
            array(27002, '', '', '', '', '', '携程攻略', '', '', 'ec'),
            array(20840, '', '', '', '', '', '报价|图片|参数配置|口碑-汽车之家', '', '', 'sp'),
            array(20776, '', '', '', '', '', '[猜]&nbsp;百度百科', '', '', 'sp'),
            array(20679, '<a target="_blank" href="', '//help.alipay.com/lab/234578-236168/0-236168.htm', '', '" rel="external nofollow noreferrer', '">', '余额宝相关问题&nbsp;支付宝个人帮助中心', '</a>', '', 'sp'),
            array(20631, '', '', '', '', '', '教育考试&nbsp;百度知心文库', '', '', 'sp'),
            array(20548, '', '', '', '', '', '系列&nbsp;百度视频', '', '', 'sp'),
            array(20546, '', '', '', '', '', '分集剧情&nbsp;电视猫', '', '', 'sp'),
            array(20535, '', '', '', '', '', '[猜]&nbsp;2014年火车票购票日历', '', '', 'sp'),
            array(20528, '', '', '', '', '', '电视剧情介绍&nbsp;电视猫', '', '', 'sp'),
            array(20527, '', '', '', '', '', '百度左侧知心同系列电影&nbsp;百度视频', '', '', 'sp'),
            array(20458, '', '', '', '', '', '官方微博(原知心左侧卡片框)', '', '', 'sp'),
            array(20457, '', '', '', '', '', '电视剧&nbsp;百度视频', '', '', 'sp'),
            array(20451, '', '', '', '', '', '分集剧情&nbsp;电视猫', '', '', 'sp'),
            array(20426, '<a target="_blank" href="', '//s.weibo.com/user/', preg_replace('/(\s+)/', '+', $query), '&amp;auth=vip" rel="external nofollow noreferrer', '">', '新浪官微&nbsp;[1－10&nbsp;位]', '</a>', '', 'sp'),
            array(20423, '', '', '', '', '', '[猜]&nbsp;百度知道&nbsp;医疗健康&nbsp;更多知道相关问题', '', '', 'sp'),
            array(20422, '', '', '', '', '', '百度知道&nbsp;医疗健康&nbsp;更多知道相关问题', '', '', 'sp'),
            array(20408, '百度百科(由<a target="_blank" href="', '//www.baikemy.com', '', '&amp;auth=vip" rel="external nofollow noreferrer', '">', '卫生部临床医生科普平台/百科名医网', '</a>权威认证', '', 'sp'),
            array(20407, '百度百科(由<a target="_blank" href="', '//www.baikemy.com', '', '&amp;auth=vip" rel="external nofollow noreferrer', '">', '卫生部临床医生科普平台/百科名医网', '</a>权威认证', '', 'sp'),
            array(20406, '', '', '', '', '', '百度视频', '', '', 'sp'),
            array(20387, '', '', '', '', '', '易车网', '', '', 'sp'),
            array(20376, '', '', '', '', '', '百度百科&nbsp;汽车之家阿拉丁', '', '', 'sp'),
            array(20375, '', '', '', '', '', '官网&nbsp;汽车之家阿拉丁', '', '', 'sp'),
            array(20324, '', '', '', '', '', '百度百科(原知心左侧卡片框)', '', '', 'sp'),
            array(20323, '', '', '', '', '', '百度图片(原知心左侧卡片框)', '', '', 'sp'),
            array(20322, '', '', '', '', '', '百度音乐(原知心左侧卡片框)', '', '', 'sp'),
            array(20321, '', '', '', '', '', '百度视频(原知心左侧卡片框)', '', '', 'sp'),
            array(20319, '', '', '', '', '', '百度贴吧(原知心左侧卡片框)', '', '', 'sp'),
            array(20315, '', '', '', '', '', '付费观看&nbsp;百度视频', '', '', 'sp'),
            array(20294, '', '', '', '', '', '[猜]&nbsp;热映电影&nbsp;百度视频&nbsp;-&nbsp;百度左侧知心结果', '', '', 'sp'),
            array(20289, '<a target="_blank" href="', '//www.zhihu.com/search?q=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '知乎&nbsp;-&nbsp;百度阿拉丁', '</a>', '', 'sp'),
            array(20172, '', '', '', '', '', '知心旅游介绍&nbsp;百度旅游', '', '', 'sp'),
            array(20135, '', '', '', '', '', 'topik&nbsp;网上报名', '', '', 'sp'),
            array(20124, '', '', '', '', '', '百度左侧知心视频电视剧', '', '', 'sp'),
            array(20080, '', '', '', '', '', '北京市预约挂号统一平台', '', '', 'sp'),
            array(20071, '', '', '', '', '', '医院科室&nbsp;好大夫在线', '', '', 'sp'),
            array(20070, '', '', '', '', '', '挂号网', '', '', 'sp'),
            array(20006, '', '', '', '', '', '医院网站', '', '', 'sp'),
            array(20005, '', '', '', '', '', '医院科室', '', '', 'sp'),
            array(19912, '<a target="_blank" href="', '//www.soyoung.com/', '', '" rel="external nofollow noreferrer', '">', '新氧美容整形', '</a>', '', 'sp'),
            array(19792, '<a target="_blank" href="', '//beauty.yxlady.com/', '', '" rel="external nofollow noreferrer', '">', '伊秀美容', '</a>', '', 'sp'),
            array(19788, '<a target="_blank" href="', '//www.yxlady.com/', '', '" rel="external nofollow noreferrer', '">', '伊秀娱乐网', '</a>', '', 'sp'),
            array(19687, '<a target="_blank" href="', '//detail.zol.com.cn/', '', '" rel="external nofollow noreferrer', '">', 'ZOL产品报价&nbsp;中关村在线', '</a>', '', 'sp'),
            array(19093, '<a target="_blank" href="', '//www.18183.com/', '', '" rel="external nofollow noreferrer', '">', '游戏攻略&nbsp;18183手机游戏网', '</a>', '', 'sp'),
            array(18577, '', '', '', '', '', '【携程攻略】', '', '', 'sp'),
            array(18521, '<a target="_blank" href="', '//s.hc360.com/?w=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '慧聪网&nbsp;导购', '</a>', '', 'sp'),
            array(18308, '<a target="_blank" href="', '//club.xywy.com/', '', '" rel="external nofollow noreferrer', '">', '有问必答&nbsp;寻医问药网', '</a>', '', 'sp'),
            array(18258, '<a target="_blank" href="', '//news.91.com/', '', '" rel="external nofollow noreferrer', '">', '91资讯', '</a>', '', 'sp'),
            array(18198, '<a target="_blank" href="', '//www.downza.cn/', '', '" rel="external nofollow noreferrer', '">', '下载之家', '</a>', '', 'sp'),
            array(17719, '<a target="_blank" href="', '//pic.yesky.com/', '', '" rel="external nofollow noreferrer', '">', '天极时尚', '</a>', '', 'sp'),
            array(17706, '<a target="_blank" href="', '//pic.yesky.com/', '', '" rel="external nofollow noreferrer', '">', '天极时尚', '</a>', '', 'sp'),
            array(17590, '<a target="_blank" href="', '//www.onlinedown.net/', '', '" rel="external nofollow noreferrer', '">', '华军软件园', '</a>', '', 'sp'),
            array(17590, '', '', '', '', '', '华军软件园', '', '', 'sp'),
            array(17153, '<a target="_blank" href="', '//www.cr173.com/', '', '" rel="external nofollow noreferrer', '">', '西西软件园', '</a>', '', 'sp'),
            array(16932, '', '', '', '', '', '美食/营养&nbsp;百度经验【组图】', '', '', 'sp'),
            array(16852, '', '', '', '', '', '[猜]&nbsp;腾讯科技', '', '', 'sp'),
            array(16847, '', '', '', '', '', '[猜]&nbsp;热点话题', '', '', 'sp'),
            array(16821, '', '', '', '', '', '[猜]&nbsp;体育直播&nbsp;新浪网', '', '', 'sp'),
            array(16809, '', '', '', '', '', '电视猫', '', '', 'sp'),
            array(16796, '', '', '', '', '', '综艺&nbsp;腾讯视频', '', '', 'sp'),
            array(16790, '', '', '', '', '', '美食美客&nbsp;爱奇艺', '', '', 'sp'),
            array(16758, '', '', '', '', '', '悦美网&nbsp;子链&nbsp;缩略图', '', '', 'sp'),
            array(16743, '', '', '', '', '', '软件下载&nbsp;中关村在线', '', '', 'sp'),
            array(16724, '', '', '', '', '', '[猜]&nbsp;中国好系统', '', '', 'sp'),
            array(16689, '', '', '', '', '', '走势图表&nbsp;百度乐彩', '', '', 'sp'),
            array(16653, '', '', '', '', '', '女子拒搭讪被打死&nbsp;百度贴吧直播', '', '', 'sp'),
            array(16641, '', '', '', '', '', '百度加速乐', '', '', 'sp'),
            array(16634, '', '', '', '', '', '[猜]&nbsp;蘑菇系统之家', '', '', 'sp'),
            array(16633, '', '', '', '', '', '[猜]&nbsp;系统吧', '', '', 'sp'),
            array(16590, '', '', '', '', '', '开放式基金&nbsp;天天基金网', '', '', 'sp'),
            array(16545, '', '', '', '', '', '面包屑导航新闻时间轴', '', '', 'sp'),
            array(16524, '', '', '', '', '', '疑似推销', '', '', 'sp'),
            array(16499, '', '', '', '', '', '[猜]&nbsp;港股实时行情&nbsp;-&nbsp;东方财富网', '', '', 'sp'),
            array(16498, '', '', '', '', '', '[猜]&nbsp;股票实时行情&nbsp;-&nbsp;东方财富网', '', '', 'sp'),
            array(16488, '', '', '', '', '', '百度知道问律师', '', '', 'sp'),
            array(16450, '', '', '', '', '', '百度阿拉丁&nbsp;robots&nbsp;禁止抓取', '', '', 'sp'),
            array(16448, '', '', '', '', '', '性病科&nbsp;挂号网', '', '', 'sp'),
            array(16411, '', '', '', '', '', '百度软件中心', '', '', 'sp'),
            array(16391, '<a target="_blank" href="', '//search.jd.com/Search?keyword=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '京东', '</a>', '', 'sp'),
            array(16387, '', '', '', '', '', '手机&nbsp;太平洋电脑网', '', '', 'sp'),
            array(16355, '', '', '', '', '', '[猜]&nbsp;系统之家', '', '', 'sp'),
            array(16345, '', '', '', '', '', '[猜]&nbsp;世界杯&nbsp;网易体育', '', '', 'sp'),
            array(16343, '', '', '', '', '', '[猜]&nbsp;NBA赛季&nbsp;新浪体育', '', '', 'sp'),
            array(16323, '<a target="_blank" href="', '//www.39yst.com/', '', '" rel="external nofollow noreferrer', '">', '三九养生堂', '</a>', '', 'sp'),
            array(16312, '', '', '', '', '', '[猜]&nbsp;百度贴吧访谈直播', '', '', 'sp'),
            array(16311, '<a target="_blank" href="', 'http://biz.finance.sina.com.cn/suggest/lookup_n.php?country=usstock&amp;q=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '股票代码&nbsp;美股实时行情&nbsp;新浪财经&nbsp;[1－9&nbsp;位]', '</a>', '', 'sp'),
            array(16309, '<a target="_blank" href="', 'http://biz.finance.sina.com.cn/suggest/lookup_n.php?country=usstock&amp;q=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '股票代码&nbsp;美股实时行情&nbsp;新浪财经&nbsp;[1－9&nbsp;位]', '</a>', '', 'sp'),
            array(16277, '<a target="_blank" href="', '//sports.sina.com.cn/g/seriea/', '', '" rel="external nofollow noreferrer', '">', '意甲&nbsp;新浪体育', '</a>', '', 'sp'),
            array(16262, '', '', '', '', '', '带子链&nbsp;寻医问药网', '', '', 'sp'),
            array(16228, '', '', '', '', '', '[猜]&nbsp;非中国内地明星&nbsp;伊秀娱乐&nbsp;伊秀女性网', '', '', 'sp'),
            array(16198, '', '', '', '', '', '[猜]&nbsp;百度经验【组图】', '', '', 'sp'),
            array(16189, '', '', '', '', '', '股票实时行情&nbsp;东方财富网', '', '', 'sp'),
            array(16188, '', '', '', '', '', '新浪财经', '', '', 'sp'),
            array(16184, '', '', '', '', '', '股票实时行情&nbsp;东方财富网', '', '', 'sp'),
            array(16163, '', '', '', '', '', '[猜]&nbsp;欧冠新闻时间轴', '', '', 'sp'),
            array(16140, '<a target="_blank" href="', '//www.guahao.com', '', '" rel="external nofollow noreferrer', '">', '挂号网', '</a>', '', 'sp'),
            array(16049, '', '', '', '', '', '诈骗', '', '', 'sp'),
            array(16048, '', '', '', '', '', '寻医问药网', '', '', 'sp'),
            array(16047, '<a target="_blank" href="', '//fanyi.baidu.com/#auto/zh/', '', '" rel="external nofollow noreferrer', '">', '百度在线翻译&nbsp;[1－10&nbsp;位]', '</a>', '', 'sp'),
            array(16035, '', '', '', '', '', '[猜]&nbsp;旅游目的地推荐&nbsp;-&nbsp;百度旅游', '', '', 'sp'),
            array(15988, '', '', '', '', '', '动漫&nbsp;腾讯视频', '', '', 'sp'),
            array(15964, '', '', '', '', '', '专辑&nbsp;百度音乐', '', '', 'sp'),
            array(15958, '', '', '', '', '', '电视剧&nbsp;腾讯视频', '', '', 'sp'),
            array(15940, '<a target="_blank" href="', '//sports.sina.com.cn/g/laliga/', '', '" rel="external nofollow noreferrer', '">', '西甲&nbsp;新浪体育', '</a>', '', 'sp'),
            array(15929, '', '', '', '', '', '[猜]&nbsp;软件下载&nbsp;太平洋电脑网', '', '', 'sp'),
            array(15883, '<a target="_blank" href="', '//ask.seowhy.com/question/8497', '', '" rel="external nofollow noreferrer" title="百度搜索结果页，都什么情况下会出现直链？', '">', '代名词 百度快照在2013年09月-2013年10月间', '</a>', '', 'sp'),
            array(15863, '', '', '', '', '', '小道消息&nbsp;手机中国', '', '', 'sp'),
            array(15858, '', '', '', '', '', '单机游戏网', '', '', 'sp'),
            array(15820, '', '', '', '', '', '速尔快递客服电话', '', '', 'sp'),
            array(15817, '', '', '', '', '', '普通官网', '', '', 'sp'),
            array(15791, '', '', '', '', '', '[猜]&nbsp;快递电话', '', '', 'sp'),
            array(15785, '', '', '', '', '', '口袋巴士', '', '', 'sp'),
            array(15772, '', '', '', '', '', '逗游', '', '', 'sp'),
            array(15765, '', '', '', '', '', '世界杯新闻轴', '', '', 'sp'),
            array(15758, '<a target="_blank" href="', '//ask.seowhy.com/question/14936', '', '" rel="external nofollow noreferrer', '">', '慧聪网B2B', '</a>', '', 'sp'),
            array(15751, '', '', '', '', '', '齐家网', '', '百度收购', 'sp'),
            array(15728, '', '', '', '', '', '起点中文网', '', '', 'sp'),
            array(15726, '', '', '', '', '', '起点中文网', '', '', 'sp'),
            array(15720, '', '', '', '', '', '百度经验', '', '', 'sp'),
            array(15678, '', '', '', '', '', '巴西队赛程&nbsp;网易体育', '', '', 'sp'),
            array(15648, '', '', '', '', '', '[猜]&nbsp;旅游攻略&nbsp;百度旅游', '', '', 'sp'),
            array(15623, '', '', '', '', '', '报价及图片_太平洋汽车网', '', '', 'sp'),
            array(15584, '<a target="_blank" href="', '//zhanzhang.baidu.com/', '', '" rel="external nofollow noreferrer', '">', '百度站长平台', '</a>', '', 'sp'),
            array(15560, '', '', '', '', '', '中关村在线', '', '', 'sp'),
            array(15557, '', '', '', '', '', '[猜]&nbsp;中公教育', '', '', 'sp'),
            array(15547, '<a target="_blank" href="', '//www.yuemei.com/', '', '" rel="external nofollow noreferrer', '">', '整形美容&nbsp;-&nbsp;悦美网', '</a>', '', 'sp'),
            array(15516, '<a target="_blank" href="', '//name.renren.com/', '', '" rel="external nofollow noreferrer', '">', '人人网同名搜索', '</a>', '', 'sp'),
            array(15515, '', '', '', '', '', '人人网同名搜索', '', '', 'sp'),
            array(15460, '', '', '', '', '', '中国足彩网', '', '', 'sp'),
            array(15448, '<a target="_blank" href="', '//s.hc360.com', '', '" rel="external nofollow noreferrer', '">', '慧聪商务搜索', '</a>', '', 'sp'),
            array(15442, '', '', '', '', '', '疾病百科&nbsp;39健康网', '', '', 'sp'),
            array(15388, '', '', '', '', '', '手机中国', '', '', 'sp'),
            array(15357, '', '', '', '', '', 'hao123汽车|hao123头条', '', '', 'sp'),
            array(15295, '', '', '', '', '', '畛域_百度视频', '', '', 'sp'),
            array(15279, '<a target="_blank" href="', '//open.baidu.com/coop/kefu.html', '', '" rel="external nofollow noreferrer', '">', '客服电话&nbsp;[3－4&nbsp;位]', '</a>', '', 'sp'),
            array(15232, '', '', '', '', '', '百度轻应用', '', '', 'sp'),
            array(15213, '<a target="_blank" href="', '//www.yuemei.com/parts_price.html', '', '" rel="external nofollow noreferrer', '">', '整形报价大全&nbsp;悦美整形网', '</a>', '', 'sp'),
            array(15200, '<a target="_blank" href="', '//movie.douban.com/subject_search?search_text=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '豆瓣电影', '</a>', '', 'sp'),
            array(15198, '', '', '', '', '', '考研时间安排&nbsp;新浪教育', '', '', 'sp'),
            array(15195, '', '', '', '', '', '不凡游戏网', '', '', 'sp'),
            array(15110, '', '', '', '', '', '好大夫在线', '', '', 'sp'),
            array(15109, '', '', '', '', '', '[猜]&nbsp;疾病&nbsp;好大夫在线', '', '', 'sp'),
            array(15056, '', '', '', '', '', '天极下载', '', '', 'sp'),
            array(15017, '', '', '', '', '', '热点&nbsp;网易体育', '', '', 'sp'),
            array(14994, '', '', '', '', '', '伊秀娱乐明星库', '', '', 'sp'),
            array(14990, '<a target="_blank" href="', '//xiazai.zol.com.cn/search?wd=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', 'ZOL软件下载', '</a>', '', 'sp'),
            array(14966, '<a target="_blank" href="', '//v.baidu.com/v?ie=utf-8&amp;word=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '百度视频&nbsp;相关视频', '</a>', '', 'sp'),
            array(14960, '<a target="_blank" href="', '//product.yesky.com/', '', '" rel="external nofollow noreferrer', '">', '天极产品库', '</a>', '', 'sp'),
            array(14955, '', '', '', '', '', '实物价格&nbsp;和讯黄金', '', '', 'sp'),
            array(14907, '', '', '', '', '', '分集剧情介绍&nbsp;电视猫', '', '', 'sp'),
            array(14861, '', '', '', '', '', '[猜]&nbsp;选手&nbsp;乐视网', '', '', 'sp'),
            array(14744, '<a target="_blank" href="', '//www.xiaopi.com/', '', '" rel="external nofollow noreferrer', '">', '小皮游戏', '</a>', '', 'sp'),
            array(14726, '', '', '', '', '', '热点&nbsp;网易娱乐', '', '', 'sp'),
            array(14713, '', '', '', '', '', '[猜]&nbsp;目的地指南&nbsp;百度旅游', '', '', 'sp'),
            array(14664, '', '', '', '', '', '爱卡汽车网', '', '', 'sp'),
            array(14611, '', '', '', '', '', 'hao123小游戏', '', '', 'sp'),
            array(14584, '', '', '', '', '', '[猜]&nbsp;百度团购官网', '', '', 'sp'),
            array(14580, '', '', '', '', '', 'Zinch', '', '', 'sp'),
            array(14545, '', '', '', '', '', '品牌词', '', '', 'sp'),
            array(14515, '', '', '', '', '', '[猜]&nbsp;新浪微博|58同城|百度卫士|百度影音|铁路客户服务中心', '', '', 'sp'),
            array(14510, '', '', '', '', '', '[猜]&nbsp;58同城|淘宝网', '', '', 'sp'),
            array(14480, '<a target="_blank" href="', '//sports.sohu.com/s2004/zhongjia.shtml', '', '" rel="external nofollow noreferrer', '">', '中甲&nbsp;搜狐体育', '</a>', '', 'sp'),
            array(14474, '', '', '', '', '', '百度投诉中心', '', '', 'sp'),
            array(14466, '', '', '', '', '', '汽车点评', '', '百度收购', 'sp'),
            array(14452, '<a target="_blank" href="', '//tousu.baidu.com/webmaster/add', '', '" rel="external nofollow noreferrer', '">', '快照删除与更新&nbsp;百度投诉', '</a>', '', 'sp'),
            array(14435, '', '', '', '', '', '[猜]&nbsp;聊天通讯&nbsp;-&nbsp;百度软件中心', '', '', 'sp'),
            array(14434, '<a target="_blank" href="', '//product.yesky.com/', '', '" rel="external nofollow noreferrer', '">', '天极产品库', '</a>', '', 'sp'),
            array(14427, '<a target="_blank" href="', '//mydown.yesky.com/', '', '" rel="external nofollow noreferrer', '">', '天极下载', '</a>', '', 'sp'),
            array(14421, '', '', '', '', '', '时刻表&nbsp;发车间隔&nbsp;同程网', '', '', 'sp'),
            array(14412, '<a target="_blank" href="', '//data.10jqka.com.cn/financial/bdcbmg/', '', '" rel="external nofollow noreferrer', '">', '公司财报&nbsp;同花顺财经', '</a>', '', 'sp'),
            array(14331, '', '', '', '', '', '百度经验【图文】', '', '', 'sp'),
            array(14305, '', '', '', '', '', '百度网盘', '', '', 'sp'),
            array(14287, '', '', '', '', '', '股吧&nbsp;-&nbsp;东方财富网', '', '', 'sp'),
            array(14283, '', '', '', '', '', '股吧&nbsp;-&nbsp;东方财富网', '', '', 'sp'),
            array(14181, '', '', '', '', '', '[猜]社交网络&nbsp;-&nbsp;ipush', '', '', 'sp'),
            array(14175, '<a target="_blank" href="', '//euro2012.sina.com.cn/', '', '" rel="external nofollow noreferrer', '">', '欧洲杯', '</a>', '', 'sp'),
            array(14142, '', '', '', '', '', '[猜]&nbsp;系统吧', '', '', 'sp'),
            array(14134, '', '', '', '', '', '[猜]&nbsp;百度图片 医疗健康', '', '', 'sp'),
            array(14110, '', '', '', '', '', '中国天气网', '', '', 'sp'),
            array(14098, '<a target="_blank" href="', '//yz.chsi.com.cn/', '', '" rel="external nofollow noreferrer', '">', '中国研究生招生信息网', '</a>', '', 'sp'),
            array(14076, '<a target="_blank" href="', '//v.baidu.com/v?ie=utf-8&amp;word=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '最新迷你&nbsp;在线观看&nbsp;百度视频', '</a>', '', 'sp'),
            array(14062, '', '', '', '', '', 'hao123折扣导航', '', '', 'sp'),
            array(14060, '<a target="_blank" href="', '//yingjian.baidu.com/', '', '" rel="external nofollow noreferrer', '">', '百度硬件', '</a>', '', 'sp'),
            array(14059, '', '', '', '', '', '[猜]&nbsp;马槽&nbsp;百度经验', '', '', 'sp'),
            array(14058, '', '', '', '', '', '电影&nbsp;百度团购', '', '', 'sp'),
            array(14022, '', '', '', '', '', '旅游景点&nbsp;百度经验【组图】', '', '', 'sp'),
            array(14004, '', '', '', '', '', '挂号网', '', '', 'sp'),
            array(13932, '', '', '', '', '', '企业官方贴吧', '', '', 'sp'),
            array(13927, '<a target="_blank" href="', '//detail.zol.com.cn/', '', '" rel="external nofollow noreferrer', '">', 'ZOL产品报价&nbsp;中关村在线', '</a>', '', 'sp'),
            array(13920, '', '', '', '', '', '产品报价&nbsp;中关村在线', '', '', 'sp'),
            array(13911, '', '', '', '', '', '手机&nbsp;天极网', '', '', 'sp'),
            array(13885, '', '', '', '', '', '[猜]&nbsp;百度卫士&nbsp;更多知道相关问题&gt;&gt;百度知道', '', '', 'sp'),
            array(13863, '', '', '', '', '', '百度火车票', '', '', 'sp'),
            array(13854, '', '', '', '', '', '电影&nbsp;-&nbsp;腾讯视频', '', '', 'sp'),
            array(13842, '', '', '', '', '', '旅游攻略&nbsp;百度旅游', '', '', 'sp'),
            array(13841, '', '', '', '', '', '英语四六级考试查分&nbsp;考试吧', '', '', 'sp'),
            array(13823, '<a target="_blank" href="', '//soft.hao123.com/', '', '" rel="external nofollow noreferrer', '">', 'hao123下载站', '</a>', '', 'sp'),
            array(13806, '', '', '', '', '', '附近电影院&nbsp;时光网', '', '', 'sp'),
            array(13805, '<a target="_blank" href="', '//www.99danji.com/', '', '" rel="external nofollow noreferrer', '">', '99安卓游戏', '</a>', '', 'sp'),
            array(13798, '', '', '', '', '', '支付宝客服电话|百度用户服务中心', '', '', 'sp'),
            array(13750, '', '', '', '', '', '7k7k小游戏', '', '', 'sp'),
            array(13747, '', '', '', '', '', '网页游戏&nbsp;7k7k小游戏', '', '', 'sp'),
            array(13741, '', '', '', '', '', '实时路况', '', '', 'sp'),
            array(13717, '', '', '', '', '', '左侧知心&nbsp;电视剧&nbsp;爱奇艺', '', '', 'sp'),
            array(13706, '', '', '', '', '', '[猜]&nbsp;腾讯彩票', '', '', 'sp'),
            array(13679, '', '', '', '', '', '现货价格&nbsp;和讯黄金', '', '', 'sp'),
            array(13631, '', '', '', '', '', '比赛进程&nbsp;乐视网', '', '', 'sp'),
            array(13630, '', '', '', '', '', '[猜]&nbsp;中国内地明星&nbsp;伊秀娱乐&nbsp;伊秀女性网', '', '', 'sp'),
            array(13627, '<a target="_blank" href="', '//sports.sina.com.cn/z/AFCCL2015/', '', '" rel="external nofollow noreferrer', '">', '亚冠赛程结果&nbsp;新浪体育', '</a>', '', 'sp'),
            array(13620, '<a target="_blank" href="', '//www.baidu.com/aladdin/js/iknow/iknowask.html', '', '" rel="external nofollow noreferrer', '">', '百度知道&nbsp;ipush', '</a>', '', 'sp'),
            array(13616, '', '', '', '', '', '二手房&nbsp;百度乐居', '', '', 'sp'),
            array(13598, '', '', '', '', '', '猎聘网', '', '', 'sp'),
            array(13580, '', '', '', '', '', '嫣然天使基金', '', '', 'sp'),
            array(13466, '', '', '', '', '', '逗游网', '', '', 'sp'),
            array(13445, '', '', '', '', '', '供应信息&nbsp;慧聪网', '', '', 'sp'),
            array(13390, '', '', '', '', '', '腾讯动漫', '', '', 'sp'),
            array(13369, '', '', '', '', '', '一听音乐', '', '', 'sp'),
            array(13360, '<a target="_blank" href="', '//tieba.baidu.com/f?kw=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '[猜]&nbsp;百度贴吧', '</a>', '', 'sp'),
            array(13355, '', '', '', '', '', '短信&nbsp;爱祝福', '', '', 'sp'),
            array(13336, '', '', '', '', '', '墨迹天气', '', '', 'sp'),
            array(13310, '', '', '', '', '', '手机品牌&nbsp;太平洋电脑网', '', '', 'sp'),
            array(13264, '<a target="_blank" href="', '//open.baidu.com/data/ms/nav/somesources/tag/ctw/', '', '" rel="external nofollow noreferrer', '">', '畅途网&nbsp;百度数据开放平台合作伙伴', '</a>', '', 'sp'),
            array(13260, '', '', '', '', '', '汽车百科知识&nbsp;汽车点评', '', '', 'sp'),
            array(13255, '', '', '', '', '', '1', '', '', 'sp'),
            array(13231, '<a target="_blank" href="', '//sports.sina.com.cn/g/ucl/fixtures.html', '', '" rel="external nofollow noreferrer', '">', '欧洲冠军联赛&nbsp;-&nbsp;新浪体育', '</a>', '', 'sp'),
            array(13216, '', '', '', '', '', '影讯&nbsp;最近上映电影&nbsp;Mtime时光网', '', '', 'sp'),
            array(13174, '', '', '', '', '', '列车时刻表查询及在线预订&nbsp;去哪儿', '', '', 'sp'),
            array(13118, '', '', '', '', '', '比赛进程&nbsp;百度视频', '', '', 'sp'),
            array(13111, '', '', '', '', '', '中国红十字基金会', '', '', 'sp'),
            array(13096, '', '', '', '', '', '百度团购', '', '', 'sp'),
            array(13039, '', '', '', '', '', '客服电话&nbsp;去哪儿', '', '', 'sp'),
            array(13031, '<a target="_blank" href="', '//open.baidu.com/data/ms/nav/somesources/tag/zgtq/', '', '" rel="external nofollow noreferrer', '">', '城市天气预报&nbsp;中国天气网', '</a>', '', 'sp'),
            array(12967, '', '', '', '', '', '百度软件', '', '', 'sp'),
            array(12965, '<a target="_blank" href="', '//www.abab.com/', '', '" rel="external nofollow noreferrer', '">', 'ABAB小游戏', '</a>', '', 'sp'),
            array(12946, '', '', '', '', '', '动漫&nbsp;爱奇艺', '', '', 'sp'),
            array(12926, '', '', '', '', '', '[猜]&nbsp;亚信峰会直播&nbsp;凤凰网', '', '', 'sp'),
            array(12906, '', '', '', '', '', '[猜]城市&nbsp;-&nbsp;百度团购', '', '', 'sp'),
            array(12904, '', '', '', '', '', '[猜]&nbsp;中国网络电视台', '', '', 'sp'),
            array(12903, '', '', '', '', '', '[猜]&nbsp;百度团购导航', '', '', 'sp'),
            array(12901, '', '', '', '', '', '旅游攻略&nbsp;-&nbsp;百度旅游', '', '', 'sp'),
            array(12880, '', '', '', '', '', '[猜]&nbsp;国内省市级|国外国家级目的地&nbsp;百度旅游', '', '', 'sp'),
            array(12840, '', '', '', '', '', '百度乐居', '', '', 'sp'),
            array(12839, '', '', '', '', '', '招远麦当劳&nbsp;新闻直播', '', '', 'sp'),
            array(12809, '', '', '', '', '', '综艺&nbsp;爱奇艺', '', '', 'sp'),
            array(12729, '<a target="_blank" href="', '//piao.baidu.com/s?wd=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '百度票务', '</a>', '', 'sp'),
            array(12726, '', '', '', '', '', '医院&nbsp;好大夫在线', '', '', 'sp'),
            array(12645, '', '', '', '', '', '[猜]&nbsp;轿车&nbsp;易车网', '', '', 'sp'),
            array(12644, '', '', '', '', '', '软件排行榜&nbsp;太平洋下载', '', '', 'sp'),
            array(12643, '', '', '', '', '', '百度团购第&nbsp;2&nbsp;种起点', '', '', 'sp'),
            array(12616, '', '', '', '', '', '开奖查询&nbsp;百度乐彩', '', '', 'sp'),
            array(12610, '', '', '', '', '', '汽车点评', '', '', 'sp'),
            array(12605, '', '', '', '', '', '百度乐彩', '', '', 'sp'),
            array(12594, '', '', '', '', '', '[猜]&nbsp;腾讯视频', '', '', 'sp'),
            array(12558, '', '', '', '', '', '说明书&nbsp;寻医问药网', '', '', 'sp'),
            array(12542, '', '', '', '', '', '英语四六级真题试卷&nbsp;新浪教育', '', '', 'sp'),
            array(12521, '', '', '', '', '', '开心网会员登录', '', '', 'sp'),
            array(12512, '', '', '', '', '', '录取分数线&nbsp;高考招生&nbsp;中国教育在线', '', '', 'sp'),
            array(12501, '', '', '', '', '', '育儿&nbsp;太平洋亲子网', '', '', 'sp'),
            array(12500, '', '', '', '', '', '育儿检测&nbsp;太平洋亲子网', '', '', 'sp'),
            array(12403, '', '', '', '', '', '壹基金', '', '', 'sp'),
            array(12391, '', '', '', '', '', '装修&nbsp;齐家网', '', '', 'sp'),
            array(12347, '', '', '', '', '', '产品导航&nbsp;手机&nbsp;太平洋电脑网', '', '', 'sp'),
            array(12346, '', '', '', '', '', '商户&nbsp;大众点评网', '', '', 'sp'),
            array(12345, '', '', '', '', '', '食品营养价值&nbsp;美食天下', '', '', 'sp'),
            array(12342, '', '', '', '', '', '[猜]&nbsp;NBA决赛&nbsp;热点直播&nbsp;网易体育', '', '', 'sp'),
            array(12270, '', '', '', '', '', '18183&nbsp;手游网', '', '', 'sp'),
            array(12220, '', '', '', '', '', '排行榜&nbsp;百度搜索风云榜', '', '', 'sp'),
            array(12215, '', '', '', '', '', '今日游戏排行榜&nbsp;百度搜索风云榜', '', '', 'sp'),
            array(12185, '', '', '', '', '', '有妖气', '', '', 'sp'),
            array(12123, '', '', '', '', '', '专题&nbsp;百度音乐', '', '', 'sp'),
            array(12121, '', '', '', '', '', '综艺&nbsp;风行网', '', '', 'sp'),
            array(12118, '', '', '', '', '', '百度相册', '', '', 'sp'),
            array(12114, '', '', '', '', '', '百度经验【组图】', '', '', 'sp'),
            array(12102, '', '', '', '', '', '自学考试&nbsp;考试吧', '', '', 'sp'),
            array(12097, '', '', '', '', '', '京东商城品牌', '', '', 'sp'),
            array(12049, '', '', '', '', '', '百度推广投诉客服电话', '', '', 'sp'),
            array(12048, '', '', '', '', '', '客服电话', '', '', 'sp'),
            array(12021, '', '', '', '', '', '新闻时间轴', '', '', 'sp'),
            array(11952, '', '', '', '', '', '百度口碑', '', '', 'sp'),
            array(11940, '<a target="_blank" href="', '//open.baidu.com/data/ms/nav/somesources/tag/zgtq/', '', '" rel="external nofollow noreferrer', '">', '全国省份天气预报&nbsp;中国天气网', '</a>', '', 'sp'),
            array(11939, '', '', '', '', '', '网页游戏开服表&nbsp;07073游戏网', '', '', 'sp'),
            array(11933, '', '', '', '', '', '健身&nbsp;中国易登网', '', '', 'sp'),
            array(11899, '', '', '', '', '', '[猜]&nbsp;维基百科|百度团购|百度杀毒', '', '', 'sp'),
            array(11898, '', '', '', '', '', '知名网站', '', '', 'sp'),
            array(11874, '<a target="_blank" href="', '//www.9niu.com/', '', '" rel="external nofollow noreferrer', '">', '九牛网', '</a>', '', 'sp'),
            array(11852, '<a target="_blank" href="', '//sports.sina.com.cn/global/france2/', '', '" rel="external nofollow noreferrer', '">', '法甲&nbsp;新浪体育', '</a>', '', 'sp'),
            array(11838, '', '', '', '', '', '[猜]&nbsp;客服电话表', '', '', 'sp'),
            array(11830, '', '', '', '', '', '百度软件中心', '', '', 'sp'),
            array(11828, '', '', '', '', '', '融360', '', '', 'sp'),
            array(11810, '', '', '', '', '', '区号查询', '', '', 'sp'),
            array(11803, '', '', '', '', '', '爱漫画', '', '', 'sp'),
            array(11782, '', '', '', '', '', '手机大全&nbsp;-&nbsp;手机中国&nbsp;[1－10&nbsp;位]', '', '百度收购', 'sp'),
            array(11757, '', '', '', '', '', '爱漫画', '', '', 'sp'),
            array(11708, '', '', '', '', '', '组图&nbsp;美食天下', '', '', 'sp'),
            array(11692, '', '', '', '', '', '地铁&nbsp;百度地图', '', '', 'sp'),
            array(11677, '', '', '', '', '', '网易163邮箱登录', '', '', 'sp'),
            array(11675, '', '', '', '', '', '五笔编码汉语拼音查询&nbsp;ip138', '', '', 'sp'),
            array(11640, '', '', '', '', '', '考试吧', '', '', 'sp'),
            array(11620, '', '', '', '', '', '公益咨询电话', '', '', 'sp'),
            array(11610, '', '', '', '', '', '成人高考报名时间_考试吧', '', '', 'sp'),
            array(11582, '<a target="_blank" href="', '//sports.sina.com.cn/csl/', '', '" rel="external nofollow noreferrer', '">', '中超&nbsp;新浪体育', '</a>', '', 'sp'),
            array(11547, '', '', '', '', '', '求医网', '', '', 'sp'),
            array(11539, '', '', '', '', '', '足球联赛对战表&nbsp;新浪体育', '', '', 'sp'),
            array(11520, '', '', '', '', '', '观后感、评论&nbsp;豆瓣电影', '', '', 'sp'),
            array(11519, '', '', '', '', '', '影评、简介及基本信息&nbsp;豆瓣电影', '', '', 'sp'),
            array(11501, '<a target="_blank" href="', '//soft.hao123.com/', '', '" rel="external nofollow noreferrer', '">', 'hao123下载站', '</a>', '', 'sp'),
            array(11490, '', '', '', '', '', '国际原油期货价格&nbsp;国际石油网', '', '', 'sp'),
            array(11478, '', '', '', '', '', '间接确认的官网', '', '', 'sp'),
            array(11471, '', '', '', '', '', '国家授时中心标准时间', '', '', 'sp'),
            array(11463, '<a target="_blank" href="', '//open.baidu.com/data/ms/nav/somesources/tag/ctw/', '', '" rel="external nofollow noreferrer', '">', '畅途网&nbsp;百度数据开放平台合作伙伴', '</a>', '', 'sp'),
            array(11462, '', '', '', '', '', '[猜]&nbsp;官方订票电话', '', '', 'sp'),
            array(11443, '<a target="_blank" href="', '//info.sports.sina.com.cn/rank/', '', '" rel="external nofollow noreferrer', '">', '国际足联排名&nbsp;新浪体育', '</a>', '', 'sp'),
            array(11442, '', '', '', '', '', '网球世界排名&nbsp;新浪体育', '', '', 'sp'),
            array(11439, '', '', '', '', '', '乒乓球世界排名&nbsp;新浪体育', '', '', 'sp'),
            array(11437, '', '', '', '', '', '羽毛球世界排名&nbsp;新浪体育', '', '', 'sp'),
            array(11436, '', '', '', '', '', '233网校', '', '', 'sp'),
            array(11421, '<a target="_blank" href="', '//jiaoyu.baidu.com/college/match?originQuery=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '高考分数线&nbsp;招生信息&nbsp;百度教育', '</a>', '', 'sp'),
            array(11409, '', '', '', '', '', '公益咨询电话', '', '', 'sp'),
            array(11386, '<a target="_blank" href="', '//tieba.baidu.com/f/search/res?ie=utf-8&qw=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '百度贴吧&nbsp;查看更多贴子&gt;&gt;', '</a>', '', 'sp'),
            array(11353, '', '', '', '', '', '[猜]&nbsp;铁路客户服务中心官网', '', '', 'sp'),
            array(11301, '', '', '', '', '', '人民网宏观经济数据库', '', '', 'sp'),
            array(11299, '<a target="_blank" href="', '//product.cnmo.com/', '', '" rel="external nofollow noreferrer', '">', '手机中国', '</a>', '', 'sp'),
            array(11263, '', '', '', '', '', '中国妇女发展基金会', '', '', 'sp'),
            array(11260, '', '', '', '', '', '百度文库认证机构', '', '', 'sp'),
            array(11252, '', '', '', '', '', '百度文库认证作者', '', '', 'sp'),
            array(11239, '', '', '', '', '', '中国宋庆龄基金会', '', '', 'sp'),
            array(11228, '', '', '', '', '', '综艺节目联系方式&nbsp;爱奇艺', '', '', 'sp'),
            array(11205, '', '', '', '', '', '新浪星座查询', '', '', 'sp'),
            array(11196, '', '', '', '', '', '12306&nbsp;官网', '', '', 'sp'),
            array(11175, '', '', '', '', '', '[猜]&nbsp;百度贴吧直播', '', '', 'sp'),
            array(11170, '', '', '', '', '', '太平洋下载中心', '', '', 'sp'),
            array(11129, '', '', '', '', '', '[猜]&nbsp;综艺节目联系方式', '', '', 'sp'),
            array(10936, '', '', '', '', '', '英语四六级&nbsp;新浪教育', '', '', 'sp'),
            array(10927, '', '', '', '', '', '电视节目表', '', '', 'sp'),
            array(10904, '<a target="_blank" href="', '//cet.99sushe.com/', '', '" rel="external nofollow noreferrer', '">', '全国大学英语四六级考试(CET)官方成绩查询', '</a>', '', 'sp'),
            array(10858, '', '', '', '', '', '高考分数线&nbsp;新浪高考', '', '', 'sp'),
            array(10827, '', '', '', '', '', '高考各省市录取分数线汇总&nbsp;新浪高考', '', '', 'sp'),
            array(10806, '', '', '', '', '', '手机中国', '', '百度收购', 'sp'),
            array(10797, '<a target="_blank" href="', '//soft.hao123.com/', '', '" rel="external nofollow noreferrer', '">', 'hao123下载站', '</a>', '', 'sp'),
            array(10794, '', '', '', '', '', '电影&nbsp;爱奇艺', '', '', 'sp'),
            array(10792, '', '', '', '', '', '快速查询&nbsp;求医网', '', '', 'sp'),
            array(10789, '', '', '', '', '', '宜家|百度云图|世界知识产权组织|英雄联盟', '', '', 'sp'),
            array(10788, '', '', '', '', '', '亲子百科&nbsp;太平洋亲子网', '', '', 'sp'),
            array(10776, '', '', '', '', '', 'Mtime时光网', '', '', 'sp'),
            array(10775, '', '', '', '', '', '影评、简介及放映时间查询&nbsp;Mtime时光网', '', '', 'sp'),
            array(10764, '', '', '', '', '', '高考查分&nbsp;新浪高考', '', '', 'sp'),
            array(10744, '', '', '', '', '', '考研分数线查询&nbsp;新浪教育', '', '', 'sp'),
            array(10723, '', '', '', '', '', '考研真题试卷&nbsp;新浪教育', '', '', 'sp'),
            array(10693, '', '', '', '', '', '世界时间&nbsp;百度开放平台', '', '', 'sp'),
            array(10678, '', '', '', '', '', '基金吧&nbsp;天天基金网', '', '', 'sp'),
            array(10652, '<a target="_blank" href="', '//baike.baidu.com/search?word=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '实例&nbsp;聚合&nbsp;百度百科', '</a>', '', 'sp'),
            array(10646, '', '', '', '', '', '[猜]&nbsp;客船沉没', '', '', 'sp'),
            array(10639, '', '', '', '', '', '[猜]&nbsp;中国移动客服电话', '', '', 'sp'),
            array(10610, '', '', '', '', '', '百度招聘', '', '', 'sp'),
            array(10594, '', '', '', '', '', '飞翔游戏', '', '', 'sp'),
            array(10577, '', '', '', '', '', '网页游戏&nbsp;百度游戏', '', '', 'sp'),
            array(10530, '', '', '', '', '', '药品通&nbsp;39健康网', '', '', 'sp'),
            array(10501, '', '', '', '', '', '[猜]&nbsp;直播热点话题&nbsp;新浪娱乐', '', '', 'sp'),
            array(10500, '', '', '', '', '', '客服是多少&nbsp;百度知道&nbsp;更多知道相关问题&gt;&gt;', '', '', 'sp'),
            array(10422, '', '', '', '', '', '[猜]时间轴新闻', '', '', 'sp'),
            array(10396, '', '', '', '', '', '[猜]&nbsp;搜狐健康', '', '', 'sp'),
            array(10393, '', '', '', '', '', '[猜]&nbsp;基于&nbsp;IP&nbsp;地理位置回答', '', '', 'sp'),
            array(10385, '', '', '', '', '', '有道翻译', '', '', 'sp'),
            array(10382, '', '', '', '', '', '尾号限行', '', '', 'sp'),
            array(10342, '<a target="_blank" href="', '//www.jushuo.com/', '', '" rel="external nofollow noreferrer', '">', '据说娱乐', '</a>', '', 'sp'),
            array(10319, '', '', '', '', '', '热门视频&nbsp;太平洋游戏网', '', '', 'sp'),
            array(10317, '', '', '', '', '', '网易彩票', '', '', 'sp'),
            array(10315, '', '', '', '', '', '开奖详情查询&nbsp;网易彩票', '', '', 'sp'),
            array(10306, '', '', '', '', '', '资讯&nbsp;网易彩票', '', '', 'sp'),
            array(10298, '<a target="_blank" href="', '//www.gov.cn/zwgk/2013-12/11/content_2546204.htm', '', '" rel="external nofollow noreferrer', '">', '2014年全年公休假放假安排&nbsp;中国政府网', '</a>', '放假通知', 'sp'),
            array(10268, '', '', '', '', '', '百度经验【组图】', '', '', 'sp'),
            array(10254, '', '', '', '', '', '全国猎聘网', '', '', 'sp'),
            array(10249, '<a target="_blank" href="', '//drugs.dxy.cn/search/drug.htm?keyword=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '药品搜索&nbsp;丁香园', '</a>', '', 'sp'),
            array(10244, '', '', '', '', '', '第&nbsp;2&nbsp;种百度经验', '', '', 'sp'),
            array(10240, '', '', '', '', '', '[猜]&nbsp;开奖&nbsp;新浪彩票', '', '', 'sp'),
            array(10239, '', '', '', '', '', '乐游网', '', '', 'sp'),
            array(10219, '<a target="_blank" href="', '//open.baidu.com/coop/kefu.html', '', '" rel="external nofollow noreferrer', '">', '第&nbsp;2&nbsp;种客服电话&nbsp;[3－4&nbsp;位]', '</a>', '', 'sp'),
            array(10213, '', '', '', '', '', '易登网', '', '', 'sp'),
            array(10210, '<a target="_blank" href="', '//www.showji.com/', '', '" rel="external nofollow noreferrer', '">', '手机号码归属地查询', '</a>', '', 'sp'),
            array(10201, '', '', '', '', '', '货币基金&nbsp;天天基金网', '', '', 'sp'),
            array(10199, '', '', '', '', '', '[猜]&nbsp;医院&nbsp;-&nbsp;悦美整形网', '', '', 'sp'),
            array(10197, '', '', '', '', '', '[猜]&nbsp;转诊预约&nbsp;-&nbsp;好大夫在线', '', '', 'sp'),
            array(10183, '', '', '', '', '', '时刻表&nbsp;票价&nbsp;同程网', '', '', 'sp'),
            array(10178, '', '', '', '', '', '展现多方观点&nbsp;百度知道', '', '', 'sp'),
            array(10175, '', '', '', '', '', '找好医院&nbsp;家庭医生在线', '', '', 'sp'),
            array(10162, '', '', '', '', '', '装修效果图大全&nbsp;齐家网', '', '', 'sp'),
            array(10161, '', '', '', '', '', '[猜]疾病&nbsp;寻医问药专家网', '', '', 'sp'),
            array(10139, '', '', '', '', '', '人民币利率&nbsp;和讯网', '', '', 'sp'),
            array(10118, '', '', '', '', '', '[猜]&nbsp;开奖&nbsp;hao123彩票', '', '', 'sp'),
            array(10094, '', '', '', '', '', '[猜]&nbsp;开奖结果&nbsp;体坛网', '', '', 'sp'),
            array(10077, '', '', '', '', '', '公务员考试真题试卷&nbsp;中公教育', '', '', 'sp'),
            array(10041, '<a target="_blank" href="', '//www.autohome.com.cn/', '', '" rel="external nofollow noreferrer', '">', '汽车之家', '</a>', '', 'sp'),
            array(10023, '<a target="_blank" href="', '//sports.sina.com.cn/g/premierleague/', '', '" rel="external nofollow noreferrer', '">', '英超&nbsp;新浪体育', '</a>', '', 'sp'),
            array(10015, '', '', '', '', '', '[猜]&nbsp;时间轴新闻&nbsp;腾讯网|新浪网', '', '', 'sp'),
            array(8041, '<a target="_blank" href="', '//sou.kuwo.cn/ws/NSearch?key=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '酷我音乐', '</a>', '', 'sp'),
            array(7136, '', '', '', '', '', '就医助手&nbsp;39健康网', '', '', 'sp'),
            array(7127, '<a target="_blank" href="', '//opendata.baidu.com/yaopin/s?ie=utf-8&amp;oe=utf-8&amp;wd=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '百度药品', '</a>', '', 'sp'),
            array(7123, '', '', '', '', '', '[猜]&nbsp;好大夫在线 推荐医院', '', '', 'sp'),
            array(7092, '', '', '', '', '', '航班信息', '', '', 'sp'),
            array(7086, '', '', '', '', '', '4399小游戏', '', '', 'sp'),
            array(7084, '', '', '', '', '', '点评&nbsp;中关村在线', '', '', 'sp'),
            array(7079, '<a target="_blank" href="', '//detail.zol.com.cn/', '', '" rel="external nofollow noreferrer', '">', '数码系列&nbsp;-&nbsp;中关村在线', '</a>', '', 'sp'),
            array(7076, '', '', '', '', '', '详情页&nbsp;-&nbsp;中关村在线', '', '', 'sp'),
            array(7074, '', '', '', '', '', '菜谱优质结果', '', '', 'sp'),
            array(7072, '', '', '', '', '', '[猜]&nbsp;洛克王国&nbsp;4399', '', '', 'sp'),
            array(7032, '', '', '', '', '', '车次查询&nbsp;去哪儿', '', '', 'sp'),
            array(7027, '', '', '', '', '', '物品&nbsp;178游戏网', '', '', 'sp'),
            array(6899, '<a target="_blank" href="', '//shixin.court.gov.cn/', '', '" rel="external nofollow noreferrer', '">', '全国失信被执行人名单', '</a>', '', 'sp'),
            array(6869, '', '', '', '', '', '影视新生态', '', '', 'sp'),
            array(6845, '', '', '', '', '', '小说', '', '', 'sp'),
            array(6835, '<a target="_blank" href="', '//rj.baidu.com/search/index/?kw=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', $query.'_百度软件中心', '</a>', '', 'sp'),
            array(6833, '', '', '', '', '', '百度百科&nbsp;多义词', '', '', 'sp'),
            array(6832, '', '', '', '', '', '旅游景点大全', '', '', 'sp'),
            array(6827, '<a target="_blank" href="', '//www.baidu.com/#wd=', $query.' 失信被执行人', '" rel="external nofollow noreferrer', '">', $query.'由于失信已被列入国家失信被执行人名单', '</a>', '', 'sp'),
            array(6826, '<a target="_blank" href="', '//shixin.court.gov.cn/', '', '" rel="external nofollow noreferrer', '">', '该企业已被列入全国失信被执行人名单中！', '</a>', '', 'sp'),
            array(6819, '<a target="_blank" href="', '//shixin.court.gov.cn/', '', '" rel="external nofollow noreferrer', '">', '全国法院失信被执行人名单', '</a>', '', 'sp'),
            array(6817, '', '', '', '', '', '百度视频', '', '', 'sp'),
            array(6811, '', '', '', '', '', '百度音乐', '', '', 'sp'),
            array(6804, '', '', '', '', '', '最新报价&nbsp;配置&nbsp;图片&nbsp;口碑&nbsp;油耗&nbsp;易车网', '', '', 'sp'),
            array(6801, '', '', '', '', '', '车型&nbsp;-&nbsp;易车网', '', '', 'sp'),
            array(6735, '<a target="_blank" href="', '//zhanzhang.baidu.com/wiki/256', '', '" rel="external nofollow noreferrer', '">', 'site特型', '</a>', '', 'sp'),
            array(6727, '', '', '', '', '', '[猜]&nbsp;左侧动漫作品', '', '', 'sp'),
            array(6714, '', '', '', '', '', '最佳答案', '', '', 'sp'),
            array(6705, '', '', '', '', '', '电视剧榜单', '', '', 'sp'),
            array(6700, '', '', '', '', '', '电影&nbsp;-&nbsp;百度团购', '', '', 'sp'),
            array(6691, '', '', '', '', '', '歌曲&nbsp;-&nbsp;百度音乐', '', '', 'sp'),
            array(6690, '', '', '', '', '', '电影&nbsp;-&nbsp;百度视频', '', '', 'sp'),
            array(6680, '<a target="_blank" href="', '//gouwu.baidu.com/s?wd=', $query, '" rel="external nofollow noreferrer', '">', '百度购物搜索', '</a>', '', 'ec'),
            array(6677, '', '', '', '', '', '网页应用&nbsp;百度阿拉丁', '', '', 'sp'),
            array(6670, '', '', '', '', '', '百度团购', '', '', 'sp'),
            array(6666, '', '', '', '', '', '百度招聘搜索', '', '', 'sp'),
            array(6665, '', '', '', '', '', '百度招聘会搜索', '', '', 'sp'),
            array(6653, '', '', '', '', '', '[猜]&nbsp;百度知心最佳答案', '', '', 'sp'),
            array(6112, '', '', '', '', '', '[猜]&nbsp;电视剧&nbsp;百度视频', '', '', 'sp'),
            array(6018, '', '', '', '', '', '日历&nbsp;[1－3&nbsp;位]', '', '', 'sp'),
            array(6017, '<a target="_blank" href="', '//forex.hexun.com/rmbhl/#zkRate', '', '" rel="external nofollow noreferrer', '">', '最新汇率&nbsp;[1－10&nbsp;位]', '</a>', '', 'sp'),
            array(6014, '<a target="_blank" href="', '//www.baidu.com/aladdin/js/iknow/iknowask.html', '', '" rel="external nofollow noreferrer', '">', '提问到百度知道', '</a>', '', 'sp'),
            array(6009, '', '', '', '', '', '万年历', '', '', 'sp'),
            array(6007, '', '', '', '', '', '计算器', '', '', 'sp'),
            array(6006, '<a target="_blank" href="', '//www.ip138.com/ips138.asp?ip=', $query, '" rel="external nofollow noreferrer', '">', 'IP地址查询', '</a>', '', 'sp'),
            array(6004, '<a target="_blank" href="', '//www.showji.com/search.htm?m=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '手机归属地', '</a>', '', 'sp'),
            array(4004, '', '', '', '', '', '快递查询&nbsp;快递100', '', '', 'ec'),
            array(4002, '', '', '', '', '', '单位换算&nbsp;百度阿拉丁', '', '', 'ec'),
            array(4001, '', '', '', '', '', '快递查询&nbsp;快递100', '', '', 'ec'),
            array(1599, '', '', '', '', '', '普通结果', '', '模版名2数据策略', 'as'),
            array(1581, '', '', '', '', '', '更多同站相关结果&gt;&gt;', '', '201412添加', 'as'),
            // 2015-09-25 Twitter - Wikipedia, the free encyclopedia // https://en.wikipedia.org/wiki/Twitter
            array(1553, '', '', '', '', '', '维基百科', '', '', 'as'),
            // 2015-06-23 如何在中国办理留学生学历认证 RED SCARF // www.honglingjin.co.uk/3023.html
            array(1551, '', '', '', '', '', '列表－模版', '', '201411添加&nbsp;QQ&nbsp;751476', 'as'),
            array(1550, '', '', '', '', '', '未知', '', '', 'as'),
            array(1549, '', '', '', '', '', '未知', '', '', 'as'),
            array(1548, '', '', '', '', '', '评分－结构化', '', '201408添加', 'as'),
            array(1547, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '百度百科', '</a>', '[201407添加]', 'ec'),
            array(1546, '', '', '', '', '', '未知', '', '', 'as'),
            array(1545, '', '', '', '', '', '非正规相册', '', '201412添加&nbsp;QQ&nbsp;1724102740', 'as'),
            array(1544, '', '', '', '', '', '未知', '', '', 'as'),
            array(1543, '', '', '', '', '', '面包屑－结构化', '', '', 'as'),
            array(1542, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '百度学术&nbsp;查看更多相关论文', '</a>', '', 'ec'),
            array(1541, '', '', '', '', '', '未知', '', '', 'as'),
            array(1540, '', '', '', '', '', '未知', '', '', 'as'),
            // 2015-01-08 搜外 搜外网 //www.seowhy.com/
            array(1539, '', '', '', '', '', '[官网]&nbsp;0－6&nbsp;个子链', '', '201405添加', 'as'),
            array(1538, '', '', '', '', '', '摘要－结构化', '', '', 'as'),
            array(1537, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '组图&nbsp;百度经验', '</a>', '', 'ec'),
            array(1536, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '一般答案&nbsp;百度知道', '</a>', '', 'ec'),
            array(1535, '', '', '', '', '', '未知，模版采用&nbsp;se_com_image_s', '', '模版', 'as'),
            array(1534, '', '', '', '', '', '未知，模版采用&nbsp;se_com_default', '', '模版', 'as'),
            array(1533, '', '', '', '', '', '论坛帖子', '', '', 'as'),
            array(1532, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '最佳答案&nbsp;百度知道', '</a>', '', 'ec'),
            // 在原用户查询词的基础上，通过一定的方法和策略把与原查询词相关的词、词组添加到原查询中，组成新的、更能准确表达用户查询意图的查询词序列，然后用新查询对文档重新检索，从而提高信息检索中的查全率和查准率。 李晓明; 闫宏飞; 王继民. 附录 术语//搜索引擎——原理、技术与系统(第二版). 2013年5月第9次印刷. 北京: 科学. 2012.5: 第322–323页 ISBN 7-03-034258-4 (简体中文)
            array(1531, '', '', '', '', '', '查询扩展', '', '', 'as'),
            array(1530, '', '', '', '', '', '百度贴吧&nbsp;更多贴吧相关帖子', '', '', 'as'),
            // 百度知道|搜狗问问(搜搜问问)|爱问知识人|39问医生|寻医问药网有问必答
            array(1529, '', '', '', '', '', '权威问答网站', '', '', 'as'),
            array(1528, '', '', '', '', '', '更多知道相关问题', '', '', 'as'),
            array(1527, '', '', '', '', '', '百度文库标签&nbsp;更多文库相关文档&gt;&gt;', '', '', 'ec'),
            array(1526, '', '', '', '', '', '更多文库相关文档', '', '', 'as'),
            array(1525, '', '', '', '', '', '百度文库', '', '', 'as'),
            array(1524, '', '', '', '', '', '缩略图结果', '', '但非每个查询词展现图片', 'as'),
            array(1523, '', '', '', '', '', 'robots.txt&nbsp;存在限制', '', '', 'as'),
            array(1522, '', '', '', '', '', '百度经验带相册', '', '', 'as'),
            array(1521, '<a target="_blank" href="', '//baike.baidu.com/search?word=', $query, '" rel="external nofollow noreferrer', '">', '图片&nbsp;百度百科(可能与查询词内容相关度较高)', '</a>', '', 'ec'),
            // 2015-01-08 无序的新世界 维普网 //www.cqvip.com/qk/95355X/200106/15044983.html
            array(1520, '', '', '', '', '', '期刊文献', '', '', 'as'),
            array(1519, '', '', '', '', '', '维基百科&nbsp;国际化', '', '', 'as'),
            array(1518, '', '', '', '', '', '软件下载&nbsp;国际化', '', '', 'as'),
            array(1517, '', '', '', '', '', '[图文]', '', '但并非每个查询词显示&nbsp;[图文]', 'as'),
            array(1516, '', '', '', '', '', '宗教&nbsp;国际化', '', '', 'as'),
            array(1515, '', '', '', '', '', '电影&nbsp;国际化', '', '', 'as'),
            array(1514, '', '', '', '', '', '在线文档－结构化', '', '', 'as'),
            array(1513, '', '', '', '', '', '软件下载－结构化', '', '', 'as'),
            array(1512, '', '', '', '', '', '单视频&nbsp;国际化', '', '', 'as'),
            array(1511, '', '', '', '', '', '[原创]&nbsp;星火计划', '', '', 'as'),
            array(1510, '', '', '', '', '', '子链&nbsp;国际化', '', '', 'as'),
            array(1509, '', '', '', '', '', '[官网]', '', '通常在 1－2 位', 'as'),
            array(1508, '', '', '', '', '', '单视频&nbsp;站点', '', '', 'as'),
            array(1507, '', '', '', '', '', '微博', '', '', 'as'),
            array(1506, '', '', '', '', '', '单视频', '', '', 'as'),
            array(1505, '', '', '', '', '', '百度知道&nbsp;高品质(知道达人|权威专家|官方机构)', '', '', 'as'),
            array(1504, '', '', '', '', '', '自动问答', '', '', 'as'),
            array(1503, '', '', '', '', '', '图片&nbsp;单视频', '', '', 'as'),
            array(1502, '', '', '', '', '', '百度百科', '', '', 'as'),
            array(1501, '', '', '', '', '', '评分－结构化', '', '', 'as'),
            array(1500, '', '', '', '', '', '无', '', '', 'as'),
            array(101, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '[猜]&nbsp;沙盒保护', '</a>', '', 'ec'),
            array(91, '<a target="_blank" href="', '//baike.baidu.com/search?word=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '百度百科&nbsp;[1－10&nbsp;位]', '</a>', '多义词', 'sp'),
            array(85, '<a target="_blank" href="', '//fanyi.baidu.com/#en/zh/', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '百度翻译|百度词典', '</a>', '', 'sp'),
            array(81, '<a target="_blank" href="', '//baike.baidu.com/search?word=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '百度百科_多义词', '</a>', '', 'sp'),
            array(80, '<a target="_blank" href="', '//baike.baidu.com/search?word=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '百度百科专有名词', '</a>', '', 'sp'),
            array(43, '<a target="_blank" href="', '//zhidao.baidu.com/new?ie=utf8&word=', $query, '" rel="external nofollow noreferrer', '">', '去百度知道提问', '</a>', '', 'ec'),
            array(37, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '最新图片', '</a>', '', 'ec'),
            array(34, '<a target="_blank" href="', '//www.baidu.com/s?rtt=2&tn=baiduwb&cl=2&wd=', $query, '" rel="external nofollow noreferrer', '">', '最新微博结果', '</a>', '', 'ec'),
            array(23, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '百度翻译', '</a>', '', 'ec'),
            array(19, '<a target="_blank" href="', '//www.baidu.com/s?tn=baidurt&amp;rtt=1&amp;bsst=1&amp;wd=', $query, '" rel="external nofollow noreferrer', '">', '最新相关消息', '</a>', '', 'ec'),
            array(10, '<a target="_blank" href="', '//tieba.baidu.com/f?kw=', preg_replace('/(\s+)/', '+', $query), '" rel="external nofollow noreferrer', '">', '百度贴吧&nbsp;[1－10&nbsp;位]', '</a>', '', 'sp'),
            array(5, '<a target="_blank" href="', '//music.baidu.com/search?key=', $query, '" rel="external nofollow noreferrer', '">', '百度音乐', '</a>', '', 'ec'),
            array(4, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '百度图片', '</a>', '', 'ec'),
            array(1, '<a target="_blank" href="', '', '', '" rel="external nofollow noreferrer', '">', '百度视频', '</a>', '', 'ec')
        );

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

        foreach ($n as $i => $v) {
            foreach ($srcid as $h => $v) {
                if ($n[$i][0] == $srcid[$h][0] && $srcid[$h][9] == 'as') {
                    echo '
                <tr class="back-white">
                    <td>
                        <a href="'.$n[$i][3].'" rel="external nofollow noreferrer" target="_blank">
                            '.stripslashes($n[$i][1]).'
                        </a>
                    </td>
                    <td class="center">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($n[$i][1], ENT_QUOTES))).'</td>
                    <td class="center">'.$srcid[$h][6].'</td>
                    <td class="center">'.$n[$i][2].'</td>
                </tr>';
                    unset($n[$i]);
                }
                elseif ($n[$i][0] == $srcid[$h][0] && $srcid[$h][9] == 'sp') {
                    echo '
                <tr class="back-egg">
                    <td>
                        '.$srcid[$h][1].$srcid[$h][2].$srcid[$h][3].$srcid[$h][4].$srcid[$h][5].$srcid[$h][6].$srcid[$h][7].'
                    </td>
                    <td class="center">
                        <a href="//www.weixingon.com/baidusp-srcid.php" target="_blank" rel="external nofollow noreferrer">'.$srcid[$h][9].'</a>
                    </td>
                    <td class="center">
                        <a target="_blank" href="//www.weixingon.com/baidusp-op.php?srcid='.$n[$i][0].'&amp;s='.preg_replace('/(\s+)/', '+', $n[$i][1]).'" rel="external nofollow noreferrer">'.$n[$i][0].'</a>
                    </td>
                    <td class="center">'.$n[$i][2].'</td>
                </tr>';
                    unset($n[$i]);
                }
                elseif ($n[$i][0] == $srcid[$h][0] && $srcid[$h][9] == 'ec') {
                    $np = array (
                        '/(http:\/\/privatehospital.health.vs-static.baidu.com)/',
                        '/(http:\/\/foodsearch.health.vs-static.baidu.com)/',
                        '/(http:\/\/nourl.ubs.baidu.com\/291228)/',
                        '/(http:\/\/fakeurl.baidu.com\/xueshu)/',
                        '/(http:\/\/29163.baidu.com)/',
                        '/(http:\/\/nourl.ubs.baidu.com\/29115)/',
                        '/(http:\/\/nourl.ubs.baidu.com\/29114)/',
                        '/(http:\/\/tsm.nuomi.com\/28026\/)/',
                        '/(http:\/\/jiaoyu.baidu.com)/',
                        '/(http:\/\/fanyi.baidu.com)/',
                        );
                    $nr = array (
                        '//jiankang.baidu.com/juhe/index?aType=1&amp;wd='.$query,
                        '//jiankang.baidu.com/Food/search?key='.$query,
                        '//temai.baidu.com/Index/index?wd='.$query,
                        '//xueshu.baidu.com/s?wd='.$query,
                        '//iwan.baidu.com/search?searchquery='.$query,
                        '//temai.baidu.com/Index/index?wd='.$query,
                        '//temai.baidu.com/Index/index?wd='.$query,
                        '//www.nuomi.com/search?ie=gbk&amp;k=',
                        '//jiaoyu.baidu.com/query/juhe?originQuery='.$query,
                        '//fanyi.baidu.com/#auto/zh/'.$query,
                        );
                    echo '
                <tr class="back-orange">
                    <td>
                        '.$srcid[$h][1].preg_replace($np, $nr, $n[$i][3]).$srcid[$h][4].$srcid[$h][5].$srcid[$h][6].$srcid[$h][7].'
                    </td>
                    <td class="center">
                        <a href="//ask.seowhy.com/question/9186" target="_blank" rel="external nofollow noreferrer" title="为什么有的搜索结果会没有百度参数，这样的现象原因是什么">'.$srcid[$h][9].'</a>
                    </td>
                    <td class="center">'.$n[$i][0].'</td>
                    <td class="center">'.$n[$i][2].'</td>
                </tr>';
                    unset($n[$i]);
                }
            }
            if ($n[$i] != null) {
                echo '
                <tr class="back-azure">
                    <td>未收进资源库</td>
                    <td></td>
                    <td class="center">
                        <a target="_blank" href="//www.weixingon.com/baidusp-op.php?srcid='.$n[$i][0].'&amp;s='.preg_replace('/(\s+)/', '+', $n[$i][1]).'" rel="external nofollow noreferrer">'.$n[$i][0].'</a>
                    </td>
                    <td class="center">'.$n[$i][2].'</td>
                </tr>';
            }
        }
        echo '
            </tbody>
        </table>
    </div>';
    }

    // 相关搜索

    if (preg_match_all("/(?<=&rs_src=[01]{1}&rsv_pq=[a-z0-9]{16}&rsv_t=)([\w\%]{50,64}\">)([\x80-\xff\w\s\.#\:\/\+\-]{0,32})(?=<\/a><\/th><)/", $se, $mrelated)) {

        // 随机更换下拉框提示 IP
        $sugip = array (
            'http://115.239.211.11',
            'http://115.239.211.12',
            'http://180.97.33.72',
            'http://180.97.33.73',
            );
        shuffle ($sugip);

        // 匹配百度搜索3种下拉框提示词
        $p3 = array ('/window\.baidu\.sug\({q:/', '/p:false,s:\[/', '/}\);/');
        $r3 = array ('[', '', '');
        $sug1 = json_decode(file_get_contents($sugip[0].'/su?action=opensearch&ie=UTF-8&wd='.$query));
        $sug2 = json_decode(file_get_contents($sugip[0].'/su?action=opensearch&ie=UTF-8&sugmode=2&wd='.$query));
        $sugunion = json_decode(preg_replace($p3, $r3, file_get_contents('http://unionsug.baidu.com/su?ie=UTF-8&wd='.$query)));

        echo '
    <div class="draglist" draggable="true">
        <table>
            <thead>
                    <tr>
                        <th>相关搜索</th>
                        <th>下拉框提示模式&nbsp;I</th>
                        <th>
                            <a href="//ask.seowhy.com/article/109" rel="external nofollow noreferrer" target="_blank" title="百度相关提示与搜索结果标题">下拉框提示模式&nbsp;II</a>
                        </th>
                        <th>百度搜索框提示</th>
                    </tr>
            </thead>
            <tbody>';

        for ($i = 0; $i <= 9; $i++) {
            echo '
                <tr class="back-azure">
                    <td>';
            if (strlen(@$mrelated[2][$i]) > 0) {
                echo '
                        <a href="'.$url.$l.preg_replace('/(\s+)/', '%20', @$mrelated[2][$i]).'" target="_blank">'
                        .@$mrelated[2][$i].'
                        </a>';
            }
            echo '
                    </td>
                    <td>';
            if (strlen(@$sug1[1][$i]) > 0) {
                echo '
                        <a href="'.$url.$l.preg_replace('/(\s+)/', '+', @$sug1[1][$i]).'" target="_blank">'
                        .@$sug1[1][$i].'
                        </a>';
            }
            echo '
                    </td>
                    <td>';
            if (strlen(@$sug2[1][$i]) > 0) {
                echo '
                        <a href="'.$url.$l.preg_replace('/(\s+)/', '+', @$sug2[1][$i]).'" target="_blank">'
                        .@$sug2[1][$i].'
                        </a>';
            }
            echo '
                    </td>
                    <td>';
            if (strlen(@$sugunion[$i+1]) > 0) {
                echo '
                        <a href="'.$url.$l.preg_replace('/(\s+)/', '+', @$sugunion[$i+1]).'" target="_blank">'
                        .@$sugunion[$i+1].'
                        </a>';
            }
            echo '
                    </td>
                </tr>';
        }
        echo '
            </tbody>
        </table>
    </div>';
    }

    // 为您推荐

    if (preg_match_all('/(?<=&p1=)(\d{1,2})("\s\n\s+target="_blank"\s\n\s+class="m">)(.+)(<\/div><div class="c-gap-top c-recommend" style="display:none;" data-extquery=")(.+)(?="><i class="c-icon c-icon-bear-circle c-gap-right-small">)/', $se, $mcrq)) {

        if (!is_null(@$mcrq)) {
            echo '
    <div class="draglist" draggable="true">
        <table>
            <thead>
                <tr>
                    <th colspan="4">为您推荐</th>
                </tr>
            </thead>
            <tbody>';

            foreach ($mcrq[1] as $g => $v) {
                $kz = (explode('&nbsp;', $mcrq[5][$g]));
                array_pop($kz);
                foreach ($kz as $f => $o) {
                    if ($f % 4 == 0) {
                        echo '
                <tr class="back-azure">';
                    }
                    echo '
                    <td>
                        <a href="'.$url.$l.preg_replace('/(\s+)/', '+', @$kz[$f]).'" target="_blank">'
                        .@$kz[$f].'</a>
                    </td>';
                    $f++;
                    if ($f % 4 == 0) {
                        echo '
                </tr>';
                    }
                }
                if ($f % 4 == 1) {
                    echo '
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
                }
                elseif ($f % 4 == 2) {
                    echo '
                    <td></td>
                    <td></td>
                </tr>';
                }
                elseif ($f % 4 == 3) {
                    echo '
                    <td></td>
                </tr>';
                }
            }
            echo '
            </tbody>
        </table>
    </div>';
        }
    }

    // F

    if (preg_match_all("/(?<=F':)(\s?)(')([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})(?=',)/", $se, $mf)) {
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

        foreach ($mf[3] as $i => $v) {
            $fvalue1 = $mf[3][$i];
            $fvalue2 = $mf[4][$i];
            $fvalue3 = $mf[5][$i];
            $fvalue4 = $mf[6][$i];
            $fvalue5 = $mf[7][$i];
            $fvalue6 = $mf[8][$i];
            $fvalue7 = $mf[9][$i];
            $fvalue8 = $mf[10][$i];
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
                    <td class="back-pink">'.@$msrcid[3][$i].'</td>
                </tr>';
        }
        echo '
            </tbody>
        </table>
    </div>';
    }

    // F1

    if (preg_match_all("/(?<=F1':)(\s?)(')([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})(?=',)/", $se, $mf1)) {
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

        foreach ($mf1[3] as $i => $v) {
            $f1value1 = $mf1[3][$i];
            $f1value2 = $mf1[4][$i];
            $f1value3 = $mf1[5][$i];
            $f1value4 = $mf1[6][$i];
            $f1value5 = $mf1[7][$i];
            $f1value6 = $mf1[8][$i];
            $f1value7 = $mf1[9][$i];
            $f1value8 = $mf1[10][$i];
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
                        <a href="//www.weixingon.com/baidusp-lm.php?s='.$query.'&amp;rn=50&amp;lm=7" target="_blank" title="yyyy年MM月dd日|hh小时前|mm分钟前|ss秒前" rel="external nofollow noreferrer">0-24小时前更新快照</a><br>6
                    </td>';
            }
            elseif ($f1value3 == '5') {
                echo '
                    <td class="unit-lavender">
                        <a href="//www.weixingon.com/baidusp-lm.php?s='.$query.'&amp;rn=50&amp;lm=7" target="_blank" title="yyyy年MM月dd日" rel="external nofollow noreferrer">24-48小时前更新快照</a><br>5
                    </td>';
            }
            elseif ($f1value3 == '4') {
                echo '
                    <td class="unit-tomato">
                        <a href="//www.weixingon.com/baidusp-lm.php?s='.$query.'&amp;rn=50&amp;lm=7" target="_blank" title="yyyy年MM月dd日" rel="external nofollow noreferrer">2-7天前更新快照</a><br>4
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
                        <a href="//www.weixingon.com/baidusp-hot.php?s='.$query.'" target="_blank" title="百度搜索热门词">新热门</a><br>5
                    </td>';
            }
            elseif ($f1value6 == '3') {
                echo '
                    <td class="unit-violet">
                        <a href="//www.weixingon.com/baidusp-hot.php?s='.$query.'" target="_blank" title="百度搜索热门词">中热门</a><br>3
                    </td>';
            }
            elseif ($f1value6 == '0') {
                echo '
                    <td class="unit-honeydew">
                        <a href="//www.weixingon.com/baidusp-hot.php?s='.$query.'" target="_blank" title="百度搜索热门词">老热门</a><br>0
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
                    <td class="back-yellow">'.@$msrcid[3][$i].'</td>
                </tr>';
        }
        echo '
            </tbody>
        </table>
    </div>';
    }

    // F2

    if (preg_match_all("/(?<=F2':)(\s?)(')([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})(?=',)/", $se, $mf2)) {
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
                    <th><a href="//ask.seowhy.com/question/8709" rel="external nofollow noreferrer" target="_blank" title="百度搜索结果参数 F2 和 rsv_sug9 探讨">F2</a></th>
                </tr>
            </thead>
            <tbody class="center">';
    
        foreach ($mf2[3] as $i => $v) {
            $f2value1 = $mf2[3][$i];
            $f2value2 = $mf2[4][$i];
            $f2value3 = $mf2[5][$i];
            $f2value4 = $mf2[6][$i];
            $f2value5 = $mf2[7][$i];
            $f2value6 = $mf2[8][$i];
            $f2value7 = $mf2[9][$i];
            $f2value8 = $mf2[10][$i];
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
                        <a href="//www.weixingon.com/wordcount/#exp" target="_blank" title="名词解释">大字标题&nbsp;(-)&nbsp;网页标题</a><br>F
                    </td>';
            }
            elseif ($f2value8 == 'E') {
                echo '
                    <td class="unit-deepskyblue">
                        大字标题<br>
                        headline<br>E
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
                    <td class="back-green">'.@$msrcid[3][$i].'</td>
                </tr>';
        }
        echo'
            </tbody>
        </table>
    </div>';
    }

    // F3

    if (preg_match_all("/(?<=F3':)(\s?)(')([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})(?=',)/", $se, $mf3)) {
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
                    <th><a href="//ask.seowhy.com/article/41" rel="external nofollow noreferrer" target="_blank" title="对吴星关于“F系列”参数研究的看法">F3</a></th>
                </tr>
            </thead>
            <tbody class="center">';

        foreach ($mf3[3] as $i => $v) {
            $f3value1 = $mf3[3][$i];
            $f3value2 = $mf3[4][$i];
            $f3value3 = $mf3[5][$i];
            $f3value4 = $mf3[6][$i];
            $f3value5 = $mf3[7][$i];
            $f3value6 = $mf3[8][$i];
            $f3value7 = $mf3[9][$i];
            $f3value8 = $mf3[10][$i];
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
                        主域名、子域名优先级较低<br>
                        或内容相对充实的目录、详情页<br>2
                    </td>';
            }
            elseif ($f3value5 == 'B') {
                echo '
                    <td class="unit-springgreen">
                        目录|详情页优先级较高<br>B
                    </td>';
            }
            elseif ($f3value5 == 'A') {
                echo '
                    <td class="unit-aquamarine">
                        主域名、子域名优先级较高<br>
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
                        目录|详情页优先级较低<br>3
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
                    <td class="back-blue">'.@$msrcid[3][$i].'</td>
                </tr>';
        }
        echo '
            </tbody>
        </table>
    </div>';
    }

    // 摘要

    if (preg_match_all('/(?<=<div class="c-abstract">)(.*)(?=<\/div><div class="f13">)/', $se, $mabs)) {
        echo '
    <table>
        <thead>
            <tr>
                <th>摘要<br>abstract</th>
                <th>排序</th>
            </tr>
        </thead>
        <tbody class="break">';

        foreach ($mabs[1] as $i => $v) {
            echo '
            <tr class="back-gold">
                <td>'.strip_tags($mabs[1][$i]).'</td>
                <td class="center">'.($i+1).'</td>
            </tr>';
        }
        echo '
        </tbody>
    </table>';
    }

    // template

    if (preg_match_all('/(?<=" tpl=")([0-9a-z_]{3,28})(?=")/', $se, $mtpl)) {

        // y

        if (preg_match_all("/(?<='y':')([0-9A-F]{8})(?=')/", $se, $my)) {

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

            foreach ($mtpl[1] as $i => $v) {
                echo '
                <tr class="back-sky">
                    <td>'.$mtpl[1][$i].'</td>
                    <td class="center">'.@$my[1][$i].'</td>
                    <td class="center">'.($i+1).'</td>
                </tr>';
            }
        echo '
            </tbody>
        </table>
    </div>';    
        }
    }

    // 右侧知心打分

    $score = json_decode(file_get_contents
    ('http://opendata.baidu.com/api.php?resource_id=21028&format=json&ie=utf-8&oe=utf-8&query='.$query), true);

    if (is_array(@$score['data'][0]['card'][0]['unit'])) {
        echo '
    <div class="draglist" draggable="true">
        <table>
            <thead>
                <tr>
                    <th>右侧知心推荐</th>
                    <th>打分</th>
                    <th>右侧知心推荐</th>
                    <th>打分</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($score['data'][0]['card'] as $i => $v) {
            foreach ($score['data'][0]['card'][$i]['unit'] as $j => $o) {
                if ($j % 2 == 0) {
                echo '
                <tr class="back-egg">';
                }
                echo '
                    <td class="center">
                        <a href="'.$url.$l.preg_replace('/(\s+)/', '+', $score['data'][0]['card'][$i]['unit'][$j]['name']).'" target="_blank">'.$score['data'][0]['card'][$i]['unit'][$j]['name'].'</a>
                    </td>
                    <td class="center">';

                // 对齐分值
                $scores = ((preg_replace('/(score=)/', '', $score['data'][0]['card'][$i]['unit'][$j]['uri_drsv'])) * 10000);

                if (preg_match('/-(\d){4}/', $scores)) {
                    echo '-'.preg_replace('/-/', '', $scores);
                }
                elseif (preg_match('/(\d){4}/', $scores)) {
                    echo $scores;
                }
                elseif (preg_match('/-(\d){3}/', $scores)) {
                    echo '-0'.preg_replace('/-/', '', $scores);
                }
                elseif (preg_match('/(\d){3}/', $scores)) {
                    echo '0'.$scores;
                }
                elseif (preg_match('/-(\d){2}/', $scores)) {
                    echo '-00'.preg_replace('/-/', '', $scores);
                }
                elseif (preg_match('/(\d){2}/', $scores)) {
                    echo '00'.$scores;
                }
                elseif (preg_match('/-(\d){1}/', $scores)) {
                    echo '-000'.preg_replace('/-/', '', $scores);
                }
                elseif (preg_match('/(\d){1}/', $scores)) {
                    echo '000'.$scores;
                }
                else {
                    echo $scores;
                }
                echo '</td>';
                $j++;
                if ($j % 2 == 0) {
                    echo '
                </tr>';
                }
            }
            if ($j % 2 == 1)  {
                echo '
                    <td></td>
                    <td></td>
                </tr>';
            }
        }
        echo '
            </tbody>
        </table>
    </div>';
    }

    // 周围人都在搜

    if (preg_match_all('/(?<=&r_type=text&r_key=hot-1&r_wd=)(.{1,50})(?=" class=link data-type=hl-mod-link target=)/', file_get_contents("http://entry.baidu.com/ur/scun?di=contentunion4170"), $maround)) {
        echo '
    <table>
        <thead>
            <tr>
                <th colspan="4">周围人都在搜</th>
            </tr>
        </thead>
        <tbody>';

        foreach ($maround[0] as $i => $v) {
            if ($i % 4 == 0) {
                echo '
            <tr class="back-azure">';
            }
            echo '
                <td>
                    <a href="'.$url.$l.$maround[0][$i].'" target="_blank">'.$maround[0][$i].'</a>
                </td>';
            $i++;
            if ($i % 4 == 0) {
                echo '
            </tr>';
            }
        }

        if (count($maround[0]) % 4 == 1)  {
            echo '
                <td>
                    <a href="https://github.com/ausdruck/baidu-prm/blob/master/baidu-f.php" target="_blank" rel="external nofollow noreferrer">百度参数分析工具</a>
                </td>
                <td>
                    <a href="//www.weixingon.com/feed.xml" target="_blank" rel="nofollow noreferrer">更新日志</a>
                </td>
                <td>
                    <a href="//www.weixingon.com/chaolianfenxi.html" target="_blank">超链分析</a>
                </td>
            </tr>';
        }
        elseif (count($maround[0]) % 4 == 2)  {
            echo '
                <td>
                    <a href="https://github.com/ausdruck/baidu-prm/blob/master/baidu-f.php" target="_blank" rel="external nofollow noreferrer">百度参数分析工具</a>
                </td>
                <td>
                    <a href="//www.weixingon.com/feed.xml" target="_blank" rel="nofollow noreferrer">更新日志</a>
                </td>
            </tr>';
        }
        elseif (count($maround[0]) % 4 == 3)  {
            echo '
                <td>
                    <a href="https://github.com/ausdruck/baidu-prm/blob/master/baidu-f.php" target="_blank" rel="external nofollow noreferrer">百度参数分析工具</a>
                </td>
            </tr>';
        }

    echo '
        </tbody>
    </table>
';
    }
}
?>

    <table style="border:none;">
        <tbody>
            <tr>
                <td class="center" style="font-size:2em; border:none;">
                    <strong>
                        <a class="pink" href="#">
                            &nbsp;&nbsp;返&nbsp;&nbsp;&nbsp;&nbsp;回&nbsp;&nbsp;&nbsp;&nbsp;顶&nbsp;&nbsp;&nbsp;&nbsp;部&nbsp;&nbsp;
                        </a>
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="left_outer" style="display: block;">
    <div class="left_inner">
        <div class="left">
            <p><strong>搜索</strong><br>
<a href="https://www.google.com/#q=<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank" title="vpn">谷歌搜索</a><br>
<a href="//www.baidu.com/s?wd=<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank">百度一下</a><br>
<a href="//www.haosou.com/s?q=<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank">好搜一下</a><br>
<a href="//www.sogou.com/web?query=<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank">搜狗搜索</a><br>
<a href="//cn.bing.com/search?q=<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank">必应</a><br>
<a href="//s.weibo.com/weibo/<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank">微博搜索</a><br>
<a href="https://web.archive.org/web/*/<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank" title="vpn">Internet Archive</a><br>
<a href="//www.ask.com/web?q=<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank" title="What's Your Question?">Ask.com</a><br>
<strong>词典</strong><br>
<a href="//fanyi.baidu.com/#auto/zh/<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank">百度翻译</a><br>
<a href="//translate.google.cn/#auto/zh-CN/<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank">谷歌翻译</a><br>
<a href="//www.zdic.net" rel="external nofollow noreferrer" target="_blank">汉典</a><br>
<strong>工具</strong><br>
<a href="https://mail.google.com/mail/u/0/#inbox" rel="external nofollow noreferrer" target="_blank" title="vpn">Gmail</a><br>
<a href="//douban.fm/" rel="external nofollow noreferrer" target="_blank" title="音乐">豆瓣FM</a><br>
<a href="https://developers.google.com/structured-data/testing-tool/" rel="external nofollow noreferrer" target="_blank" title="vpn">结构化数据测试</a><br>
<a href="https://validator.w3.org/unicorn/check?ucn_task=conformance&amp;ucn_uri=<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank">W3C 统一验证</a><br>
<a href="https://developers.google.com/speed/pagespeed/insights/?url=<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank" title="vpn">PageSpeed</a><br>
<a href="//developer.baidu.com/apm/index" rel="external nofollow noreferrer" target="_blank">应用性能监测中心</a><br>
<a href="//www.aizhan.com/" rel="external nofollow noreferrer" target="_blank">爱站网</a><br>
<a href="//seo.chinaz.com/" rel="external nofollow noreferrer" target="_blank">站长工具</a><br>
<a href="https://moz.com/researchtools/ose/links?filter=&amp;source=external&amp;target=page&amp;group=0&amp;page=1&amp;sort=page_authority&amp;anchor_id=&amp;anchor_type=&amp;anchor_text=&amp;from_site=&amp;site=<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank">Moz</a><br>
<a href="https://cmn.ahrefs.com/site-explorer" rel="external nofollow noreferrer" target="_blank">ahrefs</a><br>
<a href="https://majestic.com/reports/site-explorer?q=<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank">Majestic</a><br>
<a href="//www.alexa.com/siteinfo/<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank" title="vpn">Alexa</a><br>
<a href="//www.5118.com/" rel="external nofollow noreferrer" target="_blank">5118 站长大数据</a><br>
<a href="//www.chaoji.com/seoreport.aspx" rel="external nofollow noreferrer" target="_blank">seo 数据风向标</a><br>
<a href="//www.convertstring.com/zh_CN/EncodeDecode/UrlDecode" rel="external nofollow noreferrer" target="_blank">Url 编解码</a><br>
<a href="//tool.chinaz.com/Tools/unixtime.aspx" rel="external nofollow noreferrer" target="_blank">Unix 时间戳</a><br>
<a href="https://adwords.google.com/da/DisplayPlanner/Home" rel="external nofollow noreferrer" target="_blank" title="vpn">Google AdWords</a><br>
<a href="//support.google.com/analytics/bin/answer.py?hl=zh-Hans&amp;answer=1033867" rel="external nofollow noreferrer" target="_blank" title="vpn">网址构建工具</a><br>
<a href="//creativecommons.org/choose/" rel="external nofollow noreferrer" target="_blank">creative common</a></p>
            <p>百度参数QQ群<br>255363059</p>
        </div>
    </div>
</div>

<div class="right_outer" style="display: block;">
    <div class="right_inner">
        <div class="right">
            <p><strong>导航</strong><br>
<a href="//www.douban.com" rel="external nofollow noreferrer" target="_blank">豆瓣</a><br>
<a href="//www.zhihu.com" rel="external nofollow noreferrer" target="_blank">知乎</a><br>
<a href="https://www.pinterest.com" rel="external nofollow noreferrer" target="_blank">pinterest</a><br>
<a href="//www.ruanyifeng.com/blog/" rel="external nofollow noreferrer" target="_blank">阮一峰的网络日志</a><br>
<a href="//www.jintian.net/today/" rel="external nofollow noreferrer" target="_blank">今天</a><br>
<a href="//www.huxiu.com" rel="external nofollow noreferrer" target="_blank">虎嗅</a><br>
<a href="https://support.google.com/webmasters/answer/72462?hl=zh-Hans" rel="external nofollow noreferrer" target="_blank" title="vpn">移动网站开发详情</a><br>
<a href="//www.smashingmagazine.com/tag/wallpapers/" rel="external nofollow noreferrer" target="_blank">Wallpaper</a><br>
<a href="//googlewebmastercentral.blogspot.com" rel="external nofollow noreferrer" target="_blank" title="vpn">谷歌网管中心</a><br>
<strong>文档</strong><br>
<a href="//deerchao.net/tutorials/regex/regex.htm" rel="external nofollow noreferrer" target="_blank">正则表达式入门</a><br>
<a href="https://github.com/taobao/nginx-book" rel="external nofollow noreferrer" target="_blank">Nginx book</a><br>
<a href="//nginx.org/en/docs/" rel="external nofollow noreferrer" target="_blank">nginx 文档</a><br>
<a href="https://zh.wikibooks.org/zh-cn/Lisp_%E5%85%A5%E9%96%80" rel="external nofollow noreferrer" target="_blank">Lisp 入门</a><br>
<a href="//www.w3school.com.cn/tags/html_ref_entities.html" rel="external nofollow noreferrer" target="_blank">HTML ISO</a><br>
<a href="https://github.com/ausdruck/spec" rel="external nofollow noreferrer" target="_blank">百度内部编码规范</a><br>
<a href="//schema.org/docs/full.html" rel="external nofollow noreferrer" target="_blank" title="vpn">微数据层级</a><br>
<a href="//www.html-5.com/microdata/breadcrumbs/index.html" rel="external nofollow noreferrer" target="_blank">Breadcrumb Trail</a><br>
<a href="https://developers.google.com/speed/articles/optimizing-html" rel="external nofollow noreferrer" target="_blank" title="vpn">Reducing file size</a><br>
<strong>站长平台</strong><br>
<a href="https://www.google.com/webmasters/tools/home?hl=zh" rel="external nofollow noreferrer" target="_blank" title="vpn">谷歌网管工具</a><br>
<a href="//cn.bing.com/webmaster/" rel="external nofollow noreferrer" target="_blank">必应网管工具</a><br>
<a href="//zhanzhang.baidu.com/site/index" rel="external nofollow noreferrer" target="_blank">百度站长平台</a><br>
<a href="//zhanzhang.sogou.com/index.php/dashboard/index" rel="external nofollow noreferrer" target="_blank">搜狗站长平台</a><br>
<a href="//zhanzhang.so.com" rel="external nofollow noreferrer" target="_blank">好搜站长平台</a><br>
<a href="//mp.weixin.qq.com/" rel="external nofollow noreferrer" target="_blank">微信公众平台登录</a><br>
<strong>统计</strong><br>
<a href="https://www.google.com/trends/explore#q=<?php echo $query;?>" rel="external nofollow noreferrer" target="_blank" title="vpn">Google Trends</a><br>
<a href="//index.baidu.com/" rel="external nofollow noreferrer" target="_blank">百度指数</a><br>
<a href="//tongji.baidu.com/web/welcome/login" rel="external nofollow noreferrer" target="_blank">百度统计</a><br>
<a href="//www.google.com/analytics/ce/mws/" rel="external nofollow noreferrer" target="_blank" title="vpn">Google Analytics</a><br>
<a href="//i.baidu.com/my/history" rel="external nofollow noreferrer" target="_blank">百度搜索历史记录</a><br></p>
            <p><a class="pink" href="#">&nbsp;&nbsp;返&nbsp;&nbsp;&nbsp;回&nbsp;&nbsp;&nbsp;顶&nbsp;&nbsp;&nbsp;部&nbsp;&nbsp;</a></p>
        </div>
    </div>
</div>
<script>
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

(function(){var A=window.baidu||{version:"1-1-0"};A.object=A.object||{};A.object.extend=function(B,D){for(var C in D){if(D.hasOwnProperty(C)){B[C]=D[C]}}};A.extend=A.object.extend;A.dom=A.dom||{};A.dom.g=function(B){if("string"==typeof B||B instanceof String){return document.getElementById(B)}else{if(B&&(B.nodeName&&(B.nodeType==1||B.nodeType==9))){return B}}return null};A.g=A.G=A.dom.g;A.dom.getDocument=function(B){B=A.dom.g(B);return B.nodeType==9?B:B.ownerDocument||B.document};A.dom._styleFixer=A.dom._styleFixer||{};A.dom._styleFilter=A.dom._styleFilter||[];A.dom._styleFilter.filter=function(C,G,E){for(var B=0,D=A.dom._styleFilter,F;F=D[B];B++){if(F=F[E]){G=F(C,G)}}return G};A.string=A.string||{};A.string.toCamelCase=function(B){return String(B).replace(/[-_]\D/g,function(C){return C.charAt(1).toUpperCase()})};A.dom.getStyle=function(F,G){var D=A.dom;F=D.g(F);G=A.string.toCamelCase(G);var B=F.style[G];if(B){return B}var C=D._styleFixer[G],E=F.currentStyle||(A.browser.ie?F.style:getComputedStyle(F,null));B="object"==typeof C&&C.get?C.get(F,E):E[C||G];if(C=D._styleFilter){B=C.filter(G,B,"get")}return B};A.getStyle=A.dom.getStyle;A.browser=A.browser||{};if(/msie (\d+\.\d)/i.test(navigator.userAgent)){A.ie=A.browser.ie=parseFloat(RegExp.$1)}if(/opera\/(\d+\.\d)/i.test(navigator.userAgent)){A.browser.opera=parseFloat(RegExp.$1)}A.browser.isWebkit=/webkit/i.test(navigator.userAgent);A.browser.isGecko=/gecko/i.test(navigator.userAgent)&&!/like gecko/i.test(navigator.userAgent);A.browser.isStrict=document.compatMode=="CSS1Compat";A.dom.getPosition=function(D){var B=A.dom.getDocument(D),E=A.browser;D=A.dom.g(D);var I=E.isGecko>0&&(B.getBoxObjectFor&&(A.dom.getStyle(D,"position")=="absolute"&&(D.style.top===""||D.style.left===""))),J={left:0,top:0},H=E.ie&&!E.isStrict?B.body:B.documentElement;if(D==H){return J}var C=null,F;if(D.getBoundingClientRect){F=D.getBoundingClientRect();J.left=Math.floor(F.left)+Math.max(B.documentElement.scrollLeft,B.body.scrollLeft);J.top=Math.floor(F.top)+Math.max(B.documentElement.scrollTop,B.body.scrollTop);J.left-=B.documentElement.clientLeft;J.top-=B.documentElement.clientTop;if(E.ie&&!E.isStrict){J.left-=2;J.top-=2}}else{if(B.getBoxObjectFor&&!I){F=B.getBoxObjectFor(D);var G=B.getBoxObjectFor(H);J.left=F.screenX-G.screenX;J.top=F.screenY-G.screenY}else{C=D;do{J.left+=C.offsetLeft;J.top+=C.offsetTop;if(E.isWebkit>0&&A.dom.getStyle(C,"position")=="fixed"){J.left+=B.body.scrollLeft;J.top+=B.body.scrollTop;break}C=C.offsetParent}while(C&&C!=D);if(E.opera>0||E.isWebkit>0&&A.dom.getStyle(D,"position")=="absolute"){J.top-=B.body.offsetTop}C=D.offsetParent;while(C&&C!=B.body){J.left-=C.scrollLeft;if(!b.opera||C.tagName!="TR"){J.top-=C.scrollTop}C=C.offsetParent}}}return J};A.event=A.event||{};A.event._unload=function(){var C=A.event._listeners,B=C.length,D=!(!window.removeEventListener),E,F;while(B--){E=C[B];F=E[0];if(F.removeEventListener){F.removeEventListener(E[1],E[3],false)}else{if(F.detachEvent){F.detachEvent("on"+E[1],E[3])}}}if(D){window.removeEventListener("unload",A.event._unload,false)}else{window.detachEvent("onunload",A.event._unload)}};if(window.attachEvent){window.attachEvent("onunload",A.event._unload)}else{window.addEventListener("unload",A.event._unload,false)}A.event._listeners=A.event._listeners||[];A.event.on=function(F,B,E){B=B.replace(/^on/i,"");if("string"==typeof F){F=A.dom.g(F)}var C=function(G){E.call(F,G)},D=A.event._listeners;D[D.length]=[F,B,E,C];if(F.attachEvent){F.attachEvent("on"+B,C)}else{if(F.addEventListener){F.addEventListener(B,C,false)}}return F};A.on=A.event.on;A.event.preventDefault=function(B){if(B.preventDefault){B.preventDefault()}else{B.returnValue=false}};A.ui=A.ui||{};A.suggestion=A.ui.suggestion=A.ui.suggestion||{};(function(){var B={},C=function(E){var D={};E.listen=function(F,H){D[F]=D[F]||[];var G=0;while(G<D[F].length&&D[F][G]!=H){G++}if(G==D[F].length){D[F].push(H)}return E};E.call=function(G){if(D[G]){for(var F=0;F<D[G].length;F++){D[G][F].apply(this,Array.prototype.slice.call(arguments,1))}}return E}};B.extend=function(D){new C(D);return D};B.extend(B);A.suggestion._Central=B})();A.ui.suggestion._Div=function(V,o,Z,a,X){var d=this,h,T,Y,l,f=X.class_prefix,U,S=document.createElement("DIV");S.id=f+(new Date()).getTime();S.className=f+"wpr";S.style.display="none";var c=document.createElement("IFRAME");c.className=f+"sd";c.style.display="none";c.style.position="absolute";c.style.borderWidth="0px";if(X.apd_body){document.body.appendChild(S)}else{o.parentNode.appendChild(S)}S.parentNode.insertBefore(c,S);V.listen("start",function(){A.on(document,"mousedown",function(B){B=B||window.event;var C=B.target||B.srcElement;if(C==o){return }while(C=C.parentNode){if(C==S){return }}W()});A.on(window,"blur",W)});V.listen("key_enter",function(){var B=i(),C=B[0]==-1?l:B[1];X.onconfirm(Z.getValue(),B[0],C,B[2],true);W()});function m(F,D){if(S.style.display=="none"){V.call("need_data",Z.getValue());return }var B=i()[0];j();if(F){if(B==0){g(D);B--;return }if(B==-1){B=T.length}B--}else{if(B==T.length-1){g(D);B=-1;return }B++}n(B);k();var E=Z.getValue();g(B);var C=i();X.onpick(E,C[0],C[1],C[2])}V.listen("key_up",function(B){m(1,B)});V.listen("key_down",function(B){m(0,B)});V.listen("key_tab",W);V.listen("key_esc",W);V.listen("all_clear",W);V.listen("data_ready",function(E,C){l=C;T=[];Y=[];for(var B=0,D=C.length;B<D;B++){if(typeof C[B].input!="undefined"){T[B]=C[B].input;Y[B]=C[B].selection}else{Y[B]=T[B]=C[B]}}if(T.length!=0){U=a(S,Y,d);for(var B=0,D=U.length;B<D;B++){A.on(U[B],"mouseover",function(){j();this.className=f+"mo";k()});A.on(U[B],"mouseout",j);A.on(U[B],"mousedown",function(F){V.call("mousedown_item");if(!A.ie){F.stopPropagation();F.preventDefault();return false}});A.on(U[B],"click",e(B))}}else{W()}});function j(){for(var B=0;B<U.length;B++){U[B].className=f+"ml"}}function i(){if(U&&S.style.display!="none"){for(var B=0;B<U.length;B++){if(U[B].className==f+"mo"){return[B,T[B],Y[B]]}}}return[-1,""]}function k(){var B=i();X.onhighlight(Z.getValue(),B[0],B[1],B[2])}function n(B){j();U[B].className=f+"mo"}function g(C){var B=T&&(typeof C=="number"&&typeof T[C]!="undefined")?T[C]:C;V.call("pick_word",B)}function W(){if(S.style.display=="none"){return null}c.style.display=S.style.display="none";X.onhide()}function e(B){var C=B;return function(){V.call("confirm_item",Z.getValue(),T[C],C,Y[C]);var D=Z.getValue();g(T[C]);X.onpick(D,C,T[C],Y[C]);X.onconfirm(Z.getValue(),C,T[C],Y[C]);W()}}return{element:S,shade:c,pick:g,highlight:n,hide:W,dispose:function(){S.parentNode.removeChild(S)}}};A.ui.suggestion._Data=function(D,B){var C=this,E={};D.listen("response_data",function(G,F){E[G]=F;D.call("data_ready",G,F)});D.listen("need_data",function(F){if(typeof E[F]=="undefined"){B(F)}else{D.call("data_ready",F,E[F])}});return{}};A.ui.suggestion._InputWatcher=function(H,G,E){var F=this,K,D=0,L="",C="",J="",M,I=false,N=false,B=false;G.setAttribute("autocomplete","off");A.on(G,"keydown",function(O){if(!B){H.call("start");B=true}O=O||window.event;var P;switch(O.keyCode){case 9:P="tab";break;case 27:P="esc";break;case 13:P="enter";break;case 38:P="up";A.event.preventDefault(O);break;case 40:P="down"}if(P){H.call("key_"+P,C)}});A.on(G,"mousedown",function(){if(!B){H.call("start");B=true}});A.on(G,"beforedeactivate",function(){if(I){window.event.cancelBubble=true;window.event.returnValue=false}});H.listen("start",function(){J=G.value;D=setInterval(function(){if(N){return }if(A.G(G)==null){suggestion.dispose()}var O=G.value;if(O==L&&(O!=""&&(O!=J&&O!=M))){if(K==0){K=setTimeout(function(){H.call("need_data",O)},100)}}else{clearTimeout(K);K=0;if(O==""&&L!=""){M="";H.call("all_clear")}L=O;if(O!=M){C=O}if(J!=G.value){J=""}}},10)});H.listen("pick_word",function(O){if(I){G.blur()}G.value=M=O;if(I){G.focus()}});H.listen("mousedown_item",function(O){I=true;N=true;setTimeout(function(){N=false;I=false},500)});H.listen("confirm_item",function(R,P,Q,O){N=false;C=L=Q});return{getValue:function(){return G.value},dispose:function(){clearInterval(D)}}};A.ui.suggestion._Suggestion=function(F,B){var E=this,C=A.ui.suggestion._MessageDispatcher;E.options={onpick:function(){},onconfirm:function(){},onhighlight:function(){},onhide:function(){},view:null,getData:false,prepend_html:"",append_html:"",class_prefix:"tangram_sug_",apd_body:false};A.extend(E.options,B);if(!(F=A.G(F))){return null}E.inputElement=F;if(F.id){E.options._inputId=F.id}else{F.id=E.options._inputId=E.options.class_prefix+"ipt"+(new Date()).getTime()}E._adjustPos=function(S){var J=G.element,M=G.shade,P=document,N=P.compatMode=="BackCompat"?P.body:P.documentElement,O=N.clientHeight,K=N.clientWidth;if(J.style.display=="none"&&S){return }var Q=A.dom.getPosition(F),L=[Q.top+F.offsetHeight-1,Q.left,F.offsetWidth];L=typeof E.options.view=="function"?E.options.view(L):L;J.style.display=M.style.display="block";M.style.top=L[0]+"px";M.style.left=L[1]+"px";M.style.width=L[2]+"px";var V=parseFloat(A.getStyle(J,"marginTop"))||0,R=parseFloat(A.getStyle(J,"marginLeft"))||0;J.style.top=L[0]-V+"px";J.style.left=L[1]-R+"px";if(A.ie&&document.compatMode=="BackCompat"){J.style.width=L[2]+"px"}else{var U=parseFloat(A.getStyle(J,"borderLeftWidth"))||0,W=parseFloat(A.getStyle(J,"borderRightWidth"))||0,T=parseFloat(A.getStyle(J,"marginRight"))||0;J.style.width=L[2]-U-W-R-T+"px"}M.style.height=J.offsetHeight+"px";if(O!=N.clientHeight||K!=N.clientWidth){E._adjustPos()}};E._draw=function(M,T){var Q=[],L=document.createElement("TABLE");L.cellPadding=2;L.cellSpacing=0;var R=document.createElement("TBODY");L.appendChild(R);for(var O=0,J=T.length;O<J;O++){var S=R.insertRow(-1);Q.push(S);var K=S.insertCell(-1);K.innerHTML=T[O]}var P=document.createElement("DIV");P.className=E.options.class_prefix+"pre";P.innerHTML=E.options.prepend_html;var N=document.createElement("DIV");N.className=E.options.class_prefix+"app";N.innerHTML=E.options.append_html;M.innerHTML="";M.appendChild(P);M.appendChild(L);M.appendChild(N);E._adjustPos();return Q};var H=A.suggestion._Central.extend(E),D=new A.ui.suggestion._Data(H,E.options.getData),I=new A.ui.suggestion._InputWatcher(H,F,G),G=new A.ui.suggestion._Div(H,F,I,E._draw,E.options);H.listen("start",function(){setInterval(function(){var J=G.element;if(J.offsetWidth!=0&&F.offsetWidth!=J.offsetWidth){E._adjustPos()}},100);A.on(window,"resize",function(){E._adjustPos(true)})});return{pick:G.pick,hide:G.hide,highlight:G.highlight,getElement:function(){return G.element},getData:E.options.getData,giveData:function(K,J){H.call("response_data",K,J)},dispose:function(){G.dispose();I.dispose()}}};A.ui.suggestion.create=function(B,C){return new A.ui.suggestion._Suggestion(B,C)};window.baidu=A})();var BaiduSuggestion=(function(){var D={};var E={};function O(P){return document.createElement(P)}var J={createSugOptions:function(S,R,Q,P){return{class_prefix:"bdSug_",onconfirm:function(Y,W,U,V,X){if(Q&&W>-1){try{Q.apply(window,[U])}catch(T){}}if(P&&!X){P.submit()}},view:function(T){if(R&&R.width){T[2]=parseInt(R.width)}if(R&&R.XOffset&&R.YOffset){return[T[0]-R.YOffset,T[1]-R.XOffset,T[2]]}return[T[0],T[1],T[2]]},getData:function(U){var V=(new Date()).getTime();var W=baidu.G("bdSug_script");if(W){document.body.removeChild(W)}var T=O("script");T.setAttribute("charset","gbk");T.src="//unionsug.baidu.com/su?wd="+encodeURIComponent(U)+"&p=3&cb=BaiduSuggestion.callbacks.give"+S+"&t="+V;T.id="bdSug_script";document.body.appendChild(T)},append_html:"",apd_body:true}},createSugCallback:function(P){return function(R){if(!R){return }var S=[];for(var T=0;T<R.s.length;T++){var Q={};Q.input=R.s[T];Q.selection=R.s[T];S.push(Q)}E["sug"+P].giveData(R.q,S)}}};function I(T,Z,S,X){if(!T){return }if(typeof (T)=="string"||T instanceof String){T=baidu.G(T)}if(!T.sugId){T.sugId=(new Date).getTime()}if(E["sug"+T.sugId]){return false}if(Z==null){var Z=[]}else{X=Z.sugSubmit;var Q=Z.fontColor?Z.fontColor:"#000";var W=Z.fontSize?Z.fontSize:"14px";var P=Z.fontFamily?Z.fontFamily:"verdana";var U=Z.bgcolorHI?Z.bgcolorHI:"#36c";var R=Z.fontColorHI?Z.fontColorHI:"#FFF";var Y=Z.borderColor?Z.borderColor:"#817f82";L(".bdSug_wpr","border:1px solid "+Y+";position:absolute;z-index:9;top:28px;left:0;color:"+Q);L(".bdSug_wpr td","font-size:"+W+";font-family:"+P);L(".bdSug_mo","background-color:"+U+";color:"+R)}if(G(document.body,"position")=="relative"||G(document.body,"position")=="absolute"){var V=B(document.body);Z.XOffset=(Z.XOffset?parseInt(Z.XOffset):0)+V.x;Z.YOffset=(Z.YOffset?parseInt(Z.YOffset):0)+V.y}E["sug"+T.sugId]=baidu.suggestion.create(T,J.createSugOptions(T.sugId,Z,S,X?N(T):null));D["give"+T.sugId]=J.createSugCallback(T.sugId)}function N(Q){var P=Q;while(P!=document.body&&P.tagName!="FORM"){P=P.parentNode}return(P.tagName=="FORM")?P:null}function B(R){var P=document;var Q=0;var S=0;if(R.getBoundingClientRect){var T=R.getBoundingClientRect();Q=T.left+Math.max(P.documentElement.scrollLeft,P.body.scrollLeft);S=T.top+Math.max(P.documentElement.scrollTop,P.body.scrollTop);Q-=P.documentElement.clientLeft;S-=P.documentElement.clientTop}else{while(R=R.offsetParent){Q+=R.offsetLeft;S+=R.offsetTop}}return{x:Q,y:S}}function L(R,Q){var S=document.styleSheets;if(!S||S.length<=0){var P=document.createElement("STYLE");P.type="text/css";var T=document.getElementsByTagName("HEAD")[0];T.appendChild(P)}S=document.styleSheets;S=S[S.length-1];if(baidu.ie){S.addRule(R,Q)}else{S.insertRule(R+" { "+Q+" }",S.cssRules.length)}}function G(R,P,Q){if(!R){return }if(Q!=undefined){R.style[P]=Q}else{if(R.style[P]){return R.style[P]}else{if(R.currentStyle){return R.currentStyle[P]}else{if(document.defaultView&&document.defaultView.getComputedStyle){P=P.replace(/([A-Z])/g,"-\u00241").toLowerCase();var S=document.defaultView.getComputedStyle(R,"");return S&&S.getPropertyValue(P)||""}}}}}function A(){L(".bdSug_wpr","line-height:normal;background:#FFF;padding:0;margin:0;border:1px solid #817F82;position:absolute;z-index:9999;");L(".bdSug_wpr table","padding:0;width:100%;background:#fff;cursor:default;");L(".bdSug_wpr tr","padding:0;margin:0");L(".bdSug_wpr td","padding:2px;margin:0;text-align:left;vertical-align:middle;font:14px verdana;font-weight:normal;text-decoration:none;text-indent:0");L(".bdSug_mo","background:#36c;color:#fff");L(".bdSug_app","padding:0;margin:0;background:#fff");L(".bdSug_pre","padding:0;margin:0");L()}A();var H=document.body.getElementsByTagName("INPUT");for(var K=0,F=H.length;K<F;K++){var M=H[K];if(M&&M.type=="text"&&(M.getAttribute("baiduSug")==1||M.getAttribute("baiduSug")==2)){M.sugId=K;var C=(M.getAttribute("baiduSug")==1);I(M,null,null,C)}}return{bind:I,callbacks:D}})();

// 回调函数，用于获取用户当前选择的文字
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