$(function(){
 	$(".click").click(function () {
 		$(".suppression").addClass("active");
 		let maClass = $(".suppression").attr("id")
 		console.log(maClass);
 	})
 	$(".non").click(function () {
 		$(".suppression").removeClass("active");
 	})
});