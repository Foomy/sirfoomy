function type_text() {
	contents='';
	row=Math.max(0,index-7);

	while(row<index)
		contents += tl[row++] + '\r\n';
	document.forms[0].elements[0].value = contents + tl[index].substring(0,text_pos) + '_';

	if(text_pos++==str_length) {
		text_pos=0;
		index++;
		if(index!=tl.length) {
			str_length=tl[index].length;
			setTimeout('type_text()',1000);
		}
	}
	else {
		setTimeout('type_text()',speed);
	}
}//type_text()

function setExternalLinks() {

	if ( ! document.getElementsByTagName ) {
		return null;
	}

	var anchors = document.getElementsByTagName('a');

	for (var i=0; i<anchors.length; i++) {
		var anchor = anchors[i];
		if ( anchor.getAttribute('href') && anchor.getAttribute('rel')=='extern' ) {
			anchor.setAttribute('target', 'blank');
		}
	}
}// setExternalLinks()

function parseElementId(elementId) {
	return({
		action: elementId.split('_')[0],
		id: elementId.split('_')[1]
	});
}// splitElementId()
