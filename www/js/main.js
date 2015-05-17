$(function(){
  $('.datepicker').pickadate({
    selectMonths: false, // Creates a dropdown to control month
  });
});
$(function () {
    $.nette.init();
});

/*
 * Function inicilaize form input
 */
function initInput()
{
	$("input").each(function(){
		if(typeof($(this).val()) != "undefined" && $(this).val() !== null && $(this).val() != "")
		{
			var $label = $("label[for='"+this.id+"']")
			$label.addClass('active') ;
		}
	});
};