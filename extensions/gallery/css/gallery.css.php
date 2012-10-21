<?php $config = include(realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'../config'.DIRECTORY_SEPARATOR.'main.php');?>

<?php echo '#'.$this->id; ?> ul.egallery {list-style: none}

<?php echo '#'.$this->id;?> ul.egallery li a {display: block}

<?php echo '#'.$this->id;?> ul.egallery li
{
	list-style: none;
	background: #eee;
	border-color: #ddd #bbb #aaa #ccc;
	border-style: solid;
	border-width: 1px;
	color: inherit;
	display: inline;
	float: left;
	margin: 3px;
	padding: 5px;
	position: relative;
	text-align: center;
	width: <?=$config['thumbnailWidth']+10?>px;
	overflow: hidden
}

<?php echo '#'.$this->id;?> ul.egallery img
{
	background: #fff;
	border-color: #aaa #ccc #ddd #bbb;
	border-style: solid;
	border-width: 1px;
	color: inherit;
	padding: 2px;
	vertical-align: top;
	display: block;
	margin: auto;
}

<?php echo '#'.$this->id;?> .newRow {clear:left}