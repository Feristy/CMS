$(document).ready(function(){
	function select(data){
		var id = $(data).attr('data-id');
		var cls = $(data).attr('data-class');
		$(id+' '+cls).attr('selected', 'selected');
	}
	select('.select-active');
	select('.select-active1');
	select('.select-active2');

	$('.file').on('change', function(){
		$('#upload-file').submit();
	});

	$('.file1').on('change', function(){
		$('#upload-file1').submit();
	});

	var burger = 0;
	$(document).on('click', '.burger', function(){
		if(burger == 0){
			$('.admin-menu').addClass('side-in');
			$('.contents').addClass('content-in');
			burger++;
		}else{
			$('.admin-menu').removeClass('side-in');
			$('.contents').removeClass('content-in');
			burger--;
		}
	});

	var burger = 0;
	$(document).on('click', '.burger1', function(){
		if(burger == 0){
			$('.admin-menu').addClass('side-in1');
			burger++;
		}else{
			$('.admin-menu').removeClass('side-in1');
			burger--;
		}
	});

	var adminmenu = $('#data').attr('data-id');
	$(adminmenu+' .submenu').css({'max-height':'initial'});
	$(adminmenu+' .admin-menu-first').removeClass('admin-menu-first').addClass('admin-menu-active');

	$(document).on('click', '.admin-menu-first', function(){
		var panel = this.nextElementSibling;
		$('.admin-menu-active').removeClass('admin-menu-active').addClass('admin-menu-first');
		$('.submenu').css({'max-height':'0px'});
		$(this).removeClass('admin-menu-first').addClass('admin-menu-active');
		panel.style.maxHeight = panel.scrollHeight + "px";
	});
	$(document).on('click', '.admin-menu-active', function(){
		$('.submenu').css({'max-height':'0px'});
		$('.admin-menu-active').removeClass('admin-menu-active').addClass('admin-menu-first');
	});

	$('.input-gambar').click(function(){
		var img = $(this).attr('data-id');
		var name = $(this).attr('data-name');
		$('.input-img').val(name);
		$('.open-explore').css({'display':'none'});
		$('.gambar').css({'display':'block'});
		$('.gambar').attr('src', img);
		$('.remove-gambar').css({'display':'block'});
	});
	$('.remove-gambar').click(function(){
		$('.input-img').val('');
		$('.gambar').css({'display':'none'});
		$('.remove-gambar').css({'display':'none'});
		$('.open-explore').css({'display':'block'});
	});

	var checkid = document.getElementsByClassName('check');
	function check(){
	    for(var i = 0; i < checkid.length; i++){
	    	checkid[i].checked=true
	    }
	}
	
	function uncheck(){
	    for(var i = 0; i < checkid.length; i++){
	    	checkid[i].checked=false
	    }
	}

	$(document).on('click', '.check-true', function(){
		$('.check-true').removeClass('check-true').addClass('check-false');
		check();
	});

	$(document).on('click', '.check-false', function(){
		$('.check-false').removeClass('check-false').addClass('check-true');
		uncheck();
	});
	
	$('.btn-edit').click(function(){
		var id_menu = $(this).attr('data-id');
		var title_menu = $(this).attr('data-title');
		var url_menu = $(this).attr('data-url');

		$('.edit-menu-id').val(id_menu);
		$('.edit-menu-title').val(title_menu);
		$('.edit-menu-url').val(url_menu);
	});

	//select submit grup
	$('#submit-grup').on('change', function(){
		$('#select-grup').submit();
	});
});