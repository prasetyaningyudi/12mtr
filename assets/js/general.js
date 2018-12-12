var the_data;
function get_data(url_class){
	$.ajax({
		type  : 'ajax',
		url   : url_class+'/list',
		async : true,
		dataType : 'json',
		success : function(data){
			the_data = data;
			if(data.type == 'table'){
				hide_toolbar();
				generate_table();
			}else if(data.type == 'modal'){
				data_modal(data.data);
			}else{
				
			}
		}
	});	
}

function hide_toolbar(){
	console.log( 'show or hide toolbar button' );
	if(the_data.data.insertable == true){
		$(".button-add").show();
	}else{
		$(".button-add").hide();
	}
	if(the_data.data.pdf == true){
		$(".button-pdf").show();
	}else{
		$(".button-pdf").hide();
	}
	if(the_data.data.xls == true){
		$(".button-xls").show();
	}else{
		$(".button-xls").hide();
	}
	if(the_data.data.filters != null){
		$(".button-filter").show();
	}else{
		$(".button-filter").hide();
	}	
}

function generate_table(){
	console.log('generate table start');
	var html = '';
	html += '<table class="table'+table_classes(the_data.data.classes)+'">';
	html += '<thead>';
	html += set_table_header();
	html += '</thead>';
	html += '<tbody>';
	html += set_table_body();
	html += '</tbody>';
	html += '</table>';
	console.log('generate table finished');
	$('#show-data').html(html);	
}

function set_table_header(){
	console.log('set table header');
	var html = '';
	var i;
	var j;
	for(i=0; i<the_data.data.header.length; i++){
		html += '<tr>';
		for(j=0; j<the_data.data.header[i].length; j++){
			html += '<td class="align-middle '+ text_classes(the_data.data.header[i][j].classes)+ '" ';     
			if(the_data.data.header[i][j].rowspan != null){
				html += 'rowspan="'+the_data.data.header[i][j].rowspan+'" ';	
			}
			if(the_data.data.header[i][j].colspan != null){
				html += 'colspan="'+the_data.data.header[i][j].colspan+'" ';	
			}							
			html += '>';
			html += the_data.data.header[i][j].value;
			html += '</td>';
		}
		if(the_data.data.editable == true || the_data.data.deletable == true || the_data.data.statusable == true || the_data.data.detailable == true){
			if(i==0){
				html += '<td class="align-middle text-center font-weight-bold" rowspan="'+the_data.data.header.length+'" colspan="4">Action';
				html += '</td>'; 
			}
		}
		html += '</tr>';
	}
	return html;
}

function set_table_body(){
	console.log('set table body');
	var html = '';
	var i;
	var j;
	for(i=0; i<the_data.data.body.length; i++){
		html += '<tr>';
		for(j=0; j<the_data.data.body[i].length; j++){
			if(the_data.data.body[i][j].classes.includes("hidden") == true){
				
			}else{
				html += '<td class="'+ text_classes(the_data.data.body[i][j].classes) +'"';
				if(the_data.data.body[i][j].rowspan != null){
					html += 'rowspan="'+the_data.data.body[i][j].rowspan+'" ';	
				}
				if(the_data.data.body[i][j].colspan != null){
					html += 'colspan="'+the_data.data.body[i][j].colspan+'" ';	
				}
				html += '>';
				html += the_data.data.body[i][j].value;
				html += '</td>';
			}
		}
		if(the_data.data.body.length == 1 & the_data.data.body[i][0].classes.includes("empty") == true){
			
		}else{
			if(the_data.data.statusable == true){
				html += '<td class="text-center font-weight-bold">';
				html += '<a class="item-status" id="'+the_data.data.body[i][0].value+'" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="edit status"><i style="font-size: 16px;" class="fa fa-check"></i></a>';
				html += '</td>';
			}					
			if(the_data.data.editable == true){
				html += '<td class="text-center font-weight-bold">';
				html += '<a class="item-edit" id="'+the_data.data.body[i][0].value+'" href="javascript:void(0);" data-toggle="modal" data-target="#modal-edit" title="edit"><i style="font-size: 16px;" class="fas fa-edit"></i></a>';
				html += '</td>';
			}
			if(the_data.data.deletable == true){
				html += '<td class="text-center font-weight-bold">';
				html += '<a class="item-delete" id="'+the_data.data.body[i][0].value+'" href="javascript:void(0);" data-toggle="modal" data-target="#modal-delete" title="delete"><i style="font-size: 16px;" class="fas fa-trash"></i></a>';
				html += '</td>';
			}
			if(the_data.data.detailable == true){
				html += '<td class="text-center font-weight-bold">';
				html += '<a class="item-detail" id="'+the_data.data.body[i][0].value+'" href="javascript:void(0);" data-toggle="modal" data-target="#modal-detail" title="detail"><i style="font-size: 16px;" class="fas fa-info"></i></a>';
				html += '</td>';
			}			
		}					
		html += '</tr>';
	}
	return html;
}

function table_classes(value){
	var table='';
	if(value.includes("striped") == true){
		table += ' table-striped';
	}
	if(value.includes("bordered") == true){
		table += ' table-bordered';
	}
	if(value.includes("hover") == true){
		table += ' table-hover';
	}
	return table;
}

function text_classes(value){
	var fontweight;
	var fontitalic;
	var texttransform;
	var textalign;	
	
	if(value.includes("bold") == true){
		fontweight= 'font-weight-bold';
	}else if(value.includes("light") == true){
		fontweight= 'font-weight-light';
	}else if(value.includes("normal") == true){
		fontweight= 'font-weight-normal';
	}else{
		fontweight= 'font-weight-normal';
	}
	
	if(value.includes("italic") == true){
		fontitalic= 'font-italic';
	}else{
		fontitalic= '';
	}
	
	if(value.includes("uppercase") == true){
		texttransform= 'text-uppercase';
	}else if(value.includes("lowercase") == true){
		texttransform= 'text-lowercase';
	}else if(value.includes("capitalize") == true){
		texttransform= 'text-capitalize';
	}else{
		texttransform= '';
	}			
	
	if(value.includes("align-left") == true){
		textalign= 'text-left';
	}else if(value.includes("align-center") == true){
		textalign= 'text-center';
	}else if(value.includes("align-right") == true){
		textalign= 'text-right';
	}else{
		textalign= 'text-left';
	}

	return (fontweight+ ' ' + fontitalic + ' ' + texttransform + ' ' + textalign);
}

