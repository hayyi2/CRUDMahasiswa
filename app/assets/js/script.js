var api = "http://localhost/ade/webservice/mahasiswa.php";

function numbering() {
	$('[numbering]').each(function(i) {
		var el = $(this);
		$(this).text((++i) + ". ");
	});
}

function show_all_data() {
	$.ajax({
		method: "get",
		url: api,
	}).done(function( respon ) {
		if (respon[0]) {
			$('[body-data]').html("");
			var target = $('[body-data]');
			var master = $('.master');
			respon[1].forEach(function(data) {
				$('.master #nama-nim a').attr('show_data', data.id_mahasiswa);
				$('.master #nama-nim a').text(data.nama + "/ " + data.nim);
				$('.master [edit_data]').attr('edit_data', data.id_mahasiswa);
				$('.master [delete_data]').attr('delete_data', data.id_mahasiswa);
				$(master.html()).appendTo('[body-data]');
			});
			numbering();
		}else{
			alert('Error.');
		}
	});
}

$(function() {
	show_all_data();
	$(document).on('click', '[show_data]', function () {
		var el = $(this);
		$('[page]').hide();
		$('#page-single').show();
		var id = el.attr('show_data');

		$.ajax({
			method: "get",
			url: api + "?id=" + id,
		}).done(function( respon ) {
			if (respon[0]) {
				var target = $('[body-data]');
				var master = $('.master');
				for (var key in respon[1]){
					$('[item=' + key + ']').text(respon[1][key]);
				}
			}else{
				alert('Error.');
			}
		});
	});
	$(document).on('click', '[show_all_data]', function () {
		$('[page]').hide();
		$('#page-data').show();
	});
	$(document).on('click', '[add_data]', function () {
		$('[page]').hide();
		$('#page-input').show();
		$('[title_mode]').attr('title_mode', 'add');
		$('[title_mode]').text('Input Mahasiswa');
		$('[name]').val('');
	});
	$(document).on('click', '[edit_data]', function () {
		var el = $(this);
		$('[page]').hide();
		$('#page-input').show();
		$('[title_mode]').text('Edit Mahasiswa');
		var id = el.attr('edit_data');
		$('[title_mode]').attr('title_mode', id);

		$.ajax({
			method: "get",
			url: api + "?id=" + id,
		}).done(function( respon ) {
			if (respon[0]) {
				var target = $('[body-data]');
				var master = $('.master');
				for (var key in respon[1]){
					$('[name=' + key + ']').val(respon[1][key]);
				}
			}else{
				alert('Error.');
			}
		});
	});

	$(document).on('submit', '[input]', function () {
		if ($('[title_mode]').attr('title_mode') == 'add') {
			$.ajax({
				method: "post",
				url: api,
				data: $('[input]').serialize()
			}).done(function( respon ) {
				if (respon[0]) {
					show_all_data();
					$('[page]').hide();
					$('#page-data').show();
					alert('Success Tambah Data.');
				}else{
					alert('Error.');
				}
			});
		}else{
			var id = $('[title_mode]').attr('title_mode');
			$.ajax({
				method: "put",
				url: api + "?id=" + id,
				data: $('[input]').serialize()
			}).done(function( respon ) {
				if (respon[0]) {
					show_all_data();
					$('[page]').hide();
					$('#page-data').show();
					alert('Success Edit Data.');
				}else{
					alert('Error.');
				}
			});
		}
		return false;
	});
	$(document).on('click', '[delete_data]', function () {
		var el = $(this);
		var id = el.attr('delete_data');
		if (confirm("Anda yakin hapus data?")) {
			$.ajax({
				method: "delete",
				url: api + "?id=" + id
			}).done(function( respon ) {
				if (respon[0]) {
					show_all_data();
					$('[page]').hide();
					$('#page-data').show();
					alert('Success Delete Data.');
				}else{
					alert('Error.');
				}
			});
		}
	});
});