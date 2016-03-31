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
		active_menu:function(var1, var2){
			$("#"+var1).addClass("active");
			$("#"+var1+"I").removeClass("fa-angle-left");
			$("#"+var1+"I").addClass("fa-angle-down");
			$("#"+var1+" ul").css("display","block");
			$("#"+var2).addClass("active");
		},
		autoCloseMessage:function(){
			setTimeout(function(){ $("#messageResult").alert('close'); }, 1000);
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
		myDialogConfirmNew:function(Id, urlPost, message){
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
		            	$crm.myDeleteNew(Id, urlPost);
		            	dialog.close();
		            }
		        }]
		    });
		},
		myDeleteNew:function(idTable, urlDelete){
			$.ajax({
		    	url:urlDelete,
		    	type: 'POST',
		    	data:{
		    		select_all:idTable,
				},
		    	success:function(result){
					BootstrapDialog.show({
						title: 'Warning!',
						type: BootstrapDialog.TYPE_DANGER,
						size: BootstrapDialog.SIZE_SMALL,
						message: result.messenger,
						buttons: [{
							label: 'OK',
							cssClass: 'btn-danger',
							icon: 'glyphicon glyphicon-check',
							hotkey: 13,
							action: function(dialog) {           
								dialog.close();
							}
						}]
					});
					if(result.f==1){
						window.location.href = result.href;
					}
		    		
				}
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
		    if($('#'+idTable+' #'+idCheckAll).prop("checked")) {
		        $('#'+idTable+' .'+idCheckAll+'Location').each(function() {this.checked = true;});
		        $('#'+idTable+' .'+idCheckAll+'Ap').each(function() {this.checked = true;});
		    }else{
		        $('#'+idTable+' .'+idCheckAll+'Location').each(function(){this.checked = false;});  
		        $('#'+idTable+' .'+idCheckAll+'Ap').each(function() {this.checked = false;});       
		    }
		},
		checkLocation:function(idLocation, idCheckAll, idTable){
		    if($('#'+idTable+' #'+idLocation).prop("checked")) {
		        $('#'+idTable+' .'+idLocation).each(function() {this.checked = true;});
		    }else{
		        $('#'+idTable+' .'+idLocation).each(function(){this.checked = false;});         
		    }
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
		link_unlink:function(idTableFrom, idTableTo, idTable, submitName, contentSearch){
			var list_ap = [];
			$('#'+idTable+' .chooseAp').each(function(){
		        if (this.checked) list_ap.push($(this).val());
			});
			if (list_ap.length != 0 || $('#import_booking').attr('id') == 'import_booking'){
				$.ajax({
			    	url:'/booking/linkUnlinkAjax',
			    	type: 'POST',
			    	data:{
			    		submit:submitName,
			    		list_ap:list_ap,
			    		search:contentSearch
					},
			    	success:function(result){
			    		// console.log(result);
			    		if(result == "redirect") { 
					    	return window.location.href = "/login?v=ajax";  
					    } 
						if (idTableFrom == 'tableFrom'){
							$('#title_from').html(
								'<b>Location: <i style="color:red">'+result.totalFromL+'</i>'+
								'<br> Accesspoint: <i style="color:red">'+result.totalFromA+'</i></b>'
							);
							$('#title_to').html(
								'<b>Location: <i style="color:red">'+result.totalToL+'</i>'+
								'<br> Accesspoint: <i style="color:red">'+result.totalToA+'</i></b>'
							);
						}else {
							$('#title_from_info').html(
								'<b>Location: <i style="color:red">'+result.totalFromL+'</i>'+
								'<br> Accesspoint: <i style="color:red">'+result.totalFromA+'</i></b>'
							);
							$('#title_to_info').html(
								'<b>Location: <i style="color:red">'+result.totalToL+'</i>'+
								'<br> Accesspoint: <i style="color:red">'+result.totalToA+'</i></b>'
							);
						}
						var listLF = result.listLocationFrom;
						if (listLF != null){
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
						}
						if (listLF != null){
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
	    	    		console.log(result);
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
//				$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
				$("#sec").html("59");
			},1000);
			setInterval( function() {
				// Create a newDate() object and extract the minutes of the current time on the visitor's
				var minutes = new Date().getMinutes();
				// Add a leading zero to the minutes value
//				$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
				$("#min").html("59");
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
			var oneDate = 86400000;
			var startDay = 1; //0=sunday, 1=monday etc.
			switch (value) {
			    case 'today':
				    $(divFrom).html($crm.getDateC(newDate));
				    $(divTo).html($crm.getDateC(newDate));
			        break;
			    case 'yesterday':
			    	$(divFrom).html($crm.getDateC(new Date(newDate.getTime()-oneDate)));
				    $(divTo).html($crm.getDateC(new Date(newDate.getTime()-oneDate)));
			        break;
			    case 'this_week':
					var d = newDate.getDay(); //get the current day
					var weekStart = new Date(newDate.valueOf() - (d<=0 ? 7-startDay:d-startDay)*oneDate);
			    	// $(divFrom).html($crm.getDateC(new Date(newDate.setDate(newDate.getDate() - newDate.getDay()))));
					$(divFrom).html($crm.getDateC(weekStart));
				    $(divTo).html($crm.getDateC(new Date()));
			        break;
			    case 'last_week':
					var lastWeek = new Date(newDate.getFullYear(), newDate.getMonth(), newDate.getDate() - 7);
					var d = lastWeek.getDay(); //get the current day
					var weekStart = new Date(lastWeek.valueOf() - (d<=0 ? 7-startDay:d-startDay)*oneDate);
					var weekEnd = new Date(weekStart.valueOf() + 6*oneDate);
			    	$(divFrom).html($crm.getDateC(weekStart));
				    $(divTo).html($crm.getDateC(weekEnd));
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
			    	var newDate2 = new Date();
			    	$(divFrom).html($crm.getDateC(new Date(newDate.getTime()-oneDate*366)));
				    $(divTo).html($crm.getDateC(new Date(newDate2.getTime()-oneDate)));
				    break;
			    case value:
			    	var value = value.split("-");
			    	var newDateTmp = new Date(value[1] , value[0]-1,1);
			    	$(divFrom).html($crm.getDateC(new Date(newDateTmp.getFullYear(), newDateTmp.getMonth(), 1)));
			    	$(divTo).html($crm.getDateC(new Date(newDateTmp.getFullYear(), newDateTmp.getMonth()+1, 0)));
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
	    	if(num == null){
	    		return 0;
	    	}
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
		showInfoData: function(type){
			if(type==1) $crm.showIdCustom('btn_viewInfo');
			else $crm.hideIdCustom('btn_viewInfo');
		},
		lineChartCustom:function(id, data, title_,name,value1,value2,format) {
			var n ,temp=false;
			google.setOnLoadCallback($(document).ready(drawChart),true);
			function drawChart() {
				var dataChart = new google.visualization.DataTable();
				dataChart.addColumn('datetime', 'Date');
				dataChart.addColumn('number', value1);
				dataChart.addColumn('number', value2);
				if(data!=null && data!=0) n = data.length ;
				else n = 0;
				for(var i = 0; i < n ;i++){
					dataChart.addRow([new Date(data[i][name]),parseInt(data[i][value1]),parseInt(data[i][value2])]);
					if(parseInt(data[i][value1])!=0 || parseInt(data[i][value2])!=0) temp=true;
				}
				if(temp==false)
					dataChart.removeRows(0, n);
				var options = {
					title : '',
					width:1100,
                    height:300,
					hAxis: {
		                format: format,
		            },
			        vAxis: {
			        },
			        legend: { position: 'right' },
			        pointSize : 5,
				};
				var chart = new google.visualization.LineChart(document
						.getElementById(id));
				chart.draw(dataChart, options);
			}
		},pieChartCustom:function(id, data, title_,titleData,value) {
			var n,temp=false;
			google.setOnLoadCallback($(document).ready(drawChart), true);
			function drawChart() {
				var dataChart = new google.visualization.DataTable();
				dataChart.addColumn('string', 'Task');
				dataChart.addColumn('number', 'Hours per Day');
				if(data!=null && data!=0) n = data.length ;
				else n = 0;
				for(var i = 0; i < n ;i++){
					dataChart.addRow([data[i][titleData],parseInt(data[i][value])]);
					if(parseInt(data[i][value])!=0) temp=true;
				}
				if(temp==false)
					dataChart.removeRows(0, n);
				var options = {
					title : title_,
					width:500,
                    height:300,
					chartArea: {width: '90%',height:'90%'}
				};
				var chart = new google.visualization.PieChart(document
						.getElementById(id));
				chart.draw(dataChart, options);
			}
		},
		createaTag:function(url){
			if(navigator.userAgent.indexOf("Firefox") != -1 ){
				window.open(url,'_blank');
		    }else if(navigator.userAgent.indexOf("Chrome") != -1 ){
		    	var a = document.createElement("a");
				a.target = "_blank";
				a.href = url;
				a.click();
			}
			
		},
		createDataTableId:function(idTable){
			var dTable = $(idTable).dataTable({
				"bAutoWidth": false,
			});
		},
		autoScrollTop:function(idScroll,heightCustom){
			$('html,body').animate({ scrollTop: $("#"+idScroll).offset().top - heightCustom }, 100);
		}
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