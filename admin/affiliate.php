<?php

/**
 * 烽火微信分销代理系统 版本号v H1.0
 *火一五信息科技有限公司
 *主营业务：网站建设、手机app开发、应用软件开发、SEO网络优化、竞价排名以及计算机电路、软件设计
 *网址：www.huo15.com
 *联系方式：15288986891 18765270751
 *QQ : 3186355915
*/

define('IN_ECTOUCH', true);
require(dirname(__FILE__) . '/includes/init.php');
admin_priv('affiliate');
$config = get_affiliate();
//huo15 获取代理级别信息
$dealer_level = get_dealer_level();

/*------------------------------------------------------ */
//-- 分成管理页
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    assign_query_info();
    if (empty($_REQUEST['is_ajax']))
    {
        $smarty->assign('full_page', 1);
    }

    $smarty->assign('ur_here', $_LANG['affiliate']);
    $smarty->assign('config', $config);
    $smarty->assign('dealer_level', $dealer_level);
    $smarty->display('affiliate.htm');
}
elseif ($_REQUEST['act'] == 'query')
{
    $smarty->assign('ur_here', $_LANG['affiliate']);
    $smarty->assign('config', $config);
    make_json_result($smarty->fetch('affiliate.htm'), '', null);
}
/*------------------------------------------------------ */
//-- 增加下线分配方案
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'add')
{
	$caption = trim($_REQUEST['caption']);
	$id = trim($_REQUEST['id']);
	$config = $dealer_level[$caption];
    if (count($config['item']) < 10)
    {
        //下线不能超过10层
        $_REQUEST['discount'] = (float)$_REQUEST['discount'];
        $_REQUEST['agent_num'] = intval($_REQUEST['agent_num']);
       
        $maxpoint  = 100;
        $minmoney = 0;
        if ($_REQUEST['discount'] <= 0 || $_REQUEST['discount'] > 100) {
        	$_REQUEST['discount'] = $maxpoint;
        }
        if ( $_REQUEST['agent_num'] <= 0) {
        	$_REQUEST['agent_num'] = $minmoney;
        }
        if ($_REQUEST['number'] <= 0) {
        	$_REQUEST['number'] = 1;
        }
        $items = array('discount'=>$_REQUEST['discount'],'agent_num'=>$_REQUEST['agent_num'], 'number'=>$_REQUEST['number'], 'name'=>$_REQUEST['name']);
        $links[] = array('text' => $_LANG['affiliate'], 'href' => 'affiliate.php?act=list');
        $config['item'][] = $items;
        $config['on'] = 1;
        $config['config']['separate_by'] = 0;
        $dealer_level[$caption] = $config;
        put_dealer_level($dealer_level);
       // ecs_header("Location: affiliate.php?act=list\n");
       // echo '<script>alert("添加成功！");window.history.goback(-1); </script>';
        $links[0]['text'] = $GLOBALS['_LANG']['go_back'];
        $links[0]['href'] = 'affiliate.php?act=list';
        sys_msg('添加成功！', 0, $links);
        exit;
    }
    else
    {
       make_json_error($_LANG['level_error']);
    }

    ecs_header("Location: affiliate.php?act=list\n");
    exit;
}
/*------------------------------------------------------ */
//-- 修改配置
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'updata')
{

    $separate_by = (intval($_POST['separate_by']) == 1) ? 1 : 0;

    $_POST['expire'] = (float) $_POST['expire'];
    $_POST['level_point_all'] = (float)$_POST['level_point_all'];
    $_POST['level_money_all'] = (float)$_POST['level_money_all'];
    $_POST['level_money_all'] > 100 && $_POST['level_money_all'] = 100;
    $_POST['level_point_all'] > 100 && $_POST['level_point_all'] = 100;

    if (!empty($_POST['level_point_all']) && strpos($_POST['level_point_all'],'%') === false)
    {
        $_POST['level_point_all'] .= '%';
    }
    if (!empty($_POST['level_money_all']) && strpos($_POST['level_money_all'],'%') === false)
    {
        $_POST['level_money_all'] .= '%';
    }
    $_POST['level_register_all'] = intval($_POST['level_register_all']);
    $_POST['level_register_up'] = intval($_POST['level_register_up']);
    $temp = array();
    $temp['config'] = array('expire'                => $_POST['expire'],        //COOKIE过期数字
                            'expire_unit'           => $_POST['expire_unit'],   //单位：小时、天、周
                            'separate_by'           => $separate_by,            //分成模式：0、注册 1、订单
                            'level_point_all'       =>$_POST['level_point_all'],    //积分分成比
                            'level_money_all'       =>$_POST['level_money_all'],    //金钱分成比
                            'level_register_all'    =>$_POST['level_register_all'], //推荐注册奖励积分
                            'level_register_up'     =>$_POST['level_register_up']   //推荐注册奖励积分上限
          );
    $temp['item'] = $config['item'];
    $temp['on'] = 1;
    put_affiliate($temp);
    $links[] = array('text' => $_LANG['affiliate'], 'href' => 'affiliate.php?act=list');
    sys_msg($_LANG['edit_ok'], 0 ,$links);
}
/*------------------------------------------------------ */
//-- 推荐开关
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'on')
{

    $on = (intval($_POST['on']) == 1) ? 1 : 0;

    $config['on'] = $on;
    put_affiliate($config);
    $links[] = array('text' => $_LANG['affiliate'], 'href' => 'affiliate.php?act=list');
    sys_msg($_LANG['edit_ok'], 0 ,$links);
}
/*------------------------------------------------------ */
//-- Ajax修改设置
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit_point')//Huo15 折扣率
{

    /* 取得参数 */
    $key = trim($_POST['id']);
    $val = (float)trim($_POST['val']);
    $caption = trim($_POST['caption']);
    $maxpoint = 100;
    $config = $dealer_level[$caption];
    $temp_config = array();
    foreach ($config['item'] as $k => $v)
    {
    	//make_json_result($v['agent_num']);
        if ($k != $key)
        {
            $temp_config[] = $v;
        }
        if ($k == $key) {
        	if ($val <=100 && $val >0) {
        		
        		$v['discount'] = $val;
        		$temp_config[] = $v;
        	} else  {
        		$v['discount'] = $maxpoint;
        		$val = $maxpoint;
        		$temp_config[] = $v;
        	}
        	
        }
    }
    $dealer_level[$caption]['item'] = $temp_config;
     $dealer_level[$caption]['on'] = 1;
   // put_affiliate($config);
   put_dealer_level($dealer_level);
    make_json_result(stripcslashes($val));
}
/*------------------------------------------------------ */
//-- Ajax修改设置
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit_name')//修改名称
{
	$key = trim($_POST['id']);
	$val = trim($_POST['val']);
	$caption = trim($_POST['caption']);
	
	$config = $dealer_level[$caption];
	$temp_config = array();
	foreach ($config['item'] as $k => $v)
	{
		//make_json_result($v['agent_num']);
		if ($k != $key)
		{
			$temp_config[] = $v;
		}
		if ($k == $key) {

				$v['agent_name'] = $val;
				$temp_config[] = $v;
			
			 
		}
	}
	p($_POST);die;
	$dealer_level[$caption]['item'] = $temp_config;
	$dealer_level[$caption]['on'] = 1;
	// put_affiliate($config);
	put_dealer_level($dealer_level);
	make_json_result(stripcslashes($val));
}
/*------------------------------------------------------ */
//-- Ajax修改设置
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit_number')//每箱个数
{
    $key = trim($_POST['id']);
    $val = (float)trim($_POST['val']);
    $caption = trim($_POST['caption']);
    $minmoney = 0;
    $config = $dealer_level[$caption];
    $temp_config = array();
 	foreach ($config['item'] as $k => $v)
    {
    	//make_json_result($v['agent_num']);
        if ($k != $key)
        {
            $temp_config[] = $v;
        }
        if ($k == $key) {
        	if ($val > 0) {
        		
        		$v['agent_num'] = $val;
        		$temp_config[] = $v;
        	} else  {
        		$v['agent_num'] = $minmoney;
        		$val = $minmoney;
        		$temp_config[] = $v;
        	}
        	
        }
    }
    $dealer_level[$caption]['item'] = $temp_config;
    $dealer_level[$caption]['on'] = 1;
    // put_affiliate($config);
    put_dealer_level($dealer_level);
    make_json_result(stripcslashes($val));
}


/*------------------------------------------------------ */
//-- 删除下线分成
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'del')
{
    //$key = trim($_GET['id']) - 1;
    $level_caption = trim($_GET['caption']);
    $level_id = trim($_GET['id']);
    //unset($config['item'][$key]);
    unset($dealer_level[$level_caption]['item'][$level_id]);
    $temp = array();
    /*
    foreach ($config['item'] as $key => $val)
    {
        $temp[] = $val;
    }
    $config['item'] = $temp;
    $config['on'] = 1;
    $config['config']['separate_by'] = 0;
    put_affiliate($config);
    */
    $agent_config = $dealer_level[$level_caption];
    
    foreach ($agent_config['item'] as $key => $val)
    {
    	$temp[] = $val;
    }
    $agent_config['item'] = $temp;
    $agent_config['on'] = 1;
    $agent_config['config']['separate_by'] = 0;
    //put_affiliate($config);
    $dealer_level[$level_caption] = $agent_config;
    put_dealer_level($dealer_level);
    
    ecs_header("Location: affiliate.php?act=list\n");
    exit;
}

function get_affiliate()
{
    $config = unserialize($GLOBALS['_CFG']['affiliate']);
    empty($config) && $config = array();

    return $config;
}


function put_affiliate($config)
{
    $temp = serialize($config);
    $sql = "UPDATE " . $GLOBALS['ecs']->table('touch_shop_config') .
           "SET  value = '$temp'" .
           "WHERE code = 'affiliate'";
    $GLOBALS['db']->query($sql);
    clear_all_files();
}

/**
 * Huo15 更新代理商级别数据
 * @param array $config
 */

function put_dealer_level($config)
{
	$temp = serialize($config);
	$sql = "UPDATE " . $GLOBALS['ecs']->table('touch_shop_config') .
	"SET  value = '$temp'" .
	"WHERE code = 'dealer_level'";
	if ($GLOBALS['db']->query($sql)) {
		clear_all_files();
		
	} else {
		echo '更新失败';
		die;
	}
	
}
?>