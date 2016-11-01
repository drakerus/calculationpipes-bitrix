$(document).ready(function()
{
	$('body').on('change','input.litrs',function()
	{
		var val=$(this).val();
		$('#litr_interval').val(val);
	});

	$('body').on('submit','form#calculate_form',function()
	{

		$('#id1').click();
		var str=$(this).serialize();


		$.ajax({
		   type: "POST",
		   url: "/ajax/podbor_obogreva_trub.php",
		   data: str,
		   success: function(msg){
			$('.resultat_serch').html(msg);
		   }
		});
		return false;
	});
})