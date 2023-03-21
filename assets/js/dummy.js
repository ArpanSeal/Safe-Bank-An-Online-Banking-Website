$(document).ready(function () {

	$('#file').change(function () {
		let fileSize = $(this)[0].files[0].size;

		let fileStr = $(this).val();
		let test = fileStr.match(/(.+)\.(.+)/);

		let filename = test[1];
		let filext = test[2];

		if (fileSize < 2000000) {
			if (filext == 'jpg' || filext == 'png' || filext == 'jpeg') {
				alert("match Found");
			}
			else {
				alert("invalid file extention");
			}
		}
		else{
			alert("File is too big");
		}

	});


});
