<!--这是百度快照更新时间限定(lm)工具 PHP 源码，若不知如何在浏览器打开，可加入百度参数QQ交流群(255363059)，或请直接访问在线版 weixingon.com/lm.php。如果你有更多的宝贵意见，也欢迎发送邮件至邮箱 maasdruck@gmail.com-->
<?php
// 请手动修改 url 对应网址和标题后缀

$url = 'http://127.0.0.1/lm.php';
$pt = '百度快照更新时间限定(lm)';

echo '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN" xml:lang="zh-CN">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<meta content="text/html;charset=UTF-8" http-equiv="Content-Type" />';

// 取得搜索词

$s = @$_GET['s'];

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
}

// 标题前缀

echo '<title>';
if (strlen($s) > 0) {
	echo htmlspecialchars($z, ENT_QUOTES).' - ';
}

// 标题后缀

echo $pt.'</title>';

// meta keywords

echo '<meta content="'.htmlspecialchars(@$z, ENT_QUOTES).',百度搜索结果参数,时间限制,F1,lm,site,inurl,rn" name="keywords" />
<meta content="百度限定要搜索的网页的时间是'.htmlspecialchars(@$z, ENT_QUOTES).'" name="description" />';
?>

<!--css-->
<link rel="stylesheet" type="text/css" href="http://www.weixingon.com/style/w.css" />
<style>
ol,ul{list-style-position:inside;}
</style>
</head>
<body itemscope itemtype="http://schema.org/TechArticle">
<div class="rich_media">
	<div class="rich_media_inner">
		<h1 class="rich_media_title" itemprop="name"><a itemprop="url" href="<?php echo $url;?>">百度快照更新时间限定(lm)</a></h1>
		<div class="rich_media_meta_list">
			<meta itemprop="datePublished" content="2014-11-17"><time class="rich_media_meta text">2014-11-17</time>
			<a class="rich_media_meta link nickname" itemprop="author url" href="http://www.weixingon.com" target="_blank">吴星</a>
			<meta itemprop="dependencies" content="PHP">
			<meta itemprop="proficiencyLevel" content="Beginner">
			<meta itemprop="publisher" content="天香空城">
			<meta itemprop="inLanguage" content="简体中文">
		</div>
		<div class="rich_media_content">
			<form method="get" action="<?php echo $url;?>">
				<select title="高级语法查询指令" name="pre">
					<option value="">无</option>
					<option value="site%3A" <?php if (@$_GET['pre'] == "site%3A") echo 'selected'; ?>>site:</option>
					<option value="inurl%3A" <?php if (@$_GET['pre'] == "inurl%3A") echo 'selected'; ?>>inurl:</option>
				</select>
				<select title="百度快照更新时间限定" name="lm">
					<option value="7">最近1週</option>
					<option value="1" <?php if(@$_GET['lm'] == 1) echo 'selected';?>>最近1天</option>
					<option value="30" <?php if(@$_GET['lm'] == 30) echo 'selected';?>>最近1月</option>
					<option value="360" <?php if(@$_GET['lm'] == 360) echo 'selected';?>>最近1年</option>
				</select>
				<input class="kw" type="text" value="<?php echo htmlspecialchars(@$_GET['s'] ,ENT_QUOTES);?>" name="s" title="查询" autocomplete="off" maxlength="76" baiduSug="1" autofocus="autofocus" placeholder="请输入查询词" />
				<input class="submit" type="submit" value="百度一下" />
			</form>
<?php
$startTime = microtime(true);

if (strlen($s) > 0) {
// 取得搜索词

$s = @$_GET['s'];
$pre = @$_GET['pre'];
$pn = @$_GET['pn'];
$rn = 100;
$lm = @$_GET['lm'];
$connectpn = "&pn=";
$connectrn = "&rn=";
$connectlm = "&lm=";

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

// 个人网站使用的是浙江杭州阿里云服务器，所以直接使用接近的杭州百度 IP，提升抓取速度。
// 随机更换 IP

$ip = array (
	'115.239.210.25',
	'115.239.210.26',
	'115.239.210.27',
	'115.239.210.28',
	'115.239.211.109',
	'115.239.211.110',
	'115.239.211.112',
	'115.239.211.113',
	'115.239.211.114',
	);
shuffle ($ip);
$baidu = "http://".$ip[0]."/s?wd=";
$serp = file_get_contents($baidu.$pre.$query.$connectpn.$pn.$connectrn.$rn.$connectlm.$lm);

// 确定时间

date_default_timezone_set('PRC');
clearstatcache();

// 搜索结果数量

if (preg_match("/(?<=百度为您找到相关结果)([\x80-\xff]{0,3})([0-9,]{1,11})(?=个<\/div>)/", @$serp, $mnumbers))

// 冇收录

if (preg_match("/(?<=<p>抱歉，没有找到与<span style=\"font-family:宋体\">“<\/span><em>)(.+)(?=<\/em><span style\=\"font\-family:宋体\">”<\/span>相关的网页。<\/p>)/", @$serp, $mno))
echo '<p><a itemprop="url" href="http://'.$mno[1].'" target="_blank" rel="external nofollow" title="直接访问&nbsp;'.@$mno[2].'">抱歉，没有找到与“<span class="red">'.$mno[1].'</span>”相关的网页。</a></p>
<p>如网页存在，请<a itemprop="url" href="http://zhanzhang.baidu.com/sitesubmit/index?sitename=http%3A%2F%2F'.$mno[1].'" target="_blank" rel="external nofollow" title="您可以提交想被百度收录的url">提交网址</a>给我们</p>';

// 冇收录，但有其他搜索结果

if (preg_match("/(?<=<font class=\"c-gray\">没有找到该URL。您可以直接访问&nbsp;<\/font><a href=\")(.+)(?=\" target=\"_blank\" onmousedown)/", @$serp, $mno2))
echo '<p>没有找到该URL。您可以直接访问&nbsp;<span class="red"><a itemprop="url" href="'.$mno2[1].'" target="_blank" rel="external nofollow" title="直接访问 '.$mno2[1].'">'.$mno2[1].'</a></span>，还可<a href="http://zhanzhang.baidu.com/sitesubmit/index?sitename=http%3A%2F%2F'.$mno2[1].'" target="_blank" rel="external nofollow" title="您可以提交想被百度收录的url">提交网址</a>给我们。</p>';

// 字数限制

if (preg_match("/(?<=<font class\=f14><b>)(.+)(?=&nbsp;及其后面的字词均被忽略，因为百度的查询限制在38个汉字以内。<\/b><\/font>)/", @$serp, $mlimit))
echo '<p>'.$mlimit[1].'&nbsp;及其后面的字词均被忽略，因为百度的查询限制在38个汉字以内。</p>';

// 屏蔽词

if (preg_match("/(?<=<div class\=\"boldline se\_common\_hint c\-gap\-bottom c\-container\" data\-id\=\"40400\" data\-tpl\=\"hint\_boldline\"><strong>)(.+)(?=<\/strong><\/div>)/", @$serp, $mcensor))
echo '<p>'.$mcensor[1].'</p>';

// 推销电话

if (preg_match("/(?<=<div class\=\"op\_liarphone2_word\">被)(\d+)(?=个&nbsp;<a href\=\"http:\/\/shoujiweishi.baidu.com\/\" target\=\"\_blank\">百度手机卫士<\/a>&nbsp;用户标记为<strong>\"广告推销\"<\/strong>,供您参考。<\/div>)/", @$serp, $mliarphone))
echo '<p>被'.$mliarphone[1].'个<a itemprop="url" href="http://shoujiweishi.baidu.com/" rel="external nofollow" target="_blank">百度手机卫士</a>用户标记为<strong>"骚扰电话"</strong>,供您参考。</p>';

// 诈骗电话

if (preg_match("/(?<=<div class\=\"op\_liarphone2_word\">被)(\d+)(?=个&nbsp;<a href\=\"http:\/\/haoma.sogou.com\" target\=\"\_blank\">搜狗号码通<\/a>&nbsp;用户标记为<strong>\"诈骗\"<\/strong>,请谨防受骗。<\/div>)/", @$serp, $mliarphone2))
echo '<p>被'.$mliarphone2[1].'个<a itemprop="url" href="http://haoma.sogou.com" rel="external nofollow" target="_blank">搜狗号码通</a>用户标记为<strong>"诈骗"</strong>,请谨防受骗。</p>';

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
		echo '<tr><td><a itemprop="url" href="'.$mserp[3][$i].'" rel="external nofollow" target="_blank">'.stripslashes($mserp[1][$i]).'</a><br />';
		$srcid = $msrcid[5][$i];
		{
		if ($srcid == 1599)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;普通结果&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1548)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;影评&nbsp;结构化数据『201408添加』&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1547)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度百科『201407添加』&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1543)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;面包屑导航&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1542)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度学术&nbsp;-&nbsp;查看更多相关论文&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1539)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;带&nbsp;0－6&nbsp;个子链结果&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1538)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;软件下载摘要|小说作者状态类型&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1537)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;组图&nbsp;百度经验&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1536)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;一般答案&nbsp;百度知道&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1533)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;论坛帖子&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1532)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;最佳答案&nbsp;百度知道&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1531)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;查询词扩展&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1530)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度贴吧&nbsp;更多贴吧相关帖子&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1529)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;权威问答网站结果&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1528)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度知道阿拉丁&nbsp;更多知道相关问题&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1527)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度文库标签&nbsp;更多文库相关文档>>&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1526)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度文库阿拉丁&nbsp;更多文库相关文档&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1525)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度文库&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1524)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;缩略图结果，但非每个查询词展现图片&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1523)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;robots.txt&nbsp;文件存在限制指令的结果&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1522)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度经验带相册&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1521)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;图片_百度百科(可能与查询词内容相关度较高)&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1520)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;期刊文献&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1519)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;维基百科&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1518)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;软件下载&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1517)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;[图文]，但并非每个查询词显示 [图文]&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1516)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;宗教&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1515)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;电影&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1514)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;在线文档&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1513)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;软件下载&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1512)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;单视频&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1511)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;[原创]&nbsp;星火计划&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1510)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;子链&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1509)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;官网&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1508)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;单视频&nbsp;站点&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1507)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;微博&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1506)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;单视频&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1505)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度知道&nbsp;高品质(知道达人|权威专家|官方机构)&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1504)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;自动问答&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1503)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;图片&nbsp;单视频&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1502)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度百科&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1501)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;评分&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		else
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;'.$srcid.'&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
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
		echo '<tr><td><a itemprop="url" href="'.$mserp[3][$i].'" rel="external nofollow" target="_blank">'.stripslashes($mserp[1][$i]).'</a><br />';
		$srcid = $msrcid[5][$i];
		{
		if ($srcid == 1599)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;普通结果&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1548)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;影评&nbsp;结构化数据『201408添加』&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1547)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度百科『201407添加』&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1543)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;面包屑导航&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1542)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度学术&nbsp;-&nbsp;查看更多相关论文&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1539)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;带&nbsp;0－6&nbsp;个子链结果&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1538)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;软件下载摘要|小说作者状态类型&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1537)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;组图&nbsp;百度经验&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1536)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;一般答案&nbsp;百度知道&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1533)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;论坛帖子&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1532)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;最佳答案&nbsp;百度知道&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1531)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;查询词扩展&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1530)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度贴吧&nbsp;更多贴吧相关帖子&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1529)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;权威问答网站结果&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1528)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度知道阿拉丁&nbsp;更多知道相关问题&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1527)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度文库标签&nbsp;更多文库相关文档>>&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1526)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度文库阿拉丁&nbsp;更多文库相关文档&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1525)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度文库&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1524)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;缩略图结果，但非每个查询词展现图片&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1523)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;robots.txt&nbsp;文件存在限制指令的结果&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1522)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度经验带相册&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1521)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;图片_百度百科(可能与查询词内容相关度较高)&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1520)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;期刊文献&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1519)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;维基百科&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1518)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;软件下载&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1517)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;[图文]，但并非每个查询词显示 [图文]&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1516)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;宗教&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1515)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;电影&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1514)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;在线文档&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1513)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;软件下载&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1512)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;单视频&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1511)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;[原创]&nbsp;星火计划&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1510)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;子链&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1509)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;官网&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1508)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;单视频&nbsp;站点&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1507)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;微博&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1506)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;单视频&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1505)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度知道&nbsp;高品质(知道达人|权威专家|官方机构)&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1504)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;自动问答&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1503)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;图片&nbsp;单视频&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1502)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度百科&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1501)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;评分&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		else
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;'.$srcid.'&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
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
		echo '<tr><td><a itemprop="url" href="'.$mserp[3][$i].'" rel="external nofollow" target="_blank">'.stripslashes($mserp[1][$i]).'</a><br />';
		$srcid = $msrcid[5][$i];
		{
		if ($srcid == 1599)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;普通结果&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1548)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;影评&nbsp;结构化数据『201408添加』&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1547)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度百科『201407添加』&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1543)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;面包屑导航&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1542)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度学术&nbsp;-&nbsp;查看更多相关论文&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1539)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;带&nbsp;0－6&nbsp;个子链结果&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1538)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;软件下载摘要|小说作者状态类型&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1537)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;组图&nbsp;百度经验&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1536)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;一般答案&nbsp;百度知道&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1533)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;论坛帖子&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1532)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;最佳答案&nbsp;百度知道&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1531)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;查询词扩展&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1530)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度贴吧&nbsp;更多贴吧相关帖子&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1529)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;权威问答网站结果&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1528)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度知道阿拉丁&nbsp;更多知道相关问题&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1527)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度文库标签&nbsp;更多文库相关文档>>&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1526)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度文库阿拉丁&nbsp;更多文库相关文档&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1525)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度文库&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1524)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;缩略图结果，但非每个查询词展现图片&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1523)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;robots.txt&nbsp;文件存在限制指令的结果&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1522)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度经验带相册&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1521)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;图片_百度百科(可能与查询词内容相关度较高)&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1520)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;期刊文献&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1519)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;维基百科&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1518)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;软件下载&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1517)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;[图文]，但并非每个查询词显示 [图文]&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1516)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;宗教&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1515)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;电影&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1514)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;在线文档&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1513)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;软件下载&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1512)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;单视频&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1511)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;[原创]&nbsp;星火计划&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1510)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;子链&nbsp;国际化&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1509)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;官网&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1508)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;单视频&nbsp;站点&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1507)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;微博&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1506)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;单视频&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1505)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度知道&nbsp;高品质(知道达人|权威专家|官方机构)&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1504)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;自动问答&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1503)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;图片&nbsp;单视频&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1502)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;百度百科&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		elseif ($srcid == 1501)
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;评分&nbsp;-&nbsp;结构化数据&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		else
			echo '<span class="wheat">'.smarty_modifier_wordcount(stripslashes(htmlspecialchars_decode($mserp[1][$i], ENT_QUOTES))).'&nbsp;字节&nbsp;'.$srcid.'&nbsp;第&nbsp;'.$msrcid[3][$i].'&nbsp;名</span></td>';
		}
		echo '</tr>';
	}
echo '</tbody></table></div>';
}

// 翻页

echo '<div itemprop="articleSection"><table><thead><tr><th>翻页</th></tr></thead><tbody><tr><td>';

if ($pn==100) {
	echo '<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;rn=100&amp;lm=7">&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=100&amp;lm=7">&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=100&amp;lm=7">&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=100&amp;lm=7">&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=100&amp;lm=7">&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=100&amp;lm=7">&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=100&amp;lm=7">&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=100&amp;lm=7">&nbsp;&nbsp;8&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==200) {
	echo '<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;rn=100&amp;lm=7">&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=100&amp;lm=7">&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=100&amp;lm=7">&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=100&amp;lm=7">&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=100&amp;lm=7">&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=100&amp;lm=7">&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=100&amp;lm=7">&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=100&amp;lm=7">&nbsp;&nbsp;8&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==300) {
	echo '<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;rn=100&amp;lm=7">&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=100&amp;lm=7">&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=100&amp;lm=7">&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=100&amp;lm=7">&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=100&amp;lm=7">&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=100&amp;lm=7">&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=100&amp;lm=7">&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=100&amp;lm=7">&nbsp;&nbsp;8&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==400) {
	echo '<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;rn=100&amp;lm=7">&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=100&amp;lm=7">&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=100&amp;lm=7">&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=100&amp;lm=7">&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=100&amp;lm=7">&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=100&amp;lm=7">&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=100&amp;lm=7">&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=100&amp;lm=7">&nbsp;&nbsp;8&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==500) {
	echo '<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;rn=100&amp;lm=7">&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=100&amp;lm=7">&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=100&amp;lm=7">&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=100&amp;lm=7">&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=100&amp;lm=7">&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=100&amp;lm=7">&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=100&amp;lm=7">&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=100&amp;lm=7">&nbsp;&nbsp;8&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==600) {
	echo '<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;rn=100&amp;lm=7">&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=100&amp;lm=7">&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=100&amp;lm=7">&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=100&amp;lm=7">&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=100&amp;lm=7">&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=100&amp;lm=7">&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=100&amp;lm=7">&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=100&amp;lm=7">&nbsp;&nbsp;8&nbsp;&nbsp;</a></strong>';
}
elseif ($pn==700) {
	echo '<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;rn=100&amp;lm=7">&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=100&amp;lm=7">&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=100&amp;lm=7">&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=100&amp;lm=7">&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=100&amp;lm=7">&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=100&amp;lm=7">&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=100&amp;lm=7">&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a class="wheat" itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=100&amp;lm=7">&nbsp;&nbsp;8&nbsp;&nbsp;</a></strong>';
}
else {
	echo '<strong><a class="wheat" itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;rn=100&amp;lm=7">&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=100&amp;rn=100&amp;lm=7">&nbsp;&nbsp;2&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=200&amp;rn=100&amp;lm=7">&nbsp;&nbsp;3&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=300&amp;rn=100&amp;lm=7">&nbsp;&nbsp;4&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=400&amp;rn=100&amp;lm=7">&nbsp;&nbsp;5&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=500&amp;rn=100&amp;lm=7">&nbsp;&nbsp;6&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=600&amp;rn=100&amp;lm=7">&nbsp;&nbsp;7&nbsp;&nbsp;&nbsp;</a></strong>
<strong><a itemprop="url" href="'.$url.'?s='.$pre.$query.'&amp;pn=700&amp;rn=100&amp;lm=7">&nbsp;&nbsp;8&nbsp;&nbsp;</a></strong>';
}
echo '</td></tr></tbody></table></div>';

if (!is_numeric($f136) && !is_numeric($f135) && !is_numeric($f134)) {

	// 最新相关消息

	$news = 'http://'.$ip[0].'/s?tn=newsxml&wd='.$query;
	$baidunews = file_get_contents($news);

	if (preg_match_all("/(?<=\<subnewstlurl\>\<\!\[CDATA\[  )(.*)( \]\]\>\<\/subnewstlurl\>\n\s+\<subnewstitle\><\!\[CDATA\[  )(.*)(?= \]\]\>\<\/subnewstitle\>)/", @$baidunews, $mnews))
	if (strlen($mnews[3][0]) > 0) {
		echo '<div itemprop="articleSection"><table><thead><tr><th>最新相关消息</th></tr></thead><tbody>';

		// GBK 转 UTF-8 解码

		foreach ($mnews[3] as $key => $value) {
			$title=iconv("GBK","UTF-8//IGNORE",urldecode($mnews[3][$key]));
			echo '<tr><td><a itemprop="url" href="'.$url.'?s='.strip_tags($title).'&amp;rn=100&amp;lm=7">'.strip_tags($title).'</a></td></tr>';
		}
	echo '</tbody></table></div>';
	}

	// 百度风云榜

	$hot = file_get_contents('http://opendata.baidu.com/api.php?resource_id=6698&format=json&ie=UTF-8&oe=UTF-8&query=random');
	$jsonhot = json_decode($hot, true);
	echo '<div itemprop="articleSection"><table><caption>百度风云榜</caption><thead><tr><th>实时热点</th><th>搜索指数</th></tr></thead><tbody>';

	foreach (@$jsonhot[data][0][bdlist] as $key => $value) {
		echo '<tr><td><a itemprop="url" href="'.$url.'?s='.@$jsonhot[data][0][bdlist][$key][content].'&amp;rn=100&amp;lm=7">'.@$jsonhot[data][0][bdlist][$key][content].'</a></td><td class="center">'.@$jsonhot[data][0][bdlist][$key][num].'</td></tr>';
	}
	echo '</tbody></table></div>';
}

$costTime = microtime(true) - $startTime;

// 页脚

echo '<p><a itemprop="url" href="https://github.com/ausdruck/baidu-prm/blob/master/lm.php" target="_blank" rel="external nofollow">百度快照更新时间限定工具v1.00</a>
本次查询耗时&nbsp;'.sprintf("%.2f",($costTime*1000)).'&nbsp;毫秒&nbsp;
<a itemprop="url" href="http://www.baidu.com/s?wd='.$pre.$query.$connectpn.$pn.$connectrn.$rn.$connectlm.$lm.'" target="_blank" rel="external nofollow">点击查看“<span class="red">'.$s.'</span>”</a></p></div>';
}
?>
			<div class="qr_code_pc_outer" style="display: block;">
				<div class="qr_code_pc_inner">
					<div class="qr_code_pc">
						<p class="wheat">百度参数QQ群<br />255363059<br />无需在意无知的人<br />置之不理<br />亦可彰显您的气度<br />——季雨</p>
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