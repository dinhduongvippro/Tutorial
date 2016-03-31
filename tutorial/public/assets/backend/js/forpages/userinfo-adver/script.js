$(document).ready(function() {
	$crm.active_menu('report', 'advertiser');
	$('#table').append(stringTable);
	$crm.createDataTableId('#table');
});