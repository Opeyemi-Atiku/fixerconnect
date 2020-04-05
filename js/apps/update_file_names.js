$('#file-upload').change(function(){
  readImgUrlAndPreview(this);
  function readImgUrlAndPreview(input){
    console.log(input);
    if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#job_media_').text($('#file-upload')[0].files[0]['name']);
      }
    }
    reader.readAsDataURL(input.files[0]);
  }
});

$('#file-uploads').change(function(){
  readImgUrlAndPreview(this);
  function readImgUrlAndPreview(input){
    console.log(input);
    if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#job_medias_').text($('#file-uploads')[0].files[0]['name']);
      }
    }
    reader.readAsDataURL(input.files[0]);
  }
});
