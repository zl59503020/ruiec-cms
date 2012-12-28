<?php
defined('IN_RUIEC') or exit('Access Denied');
file_copy(RE_ROOT.'/api/ajax.php', RE_ROOT.'/'.$dir.'/ajax.php');
install_file('index', $dir, 1);
install_file('list', $dir, 1);
install_file('show', $dir, 1);
install_file('search', $dir, 1);
?>