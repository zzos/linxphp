<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="cmn-Hans" xml:lang="cmn-Hans">
<head><meta charset="UTF-8">
<title>演示朴素贝叶斯自动过滤擦边词</title>
<meta content="演示朴素贝叶斯过滤器自动判断垃圾内容" name="description">
<meta content="演示,贝叶斯,过滤器,擦边词" name="keywords">
<meta content="演示朴素贝叶斯自动过滤擦边词" name="apple-mobile-web-app-title">
<meta content="webkit" name="renderer">
<meta content="telephone=no" name="format-detection">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0,minimal-ui" name="viewport">
</head><body>
<?php
/**
  * @author maas(maasdruck@gmail.com)
  * @date 2016/05/15
  * @version v1.4
  * @brief 演示朴素贝叶斯自动过滤擦边词
  */

$dict = array('a','j','v'); // 词典
$spm = 'av'; // 垃圾文本
$nom = 'java'; // 正常文本
$q = 'java'; // 查询词
$bys = 60; // 贝叶斯过滤器可以设置 0 - 100 之间任意正整数，0 表示不过滤擦边内容，100 意味着过滤绝大多数内容
$isn = 0.001; // 调整词库没有收录关键词的词频，减少误判

$start = microtime(true);

// 垃圾单文本简易分词
$segs =  array_filter(preg_split('/\.{2,}|\+/', strtolower($spm)));
foreach ($dict as $k => $v) {
    if (strlen(strpos($spm, $dict[$k])) > 0) {
        $segc[$k] = $dict[$k];
    }
}
if (isset($segs[1])) {
    if (isset($segc)) {
        $segf = array_merge($segc, $segs);
    }
    else {
        $segf = $segs;
    }
    $seg = array_values(array_unique($segf));
}
elseif (isset($segc)) {
    $segf = $segc;
    $seg = array_values(array_unique($segf));
}
else {
    $seg = $spm;
}
$sf =  array($seg);

// 正常单文本简易分词
$segn =  array_filter(preg_split('/\.{2,}|\+/', strtolower($nom)));
foreach ($dict as $k => $v) {
    if (strlen(strpos($nom, $dict[$k])) > 0) {
        $segc1[$k] = $dict[$k];
    }
}
if (isset($segn[1])) {
    if (isset($segc1)) {
        $segf1 = array_merge($segc1, $segn);
    }
    else {
        $segf1 = $segn;
    }
    $seg1 = array_values(array_unique($segf1));
}
elseif (isset($segc1)) {
    $segf1 = $segc1;
    $seg1 = array_values(array_unique($segf1));
}
else {
    $seg1 = $nom;
}
$nf =  array($seg1);

// 垃圾词二维数组转为一维数组
foreach ($sf as $k => $v) {
    foreach ($sf[$k] as $i => $v) {
        $sff[$u] = $sf[$k][$i];
        $u++;
    }
}
// 正常词二维数组转为一维数组
foreach ($nf as $k => $v) {
    foreach ($nf[$k] as $i => $v) {
        $nff[$w] = $nf[$k][$i];
        $w++;
    }
}
// 按数组所有值出现的次数精简
$cnt = array_count_values($sff);
$coun = array_count_values($nff);

// 把垃圾词出现次数转换为比例
foreach ($cnt as $k => $v) {
    $c[$k] = $cnt[$k] / count($sf);
}
// 垃圾词数组中的关键词与比例拆分为 2 个数组
$c1 = array_keys($c);
$c2 = array_values($c);
// 关键词和比例重组为新的二维数组
foreach ($c1 as $k => $v) {
    $cc[$k] = array($c1[$k], $c2[$k]);
}

// 把正常词出现次数转换为比例
foreach ($coun as $k => $v) {
    $d[$k] = $coun[$k] / count($nf);
}
// 正常词数组中的关键词与比例拆分为 2 个数组
$d1 = array_keys($d);
$d2 = array_values($d);
// 关键词和比例重组为新的二维数组
foreach ($d1 as $k => $v) {
    $dd[$k] = array($d1[$k], $isn, $d2[$k]);
}

// 垃圾词数组中每个词的垃圾和正常概率
foreach ($cc as $k => $v) {
    foreach ($dd as $i => $v) {
        if ($cc[$k][0] == $dd[$i][0]) {
            $ccc[$k] = array($cc[$k][0], $cc[$k][1], $dd[$i][2]);
            break;
        }
        else {
            $ccc[$k] = array($cc[$k][0], $cc[$k][1], $isn);
        }
    }
}
// 正常词数组中每个词的垃圾和正常概率
foreach ($dd as $k => $v) {
    foreach ($cc as $i => $v) {
        if ($dd[$k][0] == $cc[$i][0]) {
            unset($dd[$k]);
        }
    }
}
// 合并垃圾词的垃圾和正常概率与正常词的垃圾和正常概率
$new = array_merge($ccc, $dd);

// 查询内容分词
$abse =  array_filter(preg_split('/\.{2,}|\+/', strtolower($q)));
foreach ($new as $k => $v) {
    if (strlen(strpos($q, $new[$k][0])) > 0) {
        $segc[$k] = $new[$k][0];
    }
}
if (isset($abse[1])) {
    if (isset($segc)) {
        $segf = array_merge($segc, $abse);
    }
    else {
        $segf = $abse;
    }
    $seg = array_values(array_unique($segf));
}
elseif (isset($segc)) {
    $segf = $segc;
    $seg = array_values(array_unique($segf));
}
else {
    $seg = $q;
}
// 计算每个命中垃圾的词占总垃圾和总正常的比例
if (is_array($seg)) {
    foreach ($seg as $k => $v) {
        foreach ($new as $i => $v) {
            if ($seg[$k] == $new[$i][0]) {
            $sf[$k] = $new[$i][1];
            $nf[$k] = $new[$i][2];
            }
        }
       $spw[$k] = array($seg[$k], $sf[$k], $nf[$k]);
    }
    // 删除词库里不存在的词
    foreach ($spw as $k => $v) {
        if ($spw[$k][1] == 0 && $spw[$k][2] == 0) {
             unset($spw[$k]);
        }
    }
    // 贝叶斯方法计算垃圾概率
    foreach ($seg as $k => $v) {
        foreach ($spw as $swi => $v) {
            if ($seg[$k] == $spw[$swi][0]) {
                $spp[$k] = $spw[$swi][1] / ($spw[$swi][1] + $spw[$swi][2]);
                $spo[$k] = 1- $spw[$swi][1] / ($spw[$swi][1] + $spw[$swi][2]);
            }
        }
    }
}
echo '<p>'.$spm.' 为垃圾文本，'.$nom.' 为正常文本<br>';
echo '贝叶斯判断 <strong>'.$q.'</strong> 有'.sprintf('%.2f', (array_product($spp) / (array_product($spp) + array_product($spo))) * 100).'% 概率是擦边词';
echo '<br>计算耗时'.sprintf(' %.6f',(microtime(true) - $start)).' 秒';
?>
</p></body></html>