$(function(){
	$('.wp-setting-menu li').click(function(){
		$(this).addClass('setting-active').siblings().removeClass('setting-active');
	});

	$('.current-input-container input, .new-input-container input').on('focus', function(){
		$(this).addClass('focus');
	});

	$('.current-input-container input, .new-input-container input').blur('focus', function(){
		if($(this).val() == "")
		$(this).removeClass('focus');
	});

	$('.current-input-container input').on('focus', function(){
		$('#new-block, .wp-current-account-container').removeClass('focus');
		$('#current-block, .wp-new-account-container').addClass('focus');
	});

	$('.new-input-container input').on('focus', function(){
		$('#current-block, .wp-new-account-container').removeClass('focus');
		$('#new-block, .wp-current-account-container').addClass('focus');
	});

	$eye = $('#account-show-pass i');
    $pass = $('#account-pass');

	$('#account-show-pass').click(function(){
		if($pass.attr('type') == 'password'){
			$pass.attr('type', 'text');
			$eye.removeClass('fa-eye-slash');
			$eye.addClass('fa-eye');
		}else{
			$pass.attr('type', 'password');
			$eye.removeClass('fa-eye');
			$eye.addClass('fa-eye-slash');
		}
	});
});