var features = {};
features.featuresElement = "";
features.previewElement = "";
features.firstRow = null;
features.rowHeaders = null;
features.count = 0;

features.init = function(featuresElem,previewElement){
	features.featuresElement = featuresElem;
	features.previewElement = previewElement;
}

features.addFeature = function(name,value){
	elem = features.featuresElement;
	if(value == null){ value = features.getNextValue(); }
	if(name == null){ name = features.getValueHeader(value); }
	var field = "";
	
	field = '<div class="feature form-group ui-state-default">';
	field += '<div class="row">';
	field += '<div class="col-xs-5">';
	field += '<input class="form-control input-sm featureName" type="text" name="feature['+features.count+'][name]" value="'+name+'">';	
	field += '</div>';
	field += '<div class="col-xs-5">';
	field += '<select class="form-control input-sm featuresDropdown" onchange="features.changed(this)" name="feature['+features.count+'][colNum]">';
	field += features.getSelectBoxHTML();
	field += '</select>';
	field += '</div>';
	field += '<div class="col-xs-2 text-right">';
	field += '<div class="btn-group" role="group">';
	field += '<span class="glyphicon glyphicon-trash btn btn-sm btn-default" onclick="features.removeFeature(this)"><span class=""></span></span>';
	field += '<span class="handle glyphicon glyphicon-sort btn btn-sm btn-default"><span class=""></span></span>';
	field += '</div>';
	field += '</div>';
	field += '</div>';
	field += '</div>';
	
	$(elem).append(field);
	$(".feature").last().find('select').val(value);
	features.count++;
}

features.setRowHeaders = function(data){
	features.rowHeaders = JSON.parse(data);
}

features.getNextValue = function(){
	var next = parseInt($(".feature").last().find('.featuresDropdown :selected').val())+1;
	if(isNaN(next)){return 0;}
	
	return next;
}

features.getValueHeader = function(valueId){
	return features.rowHeaders[valueId];
}

features.removeFeature = function(elem){
	$(elem).parents('.feature').remove();
	features.count--;
}

features.removeLastFeature = function(){
	$(".feature").last().remove();
	features.count--;
}

features.setSelectBoxHTML = function(html){
	features.selectBoxHTML = html;
}

features.getSelectBoxHTML = function(){
	return features.selectBoxHTML;
}

features.changed = function(elem){
	$(elem).parents('.feature').find('.featureName').val(features.getValueHeader($(elem).val()));	
}

features.setFirstRowData = function(data){
	features.firstRow = JSON.parse(data);	
}

features.getRowValue = function(index){
	return features.firstRow[index];	
}

features.getItemTitle = function(){
	title = $("#make").val()+" ";
	title += features.getRowValue($("#model").val())+" ";
	title += features.getRowValue($("#type").val());
	
	return title;	
}

features.getItemPriceResale = function(){
	price = parseFloat(features.getRowValue($("#nettPrice option:selected").val()));
	percentage = (parseInt($("#priceIncrease").val()) / 100) + 1;
	
	return (price * percentage).toFixed(2);
}

features.getItemDimensions = function(){
	dimensions = features.getRowValue($("#width").val())+"mm (W) x ";
	dimensions += features.getRowValue($("#depth").val())+"mm (D) x ";
	dimensions += features.getRowValue($("#height").val())+"mm (H)";
	
	return dimensions;
}

features.getItemImage = function(){
	image = features.getRowValue($("#imageFilename").val());
	
	if(image.indexOf(";") >= 0){
		images = image.split(";");
		image = images[0];
	}
	
	imageUrl = $("#imageLibrary").val();
	imageUrl += image;
	
	return imageUrl;
}

features.updateItemPreview = function(){
	elem = features.previewElement;	
	data = '<div class="item">';
	data += '<div class="item-image">';
	data += '<img src="'+features.getItemImage()+'">';
	data += '</div>';
	data += '<div class="item-content">';
	data += '<span class="item-title">'+features.getItemTitle()+'</span>';
	data += '<span class="item-price">Price: £'+features.getItemPriceResale()+' <small>excl VAT</small></span>';
	data += '<span class="item-dimensions">Dimensions: '+features.getItemDimensions()+'</span>';
	data += '</div>';
	data += '</div>';
	$(elem).html(data);
}