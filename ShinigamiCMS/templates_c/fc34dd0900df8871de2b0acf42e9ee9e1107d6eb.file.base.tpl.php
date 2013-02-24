<?php /* Smarty version Smarty-3.1.13, created on 2013-02-24 12:19:21
         compiled from "application/views/packetunderground/base.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1365839759512a48e3145ab2-79279583%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc34dd0900df8871de2b0acf42e9ee9e1107d6eb' => 
    array (
      0 => 'application/views/packetunderground/base.tpl',
      1 => 1361726357,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1365839759512a48e3145ab2-79279583',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_512a48e3253ff9_56103238',
  'variables' => 
  array (
    'data' => 0,
    'sideitems' => 0,
    'sideitem' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_512a48e3253ff9_56103238')) {function content_512a48e3253ff9_56103238($_smarty_tpl) {?><html>
    <head>
        <title>Packet Underground -- Scattered Ramblings</title>
        <link rel="stylesheet" href="/resources/css/blueprint/screen.css" type="text/css" media="screen, projection">
        <link rel="stylesheet" href="/resources/css/blueprint/print.css" type="text/css" media="print"> 
        <!--[if lt IE 8]>
          <link rel="stylesheet" href="resources/css/blueprint/ie.css" type="text/css" media="screen, projection">
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="/resources/css/main.css" media="screen, projection" />
        
    </head>
    <body>
        <div class="container">
            <div class="span-24 banner">
                <img src="/resources/images/banner.png" alt="Packet Underground" />
            </div>
            
            <div class="span-24 content-container">
                <div class="span-19 content">
                    <!-- Start Content Area -->
                    
                    <?php echo $_smarty_tpl->tpl_vars['data']->value;?>

                    
                    <!-- End Content Area -->
                </div>
                
                <div class="span-5 sidebar last">
                    <!-- Start Sidebar Area -->
                    
                        <?php  $_smarty_tpl->tpl_vars['sideitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sideitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sideitems']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sideitem']->key => $_smarty_tpl->tpl_vars['sideitem']->value){
$_smarty_tpl->tpl_vars['sideitem']->_loop = true;
?><div class="box side_item"><h2><?php echo $_smarty_tpl->tpl_vars['sideitem']->value['title'];?>
</h2><ul><?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sideitem']->value['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value){
$_smarty_tpl->tpl_vars['link']->_loop = true;
?><li><a href='<?php echo $_smarty_tpl->tpl_vars['link']->value['uri'];?>
'><?php echo $_smarty_tpl->tpl_vars['link']->value['title'];?>
</a></li><?php } ?></ul></div><?php } ?>
                    
                    <!-- End Sidebar Area -->
                </div>
            </div>
            <div class="span-24 footer last">
                <div class="box">
                    Copyright &copy 2013 Shane McIntosh http://packetunderground.com<br />Shinigami-CMS
                </div>
            </div>
        </div>
    </body>
</html><?php }} ?>