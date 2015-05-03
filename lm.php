<!--这是百度快照更新时间限定工具 1.01 PHP 源码，百度参数QQ交流群(255363059)-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cmn-Hans" xml:lang="zh-cmn-Hans">
<head>
<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0,minimal-ui" />
<meta name="apple-mobile-web-app-title" content="百度快照更新时间" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta content="text/html;charset=UTF-8" http-equiv="Content-Type" />
<?php

// 自动生成标题 v2.2

// 请手动修改 url 对应网址、标题后缀
$url = 'http://'.$_SERVER['HTTP_HOST'].'/lm.php';
$pt = '百度快照更新时间';

// 取得搜索词
$s = @$_GET['s'];

if (preg_match("/(.*)(ed2k)(.*)/", $s)) {
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

// 过滤字符串
if (strlen($s) > 0) {
    $p = array(
        '/(\s+)/',
        '/(http:\/\/)/',
    );
    $r = array(
        '%20',
        '',
    );
    $z = preg_replace($p[1], $r[1], $s);
    $query = htmlspecialchars(preg_replace($p, $r, $s));

    // 右侧相关搜索 第 1 位查询扩展作为主标题
    $srcid = json_decode(file_get_contents('http://opendata.baidu.com/api.php?resource_id=20558&format=json&ie=utf-8&oe=utf-8&query='.$query), true);
    if (preg_match('/(?<=20558\])(.+)(?=\[\/url\])/', @$srcid['data'][0]['tips'][0]['label1'], $w));
}
echo '<title>';
if (strlen($s) > 0) {
    if (strlen(@$w[1]) > 0) {
        echo $w[1].'_';
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
        }
    }

    // 引号转换为 HTML 实体的查询词作为副标题
    echo htmlspecialchars($z, ENT_QUOTES).'_';
}

// 标题后缀，品牌名
echo $pt."</title>\r\n";

// 下拉框提示词第 1 位，查询词作为 meta keywords
echo '<meta content="';
if (strlen($s) > 0) {
    if (strlen(@$w[1]) > 0) {
        echo $w[1].',';
    }
    else {
        if (strlen($sug) > 0) {
            echo $sug.',';
        }
    }
echo htmlspecialchars($z, ENT_QUOTES).',';
}
?>
百度搜索结果参数,时间限制,F1,gpc,site,inurl,rn" name="keywords" />
<meta content="限定
<?php
if (strlen($s) > 0) {
    if (strlen($sug) > 0) {
        echo $sug.'与';
    }
    echo htmlspecialchars($z, ENT_QUOTES);
}
;?>
在时间段内搜索" name="description" />
<meta name="author" content="吴星, maasdruck@gmail.com" />
<!--css-->
<link rel="stylesheet" type="text/css" href="http://www.weixingon.com/style/w.css" />
<style>
ol,ul{list-style-position:inside;}
</style>
</head>
<body itemscope itemtype="http://schema.org/TechArticle">
<div class="rich_media">
    <div class="rich_media_inner">
        <h1 class="rich_media_title" itemprop="name"><a itemprop="url" href="<?php echo $url;?>" rel="nofollow">百度快照更新时间限定</a></h1>
        <div class="rich_media_meta_list">
            <meta itemprop="datePublished" content="2015-05-03"><time class="rich_media_meta text">2015-05-03</time>
            <a class="rich_media_meta link nickname" itemprop="author url" href="http://weixingon.com/" target="_blank">吴星</a>
            <meta itemprop="dependencies" content="PHP">
            <meta itemprop="proficiencyLevel" content="Beginner">
            <meta itemprop="publisher" content="天香空城">
            <meta itemprop="inLanguage" content="简体中文">
        </div>
        <div class="rich_media_content">
<?php
echo '    <form method="get" action="'.$url.'">'."\r\n";
echo '        <select title="高级语法查询指令" name="pre">';
echo '        <option value="">无</option>';
echo '        <option value="site%3A"';
if (@$_GET['pre'] == "site%3A") {
    echo 'selected';
}
echo '>site:</option>';
echo '        <option value="inurl%3A"';
if (@$_GET['pre'] == "inurl%3A") {
    echo 'selected';
}
echo '>inurl:</option>';
echo '        </select>';
echo '        <select name="gpc">';
echo '        <option value="stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">最近1天</option>';
echo '        </select>';
echo '        <input class="submit" type="submit" value="百度一下">'."\r\n";
echo '        <input class="kw" type="text" value="'.htmlspecialchars(@$_GET['s'] ,ENT_QUOTES).'" name="s" title="解析" autocomplete="off" maxlength="76" baiduSug="1" autofocus="autofocus" placeholder="请输入查询词">'."\r\n";
echo '    </form>'."\r\n";

$startTime = microtime(true);

$u = ' itemprop="url" ';

// 打开空白网页显示"经常访问的网站"

if (is_null($s)) {
echo '<br><h2 itemprop="name" class="center">经常访问的网站</h2>
<br><p class="center"><a'.$u.'href="'.$url.'?pre=site%253A&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1&amp;s=zhihu.com">知乎</a>&nbsp;&nbsp;&nbsp;&nbsp;<a'.$u.'href="'.$url.'?pre=site%253A&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1&amp;s=douban.com">豆瓣</a></p>';
}

if (strlen($s) > 0) {
// 取得搜索词

$s = @$_GET['s'];
$pre = @$_GET['pre'];
$pn = @$_GET['pn'];
$rn = 50;
$gpc = @$_GET['gpc'];
$connectpn = "&pn=";
$connectrn = "&rn=";
$connectgpc = "&gpc=";

// 过滤字符串

$p = array(
    '/(\s+)/',
    '/(http:\/\/)/',
);
$r = array(
    '%20',
    '',
);
$query = htmlspecialchars(preg_replace($p, $r, $s));

echo '<div itemprop="articleBody">';

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
    '180.76.2.183',
    '180.76.3.151',
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
$serp = file_get_contents('http://'.$ip[0].'/s?wd='.$pre.$query.$connectpn.$pn.$connectrn.$rn.$connectgpc.$gpc);

// 确定时间

date_default_timezone_set('PRC');
clearstatcache();

// 冇收录

if (preg_match("/(?<=<p>抱歉，没有找到与<span style=\"font-family:宋体\">“<\/span><em>)(.+)(?=<\/em><span style\=\"font\-family:宋体\">”<\/span>相关的网页。<\/p>)/", @$serp, $mno))
echo '<p><a'.$u.'href="http://'.$mno[1].'" target="_blank" rel="external nofollow" title="直接访问&nbsp;'.@$mno[1].'">抱歉，没有找到与“<span class="red">'.$mno[1].'</span>”相关的网页。</a></p>
<p>如网页存在，请<a'.$u.'href="http://zhanzhang.baidu.com/sitesubmit/index?sitename=http%3A%2F%2F'.$mno[1].'" target="_blank" rel="external nofollow" title="您可以提交想被百度收录的url">提交网址</a>给我们</p>';

// 冇收录，但有其他搜索结果

if (preg_match("/(?<=<font class=\"c-gray\">没有找到该URL。您可以直接访问&nbsp;<\/font><a href=\")(.+)(?=\" target=\"_blank\" onmousedown)/", @$serp, $mno2))
echo '<p>没有找到该URL。您可以直接访问&nbsp;<span class="red"><a'.$u.'href="'.$mno2[1].'" target="_blank" rel="external nofollow" title="直接访问 '.$mno2[1].'">'.$mno2[1].'</a></span>，还可<a href="http://zhanzhang.baidu.com/sitesubmit/index?sitename=http%3A%2F%2F'.$mno2[1].'" target="_blank" rel="external nofollow" title="您可以提交想被百度收录的url">提交网址</a>给我们。</p>';

// 字数限制

if (preg_match("/(?<=<font class\=f14><b>)(.+)(?=&nbsp;及其后面的字词均被忽略，因为百度的查询限制在38个汉字以内。<\/b><\/font>)/", @$serp, $mlimit))
echo '<p>'.$mlimit[1].'&nbsp;及其后面的字词均被忽略，因为百度的查询限制在38个汉字以内。</p>';

// 屏蔽词

if (preg_match("/(?<=<div class\=\"boldline se\_common\_hint c\-gap\-bottom c\-container\" data\-id\=\"40400\" data\-tpl\=\"hint\_boldline\"><strong>)(.+)(?=<\/strong><\/div>)/", @$serp, $mcensor))
echo '<p>'.$mcensor[1].'</p>';

// 推销电话

if (preg_match("/(?<=<div class\=\"op\_liarphone2_word\">被)(\d+)(?=个&nbsp;<a href\=\"http:\/\/shoujiweishi.baidu.com\/\" target\=\"\_blank\">百度手机卫士<\/a>&nbsp;用户标记为<strong>\"广告推销\"<\/strong>,供您参考。<\/div>)/", @$serp, $mliarphone))
echo '<p>被'.$mliarphone[1].'个<a'.$u.'href="http://shoujiweishi.baidu.com/" rel="external nofollow" target="_blank">百度手机卫士</a>用户标记为<strong>"骚扰电话"</strong>,供您参考。</p>';

// 诈骗电话

if (preg_match("/(?<=<div class\=\"op\_liarphone2_word\">被)(\d+)(?=个&nbsp;<a href\=\"http:\/\/haoma.sogou.com\" target\=\"\_blank\">搜狗号码通<\/a>&nbsp;用户标记为<strong>\"诈骗\"<\/strong>,请谨防受骗。<\/div>)/", @$serp, $mliarphone2))
echo '<p>被'.$mliarphone2[1].'个<a'.$u.'href="http://haoma.sogou.com" rel="external nofollow" target="_blank">搜狗号码通</a>用户标记为<strong>"诈骗"</strong>,请谨防受骗。</p>';

// 搜索结果数量

if (preg_match("/(?<=百度为您找到相关结果)([\x80-\xff]{0,3})([0-9,]{1,11})(?=个<\/div>)/", @$serp, $mnumbers))

// site 特型

if (preg_match("/(?<=<span>该网站共有<b style=\"color:#333\">)([0-9,\x80-\xff]{1,32})(?=<\/b>个网页被百度收录<\/span>)/", @$serp, $msite))
echo '<p class="wheat">'.$mnumbers[2].'&nbsp;个结果&nbsp;百度索引量&nbsp;'.$msite[1].'</p>';

// 搜索结果
if (preg_match_all("/(?<=\" data\-tools\=\'{\"title\":\")([^\"]+)(\",\"url\":\"http:)(\/\/www.baidu.com\/link\?url\=[a-zA-Z0-9_\-]+)(?=\"}'><a class=\"c-tip-icon\"><i class=\"c-icon c-icon-triangle-down-g\"><\/i><\/a><\/div>)/", @$serp, $mserp))

// 搜索结果页资源

if (preg_match_all("/(?<=<div class\=\"result c\-container)( ?)(\" id\=\")(\d{1,3})(\" srcid\=\")(\d{1,5})(?=\" tpl\=\")/", @$serp, $msrcid))

// F1

$mf = preg_match_all("/(?<=F1':)(\s?)(')([0-9A-F]{2})([0-9A-F]{1})(?=([0-9A-F]{1}))/", @$serp, $mf1);
@$f136 = (array_search(6, $mf1[4]));
@$f135 = (array_search(5, $mf1[4]));
@$f134 = (array_search(4, $mf1[4]));

// 字数统计函数

function smarty_modifier_wordcount($str,$encoding = 'UTF-8')
{
    if(strtolower($encoding) == 'gbk') {

        $encoding = 'gb18030';
    }
    
    if(!is_string($str)||$str === '') return false;
    $mbLen = iconv_strlen($str, $encoding);
    $subLen = 0;
    for ($i = 0; $i < $mbLen; $i++) {
        $mbChr = iconv_substr($str, $i, 1, $encoding);
        if (1 == strlen($mbChr)) {
            $subLen += 1;
        } else {
            $subLen += 2;
        }
    }
    return $subLen;
}

if (is_numeric($f136)) {
    echo '<div itemprop="articleSection"><table><thead><tr><th itemprop="name">0－24小时前更新百度快照</th></tr></thead><tbody>';

// F1-3-6

if (preg_match_all("/(?<=F1':)(\s?)(')([0-9A-F]{2})([0-9A-F]{1})(?=([0-9A-F]{1}))/", @$serp, $mf1))

    foreach ($mf1[3] as $i => $position)
    {
        if ($mf1[4][$i] == 7) {
            unset($mf1[4][$i]);
            continue;
        }
        if ($mf1[4][$i] == 5) {
            unset($mf1[4][$i]);
            continue;
        }
        if ($mf1[4][$i] == 4) {
            unset($mf1[4][$i]);
            continue;
        }
        echo '<tr><td><a'.$u.'href="'.$mserp[3][$i].'" rel="external nofollow" target="_blank">'.stripslashes($mserp[1][$i]).'</a><br>';
        $short = smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES)));
        $srcid = $msrcid[5][$i];
        $id = $msrcid[3][$i];
        {
        if ($srcid == 1599)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;普通结果&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1581)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;更多同站相关结果&gt;&gt;『201412添加』&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1548)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;评分－结构化数据『201408添加』&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1547)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度百科『201407添加』&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1545)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;非正规相册『201412添加』&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1543)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;面包屑导航－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1542)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度学术&nbsp;查看更多相关论文&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1539)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;[官网]&nbsp;0－6&nbsp;个子链结果[201405添加]&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1538)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;软件下载摘要|小说作者状态类型－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1537)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;组图&nbsp;百度经验&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1536)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;一般答案&nbsp;百度知道&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1535)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;未知，模版采用&nbsp;se_com_image_s&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1534)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;[猜]&nbsp;化妆品，模版采用&nbsp;se_com_cosmetic&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1533)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;论坛帖子&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1532)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;最佳答案&nbsp;百度知道&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1531)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;查询扩展&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>'; // 在原用户查询词的基础上，通过一定的方法和策略把与原查询词相关的词、词组添加到原查询中，组成新的、更能准确表达用户查询意图的查询词序列，然后用新查询对文档重新检索，从而提高信息检索中的查全率和查准率。 李晓明; 闫宏飞; 王继民. 附录 术语//搜索引擎——原理、技术与系统(第二版). 2013年5月第9次印刷. 北京: 科学. 2012.5: 第322–323页 ISBN 7-03-034258-4 (简体中文)
        elseif ($srcid == 1530)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度贴吧&nbsp;更多贴吧相关帖子&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1529)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;权威问答网站结果&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>'; //百度知道|搜狗问问(搜搜问问)|爱问知识人|39问医生|寻医问药网有问必答
        elseif ($srcid == 1528)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度知道阿拉丁&nbsp;更多知道相关问题&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1527)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度文库标签&nbsp;更多文库相关文档>>&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1526)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度文库阿拉丁&nbsp;更多文库相关文档&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1525)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度文库&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1524)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;缩略图结果，但非每个查询词展现图片&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1523)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;robots.txt&nbsp;文件存在限制指令的结果&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1522)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度经验带相册&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1521)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;图片_百度百科(可能与查询词内容相关度较高)&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1520)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;期刊文献&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1519)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;维基百科&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1518)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;软件下载&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1517)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;[图文]，但并非每个查询词显示 [图文]&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1516)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;宗教&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1515)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;电影&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1514)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;在线文档－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1513)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;软件下载－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1512)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;单视频&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1511)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;[原创]&nbsp;星火计划&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1510)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;子链&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1509)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;官网&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1508)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;单视频&nbsp;站点&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1507)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;微博&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1506)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;单视频&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1505)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度知道&nbsp;高品质(知道达人|权威专家|官方机构)&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1504)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;自动问答&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1503)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;图片&nbsp;单视频&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1502)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度百科&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        elseif ($srcid == 1501)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;评分－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        else
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;'.$srcid.'&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        }
        echo '</tr>';
    }
echo '</tbody></table></div>';
}

if (is_numeric($f135)) {
    echo '<div itemprop="articleSection"><table><thead><tr><th itemprop="name">24－48小时前更新百度快照</th></tr></thead><tbody>';

// F1-3-5

if (preg_match_all("/(?<=F1':)(\s?)(')([0-9A-F]{2})([0-9A-F]{1})(?=([0-9A-F]{1}))/", @$serp, $mf1))

    foreach ($mf1[3] as $i => $position)
    {
        if ($mf1[4][$i] == 7) {
            unset($mf1[4][$i]);
            continue;
        }
        if ($mf1[4][$i] == 6) {
            unset($mf1[4][$i]);
            continue;
        }
        if ($mf1[4][$i] == 4) {
            unset($mf1[4][$i]);
            continue;
        }
        echo '<tr><td><a'.$u.'href="'.$mserp[3][$i].'" rel="external nofollow" target="_blank">'.stripslashes($mserp[1][$i]).'</a><br>';
        $short = smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES)));
        $srcid = $msrcid[5][$i];
        $id = $msrcid[3][$i];
        {
            if ($srcid == 1599)
                echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;普通结果&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1581)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;更多同站相关结果&gt;&gt;『201412添加』&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1548)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;评分－结构化数据『201408添加』&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1547)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度百科『201407添加』&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1545)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;非正规相册『201412添加』&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1543)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;面包屑导航－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1542)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度学术&nbsp;查看更多相关论文&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1539)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;[官网]&nbsp;0－6&nbsp;个子链结果[201405添加]&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1538)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;软件下载摘要|小说作者状态类型－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1537)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;组图&nbsp;百度经验&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1536)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;一般答案&nbsp;百度知道&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1535)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;未知，模版采用&nbsp;se_com_image_s&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1534)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;[猜]&nbsp;化妆品，模版采用&nbsp;se_com_cosmetic&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1533)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;论坛帖子&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1532)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;最佳答案&nbsp;百度知道&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1531)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;查询扩展&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>'; // 在原用户查询词的基础上，通过一定的方法和策略把与原查询词相关的词、词组添加到原查询中，组成新的、更能准确表达用户查询意图的查询词序列，然后用新查询对文档重新检索，从而提高信息检索中的查全率和查准率。 李晓明; 闫宏飞; 王继民. 附录 术语//搜索引擎——原理、技术与系统(第二版). 2013年5月第9次印刷. 北京: 科学. 2012.5: 第322–323页 ISBN 7-03-034258-4 (简体中文)
            elseif ($srcid == 1530)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度贴吧&nbsp;更多贴吧相关帖子&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1529)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;权威问答网站结果&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>'; //百度知道|搜狗问问(搜搜问问)|爱问知识人|39问医生|寻医问药网有问必答
            elseif ($srcid == 1528)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度知道阿拉丁&nbsp;更多知道相关问题&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1527)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度文库标签&nbsp;更多文库相关文档>>&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1526)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度文库阿拉丁&nbsp;更多文库相关文档&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1525)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度文库&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1524)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;缩略图结果，但非每个查询词展现图片&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1523)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;robots.txt&nbsp;文件存在限制指令的结果&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1522)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度经验带相册&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1521)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;图片_百度百科(可能与查询词内容相关度较高)&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1520)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;期刊文献&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1519)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;维基百科&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1518)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;软件下载&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1517)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;[图文]，但并非每个查询词显示 [图文]&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1516)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;宗教&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1515)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;电影&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1514)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;在线文档－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1513)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;软件下载－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1512)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;单视频&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1511)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;[原创]&nbsp;星火计划&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1510)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;子链&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1509)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;官网&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1508)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;单视频&nbsp;站点&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1507)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;微博&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1506)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;单视频&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1505)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度知道&nbsp;高品质(知道达人|权威专家|官方机构)&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1504)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;自动问答&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1503)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;图片&nbsp;单视频&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1502)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度百科&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1501)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;评分－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            else
                echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;'.$srcid.'&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        }
        echo '</tr>';
    }
echo '</tbody></table></div>';
}

if (is_numeric($f134)) {
    echo '<div itemprop="articleSection"><table><thead><tr><th itemprop="name">2－7天前更新百度快照</th></tr></thead><tbody>';

// F1-3-4

if (preg_match_all("/(?<=F1':)(\s?)(')([0-9A-F]{2})([0-9A-F]{1})(?=([0-9A-F]{1}))/", @$serp, $mf1))

    foreach ($mf1[3] as $i => $position)
    {
        if ($mf1[4][$i] == 7) {
            unset($mf1[4][$i]);
            continue;
        }
        if ($mf1[4][$i] == 6) {
            unset($mf1[4][$i]);
            continue;
        }
        if ($mf1[4][$i] == 5) {
            unset($mf1[4][$i]);
            continue;
        }
        echo '<tr><td><a'.$u.'href="'.$mserp[3][$i].'" rel="external nofollow" target="_blank">'.stripslashes($mserp[1][$i]).'</a><br>';
        $short = smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES)));
        $srcid = $msrcid[5][$i];
        $id = $msrcid[3][$i];
        {
            if ($srcid == 1599)
                echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;普通结果&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1581)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;更多同站相关结果&gt;&gt;『201412添加』&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1548)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;评分－结构化数据『201408添加』&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1547)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度百科『201407添加』&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1545)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;非正规相册『201412添加』&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1543)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;面包屑导航－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1542)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度学术&nbsp;查看更多相关论文&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1539)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;[官网]&nbsp;0－6&nbsp;个子链结果[201405添加]&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1538)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;软件下载摘要|小说作者状态类型－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1537)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;组图&nbsp;百度经验&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1536)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;一般答案&nbsp;百度知道&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1535)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;未知，模版采用&nbsp;se_com_image_s&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1534)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;[猜]&nbsp;化妆品，模版采用&nbsp;se_com_cosmetic&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1533)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;论坛帖子&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1532)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;最佳答案&nbsp;百度知道&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1531)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;查询扩展&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>'; // 在原用户查询词的基础上，通过一定的方法和策略把与原查询词相关的词、词组添加到原查询中，组成新的、更能准确表达用户查询意图的查询词序列，然后用新查询对文档重新检索，从而提高信息检索中的查全率和查准率。 李晓明; 闫宏飞; 王继民. 附录 术语//搜索引擎——原理、技术与系统(第二版). 2013年5月第9次印刷. 北京: 科学. 2012.5: 第322–323页 ISBN 7-03-034258-4 (简体中文)
            elseif ($srcid == 1530)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度贴吧&nbsp;更多贴吧相关帖子&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1529)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;权威问答网站结果&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>'; //百度知道|搜狗问问(搜搜问问)|爱问知识人|39问医生|寻医问药网有问必答
            elseif ($srcid == 1528)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度知道阿拉丁&nbsp;更多知道相关问题&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1527)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度文库标签&nbsp;更多文库相关文档>>&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1526)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度文库阿拉丁&nbsp;更多文库相关文档&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1525)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度文库&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1524)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;缩略图结果，但非每个查询词展现图片&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1523)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;robots.txt&nbsp;文件存在限制指令的结果&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1522)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度经验带相册&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1521)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;图片_百度百科(可能与查询词内容相关度较高)&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1520)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;期刊文献&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1519)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;维基百科&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1518)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;软件下载&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1517)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;[图文]，但并非每个查询词显示 [图文]&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1516)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;宗教&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1515)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;电影&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1514)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;在线文档－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1513)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;软件下载－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1512)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;单视频&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1511)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;[原创]&nbsp;星火计划&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1510)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;子链&nbsp;国际化&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1509)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;官网&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1508)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;单视频&nbsp;站点&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1507)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;微博&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1506)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;单视频&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1505)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度知道&nbsp;高品质(知道达人|权威专家|官方机构)&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1504)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;自动问答&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1503)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;图片&nbsp;单视频&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1502)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;百度百科&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            elseif ($srcid == 1501)
            echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;评分－结构化数据&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
            else
                echo '<span class="wheat">'.$short.'&nbsp;字节&nbsp;'.$srcid.'&nbsp;第&nbsp;'.$id.'&nbsp;名</span></td>';
        }
        echo '</tr>';
    }
echo '</tbody></table></div>';
}

// 翻页

echo '<table><thead><tr><th>翻页</th></tr></thead><tbody><tr><td>';

if ($pn==50) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==100) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==150) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==200) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==250) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==300) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==350) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==400) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==450) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==500) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==550) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==600) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==650) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==700) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==750) {
    echo '<strong><a href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
else {
    echo '<strong><a class="wheat" href="'.$url.'?s='.$pre.$query.'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;01&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=50&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;02&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;03&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=150&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;04&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;05&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=250&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;06&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;07&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=350&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;08&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;09&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=450&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;10&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=550&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;12&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<br><br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=650&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;14&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a href="'.$url.'?s='.$pre.$query.'&amp;pn=750&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">&nbsp;&nbsp;&nbsp;&nbsp;16&nbsp;&nbsp;&nbsp;&nbsp;</a></strong>';
}
echo '</td></tr></tbody></table>';

if (!is_numeric($f136) && !is_numeric($f135) && !is_numeric($f134)) {

    // 最新相关消息

    // 1. 初始化
    $ch = curl_init();

    // 2. 设置选项，包括 URL
    curl_setopt($ch, CURLOPT_URL, 'http://www.baidu.com/s?tn=newsxml&wd='.$query);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器

    // 3. 执行并获取 HTML 文档内容
    $news = curl_exec ($ch);
    if ($news === FALSE) {
        echo "cURL Error: " . curl_error($ch);
    }

    if (preg_match_all("/(?<=\<subnewstlurl\>\<\!\[CDATA\[  )(.*)( \]\]\>\<\/subnewstlurl\>\n\s+\<subnewstitle\><\!\[CDATA\[  )(.*)(?= \]\]\>\<\/subnewstitle\>)/", @$news, $mnews))
    if (strlen($mnews[3][0]) > 0) {
        echo '<div itemprop="articleSection"><table><thead><tr><th>最新相关消息</th></tr></thead><tbody>';

        // GBK 转 UTF-8 解码

        foreach ($mnews[3] as $key => $value) {
            $title=iconv("GBK", "UTF-8//IGNORE", urldecode($mnews[3][$key]));
            echo '<tr><td><a'.$u.'href="'.$url.'?s='.strip_tags($title).'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">'.strip_tags($title).'</a></td></tr>';
        }
    echo '</tbody></table></div>';
    }

    // 4. 释放 curl 句柄
    curl_close ($ch);

    // 百度风云榜

    // 1. 初始化
    $ch = curl_init();

    // 2. 设置选项，包括 URL
    curl_setopt($ch, CURLOPT_URL, 'http://opendata.baidu.com/api.php?resource_id=6698&format=json&ie=UTF-8&oe=UTF-8&query=random');
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器

    // 3. 执行并获取 HTML 文档内容
    $hot = curl_exec ($ch);
    if ($hot === FALSE) {
    echo "cURL Error: " . curl_error($ch);
    }

    $jsonhot = json_decode($hot, true);
    echo '<div itemprop="articleSection"><table><caption>百度风云榜</caption><thead><tr><th>实时热点</th><th>搜索指数</th></tr></thead><tbody>';

    // 4. 释放 curl 句柄
    curl_close ($ch);

    foreach (@$jsonhot[data][0][bdlist] as $key => $value) {
        echo '<tr><td><a'.$u.'href="'.$url.'?s='.@$jsonhot[data][0][bdlist][$key][content].'&amp;rn=50&amp;gpc=stf%3D'.(time() - 86400).'%2C'.time().'%7Cstftype%3D1">'.@$jsonhot[data][0][bdlist][$key][content].'</a></td><td class="center">'.@$jsonhot[data][0][bdlist][$key][num].'</td></tr>';
    }
    echo '</tbody></table></div>';
}

$costTime = microtime(true) - $startTime;

// 页脚

echo '<p><a'.$u.'href="https://github.com/ausdruck/baidu-prm/blob/master/lm.php" target="_blank" rel="external nofollow">百度快照更新时间限定工具v1.01</a>
本次查询耗时&nbsp;'.sprintf("%.2f",($costTime*1000)).'&nbsp;毫秒&nbsp;
<a href="http://www.baidu.com/s?wd='.$pre.$query.$connectpn.$pn.$connectrn.$rn.$connectgpc.$gpc.'" target="_blank" rel="external nofollow">点击查看“<span class="red">'.$s.'</span>”</a></p></div>';
}
?>
            <div class="qr_code_pc_outer" style="display: block;">
                <div class="qr_code_pc_inner">
                    <div class="qr_code_pc">
                        <p class="wheat">无需在意无知的人<br />置之不理<br />亦可彰显您的气度<br />——季雨<br />百度参数QQ群<br>255363059</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script charset="gbk" src="http://www.baidu.com/js/opensug.js"></script>
<script src="http://www.weixingon.com/javascript/j.js"></script>
<script>(new GoTop()).init({pageWidth:1022,nodeId:'go-top',nodeWidth:100,distanceToBottom:200,distanceToPage:0,hideRegionHeight:130,text:'&nbsp;&nbsp;顶&nbsp;部&nbsp;&nbsp;'})</script>
</body>
</html>