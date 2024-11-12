function onclick_soldout() {
	if( true == document.form.soldout.checked ) {
		document.form.opportunities_in.checked = false;
	}
}

function onclick_opport() {
	if( true == document.form.opportunities_in.checked ) {
		document.form.soldout.checked = false;
	}
}
