<?php
defined('IN_RUIEC') or exit('Access Denied');
$seo_modulename = $MOD['name'];
$seo_sitename = $RE['sitename'];
$seo_sitetitle = $RE['seo_title'];
$seo_sitekeywords = $RE['seo_keywords'];
$seo_sitedescription = $RE['seo_description'];
$seo_delimiter = $RE['seo_delimiter'];
$seo_page = $page > 1 ? $seo_delimiter : '';
$seo_catname = $seo_cattitle = $seo_parentname = $seo_catkeywords = $seo_catdescription = '';
if($catid) {
	if($CAT['parentid']) {
		$seo_catname = '';
		$tmp = strip_tags(cat_pos($CAT, 'RUIEC'));
		$tmp = explode('RUIEC', $tmp);
		$tmp = array_reverse($tmp);
		foreach($tmp as $k=>$v) {
			$seo_catname .= $v.$seo_delimiter;
		}
	} else {
		$seo_catname = $CAT['catname'].$seo_delimiter;
	}
	$seo_cattitle = $CAT['seo_title'] ? $CAT['seo_title'].$seo_delimiter : $seo_catname;
	$seo_catkeywords = $CAT['seo_keywords'] ? $CAT['seo_keywords'] : '';
	$seo_catdescription = $CAT['seo_description'] ? $CAT['seo_description'] : '';
}
$seo_areaname = (isset($areaid) && $areaid) ? area_pos($areaid, $seo_delimiter).$seo_delimiter : '';
$seo_showtitle = isset($title) ? $title : '';
$seo_showintroduce = isset($introduce) ? $introduce : '';
switch($seo_file) {
	case 'index':
		if($MOD['title_index']) {
			eval("\$seo_title = \"$MOD[title_index]\";");
		} else {
			$seo_title = $seo_modulename.$seo_delimiter.$seo_sitename;
		}
		if($MOD['keywords_index']) { eval("\$head_keywords = \"$MOD[keywords_index]\";");}
		else {$head_keywords = $seo_sitekeywords;}
		if($MOD['description_index']) {	eval("\$head_description = \"$MOD[description_index]\";");}
		else {$head_description = $seo_sitedescription;}
	break;
	case 'list':
		if($MOD['title_list']) {
			eval("\$seo_title = \"$MOD[title_list]\";");
		} else {
			$seo_title = $seo_cattitle.$seo_page.$seo_modulename.$seo_delimiter.$seo_sitename;
		}
		$_seo_catname = $seo_catname;
		$_seo_areaname = $seo_areaname;
		if($CAT['seo_keywords']) {
			$head_keywords = $CAT['seo_keywords'];
		} else if($MOD['keywords_list']) {
			if($_seo_catname) $seo_catname = str_replace($seo_delimiter, ',', $_seo_catname);
			if($_seo_areaname) $seo_areaname = str_replace($seo_delimiter, ',', $_seo_areaname);
			eval("\$head_keywords = \"$MOD[keywords_list]\";");
		} else {
			$head_keywords = $seo_sitekeywords;
		}
		if($CAT['seo_description']) {
			$head_description = $CAT['seo_description'];
		} else if($MOD['description_list']) {
			if($_seo_catname) $seo_catname = str_replace($seo_delimiter, ' ', $_seo_catname);
			if($_seo_areaname) $seo_areaname = str_replace($seo_delimiter, ' ', $_seo_areaname);
			eval("\$head_description = \"$MOD[description_list]\";");
		} else {
			$head_description = $seo_sitedescription;
		}
	break;
	case 'show':
		if($MOD['title_show']) {
			eval("\$seo_title = \"$MOD[title_show]\";");
		} else {
			$seo_title = $seo_showtitle.$seo_delimiter.$seo_catname.$seo_modulename.$seo_delimiter.$seo_sitename;
		}
		$_seo_catname = $seo_catname;
		$_seo_areaname = $seo_areaname;
		if($MOD['keywords_show']) {
			if($_seo_catname) $seo_catname = str_replace($seo_delimiter, ',', $_seo_catname);
			if($_seo_areaname) $seo_areaname = str_replace($seo_delimiter, ',', $_seo_areaname);
			eval("\$head_keywords = \"$MOD[keywords_show]\";");
		} else {
			$head_keywords = $keyword;
		}
		if($MOD['description_show']) {
			if($_seo_catname) $seo_catname = str_replace($seo_delimiter, ' ', $_seo_catname);
			if($_seo_areaname) $seo_areaname = str_replace($seo_delimiter, ' ', $_seo_areaname);
			eval("\$head_description = \"$MOD[description_show]\";");
		} else {
			$head_description = $introduce ? $introduce : $title;
		}
	break;
	case 'search':
		if($MOD['title_search']) {
			$seo_kw = $kw ? $kw.$seo_delimiter : '';
			eval("\$seo_title = \"$MOD[title_search]\";");
		} else {
			$seo_title = $seo_modulename.$L['search'].$seo_delimiter.$seo_page.$seo_sitename;
			if($catid) $seo_title = $seo_catname.$seo_title;
			if($areaid) $seo_title = $seo_areaname.$seo_title;
			if($kw) $seo_title = $kw.$seo_delimiter.$seo_title;
		}
		$_seo_catname = $seo_catname;
		$_seo_areaname = $seo_areaname;
		if($MOD['keywords_search']) {
			if($_seo_catname) $seo_catname = str_replace($seo_delimiter, ',', $_seo_catname);
			if($_seo_areaname) $seo_areaname = str_replace($seo_delimiter, ',', $_seo_areaname);
			$seo_kw = $kw ? $kw.',' : '';
			eval("\$head_keywords = \"$MOD[keywords_search]\";");
		}
		if($MOD['description_search']) {
			if($_seo_catname) $seo_catname = str_replace($seo_delimiter, ' ', $_seo_catname);
			if($_seo_areaname) $seo_areaname = str_replace($seo_delimiter, ' ', $_seo_areaname);
			$seo_kw = $kw ? $kw : '';
			eval("\$head_description = \"$MOD[description_search]\";");
		}
	break;
	default:
	break;
}
	
	
?>