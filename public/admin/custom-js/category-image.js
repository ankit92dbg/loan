function showImgInDiv(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(input).parent('div').find('img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function triggerInputFile(){
   $('.categoryImgDiv').off('click');
   $('.categoryImgDiv').on('click', function(event){
      let input_name = $(this).data('name');
      $('input[name='+input_name+']').trigger('click');
   });
}