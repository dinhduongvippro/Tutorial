var select_all = [];
var locations = [];
var flagAP = 0;
var startIndex = 1;
var idSize = '#size';
var maxVisible = 5;

var $crm={
		showDataTotalLocation:function(id,result){
			$('#'+id+' tbody').remove();
			$('#'+id).append(result.dataTotal);
		},
		showDataTableLocation:function(id,result,column){
			$('#'+id).dataTable().fnDestroy();
			$('#'+id+' tbody').remove();
			$('#'+id).append(result.dataTable);
			$('#'+id).dataTable({
					"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ column ] }],
					"language": {
			            "decimal": ".",
			            "thousands": ","
		        	}
			});
		},
		columnChart:function(id, data, title_,name,value1,value2) {
			google.setOnLoadCallback(drawChart);
			function drawChart() {
				var dataChart = new google.visualization.DataTable();
				dataChart.addColumn('timeofday', 'Date');
				dataChart.addColumn('number', 'Impresion');
				dataChart.addColumn('number', 'Click');
				var n = data.length ;
				for(var i = 0; i < n ;i++){
					dataChart.addRow([{v: [parseInt(data[i][name]), 0, 0]},parseInt(data[i][value1]),parseInt(data[i][value2])]);
				}
				var options = {
					title : title_,
					legend: {position: 'top'},
			        hAxis: {
			        	format: 'HH',
			        },
			        chartArea: {width: '70%',height:'70%'}
				};
				var chart = new google.visualization.ColumnChart(document
						.getElementById(id));
				chart.draw(dataChart, options);
			}
		},
		pieChart:function(id, data, title_,title,value) {
			
			google.setOnLoadCallback(drawChart, true);
			function drawChart() {
				var dataChart = new google.visualization.DataTable();
				dataChart.addColumn('string', 'Task');
				dataChart.addColumn('number', 'Hours per Day');
				var n = data.length ;
				for(var i = 0; i < n ;i++){
					dataChart.addRow([data[i][title],parseInt(data[i][value])]);
				}
//				dataChart.addRows(data);
				var options = {
					title : title_,
					chartArea: {width: '90%',height:'90%'}
				};
				var chart = new google.visualization.PieChart(document
						.getElementById(id));
				chart.draw(dataChart, options);
			}
		},
		lineChartOne:function(id, data, title_,title,value,format) {
			google.setOnLoadCallback(drawChart,true);
			function drawChart() {
				var dataChart = new google.visualization.DataTable();
				dataChart.addColumn('datetime', 'Date');
				dataChart.addColumn('number', value);
				var n = data.length ;
				for(var i = 0; i < n ;i++){
					dataChart.addRow([new Date(data[i][title]),parseInt(data[i][value])]);
				}
//				dataChart.addRows(data);
				var options = {
					title : title_,
					curveType: 'function',
					hAxis: {
		                format: format
		            },
			        vAxis: {
			        	title: value
			        },
			        legend: { position: 'top' },
			        pointSize : 3,
				};
				var chart = new google.visualization.LineChart(document
						.getElementById(id));
				chart.draw(dataChart, options);
			}
		},
		lineChartWeek:function(id, data, title_,title,value) {
			google.setOnLoadCallback(drawChart,true);
			function drawChart() {
				var dataChart = new google.visualization.DataTable();
				dataChart.addColumn('string', 'Date');
				dataChart.addColumn('number', value);
				var n = data.length ;
				for(var i = 0; i < n ;i++){
					dataChart.addRow([data[i][title],parseInt(data[i][value])]);
				}
				var options = {
					title : title_,
					curveType: 'function',
			        vAxis: {
			        	title: value
			        },
			        legend: { position: 'top' },
			        pointSize : 3,
				};
				var chart = new google.visualization.LineChart(document
						.getElementById(id));
				chart.draw(dataChart, options);
			}
		},
		lineChartMonth:function(id, data, title_,title,value,format) {
			google.setOnLoadCallback(drawChart,true);
			function drawChart() {
				var dataChart = new google.visualization.DataTable();
				dataChart.addColumn('datetime', 'Date');
				dataChart.addColumn('number', value);
				var n = data.length ;
				for(var i = 0; i < n ;i++){
					var date = new Date(data[i][title]);
					dataChart.addRow([new Date(date.getFullYear(), date.getMonth()+1, 1),parseInt(data[i][value])]);
				}
				var options = {
					title : title_,
					curveType: 'function',
					hAxis: {
		                format: format
		            },
			        vAxis: {
			        	title: value
			        },
			        legend: { position: 'top' },
			        pointSize : 3,
				};
				var chart = new google.visualization.LineChart(document
						.getElementById(id));
				chart.draw(dataChart, options);
			}
		},
		lineChart:function(id, data, title_,name,value1,value2,format) {
			google.setOnLoadCallback(drawChart,true);
			function drawChart() {
				var dataChart = new google.visualization.DataTable();
				dataChart.addColumn('datetime', 'Date');
				dataChart.addColumn('number', value1);
				dataChart.addColumn('number', value2);
				var n = data.length ;
				for(var i = 0; i < n ;i++){
					dataChart.addRow([new Date(data[i][name]),parseInt(data[i][value1]),parseInt(data[i][value2])]);
				}
//				dataChart.addRows(data);
				var options = {
					title : '',
					curveType: 'function',
					hAxis: {
		                format: format,
		            },
			        vAxis: {
			        },
			        legend: { position: 'top' },
			        pointSize : 5,
				};
				var chart = new google.visualization.LineChart(document
						.getElementById(id));
				chart.draw(dataChart, options);
			}
		},
		active_menu:function(var1, var2){
			$("#"+var1).addClass("active");
			$("#"+var1+"I").removeClass("fa-angle-left");
			$("#"+var1+"I").addClass("fa-angle-down");
			$("#"+var1+" ul").css("display","block");
			$("#"+var2).addClass("active");
		},
		autoCloseMessage:function(){
			setTimeout(function(){ $("#messageResult").alert('close'); }, 15000);
		},
		createDataTable:function(idTable){
			$(idTable).dataTable({ 
				"bPaginate": false, 
				"bInfo": false, 
				"bFilter": false,
				'aoColumnDefs': [{
			        'bSortable': false,
			        'aTargets': ['nosort']
			    }]
			});
		},
		createDataTableFrontend:function(idTable){
			$(idTable).dataTable({ 
				"bPaginate": true, 
				"bInfo": true, 
				"bFilter": true,
				'aoColumnDefs': [{
			        'bSortable': false,
			        'aTargets': ['nosort']
			    }]
			});
		},
		myDelete:function(idTable, urlDelete){
			$(idTable).find('input[type=checkbox]').each(function(){
		        if (this.checked) select_all.push($(this).val());
			});
			$.ajax({
		    	url:urlDelete,
		    	type: 'POST',
		    	data:{
		    		select_all:select_all.toString(),
				},
		    	success:function(result){
		    		window.location.href = result.message;
				}
		  	});		
		},
		searchTable:function(idSearch, urlSearch){
			$(idSearch).keyup(function(e){
			    if(e.keyCode == 13){
			    	window.location.href = urlSearch + this.value;
			    }
			});
		},
		myPaging:function(idsize,urlPaging,contentSearch){
			$(idsize).change(function(){
				window.location.href = urlPaging+"&index=1&size="+this.value+"&search="+contentSearch;
			});
		},
		disablePreviousNext:function(pageIndex, totalPage){
			if(pageIndex <= 0){ 
				$("#previous").removeAttr("href"); 
			}
			if (pageIndex+2 >= totalPage){ 
				$("#next").removeAttr("href"); 
			}
		},
		checkAll:function(){
			$('#all').click(function(event) {  //on click 
			    if(this.checked) { // check select status
			        $('.choose').each(function() { //loop through each checkbox
			            this.checked = true;  //select all checkboxes with class "checkbox1"               
			        });
			    }else{
			        $('.choose').each(function() { //loop through each checkbox
			            this.checked = false; //deselect all checkboxes with class "checkbox1"                       
			        });         
			    }
			});
		},
		changeStatus:function(idTable, urlChangeSession){
			$(idTable).find('input[type=checkbox]').each(function(){
		        if (this.checked) select_all.push($(this).val());
			});
			$.ajax({
		    	url:urlChangeSession,
		    	type: 'POST',
		    	data:{
		    		select_all:select_all.toString(),
				},
		    	success:function(result){
		    		if(result == "redirect") { 
				    	return window.location.href = "/login?v=ajax";  
				    } 
		    		window.location.href = result.message;
				}
		  	});		
		},
		checkAllAccessPoint:function(idCheckAll, idTable){
//			if(flagAP > 0){}
//			else {
//				flagAP ++;
//				$('#'+idTable+' .'+idCheckAll+'Location').each(function() {this.checked = true;});
//			    $('#'+idTable+' .'+idCheckAll+'Ap').each(function() {this.checked = true;});
//			}
//			alert(event);
//			$('#'+idTable+' #'+idCheckAll).click(function(event) {
		    if($('#'+idTable+' #'+idCheckAll).prop("checked")) {
		        $('#'+idTable+' .'+idCheckAll+'Location').each(function() {this.checked = true;});
		        $('#'+idTable+' .'+idCheckAll+'Ap').each(function() {this.checked = true;});
		    }else{
		        $('#'+idTable+' .'+idCheckAll+'Location').each(function(){this.checked = false;});  
		        $('#'+idTable+' .'+idCheckAll+'Ap').each(function() {this.checked = false;});       
		    }
//			});
		},
		checkLocation:function(idLocation, idCheckAll, idTable){
//			if(locations[idLocation] > 0) {  }
//			else { 
//				locations[idLocation] = 1 ;
//				if(flagAP > 0)
//					$('#'+idTable+' .'+idLocation).each(function() {this.checked = false;}); 
//				else
//					$('#'+idTable+' .'+idLocation).each(function() {this.checked = true;}); 
//			}
//			$('#'+idTable+' #'+idLocation).click(function(event) {
		    if($('#'+idTable+' #'+idLocation).prop("checked")) {
		        $('#'+idTable+' .'+idLocation).each(function() {this.checked = true;});
		    }else{
		        $('#'+idTable+' .'+idLocation).each(function(){this.checked = false;});         
		    }
//			});

			if ($crm.check(idCheckAll+'Location', idTable) == true) $('#'+idTable+' #'+idCheckAll).prop( "checked", true );
			else $('#'+idTable+' #'+idCheckAll).prop( "checked", false );
		},
		checkAp:function(classLocation, idCheckAll, idTable){	
			if ($crm.check(classLocation, idTable) == true) {
				$('#'+idTable+' #'+classLocation).prop( "checked", true );
			}else if ($crm.check(classLocation, idTable) == false){
				$('#'+idTable+' #'+classLocation).prop( "checked", false );
				$('#'+idTable+' #'+idCheckAll).prop( "checked", false );
			}
			if ($crm.check(idCheckAll+'Location', idTable) == true && $crm.check(classLocation, idTable) == true){
				$('#'+idTable+' #'+idCheckAll).prop( "checked", true );
			}
		},
		check:function(classLocation, idTable){
			var i = true;
			$('#'+ idTable + ' .'+classLocation).each(function() {
			    if(!this.checked) return i = false;
			});
			return i;
		},
		link_unlink:function(idTableFrom, idTableTo, idTable, submitName, contentSearch, index, idPerPage){
			var list_location = [];
			var list_ap = [];
			$('#'+idTable+' .chooseLocation').each(function() {
				if (this.checked) list_location.push($(this).val());
			});
			$('#'+idTable+' .chooseAp').each(function(){
		        if (this.checked) list_ap.push($(this).val());
			});
			
			if (list_location.length != 0 || list_ap.length != 0 || $('#import_booking').attr('id') == 'import_booking'){
				$.ajax({
			    	url:'/booking/linkUnlinkAjax',
			    	type: 'POST',
			    	data:{
			    		list_location:list_location,
			    		list_ap:list_ap,
			    		submit:submitName,
			    		search:contentSearch,
			    		index:index
					},
			    	success:function(result){
			    		console.log(result);
				    	if(result != null){
				    		var listLF = result.listLocationFrom;
				    		var nF = listLF.length;
							$('#'+idTableFrom+' tbody').remove();
				    		var string = '<tbody>';
							for(var t = 0; t < nF; t++){
								var listAP = listLF[t].listap;
								var idL = listLF[t].id.replace("!","");
								var mF = listAP.length;
								string += "<tr>" +
								"<td><input type='checkbox' name='list_location[]' class='chooseLocation' id='"+idL+"' onchange=" + '"' + "$crm.checkLocation('"+idL+"','choose','"+idTableFrom+"')" + '"' + " value='"+listLF[t].id+"'/></td>" +
								'<td>'+ listLF[t].name +'</td></tr>';
								for(var h = 0; h < mF; h++){
									string += '<tr>' +
									'<td></td>' + 
									"<td><input type='checkbox' name='list_ap[]' class='chooseAp "+idL+"' onchange=" + '"' + "$crm.checkAp('"+idL+"','choose','"+idTableFrom+"')" + '"' + " value='"+listAP[h].id+"'/>"+listAP[h].name+"</td>"+
									+'</tr>';
								}
							}
							string +='</tbody>';
							$('#'+idTableFrom).append(string);
							var listLF = result.listLocationTo;
				    		var nT = listLF.length;
							$('#'+idTableTo+' tbody').remove();
				    		var string = '<tbody>';
							for(var t = 0; t < nT; t++){
								var listAP = listLF[t].listap;
								var idL = listLF[t].id.replace("!","");
								var mT = listAP.length;
								string += "<tr>" +
								"<td><input type='checkbox' name='list_location[]' class='chooseLocation' id='"+idL+"' onchange=" + '"' + "$crm.checkLocation('"+idL+"','choose','"+idTableTo+"')" + '"' + " value='"+listLF[t].id+"'/></td>" +
								'<td>'+ listLF[t].name +'</td></tr>';
								for(var h = 0; h < mT; h++){
									string += '<tr>' +
									'<td></td>' + 
									"<td><input type='checkbox' name='list_ap[]' class='chooseAp "+idL+"' onchange=" + '"' + "$crm.checkAp('"+idL+"','choose','"+idTableTo+"')" + '"' + " value='"+listAP[h].id+"'/>"+listAP[h].name+"</td>"+
									+'</tr>';
								}
							}
							string +='</tbody>';
							$('#'+idTableTo).append(string);
							$crm.perpage(idPerPage, nF, result.paging.total,result.paging.index, result.paging.size, result.paging.search, result.paging.total_page,idTableFrom);
				    	}
					}
			  	});	
			}
		},
	    searchInTable:function(_this, idTable){
	         $.each($("#"+idTable+" tbody").find("tr"), function() {
	             if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) == -1)
	                $(this).hide();
	             else
	                $(this).show();                
	         });
	    },
	    searchInDatabase:function(idPerPage,idTableFrom,contentSearch){
	   	 	$.ajax({
		    	url:'/booking/linkUnlinkAjax',
		    	type: 'POST',
		    	data:{
		    		search:contentSearch,
				},
		    	success:function(result){
			    	if(result != null){
			    		var listLF = result.listLocationFrom;
			    		var n = listLF.length;
						$('#'+idTableFrom+' tbody').remove();
			    		var string = '<tbody>';
						for(var t = 0; t < n; t++){
							var listAP = listLF[t].listap;
							var idL = listLF[t].id.replace("!","");
							var m = listAP.length;
							string += "<tr>" +
							"<td><input type='checkbox' name='list_location[]' class='chooseLocation' id='"+idL+"' onchange=" + '"' + "$crm.checkLocation('"+idL+"','choose','"+idTableFrom+"')" + '"' + " value='"+listLF[t].id+"'/></td>" +
							'<td>'+ listLF[t].name +'</td></tr>';
							for(var h = 0; h < m; h++){
								string += '<tr>' +
								'<td></td>' + 
								"<td><input type='checkbox' name='list_ap[]' class='chooseAp "+idL+"' onchange=" + '"' + "$crm.checkAp('"+idL+"','choose','"+idTableFrom+"')" + '"' + " value='"+listAP[h].id+"'/>"+listAP[h].name+"</td>"+
								+'</tr>';
							}
						}
						string +='</tbody>';
						$('#'+idTableFrom).append(string);
						$crm.perpage(idPerPage, n, result.paging.total,result.paging.index, result.paging.size, result.paging.search, result.paging.total_page,idTableFrom);
			    	}
				}
		  	});
	    },
	    perpage: function(idPerPage, countDataCurrent, countTotal, index, size, search, total_page,idTableFrom){    	
        	$("#"+idPerPage +" div").remove();
        	var string = '';
        	string += '<div class="col-xs-12">';
    		if (countDataCurrent > 0){
    			string += '<div class="pull-right">'+
    			'<div class="pull-left">';
    				var from=index*size;
    				var to=(from+size <= countTotal) ? from+size : from+(countTotal%size);
    				string += '<div class="dataTables_info">Showing '+(from+1)+' to '+to+' of '+countTotal+' entries</div>'+
    			'</div>&nbsp;'+
             	'<ul id="'+idPerPage+'" class="pagination pagination-sm no-margin pull-right">'+			                     	
                	'<li><a id="1" class="pageClass" style="cursor: pointer;"><i class="fa fa-angle-double-left"></i></a></li>'+
                	'<li><a id="previous" class="pageClass" style="cursor: pointer;"><i class="fa fa-angle-left"></i></a></li>';
                     	if(total_page <= 5){
    						var start = 1; var end = total_page;
    					}else if (index+5 <= total_page){
    						var start = index+1; var end = index+5;
    					}else{
    						var start = total_page-4; var end = total_page;
    					}
                     	for (var i=start; i<=end; i++){
                     		string += '<li '; if (i==(index+1)) string += "class='active'"; string +='><a class="pageClass" style="cursor: pointer;">'+i+'</a></li>';
                     	}
                     string += '<li><a class="pageClass" style="cursor: pointer;" id="next"><i class="fa fa-angle-right"></i></a></li>'+
                     '<li><a class="pageClass" style="cursor: pointer;" id="final"><i class="fa fa-angle-double-right"></i></a></li>'+
             	'</ul>'+
            '</div>';
            }
          	string += '</div>';
          	$('#'+idPerPage).append(string);
	      	$("#"+idPerPage+" .pageClass").click(function(){
	      		var indexparam = "";   		
				if($(this).attr('id') == 1){
					indexparam = $(this).attr('id');
				}else if($(this).attr('id') == 'previous'){
					indexparam = index;
				}else if($(this).attr('id') == 'next'){
					if ((index+2) >= total_page){
						indexparam = total_page;
					}else{
						indexparam = index + 2;
					}
				}else if($(this).attr('id') == 'final'){
					indexparam = total_page;
				}else{
					indexparam = $(this).text();
				}
	    		
	       	 	$.ajax({
	    	    	url:'/booking/linkUnlinkAjax',
	    	    	type: 'POST',
	    	    	data:{
	    	    		search:$("#searchFrom").val(),
	    	    		index:indexparam,
	    			},
	    	    	success:function(result){
	    		    	if(result != null){
	    		    		var listLF = result.listLocationFrom;
	    		    		var n = listLF.length;
	    					$('#'+idTableFrom+' tbody').remove();
	    		    		var string = '<tbody>';
	    					for(var t = 0; t < n; t++){
	    						var listAP = listLF[t].listap;
	    						var idL = listLF[t].id.replace("!","");
	    						var m = listAP.length;
	    						string += "<tr>" +
	    						"<td><input type='checkbox' name='list_location[]' class='chooseLocation' id='"+idL+"' onchange=" + '"' + "$crm.checkLocation('"+idL+"','choose','"+idTableFrom+"')" + '"' + " value='"+listLF[t].id+"'/></td>" +
	    						'<td>'+ listLF[t].name +'</td></tr>';
	    						for(var h = 0; h < m; h++){
	    							string += '<tr>' +
	    							'<td></td>' + 
	    							"<td><input type='checkbox' name='list_ap[]' class='chooseAp "+idL+"' onchange=" + '"' + "$crm.checkAp('"+idL+"','choose','"+idTableFrom+"')" + '"' + " value='"+listAP[h].id+"'/>"+listAP[h].name+"</td>"+
	    							+'</tr>';
	    						}
	    					}
	    					string +='</tbody>';
	    					$('#'+idTableFrom).append(string);
	    					$crm.perpage(idPerPage, n, result.paging.total,result.paging.index, result.paging.size, result.paging.search, result.paging.total_page,idTableFrom);
	    		      		
	    		    	}
	    			}
	    	  	});	
	    	});
	    },
		showDate:function () {
			// Create two variable with the names of the months and days in an array
			var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
			var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
			// Create a newDate() object
			var newDate = new Date();
			// Extract the current date from Date object
			newDate.setDate(newDate.getDate());
			// Output the day, date, month and year    
			$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());
			setInterval( function() {
				// Create a newDate() object and extract the seconds of the current time on the visitor's
				var seconds = new Date().getSeconds();
				// Add a leading zero to seconds value
				$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
			},1000);
			setInterval( function() {
				// Create a newDate() object and extract the minutes of the current time on the visitor's
				var minutes = new Date().getMinutes();
				// Add a leading zero to the minutes value
				$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
		    },1000);	
			setInterval( function() {
				// Create a newDate() object and extract the hours of the current time on the visitor's
				var hours = new Date().getHours();
				// Add a leading zero to the hours value
				hours = hours -1;
				$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
		    }, 1000);	
		},
		dateSelect : function(value,divFrom,divTo){
			var newDate = new Date();
			switch (value) {
			    case 'today':
				    $(divFrom).html($crm.getDateC(newDate));
				    $(divTo).html($crm.getDateC(newDate));
			        break;
			    case 'yesterday':
			    	$(divFrom).html($crm.getDateC(new Date(newDate.setDate(newDate.getDate()-1))));
				    $(divTo).html($crm.getDateC(new Date(newDate.setDate(newDate.getDate()))));
			        break;
			    case 'this_week':
			    	$(divFrom).html($crm.getDateC(new Date(newDate.setDate(newDate.getDate() - newDate.getDay()))));
				    $(divTo).html($crm.getDateC(new Date()));
			        break;
			    case 'last_week':
			    	$(divFrom).html($crm.getDateC(new Date(newDate.setDate(newDate.getDate() - newDate.getDay()-7))));
				    $(divTo).html($crm.getDateC(new Date(newDate.setDate(newDate.getDate() - newDate.getDay()+6))));
			        break;
			    case 'this_month':
			    	$(divFrom).html($crm.getDateC(new Date(newDate.getFullYear(), newDate.getMonth(), 1)));
				    $(divTo).html($crm.getDateC(new Date()));
				    break;
			    case 'last_month':
			    	$(divFrom).html($crm.getDateC(new Date(newDate.getFullYear(), newDate.getMonth()-1, 1)));
				    $(divTo).html($crm.getDateC(new Date(newDate.getFullYear(), newDate.getMonth(), 0)));
				    break;
			    case 'lifetime':
			    	$(divFrom).html($crm.getDateC(new Date(newDate.getFullYear()-1, newDate.getMonth(), 1)));
				    $(divTo).html($crm.getDateC(new Date()));
				    break;
			    case value:
			    	var value = value.split("-");
			    	var newDateTmp = new Date(value[1] , value[0]-1,1);
			    	$(divFrom).html($crm.getDateC(new Date(newDateTmp.getFullYear(), newDateTmp.getMonth(), 1)));
			    	$("#dateTo").html($crm.getDateC(new Date(newDateTmp.getFullYear(), newDateTmp.getMonth()+1, 0)));
				    break;
			}
		},
		myDialogConfirm:function(tableId, urlPost, message){
			BootstrapDialog.show({
				title: 'Warning!',
				type: BootstrapDialog.TYPE_DANGER,
				size: BootstrapDialog.SIZE_SMALL,
		        message: message,
		        buttons: [{
		            label: 'Cancel',
		            cssClass: 'btn-primary',
		            action: function(dialog) {                    
		                dialog.close();
		            }
		        },{
		            label: 'OK',
		            cssClass: 'btn-danger',
		            icon: 'glyphicon glyphicon-check',
		            hotkey: 13,
		            action: function(dialog) {                
		            	$crm.myDelete(tableId, urlPost);
		            	dialog.close();
		            }
		        }]
		    });
		},
		getDateC : function(date){
			var month = (date.getMonth()+1)<10 ? "0"+(date.getMonth()+1) : (date.getMonth()+1);
			var day = date.getDate() < 10 ? "0"+date.getDate() : date.getDate();
		    return  date.getFullYear()+ "-" +month+ "-" + day;
		},
		getDateFormat : function(formatter){
		    return  moment().format(formatter);
		},
		radioSelecttime:function(radioName, valHidedId, hidedId, showedId){
			$('input[name="'+radioName+'"]:radio').change(function(){
				if($(this).val() == valHidedId){
					$crm.showIdCustom(hidedId);
					$crm.hideIdCustom(showedId);		
				}else{
					$crm.hideIdCustom(hidedId);
					$crm.showIdCustom(showedId);
				}
			});
		},
		hideIdCustom: function(hidedId){
			$('#'+hidedId).hide();
		},
		showIdCustom: function(showedId){
			$('#'+showedId).show();
		},
		hideClassCustom: function(hidedClass){
			$('.'+hidedClass).hide();
		},
		showClassCustom: function(showedClass){
			$('.'+showedClass).show();
		},
		formatDecimal: function(number, nDecimal) {
			return parseFloat(number).toFixed(nDecimal);
	    },
	    formatNumber: function(num) {
	        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
	    },
	    loadPaging: function (idPaging,totalPage,currentIndex){
			$('#'+idPaging).bootpag({
			    total: totalPage,
			    page: currentIndex,
			    maxVisible: maxVisible,
			    leaps: true,
			    firstLastUse: true,
			    first: 'First',
			    last: 'Last',
			    wrapClass: 'pagination',
			    activeClass: 'active',
			    disabledClass: 'disabled',
			    nextClass: 'next',
			    prevClass: 'prev',
			    lastClass: 'last',
			    firstClass: 'first'
			});
		},
		loadPerPage: function(idPageSize, size){
			var strSelect = '';
			switch(size){
				case 20:
					strSelect = '<option value="10">10</option><option selected value="20">20</option><option value="50">50</option><option value="100">100</option>';
					break;
				case 50:
					strSelect = '<option value="10">10</option><option value="20">20</option><option selected value="50">50</option><option value="100">100</option>';
					break;
				case 100:
					strSelect = '<option value="10">10</option><option value="20">20</option><option value="50">50</option><option selected value="100">100</option>';
					break;
				default:
					strSelect = '<option selected value="10">10</option><option value="20">20</option><option value="50">50</option><option value="100">100</option>';			
			}
			$(idPageSize).html('Display'+ 
					'<select id="size">'+
						strSelect+
					'</select>'+
				'records per page <span style="display: none" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>');
			
		},
		myDialogConfirmFrontEnd: function(idTable, url, message, callback){
			BootstrapDialog.show({
				title: 'Warning!',
				type: BootstrapDialog.TYPE_DANGER,
				size: BootstrapDialog.SIZE_SMALL,
		        message: message,
		        buttons: [{
		            label: 'Cancel',
		            cssClass: 'btn-primary',
		            action: function(dialog) {                    
		                dialog.close();
		            }
		        },{
		            label: 'OK',
		            cssClass: 'btn-danger',
		            icon: 'glyphicon glyphicon-check',
		            hotkey: 13,
		            action: function(dialog) { 
		            	callback(idTable, url);
		            	dialog.close();
		            }
		        }]
		    });
		},
		myDialogConfirmFrontEndA: function(url, message){
			BootstrapDialog.show({
				title: 'Warning!',
				type: BootstrapDialog.TYPE_DANGER,
				size: BootstrapDialog.SIZE_SMALL,
		        message: message,
		        buttons: [{
		            label: 'Cancel',
		            cssClass: 'btn-primary',
		            action: function(dialog) {                    
		                dialog.close();
		            }
		        },{
		            label: 'OK',
		            cssClass: 'btn-danger',
		            icon: 'glyphicon glyphicon-check',
		            hotkey: 13,
		            action: function(dialog) { 
		            	window.location.href = url;  
		            	dialog.close();
		            }
		        }]
		    });
		},
		displayPaging: function (idPaging,totalPage,currentIndex){
			$(idPaging).bootpag({
			    total: totalPage,
			    page: currentIndex,
			    maxVisible: maxVisible,
			    leaps: true,
			    firstLastUse: true,
			    first: 'First',
			    last: 'Last',
			    wrapClass: 'pagination',
			    activeClass: 'active',
			    disabledClass: 'disabled',
			    nextClass: 'next',
			    prevClass: 'prev',
			    lastClass: 'last',
			    firstClass: 'first'
			});
		},
		displaySize: function(idPageSize, size){
			var strSelect = '';
			switch(size){
				case 20:
					strSelect = '<option value="10">10</option><option selected value="20">20</option><option value="50">50</option><option value="100">100</option>';
					break;
				case 50:
					strSelect = '<option value="10">10</option><option value="20">20</option><option selected value="50">50</option><option value="100">100</option>';
					break;
				case 100:
					strSelect = '<option value="10">10</option><option value="20">20</option><option value="50">50</option><option selected value="100">100</option>';
					break;
				default:
					strSelect = '<option selected value="10">10</option><option value="20">20</option><option value="50">50</option><option value="100">100</option>';			
			}
			$(idPageSize).html('Display'+ 
					'<select id="size">'+
						strSelect+
					'</select>'+
				'records per page <span style="display: none" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>');
			
		},
//		showDatafdf: function(param){
//			$crm.showIdCustom(param['idRotate']);
//			$.ajax({
//		    	url:'/admin/performclick/showdata',
//		    	type: 'POST',
//		    	data:{
//		    		date_status		:$('input[name="date_range"]:checked').val(),
//		    		start_date		:$("#dateFrom").text(),
//		    		end_date		:$("#dateTo").text(),
//		    		booking_date	:$("#datePicker").val(),
//		    		view_report_by	:$("#view_report_by").val(),
//		    		filter_name		:$("#filterName").val(),
//					size			:$('#size').val(),
//					index			:param['index'],
//				},
//		    	success:function(result){
//			    	console.log(result);
//			    	if(result == "redirect") { 
//				    	return window.location.href = "/admin/login?v=ajax";  
//				    }    		
//		    		if (result.listData != null){
//			    		/////////// Data Table /////////
//			    		var listData = result.listData;
//	 					$('#table tbody').remove();
//	 					$('#table').append(result.listData);
//						/////////// \.Data Table /////////
//						///////// SizeAndPaging /////////////
//	 					var paging = result.paging;
//	 					$('#showFrom').text(paging.from);
//	 					$('#showTo').text(paging.to);
//	 					$('#showTotal').text(paging.total);
//	 					$crm.displaySize('#displaySize',paging.size);
//	 					$('#size').change(function(){
//	 						var param 			= new Array();
//	 						param['idRotate'] 	= 'displaySize span';
//	 						param['index'] 		= 1;
//	 						showData(param);
//	 					});
//	 					$crm.displayPaging('#displayPaging', paging.total_page, param['index']);
//	 					$('#displayPaging').bootpag().on("page", function(event, num){
//	 						var param 			= new Array();
//	 						param['idRotate'] 	= 'displaySize span';
//	 						param['index'] 		= num;
//	 						showData(param);
//	 					});
//						///////// \.SizeAndPaging /////////////
//						$crm.showIdCustom('contentTable');
//	 		    		$crm.showIdCustom('sizeAndPaging');
//			    		$crm.hideIdCustom(param['idRotate']);
//		    		}else{
//		    			$('#table tbody').remove();
//			    		var string = '<tbody><tr><td style="text-align: center" colspan="5">No data</td></tr></tbody>';
//			    		$('#table').append(string);
//			    		$crm.showIdCustom('contentTable');
//	 		    		$crm.hideIdCustom('sizeAndPaging');
//			    		$crm.hideIdCustom(param['idRotate']);
//			    	}
//				}
//		  	});
//		}
};