<?php if ($this->_var['full_page']): ?>
<!-- $Id: users_list.htm 15617 2009-02-18 05:18:00Z sunxiaodong $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../data/static/js/utils.js,./js/listtable.js')); ?>

<form method="POST" action="" name="listForm">

<!-- start users list -->
<div class="list-div" id="listDiv">
<?php endif; ?>
<!--用户列表部分-->
<table cellpadding="3" cellspacing="1">
  <tr>
  <th>订单号</th>
  <th>总金额</th>
  <th>比列</th>
  <th>分成金额</th>
  <th>状态</th>
  </tr>
  <?php $_from = $this->_var['logdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
  <tr>
  <td align="center"><a href="user.php?act=myorder_detail&order_id=<?php echo $this->_var['val']['order_id']; ?>&level=<?php echo $this->_var['level']; ?>"><?php echo $this->_var['val']['order_sn']; ?></a></td>
  <td align="center"><?php echo $this->_var['val']['order_amount']; ?></td>
  <td align="center"><?php echo $this->_var['val']['level_money']; ?></td>
  <td align="center"><?php echo $this->_var['val']['set_money']; ?></td>
   
  <td align="center"><?php if ($this->_var['val']['is_separate'] == 0): ?>未分成<?php else: ?>已分成<?php endif; ?></td>
  </tr>
  <?php endforeach; else: ?>
  <tr><td class="no-records" colspan="12"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>

<?php if ($this->_var['full_page']): ?>
</div>
<!-- end users list -->
</form>
<script type="text/javascript" language="JavaScript">
<!--

onload = function()
{
    document.forms['searchForm'].elements['keyword'].focus();
    // 开始检查订单
    startCheckOrder();
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>