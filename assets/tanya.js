

//Konfigurasi tinyMCE dengan fitur full
   tinyMCE.init({
      selector: ".rich",
      height: 150,
      
      plugins: [
         "tiny_mce_wiris"
      ],
      toolbar: "insertfile undo redo | bold italic tiny_mce_wiris_formulaEditor",
	      
      external_filemanager_path:"../assets/filemanager/",
      filemanager_title:"File Manager" ,
      external_plugins: { "filemanager" : "../filemanager/plugin.min.js"}
   });


