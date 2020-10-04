$(document).ready(function(){
	var $image = $(".image-crop > img")
    var cropper;
    $image.cropper({
        aspectRatio: 1 / 1,
        preview: ".img-preview",
        
        crop: function(e) {
            // Output the result data for cropping image.
            
           /* console.log(e.x);
            console.log(e.y);
            console.log(e.width);
            console.log(e.height);
            console.log(e.rotate);
            console.log(e.scaleX);
            console.log(e.scaleY);*/
        },            
    });

    var $inputImage = $("#inputImage");
    if (window.FileReader) {
        $inputImage.change(function() {
            var fileReader = new FileReader(),
                    files = this.files,
                    file;

            if (!files.length) {
                return;
            }

            file = files[0];

            if (/^image\/\w+$/.test(file.type)) {
                fileReader.readAsDataURL(file);
                fileReader.onload = function () {
                    $inputImage.val();
                    $image.cropper("reset", true).cropper("replace", this.result);
                };
            } else {
                showMessage("Please choose an image file.");
            }
        });
    } else {
        $inputImage.addClass("hide");
    }

    $('#guardar').click(function(){
    		
            $image.cropper('getCroppedCanvas').toBlob(function (blob) {
            

            var formData = new FormData();
            var token = $('meta[name="csrf-token"]').attr('content');
            
            formData.append('imagen',$image.cropper('getCroppedCanvas',{
              width: 256,
              height: 256,
              
            }).toDataURL("image/png"));
            formData.append("_token", token);
            // Use `jQuery.ajax` method
            $.ajax( {
	            url:'../../saveProfileImage',
	            type:'post',
	            data: formData,
	            processData: false,
	            contentType: false,
	            success: function (data) {
	            	$('#img').attr("src","../../../img/perfil/"+data);
	            	$('#im').attr("src","../../../img/perfil/"+data);
	            	$('#myModal').modal('hide');
	                
	            },
	            error: function (e) {
	            	console.log(e.responseJSON);
	            
	            }
            });
        });
    });	
});