
$( document ).ready(function() {
var a4_page_height = 3508;
var section_info_height = $('#section_info').height();
var section_package_height = $('#section_package').height();
var section_instalment_height = $('#section_instalment').height();
var section_fine_height = $('#section_fine').height();
var section_heads_height = $('#section_heads').height();
var section_footer_height = $('#section_footer').height();

var page_break_class = 'page-break-after';
var margin_bottom = 20;

	var remain = a4_page_height - (section_fine_height + section_heads_height);
	remain = remain - section_footer_height;
	remain_percentage = (remain / a4_page_height) * 100;
	// $("#section_footer").css({'margin-top': (remain_percentage - 10)+'%'});
	// debugger;

	// var page_height_remain = a4_page_height - (section_info_height+section_package_height+section_footer_height);
	// if ((page_height_remain - margin_bottom) > section_instalment_height) {
	// 	page_height_remain = page_height_remain - section_instalment_height;
	// } else if ((page_height_remain - margin_bottom) < section_instalment_height) {} {

	// }

});