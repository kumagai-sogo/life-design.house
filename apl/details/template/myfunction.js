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

function reload_select(mode) {
	form1.mode.value = mode;
	form1.mom_dog.selectedIndex = 0;
	form1.dad_dog.selectedIndex = 0;
	form1.submit();
}