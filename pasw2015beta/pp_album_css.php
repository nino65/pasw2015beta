<?php
/* Photopress album style */
$pp_cellwidth = $pp_options['thumbsize'] + 20;
echo '
<style type="text/css" media="screen">
/* Structure */
.pp_cell 
{
	display: table;
	float: left;
	width: ' . $pp_cellwidth . 'px;
	height: ' . $pp_cellwidth . 'px;
	margin: 0 15px 15px 0;
	padding: 0px;
	overflow: hidden;
}
.pp_incell 
{
	display: table-cell;
	position: relative;
}
.pp_incell img,
.pp_thumb img 
{
	padding: 5px;
	margin: 2px;
}
.pp_incell a:hover img,
.pp_thumb a:hover img 
{
	margin: 2px;
}
#pp_wrap,
ul.pp_slides 
{
	display: block;
	/* width: auto;  640px; /* (was 385) if someone thinks of a better way to center please let me know! */
	margin-left: auto;
	margin-right: auto;
	margin-top: 15px;
	padding:0;
}
.pp_slides li 
{
	display:block;
	float:left;
	margin:0 10px 10px 0;
	padding:0;
	width: auto;
	height: auto;
}
#pp_prevnext 
{
	clear: both;
}
.pp_prev, 
.pp_next
{
	margin: -25px 0px 5px 0px;
	display: block;
	padding: 1px 5px 1px 5px;
}
.pp_prev 
{
	float: left;
}
.pp_next 
{
	float: right;
}
#pp_block 
{
	width: 100%;
	clear: both;
}
#pp_lgphoto img,
#pp_lgphoto,
.pp_lgphoto 
{
	display: block;
	margin-left: auto;
	margin-right: auto;
}
#pp_block a img 
{
	padding: 4px;
}
#pp_block a:hover img 
{
	padding: 4px;
}
/* Typography */
.pp_cell 
{
	text-align: center;
}
.pp_incell 
{
	vertical-align: bottom;
}
#pp_cat_heading,
.pp_cat_heading
{
	text-align: center;
}
.pp_incell img,
.pp_thumb img 
{
	text-align: center;
}
#pp_wrap,
ul.pp_slides 
{
	list-style:none;
	line-height:1.4em;
}
.pp_tag 
{
	text-align: center;
	font-size: 0.9em;
}
#pp_page_links 
{
	text-align: center;
}
a.pp_prev, 
a.pp_next 
{
	text-decoration: none;
	font-weight: bold;
}
a.pp_prev:hover, 
a.pp_next:hover 
{
	text-decoration: none;
}
/* Colours and borders */
.pp_incell img,
.pp_thumb img 
{
	border: 1px solid #ccc;
}
.pp_incell a:hover img,
.pp_thumb a:hover img 
{
	border: 1px solid #E58712;
}
.pp_photo 
{
}
.pp_prev a,
.pp_next a,
a.pp_prev,
a.pp_next 
{
	background: #ccc;
	border: solid 1px #9ac;
	color: #000;
}
.pp_prev a:hover,
.pp_next a:hover,
a.pp_prev:hover, 
a.pp_next:hover 
{
	background: #acf;
	border: solid 1px #036;
	color: #036;
}
#pp_block a img 
{
	border: 1px solid #ccc;
}
#pp_block a:hover img 
{
	border: 1px solid #06c;
}
</style>
<style type="text/css" media="print">
/* Structure */
.pp_cell 
{
	display: table;
	float: left;
	width: ' . $pp_cellwidth . 'px;
	height: ' . $pp_cellwidth . 'px;
	margin: 0 15px 15px 0;
	padding: 0px;
	overflow: hidden;
}
.pp_incell 
{
	display: table-cell;
	position: relative;
}
.pp_incell img,
.pp_thumb img 
{
	padding: 5px;
	margin: 2px;
}
.pp_incell a:hover img,
.pp_thumb a:hover img 
{
	margin: 2px;
}
#pp_wrap 
{
	margin: 10px 0 0 0;
	padding: 0px;
}
#pp_wrap,
ul.pp_slides 
{
	display: block;
	/* width: 640px;  (was 385) if someone thinks of a better way to center please let me know! */
	margin-left: auto;
	margin-right: auto;
	margin-top: 15px;
	padding:0;
}
.pp_slides li 
{
	display:block;
	float:left;
	margin:0 10px 10px 0;
	padding:0;
	width: auto;
	height: auto;
}
#pp_wrap 
{
	margin: 10px 0 0 0;
	padding: 0px;
}
#pp_prevnext 
{
	clear: both;
}
.pp_prev, 
.pp_next
{
	display: none;
	margin: -25px 0px 5px 0px;
	padding: 1px 5px 1px 5px;
}
.pp_prev 
{
	float: left;
}
.pp_next 
{
	float: right;
}
#pp_block 
{
	width: 100%;
	clear: both;
}
#pp_lgphoto img,
#pp_lgphoto,
.pp_lgphoto 
{
	display: block;
	margin-left: auto;
	margin-right: auto;
}
#pp_block a img 
{
	padding: 4px;
}
#pp_block a:hover img 
{
	padding: 4px;
}
/* Typography */
.pp_cell 
{
	text-align: center;
}
.pp_incell 
{
	vertical-align: bottom;
}
#pp_cat_heading,
.pp_cat_heading
{
	text-align: center;
}
.pp_incell img,
.pp_thumb img 
{
	text-align: center;
}
#pp_wrap,
ul.pp_slides 
{
	list-style:none;
	line-height:1.4em;
}
.pp_tag 
{
	text-align: center;
	font-size: 0.9em;
}
#pp_page_links 
{
	text-align: center;
}
a.pp_prev, 
a.pp_next 
{
	text-decoration: none;
	font-weight: bold;
}
a.pp_prev:hover, 
a.pp_next:hover 
{
	text-decoration: none;
}
/* Colours and borders */
.pp_incell img,
.pp_thumb img 
{
	border: 1px solid #ccc;
}
.pp_incell a:hover img,
.pp_thumb a:hover img 
{
	border: 1px solid #06c;
}
.pp_photo 
{
}
.pp_prev a,
.pp_next a,
a.pp_prev,
a.pp_next 
{
	background: #ccc;
	border: solid 1px #9ac;
	color: #000;
}
.pp_prev a:hover,
.pp_next a:hover,
a.pp_prev:hover, 
a.pp_next:hover 
{
	background: #acf;
	border: solid 1px #036;
	color: #036;
}
#pp_block a img 
{
	border: 1px solid #ccc;
}
#pp_block a:hover img 
{
	border: 1px solid #06c;
}
</style>
';
?>