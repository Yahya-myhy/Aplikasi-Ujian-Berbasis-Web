

jQuery(document).ready(function(){
	
	// Transform upload file
	jQuery('.uniform-file').uniform();
	
	// Date Picker
	jQuery("#datepicker").datepicker();
	
	// Dual Box Select
	var db = jQuery('#dualselect').find('.ds_arrow button');	//get arrows of dual select
	var sel1 = jQuery('#dualselect select:first-child');		//get first select element
	var sel2 = jQuery('#dualselect select:last-child');			//get second select element
	
	sel2.empty(); //empty it first from dom.
	
	db.click(function(){
		var t = (jQuery(this).hasClass('ds_prev'))? 0 : 1;	// 0 if arrow prev otherwise arrow next
		if(t) {
			sel1.find('option').each(function(){
				if(jQuery(this).is(':selected')) {
					jQuery(this).attr('selected',false);
					var op = sel2.find('option:first-child');
					sel2.append(jQuery(this));
				}
			});	
		} else {
			sel2.find('option').each(function(){
				if(jQuery(this).is(':selected')) {
					jQuery(this).attr('selected',false);
					sel1.append(jQuery(this));
				}
			});		
		}
		return false;
	});	
	
	// Tags Input
	jQuery('#tags').tagsInput();

	// Spinner
	jQuery("#spinner").spinner({min: 0, max: 100, increment: 2});
	
	// Character Counter
	jQuery("#textarea2").charCount({
		allowed: 120,		
		warning: 20,
		counterText: 'Characters left: '	
	});
	
	// Select with Search
	jQuery(".chzn-select").chosen();
	
	// Textarea Autogrow
	jQuery('#autoResizeTA').autogrow();	
	
	
	// With Form Validation
	jQuery("#form1").validate({
		rules: {
			nama: "required",
			tempatlahir: "required",
			tanggal_lahir: "required",
			email: {
				required: true,
				email: true,
			},
			alamat: "required",
			agama: "required",
			sekolah: "required",
			wali: "required",
			telp: "required",
			jenis_kelamin: "required"
		},
		messages: {
			nama: "Masukkan Nama anda",
			tempatlahir: "Tuliskan Tempat/Kota Anda dilahirkan",
			tanggal_lahir: "Pilih Tanggal Lahir",
			email: "Please enter a valid email address",
			alamat: "Masukkan Alamat Anda Tinggal",
			agama: "Anda Belum Menentukan Agama",
			sekolah: "Pilih Dengan Sekolah Anda Sebelumnya, Jika Tidak ada hubungi Pihak Sekolah",
			wali: "Siapa Wali Anda",
			telp: "Berika Nomer Telp Yang Bisa Dihubungi",
			jenis_kelamin: "Anda Belum Menentukan Jenis Kelamin Anda"
		},
		highlight: function(label) {
			jQuery(label).closest('.control-group').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('Sudah Benar !').addClass('valid')
	    		.closest('.control-group').addClass('success');
	    }
	});
	
	jQuery('#timepicker1').timepicker();
	
});