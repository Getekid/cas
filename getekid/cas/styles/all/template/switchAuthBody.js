$(document).ready(function() {
	$(".login-title").hide();
	$(".fields1").hide();
});

$("#switchAuth").click(function(){
	$(".login-cas-title").hide(500);
	$(".fields2").hide(500);
	$(".login-title").show(500);
	$(".fields1").show(500);
});
