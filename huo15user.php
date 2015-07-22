<?php

/**
 * 烽火微信分销代理系统 版本号v H1.0
 *火一五信息科技有限公司
 *主营业务：网站建设、手机app开发、应用软件开发、SEO网络优化、竞价排名已经计算机电路、软件设计
 *网址：www.huo15.com
 *联系方式：15288986891 18765270751
 *QQ : 3186355915
 */
define('IN_ECTOUCH', true);

require(dirname(__FILE__) . '/include/init.php');
require(ROOT_PATH . 'include/lib_weixintong.php');
include_once(ROOT_PATH . 'include/lib_transaction.php');
require(ROOT_PATH . 'include/lib_order.php');
require_once "js-sdk/php/jssdk.php";
$jssdk = new JSSDK("wxf436d575fbedb88e", "233e8b3cb572a5ac3a38672227ff6cf9");

/* 载入语言文件 */
require_once(ROOT_PATH . 'lang/' .$_CFG['lang']. '/user.php');
$user_id = $_SESSION['user_id'];
$action  = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : 'default';

$back_act='';

// 不需要登录的操作或自己验证是否登录（如ajax处理）的act
$not_login_arr =
array('yq','login','act_login','register','act_register','act_edit_password','get_password','send_pwd_email','send_pwd_sms','password', 'signin', 'add_tag',
		'collect', 'return_to_cart', 'logout', 'email_list', 'validate_email', 'send_hash_mail', 'order_query', 'is_registered', 'check_email','clear_history','qpassword_name',
		'get_passwd_question', 'check_answer', 'oath', 'oath_login');

/* 显示页面的action列表 */
$ui_arr = array('register', 'login', 'profile','dianpu', 'act_dianpu', 'order_list', 'order_detail', 'order_tracking', 'address_list', 'act_edit_address', 'collection_list',
		'message_list', 'tag_list', 'get_password', 'reset_password', 'booking_list', 'add_booking', 'account_raply',
		'account_deposit', 'account_log', 'account_detail', 'act_account', 'pay', 'default', 'bonus', 'group_buy', 'group_buy_detail', 'affiliate', 'comment_list','validate_email','track_packages', 'transform_points','qpassword_name', 'get_passwd_question', 'check_answer','point','user_card','fenxiao1','myorder','myorder_detail','fenxiao2','fenxiao3','fenxiao4');
/* 未登录处理 */
if (empty($_SESSION['user_id']))
{
	if (!in_array($action, $not_login_arr))
	{
		if (in_array($action, $ui_arr))
		{
			/* 如果需要登录,并是显示页面的操作，记录当前操作，用于登录后跳转到相应操作
			 if ($action == 'login')
			 {
			 if (isset($_REQUEST['back_act']))
			 {
			 $back_act = trim($_REQUEST['back_act']);
			 }
			 }
			 else
			 {}*/
			if (!empty($_SERVER['QUERY_STRING']))
			{
				$back_act = 'user.php?' . strip_tags($_SERVER['QUERY_STRING']);
			}
			$action = 'login';
		}
		else
		{
			//未登录提交数据。非正常途径提交数据！
			die($_LANG['require_login']);
		}
	}
}

//垂直业务，添加订单
if ($action == 'user_add_order') {
	include_once('include/cls_json.php');
	$json = new JSON();
	$res = array('err_msg' => '', 'result' => '', 'order_id' => '');
	//插入数组
	$field_values = array();
	if (isset($_POST['order_sn'])) {
		$field_values['wx'] = json_str_iconv(trim($_POST['wx']));
		$field_values['order_sn'] = json_str_iconv(trim($_POST['order_sn']));
		$field_values['consignee'] = json_str_iconv(trim($_POST['consignee']));
		$field_values['mobile'] = json_str_iconv(trim($_POST['mobile']));
		$field_values['country'] = json_str_iconv(trim($_POST['country']));
		$field_values['province'] = json_str_iconv(trim($_POST['province']));
		$field_values['city'] = json_str_iconv(trim($_POST['city']));
		$field_values['district'] = json_str_iconv(trim($_POST['district']));
		$field_values['address'] = json_str_iconv(trim($_POST['address']));
		$field_values['postscript'] = json_str_iconv(trim($_POST['postscript']));
		$field_values['agent_parent_id'] = json_str_iconv(trim($_SESSION['user_id']));
		$field_values['add_time'] = time();
		$field_values['pay_status'] = 2;
		$field_values['order_status'] = 5;
		$field_values['shipping_status'] = 1;
		$field_values['shipping_id'] = 1;
	}
	$sql = "select COUNT(*) from " . $ecs->table('huo15_order_info') . " where order_sn = '" . $field_values['order_sn'] . "'";
	$insertOk = !$db->getOne($sql);
	
	if ($insertOk) {
		if ($db->autoExecute($ecs->table('huo15_order_info'), $field_values)) {
			$res['err_msg'] = "添加订单成功！";
			$res['result'] = 1;
			die($json->encode($res));
		}
	} else {
		if ($db->autoExecute($ecs->table('huo15_order_info'), $field_values, 'update', " order_sn = '" . $field_values['order_sn'] . "'")) {
			$res['err_msg'] = "更新订单成功！";
			$res['result'] = 2;
			die($json->encode($res));
		}
	}
	
	
	
	
}

/* 垂直业务添加订单商品操作  火一五信息科技 */
elseif ($action == 'add_goods_done')
{
	include_once('include/cls_json.php');
	$json = new JSON();
	$res = array('err_msg' => '', 'result' => '', 'order_id' => '');
	if (isset($_POST['good0'])) {
		$temp = array();
		foreach ($_POST as $k => $v) {
				
			if (preg_match('/good/', $k)) {
				$v['goods_id'] = json_str_iconv(trim($v['goods_id']));
				$v['goods_name'] = json_str_iconv(trim($v['goods_name']));
				$v['order_sn'] = json_str_iconv(trim($v['order_sn']));
				$v['goods_number'] = json_str_iconv(trim($v['goods_num']));
				//$v['user_id'] = json_str_iconv(trim($v['user_id']));
				$sql = "select order_id from " . $ecs->table('huo15_order_info') . " where order_sn = '" . $v['order_sn'] . "'";
				$v['order_id'] = $db->getOne($sql);
					
				$temp[] = $v;
			}
				
				
		}
	}
	$huo15_order_goods = $temp;
	//$huo15_order_goods = agent_priceAndMinNum($temp, $temp[0]['user_id'], $ecs, $db);
	$field_values = array();
	foreach ($huo15_order_goods as $k => $v) {
		$field_values['order_id'] = $v['order_id'];
		$field_values['goods_id'] = $v['goods_id'];
		$field_values['goods_name'] = $v['goods_name'];
		$field_values['goods_number'] = $v['goods_number'];
		//$field_values['goods_price'] = $v['agent_price'];
		$field_values['goods_id'] = $v['goods_id'];
		$field_values['is_real'] = 1;
		$sql = "select COUNT(*) from " . $ecs->table('huo15_order_goods') . " where goods_id = " . $field_values['goods_id'] . " and order_id = " . $field_values['order_id'];
		$is_ok = $db->getOne($sql);
		if (!$is_ok) {
			if (!$db->autoExecute($ecs->table('huo15_order_goods'), $field_values)) {
				$res['err_msg'] = "添加订单失败，请重试！";
				$res['result'] = 0;
				die($json->encode($res));
			}
		} else {
			$sql = "select goods_number from " . $ecs->table('huo15_order_goods') . " where goods_id = " . $field_values['goods_id'] . " and order_id = " . $field_values['order_id'];
			$nums = $db->getOne($sql);
			$field_values['goods_number'] = $field_values['goods_number'] + $nums;
			$where = "goods_id = ". $field_values['goods_id'] . " and order_id = " . $field_values['order_id'];
			if (!$db->autoExecute($ecs->table('huo15_order_goods'), $field_values, 'update', $where)) {
				$res['err_msg'] = "添加订单失败，请重试！";
				$res['result'] = 0;
				die($json->encode($res));
			}
		}


	}
	//更新订单金额
	
	/* $sql = "select goods_number, goods_price from " . $ecs->table('huo15_order_goods') . " where order_id = " . $huo15_order_goods[0]['order_id'];
	$arr = $db->getAll($sql);
	$total = 0;
	foreach ($arr as $k => $v) {
		$total += floatval($v['goods_number']) * floatval($v['goods_price']);
	} 
	$sql = "update " . $ecs->table('huo15_order_info') . " set goods_amount = " . $total . " where order_id = " . $huo15_order_goods[0]['order_id'];
	$db->query($sql);*/
	$res['err_msg'] = "提交订单成功！";
	$res['result'] = 1;
	$res['order_id'] = $huo15_order_goods[0]['order_id'];
	die($json->encode($res));
}

/* 扫码发货 huo15 */
elseif ($action == 'order_scan')
{

	$signPackage = $jssdk->GetSignPackage();

	$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
	$ajax = isset($_GET['ajax']) ? intval($_GET['ajax']) : 0;

	$sql = "SELECT order_id,order_sn,invoice_no,shipping_id FROM " .$ecs->table('huo15_order_info').
	"  WHERE  order_id = ".$order_id;
	$orders = $db->getRow($sql);
	
	//获取订单商品数目
	$sql = "select SUM(goods_number) from " . $ecs->table('huo15_order_goods') . " where order_id = " . $order_id;
	$goodsNumber = $db->getOne($sql);
	$smarty->assign('goodsNumber', $goodsNumber);
	//获取已经发货数目
	$sql = "select COUNT(*) from " . $ecs->table('huo15_instance') . " where no_order like  '%U" . $order_id . "%'";
	$shipedNumber = $db->getOne($sql);
	$smarty->assign('shipedNumber', $shipedNumber);

	if ($shipedNumber == $goodsNumber) {
		$sql = "update " . $ecs->table('huo15_order_info') . " set is_ship_ok = 1  where order_id = " . $order_id;
		if (!$db->query($sql)) {
			show_message('数据出错，请联系火一五信息科技技术人员，QQ：645612509');
		}

		

	}

	$signPackage = $jssdk->GetSignPackage();

	$smarty->assign('signPackage', $signPackage);
	
	$smarty->assign('huo15_order_id',      $order_id);
	$smarty->assign('huo15action',      'order_scan');
	$smarty->display('user_transaction_huo15.dwt');
}


/* 扫码发货 huo15 */
elseif ($action == 'huo15_shipping')
{
	$user_id = $_SESSION['user_id'];
	if (!$user_id) {
		die('请先登录再操作！');
	}
	$order_id = isset($_POST['order_id']) ? trim($_POST['order_id']) : 0;

	//获取订单商品ID , good_id
	$sql = "select goods_id from " . $ecs->table('huo15_order_goods') . " where order_id = " . $order_id;
	$arrGoodsId = $db->getAll($sql);
	$count_no = 0;
	//获取订单商品数目
	$sql = "select SUM(goods_number) from " . $ecs->table('huo15_order_goods') . " where order_id = " . $order_id;
	$goodsNumber = $db->getOne($sql);

	//获取已经发货数目
	$sql = "select COUNT(*) from " . $ecs->table('huo15_instance') . " where no_order like  '%U" . $order_id . "%'";
	$shipedNumber = $db->getOne($sql);
	if ($shipedNumber == $goodsNumber) {
		$sql = "update " . $ecs->table('huo15_order_info') . " set is_ship_ok = 1 where order_id = " . $order_id;
		if (!$db->query($sql)) {
			show_message('数据出错，请联系火一五信息科技技术人员，QQ：645612509');
		}
		$sql = "update " . $ecs->table('huo15_order_info') . " set is_ship_num_ok = 1 where order_id = " . $order_id;
		if (!$db->query($sql)) {
			show_message('数据出错，请联系火一五信息科技技术人员，QQ：645612509');
		}
	}
	foreach ($_POST as $k => $v) {
		if ($k == 'order_id') {
			$order_id = trim($v);

		} elseif ($k != 'toJSONString') {
				
			$huo15NO = substr($v, 0, 1);
				
			if($huo15NO == "C") {//箱码

				//获取数据库编码箱子
				$no_case = ltrim(substr($v, -6, 6), '0');
				//获取对应箱子的订单单号
				$sql = "select no_order from " . $ecs->table('huo15_instance') . " where no_case = ".$no_case." limit 1";
				$query_no_order = $db->getOne($sql);
				//获取对应的商品ID
				$sql = "select good_id from " . $ecs->table('huo15_instance') . " where no_case = ".$no_case." limit 1";
				$CaseGoodsId = $db->getOne($sql);

				$okInsert = false;
				foreach ($arrGoodsId as $gi) {
					if ($gi['goods_id'] == $CaseGoodsId) {
						$okInsert = true;
					}
				}

				if ($okInsert) {
					//判断是否存在了订单
					if (!preg_match('/U'.$order_id.'/', $arr['no_order'])) {
						//每箱个数
						$sql = "select COUNT(*) from " . $ecs->table('huo15_instance') . " where no_case = " .$no_case;
							
						$nn = $db->getOne($sql);
						if (($shipedNumber + $nn) > $goodsNumber) {
							die("N");
						}
						$field_values['no_order'] = $query_no_order .'U' . $order_id . ',';
						if (!$db->autoExecute($ecs->table('huo15_instance'), $field_values, 'UPDATE', 'no_case = '.$no_case)) {
							die('N');exit;
						} else {
								
							$count_no = $count_no + $nn;
						}
					}
				}

			} else {//普通编码
				//获取普通编码的ID号


				$no_id = ltrim(substr($v, -6, 6), '0');
				//获取数据库编码箱子，订单单号
				$sql = "select no_case, no_order from " . $ecs->table('huo15_instance') . " where id = " . $no_id;
				$arr = $db->getRow($sql);
				//获取对应的商品ID
				$sql = "select good_id from " . $ecs->table('huo15_instance') . " where id = ".$no_id." limit 1";
				$CaseGoodsId = $db->getOne($sql);
				$okInsert = false;

				foreach ($arrGoodsId as $gi) {
					if ($gi['goods_id'] == $CaseGoodsId) {
						$okInsert = true;
					}
				}

				if ($okInsert) {
					//判断是否存在了订单
						
					if (!preg_match('/U'.$order_id.'/', $arr['no_order'])) {
						$field_values['no_order'] = $arr['no_order'] . 'U' . $order_id . ',';
						if (($shipedNumber + 1) > $goodsNumber) {
							die("N");
						}
						if (!$db->autoExecute($ecs->table('huo15_instance'), $field_values, 'UPDATE', 'id = '.$no_id)) {
							die('N');
						} else {
							$count_no ++;
						}
					}
				}


			}
		}
	}

	

	//获取订单商品数目
	$sql = "select SUM(goods_number) from " . $ecs->table('huo15_order_goods') . " where order_id = " . $order_id;
	$goodsNumber = $db->getOne($sql);

	//获取已经发货数目
	$sql = "select COUNT(*) from " . $ecs->table('huo15_instance') . " where no_order like  '%U" . $order_id . "%'";
	$shipedNumber = $db->getOne($sql);

	if ($shipedNumber == $goodsNumber) {
		$sql = "update " . $ecs->table('huo15_order_info') . " set is_ship_ok = 1  where order_id = U" . $order_id;
		if (!$db->query($sql)) {
			show_message('数据出错，请联系火一五信息科技技术人员，QQ：645612509');
		}
	}
	//发货成功标示
	die('{"goodsNumber" : "' . $goodsNumber . '", "shipedNumber" : "'.$shipedNumber.'", "count" : "'. $count_no .'"}');




}




/* 查看垂直业务订单列表 火一五信息科技 */
elseif ($action == 'user_order_list')
{
	
	include_once(ROOT_PATH . 'include/lib_transaction.php');
	if (!$user_id) {
		show_message('请先登录，再进行订单处理！', '返回登录页面', "user.php");
	}

	$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
	$record_count = $db->getOne("SELECT COUNT(*) FROM " .$ecs->table('order_info'). " WHERE user_id = '$user_id'");
	$pager  = get_pager('huo15user.php', array('act' => 'user_order_list'), $record_count, $page);
	
	/* $condition = array(
			'pay_status' => 0
			
	);
	$orders = get_agent_orders_condition($user_id,$condition, $pager['size'], $pager['start']);
	 */
	$merge  = get_user_merge($user_id);
	$smarty->assign('merge',  $merge);
	$smarty->assign('pager',  $pager);
	$smarty->assign('orders', $orders);
	$smarty->assign('action', 'huo15_order_list');
	$smarty->assign('flag', 'user_order_list');
	$smarty->display('user_transaction_huo15.dwt');

}

/* 查看垂直业务 扫码未完结 订单列表 火一五信息科技 */
elseif ($action == 'user_scan_list')
{

	include_once(ROOT_PATH . 'include/lib_transaction.php');
	if (!$user_id) {
		show_message('请先登录，再进行订单处理！', '返回登录页面', "user.php");
	}

	$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
	$record_count = $db->getOne("SELECT COUNT(*) FROM " .$ecs->table('order_info'). " WHERE user_id = '$user_id'");
	$pager  = get_pager('huo15user.php', array('act' => 'user_order_list'), $record_count, $page);

	/* $condition = array(
	 'pay_status' => 0
	 	
	);
	$orders = get_agent_orders_condition($user_id,$condition, $pager['size'], $pager['start']);
	*/
	$merge  = get_user_merge($user_id);
	$smarty->assign('merge',  $merge);
	$smarty->assign('pager',  $pager);
	$smarty->assign('orders', $orders);
	$smarty->assign('action', 'huo15_order_list');
	$smarty->assign('flag', 'user_scan_list');
	$smarty->display('user_transaction_huo15.dwt');

}
/* 查看垂直业务 已发货 订单列表 火一五信息科技 */
elseif ($action == 'user_end_list')
{

	include_once(ROOT_PATH . 'include/lib_transaction.php');
	if (!$user_id) {
		show_message('请先登录，再进行订单处理！', '返回登录页面', "user.php");
	}

	$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
	$record_count = $db->getOne("SELECT COUNT(*) FROM " .$ecs->table('order_info'). " WHERE user_id = '$user_id'");
	$pager  = get_pager('huo15user.php', array('act' => 'user_order_list'), $record_count, $page);

	/* $condition = array(
	 'pay_status' => 0
	  
	);
	$orders = get_agent_orders_condition($user_id,$condition, $pager['size'], $pager['start']);
	*/
	$merge  = get_user_merge($user_id);
	$smarty->assign('merge',  $merge);
	$smarty->assign('pager',  $pager);
	$smarty->assign('orders', $orders);
	$smarty->assign('action', 'huo15_order_list');
	$smarty->assign('flag', 'user_end_list');
	$smarty->display('user_transaction_huo15.dwt');

}
/* huo15异步显示订单列表 by zhaobo */
elseif ($action == 'agent_async_order_list')
{
	include_once(ROOT_PATH . 'include/lib_transaction.php');

	$start = $_POST['last'];
	$limit = $_POST['amount'];
	
	//垂直订单列表 全部
	if (preg_match('/user_order_list/', $_GET['flag'])) {
		$condition = array(
				'pay_status' => 2,
				'order_status' => 5,
				//'is_ship_ok'   => 1
		);
		$huo15_order_list = 1;
		$orders = get_iuser_orders2($user_id, $limit, $start, $condition);


	}
	//垂直订单扫码未完结列表
	elseif (preg_match('/user_scan_list/', $_GET['flag'])) {
		$condition = array(
				'pay_status' => 2,
				'order_status' => 5,
				'is_ship_ok'   => 0
		);
		$huo15_order_list = 1;
		$orders = get_iuser_orders2($user_id, $limit, $start, $condition);
	
	
	}
	//垂直订单已经发货列表
	elseif (preg_match('/user_end_list/', $_GET['flag'])) {
		$condition = array(
				'pay_status' => 2,
				'order_status' => 5,
				'is_ship_ok'   => 1
		);
		$huo15_order_list = 1;
		$orders = get_iuser_orders2($user_id, $limit, $start, $condition);
	
	
	}
	else {
		$orders = get_agent_orders($user_id, $limit, $start);
	}

	if(is_array($orders)){
		foreach($orders as $vo){
			//获取订单第一个商品的图片
			$img = $db->getOne("SELECT g.goods_thumb FROM " .$ecs->table('huo15_order_goods'). " as og left join " .$ecs->table('goods'). " g on og.goods_id = g.goods_id WHERE og.order_id = ".$vo['order_id']." limit 1");
			$tracking = ($vo['shipping_id'] > 0) ? '<a href="huo15user.php?act=order_scan&order_id='.$vo['order_id'].'" class="c-btn3">扫码发货</a>':'';
			$asyList[] = array(
					'order_status' => '订单状态：'.$vo['order_status'],
					'order_handler' => $vo['handler'],
					'order_content' => '<a href="huo15user.php?act=agent_order_detail&order_id='.$vo['order_id'].'"><table width="100%" border="0" cellpadding="5" cellspacing="0" class="ectouch_table_no_border">
            <tr>
                <td><img src="'.$config['site_url'].$img.'" width="50" height="50" /></td>
                <td>订单编号：'.$vo['order_sn'].'<br>
                下单时间：'.$vo['order_time'].'</td>
                <td style="position:relative"><span class="new-arr"></span></td>
            </tr>
          </table></a>',
					'order_tracking' => $tracking
			);
		}
	}
	echo json_encode($asyList);
}


/* 查看订单详情 */
elseif ($action == 'agent_order_detail')
{
	include_once(ROOT_PATH . 'include/lib_transaction.php');
	include_once(ROOT_PATH . 'include/lib_payment.php');
	include_once(ROOT_PATH . 'include/lib_order.php');
	include_once(ROOT_PATH . 'include/lib_clips.php');
	$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
	
	/* 订单详情 */
	//$order = get_order_detail($order_id, $user_id);
	$order = get_user_order_detail($order_id, $user_id);
	//p($order['order_status']);p($order['pay_status']);p($order['shipping_status']);die;
	/* 取得能执行的操作列表 */
	
	$operable_list = operable_list($order);

	$smarty->assign('operable_list', $operable_list);

	if ($order === false)
	{
		$err->show($_LANG['back_home_lnk'], './');

		exit;
	}

	/* 是否显示添加到购物车 */
	if ($order['extension_code'] != 'group_buy' && $order['extension_code'] != 'exchange_goods')
	{
		$smarty->assign('allow_to_cart', 1);
	}

	/* 订单商品 */
	$goods_list = iuser_order_goods($order_id);

	

	
	

	/* 订单 支付 配送 状态语言项 */
	//p($order['order_status']);p($order['pay_status']);p($order['shipping_status']);die;

	$order['order_status'] = $_LANG['os'][$order['order_status']];
	$order['pay_status'] = $_LANG['ps'][$order['pay_status']];
	$order['shipping_status'] = $_LANG['ss'][$order['shipping_status']];
	//p($goods_list);die;

	$smarty->assign('action',      'iuser_order_detail');
	$smarty->assign('order',      $order);
	$smarty->assign('goods_list', $goods_list);
	$smarty->display('user_transaction_huo15.dwt');
}




/**
 * 返回某个订单可执行的操作列表，包括权限判断
 * @param   array   $order      订单信息 order_status, shipping_status, pay_status
 * @param   bool    $is_cod     支付方式是否货到付款
 * @return  array   可执行的操作  confirm, pay, unpay, prepare, ship, unship, receive, cancel, invalid, return, drop
 * 格式 array('confirm' => true, 'pay' => true)
 */
function operable_list($order)
{
	/* 取得订单状态、发货状态、付款状态 */
	$os = $order['order_status'];
	$ss = $order['shipping_status'];
	$ps = $order['pay_status'];
	/* 取得订单操作权限 */
	$actions = $_SESSION['action_list'];
	//授予全部权限 huo15
	$actions = 'all';
	if ($actions == 'all')
	{
		$priv_list  = array('os' => true, 'ss' => true, 'ps' => true, 'edit' => true);
	}
	else
	{
		$actions    = ',' . $actions . ',';
		$priv_list  = array(
				'os'    => strpos($actions, ',order_os_edit,') !== false,
				'ss'    => strpos($actions, ',order_ss_edit,') !== false,
				'ps'    => strpos($actions, ',order_ps_edit,') !== false,
				'edit'  => strpos($actions, ',order_edit,') !== false
		);
	}

	/* 取得订单支付方式是否货到付款 */
	$payment = payment_info($order['pay_id']);
	$is_cod  = $payment['is_cod'] == 1;

	/* 根据状态返回可执行操作 */
	$list = array();
	if (OS_UNCONFIRMED == $os)
	{
		/* 状态：未确认 => 未付款、未发货 */
		if ($priv_list['os'])
		{
			$list['confirm']    = true; // 确认
			$list['invalid']    = true; // 无效
			$list['cancel']     = true; // 取消
			if ($is_cod)
			{
				/* 货到付款 */
				if ($priv_list['ss'])
				{
					$list['prepare'] = true; // 配货
					$list['split'] = true; // 分单
				}
			}
			else
			{
				/* 不是货到付款 */
				if ($priv_list['ps'])
				{
					$list['pay'] = true;  // 付款
				}
			}
		}
	}
	elseif (OS_CONFIRMED == $os || OS_SPLITED == $os || OS_SPLITING_PART == $os)
	{
		/* 状态：已确认 */
		if (PS_UNPAYED == $ps)
		{
			/* 状态：已确认、未付款 */
			if (SS_UNSHIPPED == $ss || SS_PREPARING == $ss)
			{
				/* 状态：已确认、未付款、未发货（或配货中） */
				if ($priv_list['os'])
				{
					$list['cancel'] = true; // 取消
					$list['invalid'] = true; // 无效
				}
				if ($is_cod)
				{
					/* 货到付款 */
					if ($priv_list['ss'])
					{
						if (SS_UNSHIPPED == $ss)
						{
							$list['prepare'] = true; // 配货
						}
						$list['split'] = true; // 分单
					}
				}
				else
				{
					/* 不是货到付款 */
					if ($priv_list['ps'])
					{
						$list['pay'] = true; // 付款
					}
				}
			}
			/* 状态：已确认、未付款、发货中 */
			elseif (SS_SHIPPED_ING == $ss || SS_SHIPPED_PART == $ss)
			{
				// 部分分单
				if (OS_SPLITING_PART == $os)
				{
					$list['split'] = true; // 分单
				}
				$list['to_delivery'] = true; // 去发货
			}
			else
			{
				/* 状态：已确认、未付款、已发货或已收货 => 货到付款 */
				if ($priv_list['ps'])
				{
					$list['pay'] = true; // 付款
				}
				if ($priv_list['ss'])
				{
					if (SS_SHIPPED == $ss)
					{
						$list['receive'] = true; // 收货确认
					}
					$list['unship'] = true; // 设为未发货
					if ($priv_list['os'])
					{
						$list['return'] = true; // 退货
					}
				}
			}
		}
		else
		{
			/* 状态：已确认、已付款和付款中 */
			if (SS_UNSHIPPED == $ss || SS_PREPARING == $ss)
			{
				/* 状态：已确认、已付款和付款中、未发货（配货中） => 不是货到付款 */
				if ($priv_list['ss'])
				{
					if (SS_UNSHIPPED == $ss)
					{
						$list['prepare'] = true; // 配货
					}
					$list['split'] = true; // 分单
				}
				if ($priv_list['ps'])
				{
					$list['unpay'] = true; // 设为未付款
					if ($priv_list['os'])
					{
						$list['cancel'] = true; // 取消
					}
				}
			}
			/* 状态：已确认、未付款、发货中 */
			elseif (SS_SHIPPED_ING == $ss || SS_SHIPPED_PART == $ss)
			{
				// 部分分单
				if (OS_SPLITING_PART == $os)
				{
					$list['split'] = true; // 分单
				}
				$list['to_delivery'] = true; // 去发货
			}
			else
			{
				/* 状态：已确认、已付款和付款中、已发货或已收货 */
				if ($priv_list['ss'])
				{
					if (SS_SHIPPED == $ss)
					{
						$list['receive'] = true; // 收货确认
					}
					if (!$is_cod)
					{
						$list['unship'] = true; // 设为未发货
					}
				}
				if ($priv_list['ps'] && $is_cod)
				{
					$list['unpay']  = true; // 设为未付款
				}
				if ($priv_list['os'] && $priv_list['ss'] && $priv_list['ps'])
				{
					$list['return'] = true; // 退货（包括退款）
				}
			}
		}
	}
	elseif (OS_CANCELED == $os)
	{
		/* 状态：取消 */
		if ($priv_list['os'])
		{
			$list['confirm'] = true;
		}
		if ($priv_list['edit'])
		{
			$list['remove'] = true;
		}
	}
	elseif (OS_INVALID == $os)
	{
		/* 状态：无效 */
		if ($priv_list['os'])
		{
			$list['confirm'] = true;
		}
		if ($priv_list['edit'])
		{
			$list['remove'] = true;
		}
	}
	elseif (OS_RETURNED == $os)
	{
		/* 状态：退货 */
		if ($priv_list['os'])
		{
			$list['confirm'] = true;
		}
	}

	/* 修正发货操作 */
	if (!empty($list['split']))
	{
		/* 如果是团购活动且未处理成功，不能发货 */
		if ($order['extension_code'] == 'group_buy')
		{
			include_once(ROOT_PATH . 'include/lib_goods.php');
			$group_buy = group_buy_info(intval($order['extension_id']));
			if ($group_buy['status'] != GBS_SUCCEED)
			{
				unset($list['split']);
				unset($list['to_delivery']);
			}
		}

		/* 如果部分发货 不允许 取消 订单 */
		if (order_deliveryed($order['order_id']))
		{
			$list['return'] = true; // 退货（包括退款）
			unset($list['cancel']); // 取消
		}
	}

	/* 售后 */
	$list['after_service'] = true;

	return $list;
}

?>