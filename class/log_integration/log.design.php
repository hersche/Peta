<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>comptent log parser</title>
		<script type="text/javascript" src="../../res/jquery.custom.flowbox.new.js"></script>
		<script type="text/javascript" src="../../res/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="../../res/jquery.tablesorter.pager.js"></script>
		<script type="text/javascript" src="../../res/jquery.quicksearch.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {     // call the tablesorter plugin     
				$("table").tablesorter({widthFixed: true, widgets: ['zebra']})
				 .tablesorterPager({container: $("#pager")}); 
				$("#work").html("jaja test");
				$('input#id_search').quicksearch('table tbody tr');
			}); 
		</script>
		<style type="text/css">
			/* tables */
table.tablesorter {
	font-family:arial;
	background-color: #CDCDCD;
	margin:10px 0pt 15px;
	font-size: 8pt;
	width: 100%;
	text-align: left;
}
table.tablesorter thead tr th, table.tablesorter tfoot tr th {
	background-color: #e6EEEE;
	border: 1px solid #FFF;
	font-size: 8pt;
	padding: 4px;
}
table.tablesorter thead tr .header {
	background-image: url(http://tablesorter.com/themes/blue/bg.gif);
	background-repeat: no-repeat;
	background-position: center right;
	cursor: pointer;
}
table.tablesorter tbody td {
	color: #3D3D3D;
	padding: 4px;
	background-color: #FFF;
	vertical-align: top;
}
table.tablesorter tbody tr.odd td {
	background-color:#F0F0F6;
}
table.tablesorter thead tr .headerSortUp {
	background-image: url(http://tablesorter.com/themes/blue/asc.gif);
}
table.tablesorter thead tr .headerSortDown {
	background-image: url(http://tablesorter.com/themes/blue/desc.gif);
}
table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {
background-color: #8dbdd8;
}

		</style>
	</head>
	<body>
	<h1>System-Logdatei von Heute</h1>
		<table class="tablesorter">
			<thead>
				<tr>
					<th>Date</th>
					<th>type</th>
					<th>UID</th>
					<th>rm_atm</th>
					<th>Text</th>
				</tr>
			</thead>
			<tbody>
				<? include("log.output.php"); ?>
			</tbody>
		</table>
		<div id="pager" class="pager">
	<form>
	<br /><br />
		<input id="id_search" type="text"><br /><br />
		<img src="http://tablesorter.com/addons/pager/icons/first.png" class="first"/>
		<img src="http://tablesorter.com/addons/pager/icons/prev.png" class="prev"/>
		<input type="text" class="pagedisplay"/>
		<img src="http://tablesorter.com/addons/pager/icons/next.png" class="next"/>
		<img src="http://tablesorter.com/addons/pager/icons/last.png" class="last"/>
		<select class="pagesize">
			<option value="5">5</option>
			<option selected="selected" value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option  value="40">40</option>
		</select>
	</form>
</div>
		<div id="work">blubb</div>
	</body>
</html>
