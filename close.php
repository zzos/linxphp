<?php
/**
  * @file 可以改成任意后缀为 .php 的文件名
  * @author maas(maasdruck@gmail.com)
  * @date 2017/08/17
  * @version v1.40
  * @brief 百度搜索结果参数分析工具
  */

header ('Cache-Control: max-age=86400');
header("Content-type: text/html; charset=utf-8");

if (isset($_GET['s'])) {
    $s = $_GET['s'];
}
else {
    $s = null;
}
if (isset($_GET['pn'])) {
    $pn = $_GET['pn'];
}
else {
    $pn = null;
}
if (isset($_GET['rn'])) {
    $rn = $_GET['rn'];
}
else {
    $rn = null;
}

$crawl = 2;        // 0 较少抓取 1 中等抓取 2 较多抓取 3 全面抓取
$dir = '/';        // 自定义文件所在目录，例如想把文件放在根目录下 a 目录，'/' 改为 '/a/'
$ist = './picstore/'; // 自定义存储图片目录
$cp  = 1;          // 想展现百度图片请把 0 改为 1
$adr = 0;          // 想用绝对地址请把 0 改为 1
$len = 63;         // 自定义标题字数上限(48 相当于 24 个汉字长度)
$pt  = '热搜榜'; // 自定义标题后缀
$des = '热搜榜'; // 默认元描述
$stk = './stc/';   // 临时缓存目录
$ct  = 2592000;     // 缓存时间 以秒数计算 如 1分钟=60 1天=86400 1周=604800 30天=2592000
$lk  = 0;          // 改为 1 启用伪静态(不推荐使用)
$noad = 0;         // 改为 1 启用特定时间段不展现广告
$st1 = './z409tgfq0w94fh0q934yr980q34r0q3s/';
if (!file_exists($st1)) {
    mkdir($st1, 0755);
}
if ($noad == 1) {
    // 下面为半夜3点后，到早晨7点前，不出现广告
    $previous_time = 3;
    $next_time = 7;
}
if ($lk == 1) {
    $l = '';       // 如果会修改服务器配置和写伪静态规则，在这里修改对应的伪静态网址
}
else {
    $l = '?s=';
}
$ws  = '';         // 自定义想展现的站内搜索域名 如 'www.baidu.com' 或 'baike.baidu.com'
if (strlen($ws) > 0) {
    $si = '&tn=json&rn=2&ct=2097152&si='.$ws;
}
else {
    $si = '';
}
// 代理 IP，用于反百度自动屏蔽机制(建议至少添加 1 个中国内地 IP)
$px = array(
    '',
);
// 可在下面数组里添加或删除友链
$fl = array(
    array('http://www.apple.com/cn/', '苹果'),
    array('https://www.tmall.com/', '天猫'),
    );

// 反垃圾
$pp = array(0=>'翻墙',1=>'vpn',2=>'在线代理',3=>'fqrouter',4=>'goagent',5=>'淫',6=>'套服务',7=>'大鸟',8=>'色',9=>'荒岛女儿国',10=>'av资源',11=>'推拿',12=>'wujie',13=>'漏鸟',14=>'仓井空',15=>'三肖',16=>'shadowsock',17=>'骚',18=>'露鸟',19=>'成人',20=>'包夜',21=>'蜜桃仙子',22=>'全裸',23=>'草榴',24=>'丝袜',25=>'投注',26=>'身透视',27=>'幼女',28=>'姦',29=>'百家乐',30=>'幼交',31=>'idbd下载',32=>'扑克',33=>'分析仪',34=>'网页代理',35=>'军妓',36=>'kayden',37=>'太阳城',38=>'av下载',39=>'蒙汗药',40=>'换妻',41=>'迷晕药',42=>'xingjiao',43=>'老虎机',44=>'日在',45=>'超级学生',46=>'六合',47=>'黄se',48=>'博彩',49=>'刘春玲',50=>'三宝局',51=>'性交',52=>'内射',53=>'人体',54=>'一条龙',55=>'小姐',56=>'深喉',57=>'娱乐城',58=>'g片免费下',59=>'ed2k',60=>'性爱',61=>'肉棒',62=>'乳',63=>'狠狠',64=>'狼人干',65=>'泷泽萝拉',66=>'桑拿',67=>'偷拍自拍',68=>'oldmanxinhen',69=>'丝足',70=>'彩坛',71=>'楼凤',72=>'撸',73=>'新农夫',74=>'r级',75=>'莞',76=>'跟踪定位',77=>'爽片',78=>'sex',79=>'av天堂',80=>'妹',81=>'咪咪',82=>'h版',83=>'性欲',84=>'露阴',85=>'特码',86=>'bt搜索',87=>'乱欲',88=>'轮盘',89=>'五月婷',90=>'ons',91=>'肉蒲',92=>'潮吹',93=>'一夜情',94=>'露奶',95=>'仁科百华',96=>'中特',97=>'一肖',98=>'胴',99=>'被插',100=>'六和',101=>'晨勃',102=>'口交',103=>'阴茎',104=>'阴毛',105=>'射精',106=>'鸡巴',107=>'肛交',108=>'保健',109=>'黄网',110=>'赌',111=>'爽图',112=>'露b',113=>'露B',114=>'自慰',115=>'奶子',116=>'苍蝇水',117=>'葡京',118=>'破解',119=>'裸体',120=>'裸聊',121=>'大奶',122=>'奸',123=>'裸照',124=>'援交',125=>'特服',126=>'动态图',127=>'三级',128=>'勃起',129=>'luoliao',130=>'越狱',131=>'手机定位',132=>'蜘蛛磁力',133=>'波霸',134=>'屄',135=>'少妇白洁',136=>'九九热',137=>'fuck',138=>'技师',139=>'a片',140=>'gv',141=>'上门',142=>'猥琐',143=>'做爱',144=>'报码',145=>'灯草和尚',146=>'野结衣',147=>'阴蒂',148=>'无套',149=>'吸奶',150=>'颜射',151=>'口爆',152=>'全集完结',153=>'特马',154=>'磁力链接',155=>'尻',156=>'祼体',157=>'肛',158=>'大尺度',159=>'吃精',160=>'阴道',161=>'liuhecai',162=>'大屌',163=>'舔',164=>'东方心经',165=>'ssh',166=>'无界',167=>'影梭',168=>'干姐',169=>'侦探',170=>'情药',171=>'春药',172=>'魂药',173=>'下药',174=>'hunk',175=>'bt森林',176=>'按摩',177=>'千金点特',178=>'毛主席',179=>'少妇熟女',180=>'6合',181=>'港马会',182=>'freegate',183=>'摸奶门',184=>'untitled',185=>'官人我要',186=>'京香julia',187=>'无码',188=>'激情视频',189=>'spycall',190=>'义母',191=>'手拉鸡',192=>'钢珠',193=>'气枪',194=>'zm52',195=>'newhalfclub',196=>'蜜桃成熟时3d电影',197=>'收养',198=>'徐明',199=>'绳刑',200=>'tktx麻药',201=>'黑社会',202=>'后台很硬',203=>'政变',204=>'毒品',205=>'av电影bt',206=>'博娱乐',207=>'socks代理',208=>'露鲍',209=>'av天堂',210=>'av种子',211=>'少妇乱伦',212=>'举报',213=>'一起happy下载',214=>'招聘公主',215=>'彩票',216=>'母鸡',217=>'sm女王',218=>'娱乐场',219=>'yaligaq',220=>'即时盘',221=>'工口动漫',222=>'白姐图库',223=>'大麻',224=>'香烟',225=>'罗清泉',226=>'av大帝',227=>'乐博',228=>'滚出',229=>'e世博',230=>'esball',231=>'张定发',232=>'跳楼',233=>'出轨',234=>'socks5',235=>'注册机',236=>'google%20chrome',237=>'squid+log',238=>'卵蛋',239=>'谁日过',240=>'紫阳',241=>'玷污');
// 下面每个单引号中可以替换上面对应编号的敏感词
$rp = array(0=>'围墙',1=>'vps',2=>'在线游戏',3=>'eqrout',4=>'bob',5=>'圣',6=>'为人民牺牲',7=>'屌丝',8=>'涩',9=>'山海经',10=>'正版电影',11=>'健身',12=>'youjie',13=>'隐匿',14=>'罗玉凤',15=>'三小',16=>'brightsock',17=>'纯',18=>'隐匿',19=>'大众',20=>'日常',21=>'鸭梨仙子',22=>'铠甲',23=>'绿网',24=>'袜子',25=>'投资',26=>'无法直视',27=>'老太婆',28=>'兄贵',29=>'万家哭',30=>'老交',31=>'id上传',32=>'卡牌',33=>'文言文',34=>'网页游戏',35=>'军人',36=>'katherine',37=>'月亮城',38=>'图片上传',39=>'矿泉水',40=>'换老公',41=>'牛肉粉丝汤',42=>'jiehe',43=>'猫咪机',44=>'学在',45=>'超级老师',46=>'八卦',47=>'绿',48=>'慈善',49=>'刘玲',50=>'七宝',51=>'进出',52=>'太监',53=>'野生',54=>'一只狗',55=>'女神',56=>'喉咙',57=>'避风塘',58=>'正版电影',59=>'ed1k',60=>'拉勾',61=>'骨棒',62=>'泌',63=>'静静',64=>'出家化缘',65=>'黑泽明',66=>'蒸房',67=>'不拍',68=>'oldman',69=>'长腿',70=>'公益论坛',71=>'潘金莲',72=>'抽',73=>'老工人',74=>'一级',75=>'完',76=>'海市蜃楼',77=>'纪录片',78=>'x',79=>'地狱',80=>'姊',81=>'蓬头',82=>'笑版',83=>'无欲',84=>'抽',85=>'凡号',86=>'淘宝搜索',87=>'无欲',88=>'轮转',89=>'六月雪',90=>'sno',91=>'骨床',92=>'吹牛',93=>'搞基',94=>'隐身',95=>'仁义道德',96=>'企鹅',97=>'公益',98=>'铜',99=>'被拉',100=>'八卦新闻',101=>'不举',102=>'口吃',103=>'萝卜',104=>'森林',105=>'和谐',106=>'茄子',107=>'股',108=>'保护',109=>'输',110=>'阉割',111=>'名画',112=>'藏匿',113=>'藏匿',114=>'治愈',115=>'奶瓶',116=>'蚊子水',117=>'西京',118=>'加密',119=>'艺术照',120=>'约会',121=>'大奶瓶',122=>'幻',123=>'裹照',124=>'读书',125=>'普服',126=>'静止画',127=>'一级',128=>'不举',129=>'约会',130=>'加密',131=>'盲人导航',132=>'蚂蚁电感应',133=>'球霸',134=>'牝',135=>'贵妇白荷',136=>'长长冷',137=>'拉扯',138=>'司机',139=>'纪录片',140=>'宦官',141=>'旅游',142=>'萎靡',143=>'打坐',144=>'慈善捐款',145=>'和尚',146=>'东尼大木',147=>'眼睛',148=>'装甲',149=>'吃奶',150=>'美颜',151=>'口吃',152=>'从良',153=>'赤兔马',154=>'电感应文本',155=>'股',156=>'盛装',157=>'股',158=>'纯洁',159=>'吃惊',160=>'牝道',161=>'八卦新闻',162=>'屌丝',163=>'擦',164=>'西方哲学',165=>'游戏',166=>'有界',167=>'亮剑',168=>'兄贵',169=>'学者',170=>'可乐',171=>'果汁',172=>'神饭',173=>'上菜',174=>'oldman',175=>'沙漠',176=>'敲打',177=>'千两黄金',178=>'最高领导',179=>'老妇',180=>'八卦',181=>'猫捉老鼠',182=>'freedom',183=>'健身',184=>'defined',185=>'不要不要',186=>'小泽征尔',187=>'马赛克',188=>'无欲无求',189=>'skype',190=>'老干妈',191=>'黄焖鸡',192=>'咸蛋',193=>'手机',194=>'1688',195=>'originall',196=>'请支持正版电影',197=>'又在非法拐卖',198=>'魏忠贤',199=>'跳绳',200=>'腾讯游戏',201=>'小学',202=>'清廉为民',203=>'上班',204=>'食品',205=>'动画片',206=>'道观',207=>'端口',208=>'夹腿',209=>'佛祖圣地',210=>'动物世界',211=>'校园青春',212=>'表扬',213=>'一起娱乐',214=>'包时多少钱',215=>'慈善',216=>'鸭子',217=>'天使',218=>'避难所',219=>'udun',220=>'延时游戏',221=>'动画',222=>'佛经',223=>'煎饼',224=>'香水',225=>'珞珈山',226=>'大流士',227=>'输',228=>'热爱',229=>'世博会',230=>'football',231=>'张文远',232=>'信仰之跃',233=>'虔诚',234=>'usb',235=>'付费版',236=>'google',237=>'squid',238=>'鸡蛋',239=>'谁迷恋过',240=>'红光',241=>'礼遇');
$p = array('/(\s+)/', '/(http:\/\/)/', '/(&)/','/#/', '/(https:\/\/)/');
$r = array('%20', '', '%26', '%23', '');
$z = substr(str_replace($pp, $rp, strtolower(preg_replace($p[1], $r[1], $s))), 0, 128);
$x = substr(str_replace($pp, $rp, strtolower(htmlspecialchars(preg_replace($p, $r, $s)))), 0, 128);
$y = array('+', '', '%26', '%23', '');
$q = substr(htmlspecialchars(str_replace($pp, $rp, strtolower(preg_replace($p, $y, $s)))), 0, 128);

if (basename(__FILE__) == 'index.php') {
    $uri = $dir;
}
else {
    $uri = $_SERVER["PHP_SELF"];
}
if ($adr == 1) {
    $u = '//'.$_SERVER['HTTP_HOST'].$uri;
}
else {
    $u = $uri;
}

shuffle($px);

echo '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-Hans" xml:lang="zh-Hans">
<head><meta charset="UTF-8">';

$nof = ' itemprop="url" target="_blank" rel="external nofollow noreferrer">';

$ft = '
        </div>
    </div>
</div>
<script>(function(){var A=window.baidu||{version:"1-1-0"};A.object=A.object||{};A.object.extend=function(B,D){for(var C in D){if(D.hasOwnProperty(C)){B[C]=D[C]}}};A.extend=A.object.extend;A.dom=A.dom||{};A.dom.g=function(B){if("string"==typeof B||B instanceof String){return document.getElementById(B)}else{if(B&&(B.nodeName&&(B.nodeType==1||B.nodeType==9))){return B}}return null};A.g=A.G=A.dom.g;A.dom.getDocument=function(B){B=A.dom.g(B);return B.nodeType==9?B:B.ownerDocument||B.document};A.dom._styleFixer=A.dom._styleFixer||{};A.dom._styleFilter=A.dom._styleFilter||[];A.dom._styleFilter.filter=function(C,G,E){for(var B=0,D=A.dom._styleFilter,F;F=D[B];B++){if(F=F[E]){G=F(C,G)}}return G};A.string=A.string||{};A.string.toCamelCase=function(B){return String(B).replace(/[-_]\D/g,function(C){return C.charAt(1).toUpperCase()})};A.dom.getStyle=function(F,G){var D=A.dom;F=D.g(F);G=A.string.toCamelCase(G);var B=F.style[G];if(B){return B}var C=D._styleFixer[G],E=F.currentStyle||(A.browser.ie?F.style:getComputedStyle(F,null));B="object"==typeof C&&C.get?C.get(F,E):E[C||G];if(C=D._styleFilter){B=C.filter(G,B,"get")}return B};A.getStyle=A.dom.getStyle;A.browser=A.browser||{};if(/msie (\d+\.\d)/i.test(navigator.userAgent)){A.ie=A.browser.ie=parseFloat(RegExp.$1)}if(/opera\/(\d+\.\d)/i.test(navigator.userAgent)){A.browser.opera=parseFloat(RegExp.$1)}A.browser.isWebkit=/webkit/i.test(navigator.userAgent);A.browser.isGecko=/gecko/i.test(navigator.userAgent)&&!/like gecko/i.test(navigator.userAgent);A.browser.isStrict=document.compatMode=="CSS1Compat";A.dom.getPosition=function(D){var B=A.dom.getDocument(D),E=A.browser;D=A.dom.g(D);var I=E.isGecko>0&&(B.getBoxObjectFor&&(A.dom.getStyle(D,"position")=="absolute"&&(D.style.top===""||D.style.left===""))),J={left:0,top:0},H=E.ie&&!E.isStrict?B.body:B.documentElement;if(D==H){return J}var C=null,F;if(D.getBoundingClientRect){F=D.getBoundingClientRect();J.left=Math.floor(F.left)+Math.max(B.documentElement.scrollLeft,B.body.scrollLeft);J.top=Math.floor(F.top)+Math.max(B.documentElement.scrollTop,B.body.scrollTop);J.left-=B.documentElement.clientLeft;J.top-=B.documentElement.clientTop;if(E.ie&&!E.isStrict){J.left-=2;J.top-=2}}else{if(B.getBoxObjectFor&&!I){F=B.getBoxObjectFor(D);var G=B.getBoxObjectFor(H);J.left=F.screenX-G.screenX;J.top=F.screenY-G.screenY}else{C=D;do{J.left+=C.offsetLeft;J.top+=C.offsetTop;if(E.isWebkit>0&&A.dom.getStyle(C,"position")=="fixed"){J.left+=B.body.scrollLeft;J.top+=B.body.scrollTop;break}C=C.offsetParent}while(C&&C!=D);if(E.opera>0||E.isWebkit>0&&A.dom.getStyle(D,"position")=="absolute"){J.top-=B.body.offsetTop}C=D.offsetParent;while(C&&C!=B.body){J.left-=C.scrollLeft;if(!b.opera||C.tagName!="TR"){J.top-=C.scrollTop}C=C.offsetParent}}}return J};A.event=A.event||{};A.event._unload=function(){var C=A.event._listeners,B=C.length,D=!(!window.removeEventListener),E,F;while(B--){E=C[B];F=E[0];if(F.removeEventListener){F.removeEventListener(E[1],E[3],false)}else{if(F.detachEvent){F.detachEvent("on"+E[1],E[3])}}}if(D){window.removeEventListener("unload",A.event._unload,false)}else{window.detachEvent("onunload",A.event._unload)}};if(window.attachEvent){window.attachEvent("onunload",A.event._unload)}else{window.addEventListener("unload",A.event._unload,false)}A.event._listeners=A.event._listeners||[];A.event.on=function(F,B,E){B=B.replace(/^on/i,"");if("string"==typeof F){F=A.dom.g(F)}var C=function(G){E.call(F,G)},D=A.event._listeners;D[D.length]=[F,B,E,C];if(F.attachEvent){F.attachEvent("on"+B,C)}else{if(F.addEventListener){F.addEventListener(B,C,false)}}return F};A.on=A.event.on;A.event.preventDefault=function(B){if(B.preventDefault){B.preventDefault()}else{B.returnValue=false}};A.ui=A.ui||{};A.suggestion=A.ui.suggestion=A.ui.suggestion||{};(function(){var B={},C=function(E){var D={};E.listen=function(F,H){D[F]=D[F]||[];var G=0;while(G<D[F].length&&D[F][G]!=H){G++}if(G==D[F].length){D[F].push(H)}return E};E.call=function(G){if(D[G]){for(var F=0;F<D[G].length;F++){D[G][F].apply(this,Array.prototype.slice.call(arguments,1))}}return E}};B.extend=function(D){new C(D);return D};B.extend(B);A.suggestion._Central=B})();A.ui.suggestion._Div=function(V,o,Z,a,X){var d=this,h,T,Y,l,f=X.class_prefix,U,S=document.createElement("DIV");S.id=f+(new Date()).getTime();S.className=f+"wpr";S.style.display="none";var c=document.createElement("IFRAME");c.className=f+"sd";c.style.display="none";c.style.position="absolute";c.style.borderWidth="0px";if(X.apd_body){document.body.appendChild(S)}else{o.parentNode.appendChild(S)}S.parentNode.insertBefore(c,S);V.listen("start",function(){A.on(document,"mousedown",function(B){B=B||window.event;var C=B.target||B.srcElement;if(C==o){return }while(C=C.parentNode){if(C==S){return }}W()});A.on(window,"blur",W)});V.listen("key_enter",function(){var B=i(),C=B[0]==-1?l:B[1];X.onconfirm(Z.getValue(),B[0],C,B[2],true);W()});function m(F,D){if(S.style.display=="none"){V.call("need_data",Z.getValue());return }var B=i()[0];j();if(F){if(B==0){g(D);B--;return }if(B==-1){B=T.length}B--}else{if(B==T.length-1){g(D);B=-1;return }B++}n(B);k();var E=Z.getValue();g(B);var C=i();X.onpick(E,C[0],C[1],C[2])}V.listen("key_up",function(B){m(1,B)});V.listen("key_down",function(B){m(0,B)});V.listen("key_tab",W);V.listen("key_esc",W);V.listen("all_clear",W);V.listen("data_ready",function(E,C){l=C;T=[];Y=[];for(var B=0,D=C.length;B<D;B++){if(typeof C[B].input!="undefined"){T[B]=C[B].input;Y[B]=C[B].selection}else{Y[B]=T[B]=C[B]}}if(T.length!=0){U=a(S,Y,d);for(var B=0,D=U.length;B<D;B++){A.on(U[B],"mouseover",function(){j();this.className=f+"mo";k()});A.on(U[B],"mouseout",j);A.on(U[B],"mousedown",function(F){V.call("mousedown_item");if(!A.ie){F.stopPropagation();F.preventDefault();return false}});A.on(U[B],"click",e(B))}}else{W()}});function j(){for(var B=0;B<U.length;B++){U[B].className=f+"ml"}}function i(){if(U&&S.style.display!="none"){for(var B=0;B<U.length;B++){if(U[B].className==f+"mo"){return[B,T[B],Y[B]]}}}return[-1,""]}function k(){var B=i();X.onhighlight(Z.getValue(),B[0],B[1],B[2])}function n(B){j();U[B].className=f+"mo"}function g(C){var B=T&&(typeof C=="number"&&typeof T[C]!="undefined")?T[C]:C;V.call("pick_word",B)}function W(){if(S.style.display=="none"){return null}c.style.display=S.style.display="none";X.onhide()}function e(B){var C=B;return function(){V.call("confirm_item",Z.getValue(),T[C],C,Y[C]);var D=Z.getValue();g(T[C]);X.onpick(D,C,T[C],Y[C]);X.onconfirm(Z.getValue(),C,T[C],Y[C]);W()}}return{element:S,shade:c,pick:g,highlight:n,hide:W,dispose:function(){S.parentNode.removeChild(S)}}};A.ui.suggestion._Data=function(D,B){var C=this,E={};D.listen("response_data",function(G,F){E[G]=F;D.call("data_ready",G,F)});D.listen("need_data",function(F){if(typeof E[F]=="undefined"){B(F)}else{D.call("data_ready",F,E[F])}});return{}};A.ui.suggestion._InputWatcher=function(H,G,E){var F=this,K,D=0,L="",C="",J="",M,I=false,N=false,B=false;G.setAttribute("autocomplete","off");A.on(G,"keydown",function(O){if(!B){H.call("start");B=true}O=O||window.event;var P;switch(O.keyCode){case 9:P="tab";break;case 27:P="esc";break;case 13:P="enter";break;case 38:P="up";A.event.preventDefault(O);break;case 40:P="down"}if(P){H.call("key_"+P,C)}});A.on(G,"mousedown",function(){if(!B){H.call("start");B=true}});A.on(G,"beforedeactivate",function(){if(I){window.event.cancelBubble=true;window.event.returnValue=false}});H.listen("start",function(){J=G.value;D=setInterval(function(){if(N){return }if(A.G(G)==null){suggestion.dispose()}var O=G.value;if(O==L&&(O!=""&&(O!=J&&O!=M))){if(K==0){K=setTimeout(function(){H.call("need_data",O)},100)}}else{clearTimeout(K);K=0;if(O==""&&L!=""){M="";H.call("all_clear")}L=O;if(O!=M){C=O}if(J!=G.value){J=""}}},10)});H.listen("pick_word",function(O){if(I){G.blur()}G.value=M=O;if(I){G.focus()}});H.listen("mousedown_item",function(O){I=true;N=true;setTimeout(function(){N=false;I=false},500)});H.listen("confirm_item",function(R,P,Q,O){N=false;C=L=Q});return{getValue:function(){return G.value},dispose:function(){clearInterval(D)}}};A.ui.suggestion._Suggestion=function(F,B){var E=this,C=A.ui.suggestion._MessageDispatcher;E.options={onpick:function(){},onconfirm:function(){},onhighlight:function(){},onhide:function(){},view:null,getData:false,prepend_html:"",append_html:"",class_prefix:"tangram_sug_",apd_body:false};A.extend(E.options,B);if(!(F=A.G(F))){return null}E.inputElement=F;if(F.id){E.options._inputId=F.id}else{F.id=E.options._inputId=E.options.class_prefix+"ipt"+(new Date()).getTime()}E._adjustPos=function(S){var J=G.element,M=G.shade,P=document,N=P.compatMode=="BackCompat"?P.body:P.documentElement,O=N.clientHeight,K=N.clientWidth;if(J.style.display=="none"&&S){return }var Q=A.dom.getPosition(F),L=[Q.top+F.offsetHeight-1,Q.left,F.offsetWidth];L=typeof E.options.view=="function"?E.options.view(L):L;J.style.display=M.style.display="block";M.style.top=L[0]+"px";M.style.left=L[1]+"px";M.style.width=L[2]+"px";var V=parseFloat(A.getStyle(J,"marginTop"))||0,R=parseFloat(A.getStyle(J,"marginLeft"))||0;J.style.top=L[0]-V+"px";J.style.left=L[1]-R+"px";if(A.ie&&document.compatMode=="BackCompat"){J.style.width=L[2]+"px"}else{var U=parseFloat(A.getStyle(J,"borderLeftWidth"))||0,W=parseFloat(A.getStyle(J,"borderRightWidth"))||0,T=parseFloat(A.getStyle(J,"marginRight"))||0;J.style.width=L[2]-U-W-R-T+"px"}M.style.height=J.offsetHeight+"px";if(O!=N.clientHeight||K!=N.clientWidth){E._adjustPos()}};E._draw=function(M,T){var Q=[],L=document.createElement("TABLE");L.cellPadding=2;L.cellSpacing=0;var R=document.createElement("TBODY");L.appendChild(R);for(var O=0,J=T.length;O<J;O++){var S=R.insertRow(-1);Q.push(S);var K=S.insertCell(-1);K.innerHTML=T[O]}var P=document.createElement("DIV");P.className=E.options.class_prefix+"pre";P.innerHTML=E.options.prepend_html;var N=document.createElement("DIV");N.className=E.options.class_prefix+"app";N.innerHTML=E.options.append_html;M.innerHTML="";M.appendChild(P);M.appendChild(L);M.appendChild(N);E._adjustPos();return Q};var H=A.suggestion._Central.extend(E),D=new A.ui.suggestion._Data(H,E.options.getData),I=new A.ui.suggestion._InputWatcher(H,F,G),G=new A.ui.suggestion._Div(H,F,I,E._draw,E.options);H.listen("start",function(){setInterval(function(){var J=G.element;if(J.offsetWidth!=0&&F.offsetWidth!=J.offsetWidth){E._adjustPos()}},100);A.on(window,"resize",function(){E._adjustPos(true)})});return{pick:G.pick,hide:G.hide,highlight:G.highlight,getElement:function(){return G.element},getData:E.options.getData,giveData:function(K,J){H.call("response_data",K,J)},dispose:function(){G.dispose();I.dispose()}}};A.ui.suggestion.create=function(B,C){return new A.ui.suggestion._Suggestion(B,C)};window.baidu=A})();var BaiduSuggestion=(function(){var D={};var E={};function O(P){return document.createElement(P)}var J={createSugOptions:function(S,R,Q,P){return{class_prefix:"bdSug_",onconfirm:function(Y,W,U,V,X){if(Q&&W>-1){try{Q.apply(window,[U])}catch(T){}}if(P&&!X){P.submit()}},view:function(T){if(R&&R.width){T[2]=parseInt(R.width)}if(R&&R.XOffset&&R.YOffset){return[T[0]-R.YOffset,T[1]-R.XOffset,T[2]]}return[T[0],T[1],T[2]]},getData:function(U){var V=(new Date()).getTime();var W=baidu.G("bdSug_script");if(W){document.body.removeChild(W)}var T=O("script");T.setAttribute("charset","gbk");T.src="//unionsug.baidu.com/su?wd="+encodeURIComponent(U)+"&p=3&cb=BaiduSuggestion.callbacks.give"+S+"&t="+V;T.id="bdSug_script";document.body.appendChild(T)},append_html:"",apd_body:true}},createSugCallback:function(P){return function(R){if(!R){return }var S=[];for(var T=0;T<R.s.length;T++){var Q={};Q.input=R.s[T];Q.selection=R.s[T];S.push(Q)}E["sug"+P].giveData(R.q,S)}}};function I(T,Z,S,X){if(!T){return }if(typeof (T)=="string"||T instanceof String){T=baidu.G(T)}if(!T.sugId){T.sugId=(new Date).getTime()}if(E["sug"+T.sugId]){return false}if(Z==null){var Z=[]}else{X=Z.sugSubmit;var Q=Z.fontColor?Z.fontColor:"#000";var W=Z.fontSize?Z.fontSize:"14px";var P=Z.fontFamily?Z.fontFamily:"verdana";var U=Z.bgcolorHI?Z.bgcolorHI:"#36c";var R=Z.fontColorHI?Z.fontColorHI:"#FFF";var Y=Z.borderColor?Z.borderColor:"#817f82";L(".bdSug_wpr","border:1px solid "+Y+";position:absolute;z-index:9;top:28px;left:0;color:"+Q);L(".bdSug_wpr td","font-size:"+W+";font-family:"+P);L(".bdSug_mo","background-color:"+U+";color:"+R)}if(G(document.body,"position")=="relative"||G(document.body,"position")=="absolute"){var V=B(document.body);Z.XOffset=(Z.XOffset?parseInt(Z.XOffset):0)+V.x;Z.YOffset=(Z.YOffset?parseInt(Z.YOffset):0)+V.y}E["sug"+T.sugId]=baidu.suggestion.create(T,J.createSugOptions(T.sugId,Z,S,X?N(T):null));D["give"+T.sugId]=J.createSugCallback(T.sugId)}function N(Q){var P=Q;while(P!=document.body&&P.tagName!="FORM"){P=P.parentNode}return(P.tagName=="FORM")?P:null}function B(R){var P=document;var Q=0;var S=0;if(R.getBoundingClientRect){var T=R.getBoundingClientRect();Q=T.left+Math.max(P.documentElement.scrollLeft,P.body.scrollLeft);S=T.top+Math.max(P.documentElement.scrollTop,P.body.scrollTop);Q-=P.documentElement.clientLeft;S-=P.documentElement.clientTop}else{while(R=R.offsetParent){Q+=R.offsetLeft;S+=R.offsetTop}}return{x:Q,y:S}}function L(R,Q){var S=document.styleSheets;if(!S||S.length<=0){var P=document.createElement("STYLE");P.type="text/css";var T=document.getElementsByTagName("HEAD")[0];T.appendChild(P)}S=document.styleSheets;S=S[S.length-1];if(baidu.ie){S.addRule(R,Q)}else{S.insertRule(R+" { "+Q+" }",S.cssRules.length)}}function G(R,P,Q){if(!R){return }if(Q!=undefined){R.style[P]=Q}else{if(R.style[P]){return R.style[P]}else{if(R.currentStyle){return R.currentStyle[P]}else{if(document.defaultView&&document.defaultView.getComputedStyle){P=P.replace(/([A-Z])/g,"-\u00241").toLowerCase();var S=document.defaultView.getComputedStyle(R,"");return S&&S.getPropertyValue(P)||""}}}}}function A(){L(".bdSug_wpr","line-height:normal;background:#FFF;padding:0;margin:0;border:1px solid #817F82;position:absolute;z-index:9999;");L(".bdSug_wpr table","position:absolute;bottom:2.5em;left:.25px;padding:0;width:100%;background:#fff;cursor:default;");L(".bdSug_wpr tr","padding:0;margin:0");L(".bdSug_wpr td","padding:.25em;margin:0;text-align:left;vertical-align:middle;font:14px verdana;font-weight:normal;text-decoration:none;text-indent:0");L(".bdSug_mo","background:#36c;color:#fff");L(".bdSug_app","padding:0;margin:0;background:#fff");L(".bdSug_pre","padding:0;margin:0");L()}A();var H=document.body.getElementsByTagName("INPUT");for(var K=0,F=H.length;K<F;K++){var M=H[K];if(M&&M.type=="text"&&(M.getAttribute("su")==1||M.getAttribute("su")==2)){M.sugId=K;var C=(M.getAttribute("su")==1);I(M,null,null,C)}}return{bind:I,callbacks:D}})();function show(str){txtObj.innerHTML=str}var params={fontColorHI:"#000000",fontSize:"1em",fontFamily:"Helvetica Neue",borderColor:"#DDDDDD",bgcolorHI:"#DDDDDD",sugSubmit:true};BaiduSuggestion.bind("sug",params,show);function clearInput(){document.getElementById("js-in").value="";}</script>
</body></html>';

// 自动清理缓存
if (!file_exists($stk)) {
    mkdir($stk, 0755);
}
if (!file_exists($stk.'cache')) {
    file_put_contents($stk.'cache', '');
}
if ((time() - filemtime($stk.'cache')) > ($ct - 1)) {
    $od = opendir($stk);
    while (($ch = readdir($od)) != false) {
        if($ch == '.' || $ch == '..') {
            continue;
        }
        if ((time() - filemtime($stk.$ch)) > $ct) {
            unlink($stk.$ch);
        }
    }
    closedir($od);
}

if (!file_exists($ist.'cache')) {
    file_put_contents($ist.'cache', '');
}
if ((time() - filemtime($ist.'cache')) > ($ct - 1)) {
    $odp = opendir($ist);
    while (($chp = readdir($odp)) != false) {
        if($chp == '.' || $chp == '..') {
            continue;
        }
        if ((time() - filemtime($ist.$chp)) > $ct) {
            unlink($ist.$chp);
        }
    }
    closedir($odp);
}

if (strlen($s) > 0 && !isset($rn)) {
    if (file_exists($stk.md5(urlencode($q).$pn)) && file_exists($stk.md5(urlencode($q).$pn)).'0') {
        echo file_get_contents($stk.md5(urlencode($q).$pn).'0');
        if(date('H', time()) < @$previous_time || date('H', time()) > @$next_time) {
            // 在黑客或黑帽劫持前先行一步主动劫持 user-agent 投放没被劫持的广告
            if (stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone') || stripos($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
                echo '    <div class="header dis"></div>'; // div 容器中是移动端顶部广告位
                echo '    <div class="dis"></div>'; // div 容器中是移动端侧边广告位
            }
            // 正常展现广告
            else {
                echo '    <div class="header center non"></div>'; // div 容器中是 pc 端顶部广告位
                echo '    <div class="dis"></div>'; // div 容器中是移动端侧边广告位
            }
        }
        echo file_get_contents($stk.md5(urlencode($q).$pn)).$ft;
        exit;
    }
    ob_start();
}

$url_arr=array('xss'=>"\\=\\+\\/v(?:8|9|\\+|\\/)|\\%0acontent\\-(?:id|location|type|transfer\\-encoding)");$args_arr=array('xss'=>"[\\'\\\"\\;\\*\\<\\>].*\\bon[a-zA-Z]{3,15}[\\s\\r\\n\\v\\f]*\\=|\\b(?:expression)\\(|\\<script[\\s\\\\\\/]|\\<\\!\\[cdata\\[|\\b(?:eval|alert|prompt|msgbox)\\s*\\(|url\\((?:\\#|data|javascript)",'sql'=>"[^\\{\\s]{1}(\\s|\\b)+(?:select\\b|update\\b|insert(?:(\\/\\*.*?\\*\\/)|(\\s)|(\\+))+into\\b).+?(?:from\\b|set\\b)|[^\\{\\s]{1}(\\s|\\b)+(?:create|delete|drop|truncate|rename|desc)(?:(\\/\\*.*?\\*\\/)|(\\s)|(\\+))+(?:table\\b|from\\b|database\\b)|into(?:(\\/\\*.*?\\*\\/)|\\s|\\+)+(?:dump|out)file\\b|\\bsleep\\([\\s]*[\\d]+[\\s]*\\)|benchmark\\(([^\\,]*)\\,([^\\,]*)\\)|(?:declare|set|select)\\b.*@|union\\b.*(?:select|all)\\b|(?:select|update|insert|create|delete|drop|grant|truncate|rename|exec|desc|from|table|database|set|where)\\b.*(charset|ascii|bin|char|uncompress|concat|concat_ws|conv|export_set|hex|instr|left|load_file|locate|mid|sub|substring|oct|reverse|right|unhex)\\(|(?:master\\.\\.sysdatabases|msysaccessobjects|msysqueries|sysmodules|mysql\\.db|sys\\.database_name|information_schema\\.|sysobjects|sp_makewebtask|xp_cmdshell|sp_oamethod|sp_addextendedproc|sp_oacreate|xp_regread|sys\\.dbms_export_extension)",'other'=>"\\.\\.[\\\\\\/].*\\%00([^0-9a-fA-F]|$)|%00[\\'\\\"\\.]");$referer=empty($_SERVER['HTTP_REFERER'])?array():array($_SERVER['HTTP_REFERER']);$query_string=empty($_SERVER["QUERY_STRING"])?array():array($_SERVER["QUERY_STRING"]);check_data($query_string,$url_arr);check_data($_GET,$args_arr);check_data($_POST,$args_arr);check_data($_COOKIE,$args_arr);check_data($referer,$args_arr);function W_log($log){$logpath=$_SERVER["DOCUMENT_ROOT"]."/log.txt";$log_f=fopen($logpath,"a+");fputs($log_f,$log."\r\n");fclose($log_f);}function check_data($arr,$v){foreach($arr as $key=>$value){if(!is_array($key)){check($key,$v);}else{check_data($key,$v);}if(!is_array($value)){check($value,$v);}else{check_data($value,$v);}}}function check($str,$v){foreach($v as $key=>$value){if(preg_match("/".$value."/is", $str)==1||preg_match("/".$value."/is", urlencode($str))==1){echo'<title>已过滤跨站脚本攻击漏洞, 到别处看看罢</title>';exit();}}}

echo '<title>';

if (strlen($s) > 0) {
    $sugip = array('115.239.211.11', '115.239.211.12', '180.97.33.72', '180.97.33.73');
    shuffle ($sugip);
    $c = curl_init();
    curl_setopt($c, CURLOPT_HEADER, 0);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 1);
    curl_setopt($c, CURLOPT_TIMEOUT, 2);
    curl_setopt($c, CURLOPT_URL, 'http://'.$sugip[0].'/su?action=opensearch&ie=UTF-8&wd='.$q);
    $su = json_decode(curl_exec($c));
    curl_close($c);

    function wc($str, $enc = 'UTF-8') {
        if(strtolower($enc) == 'gbk') {
            $enc = 'gb18030';
        }
        if(!is_string($str) || $str === '')
            return false;
            $sl = 0;
            for ($i = 0; $i < iconv_strlen($str, $enc); $i++) {
                strlen(iconv_substr($str, $i, 1, $enc)) == 1 ? $sl += 1 : $sl += 2;
            }
            return $sl;
    }
    $wpt = wc($pt);
    $wz = wc(htmlspecialchars($z, ENT_QUOTES));
    $wsug = wc(@$su[1][0]);

    if ($pn > 0) {
        if (strlen(@$su[1][1]) > 0) {
            if (($wsug + $wz) < $len) {
                echo str_replace($pp, $rp, $su[1][1]).'_';
            }
        }
        echo htmlspecialchars($z, ENT_QUOTES).'_第'.floor($pn / 10 + 1).'页';
    }
    else {
        if (strlen(@$su[1][0]) > 0) {
            if (($wsug + $wz) < $len) {
                echo str_replace($pp, $rp, $su[1][0]).'_';
            }
        }
        echo htmlspecialchars($z, ENT_QUOTES);
        if ((($wz + $wpt) < ($len - 1) && ($wsug + $wz) > $len) || ($wsug + $wz + $wpt) < ($len - 1)) {
            echo '_'.$pt;
        }
    }
}
else {
    echo $pt;
}
echo '</title>
<meta content="';
if (strlen($s) > 0) {
    $c = curl_init();
    curl_setopt($c, CURLOPT_HEADER, 0);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 1);
    curl_setopt($c, CURLOPT_TIMEOUT, 3);
    curl_setopt($c, CURLOPT_URL, 'http://baike.baidu.com/api/openapi/BaikeLemmaCardApi?format=json&appid=379020&bk_key='.@$q);
    $bk = json_decode(curl_exec($c), 1);
    curl_close($c);
    if (strlen(@$bk['abstract']) > 0 && @$pn == null && @$rn == null) {
        echo str_replace('...', '', str_replace($pp, $rp, $bk['abstract']));
    }
    else {
        echo $des;
    }
}
else {
    echo $des;
}
echo '" name="description">
';

echo '<meta content="';
if (strlen($s) > 0) {
    if (strlen(@$su[1][0]) > 0 && @$su[1][0] != $pt) {
        echo str_replace($pp, $rp, $su[1][0]).',';
    }
    if (strlen(@$su[1][1]) > 0 && @$su[1][1] != $pt) {
        echo str_replace($pp, $rp, $su[1][1]).',';
    }
    if (strlen(@$su[1][2]) > 0 && @$su[1][2] != $pt) {
        echo str_replace($pp, $rp, $su[1][2]).',';
    }
    if (strlen(@$su[1][3]) > 0 && @$su[1][3] != $pt) {
        echo str_replace($pp, $rp, $su[1][3]).',';
    }
    if (strlen(@$su[1][4]) > 0 && @$su[1][4] != $pt) {
        echo str_replace($pp, $rp, $su[1][4]).',';
    }
    echo htmlspecialchars($z, ENT_QUOTES).',';
}
echo $pt.'" name="keywords">
<meta content="';
if (strlen($s) > 0) {
    if (strlen(@$su[1][0]) > 0) {
        if (($wsug + $wz) < $len) {
            echo str_replace($pp, $rp, $su[1][0]).'_';
        }
    }
    echo htmlspecialchars($z, ENT_QUOTES);
}
else {
    echo $pt;
}
$http = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
echo '" name="apple-mobile-web-app-title">
<link href="'.$http.$_SERVER['HTTP_HOST'].$u;
if (isset($x) && strlen($x) > 0) {
    echo $l;
}
if (isset($x)) {
    echo $x.'" rel="canonical">
';
}
else {
    echo '" rel="canonical">
';
}
?>
<meta content="webkit" name="renderer">
<meta content="telephone=no" name="format-detection">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0,minimal-ui" name="viewport">
<style type="text/css">body,div,h1{margin:0}body{color:#222222;background-color:#F8F7F5;font-family:"Helvetica Neue",Helvetica,"Hiragino Sans GB","Microsoft YaHei",Arial,sans-serif;height:100%}h1{font-size:1.5em;line-height:2.25em}img{height:auto!important;max-width:88.6%!important;border-radius:.618em}table{width:46.25em;border-collapse:collapse;width:100%!important}thead{color:#0080FF;background-color:#F2F2F2}th,td{padding:.618em .5em .618em .5em}blockquote{margin:1.25em;padding:0 1em;border-left-width:.3125em;border-left-style:solid;border-left-color:rgb(234,238,241);color:rgb(85,85,85);line-height:1.57421875em;white-space:normal}a{color:#607FA6;font-size:1em;text-decoration:none;line-height:1.25em}.noa{color:#FFD700;font-size:1em;font-weight:bold;text-decoration:none}.soft{color:#FFDDAA}.pink{color:#FFC0CB;font-size:1em;font-weight:bold;text-decoration:none}.pinks{color:#FFC0CB;text-decoration:none}input{font:normal 100% "STHeiti STXihei","Lucida Grande","Microsoft JhengHei","Microsoft Yahei",Helvetica,Tohoma,Arial,Verdana,sans-serif}.other{padding:.125em .3125em .25em .3125em;height:2.5em;width:5em;outline:0}.submit{height:3.125em;width:5.9375em;border:0}.center{text-align:center}.bold{font-size:1.5em;font-weight:bold;word-break:normal;word-wrap:break-word}.break{word-break:break-all}.tiny{font-size:.8em;line-height:1em}@media screen and (min-width:1024px){.detail{width:46.25em;margin:0 auto;padding:1.25em;padding-top:0;border:0}}.detail{background-color:#373737}.header{padding:.5em 0 .625em 0;border-bottom:.0625em}.red{color:#F5DEB3}.white{color:#FFFAF0}.back-white{background-color:#FFFFFF;opacity:.85}.back-egg{background-color:#FFFFBB;opacity:.85}.back-pink{background-color:#FFB7DD;opacity:.85}.back-yellow{background-color:#FFDDAA;opacity:.85}.back-orange{background-color:#FFDDAA;opacity:.85}.back-gold{background-color:#FFEE99;opacity:.85}.back-green{background-color:#EEFFBB;opacity:.85}.back-blue{background-color:#CCDDFF;opacity:.85}.back-sky{background-color:#CCEEFF;opacity:.85}.back-baidu{background-color:#77BBEF;opacity:.85}.back-wheat{background-color:#F5DEB3;opacity:.85}.back-azure{background-color:#F0FFFF;opacity:.85}.honeydew{background-color:#F0FFF0;opacity:.85}.gold{background-color:#FFD700;opacity:.85}.orange{background-color:#FFA500;opacity:.85}.violet{background-color:#EE82EE;opacity:.85}.tomato{background-color:#FF6347;opacity:.85}.lavender{background-color:#E6E6FA;opacity:.85}.silver{background-color:#C0C0C0;opacity:.85}.darkseagreen{background-color:#8FBC8F;opacity:.85}.mediumpurple{background-color:#9370DB;opacity:.85}.burlywood{background-color:#DEB887;opacity:.85}.aquamarine{background-color:#7FFFD4;opacity:.85}.springgreen{background-color:#00FF7F;opacity:.85}.darkturquoise{background-color:#00CED1;opacity:.85}.mediumseagreen{background-color:#3CB371;opacity:.85}.deepskyblue{background-color:#00BFFF;opacity:.85}.lightskyblue{background-color:#87CEFA;opacity:.85}.rr{border-radius:0 .382em .382em 0}.topr{border-radius:.382em .382em 0 0}.btnr{border-radius:0 0 .382em .382em}.right_outer,.non{display:none!important}@media screen and (min-width:1024px){.draglist:hover{border-color:#FFFFBB;background-color:#FFDDAA}.non{display:block!important}.text{padding:.125em .3125em .25em .3125em;height:2.5em;width:22.5em;outline:0}.right_outer{display:block!important;position:fixed;left:0;right:0;top:-2.5em;color:#717375;text-align:center}.right_inner{position:relative;width:46.25em;margin-left:auto;margin-right:auto}.right p{line-height:1.75em}.right{position:absolute;right:-150px;top:42px;padding:8px;border:.0625em solid #D9DADC;background-color:#FFFFFF;width:7em}}.dis{display:none!important}.space{letter-spacing:.875em}@media screen and (max-width:1023px){.dis{display:block!important}.text{padding:.125em .3125em .25em .3125em;height:2.5em;width:12em;outline:0}}@media screen and (max-width:1023px){.mb{font-size:.875em;line-height:1.9em}}</style>
<script>
<!--
if (top.location != self.location)top.location=self.location;
//
-->
</script></head>
<body itemscope itemtype="http://schema.org/WebPage">
<div class="detail" style="box-shadow:0 0 3.5em #00C3FF inset,0 0 0 0">
<?php
if (strlen($s) > 0 && !isset($rn)) {
    $tp0 = ob_get_contents();
    ob_end_clean();
    echo $tp0;
    file_put_contents($stk.md5(urlencode($q).$pn).'0', $tp0);
}

date_default_timezone_set('PRC');

if(date('H', time()) < @$previous_time || date('H', time()) > @$next_time) {
    // 在黑客或黑帽劫持前先行一步主动劫持 user-agent 投放没被劫持的广告
    if (stripos($_SERVER['HTTP_USER_AGENT'], 'iPhone') || stripos($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
        echo '    <div class="header dis"></div>'; // div 容器中是移动端顶部广告位
        echo '    <div class="dis"></div>'; // div 容器中是移动短侧边广告位
    }
    // 正常展现广告
    else {
        echo '    <div class="header center non"><script type="text/javascript" src="tongji.js"></script></div>'; // div 容器中是 pc 端顶部广告位
        echo '    <div class="header dis"></div>'; // div 容器中是移动端顶部广告位
        echo '    <div class="dis"></div>'; // div 容器中是移动端侧边广告位
    }
}

if (strlen($s) > 0 && !isset($rn)) {
    ob_start();
}
if (strlen($s) == 0) {
    echo '    <div class="back-yellow mb" style="padding:1em;border-radius:0 0 .382em .382em">';
    // 网友们实时搜索
    $c2 = 'cac';
    $ct2 = 14400;
    $shlbaidu = 'yizhiwangnanfangkai'; // 百度搜索实时热点
    $shl163 = 'ruguohaiyoumingtian'; // 网易音乐
    $shlsogou = 'haikuotiankong'; // 搜狗热搜榜
    $shldouban = 'the+mass'; // 豆瓣最新电影
    if ((time() - filemtime($st1.$c2) + 1) > $ct2) {
        unlink($st1.$c2);
        // 百度搜索实时热点
        $c = curl_init();
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($c, CURLOPT_TIMEOUT, 4);
        curl_setopt($c, CURLOPT_URL, 'http://entry.baidu.com/rp/api?di=api100002&qnum=40');
        $ikbaidu = json_decode(curl_exec($c), 1);
        curl_close($c);
        if ($ikbaidu['st'] > 0) {
            ob_start();
            foreach ($ikbaidu['data']['recommends'] as $ikbaidu1) {
                if ($ikbaidu1['type'] == 109) {
                    echo strtolower($ikbaidu1['word'])."\n";
                }
                else {
                    unlink($ikbaidu1);
                }
            }
            $ikbaidu0 = ob_get_contents();
            ob_end_clean();
            file_put_contents($shlbaidu, $ikbaidu0, LOCK_EX);
        }
        else {
            touch($shlbaidu);
        }
        // 网易音乐
        $c = curl_init();
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($c, CURLOPT_TIMEOUT, 4);
        curl_setopt($c, CURLOPT_URL, 'http://music.163.com/api/playlist/detail?id=2884035');
        $ik163 = json_decode(curl_exec($c), 1);
        curl_close($c);
        if ($ik163['code'] == 200) {
            ob_start();
            foreach ($ik163['result']['tracks'] as $ik1631) {
                echo strtolower(rtrim($ik1631['name']))."\n";
            }
            $ik1630 = ob_get_contents();
            ob_end_clean();
            file_put_contents($shl163, $ik1630, LOCK_EX);
        }
        else {
            touch($shl163);
        }
        // 搜狗热搜榜
        $c = curl_init();
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($c, CURLOPT_TIMEOUT, 4);
        curl_setopt($c, CURLOPT_URL, 'http://changyan.sohu.com/api/3/topic/sogou_hotword');
        $iksogou = json_decode(curl_exec($c), 1);
        curl_close($c);
        if (isset($iksogou['sogou_hot_words'][0])) {
            ob_start();
            foreach ($iksogou['sogou_hot_words'] as $iksogou1) {
                echo strtolower($iksogou1)."\n";
            }
            $iksogou0 = ob_get_contents();
            ob_end_clean();
            file_put_contents($shlsogou, $iksogou0, LOCK_EX);
        }
        else {
            touch($shlsogou);
        }
        // 豆瓣最新电影
        $c = curl_init();
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 8);
        curl_setopt($c, CURLOPT_TIMEOUT, 8);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_URL, 'https://movie.douban.com/j/search_subjects?type=movie&tag=%E6%9C%80%E6%96%B0&page_limit=500');
        $ikdouban = json_decode(curl_exec($c), 1);
        curl_close($c);
        if (isset($ikdouban['subjects'][0]['rate'])) {
            ob_start();
            foreach ($ikdouban['subjects'] as $ikdouban1) {
                echo strtolower(rtrim($ikdouban1['title']))."\n";
            }
            $ikdouban0 = ob_get_contents();
            ob_end_clean();
            file_put_contents($shldouban, $ikdouban0, LOCK_EX);
        }
        else {
            touch($shldouban);
        }
    }
    if (!file_exists($st1.$c2) && (file_exists($shlbaidu) || file_exists($shl163) || file_exists($shlsogou) || file_exists($shldouban))) {
        file_put_contents($st1.$c2, '', LOCK_EX);
    }
    $slsbaidu = file_get_contents($shlbaidu);
    $sls163 = file_get_contents($shl163);
    $slssogou = file_get_contents($shlsogou);
    $slsdouban = file_get_contents($shldouban);
    $sls0 = $slsbaidu.$sls163.$slssogou.$slsdouban;
    $sls = explode("\n", $sls0);
    array_pop($sls);
    if (strlen($sls[0]) > 0) {
        echo '    <table>
        <tbody class="back-yellow">';
        shuffle($sls);
        foreach ($sls as $i => $v) {
            if ($i % 3 == 0) {
                echo '<tr>';
            }
            echo '
            <td><a itemprop="url" href="'.$u.$l.preg_replace('/(\s+)/', '%20', $sls[$i]).'" target="_blank">'.$sls[$i].'</a></td>';
            $i++;
            if ($i % 3 == 0) {
                echo '
            </tr>';
            }
            if ($i > 38) {
                break;
            }
        }
        if ($i % 3 == 1) {
            echo '
            <td></td>
            <td></td>
            </tr>';
        }
        elseif ($i % 3 == 2) {
            echo '
            <td></td>
            </tr>';
        }
        echo '</tbody>
    </table>';
    }
    echo '
        <hr>
        <p>';
    foreach ($fl as $i => $v) {
        echo '<a href="'.$fl[$i][0].'" target="_blank" itemprop="url">'.$fl[$i][1].'</a>&nbsp;&nbsp;';
    }
    echo '</p>';
    echo '
    </div>
';
}

if (strlen($s) > 0) {
    $oas = @$_GET['oas'];
    $osp = @$_GET['osp']; $oec = @$_GET['oec'];
    $osr = @$_GET['osr'];
    $oab = @$_GET['oab'];
    $of = @$_GET['of'];
    $os = @$_GET['os'];
    $pr = @$_GET['pr'];
    $oal = @$_GET['oal'];

    if ($pr == 'on') {
        $baidu = 'http://www.baidu.com/s?sort=pagerank&wd=';
    }
    else {
        $baidu = 'http://www.baidu.com/s?wd=';
    }
    $cpn = '&pn=';
    $crn = '&rn=';
    if (strlen($pn) > 0) {
        if (strlen($rn) > 0) {
            $c = curl_init();
            curl_setopt($c, CURLOPT_HEADER, 0);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 1);
            curl_setopt($c, CURLOPT_TIMEOUT, 4);
            curl_setopt($c, CURLOPT_PROXY, @$px[0]);
            curl_setopt($c, CURLOPT_URL, $baidu.$q.$cpn.$pn.$crn.$rn);
            $se = curl_exec($c);
            curl_close($c);
        }
        else {
            $c = curl_init();
            curl_setopt($c, CURLOPT_HEADER, 0);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 1);
            curl_setopt($c, CURLOPT_TIMEOUT, 4);
            curl_setopt($c, CURLOPT_PROXY, @$px[0]);
            curl_setopt($c, CURLOPT_URL, $baidu.$q.$cpn.$pn);
            $se = curl_exec($c);
            curl_close($c);
        }
    }
    elseif (strlen($rn) > 0) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($c, CURLOPT_TIMEOUT, 4);
        curl_setopt($c, CURLOPT_PROXY, @$px[0]);
        curl_setopt($c, CURLOPT_URL, $baidu.$q.$crn.$rn);
        $se = curl_exec($c);
        curl_close($c);
    }
    else {
        $c = curl_init();
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($c, CURLOPT_TIMEOUT, 4);
        curl_setopt($c, CURLOPT_PROXY, @$px[0]);
        curl_setopt($c, CURLOPT_URL, $baidu.$q);
        $se = curl_exec($c);
        curl_close($c);
    }

    if (strlen($ws) > 0 && !isset($bk['card']) && @$pn == null && @$rn == null) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($c, CURLOPT_TIMEOUT, 2);
        curl_setopt($c, CURLOPT_URL, 'http://www.baidu.com/s?wd='.$q.$si);
        $wse = json_decode(curl_exec($c), 1);
        curl_close($c);
    }

    if (preg_match('/(?<=百度为您找到相关结果约)([0-9,]{1,11})(?=个<\/div>)/', @$se, $mn));

    if (@$pn == null && @$rn == null) {
        echo '    <div class="white break center">
        <h1 itemprop="name">'.htmlspecialchars($z, ENT_QUOTES).'</h1>
        <span title="2字节&lt;标题长度&lt;64字节">'.date('Y-m-d H:i', time()).'</span>
    </div>';
    }
    else {
        echo '    <div class="white break center">
        <h1 itemprop="name"><a class="noa" href="'.$u.$l.$q.'">'.htmlspecialchars($z, ENT_QUOTES).'</a></h1>
        '.date('Y-m-d H:i', time()).'
    </div>';
    }

    if ($cp == 1 && !file_exists($ist.md5($q).'.jpg')) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($c, CURLOPT_TIMEOUT, 1);
        curl_setopt($c, CURLOPT_PROXY, @$px[1]);
        curl_setopt($c, CURLOPT_URL, 'http://image.baidu.com/search/acjson?tn=resultjson&ipn&rn=3&wd='.$q);
        $cpc = json_decode(curl_exec($c), 1);
        curl_close($c);
        $pic = @$cpc['data'][0]['objURL'];
        $pic2 = @$cpc['data'][1]['objURL'];
        $pic3 = @$cpc['data'][2]['objURL'];
    }

    if (isset($bk['card']) && @$pn == null && @$rn == null) {
        echo '
    <blockquote class="soft mb break">';
        foreach ($bk['card'] as $i => $v) {
            echo strip_tags($bk['card'][$i]['name']).' '.strip_tags($bk['card'][$i]['value'][0]).'<br>';
        }
        if (strlen(@$bk['abstract']) > 0) {
            echo $bk['abstract'].'&nbsp;<a class="noa" href="'.$bk['url'].'"'.$nof.'更多</a>';
        }
        echo '</blockquote>';
    }
    $scp = array('/(\s+)/', '/(&)/');
    $scr = array('+', '%26');
    if ($cp == 1) {
        if (@$cpc['displayNum'] > 0 || file_exists($ist.md5($q).'.jpg')) {
            if (!file_exists($ist)) {
                mkdir($ist, 0755);
            }
            if (preg_match('/(\.png)/is', @$pic) == true) {
                $g = str_replace('./', '', $ist).md5($q).'.png';
            }
            elseif (preg_match('/(\.gif)/is', @$pic) == true) {
                $g = str_replace('./', '', $ist).md5($q).'.gif';
            }
            else {
                $g = str_replace('./', '', $ist).md5($q).'.jpg';
            }
            if (!file_exists($g)) {
                $c=curl_init();
                $dir1 = pathinfo($pic);
                $host = $dir1['dirname'];
                $refer = $host.'/';
                curl_setopt($c, CURLOPT_REFERER, $refer);
                curl_setopt($c, CURLOPT_URL, $pic);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 3);
                curl_setopt($c, CURLOPT_TIMEOUT, 6);
                curl_setopt($c, CURLOPT_PROXY, @$px[2]);
                $o = curl_exec($c);
                curl_close($c);
                $w = @fopen($g,'a');
                fwrite($w, $o);
                fclose($w);
            }
            if (filesize($g) < 4771 || filesize($g) > 1048576) {
                unlink($g);
            }
            else {
                echo '
    <div class="center">
        <a href="//'.$_SERVER['HTTP_HOST'].$dir.$g.'" rel="nofollow" target="_blank"><img src="//'.$_SERVER['HTTP_HOST'].$dir.$g.'"  alt="'.$q.'"></a>
    </div>';
            }
        }
    }

    if (strlen(@$mn[0]) > 0 && @$pn == null && @$rn == null) {
        // 抓取今日头条
        $c = curl_init();
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($c, CURLOPT_TIMEOUT, 3);
        curl_setopt($c, CURLOPT_URL, 'http://cn.bing.com/search?q=%22'.urlencode($q).'%22+site%3Awww.toutiao.com');
        $tta = curl_exec($c);
        curl_close($c);
        if (strlen(@$tta) > 0) {
            preg_match('/(?<=class="b_attribution" u="\d\|\d{4}\|)(\d{15,17})\|(.{32})"><cite><strong>www.toutiao.com<\/strong>\/(?=a|i)/', $tta, $ttm);
            $c = curl_init();
            curl_setopt($c, CURLOPT_HEADER, 0);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 3);
            curl_setopt($c, CURLOPT_TIMEOUT, 3);
            curl_setopt($c, CURLOPT_URL, 'http://cncc.bingj.com/cache.aspx?d='.@$ttm[1].'&w='.@$ttm[2]);
            $tto = curl_exec($c);
            curl_close($c);
            preg_match_all('/(?<= opr-recommends-merge-item " data-click="{\'rsv_re_ename\':\')(.{1,99})(?=\',\'rsv_re_uri\':\')/', $se, $mzx);
            if (is_array($mzx)) {
                @$mpk = array_unique(array_merge(@$mzx[0], @$su[1], array('maas')));
            }
            if (strlen(@$tto) > 0) {
                $ttp = array('/(\s+)/', '/<p><\/p>/');
                $ttr = array('', '');
                preg_match('/(?<=201\d-\d{2}-\d{2}\d{2}:\d{2})(.+)(?=(<pclass="footnote">)|(<pclass="pgc-description">)|(相关标签：)|(投诉分享到：))/', preg_replace($ttp, $ttr, strip_tags($tto, '<p>')), $tte);
                @$ttf = explode('</p><p>', $tte[0], -1);
                if (strlen(@$tte[0]) > 0 && strpos($tte[0], '视频加载中...') === false) {
                    echo '<a id="back_article_header" rel="nofollow"></a>
    <h2 class="center bold soft mb" itemprop="name"><a class="noa" href="#article_end" rel="nofollow">'.$q.'&nbsp;相关文章</a></h2>
    <div class="soft break mb" style="padding:0 1em 0 1em;" itemprop="articleBody">
        ';
                    foreach ($ttf as $k => $v) {
                        foreach ($mpk as $ke => $v) {
                            $ccc = strpos($ttf[$k], $mpk[$ke]);
                            if ($ccc !== false) {
                                echo substr_replace($ttf[$k], '<a class="noa" href="'.$u.$l.$mpk[$ke].'" target="_blank">'.$mpk[$ke].'</a>', $ccc, strlen($mpk[$ke])).'</p>
        <p>';
                                unset($mpk[$ke]);
                                break;
                            }
                            elseif ($mpk[$ke] == 'maas') {
                                echo $ttf[$k].'</p>
        <p>';
                            }
                        }
                    }
                    echo '</p>
        <p style="text-align:right">小编&nbsp;赵彤</p>
    </div>';
                }
            }
        }
    }
    $mp = array('/(\s+)/', '/(&)/');
    $mr = array('+', '%26');

    if (strlen(@$mn[0]) > 0 && $oal != 'on') {
        if (preg_match('/(?<=<p>很抱歉，没有找到与<span style="font-family:宋体">“<\/span><em>)(.+)(?=<\/em><span style="font-family:宋体">”<\/span>相关的网页。<\/p>)/', @$se, $mno)) {
            echo '
<p><a class="noa" href="//'.$mno[1].'" title="直接访问&nbsp;'.@$mno[2].'"'.$nof.'很抱歉，没有找到与“<span class="red">'.$mno[1].'</span>”相关的网页。</a></p>
<p class="white">如网页存在，请<a class="noa" href="//zhanzhang.baidu.com/linksubmit/url?sitename=http%3A%2F%2F'.$mno[1].'" title="您可以提交想被百度收录的url"'.$nof.'提交网址</a>给我们</p>';
        }

        if (preg_match('/(?<=<font class="c-gray">没有找到该URL。您可以直接访问&nbsp;<\/font><a href=")(.+)(?=" target="_blank" onmousedown)/', @$se, $mno2)) {
            echo '
<p class="white break">没有找到该URL。您可以直接访问&nbsp;<span class="red"><a class="noa" href="'.$mno2[1].'"'.$nof.$mno2[1].'</a></span>，还可<a class="noa" href="//zhanzhang.baidu.com/sitesubmit/index?sitename='.$mno2[1].'" title="您可以提交想被百度收录的url"'.$nof.'提交网址</a>给我们。</p>';
        }
    }

    if (@$mn[0] != 0) {
        if ($cp == 1) {
            if (@$cpc['displayNum'] > 0 || file_exists($ist.md5($q).'2.jpg')) {
                if (!file_exists($ist)) {
                mkdir($ist, 0755);
                }
                if (preg_match('/(\.png)/is', @$pic2) == true) {
                    $g2 = str_replace('./', '', $ist).md5($q).'2.png';
                }
                elseif (preg_match('/(\.gif)/is', @$pic2) == true) {
                    $g2 = str_replace('./', '', $ist).md5($q).'2.gif';
                }
                else {
                    $g2 = str_replace('./', '', $ist).md5($q).'2.jpg';
                }
                if (!file_exists($g2)) {
                    $c=curl_init();
                    $dir2 = pathinfo($pic2);
                    $host2 = $dir2['dirname'];
                    $refer2 = $host2.'/';
                    curl_setopt($c, CURLOPT_REFERER, $refer2);
                    curl_setopt($c, CURLOPT_URL, $pic2);
                    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 3);
                    curl_setopt($c, CURLOPT_TIMEOUT, 4);
                    curl_setopt($c, CURLOPT_PROXY, @$px[5]);
                    $o2 = curl_exec($c);
                    curl_close($c);
                    $w2 = @fopen($g2,'a');
                    fwrite($w2, $o2);
                    fclose($w2);
                }
                if (filesize($g2) < 4771 || filesize($g2) > 1048576) {
                    unlink($g2);
                }
                else {
                    echo '
    <div class="center mb soft">
        <a href="//'.$_SERVER['HTTP_HOST'].$dir.$g2.'" rel="nofollow" target="_blank"><img src="//'.$_SERVER['HTTP_HOST'].$dir.$g2.'"  alt="'.$q.'"></a>
    </div>';
                }
            }
        }

        if ($oas == 'on' || ($oas != 'on' && $osp != 'on' && $oec != 'on')) {
            if (preg_match_all("/(?<=\" data\-tools=\'{\"title\":\")([^\"]+)(\",\"url\":\"http:)(\/\/www.baidu.com\/link\?url=[a-zA-Z0-9_\-]{43,640})(?=\"}'><a class=\"c-tip-icon\"><i class=\"c-icon c-icon-triangle-down-g\"><\/i><\/a><\/div>)/", @$se, $mse)) {
                if ($oab != 'on' && @$pn == null && @$rn == null) {
                    if (preg_match_all('/(?<=<div class="c-abstract)( c-abstract-en)*(">)(.*)(?=<\/div><div class="f13">)/', $se, $mabs));
                }
                if (preg_match_all('/(?<=<div class="result c-container)( ?" id=")(\d{1,3})(" srcid=")(15\d{2})(" tpl=")(\w{2,28})(?=" ( ?)data-click="{)/', $se, $msr)) {
                    foreach ($msr[2] as $i => $v) {
                        $nsr[$i] = array($msr[4][$i], @$mse[1][$i], $msr[2][$i], $mse[3][$i], $msr[6][$i]);
                    }
                }
            }
        }

        if ($osp == 'on' || ($oas != 'on' && $osp != 'on' && $oec != 'on')) {
            if (preg_match_all('/(?<="  srcid=")(\d{1,5})("  fk=")([\d_]{0,6}?)([^_]{1,64})(" id=")(\d{1,2})(" tpl=")(\w{2,28})(" mu=")(.+)(?=" data-op="{\'y\':\'[a-zA-Z0-9]{8}\'}")/', @$se, $fk)) {
                foreach ($fk[6] as $i => $v) {
                    $nfk[$i] = array($fk[1][$i], $fk[4][$i], $fk[6][$i], $fk[10][$i], $fk[8][$i]);
                }
            }
        }

        if (preg_match_all('/(?<="  srcid=")(\d{1,5})("  id=")(\d{1,2})(" tpl=")(\w{2,28})(" mu=")(.+)(?=" data-op="{\'y\':\'[a-zA-Z0-9]{8}\'}")/', @$se, $msp)) {
            foreach ($msp[3] as $i => $v) {
                $nsp[$i] = array($msp[1][$i], '', $msp[3][$i], $msp[7][$i], $msp[5][$i]);
            }
        }

        if (strlen(@$nsr[0][0]) > 0) {
            if (strlen(@$nfk[0][0]) > 0) {
                if (strlen(@$nsp[0][0]) > 0) {
                    $n = array_merge($nsr, $nfk, $nsp);
                }
                else {
                    $n = array_merge($nsr, $nfk);
                }
            }
            elseif (strlen(@$nsp[0][0]) > 0) {
                $n = array_merge($nsr, $nsp);
            }
            else {
                $n = array_merge($nsr);
            }
        }
        elseif (strlen(@$nfk[0][0]) > 0) {
            if (strlen(@$nsp[0][0]) > 0) {
                $n = array_merge($nfk, $nsp);
            }
            else {
                $n = array_merge($nfk);
            }
        }
        elseif (strlen(@$nsp[0][0]) > 0) {
            $n = array_merge($nsp);
        }
        else
            $n = '';

        if ($n != '') {
            foreach ($n as $i => $v) {
                $i2[$i] = $v[2];
            }
            array_multisort($i2, $n);
        }

        if (@$mn[0] != 0 && $osr != 'on') {
            echo '
    <div>
        <table>
            <thead><tr>
                <th title="'.$mn[0].' 条结果" class="topr">';
            echo '以下内容已过滤百度推广';
            echo '</th>
            </tr></thead>
            <tbody class="break">';

            if (strlen($ws) > 0 && !isset($bk['card']) && @$pn == null && @$rn == null) {
                if (strlen(@$wse['feed']['entry'][0]['url']) > 0) {
                    foreach ($wse['feed']['entry'] as $i => $v) {
                        if (isset($wse['feed']['entry'][$i]['url'])) {
                            echo '
                <tr class="back-white">
                    <td><a itemprop="url" href="'.$wse['feed']['entry'][$i]['url'].'" target="_blank">'.str_replace($pp, $rp, $wse['feed']['entry'][$i]['title']).'</a><br><span class="tiny">'.str_replace($pp, $rp, $wse['feed']['entry'][$i]['abs']).'</span></td>
                </tr>';
                        }
                    }
                }
            }

            $rr = array(' ', '');
            $qn = htmlspecialchars(str_replace($pp, $rp, strtolower(preg_replace($p, $rr, $s))));
$src=array(array(29542,$qn.'&nbsp;综合采购&nbsp;百度商贸','','','ec'),array(29541,$qn.'&nbsp;加盟服务&nbsp;百度商贸','','','ec'),array(29540,$qn.'&nbsp;商贸服务&nbsp;百度商贸','','','ec'),array(29521,$qn.'&nbsp;机构大全&nbsp;婚纱摄影&nbsp;百度婚庆','','','ec'),array(29520,$qn.'&nbsp;婚礼策划&nbsp;百度婚庆','','','ec'),array(29490,$qn.'&nbsp;百度生活圈','','','ec'),array(29405,$qn.'&nbsp;跟谁学','','','ec'),array(29402,$qn.'&nbsp;考试资讯&nbsp;百度教育','','','ec'),array(29311,$qn.'&nbsp;品牌特卖&nbsp;百度特卖','','','ec'),array(29309,$qn.'&nbsp;创业加盟&nbsp;百度商贸','','','ec'),array(29308,$qn.'&nbsp;综合采购&nbsp;百度商贸','','','ec'),array(29307,$qn.'&nbsp;婚宴酒店&nbsp;百度婚庆','','','ec'),array(29302,$qn.'&nbsp;作品欣赏&nbsp;婚纱摄影&nbsp;机构大全&nbsp;百度婚庆','','','ec'),array(29301,$qn.'&nbsp;婚纱摄影&nbsp;机构大全&nbsp;百度婚庆','','','ec'),array(29283,$qn.'&nbsp;知识图片&nbsp;百度健康','','','ec'),array(29279,$qn.'&nbsp;精选问答合集&nbsp;百度健康','','','ec'),array(29278,$qn.'&nbsp;问答列表&nbsp;百度健康','','','ec'),array(29276,$qn.'&nbsp;病症&nbsp;百度健康','','','ec'),array(29275,$qn.'&nbsp;向医生提问&nbsp;百度健康','','','ec'),array(29271,$qn.'&nbsp;优质医院&nbsp;百度健康','','','ec'),array(29266,'向医生提问&nbsp;'.$qn.'&nbsp;百度知道','','','ec'),array(29265,$qn.'&nbsp;美容整形&nbsp;百度健康','','','ec'),array(29261,$qn.'&nbsp;问答&nbsp;百度健康','','','ec'),array(29260,$qn.'&nbsp;是非&nbsp;问答&nbsp;百度健康','','','ec'),array(29257,$qn.'&nbsp;美容整形&nbsp;百度健康','','','ec'),array(29256,'饮食保健知识&nbsp;百度健康','','','ec'),array(29253,'问答&nbsp;百度健康','','','ec'),array(29250,'十二星座健康运势&nbsp;百度健康','','','ec'),array(29228,$qn.'&nbsp;百度品牌特卖','','','ec'),array(29207,$qn.'&nbsp;高考&nbsp;百度教育','','','ec'),array(29205,'高等教育自学考试&nbsp;百度教育','','','ec'),array(29204,'考试&nbsp;百度教育','','','ec'),array(29203,$qn.'&nbsp;留学机构&nbsp;留学&nbsp;百度教育','','','ec'),array(29201,$qn.'&nbsp;报名&nbsp;百度教育','','','ec'),array(29200,$qn.'&nbsp;考试&nbsp;百度教育','','','ec'),array(29195,$qn.'&nbsp保险;&nbsp;百度财富','','','ec'),array(29194,$qn.'&nbsp保险知识&nbsp;保险&nbsp;百度财富','','','ec'),array(29192,$qn.'&nbsp贷款知识&nbsp;贷款&nbsp;百度财富','','','ec'),array(29189,$qn.'&nbsp;网上开户&nbsp;百度财富','','','ec'),array(29185,$qn.'&nbsp;信用卡&nbsp;百度财富','','','ec'),array(29183,$qn.'&nbsp;车险&nbsp;百度财富','','','ec'),array(29182,$qn.'&nbsp;小额贷款&nbsp;百度财富','','','ec'),array(29181,$qn.'&nbsp;产品大全&nbsp;百度财富','','','ec'),array(29180,$qn.'&nbsp;意外险&nbsp;百度财富','','','ec'),array(29169,$qn.'&nbsp;页游&nbsp;排行榜&nbsp;百度爱玩','','','ec'),array(29166,$qn.'&nbsp;页游&nbsp;开始游戏&nbsp;百度爱玩','','','ec'),array(29164,$qn.'&nbsp;官网&nbsp;百度爱玩','','','ec'),array(29163,$qn.'&nbsp;新专区&nbsp;百度爱玩','','','ec'),array(29159,$qn.'&nbsp;礼包&nbsp;网游&nbsp;百度爱玩','','','ec'),array(29158,$qn.'&nbsp;直播&nbsp;网游&nbsp;百度爱玩','','','ec'),array(29154,$qn.'&nbsp;单机游戏&nbsp;百度爱玩','','','ec'),array(29153,'手游&nbsp;百度爱玩','','','ec'),array(29152,'游戏专区&nbsp;17173','','','ec'),array(29146,$qn.'&nbsp;新车特惠&nbsp;百度汽车','','','ec'),array(29145,$qn.'&nbsp;本地最新报价信息搜索&nbsp;百度汽车','','','ec'),array(29144,$qn.'&nbsp;估价卖车&nbsp;百度汽车','','','ec'),array(29142,$qn.'&nbsp;二手车搜索&nbsp;百度汽车','','','ec'),array(29141,$qn.'&nbsp;精准&nbsp;二手车搜索&nbsp;百度汽车','','','ec'),array(29140,'二手车&nbsp;百度汽车','','','ec'),array(29134,'单机游戏&nbsp;百度爱玩','','','ec'),array(29129,'开始游戏&nbsp;百度爱玩','','','ec'),array(29127,$qn.'&nbsp;专区&nbsp;百度爱玩','','','ec'),array(29121,'chinajoy&nbsp;百度爱玩','','','ec'),array(29120,'热门网页游戏平台&nbsp;百度爱玩','','','ec'),array(29118,'百度品牌特卖','','','ec'),array(29116,$qn.'&nbsp;百度品牌特卖','','','ec'),array(29115,'百度品牌特卖','','','ec'),array(29114,$qn.'&nbsp;百度品牌特卖','','','ec'),array(29099,'百度教育考试','','','ec'),array(29097,$qn.'&nbsp;流程攻略&nbsp;留学&nbsp;百度教育','','','ec'),array(29096,'留学图片资讯&nbsp;百度教育','','','ec'),array(29094,$qn.'&nbsp;找课程&nbsp;百度教育','','','ec'),array(29093,'机构&nbsp;百度教育','','','ec'),array(29090,'课程&nbsp;百度教育','','','ec'),array(29089,$qn.'&nbsp;混合&nbsp;百度健康','','','ec'),array(29088,$qn.'&nbsp;混合&nbsp;百度健康','','','ec'),array(29087,$qn.'&nbsp;知识&nbsp;图片&nbsp;百度健康','','','ec'),array(29085,$qn.'&nbsp;检查&nbsp;图片&nbsp;百度健康','','','ec'),array(29083,'药品频道&nbsp;寻医问药网&nbsp;百度健康','','','ec'),array(29081,'手术&nbsp;百度健康','','','ec'),array(29080,$qn.'&nbsp;知识图片&nbsp;百度健康','','','ec'),array(29075,$qn.'&nbsp;棋牌&nbsp;百度爱玩','','','ec'),array(29070,$qn.'网页游戏大全&nbsp;百度爱玩','','rsv_height:1033, rsv_width:538','ec'),array(29051,$qn.'&nbsp;百度微购','','','ec'),array(29020,$qn.'&nbsp;百度值得买','','','ec'),array(29012,$qn.'&nbsp;百度家装','','','ec'),array(29010,$qn.'&nbsp;家装&nbsp;百度微购','','','ec'),array(28299,'知识图谱','','','ec'),array(28273,$qn.'&nbsp;知识图谱&nbsp;百度百科','','','ec'),array(28267,$qn.'&nbsp;知识图谱&nbsp;百度百科','','','ec'),array(28242,$qn.'&nbsp;数学公式&nbsp;知识图谱&nbsp;百度百科','','','ec'),array(28232,$qn.'&nbsp;知识图谱&nbsp;百度词典','','','ec'),array(28226,$qn.'&nbsp;明星&nbsp;知识图谱','','','ec'),array(28225,$qn.'&nbsp;中国GDP图表&nbsp;知识图谱','','','ec'),array(28223,$qn.'&nbsp;知识图谱&nbsp;百度对比','','','ec'),array(28222,$qn.'&nbsp;口腔病防治院服务时间&nbsp;知识图谱','','','ec'),array(28218,'知识图谱&nbsp;百度旅游','','','ec'),array(28217,'详细&nbsp;知识图谱','','','ec'),array(28215,$qn.'&nbsp;知识图谱&nbsp;豆瓣电影','','','ec'),array(28213,$qn.'&nbsp;知识图谱&nbsp;百度百科','','','ec'),array(28208,$qn.'&nbsp;知识图谱&nbsp;百度网页搜索','','','ec'),array(28207,$qn.'&nbsp;知识图谱&nbsp;百度网页搜索','','','ec'),array(28206,$qn.'&nbsp;计量数据&nbsp;知识图谱','','','ec'),array(28204,$qn.'&nbsp;详细&nbsp;知识图谱&nbsp;百度词典','','','ec'),array(28203,$qn.'&nbsp;知识图谱&nbsp;百度百科','','','ec'),array(28202,$qn.'&nbsp;美食&nbsp;知识图谱&nbsp;香哈','','','ec'),array(28110,$qn.'&nbsp;歌曲&nbsp;百度音乐','','','ec'),array(28093,'去哪儿网门票频道','','','ec'),array(28092,'去哪儿网门票频道','','','ec'),array(28072,'去哪儿网酒店预定查询频道','','','ec'),array(28057,'去哪儿度假频道','','','ec'),array(28056,'[猜]&nbsp;去哪儿度假频道','','','ec'),array(28054,'机票查询&nbsp;去哪儿','','','ec'),array(28050,$qn.'&nbsp;疾病&nbsp;百度知道','','','ec'),array(28044,$qn.'&nbsp;攻略&nbsp;海外&nbsp;百度旅游','','','ec'),array(28043,$qn.'&nbsp;海外&nbsp;百度旅游','','','ec'),array(28042,'景点介绍&nbsp;第&nbsp;2&nbsp;版&nbsp;百度旅游','','','ec'),array(28041,'地图&nbsp;第&nbsp;2&nbsp;版&nbsp;百度旅游','','','ec'),array(28040,'景点介绍&nbsp;第&nbsp;2&nbsp;版&nbsp;百度旅游','','','ec'),array(28030,$qn.'&nbsp;酒店&nbsp;百度糯米','','','ec'),array(28029,$qn.'&nbsp;团购&nbsp;百度糯米','','','ec'),array(28027,$qn.'&nbsp;团购&nbsp;百度糯米','','','ec'),array(28026,'团购&nbsp;百度糯米','','','ec'),array(28025,'团购&nbsp;百度糯米','','','ec'),array(28023,$qn.'&nbsp;百度地图','','','ec'),array(28022,$qn.'&nbsp;百度地图','','','ec'),array(28010,'百度地图&nbsp;城市','','','ec'),array(28002,'百度地图','','','ec'),array(27999,$qn.'&nbsp;优先级高于推广链接&nbsp;百度百科','','','ec'),array(27997,$qn.'&nbsp;优先级高于推广链接&nbsp;百度知道','','','ec'),array(27994,$qn.'&nbsp;【企业问答】','','','ec'),array(27900,$qn.'&nbsp;品牌推广','','','ec'),array(27037,'旅游路线&nbsp;携程','','','ec'),array(27033,'酒店&nbsp;携程','','','ec'),array(27024,'经销商&nbsp;汽车之家','','','ec'),array(27023,'搜索&nbsp;寺库','','','ec'),array(27019,$qn.'&nbsp;汽车之家','','','ec'),array(27018,$qn.'&nbsp;车系&nbsp;汽车之家','','','ec'),array(27012,$qn.'&nbsp;数码&nbsp;中关村在线','','','ec'),array(27008,$qn.'&nbsp;优信二手车','','','ec'),array(27007,$qn.'&nbsp;电视之家','','','ec'),array(27003,$qn.'&nbsp;旅游攻略&nbsp;蚂蜂窝','','','ec'),array(27002,$qn.'&nbsp;携程攻略','','','ec'),array(26362,'2016苹果春季新品发布会&nbsp;聚合实时热点新闻','','','sp'),array(23073,'&nbsp;下载之家','','','sp'),array(22251,'&nbsp;下载之家','','','sp'),array(21093,'大家都在搜&nbsp;权威性答案','','','sp'),array(21018,'电影&nbsp;百度视频','','','sp'),array(20970,'链接-赞&nbsp;豆瓣影评','','','sp'),array(20843,'赞-链接&nbsp;豆瓣影评','','','sp'),array(20842,'链接-赞&nbsp;列表&nbsp;豆瓣影评','','','sp'),array(20840,'报价|图片|参数配置|口碑&nbsp;汽车之家','','','sp'),array(20776,'[猜]&nbsp;百度百科','','','sp'),array(20712,'用户口碑&nbsp;百度知道','','','sp'),array(20679,'余额宝相关问题&nbsp;支付宝个人帮助中心','','','sp'),array(20631,'教育考试&nbsp;百度知心文库','','','sp'),array(20569,'目的地推荐&nbsp;百度旅游','','','sp'),array(20548,'系列&nbsp;百度视频','','','sp'),array(20546,'分集剧情&nbsp;电视猫','','','sp'),array(20544,'知心&nbsp;百度音乐','','','sp'),array(20543,'全部歌曲&nbsp;百度音乐','','','sp'),array(20535,'火车票购票日历','','','sp'),array(20528,'电视剧情介绍&nbsp;电视猫','','','sp'),array(20527,'百度左侧知心同系列电影&nbsp;百度视频','','','sp'),array(20499,'电视剧&nbsp;百度视频','','','sp'),array(20458,'官方微博(原知心左侧卡片框)','','','sp'),array(20457,'电视剧&nbsp;百度视频','','','sp'),array(20451,'分集剧情&nbsp;电视猫','','','sp'),array(20426,'新浪官微&nbsp;[1－10]','','','sp'),array(20423,'百度知道&nbsp;医疗健康','','','sp'),array(20422,'百度拇指医生','','','sp'),array(20408,'百度百科(由国家卫生计生委临床医生科普项目/百科名医网提供内容并参与编辑)','','','sp'),array(20407,'百度百科(由国家卫生计生委临床医生科普平台/百科名医网提供内容并参与编辑)','','','sp'),array(20406,'百度视频','','','sp'),array(20387,'易车网','','','sp'),array(20376,'百度百科&nbsp;汽车之家阿拉丁','','','sp'),array(20375,'官网&nbsp;汽车之家阿拉丁','','','sp'),array(20324,'百度百科(原知心左侧卡片框)','','','sp'),array(20323,'百度图片(原知心左侧卡片框)','','','sp'),array(20322,'百度音乐(原知心左侧卡片框)','','','sp'),array(20321,'百度视频(原知心左侧卡片框)','','','sp'),array(20319,'百度贴吧(原知心左侧卡片框)','','','sp'),array(20315,'付费观看&nbsp;百度视频','','','sp'),array(20294,'[猜]&nbsp;热映电影&nbsp;百度视频&nbsp;-&nbsp;百度左侧知心结果','','','sp'),array(20289,'知乎','','','sp'),array(20281,'挂号网&nbsp;[1－10]','','','sp'),array(20172,'知心旅游介绍&nbsp;百度旅游','','','sp'),array(20135,'topik&nbsp;网上报名','','','sp'),array(20124,'百度左侧知心视频电视剧','','','sp'),array(20080,'北京市预约挂号统一平台','','','sp'),array(20071,'医院科室&nbsp;好大夫在线','','','sp'),array(20070,'挂号网','','','sp'),array(20006,'医院官网','','','sp'),array(20005,'医院科室&nbsp;好大夫在线','','','sp'),array(19999,'景点&nbsp;蚂蜂窝','','','sp'),array(19997,'走势图&nbsp;基金行情&nbsp;好买基金网','','','sp'),array(19994,'18183手机库','','','sp'),array(19979,'政府官网','','','sp'),array(19965,'英国&nbsp;学校广场&nbsp;51offer','','','sp'),array(19964,'澳洲&nbsp;学校广场&nbsp;51offer','','','sp'),array(19961,'51offer','','','sp'),array(19948,'实时行情&nbsp;好买基金网','','','sp'),array(19912,'新氧美容整形','','','sp'),array(19895,'实时行情&nbsp;好买财富网','','','sp'),array(19870,'就搜服','','','sp'),array(19869,'88A','','','sp'),array(19867,'我爱搜服网','','','sp'),array(19866,'多搜服','','','sp'),array(19857,'开区网','','','sp'),array(19851,'故事列表&nbsp;百度教育','','','sp'),array(19837,'九九搜服','','','sp'),array(19835,'热点话题','','','sp'),array(19825,'基金实时行情&nbsp;好买财富网','','','sp'),array(19817,'系统之家','','','sp'),array(19806,'奇兔ROOT','','','sp'),array(19792,'伊秀美容','','','sp'),array(19791,'伊秀美体网','','','sp'),array(19790,'伊秀服饰网','','','sp'),array(19789,'伊秀情感网','','','sp'),array(19788,'伊秀娱乐网','','','sp'),array(19787,'伊秀生活网','','','sp'),array(19786,'亲子&nbsp;伊秀生活网','','','sp'),array(19761,'逗游','','','sp'),array(19759,'攻略&nbsp;11773手游网','','','sp'),array(19746,'育儿网','','','sp'),array(19708,'途牛旅游论坛','','','sp'),array(19703,'爱卡汽车','','','sp'),array(19696,'北京地铁票价查询','','','sp'),array(19692,'找法网','','','sp'),array(19687,'ZOL产品报价&nbsp;中关村在线','','','sp'),array(19677,'下载之家','','','sp'),array(19674,'乐途旅游','','','sp'),array(19666,'中大网校','','','sp'),array(19633,'17K小说网','','','sp'),array(19596,'hao123下载','','','sp'),array(19592,'车辆违章查询&nbsp;本地宝','','','sp'),array(19590,'全国百姓网','','','sp'),array(19570,'开区网','','','sp'),array(19568,'系统屋','','','sp'),array(19558,'杭州公积金查询&nbsp;百度知心','','','sp'),array(19532,'装软件&nbsp;hao123下载站','','','sp'),array(19530,'基金实时行情&nbsp;好买基金网','','','sp'),array(19527,'装软件&nbsp;hao123下载站','','','sp'),array(19502,'蚂蜂窝','','','sp'),array(19473,'Q友乐园','','','sp'),array(19472,'网名&nbsp;Q友乐园','','','sp'),array(19467,'开区网','','','sp'),array(19453,'游戏攻略&nbsp;不凡游戏专区','','','sp'),array(19451,'游戏名字&nbsp;不凡游戏专区','','','sp'),array(19436,'阶段&nbsp;芒果TV','','','sp'),array(19435,'芒果TV','','','sp'),array(19412,'百度知心','','','sp'),array(19385,'经销商&nbsp;汽车之家','','','sp'),array(19376,'明确答案&nbsp;百度经验','','','sp'),array(19370,'网名','','','sp'),array(19337,'装软件&nbsp;hao123下载站','','','sp'),array(19334,'hao123下载站','','','sp'),array(19318,'携程去哪儿&nbsp;聚合实时热点新闻','','','sp'),array(19303,'543小游戏','','','sp'),array(19267,'走势图&nbsp;百度彩票','','','sp'),array(19256,'桌面百度','','','sp'),array(19255,'汽车之家','','','sp'),array(19254,'汽车之家','','','sp'),array(19214,'海外院校库&nbsp;留学&nbsp;百度教育','','','sp'),array(19203,'MBA中国网','','','sp'),array(19165,'公务员考试网','','','sp'),array(19164,'装软件&nbsp;hao123下载站','','','sp'),array(19160,'装软件&nbsp;hao123下载站','','','sp'),array(19159,'皇冠体育竞彩比分&nbsp;第一比分网','','','sp'),array(19155,'即时比分&nbsp;时时比分网','','','sp'),array(19132,'装软件&nbsp;hao123下载站','','','sp'),array(19094,'基金实时行情&nbsp;好买基金网','','','sp'),array(19093,'游戏攻略&nbsp;18183手机游戏网','','','sp'),array(19092,'百度房产','','','sp'),array(19082,'小米发布会&nbsp;聚合实时热点新闻','','','sp'),array(19081,'游戏攻略&nbsp;18183手机游戏网','','','sp'),array(19057,'百度开发者中心','','','sp'),array(19055,'故事列表&nbsp;儿童资源网','','','sp'),array(19052,'装软件&nbsp;hao123下载站','','','sp'),array(19031,'装软件&nbsp;hao123下载站','','','sp'),array(19023,'装软件&nbsp;hao123下载站','','','sp'),array(19006,'酒店&nbsp;蚂蜂窝','','','sp'),array(18964,'游戏专题&nbsp;游侠网','','','sp'),array(18948,'风行网','','','sp'),array(18947,'风行网','','','sp'),array(18946,'综艺&nbsp;风行网','','','sp'),array(18945,'动漫&nbsp;风行网','','','sp'),array(18944,'电竞&nbsp;风行网','','','sp'),array(18925,'开区网','','','sp'),array(18893,'开区网','','','sp'),array(18849,'易车网','','','sp'),array(18826,'就搜服','','','sp'),array(18808,'我爱搜服网','','','sp'),array(18807,'多搜服','','','sp'),array(18805,'途牛','','','sp'),array(18803,'88A','','','sp'),array(18801,'开区网','','','sp'),array(18759,'开区网','','','sp'),array(18732,'战斗力查询&nbsp;要我玩','','','sp'),array(18730,'百度阅读','','','sp'),array(18700,'奶粉口碑榜','','','sp'),array(18668,'汽车大全&nbsp;汽车点评','','','sp'),array(18666,'汽车点评','','','sp'),array(18661,'正佳养生网','','','sp'),array(18649,'易车二手车','','','sp'),array(18647,'NBA录像&nbsp;时时直播吧','','','sp'),array(18582,'公务员报名&nbsp;中公教育','','','sp'),array(18577,'【携程攻略】','','','sp'),array(18559,'游戏攻略&nbsp;11773手游网','','','sp'),array(18534,'hao123下载站','','','sp'),array(18532,'百山探索','','','sp'),array(18521,'慧聪网&nbsp;导购','','','sp'),array(18482,'竞彩258网','','','sp'),array(18478,'11773手游网','','','sp'),array(18458,'品牌&nbsp;汽车点评','','','sp'),array(18432,'多样化观点&nbsp;新&nbsp;百度知道','','','sp'),array(18404,'途牛','','','sp'),array(18402,'地图&nbsp;途牛','','','sp'),array(18379,'专区&nbsp;17173','','','sp'),array(18371,'hao123下载站','','','sp'),array(18386,'英超&nbsp;新浪体育','','','sp'),array(18380,'热门攻略&nbsp;笨手机','','','sp'),array(18308,'寻医问药网','','','sp'),array(18285,'pm2.5','','','sp'),array(18274,'游戏系列专题&nbsp;游侠网','','','sp'),array(18258,'91资讯','','','sp'),array(18255,'报考&nbsp;中公教育','','','sp'),array(18254,'九九搜服','','','sp'),array(18202,'QQ日志','','','sp'),array(18199,'hao123下载站','','','sp'),array(18198,'下载之家','','','sp'),array(18158,'景点门票&nbsp;驴妈妈旅游网','','','sp'),array(18143,'途牛旅游','','','sp'),array(18138,'电影院&nbsp;Mtime时光网','','','sp'),array(18122,'有问必答网','','','sp'),array(18064,'CNR中央人民广播电台','','','sp'),array(18059,'机器人巧答总理问&nbsp;聚合实时热点新闻','','','sp'),array(18041,'易车二手车','','','sp'),array(17989,'XP之家','','','sp'),array(17988,'读者宝','','','sp'),array(17915,'九九搜服','','','sp'),array(17914,'开区网','','','sp'),array(17868,'太平洋亲子网','','','sp'),array(17853,'故事&nbsp;六一儿童网','','','sp'),array(17795,'慧聪网','','','sp'),array(17868,'太平洋亲子网','','','sp'),array(17785,'招商加盟&nbsp;58同城','','','sp'),array(17766,'健康&nbsp;百度视频','','','sp'),array(17764,'看准网','','','sp'),array(17758,'范文&nbsp;列表&nbsp;百度教育','','','sp'),array(17753,'天极下载','','','sp'),array(17719,'天极时尚','','','sp'),array(17712,'结婚证办理&nbsp;百度知心','','','sp'),array(17706,'天极时尚','','','sp'),array(17703,'绿蚂蚁','','','sp'),array(17692,'驱动人生','','','sp'),array(17684,'淘整形&nbsp;悦美整形网','','','sp'),array(17637,'搜服网','','','sp'),array(17636,'网页游戏&nbsp;07073游戏网','','','sp'),array(17633,'77745网页游戏','','','sp'),array(17625,'话费充值&nbsp;百度钱包','','','sp'),array(17613,'公务员考试报考流程&nbsp;百度教育','','','sp'),array(17609,'开区网','','','sp'),array(17590,'华军软件园','','','sp'),array(17566,'英雄&nbsp;百度爱玩','','','sp'),array(17557,'系统乐园','','','sp'),array(17519,'全国长途汽车时刻表及汽车票价查询&nbsp;携程汽车','','','sp'),array(17518,'全国长途汽车时刻表及汽车票价查询&nbsp;携程汽车','','','sp'),array(17505,'九九搜服','','','sp'),array(17502,'购买推荐&nbsp;慧聪网','','','sp'),array(17493,'公务员报考&nbsp;百度教育','','','sp'),array(17432,'品牌排行榜&nbsp;天极产品库','','','sp'),array(17403,'美容&nbsp;YOKA时尚网','','','sp'),array(17358,'杀号&nbsp;网易彩票','','','sp'),array(17340,'法律快车网','','','sp'),array(17313,'症状库&nbsp;求医网','','','sp'),array(17312,'求医网','','','sp'),array(17306,'太平洋汽车网','','','sp'),array(17274,'游戏狗','','','sp'),array(17154,'齐家商城&nbsp;百齐搜','','百度收购','sp'),array(17153,'西西软件园','','','sp'),array(17086,'17173游戏视频','','','sp'),array(17064,'时间校准&nbsp;天气网','','','sp'),array(17046,'找医院&nbsp;求医网','','','sp'),array(17030,'古诗文网','','','sp'),array(17023,'选手&nbsp;综艺&nbsp;乐视网','','','sp'),array(16994,'范文&nbsp;百度教育','','','sp'),array(16982,'中国教育在线','','','sp'),array(16961,'职位&nbsp;百度招聘','','','sp'),array(16949,'中国教育在线','','','sp'),array(16932,'美食/营养&nbsp;百度经验【组图】','','','sp'),array(16890,'聚合&nbsp;百度百科','','','sp'),array(16865,'山东卫视&nbsp;[1－10]','','','sp'),array(16852,'[猜]&nbsp;腾讯科技','','','sp'),array(16847,'[猜]&nbsp;热点话题','','','sp'),array(16821,'[猜]&nbsp;体育直播&nbsp;新浪网','','','sp'),array(16809,'电视猫','','','sp'),array(16796,'综艺&nbsp;腾讯视频','','','sp'),array(16790,'美食美客&nbsp;爱奇艺','','','sp'),array(16786,'选择科室&nbsp;北京市预约挂号统一平台','','','sp'),array(16782,'北京市预约挂号统一平台','','','sp'),array(16780,'12306铁道部火车票网上订票唯一官网 铁路客户服务中心','','','sp'),array(16758,'悦美网&nbsp;子链&nbsp;缩略图','','','sp'),array(16756,'股票走势图&nbsp;天天基金网','','','sp'),array(16743,'软件下载&nbsp;中关村在线','','','sp'),array(16737,'百度软件中心','','','sp'),array(16728,'广场舞&nbsp;糖豆网','','','sp'),array(16724,'[猜]&nbsp;中国好系统','','','sp'),array(16689,'走势图表&nbsp;百度乐彩','','','sp'),array(16684,'天气预报&nbsp;中国天气网','','','sp'),array(16665,'美食&nbsp;权威性答案','','','sp'),array(16653,'女子拒搭讪被打死&nbsp;百度贴吧直播','','','sp'),array(16650,'hao123彩票','','','sp'),array(16641,'百度加速乐','','','sp'),array(16634,'蘑菇系统之家','','','sp'),array(16633,'系统吧','','','sp'),array(16620,'中国基金会网','','','sp'),array(16595,'QQ头像&nbsp;QQ个性网','','','sp'),array(16590,'开放式基金&nbsp;天天基金网','','','sp'),array(16583,'有缘网登录&nbsp;[1－10]','','','sp'),array(16579,'中国电视网','','','sp'),array(16578,'XP系统之家','','','sp'),array(16569,'人物介绍&nbsp;百度视频','','','sp'),array(16545,'面包屑导航新闻时间轴','','','sp'),array(16544,'品牌标记大全','','','sp'),array(16540,'院校大全&nbsp;高考&nbsp;百度教育','','','sp'),array(16524,'疑似推销','','','sp'),array(16514,'范文&nbsp;百度教育','','','sp'),array(16502,'CSDN博客','','','sp'),array(16499,'[猜]&nbsp;港股实时行情&nbsp;-&nbsp;东方财富网','','','sp'),array(16498,'[猜]&nbsp;股票实时行情&nbsp;-&nbsp;东方财富网','','','sp'),array(16497,'时时比分网','','','sp'),array(16494,'500彩票网','','','sp'),array(16489,'图片&nbsp;汽车之家','','','sp'),array(16488,'百度知道问律师','','','sp'),array(16452,'德甲&nbsp;新浪体育','','','sp'),array(16450,'百度阿拉丁&nbsp;robots&nbsp;禁止抓取','','','sp'),array(16448,'性病科&nbsp;挂号网','','','sp'),array(16422,'年款&nbsp;汽车点评','','','sp'),array(16414,'广场舞大全','','','sp'),array(16411,'百度软件中心','','','sp'),array(16391,'京东','','','sp'),array(16387,'手机&nbsp;太平洋电脑网','','','sp'),array(16381,'hao123下载站','','','sp'),array(16379,'百度旅游','','','sp'),array(16375,'91手游网','','','sp'),array(16369,'动漫之家','','','sp'),array(16360,'时时比分网','','','sp'),array(16355,'[猜]&nbsp;系统之家','','','sp'),array(16345,'[猜]&nbsp;世界杯&nbsp;网易体育','','','sp'),array(16343,'[猜]&nbsp;NBA赛季&nbsp;新浪体育','','','sp'),array(16333,'美股财报数据&nbsp;同花顺财经','','','sp'),array(16323,'三九养生堂','','','sp'),array(16322,'实时热点新闻&nbsp;电影网','','','sp'),array(16312,'[猜]&nbsp;百度贴吧访谈直播','','','sp'),array(16311,'股票代码&nbsp;美股实时行情&nbsp;新浪财经&nbsp;[1－9]','','','sp'),array(16309,'美股实时行情&nbsp;新浪财经&nbsp;[1－9]','','','sp'),array(16308,'百姓知道','','','sp'),array(16302,'美股实时行情&nbsp;新浪财经&nbsp;[1－9]','','','sp'),array(16281,'客服电话&nbsp;去哪儿','','','sp'),array(16277,'意甲&nbsp;新浪体育','','','sp'),array(16262,'带子链&nbsp;寻医问药网','','','sp'),array(16251,'火车票互联网、电话订票起售时间官方查询','','','sp'),array(16250,'游侠网','','','sp'),array(16239,'口碑&nbsp;百度知道','','','sp'),array(16228,'[猜]&nbsp;非中国内地明星&nbsp;伊秀娱乐&nbsp;伊秀女性网','','','sp'),array(16198,'[猜]&nbsp;百度经验【组图】','','','sp'),array(16189,'股票实时行情&nbsp;东方财富网','','','sp'),array(16187,'范文&nbsp;中小学&nbsp;百度教育','','','sp'),array(16188,'新浪财经','','','sp'),array(16184,'股票实时行情&nbsp;东方财富网','','','sp'),array(16177,'沪深股市实时行情&nbsp;同花顺财经&nbsp;[1－9]','','','sp'),array(16166,'装软件&nbsp;hao123下载站','','','sp'),array(16163,'[猜]&nbsp;欧冠新闻时间轴','','','sp'),array(16155,'直播&nbsp;电影网','','','sp'),array(16145,'学术&nbsp;百度学术','','','sp'),array(16140,'挂号网','','','sp'),array(16137,'hao123下载站','','','sp'),array(16127,'hao123下载站','','','sp'),array(16118,'车系&nbsp;爱卡汽车','','','sp'),array(16112,'差评&nbsp;爱卡汽车','','','sp'),array(16103,'查药品&nbsp;新浪药品','','','sp'),array(16101,'查药品&nbsp;新浪药品','','','sp'),array(16100,'黑龙江省青少年发展基金会','','','sp'),array(16094,'汽车报价&nbsp;爱卡汽车','','','sp'),array(16083,'hao123下载站','','','sp'),array(16079,'hao123下载站','','','sp'),array(16069,'QQ情侣个性签名&nbsp;QQ个性网','','','sp'),array(16067,'乐视体育','','','sp'),array(16066,'视频&nbsp;宣讲家','','','sp'),array(16053,'装修公司&nbsp;百齐搜','','','sp'),array(16049,'诈骗','','','sp'),array(16048,'寻医问药网','','','sp'),array(16047,'百度在线翻译&nbsp;[1－10]','','','sp'),array(16035,'旅游目的地推荐&nbsp;百度旅游','','','sp'),array(16019,'留学&nbsp;百度教育','','','sp'),array(15997,'游戏吧','','','sp'),array(15988,'动漫&nbsp;腾讯视频','','','sp'),array(15985,'宝宝中心网','','','sp'),array(15975,'百度彩票','','','sp'),array(15964,'专辑&nbsp;百度音乐','','','sp'),array(15958,'电视剧&nbsp;腾讯视频','','','sp'),array(15956,'言情小说吧','','','sp'),array(15944,'聚合实时热点新闻','','','sp'),array(15940,'西甲&nbsp;新浪体育','','','sp'),array(15929,'[猜]&nbsp;软件下载&nbsp;太平洋电脑网','','','sp'),array(15921,'新&nbsp;不同观点&nbsp;百度知道','','','sp'),array(15909,'科室&nbsp;挂号网','','','sp'),array(15907,'新房&nbsp;百度乐居&nbsp;[1－10]','','','sp'),array(15905,'十大&nbsp;聚合&nbsp;百度百科','','','sp'),array(15900,'维修&nbsp;天极产品库','','','sp'),array(15883,'代名词 百度快照在2013年09月-2013年10月间','','','sp'),array(15875,'红袖添香','','','sp'),array(15865,'二手房&nbsp;百度房产','','','sp'),array(15863,'小道消息&nbsp;手机中国','','','sp'),array(15858,'单机游戏网','','','sp'),array(15827,'电影购票&nbsp;百度糯米','','','sp'),array(15822,'进程&nbsp;综艺&nbsp;乐视网','','','sp'),array(15820,'速尔快递客服电话','','','sp'),array(15817,'普通官网','','','sp'),array(15812,'区号查询&nbsp;ip138查询网','','','sp'),array(15791,'[猜]&nbsp;快递电话','','','sp'),array(15785,'口袋巴士','','','sp'),array(15775,'手机应用&nbsp;天极下载','','','sp'),array(15772,'逗游','','','sp'),array(15765,'世界杯新闻轴','','','sp'),array(15758,'慧聪网B2B','','','sp'),array(15755,'88A','','','sp'),array(15751,'齐家网','','百度收购','sp'),array(15734,'飞翔游戏网','','','sp'),array(15728,'起点中文网','','','sp'),array(15726,'起点中文网','','','sp'),array(15720,'百度经验','','','sp'),array(15699,'供应信息&nbsp;慧聪网','','','sp'),array(15678,'网易体育','','','sp'),array(15671,'找医院&nbsp;悦美整形网','','','sp'),array(15665,'百度百科(由好大夫在线提供内容并参与编辑)','','','sp'),array(15653,'关系谱&nbsp;百度百科','','','sp'),array(15648,'旅游攻略&nbsp;百度旅游','','','sp'),array(15623,'报价及图片_太平洋汽车网','','','sp'),array(15620,'热搜攻略&nbsp;笨手机','','','sp'),array(15611,'剧情&nbsp;电视猫','','','sp'),array(15608,'舰船舰艇&nbsp;兵器库&nbsp;环球军事','','','sp'),array(15603,'选车中心&nbsp;爱卡汽车','','','sp'),array(15599,'海贼王','','','sp'),array(15584,'百度站长平台','','','sp'),array(15583,'慧聪网','','','sp'),array(15578,'QQ网名&nbsp;QQ个性网','','','sp'),array(15573,'范文&nbsp;中小学&nbsp;百度教育','','','sp'),array(15560,'中关村在线','','','sp'),array(15559,'慧聪网','','','sp'),array(15557,'[猜]&nbsp;中公教育','','','sp'),array(15552,'精准答案&nbsp;知识图谱&nbsp;百度百科','','','sp'),array(15550,'供应信息&nbsp;慧聪网','','','sp'),array(15547,'淘整形&nbsp;悦美整形网','','','sp'),array(15546,'特产&nbsp;知识图谱','','','sp'),array(15540,'腾牛网','','','sp'),array(15277,'263企业邮箱登录','','','sp'),array(15522,'天极产品库','','','sp'),array(15521,'百度爱生活','','','sp'),array(15516,'人人网同名搜索','','','sp'),array(15515,'人人网同名搜索','','','sp'),array(15494,'就医160','','','sp'),array(15492,'北京市预约挂号统一平台','','','sp'),array(15474,'食材&nbsp;美食','','','sp'),array(15460,'中国足彩网','','','sp'),array(15448,'慧聪商务搜索','','','sp'),array(15443,'节日&nbsp;百度百科','','','sp'),array(15442,'疾病百科&nbsp;39健康网','','','sp'),array(15436,'百度彩票&nbsp;电脑端&nbsp;[1－10]','','','sp'),array(15416,'出国留学&nbsp;百度教育','','','sp'),array(15395,'九九搜服','','','sp'),array(15388,'手机中国','','','sp'),array(15373,'阿里巴巴公益基金会','','','sp'),array(15363,'自营&nbsp;百度游戏&nbsp;[1－10]','','','sp'),array(15357,'hao123汽车|hao123头条','','','sp'),array(15355,'供应&nbsp;慧聪网','','','sp'),array(15354,'供应信息&nbsp;慧聪网','','','sp'),array(15352,'系统家园','','','sp'),array(15346,'精品课程&nbsp;百度文库','','','sp'),array(15340,'供应信息&nbsp;慧聪网','','','sp'),array(15313,'篮球赛程','','','sp'),array(15306,'话费充值&nbsp;百度钱包','','','sp'),array(15295,'畛域_百度视频','','','sp'),array(15285,'网名&nbsp;Q友乐园','','','sp'),array(15279,'客服电话&nbsp;[3－4]','','','sp'),array(15274,'租房&nbsp;百度房产','','','sp'),array(15267,'英雄&nbsp;百度爱玩','','','sp'),array(15247,'口碑&nbsp;汽车之家','','','sp'),array(15232,'百度轻应用','','','sp'),array(15213,'整形报价大全&nbsp;悦美整形网','','','sp'),array(15210,'时时比分网','','','sp'),array(15200,'豆瓣电影','','','sp'),array(15198,'考研时间安排&nbsp;新浪教育','','','sp'),array(15195,'不凡游戏网','','','sp'),array(15181,'华军软件园','','','sp'),array(15174,'百度手机助手','','','sp'),array(15131,'百度传课','','','sp'),array(15129,'yy138','','','sp'),array(15125,'在线观看&nbsp;爱奇艺','','','sp'),array(15118,'开区网','','','sp'),array(15110,'好大夫在线','','','sp'),array(15109,'疾病&nbsp;好大夫在线','','','sp'),array(15108,'看比赛&nbsp;腾讯体育&nbsp;[1－10]','','','sp'),array(15107,'球队&nbsp;腾讯体育&nbsp;[1－10]','','','sp'),array(15104,'排行榜&nbsp;腾讯体育&nbsp;[1－10]','','','sp'),array(15102,'投资&nbsp;易登网','','','sp'),array(15101,'hao到家&nbsp;hao123','','','sp'),array(15097,'hao123电视剧','','','sp'),array(15079,'二手房&nbsp;百度乐居','','','sp'),array(15063,'天气预报&nbsp;中国天气网&nbsp;[1－7]','','','sp'),array(15058,'飞翔游戏网','','','sp'),array(15056,'天极下载','','','sp'),array(15027,'pc大卡','','','sp'),array(15017,'热点&nbsp;网易体育','','','sp'),array(15009,'第一比分网','','','sp'),array(14994,'伊秀娱乐明星库','','','sp'),array(14991,'装软件&nbsp;hao123下载站','','','sp'),array(14990,'ZOL软件下载','','','sp'),array(14966,'百度视频&nbsp;相关视频','','','sp'),array(14960,'天极产品库','','','sp'),array(14957,'疑似诈骗&nbsp;电话邦','','','sp'),array(14955,'实物价格&nbsp;和讯黄金','','','sp'),array(14947,'起点小说排行榜','','','sp'),array(14946,'天极产品库','','','sp'),array(14907,'分集剧情介绍&nbsp;电视猫','','','sp'),array(14888,'全国高铁时刻表查询及在线预订&nbsp;去哪儿','','','sp'),array(14861,'[猜]&nbsp;选手&nbsp;乐视网','','','sp'),array(14873,'经销商&nbsp;汽车之家','','','sp'),array(14856,'企业信息&nbsp;易登网','','','sp'),array(14839,'动漫之家','','','sp'),array(14828,'新浪药品','','','sp'),array(14808,'湖南博物馆','','','sp'),array(14771,'看书网','','','sp'),array(14764,'好服','','','sp'),array(14746,'移动网上营业厅登录','','','sp'),array(14744,'小皮游戏','','','sp'),array(14726,'热点&nbsp;网易娱乐','','','sp'),array(14719,'新房&nbsp;百度乐居','','','sp'),array(14713,'目的地指南&nbsp;百度旅游','','','sp'),array(14709,'易登网','','','sp'),array(14695,'手机&nbsp;ZOL产品报价','','','sp'),array(14686,'ABAB游戏库','','','sp'),array(14675,'开奖结果查询&nbsp;百度彩票','','','sp'),array(14668,'上海公积金查询&nbsp;百度知心','','','sp'),array(14664,'爱卡汽车','','','sp'),array(14643,'港股实时行情&nbsp;同花顺财经','','','sp'),array(14630,'我爱搜服网','','','sp'),array(14620,'hao123下载站','','','sp'),array(14616,'hao123网页游戏','','','sp'),array(14611,'hao123小游戏','','','sp'),array(14602,'hao123电影','','','sp'),array(14593,'学术期刊','','','sp'),array(14585,'hao123下载站','','','sp'),array(14584,'[猜]&nbsp;百度团购官网','','','sp'),array(14583,'最佳答案&nbsp;百度知道','','','sp'),array(14580,'zinch中国','','','sp'),array(14556,'AK军事网','','','sp'),array(14545,'品牌词','','','sp'),array(14542,'第一彩票论坛','','','sp'),array(14538,'汽车报价&nbsp;爱卡汽车','','','sp'),array(14525,'货币兑换&nbsp;和讯外汇','','','sp'),array(14515,'[猜]&nbsp;新浪微博|58同城|百度卫士|百度影音|铁路客户服务中心','','','sp'),array(14513,'天极产品库','','','sp'),array(14510,'[猜]&nbsp;58同城|淘宝网','','','sp'),array(14509,'佛山&nbsp;新房&nbsp;百度乐居','','','sp'),array(14507,'南京&nbsp;新房&nbsp;百度乐居','','','sp'),array(14505,'保定&nbsp;新房&nbsp;百度乐居','','','sp'),array(14495,'新西兰&nbsp;海外院校库&nbsp;留学&nbsp;百度教育','','','sp'),array(14493,'油耗&nbsp;汽车点评','','','sp'),array(14491,'图片库&nbsp;汽车点评','','','sp'),array(14490,'汽车点评','','','sp'),array(14488,'马来西亚&nbsp;海外院校库&nbsp;留学&nbsp;百度教育','','','sp'),array(14486,'泰国&nbsp;海外院校库&nbsp;留学&nbsp;百度教育','','','sp'),array(14482,'报价&nbsp;手机中国','','','sp'),array(14481,'评测&nbsp;产品大全&nbsp;手机中国','','','sp'),array(14480,'中甲&nbsp;搜狐体育','','','sp'),array(14479,'四四传世','','','sp'),array(14474,'百度投诉中心','','','sp'),array(14472,'图片&nbsp;手机中国&nbsp;[1－10]','','','sp'),array(14471,'点评&nbsp;手机中国&nbsp;[1－10]','','','sp'),array(14470,'报价&nbsp;图片&nbsp;点评&nbsp;汽车点评&nbsp;[1－10]','','','sp'),array(14466,'汽车点评','','百度收购','sp'),array(14465,'高考分数线查询&nbsp;中国教育在线','','百度收购','sp'),array(14464,'产品参数&nbsp;手机中国&nbsp;[1－10]','','','sp'),array(14462,'证照申领&nbsp;中国上海政府','','','sp'),array(14460,'报价库&nbsp;汽车点评&nbsp;[1－10]','','','sp'),array(14459,'报价&nbsp;汽车点评&nbsp;[1－10]','','','sp'),array(14452,'快照删除与更新&nbsp;百度投诉','','','sp'),array(14449,'选车中心&nbsp;汽车点评','','','sp'),array(14446,'安卓讨论区&nbsp;论坛&nbsp;手机中国','','','sp'),array(14444,'客服电话','','','sp'),array(14435,'[猜]&nbsp;聊天通讯&nbsp;-&nbsp;百度软件中心','','','sp'),array(14434,'天极产品库','','','sp'),array(14427,'天极下载','','','sp'),array(14421,'时刻表&nbsp;发车间隔&nbsp;同程网','','','sp'),array(14419,'专业录取线&nbsp;中国教育在线','','','sp'),array(14413,'政府官网','','','sp'),array(14412,'公司财报&nbsp;同花顺财经','','','sp'),array(14405,'世界杯最新赛程&nbsp;网易体育','','','sp'),array(14389,'第一比分网','','','sp'),array(14380,'外汇牌价&nbsp;东方财富网','','','sp'),array(14331,'百度经验【图文】','','','sp'),array(14330,'pc6下载站','','','sp'),array(14324,'天气预报&nbsp;中国天气网','','','sp'),array(14381,'俄罗斯客机&nbsp;实时热点时间线','','','sp'),array(14347,'客栈民宿&nbsp;酒店&nbsp;去哪儿','','','sp'),array(14315,'基于&nbsp;IP&nbsp;地理位置&nbsp;商务部全国农产品商务信息公共服务平台','','','sp'),array(14308,'点评&nbsp;平板大全&nbsp;手机中国','','','sp'),array(14305,'百度网盘','','','sp'),array(14292,'百度07073网页游戏','','','sp'),array(14289,'连锁酒店&nbsp;去哪儿','','','sp'),array(14287,'股吧&nbsp;-&nbsp;东方财富网','','','sp'),array(14283,'股吧&nbsp;-&nbsp;东方财富网','','','sp'),array(14281,'楼盘检索&nbsp;百度乐居&nbsp;[1－10]','','','sp'),array(14232,'下载之家','','','sp'),array(14175,'欧洲杯','','','sp'),array(14216,'票房榜&nbsp;Mtime时光网','','','sp'),array(14183,'景点&nbsp;中国天气网','','','sp'),array(14181,'[猜]社交网络&nbsp;-&nbsp;ipush','','','sp'),array(14175,'欧洲杯','','','sp'),array(14167,'跨考网','','','sp'),array(14163,'17K小说网','','','sp'),array(14145,'期货行情&nbsp;行情中心&nbsp;和讯网','','','sp'),array(14142,'[猜]&nbsp;系统吧','','','sp'),array(14134,'[猜]&nbsp;百度图片 医疗健康','','','sp'),array(14127,'搜服网','','','sp'),array(14122,'CBA&nbsp数据库&nbsp;搜狐体育&nbsp;[1－10]','','','sp'),array(14110,'中国天气网','','','sp'),array(14109,'坦克装甲车辆&nbsp;兵器库&nbsp;环球军事','','','sp'),array(14105,'聚合实时热点新闻','','','sp'),array(14101,'开区网','','','sp'),array(14098,'研究生|公务员报考官网','','','sp'),array(14082,'二手房&nbsp;易登网','','','sp'),array(14076,'最新迷你&nbsp;在线观看&nbsp;百度视频','','','sp'),array(14072,'车系&nbsp;爱卡汽车','','','sp'),array(14071,'世界杯赛程&nbsp;网易体育','','','sp'),array(14068,'用户标记&nbsp;百度手机卫士','','','sp'),array(14065,'百度医生','','','sp'),array(14062,'hao123折扣导航','','','sp'),array(14060,'百度硬件','','','sp'),array(14059,'[猜]&nbsp;马槽&nbsp;百度经验','','','sp'),array(14058,'电影&nbsp;百度团购','','','sp'),array(14047,'枪械与单兵&nbsp;兵器库&nbsp;环球军事','','','sp'),array(14037,'数码系列&nbsp;中关村在线','','','sp'),array(14035,'指数(排行榜)&nbsp;易车网','','','sp'),array(14032,'春节直播&nbsp;综艺&nbsp;爱奇艺','','','sp'),array(14022,'旅游景点&nbsp;百度经验【组图】','','','sp'),array(14018,'违章查询','','','sp'),array(14016,'第一比分网','','','sp'),array(14015,'基于&nbsp;IP&nbsp;地理位置&nbsp;违章查询','','','sp'),array(14014,'家电&nbsp;天极产品库','','','sp'),array(14004,'挂号网','','','sp'),array(13999,'2015诺贝尔奖&nbsp;-&nbsp;pc','','','sp'),array(13975,'联合国儿童基金会','','','sp'),array(13962,'理论&nbsp;人民网','','','sp'),array(13956,'普遍二孩&nbsp;聚合实时热点新闻','','','sp'),array(13952,'百度安全论坛','','','sp'),array(13947,'考研成绩查询&nbsp;新浪教育','','','sp'),array(13932,'企业官方贴吧','','','sp'),array(13927,'ZOL产品报价&nbsp;中关村在线','','','sp'),array(13920,'产品报价&nbsp;中关村在线','','','sp'),array(13911,'手机&nbsp;天极产品库','','','sp'),array(13885,'[猜]&nbsp;百度卫士&nbsp;百度知道','','','sp'),array(13881,'文集&nbsp;宣讲家','','','sp'),array(13880,'搜服网','','','sp'),array(13863,'百度火车票','','','sp'),array(13854,'电影&nbsp;-&nbsp;腾讯视频','','','sp'),array(13847,'考试月历&nbsp;考试吧','','','sp'),array(13842,'旅游攻略&nbsp;百度旅游','','','sp'),array(13841,'英语四六级考试查分&nbsp;考试吧','','','sp'),array(13830,'售后服务热线&nbsp;百度知心','','','sp'),array(13823,'hao123下载站','','','sp'),array(13820,'核心价值观&nbsp;百度百科','','','sp'),array(13806,'附近电影院&nbsp;时光网','','','sp'),array(13805,'99单机游戏','','','sp'),array(13803,'挂号&nbsp;就医160','','','sp'),array(13798,'支付宝客服电话|百度用户服务中心','','','sp'),array(13773,'新房&nbsp;百度乐居','','','sp'),array(13750,'7k7k小游戏','','','sp'),array(13747,'网页游戏&nbsp;7k7k小游戏','','','sp'),array(13741,'实时路况','','','sp'),array(13717,'左侧知心&nbsp;电视剧&nbsp;爱奇艺','','','sp'),array(13715,'年款&nbsp;爱卡汽车','','','sp'),array(13709,'51offer&nbsp;免费留学申请智能平台','','','sp'),array(13706,'[猜]&nbsp;腾讯彩票','','','sp'),array(13692,'百度彩票','','','sp'),array(13689,'慧聪网','','','sp'),array(13682,'安卓讨论区&nbsp;论坛&nbsp;手机中国','','','sp'),array(13681,'平板讨论区&nbsp;论坛&nbsp;手机中国','','','sp'),array(13679,'现货价格&nbsp;和讯黄金','','','sp'),array(13677,'开奖时间查询&nbsp;百度彩票','','','sp'),array(13667,'世界杯&nbsp;搜狐体育','','','sp'),array(13635,'二手房&nbsp;百度乐居','','','sp'),array(13631,'比赛进程&nbsp;乐视网','','','sp'),array(13630,'[猜]&nbsp;中国内地明星&nbsp;伊秀娱乐&nbsp;伊秀女性网','','','sp'),array(13627,'亚冠赛程结果&nbsp;新浪体育','','','sp'),array(13624,'常规概念板块&nbsp;行情中心&nbsp;同花顺','','','sp'),array(13620,'百度知道&nbsp;ipush','','','sp'),array(13616,'二手房&nbsp;百度乐居','','','sp'),array(13614,'去哪儿火车票代理商统一客服电话&nbsp;[3－7]','','','sp'),array(13602,'导航&nbsp;什么值得买','','','sp'),array(13600,'爱卡汽车','','','sp'),array(13598,'猎聘网','','','sp'),array(13582,'hao123下载站','','','sp'),array(13580,'嫣然天使基金','','','sp'),array(13576,'广场舞&nbsp;百度视频','','','sp'),array(13547,'报价&nbsp;平板大全&nbsp;手机中国','','','sp'),array(13539,'中国好声音&nbsp;音乐','','','sp'),array(13522,'找工作&nbsp;求职&nbsp;上前程无忧','','','sp'),array(13516,'足球队&nbsp;新浪体育','','','sp'),array(13501,'犬类&nbsp;知心结果','','','sp'),array(13497,'楼盘检索&nbsp;百度乐居','','','sp'),array(13496,'综艺&nbsp;爱奇艺','','','sp'),array(13469,'hao123下载站','','','sp'),array(13466,'逗游网','','','sp'),array(13465,'ABAB小游戏','','','sp'),array(13447,'百度电脑专家','','','sp'),array(13445,'供应信息&nbsp;慧聪网','','','sp'),array(13442,'公式&nbsp;百度百科','','','sp'),array(13408,'二手房&nbsp;百度乐居','','','sp'),array(13937,'直播&nbsp;央视网','','','sp'),array(13390,'腾讯动漫','','','sp'),array(13376,'短信库&nbsp;爱祝福&nbsp;[1－10]','','','sp'),array(13369,'一听音乐','','','sp'),array(13363,'普通话考试成绩查询&nbsp;无忧考网','','','sp'),array(13360,'[猜]&nbsp;百度贴吧','','','sp'),array(13355,'短信&nbsp;爱祝福','','','sp'),array(13351,'百度邮编','','','sp'),array(13343,'联系方式&nbsp;畅途网&nbsp;[1－10]','','','sp'),array(13336,'墨迹天气','','','sp'),array(13331,'QQ表情','','','sp'),array(13323,'中华少年儿童慈善救助基金会','','','sp'),array(13310,'手机品牌&nbsp;太平洋电脑网','','','sp'),array(13290,'卖场&nbsp;新浪家居网','','','sp'),array(13285,'新房&nbsp;百度乐居','','','sp'),array(13275,'环球军事','','','sp'),array(13265,'手机大全&nbsp;手机中国&nbsp;[1－10]','','','sp'),array(13264,'畅途网&nbsp;百度数据开放平台合作伙伴','','','sp'),array(13262,'红十字国际委员会','','','sp'),array(13260,'汽车百科知识&nbsp;汽车点评','','','sp'),array(13255,'旅游景点&nbsp;百度旅游','','','sp'),array(13252,'开奖结果&nbsp;百度彩票','','','sp'),array(13235,'登录新浪免费企业邮箱','','','sp'),array(13231,'欧洲冠军联赛&nbsp;-&nbsp;新浪体育','','','sp'),array(13216,'影讯&nbsp;最近上映电影&nbsp;Mtime时光网','','','sp'),array(13211,'爱德基金会','','','sp'),array(13174,'列车时刻表查询及在线预订&nbsp;去哪儿','','','sp'),array(13169,'中国500强&nbsp;财富中文网','','','sp'),array(13149,'中华人民共和国公安部','','','sp'),array(13143,'油价查询&nbsp;易车网','','','sp'),array(13138,'赛车&nbsp;乐视体育','','','sp'),array(13130,'中考直通站&nbsp;考试吧','','','sp'),array(13128,'价格&nbsp;汽车点评','','','sp'),array(13126,'综艺&nbsp;爱奇艺','','','sp'),array(13118,'比赛进程&nbsp;百度视频','','','sp'),array(13116,'500彩票网','','','sp'),array(13144,'教育文库&nbsp;百度文库','','','sp'),array(13111,'中国红十字基金会','','','sp'),array(13103,'运势&nbsp;星座屋','','','sp'),array(13096,'百度团购','','','sp'),array(13088,'桌面百度最新官方版下载&nbsp;百度软件中心','','','sp'),array(13078,'列车时刻表&nbsp;去哪儿','','','sp'),array(13070,'高考&nbsp;新浪教育','','','sp'),array(13059,'联系电话&nbsp;畅途网','','','sp'),array(13051,'口碑&nbsp;百度知道','','','sp'),array(13039,'客服电话&nbsp;去哪儿','','','sp'),array(13031,'城市天气预报&nbsp;中国天气网','','','sp'),array(13013,'产品报价&nbsp;太平洋电脑网','','','sp'),array(13003,'高考&nbsp;百度教育','','','sp'),array(12976,'海淘攻略&nbsp;什么值得买','','','sp'),array(12967,'百度软件','','','sp'),array(12965,'ABAB小游戏','','','sp'),array(12964,'二手房&nbsp;百度乐居','','','sp'),array(12955,'报名&nbsp;考试吧','','','sp'),array(12946,'动漫&nbsp;爱奇艺','','','sp'),array(12934,'11773手游网','','','sp'),array(12926,'[猜]&nbsp;亚信峰会直播&nbsp;凤凰网','','','sp'),array(12911,'游戏活动&nbsp;游久网','','','sp'),array(12906,'[猜]城市&nbsp;-&nbsp;百度团购','','','sp'),array(12904,'[猜]&nbsp;中国网络电视台','','','sp'),array(12903,'[猜]&nbsp;百度团购导航','','','sp'),array(12901,'旅游攻略&nbsp;-&nbsp;百度旅游','','','sp'),array(12898,'小区房价&nbsp;二手房&nbsp;百度乐居','','','sp'),array(12896,'百度地图','','','sp'),array(12880,'[猜]&nbsp;国内省市级|国外国家级目的地&nbsp;百度旅游','','','sp'),array(12869,'挖矿大全&nbsp;hao123上网导航','','','sp'),array(12861,'攻略&nbsp;百度旅游','','','sp'),array(12851,'楼盘详情&nbsp;百度乐居','','','sp'),array(12845,'时时直播吧','','','sp'),array(12840,'百度乐居','','','sp'),array(12839,'招远麦当劳&nbsp;新闻直播','','','sp'),array(12833,'多搜服','','','sp'),array(12822,'80710直播吧','','','sp'),array(12811,'十三五&nbsp;聚合实时热点新闻','','','sp'),array(12809,'综艺&nbsp;爱奇艺','','','sp'),array(12801,'旅游出行排行榜&nbsp;114生活网&nbsp;[1－10]','','','sp'),array(12797,'爱上游','','','sp'),array(12796,'新浪高考','','','sp'),array(12790,'百度微软战略合作&nbsp;聚合实时热点新闻','','','sp'),array(12788,'年款&nbsp;爱卡汽车','','','sp'),array(12783,'秋叶墓地网','','','sp'),array(12762,'蚂蜂窝','','','sp'),array(12761,'法规库&nbsp;找法网','','','sp'),array(12758,'个人缴费人员首次参保业务&nbsp;深圳市社会保险基金管理局','','','sp'),array(12738,'选车中心&nbsp;爱卡汽车','','','sp'),array(12734,'地方彩票&nbsp;百度彩票','','','sp'),array(12730,'好服','','','sp'),array(12729,'百度票务','','','sp'),array(12726,'医院&nbsp;好大夫在线','','','sp'),array(12725,'九九搜服','','','sp'),array(12717,'要我玩','','','sp'),array(12702,'玩法规则&nbsp;百度彩票','','','sp'),array(12701,'开奖公告&nbsp;百度彩票','','','sp'),array(12682,'新房&nbsp;百度乐居&nbsp;[1－10]','','','sp'),array(12671,'学习技能条件&nbsp;齐乐乐游戏网&nbsp;[1－10]','','','sp'),array(12658,'饮食&nbsp;太平洋亲子网','','','sp'),array(12656,'开区网','','','sp'),array(12654,'专升本报名信息汇总&nbsp;无忧考网','','','sp'),array(12653,'CCTV4&nbsp;百度视频&nbsp;央视网','','','sp'),array(12651,'饮食&nbsp;太平洋亲子网','','','sp'),array(12650,'游戏装备&nbsp;齐乐乐游戏网&nbsp;[1－10]','','','sp'),array(12645,'[猜]&nbsp;轿车&nbsp;易车网','','','sp'),array(12644,'软件排行榜&nbsp;太平洋下载','','','sp'),array(12643,'百度团购第&nbsp;2&nbsp;种起点','','','sp'),array(12640,'爱卡汽车','','','sp'),array(12633,'下载之家','','','sp'),array(12628,'家庭医生在线','','','sp'),array(12616,'开奖查询&nbsp;百度乐彩','','','sp'),array(12610,'汽车点评','','','sp'),array(12605,'百度乐彩','','','sp'),array(12597,'作文网','','','sp'),array(12594,'[猜]&nbsp;腾讯视频','','','sp'),array(12581,'考试报名时间汇总&nbsp;233网校','','','sp'),array(12577,'地图&nbsp;百度旅游','','','sp'),array(12574,'范文&nbsp;中小学&nbsp;百度教育','','','sp'),array(12573,'介绍&nbsp;百度旅游','','','sp'),array(12560,'汽车报价&nbsp;汽车点评','','','sp'),array(12558,'说明书&nbsp;寻医问药网','','','sp'),array(12555,'点评&nbsp;爱卡汽车','','','sp'),array(12542,'英语四六级真题试卷&nbsp;新浪教育','','','sp'),array(12534,'高考查分&nbsp;新浪教育','','','sp'),array(12521,'开心网会员登录','','','sp'),array(12520,'节目表&nbsp;电视猫','','','sp'),array(12512,'录取分数线&nbsp;高考招生&nbsp;中国教育在线','','','sp'),array(12502,'产检&nbsp;太平洋亲子网','','','sp'),array(12501,'育儿&nbsp;太平洋亲子网','','','sp'),array(12500,'育儿检测&nbsp;太平洋亲子网','','','sp'),array(12497,'同义词&nbsp;百度百科','','','sp'),array(12496,'怀孕&nbsp;亲子百科&nbsp;太平洋亲子网','','','sp'),array(12491,'怀孕&nbsp;太平洋亲子网','','','sp'),array(12481,'孕期饮食禁忌&nbsp;太平洋亲子网','','','sp'),array(12472,'获奖名单&nbsp;新浪娱乐','','','sp'),array(12461,'飞翔下载','','','sp'),array(12456,'齐乐乐游戏网','','','sp'),array(12438,'QQ网名','','','sp'),array(12431,'世界杯球队排名&nbsp;网易体育','','','sp'),array(12403,'壹基金','','','sp'),array(12397,'车维修','','','sp'),array(12391,'装修&nbsp;齐家网','','','sp'),array(12384,'珍爱网登录','','','sp'),array(12382,'周边游&nbsp;百度旅游','','','sp'),array(12378,'电子元器件查询平台&nbsp;华强芯城','','','sp'),array(12377,'直播&nbsp;爱奇艺','','','sp'),array(12363,'时刻表信息大全&nbsp;畅途网','','','sp'),array(12360,'足球队&nbsp;新浪体育','','','sp'),array(12354,'网球&nbsp;乐视体育','','','sp'),array(12353,'快速问医生','','百度提词 属于百度返量合作的一种 阿拉丁计划里面的一部分 34226466','sp'),array(12352,'最佳答案','','','sp'),array(12347,'产品导航&nbsp;手机&nbsp;太平洋电脑网','','','sp'),array(12346,'商户&nbsp;大众点评网','','','sp'),array(12345,'食品营养价值&nbsp;美食天下','','','sp'),array(12342,'[猜]&nbsp;NBA决赛&nbsp;热点直播&nbsp;网易体育','','','sp'),array(12322,'百度视频','','','sp'),array(12302,'口碑&nbsp;汽车之家','','','sp'),array(12275,'A股财报数据&nbsp;同花顺财经','','','sp'),array(12274,'央视网&nbsp;[1－10]','','','sp'),array(12270,'18183手机游戏网','','','sp'),array(12268,'世界杯淘汰赛赛程&nbsp;网易体育','','','sp'),array(12250,'楼盘详情&nbsp;百度乐居','','','sp'),array(12248,'医护网','','','sp'),array(12239,'新浪高考','','','sp'),array(12220,'排行榜&nbsp;百度搜索风云榜','','','sp'),array(12215,'今日游戏排行榜&nbsp;百度搜索风云榜','','','sp'),array(12202,'苏州&nbsp;新房&nbsp;百度乐居','','','sp'),array(12197,'百度爱生活','','','sp'),array(12196,'18183手机游戏网','','','sp'),array(12189,'最新房源信息&nbsp;百度房产','','','sp'),array(12185,'有妖气','','','sp'),array(12180,'有利网','','','sp'),array(12149,'长途汽车时刻表及票价查询&nbsp;畅途网','','','sp'),array(12134,'就搜服','','','sp'),array(12123,'专题&nbsp;百度音乐','','','sp'),array(12121,'综艺&nbsp;风行网','','','sp'),array(12118,'百度相册','','','sp'),array(12114,'百度经验【组图】','','','sp'),array(12102,'自学考试&nbsp;考试吧','','','sp'),array(12097,'京东商城品牌','','','sp'),array(12089,'新款&nbsp;手机品牌大全&nbsp;手机大全','','','sp'),array(12085,'世界大学学术排名&nbsp;院校排行榜&nbsp;zinch中国','','','sp'),array(12084,'百度浏览器','','','sp'),array(12049,'百度推广投诉客服电话','','','sp'),array(12048,'客服电话','','','sp'),array(12040,'火车票余票查询&nbsp;中国铁路客户服务中心','','','sp'),array(12033,'港股实时行情&nbsp;同花顺财经&nbsp;[1－9]','','','sp'),array(12028,'新浪博客登录','','','sp'),array(12021,'新闻时间轴','','','sp'),array(12019,'汽车点评','','','sp'),array(11996,'招聘企业&nbsp;看准网','','','sp'),array(11990,'客服电话','','','sp'),array(11988,'挂号&nbsp;浙江省预约诊疗服务平台','','','sp'),array(11973,'平板大全&nbsp;手机中国','','','sp'),array(11952,'百度口碑','','','sp'),array(11948,'综艺&nbsp;爱奇艺','','','sp'),array(11947,'综艺&nbsp;爱奇艺','','','sp'),array(11940,'全国省份天气预报&nbsp;中国天气网','','','sp'),array(11939,'网页游戏开服表&nbsp;07073游戏网','','','sp'),array(11933,'中国易登网','','','sp'),array(11921,'有妖气','','','sp'),array(11915,'2014全国高校招生计划及招生简章汇总&nbsp;新浪教育','','','sp'),array(11903,'易登网','','','sp'),array(11899,'[猜]&nbsp;维基百科|百度团购|百度杀毒','','','sp'),array(11898,'知名网站','','','sp'),array(11885,'交友&nbsp;易登网','','','sp'),array(11874,'九牛网','','','sp'),array(11866,'单机游戏&nbsp;乐游网','','','sp'),array(11861,'人民日报电子版在线阅读','','','sp'),array(11859,'快速网店查询&nbsp;快递100','','','sp'),array(11852,'法甲&nbsp;新浪体育','','','sp'),array(11838,'客服电话表&nbsp;[3－10]','','','sp'),array(11835,'星座配对查询&nbsp;星座屋','','','sp'),array(11830,'百度软件中心','','','sp'),array(11828,'融360','','','sp'),array(11814,'出国留学网','','','sp'),array(11810,'区号查询','','','sp'),array(11803,'中国114黄页','','原“爱漫画”','sp'),array(11793,'快速问医生','','','sp'),array(11788,'综合对比&nbsp;手机大全&nbsp;手机中国','','','sp'),array(11783,'人才网&nbsp;易登网','','','sp'),array(11782,'手机大全&nbsp;手机中国&nbsp;[1－10]','','百度收购','sp'),array(11757,'爱漫画','','','sp'),array(11753,'国际&nbsp;中国天气网','','','sp'),array(11731,'房源信息&nbsp;安居客','','','sp'),array(11730,'宠物排名&nbsp;知识图谱','','','sp'),array(11708,'组图&nbsp;美食天下','','','sp'),array(11700,'疾病百科&nbsp;寻医问药网','','','sp'),array(11692,'地铁&nbsp;百度地图','','','sp'),array(11677,'网易163邮箱登录','','','sp'),array(11675,'五笔编码汉语拼音查询&nbsp;ip138查询网','','','sp'),array(11666,'实时单片票房&nbsp;中国票房网','','','sp'),array(11661,'广东电视网&nbsp;[1－10]','','','sp'),array(11647,'内容&nbsp;百度乐居','','','sp'),array(11640,'考试吧','','','sp'),array(11632,'纪录片&nbsp;爱奇艺','','','sp'),array(11627,'开区网','','','sp'),array(11620,'公益咨询电话','','','sp'),array(11611,'广东卫视&nbsp;[1－10]','','','sp'),array(11610,'成人高考报名时间_考试吧','','','sp'),array(11582,'中超&nbsp;新浪体育','','','sp'),array(11581,'玩法&nbsp;500彩票网&nbsp;[1－10]','','','sp'),array(11576,'搜狐焦点网','','','sp'),array(11567,'爱上游','','','sp'),array(11547,'聚合实时热点新闻','','原求医网','sp'),array(11540,'爱奇艺','','','sp'),array(11539,'足球联赛对战表&nbsp;新浪体育','','','sp'),array(11526,'办理旅游签证&nbsp;百度经验','','','sp'),array(11521,'全国铁路统一电话订票号码&nbsp;95105105(外地订票需加拨出发地区号)','','','sp'),array(11520,'观后感、评论&nbsp;豆瓣电影','','','sp'),array(11519,'影评、简介及基本信息&nbsp;豆瓣电影','','','sp'),array(11513,'最新港股财报&nbsp;同花顺财经','','','sp'),array(11512,'一游网','','','sp'),array(11511,'小说阅读网','','','sp'),array(11501,'hao123下载站','','','sp'),array(11495,'国际原油价格&nbsp;银天下石油','','','sp'),array(11492,'采集观点&nbsp;百度知道','','','sp'),array(11490,'国际原油期货价格&nbsp;国际石油网','','','sp'),array(11485,'楼盘详情&nbsp;百度乐居','','','sp'),array(11478,'间接确认的官网','','','sp'),array(11476,'好服','','','sp'),array(11471,'国家授时中心标准时间','','','sp'),array(11463,'畅途网&nbsp;百度数据开放平台合作伙伴','','','sp'),array(11462,'[猜]&nbsp;官方订票电话','','','sp'),array(11455,'犬类&nbsp;知心结果&nbsp;百度百科','','','sp'),array(11443,'国际足联排名&nbsp;新浪体育','','','sp'),array(11442,'网球世界排名&nbsp;新浪体育','','','sp'),array(11439,'乒乓球世界排名&nbsp;新浪体育','','','sp'),array(11437,'羽毛球世界排名&nbsp;新浪体育','','','sp'),array(11436,'233网校','','','sp'),array(11432,'礼包&nbsp;百度爱玩','','','sp'),array(11428,'综艺&nbsp;爱奇艺','','','sp'),array(11421,'高考分数线&nbsp;招生信息&nbsp;百度教育','','','sp'),array(11419,'易登网','','','sp'),array(11412,'搜服网','','','sp'),array(11409,'公益咨询电话','','','sp'),array(11408,'九九搜服','','','sp'),array(11399,'报价|配置&nbsp;爱卡汽车','','','sp'),array(11392,'爱上游','','','sp'),array(11386,'百度贴吧','','','sp'),array(11384,'产品大全&nbsp;手机中国','','','sp'),array(11382,'百度浏览器','','','sp'),array(11369,'货物追踪','','','sp'),array(11361,'楼盘检索&nbsp;百度乐居','','','sp'),array(11358,'【携程酒店】','','','sp'),array(11357,'加拿大&nbsp;海外院校库&nbsp;留学&nbsp;百度教育','','','sp'),array(11353,'铁路客户服务中心官网','','','sp'),array(11349,'下载之家','','','sp'),array(11342,'健康畛域&nbsp;百度健康','','','sp'),array(11341,'hao123下载站','','','sp'),array(11334,'母婴品牌分类信息&nbsp;用品&nbsp;太平洋亲子网','','','sp'),array(11314,'系统屋','','','sp'),array(11309,'开奖公告&nbsp;百度彩票','','','sp'),array(11305,'车系&nbsp;爱卡汽车','','','sp'),array(11301,'人民网宏观经济数据库','','','sp'),array(11299,'手机中国','','','sp'),array(11286,'下载&nbsp;攻略&nbsp;游迅网','','','sp'),array(11272,'快递网点查询&nbsp;快递100','','','sp'),array(11263,'中国妇女发展基金会','','','sp'),array(11260,'百度文库认证机构','','','sp'),array(11252,'百度文库认证作者','','','sp'),array(11239,'中国宋庆龄基金会','','','sp'),array(11230,'港澳通行证&nbsp;百度经验','','','sp'),array(11228,'综艺节目联系方式&nbsp;爱奇艺','','','sp'),array(11205,'新浪星座查询','','','sp'),array(11200,'Dotamax','','','sp'),array(11199,'房价走势&nbsp;基于&nbsp;IP&nbsp;地理位置&nbsp;搜房网','','','sp'),array(11196,'12306&nbsp;官网','','','sp'),array(11182,'百度外卖','','','sp'),array(11177,'敞篷车&nbsp;汽车点评','','','sp'),array(11175,'[猜]&nbsp;百度贴吧直播','','','sp'),array(11170,'太平洋下载中心','','','sp'),array(11164,'手机大全&nbsp;手机中国','','','sp'),array(11157,'经销商&nbsp;汽车点评','','','sp'),array(11140,'妈妈网百科','','','sp'),array(11129,'[猜]&nbsp;综艺节目联系方式','','','sp'),array(11123,'国内邮政编码和长途电话区号查询','','','sp'),array(11116,'基金净值查询&nbsp;和讯网&nbsp;[1－10]','','','sp'),array(11112,'选车中心&nbsp;爱卡汽车','','','sp'),array(11098,'铁路订票电话 95105105&nbsp;外地订票需加拨出发地区号','','','sp'),array(11090,'星座屋','','','sp'),array(11077,'净值走势图&nbsp;私募基金&nbsp;好买基金网','','','sp'),array(11070,'好服','','','sp'),array(11069,'优速快递单号查询','','','sp'),array(11066,'在职硕士联考&nbsp;新浪教育','','','sp'),array(11051,'3533手机世界','','','sp'),array(11031,'hao123子站','','','sp'),array(11002,'装软件&nbsp;hao123下载站','','','sp'),array(10991,'百度租房','','','sp'),array(10979,'装软件&nbsp;hao123下载站','','','sp'),array(10976,'我爱搜服网','','','sp'),array(10972,'汽车点评','','','sp'),array(10960,'hao123下载站','','','sp'),array(10951,'妈妈网百科','','','sp'),array(10950,'电视&nbsp;百度视频','','','sp'),array(10939,'电视台节目表&nbsp;电视猫','','','sp'),array(10936,'英语四六级&nbsp;新浪教育','','','sp'),array(10927,'电视节目表','','','sp'),array(10916,'电竞职业联赛','','','sp'),array(10902,'电视剧&nbsp;爱奇艺&nbsp;[1－10]','','','sp'),array(10908,'hao123下载站','','','sp'),array(10904,'全国大学英语四六级考试(CET)官方成绩查询','','','sp'),array(10897,'综艺&nbsp;爱奇艺','','','sp'),array(10890,'综艺&nbsp;爱奇艺','','','sp'),array(10886,'爱奇艺','','百度收购','sp'),array(10874,'演员表&nbsp;电视猫','','','sp'),array(10858,'高考分数线&nbsp;新浪高考','','','sp'),array(10846,'作者&nbsp;百度百家','','','sp'),array(10834,'漫客栈','','','sp'),array(10833,'车系&nbsp;汽车点评','','','sp'),array(10832,'商界精英&nbsp;财富中文网','','','sp'),array(10829,'游戏实例&nbsp;178游戏网','','','sp'),array(10827,'高考各省市录取分数线汇总&nbsp;新浪高考','','','sp'),array(10823,'车系&nbsp;汽车点评','','','sp'),array(10815,'平板大全&nbsp;手机中国','','','sp'),array(10814,'邮编查询','','','sp'),array(10809,'多搜服','','','sp'),array(10806,'手机中国','','百度收购','sp'),array(10797,'hao123下载站','','','sp'),array(10794,'电影&nbsp;爱奇艺','','','sp'),array(10793,'88A','','','sp'),array(10792,'快速查询&nbsp;求医网','','','sp'),array(10789,'宜家|百度云图|世界知识产权组织|英雄联盟','','','sp'),array(10788,'亲子百科&nbsp;太平洋亲子网','','','sp'),array(10785,'游久网','','','sp'),array(10784,'齐家装修网','','百度投资','sp'),array(10776,'Mtime时光网','','','sp'),array(10775,'影评、简介及放映时间查询&nbsp;Mtime时光网','','','sp'),array(10764,'高考查分&nbsp;新浪高考','','','sp'),array(10751,'就搜服','','','sp'),array(10750,'开区网','','','sp'),array(10749,'东方卫视','','','sp'),array(10744,'考研分数线查询&nbsp;新浪教育','','','sp'),array(10742,'爱奇艺','','','sp'),array(10738,'售后服务热线&nbsp;天极产品库','','','sp'),array(10723,'考研真题试卷&nbsp;新浪教育','','','sp'),array(10720,'高考院校库&nbsp;新浪教育','','','sp'),array(10716,'英雄&nbsp;要我玩','','','sp'),array(10698,'介绍&nbsp;百度旅游','','','sp'),array(10693,'世界时间&nbsp;百度开放平台','','','sp'),array(10687,'两会直播','','','sp'),array(10685,'电话号码归属地查询','','','sp'),array(10682,'客服电话','','','sp'),array(10678,'基金吧&nbsp;天天基金网','','','sp'),array(10664,'太平洋下载','','','sp'),array(10654,'系统粉','','','sp'),array(10652,'聚合&nbsp;百度百科','','','sp'),array(10650,'新房&nbsp;百度乐居&nbsp;[1－10]','','','sp'),array(10646,'[猜]&nbsp;客船沉没','','','sp'),array(10639,'中国移动客服电话','','','sp'),array(10638,'网易邮箱客服电话&nbsp;[1－3]','','','sp'),array(10634,'太平洋产品报价','','','sp'),array(10610,'百度招聘','','','sp'),array(10597,'排行榜&nbsp;中国校友会网','','','sp'),array(10596,'缺点&nbsp;产品大全&nbsp;手机中国','','','sp'),array(10594,'飞翔游戏','','','sp'),array(10585,'百度爸妈搜索','','','sp'),array(10584,'登录百度统计&nbsp;[1－10]','','','sp'),array(10577,'网页游戏&nbsp;百度游戏','','','sp'),array(10557,'地铁&nbsp;百度地图','','','sp'),array(10553,'星座屋','','','sp'),array(10546,'院校&nbsp;百度教育','','','sp'),array(10543,'AK军事网','','','sp'),array(10530,'药品通&nbsp;39健康网','','','sp'),array(10518,'经销商&nbsp;汽车点评','','','sp'),array(10515,'网页游戏&nbsp;百度游戏&nbsp;[1－10]','','','sp'),array(10505,'hao123下载站','','','sp'),array(10501,'[猜]&nbsp;直播热点话题&nbsp;新浪娱乐','','','sp'),array(10500,'客服是多少&nbsp;百度知道','','','sp'),array(10496,'ZOL产品报价&nbsp;中关村在线','','','sp'),array(10466,'电竞&nbsp;捞月狗','','','sp'),array(10465,'美国综合大学排名&nbsp;院校排行榜&nbsp;zinch中国','','','sp'),array(10458,'豆瓣影评&nbsp;[1－10]','','','sp'),array(10434,'环球军事','','','sp'),array(10422,'[猜]时间轴新闻','','','sp'),array(10417,'考试时间&nbsp;考试吧','','','sp'),array(10396,'[猜]&nbsp;搜狐健康','','','sp'),array(10393,'基于&nbsp;IP&nbsp;地理位置','','','sp'),array(10385,'有道翻译','','','sp'),array(10382,'尾号限行','','','sp'),array(10360,'百度房产','','','sp'),array(10356,'综艺&nbsp;奇艺-百度旗下视频网站&nbsp;[1－10]','','','sp'),array(10351,'hao123下载站','','','sp'),array(10350,'办理签证&nbsp;百度经验','','','sp'),array(10344,'摇号信息查询','','','sp'),array(10342,'据说娱乐','','','sp'),array(10326,'专业录取线&nbsp;中国教育在线','','','sp'),array(10319,'热门视频&nbsp;太平洋游戏网','','','sp'),array(10317,'网易彩票','','','sp'),array(10315,'开奖详情查询&nbsp;网易彩票','','','sp'),array(10313,'综艺&nbsp;爱奇艺&nbsp;[1－10]','','','sp'),array(10306,'资讯&nbsp;网易彩票','','','sp'),array(10301,'热点直播&nbsp;网易;','','','sp'),array(10298,'2014年全年公休假放假安排&nbsp;中国政府网','','放假通知','sp'),array(10270,'天极下载','','','sp'),array(10268,'百度经验【组图】','','','sp'),array(10260,'海外院校库&nbsp;留学&nbsp;百度教育','','','sp'),array(10258,'药品通&nbsp;39健康网','','','sp'),array(10254,'全国猎聘网','','','sp'),array(10249,'药品搜索&nbsp;丁香园','','','sp'),array(10244,'第&nbsp;2&nbsp;种百度经验','','','sp'),array(10240,'[猜]&nbsp;开奖&nbsp;新浪彩票','','','sp'),array(10239,'乐游网','','','sp'),array(10234,'实时大盘票房&nbsp;中国票房网','','','sp'),array(10230,'考研复试分数线(国家线)&nbsp;新浪教育&nbsp;[1－10]','','','sp'),array(10229,'房源信息&nbsp;安居客','','','sp'),array(10223,'QQ分组&nbsp;QQ个性网','','','sp'),array(10220,'基金&nbsp;东方财富网','','','sp'),array(10219,'客服电话&nbsp;[3－4]','','','sp'),array(10218,'QQ个性网','','','sp'),array(10216,'搜服网','','','sp'),array(10215,'车系&nbsp;爱卡汽车','','','sp'),array(10213,'易登网','','','sp'),array(10210,'手机号码归属地查询','','','sp'),array(10208,'腾讯视频','','','sp'),array(10201,'货币基金&nbsp;天天基金网','','','sp'),array(10199,'[猜]&nbsp;医院&nbsp;-&nbsp;悦美整形网','','','sp'),array(10197,'预约加号&nbsp;好大夫在线','','','sp'),array(10183,'时刻表&nbsp;票价&nbsp;同程网','','','sp'),array(10178,'展现多方观点&nbsp;百度知道','','','sp'),array(10175,'找好医院&nbsp;家庭医生在线','','','sp'),array(10169,'风行网','','','sp'),array(10162,'装修效果图大全&nbsp;齐家网','','','sp'),array(10161,'[猜]疾病&nbsp;寻医问药专家网','','','sp'),array(10154,'维修&nbsp;百度知道企业平台','','','sp'),array(10150,'公交查询&nbsp;百度地图','','','sp'),array(10144,'电影影讯&nbsp;百度糯米电影','','','sp'),array(10139,'人民币利率&nbsp;和讯网','','','sp'),array(10137,'人民币汇率&nbsp;和讯网','','','sp'),array(10118,'[猜]&nbsp;开奖&nbsp;hao123彩票','','','sp'),array(10112,'图片&nbsp;理论&nbsp;人民网','','','sp'),array(10096,'走势图&nbsp;体坛网','','','sp'),array(10094,'[猜]&nbsp;开奖结果&nbsp;体坛网','','','sp'),array(10088,'院校排行榜&nbsp;zinch中国','','','sp'),array(10080,'"211"工程大学名单&nbsp;中国教育在线','','','sp'),array(10079,'ABAB开服表','','','sp'),array(10077,'公务员考试真题试卷&nbsp;中公教育','','','sp'),array(10057,'搜狗号码通','','','sp'),array(10041,'汽车之家','','','sp'),array(10023,'英超&nbsp;新浪体育','','','sp'),array(10015,'[猜]&nbsp;时间轴新闻&nbsp;腾讯网|新浪网','','','sp'),array(10013,'广告电话','','','sp'),array(10006,'139邮箱登录','','','sp'),array(8087,'电视剧&nbsp;爱奇艺','','','sp'),array(8067,'星座配对&nbsp;星座屋','','','sp'),array(8058,'校园招聘&nbsp;百度招聘','','','sp'),array(8047,'百度招聘','','','sp'),array(8044,'音乐','','','sp'),array(8041,'中国内地音乐网站聚合','','百度音乐|虾米音乐|QQ音乐|网易云音乐|酷我音乐|一听音乐','sp'),array(8027,'创意礼物攻略&nbsp;礼物说','','','sp'),array(8003,'港股实时行情&nbsp;东方财富网','','','sp'),array(8002,'上证指数&nbsp;东方财富网','','','sp'),array(8000,'贝瓦儿歌','','','sp'),array(7200,'售后服务热线&nbsp;天极产品库','','','sp'),array(7199,'保修信息查询&nbsp;天极产品库','','','sp'),array(7172,'游戏卡牌&nbsp;18183手机游戏网','','','sp'),array(7166,'长途汽车时刻表及票价查询&nbsp;畅途网','','','sp'),array(7156,'售后服务热线&nbsp;赶集网','','','sp'),array(7152,'炉石传说&nbsp;电玩巴士','','','sp'),array(7150,'英雄&nbsp;电玩巴士','','','sp'),array(7148,'推荐医院&nbsp;好大夫在线','','','sp'),array(7136,'就医助手&nbsp;39健康网','','','sp'),array(7127,'百度药品','','','sp'),array(7123,'推荐医院&nbsp;好大夫在线','','','sp'),array(7106,'长途汽车时刻表及票价查询&nbsp;携程','','','sp'),array(7097,'数码系列&nbsp;基于&nbsp;IP&nbsp;地理位置&nbsp;中关村在线','','','sp'),array(7092,'航班信息','','','sp'),array(7091,'ZOL产品报价','','','sp'),array(7087,'赛尔号&nbsp;4399小游戏','','','sp'),array(7086,'4399小游戏','','','sp'),array(7085,'178游戏网','','','sp'),array(7084,'点评&nbsp;中关村在线','','','sp'),array(7083,'图片&nbsp;中关村在线','','','sp'),array(7079,'数码系列&nbsp;中关村在线','','','sp'),array(7076,'详情页&nbsp;中关村在线','','','sp'),array(7074,'菜谱优质结果','','','sp'),array(7072,'洛克王国&nbsp;4399小游戏','','','sp'),array(7068,'约瑟传说&nbsp;4399小游戏','','','sp'),array(7042,'机票票价查询及预订','','','sp'),array(7037,'非连锁酒店&nbsp;去哪儿','','','sp'),array(7033,'车站搜索&nbsp;去哪儿','','','sp'),array(7032,'车次查询&nbsp;去哪儿','','','sp'),array(7031,'电影&nbsp;爱奇艺','','','sp'),array(7027,'物品&nbsp;178游戏网','','','sp'),array(7004,'机票查询&nbsp;去哪儿','','','sp'),array(6899,'全国失信被执行人名单','','','sp'),array(6896,'股票行情&nbsp;东方财富网','','','sp'),array(6895,'新房开盘&nbsp;安居客','','','sp'),array(6887,'百度阅读','','','sp'),array(6884,'启蒙&nbsp;百度应用','','','sp'),array(6883,'小游戏&nbsp;百度应用','','','sp'),array(6882,'汇率换算&nbsp;百度应用','','','sp'),array(6881,'儿歌&nbsp;百度应用','','','sp'),array(6880,'范文&nbsp;百度文库','','','sp'),array(6878,'百度糯米电影购票','','','sp'),array(6876,'模棱两可问答&nbsp;古诗文网','','','sp'),array(6875,'美食&nbsp;知识图谱','','','sp'),array(6873,'公开课&nbsp;知识图谱','','','sp'),array(6870,'法斗士','','','sp'),array(6869,'影视新生态','','','sp'),array(6868,'汽车之家','','','sp'),array(6867,'糖豆网','','','sp'),array(6866,'糖豆网','','','sp'),array(6865,'汽车之家','','','sp'),array(6864,'综艺&nbsp;知识图谱','','','sp'),array(6863,'动漫&nbsp;知识图谱','','','sp'),array(6862,'电影&nbsp;知识图谱','','','sp'),array(6861,'电视剧&nbsp;知识图谱','','','sp'),array(6855,'电话区号','','','sp'),array(6853,'环球兵器库','','','sp'),array(6848,'成语','','','sp'),array(6845,'小说','','','sp'),array(6844,'格言&nbsp;知识图谱','','','sp'),array(6842,'演唱会&nbsp;永乐票务','','','sp'),array(6841,'永乐票务','','','sp'),array(6840,'宠物价格&nbsp;知识图谱&nbsp;赶集网','','','sp'),array(6839,'花鸟鱼虫&nbsp;知识图谱','','','sp'),array(6835,'百度软件中心','','','sp'),array(6833,'百度百科&nbsp;多义词','','','sp'),array(6832,'旅游景点大全','','','sp'),array(6831,'知识图谱&nbsp;百度美食','','','sp'),array(6829,'宠物&nbsp;知识图谱','','','sp'),array(6827,'由于失信已被列入国家失信被执行人名单','','','sp'),array(6826,'该企业已被列入全国失信被执行人名单中！','','','sp'),array(6820,'娱乐节目&nbsp;百度视频','','','sp'),array(6819,'全国法院失信被执行人名单','','','sp'),array(6818,'电视剧&nbsp;百度视频','','','sp'),array(6817,'百度视频','','','sp'),array(6811,'百度音乐','','','sp'),array(6810,'百度知心&nbsp;百度视频','','','sp'),array(6804,'最新报价&nbsp;配置&nbsp;图片&nbsp;口碑&nbsp;油耗&nbsp;易车网','','','sp'),array(6801,'车型&nbsp;-&nbsp;易车网','','','sp'),array(6746,$q.'&nbsp;知识图谱&nbsp;百度百科','','','sp'),array(6735,'site特型','','','sp'),array(6727,'[猜]&nbsp;左侧动漫作品','','','sp'),array(6714,'最佳答案','','','sp'),array(6705,'电视剧榜单','','','sp'),array(6700,'电影&nbsp;-&nbsp;百度团购','','','sp'),array(6691,'歌曲&nbsp;-&nbsp;百度音乐','','','sp'),array(6690,'电影&nbsp;-&nbsp;百度视频','','','sp'),array(6680,'百度购物搜索','','','sp'),array(6677,'网页应用&nbsp;百度阿拉丁','','','sp'),array(6670,'百度团购','','','sp'),array(6666,'百度招聘搜索','','','sp'),array(6665,'百度招聘会搜索','','','sp'),array(6653,'[猜]&nbsp;百度知心最佳答案','','','sp'),array(6112,'[猜]&nbsp;电视剧&nbsp;百度视频','','','sp'),array(6111,'音乐列表&nbsp;百度音乐','','','sp'),array(6018,'日历&nbsp;[1－3]','','','sp'),array(6017,'最新汇率&nbsp;[1－10]','','','sp'),array(6014,'提问到百度知道','','','sp'),array(6012,'诗歌&nbsp;百度百科','','','sp'),array(6011,'百度邮编','','','sp'),array(6010,'音乐分类&nbsp;百度音乐','','','sp'),array(6009,'万年历','','','sp'),array(6007,'计算器','','','sp'),array(6006,'IP地址查询','','','sp'),array(6005,'生僻字组合','','','sp'),array(6004,'手机归属地','','','sp'),array(4070,$q.'&nbsp;单位换算','','','sp'),array(4065,$q.'&nbsp;周公解梦','','','sp'),array(4064,$q.'&nbsp;百度传情','','','sp'),array(4047,$q.'&nbsp;航班时刻表&nbsp;百度知心&nbsp;去哪儿','','','sp'),array(4038,$q.'&nbsp;火车票查询|列车时刻表&nbsp;百度知心&nbsp;去哪儿','','','sp'),array(4036,$q.'&nbsp;英文名字','','','sp'),array(4034,$q.'&nbsp;歇后语&nbsp;模棱两可问答','','','sp'),array(4033,$q.'&nbsp;祝福语&nbsp;模棱两可问答','','','sp'),array(4030,$q.'&nbsp;脑筋急转弯&nbsp;模棱两可问答','','','sp'),array(4028,$q.'&nbsp;模棱两可问答','','','sp'),array(4027,'查询&nbsp;火车票&nbsp;列车时刻表&nbsp;去哪儿网','','','sp'),array(4004,'快递查询&nbsp;快递100','sp','','ec'),array(4002,'单位换算&nbsp;百度阿拉丁','sp','','ec'),array(4001,'快递查询&nbsp;快递100','sp','','ec'),array(1599,'普通','','模版名2数据策略','as'),array(1582,'H5表现','','201512发现','as'),array(1581,'更多同站相关结果','','201412添加','as'),array(1577,$qn.'&nbsp;详情&nbsp;百度学术','sp','[201510发现]','ec'),array(1553,'维基百科','','','as'),array(1552,'百度词典','','201510发现','as'),array(1551,'列表－模版','','201411添加&nbsp;QQ&nbsp;751476','as'),array(1548,'评分&nbsp;结构化','','201408添加','as'),array(1547,$qn.'&nbsp;相关百度百科词条','sp','[201407添加]','ec'),array(1545,'非正规相册','','201412添加&nbsp;QQ&nbsp;1724102740','as'),array(1543,'面包屑&nbsp;结构化','','','as'),array(1542,$qn.'&nbsp;百度学术','sp','','ec'),array(1539,'官网&nbsp;子链','','201405添加','as'),array(1538,'摘要&nbsp;结构化','','','as'),array(1537,$qn.'&nbsp;相关百度经验&nbsp;组图','sp','','ec'),array(1536,'一般答案&nbsp;百度知道','sp','','ec'),array(1533,'论坛帖子','','','as'),array(1532,'最佳答案&nbsp;百度知道','sp','','ec'),array(1531,'查询扩展','','','as'),array(1530,'百度贴吧','','','as'),array(1529,'专业问答网站','','','as'),array(1528,'百度知道','','','as'),array(1527,'百度文库标签','sp','','ec'),array(1526,'百度文库','','','as'),array(1525,'百度文库','','','as'),array(1524,'缩略图结果','','但非每个查询词展现图片','as'),array(1523,'robots.txt&nbsp;存在限制','','','as'),array(1522,'百度经验带相册','','','as'),array(1521,'图片&nbsp;百度百科(与查询词内容相关度较高)','sp','','ec'),array(1520,'期刊文献','','','as'),array(1519,'维基百科&nbsp;国际化','','','as'),array(1518,'软件下载&nbsp;国际化','','','as'),array(1517,'[图文]','','但并非每个查询词显示&nbsp;[图文]','as'),array(1516,'宗教&nbsp;国际化','','','as'),array(1515,'电影&nbsp;国际化','','','as'),array(1514,'在线文档&nbsp;结构化','','','as'),array(1513,'软件下载&nbsp;结构化','','','as'),array(1512,'单视频&nbsp;国际化','','','as'),array(1511,'[原创]','','星火计划','as'),array(1510,'子链&nbsp;国际化','','','as'),array(1509,'[官网]','','通常在 1－2 位','as'),array(1508,'单视频&nbsp;站点','','','as'),array(1507,'微博','','','as'),array(1506,'单视频','','','as'),array(1505,'百度知道&nbsp;高品质','','知道达人|权威专家|官方机构','as'),array(1504,'自动问答','','','as'),array(1503,'图片&nbsp;单视频','','','as'),array(1502,'百度百科','','','as'),array(1501,'评分&nbsp;结构化','','','as'),array(1500,'无','','','as'),array(400,'百度图片','','','sp'),array(101,'[猜]&nbsp;沙盒保护','sp','','ec'),array(91,'百度百科','','多义词','sp'),array(85,'百度翻译|百度词典','','多义词','sp'),array(81,'百度百科_多义词','','','sp'),array(80,'百度百科专有名词','','','sp'),array(43,'去百度知道提问','sp','','ec'),array(37,$qn.'&nbsp;最新图像','sp','','ec'),array(34,$qn.'&nbsp;最新微博结果','sp','','ec'),array(23,$qn.'&nbsp;百度翻译','sp','','ec'),array(21,$qn.'&nbsp;新&nbsp;百度学术','sp','20151109上线','ec'),array(19,$qn.'&nbsp;最新相关消息','sp','','ec'),array(10,'百度贴吧','','','sp'),array(5,$qn.'&nbsp;百度音乐','sp','','ec'),array(4,$qn.'&nbsp;百度图片','sp','','ec'),array(1,$qn.'&nbsp;百度视频','sp','','ec'));
$np=array('/(http:\/\/29302_life-hunshasheying.left.vs-static.baidu.com)/','/(http:\/\/29521_life-hunshasheying.left.vs-static.baidu.com)/','/(http:\/\/29520_life-hunshasheying.left.vs-static.baidu.com)/','/(http:\/\/29141left.car.vs-static.baidu.com)/','/(http:\/\/common2-insurance.left.vs-static.baidu.com)/','/(http:\/\/loan-guide.left.vs-static.baidu.com)/','/(http:\/\/29307_life-hunshasheying.left.vs-static.baidu.com)/','/(http:\/\/plastic-price.health.vs-static.baidu.com)/','/(http:\/\/29271.health.vs-static.baidu.com)/','/(http:\/\/29159.vs-static.baidu.com)/','/(http:\/\/common-insurance.left.vs-static.baidu.com)/','/(http:\/\/chinajoy.vs-static.baidu.com)/','/(http:\/\/zdm.baidu.com\/search\/\?q=)/','/(http:\/\/shifeianswer.health.vs-static.baidu.com\/)/','/(http:\/\/29145left.car.vs-static.baidu.com)/','/(http:\/\/jiancha.health.vs-static.baidu.com)/','/(http:\/\/29301_life-hunshasheying.left.vs-static.baidu.com)/','/(http:\/\/web_game_left.vs-static.baidu.com)/','/(http:\/\/29158.vs-static.baidu.com)/','/(http:\/\/vs-small-loan.left.vs-static.baidu.com)/','/(http:\/\/pc.health.29283.disease-static.baidu.com)/','/(http:\/\/car-insurance.left.vs-static.baidu.com)/','/(http:\/\/credit-card.left.vs-static.baidu.com)/','/(http:\/\/web_game_top.vs-static.baidu.com)/','/(http:\/\/shenghuo.baidu.com\/vsp)/','/(http:\/\/29146left.car.vs-static.baidu.com)/','/(http:\/\/29144left.car.vs-static.baidu.com)/','/(http:\/\/29142left.car.vs-static.baidu.com)/','/(http:\/\/kgb.baidu.com)/','/(http:\/\/mall-guotai.left.vs-static.baidu.com)/','/(http:\/\/vs-wealth.left.vs-static.baidu.com)/','/(http:\/\/askdoctor.health.vs-static.baidu.com)/','/(http:\/\/web_game_left_ranklist.vs-static.baidu.com)/','/(http:\/\/kgb.baidu.com)/','/(http:\/\/publichospital.health.vs-static.baidu.com)/','/(http:\/\/27018_aladdin.baidu.com\/src27018\/)/','/(http:\/\/plastic.health.vs-static.baidu.com)/','/(http:\/\/qaen.health.vs-static.baidu.com)/','/(http:\/\/med.structuralWenda.health.vs-static.baidu.com)/','/(http:\/\/qa.health.vs-static.baidu.com)/','/(http:\/\/symptomfilteranswer.health.vs-static.baidu.com\/)/','/(http:\/\/symptomanswer.health.vs-static.baidu.com\/)/','/(http:\/\/disease2.health.vs-static.baidu.com)/','/(http:\/\/disease.health.vs-static.baidu.com)/','/(http:\/\/med.symptom.health.vs-static.baidu.com)/','/(http:\/\/vs-static.baidu.com\/shangmao\/[a-z]{2}\d{2}-dr-vsarch-ui\d{2}.[a-z]{2}\d{2}.baidu.com)/','/(http:\/\/privatehospital.health.vs-static.baidu.com)/','/(http:\/\/foodsearch.health.vs-static.baidu.com)/','/(http:\/\/nourl.ubs.baidu.com\/291228)/','/(http:\/\/fakeurl.baidu.com\/xueshu)/','/(http:\/\/29163.baidu.com)/','/(http:\/\/29154.baidu.com)/','/(http:\/\/29153.baidu.com)/','/(http:\/\/29134.baidu.com)/','/(http:\/\/29127.baidu.com)/','/(http:\/\/nourl.ubs.baidu.com\/29311)/','/(http:\/\/nourl.ubs.baidu.com\/29116)/','/(http:\/\/nourl.ubs.baidu.com\/29115)/','/(http:\/\/nourl.ubs.baidu.com\/29114)/','/(http:\/\/tsm.nuomi.com\/28027\/)/','/(http:\/\/tsm.nuomi.com\/28026\/)/','/(http:\/\/tsm.nuomi.com\/28025\/)/','/(http:\/\/jiaoyu.baidu.com)/','/(http:\/\/fanyi.baidu.com)/','/(http:\/\/chess_card_game_left.vs-static.baidu.com)/');
$nr=array('//hunqing.baidu.com/hunshapic/index?key='.$q,'//hunqing.baidu.com/hunshasheying/index?key='.$q,'//hunqing.baidu.com/hunlicehua/index?key='.$q,'//car.baidu.com/index?key='.$q,'//caifu.baidu.com/insurance?category=1102&wd='.$q,'//caifu.baidu.com/insuranceGuide/search?key='.$q,'//hunqing.baidu.com/hunyan/index?key='.$q,'//jiankang.baidu.com/Plastic/search?wd='.$q,'//jiankang.baidu.com/juhe/index?wd='.$q,'//iwan.baidu.com/search?searchquery='.$q,'//caifu.baidu.com/insurance?wd='.$q,'//iwan.baidu.com/cj2015/','//zdm.baidu.com/?keyword=','//jiankang.baidu.com/wenda/search?from=29260&key='.$q,'//car.baidu.com/tehui?wd='.$q,'//jiankang.baidu.com/Search?wd='.$q,'//hunqing.baidu.com/hunshasheying?key='.$q,'//iwan.baidu.com/yeyou?query='.$q,'//iwan.baidu.com/wangyou/live','//caifu.baidu.com/loan?wd='.$q,'//jiankang.baidu.com/jibing/card?wd='.$q,'//caifu.baidu.com/insurance?category=1105&wd='.$q,'//caifu.baidu.com/card?wd='.$q,'//iwan.baidu.com/yeyou?query='.$q,'//shenghuo.baidu.com/banjia?wd='.$q,'//car.baidu.com/tehui?wd='.$q,'//car.baidu.com/assess?wd='.$q,'//car.baidu.com/?wd='.$q,'//dict.baidu.com/s?wd='.$q,'//caifu.baidu.com/trade/finance/stocks?wd='.$q,'//caifu.baidu.com/wealth?wd='.$q,'//jiankang.baidu.com/wenda/search?wd='.$q,'//iwan.baidu.com/search?searchquery='.$q,'//baike.baidu.com/search?word='.$q,'//jiankang.baidu.com/juhe/index?key='.$q,'//sou.autohome.com.cn/zonghe?q=','//jiankang.baidu.com/Plastic/search?key='.$q,'//jiankang.baidu.com/jibing/card?wd='.$q,'//jiankang.baidu.com/wenda/mining?key='.$q,'//jiankang.baidu.com/wenda/search?key='.$q,'//muzhi.baidu.com/ask','//jiankang.baidu.com/wenda/search?key='.$q,'//jiankang.baidu.com/jibing/card?key='.$q,'//jiankang.baidu.com/jibing/card?key='.$q,'//jiankang.baidu.com/jibing/card?key='.$q,'//shangmao.baidu.com/caigou/index?key='.$q,'//jiankang.baidu.com/juhe/index?aType=1&amp;wd='.$q,'//jiankang.baidu.com/Food/search?key='.$q,'//temai.baidu.com/Index/index?wd='.$q,'//xueshu.baidu.com/s?wd='.$q,'//iwan.baidu.com/search?searchquery='.$q,'//iwan.baidu.com/singlegame?psquery='.$q,'//iwan.baidu.com/mobilegame','//iwan.baidu.com/search?searchquery='.$q,'//iwan.baidu.com/search?searchquery='.$q,'//temai.baidu.com/Index/index?wd='.$q,'//temai.baidu.com/Index/index?wd='.$q,'//temai.baidu.com/Index/index?wd='.$q,'//temai.baidu.com/Index/index?wd='.$q,'//www.nuomi.com/search?ie=gbk&amp;k=','//www.nuomi.com/search?ie=gbk&amp;k=','//www.nuomi.com/?ie=gbk&amp;channel_content=','//jiaoyu.baidu.com/query/juhe?originQuery='.$q,'//fanyi.baidu.com/#auto/zh/'.$q,'//iwan.baidu.com/qipai');
            foreach ($n as $i => $v) {
                foreach ($src as $h => $v) {
                    if (@$n[$i][0] == $src[$h][0]) {
                        $nn[$i] = $src[$h];
                        break;
                    }
                }
                if (@$n[$i][0] == @$nn[$i][0] && @$nn[$i][4] == 'as') {
                    echo '
                <tr class="back-white">
                    <td><a href="'.$n[$i][3].'" title="'.wc(stripslashes(htmlspecialchars_decode($n[$i][1], ENT_QUOTES))).'"'.$nof.str_replace($pp, $rp, stripslashes($n[$i][1])).'</a>';
                    if (strlen(@$mabs[3][0]) > 0 && ($nn[$i][0] == 1599 || $nn[$i][0] == 1553 || $nn[$i][0] == 1548 || $nn[$i][0] == 1543 || $nn[$i][0] == 1539 || $nn[$i][0] == 1538 || $nn[$i][0] == 1533 || $nn[$i][0] == 1530 || $nn[$i][0] == 1529 || $nn[$i][0] == 1528 || $nn[$i][0] == 1526 || $nn[$i][0] == 1525 || $nn[$i][0] == 1524 || $nn[$i][0] == 1514 || $nn[$i][0] == 1511 || $nn[$i][0] == 1509 || $nn[$i][0] == 1505 || $nn[$i][0] == 1501 || $nn[$i][0] == 1581)) {
                        echo '<br><span class="tiny">'.str_replace($pp, $rp, strtolower(strip_tags($mabs[3][@$jj + 0]))).'</span>';
                        @$jj += 1;
                    }
                    echo '&nbsp;&nbsp;<span class="tiny" title="模板&nbsp;'.$n[$i][4].'">'.$nn[$i][1].'</span></td>
                </tr>';
                    unset($n[$i]);
                }
                elseif (@$n[$i][0] == @$nn[$i][0] && @$nn[$i][4] == 'sp') {
                    echo '
                <tr class="back-egg">
                    <td><a href="';
                    if ($nn[$i][0] == 8041) {
                        echo '//music.163.com/#/search/m/?s='.$q;
                    }
                    elseif ($nn[$i][0] == 6006) {
                        echo '//www.ip138.com/ips138.asp?ip='.$n[$i][1];
                    }
                    else {
                        echo $n[$i][3];
                    }
                    echo '" title="'.$nn[$i][4].'&nbsp;模板&nbsp;'.$n[$i][4].'&nbsp;'.$n[$i][0].'"'.$nof.$n[$i][1].'&nbsp;'.$nn[$i][1].'</a></td>
                </tr>';
                    unset($n[$i]);
                }
                elseif (@$n[$i][0] == @$nn[$i][0] && @$nn[$i][2] == 'sp') {
                    if ($osp == 'on' || ($oas != 'on' && $osp != 'on' && $oec != 'on')) {
                        echo '
                <tr class="back-egg">
                    <td><a href="'.preg_replace($np, $nr, $n[$i][3]).'" title="sp&nbsp;模板&nbsp;'.$n[$i][4].'&nbsp;'.$n[$i][0].'"'.$nof.$nn[$i][1].'</a></td>
                </tr>';
                    }
                    unset($n[$i]);
                }
                elseif (@$n[$i][0] == @$nn[$i][0] && @$nn[$i][4] == 'ec') {
                    if ($oec == 'on' || ($oas != 'on' && $osp != 'on' && $oec != 'on')) {
                        echo '
                <tr class="back-orange">
                    <td><a href="'.preg_replace($np, $nr, $n[$i][3]).'" title="'.$nn[$i][4].'&nbsp;模板&nbsp;'.$n[$i][4].'&nbsp;'.$n[$i][0].'"'.$nof.$nn[$i][1].'</a></td>
                </tr>';
                    }
                    unset($n[$i]);
                }
                if (@$n[$i] != null) {
                    echo '
                <tr class="back-azure">
                    <td title="模板&nbsp;'.$n[$i][4].'&nbsp;'.$n[$i][0].'">未收进资源库</td>
                </tr>';
                }
            }
            echo '
            </tbody>
        </table>
    </div>';
        }
    }

    if (@$mn[0] != 0 && @$rn == null&& @$of != 'on' && @$oal != 'on' || (@$mn[0] != 0 && @$of == 'on' && @$os == 'on' && @$pn == null && @$rn == null && @$oal != 'on')) {
        echo '
        <div>
        <table>
            <thead><tr><th colspan="4">相关推荐</th></tr></thead>
            <tbody>';

        if (preg_match_all("/(?<=&rs_src=[01]{1}&rsv_pq=[a-z0-9]{16}&rsv_t=)([\w\%]{50,64}\">)([\x80-\xff\w\s\.#\:\/\+\-&;]{0,32})(?=<\/a><\/th><)/", @$se, $mrt)) {
            if (strlen(@$mrt[2][0]) > 0) {
                $c = curl_init();
                curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($c, CURLOPT_HEADER, 0);
                curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 1);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($c, CURLOPT_TIMEOUT, 1);
                curl_setopt($c, CURLOPT_URL, 'https://suggest.taobao.com/sug?code=utf-8&q='.$q);
                $sugtb = json_decode(curl_exec($c), 1);
                curl_close($c);
                if (isset($sugtb['result'][0][0])) {
                    foreach ($sugtb['result'] as $i => $v) {
                        $stb[$i] = $sugtb['result'][$i][0];
                    }
                }
                else {
                    $stb = array();
                }
                $rstb = array_merge($mrt[2], $stb);
                $rst = array_unique($rstb);
                shuffle($rst);
                $mtp = array('/(\s+)/', '/(&amp;)/');
                $mtr = array('%20', '%26');
                foreach ($rst as $i => $v) {
                    if ($i % 4 == 0) {
                        echo '<tr class="break back-azure">';
                    }
                    echo '
                <td><a itemprop="url" href="'.$u.$l.str_replace($pp, $rp, preg_replace($mtp, $mtr, $rst[$i])).'" target="_blank">'.str_replace($pp, $rp, $rst[$i]).'</a></td>';
                    $i++;
                    if ($i % 4 == 0) {
                        echo '
                </tr>';
                    }
                }
                if ($i % 4 == 3) {
                    echo '
                <td></td>
                </tr>';
                }
                elseif ($i % 4 == 2) {
                    echo '
                <td></td>
                <td></td>
                </tr>';
                }
                elseif ($i % 4 == 1) {
                    echo '
                <td></td>
                <td></td>
                <td></td>
                </tr>';
                }
            }
        }

        if (preg_match_all('/(?<=<\/div><div class="c-gap-top c-recommend" style="display:none;" data-extquery=")(.+)(?="><i class="c-icon c-icon-bear-circle c-gap-right-small">)/', @$se, $mq)) {
            if (!is_null(@$mq)) {
                foreach ($mq as $v) {
                    $v = join('&nbsp;', $v);
                    $temp[] = $v;
                }
                $kz = explode('&nbsp;', str_replace('&nbsp;&nbsp;', '&nbsp;', $temp[0]));
                $kk = array_unique($kz);
                array_pop($kk);
                shuffle($kk);
                foreach ($kk as $i => $v) {
                    if ($i % 4 == 0) {
                        echo '<tr class="break back-sky">';
                    }
                    echo '
                <td><a itemprop="url" href="'.$u.$l.str_replace($pp, $rp, preg_replace($mp, $mr, $kk[$i])).'" target="_blank">'.str_replace($pp, $rp, $kk[$i]).'</a></td>';
                    $i++;
                    if ($i % 4 == 0) {
                        echo '
                </tr>';
                    }
                }
                if ($i % 4 == 3) {
                    echo '
                <td></td>
                </tr>';
                }
                elseif ($i % 4 == 2) {
                    echo '
                <td></td>
                <td></td>
                </tr>';
                }
                elseif ($i % 4 == 1) {
                    echo '
                <td></td>
                <td></td>
                <td></td>
                </tr>';
                }
            }
        }
        echo '</tbody>
        </table>
    </div>
';
    }

    if (@$mn[0] != 0 && @$of == 'on' && @$oal != 'on' || (@$os != 'on' && @$oal != 'on' && isset($se))) {
        if ((!isset($bk['card']) && !isset($lrc['title']) && !isset($tte[0])) || @$pn != null || @$rn != null) {
            if (preg_match_all("/(?<=F':)(\s?')([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})(?=',)/", $se, $f)) {
                if (strlen(@$f[0][0]) > 0) {
                    echo '    <div class="draglist tiny"><table><thead><tr><th title="搜索结果标题|摘要与查询词的语义关联度">出自</th><th>近似词</th><th>猜&nbsp;正规性</th><th>权威性</th><th>5</th><th title="百度搜索结果参数F第6位基于IP地理位置">地理位置</th><th>网址</th><th>标题|网址|摘要</th><th>F0</th></tr></thead><tbody class="center">';
                    foreach ($f[2] as $i => $v) {
                        echo '<tr>';
                        if ($f[2][$i] == 7) {echo '<td class="darkseagreen" title="7">略</td>';}
                        elseif ($f[2][$i] == 'F') {echo '<td class="lightskyblue" title="F">穿透</td>';}
                        elseif ($f[2][$i] == 5) {echo '<td class="lavender" title="5">中</td>';}
                        else {echo '<td class="violet" title="3">高</td>';}
                        if ($f[3][$i] == 7) {echo '<td class="darkseagreen" title="7">略</td>';}
                        elseif ($f[3][$i] == 3) {echo '<td class="violet" title="3">近似词</td>';}
                        else {echo '<td class="lightskyblue" title="F">多义词</td>';}
                        if ($f[4][$i] == 8) {echo '<td class="mediumpurple" title="8">略</td>';}
                        elseif ($f[4][$i] == 'A') {echo '<td class="aquamarine" title="A">分类信息&nbsp;|&nbsp;猜&nbsp;非正规</td>';}
                        elseif ($f[4][$i] == 2) {echo '<td class="orange" title="2">下载</td>';}
                        else {echo '<td class="honeydew" title="0">影音书籍游戏软件</td>';}
                        if ($f[5][$i] == 3) {echo '<td class="violet" title="3">略</td>';}
                        elseif ($f[5][$i] == 'F') {echo '<td class="lightskyblue" title="F">快</td>';}
                        elseif ($f[5][$i] == 'B') {echo '<td class="springgreen" title="B">较快</td>';}
                        else {echo '<td class="darkseagreen" title="7">中</td>';}
                        echo $f[6][$i] == 1 ? '<td class="gold" title="1">略</td>' : '<td class="violet" title="3">最新资讯</td>';
                        if ($f[7][$i] == 7) {echo '<td class="darkseagreen" title="7">略</td>';}
                        elseif ($f[7][$i] == 5) {echo '<td class="lavender" title="5">基于&nbsp;IP&nbsp;地理位置</td>';}
                        else {echo '<td class="violet" title="3">猜&nbsp;不基于&nbsp;IP&nbsp;地理位置更换结果<br>但进入目标网站自会选择地域</td>';}
                        if ($f[8][$i] == 'E') {echo '<td class="deepskyblue" title="E">略</td>';}
                        elseif ($f[8][$i] == 'F') {echo '<td class="lightskyblue" title="F, “以下是网页中包含xxxx的结果”之上的结果">精确匹配</td>';}
                        else {echo '<td class="aquamarine">A</td>';}
                        if ($f[9][$i] == 'A') {echo '<td class="aquamarine" title="A">精确匹配</td>';}
                        elseif ($f[9][$i] == 'B') {echo '<td class="springgreen" title="B">同义词</td>';}
                        elseif ($f[9][$i] == 9) {echo '<td class="burlywood">9</td>';}
                        else {echo '<td class="mediumpurple" title="8">部分匹配</td>';}
                        echo '<td class="back-pink">'.$msr[2][$i].'</td></tr>';
                    }
                    echo '</tbody></table></div>';
                }
            }
            if (preg_match_all("/(?<=F1':)(\s?')([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})(?=',)/", $se, $f1)) {
                if (strlen(@$f1[0][0]) > 0) {
                    echo '
    <div class="draglist tiny"><table><thead><tr><th>1</th><th>2</th><th>时间限制</th><th>猜&nbsp;实时动态</th><th>5</th><th>相关检索词</th><th>泛时效性</th><th>8</th><th>F1</th></tr></thead><tbody class="center">';
                    foreach ($f1[2] as $i => $v) {
                        echo '<tr>';
                        if ($f1[2][$i] == 9) {echo '<td class="burlywood" title="9">略</td>';}
                        elseif ($f1[2][$i] == 'D') {echo '<td class="mediumseagreen">D</td>';}
                        else {echo '<td class="springgreen" title="B">百度文库</td>';}
                        if ($f1[3][$i] == 'D') {echo '<td class="mediumseagreen" title="D">略</td>';}
                        elseif ($f1[3][$i] == 9) {echo '<td class="burlywood" title="9">猜&nbsp;匹配多个关键词</td>';}
                        else {echo '<td class="lavender" title="5">猜&nbsp;布尔匹配</td>';}
                        if ($f1[4][$i] == 7) {echo '<td class="darkseagreen" title="7">略</td>';}
                        elseif ($f1[4][$i] == 6) {echo '<td class="silver" title="6&nbsp;0－24小时前更新快照&nbsp;yyyy年MM月dd日|hh小时前|mm分钟前|ss秒前">1天内</td>';}
                        elseif ($f1[4][$i] == 5) {echo '<td class="lavender" title="5&nbsp;24－48小时前更新快照&nbsp;yyyy年MM月dd日">1－2天前</td>';}
                        else {echo '<td class="tomato" title="4&nbsp;2－7天前前更新快照&nbsp;yyyy年MM月dd日">2－7天前</td>';}
                        if ($f1[5][$i] == 3) {echo '<td class="violet" title="3">略</td>';}
                        elseif ($f1[5][$i] == 2) {echo '<td class="orange" title="2">24小时内多家同时报道</td>';}
                        else {echo '<td class="honeydew" title="0">24小时内独家</td>';}
                        if ($f1[6][$i] == 'F') {echo '<td class="lightskyblue" title="F">略</td>';}
                        elseif ($f1[6][$i] == 'E') {echo '<td class="deepskyblue" title="E">低</td>';}
                        else {echo '<td class="springgreen" title="B">百度知道</td>';}
                        if ($f1[7][$i] == 1) {echo '<td class="gold" title="1">略</td>';}
                        elseif ($f1[7][$i] == 0) {echo '<td class="honeydew" title="0&nbsp;早先其他人还搜索的相关热门内容">老热门内容</td>';}
                        elseif ($f1[7][$i] == 3) {echo '<td class="violet" title="3&nbsp;中期其他人还搜索的相关热门内容">中热门内容</td>';}
                        else {echo '<td class="lavender" title="5&nbsp;最新其他人还搜索的相关热门内容">新热门内容</td>';}
                        if ($f1[8][$i] == 'E') {echo '<td class="deepskyblue" title="E">略</td>';}
                        elseif ($f1[8][$i] == 'C') {echo '<td class="darkturquoise" title="C">调权</td>';}
                        elseif ($f1[8][$i] == 6) {echo '<td class="silver" title="6">低</td>';}
                        else {echo '<td class="tomato" title="4">较低</td>';}
                        echo $f1[9][$i] == 4 ? '<td class="tomato" title="4">略</td>' : '<td class="silver">6</td>';
                        echo '<td class="back-yellow">'.$msr[2][$i].'</td></tr>';
                    }
                    echo '</tbody></table></div>';
                }
            }
            if (preg_match_all("/(?<=F2':)(\s?')([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})(?=',)/", $se, $f2)) {
                if (strlen(@$f2[0][0]) > 0) {
                    echo '
    <div class="draglist tiny"><table><thead><tr><th>url</th><th>2</th><th>3</th><th>4</th><th>5</th><th>摘要</th><th>前标题</th><th>后标题</th><th>F2</th></tr></thead><tbody class="center">';
                    foreach ($f2[2] as $i => $v) {
                        echo '<tr>';
                        if ($f2[2][$i] == 4) {echo '<td class="tomato" title="4">略</td>';}
                        elseif ($f2[2][$i] == 'C') {echo '<td class="darkturquoise" title="C">归一化</td>';}
                        elseif ($f2[2][$i] == 8) {echo '<td class="mediumpurple" title="8">中</td>';}
                        else {echo '<td class="silver" title="6">搜索结果与查询词广度相关</td>';}
                        if ($f2[3][$i] == 'C') {echo '<td class="darkturquoise" title="C">略</td>';}
                        elseif ($f2[3][$i] == 'E') {echo '<td class="deepskyblue" title="E">猜&nbsp;搜索结果展现网址与目标网址不同</td>';}
                        elseif ($f2[3][$i] == 'D') {echo '<td class="mediumseagreen">D</td>';}
                        else {echo '<td class="mediumpurple" title="8">百度贴吧</td>';}
                        if ($f2[4][$i] == 'A') {echo '<td class="aquamarine" title="A">略</td>';}
                        elseif ($f2[4][$i] == 'E') {echo '<td class="deepskyblue">E</td>';}
                        elseif ($f2[4][$i] == 8) {echo '<td class="mediumpurple">8</td>';}
                        else {echo '<td class="gold" title="2">标语<br>slogan</td>';}
                        echo $f2[5][$i] == 6 ? '<td class="silver" title="6">略</td>' : '<td class="darkseagreen" title="7">猜&nbsp;使用百度排名点击器(搜easy)出现</td>';
                        echo $f2[6][$i] == 'D' ? '<td class="mediumseagreen" title="D">略</td>' : '<td class="darkturquoise">C</td>';
                        if ($f2[7][$i] == 'D') {echo '<td class="mediumseagreen" title="D">略</td>';}
                        elseif ($f2[7][$i] == 'F') {echo '<td class="lightskyblue" title="F">人工提交</td>';}
                        elseif ($f2[7][$i] == 'E') {echo '<td class="deepskyblue" title="E">正文</td>';}
                        else {echo '<td class="darkturquoise" title="C">元描述</td>';}
                        echo $f2[8][$i] == 6 ? '<td class="silver" title="6">略</td>' : '<td class="deepskyblue" title="E&nbsp;anchortext">锚文本</td>';
                        if ($f2[9][$i] == 'A') {echo '<td class="aquamarine" title="A">略</td>';}
                        elseif ($f2[9][$i] == 'B') {echo '<td class="springgreen" title="B&nbsp;tagtitle">网页标题</td>';}
                        elseif ($f2[9][$i] == 8) {echo '<td class="mediumpurple" title="8&nbsp;url">网址</td>';}
                        elseif ($f2[9][$i] == 'E') {echo '<td class="deepskyblue" title="E&nbsp;headline">大字标题</td>';}
                        else {echo '<td class="lightskyblue" title="F&nbsp;headline&nbsp;-&nbsp;title">大字标题&nbsp;-&nbsp;网页标题</td>';}
                        echo '<td class="back-green">'.$msr[2][$i].'</td></tr>';
                    }
                    echo'</tbody></table></div>';
                }
            }
            if (preg_match_all("/(?<=F3':)(\s?')([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})([0-9A-F]{1})(?=',)/", $se, $f3)) {
                if (strlen(@$f3[0][0]) > 0) {
                    echo '
    <div class="draglist tiny"><table><thead><tr><th>1</th><th>2</th><th>3</th><th>原创</th><th>猜&nbsp;网址形式</th><th>6</th><th>相关词</th><th>猜&nbsp;相似度</th><th>F3</th></tr></thead><tbody class="center">';
                    foreach ($f3[2] as $i => $v) {
                        echo '<tr>';
                        echo $f3[2][$i] == 5 ? '<td class="lavender" title="5">略</td>' : '<td class="mediumseagreen">D</td>';
                        echo '<td class="tomato" title="4">略</td>';
                        echo $f3[4][$i] == 'E' ? '<td class="deepskyblue" title="E">略</td>' : '<td class="lightskyblue">F</td>';
                        if ($f3[5][$i] == 5) {echo '<td class="lavender" title="5">略</td>';}
                        elseif ($f3[5][$i] == 7) {echo '<td class="darkseagreen" title="7">挖掘原创</td>';}
                        elseif ($f3[5][$i] == 6) {echo '<td class="silver">6</td>';}
                        elseif ($f3[5][$i] == 3) {echo '<td class="violet" title="3">原创</td>';}
                        elseif ($f3[5][$i] == 2) {echo '<td class="orange" title="2">原创</td>';}
                        elseif ($f3[5][$i] == 1) {echo '<td class="gold" title="1">原创</td>';}
                        else {echo '<td class="honeydew" title="0">原创&nbsp;|&nbsp;最高</td>';}
                        if ($f3[6][$i] == 2) {echo '<td class="orange" title="2">主页次优先&nbsp;|&nbsp;子页内容充实</td>';}
                        elseif ($f3[6][$i] == 'B') {echo '<td class="springgreen" title="B">子页优先级较高</td>';}
                        elseif ($f3[6][$i] == 'A') {echo '<td class="aquamarine" title="A">主页高优先&nbsp;|&nbsp;子页内容充实</td>';}
                        elseif ($f3[6][$i] == 6) {echo '<td class="violet">6</td>';}
                        elseif ($f3[6][$i] == 3) {echo '<td class="violet" title="3">子页优先级较低</td>';}
                        elseif ($f3[6][$i] == 1) {echo '<td class="gold">1</td>';}
                        else {echo '<td class="honeydew">0</td>';}
                        if ($f3[7][$i] == 4) {echo '<td class="tomato" title="4">略</td>';}
                        elseif ($f3[7][$i] == 'C') {echo '<td class="darkturquoise">C</td>';}
                        elseif ($f3[7][$i] == 6) {echo '<td class="silver">6</td>';}
                        elseif ($f3[7][$i] == 2) {echo '<td class="orange">2</td>';}
                        else {echo '<td class="honeydew" title="0">有同义词的搜索结果页<br>完全匹配查询词</td>';}
                        if ($f3[8][$i] == 3) {echo '<td class="violet" title="3">略</td>';}
                        elseif ($f3[8][$i] == 2) {echo '<td class="orange">召回</td>';}
                        else {echo '<td class="gold">1</td>';}
                        if ($f3[9][$i] == 'F') {echo '<td class="lightskyblue" title="F">精确匹配</td>';}
                        elseif ($f3[9][$i] == 'E') {echo '<td class="deepskyblue" title="E">近义词匹配</td>';}
                        elseif ($f3[9][$i] == 'D') {echo '<td class="mediumseagreen">D</td>';}
                        elseif ($f3[9][$i] == 'C') {echo '<td class="darkturquoise">C</td>';}
                        elseif ($f3[9][$i] == 7) {echo '<td class="darkseagreen" title="7">匹配网址</td>';}
                        elseif ($f3[9][$i] == 6) {echo '<td class="silver">6</td>';}
                        elseif ($f3[9][$i] == 5) {echo '<td class="lavender" title="5">近似匹配</td>';}
                        else {echo '<td class="tomato">4</td>';}
                        echo '<td class="back-blue">'.$msr[2][$i].'</td></tr>';
                    }
                    echo '</tbody></table></div>
';
                }
            }
        }
    }

    if (@$mn[0] == 0 && $crawl > 0) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_HEADER, 0);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($c, CURLOPT_TIMEOUT, 2);
        curl_setopt($c, CURLOPT_PROXY, @$px[7]);
        curl_setopt($c, CURLOPT_URL, 'http://entry.baidu.com/rp/home?di=1000059&rsi0=666&title='.$q);
        $ard = curl_exec($c);
        curl_close($c);
        if (preg_match_all('/(?<={"title":")(.{1,24})(?=","displayType":"","recommtype":")/', $ard, $mar)) {
            echo '
    <table><thead><tr><th colspan="4" class="topr">为您推荐</th></tr></thead>
        <tbody>';
            foreach ($mar[0] as $i => $v) {
                if ($i % 4 == 0) {
                    echo '<tr class="back-azure">';
                }
                echo '
            <td><a itemprop="url" href="'.$u.$l.preg_replace('/(\s+)/', '%20', $mar[0][$i]).'" target="_blank">'.$mar[0][$i].'</a></td>';
                $i++;
                if ($i % 4 == 0) {
                    echo '
            </tr>';
                }
            }
            if (count($mar[0]) % 4 == 1)  {
                echo '
            <td></td>
            <td></td>
            <td></td>
            </tr>';
            }
            elseif (count($mar[0]) % 4 == 2)  {
                echo '
            <td></td>
            <td></td>
            </tr>';
            }
            elseif (count($mar[0]) % 4 == 3)  {
                echo '
            <td></td>
            </tr>';
            }
            echo '</tbody>
    </table>
';
        }
    }

    if (@$mn[0] != 0 && $crawl > 2) {
        $pni = array(750, 740, 730, 720, 50, 40, 30, 20, 10);
        echo '    <table class="center back-white btnr"><tbody><tr>';
        if ($pn + 1 > 10) {
            echo '
        <td><a href="'.$u.'?s='.$q.'&amp;pn='.(floor($pn / 10) * 10 - 10).'">&lt;</a></td>';
        }
        foreach ($pni as $i => $v) {
            if ($pn + 1 > $pni[$i]) {
                echo '
        <td><a href="'.$u.'?s='.$q.'&amp;pn='.(floor($i + ($pn / 10) - 8) * 10 - 10).'">'.floor(($i * 10 + $pn - 80) / 10) .'</a></td>';
            }
        }
        foreach ($pni as $i => $v) {
            if ($pn < $pni[$i]) {
                echo '
        <td><a href="'.$u.'?s='.$q.'&amp;pn='.(floor($i + ($pn / 10) + 2) * 10 - 10).'">'.floor(($i * 10 + $pn + 20) / 10) .'</a></td>';
            }
        }
        if ($pn < 750) {
            echo '
        <td><a href="'.$u.'?s='.$q.'&amp;pn='.(floor(($pn / 10) + 2) * 10 - 10).'">'.'&gt;</a></td>';
        }
        echo '
    </tr></tbody></table>
';
    }
}

echo '    <div class="header center non">
        <form method="get" action="'.$u.'">
            <a itemprop="url" href="'.$u.'" rel="nofollow"><canvas id="myCanvas" width="52" height="26">no canvas</canvas></a>
            <script>var canvas=document.getElementById("myCanvas");if(canvas.getContext){var ctx=canvas.getContext("2d");ctx.font="22px Helvetica Neue";ctx.fillStyle="#FF6347";ctx.fillText("搜索",0,24);};</script>
            <input class="text" type="text" value="'.substr(htmlspecialchars(@$_GET['s'], ENT_QUOTES), 0, 128).'" name="s" autocomplete="off" maxlength="76" id="sug" placeholder="请输入查询词" onmouseover="this.focus()" onfocus="this.select()"';
if (strlen($s) > 0) {
    echo '>
';
}
else {
    echo ' autofocus="autofocus">
';
}
echo '            <input class="other" type="number" name="pn" title="从第几位开始取结果" min="0" max="750" value="'.htmlspecialchars(@$_GET['pn'] ,ENT_QUOTES).'" placeholder="取第几位" onmouseover="this.focus()" onfocus="this.select()">
            <input class="other" type="number" name="rn" title="搜索结果数量" min="0" max="50" value="'.htmlspecialchars(@$_GET['rn'] ,ENT_QUOTES).'" placeholder="返回数量" onmouseover="this.focus()" onfocus="this.select()">
            <input class="submit rr" type="submit" value="搜索一下"><br>';
if (strlen($s) > 0) {
    $chk = '" checked="checked" value="on';
    echo '
            <span class="white">
                <input type="checkbox" name="oas';
    if (@$_GET['oas'] == 'on') {
        echo  $chk;
    }
    echo '">普通结果
                <input type="checkbox" name="osp';
    if (@$_GET['osp'] == 'on') {
        echo  $chk;
    }
    echo '">阿拉丁
                <input type="checkbox" name="oec';
    if (@$_GET['oec'] == 'on') {
        echo  $chk;
    }
    echo '">商业知心
                <input type="checkbox" name="pr';
    if (@$_GET['pr'] == 'on') {
        echo  $chk;
    }
    echo '" title="默认关闭">PR
                <input type="checkbox" name="osr';
    if (@$_GET['osr'] == 'on') {
        echo  $chk;
    }
    echo '">隐藏结果
                <input type="checkbox" name="oab';
    if (@$_GET['oab'] == 'on') {
        echo  $chk;
    }
    echo '">隐藏摘要
                <input type="checkbox" name="os';
    if (@$_GET['os'] == 'on') {
        echo  $chk;
    }
    echo '">推荐
                <input type="checkbox" name="of';
    if (@$_GET['of'] == 'on') {
        echo  $chk;
    }
    echo '">F
                <input type="checkbox" name="oal';
    if (@$_GET['oal'] == 'on') {
        echo  $chk;
    }
    echo '">隐藏
            </span>';
}
echo '
        </form>
    </div>
    <div class="header center dis">
        <form method="get" action="'.$u.'">
            <input class="text" type="text" id="js-in" value="'.substr(htmlspecialchars(@$_GET['s'], ENT_QUOTES), 0, 128).'" name="s" autocomplete="off" maxlength="76" su="1" placeholder="请输入查询词" onmouseover="this.focus()" onfocus="this.select()"';
if (strlen($s) > 0) {
    echo '>
            <span style="margin-left:-4em;cursor:pointer" onclick="clearInput()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X&nbsp;&nbsp;&nbsp;&nbsp;</span>
';
}
else {
    echo ' autofocus="autofocus">
';
}
echo '            <input class="submit rr" type="submit" value="搜索一下">
        </form>
    </div>
</div>
<div class="right_outer">
    <div class="right_inner">
        <div class="right rr break">';

if (strlen($s) > 0) {
    if ($crawl > 1) {
        if (isset($su[1][0])) {
            foreach ($su[1] as $i => $v) {
                echo '<hr>
                <a itemprop="url" href="'.$u.$l.str_replace($pp, $rp, preg_replace($mp, $mr, $su[1][$i])).'" target="_blank">'.str_replace($pp, $rp, $su[1][$i]).'</a>';
            }
        }
        else {
            echo '';
        }
    }

    if (!isset($rn)) {
        $tp = ob_get_contents();
        ob_end_clean();
        echo $tp;
        file_put_contents($stk.md5(urlencode($q).$pn), $tp);
        if (isset($mar[0][0]) || filesize($stk.md5(urlencode($q).$pn)) < 9999) {
            unlink($stk.md5(urlencode($q).$pn));
        }
    }
}
echo $ft;
