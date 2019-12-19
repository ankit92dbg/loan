$(document).ready(function(){
   triggerInputFile();
   addBannerRow();
   addGalleryRow();
   addTagRow();
})

function cropArea(type){
  let obj;
  switch(true){
    case /logo_image/.test(type):
      obj = {
       aspectRatio: '1:1',
       x1: 0, y1: 0, x2: 80, y2: 80,
       maxWidth: 400, maxHeight: 400,
       handles: true,
       //fadeSpeed: 200,
       onSelectChange: preview 
     };
     break;

    case /card_image/.test(type):
      obj = {
       aspectRatio: '8:5',
       x1: 0, y1: 0, x2: 250, y2: 150,
       maxWidth: 1000, maxHeight: 600,
       handles: true,
       //fadeSpeed: 200,
       onSelectChange: preview 
     };
     break;

    case /banner/.test(type):
      obj = {
       //aspectRatio: '1:1',
       x1: 0, y1: 0, x2: 250, y2: 380,
       minWidth: 250, maxWidth: 600, minHeight: 380, maxHeight: 380,
       handles: true,
       //fadeSpeed: 200,
       onSelectChange: preview 
     };
     break;

    case /gallery/.test(type):
      obj = {
       aspectRatio: '1:1',
       x1: 0, y1: 0, x2: 200, y2: 200,
       maxWidth: 800, maxHeight: 800,
       handles: true,
       //fadeSpeed: 200,
       onSelectChange: preview 
     };
     break;

    default:
     break;
  }


  $('#photo').imgAreaSelect(obj);
}

function showImgInDiv(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('div#modal-images').find('img').attr('src', e.target.result);
            $('#modal-images').modal({backdrop:'static'});
            $('#modal-images').modal('show');
            modalOK();
            setTimeout(function(){cropArea($('#inputName').val())},800);
            //$(input).parent('div').find('img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        modalCancel();
    }
}

function triggerInputFile(){
   $('.listingImgDiv').off('click');
   $('.listingImgDiv').on('click', function(event){
      let input_name = $(this).data('name');
      $('input[type=file].'+input_name).trigger('click');
      $('#inputName').val(input_name);
   });
}

function preview(img, selection) {
    if (!selection.width || !selection.height)
        return;
      let fh = $('#photo').height();
      let fw = $('#photo').width();
    $('#cropSizeModal').val(selection.x1+'#'+selection.y1+'#'+selection.width+'#'+selection.height+'#'+fw+'#'+fh);//x1#y1#x2#y2#width#height#fakewidth#fakeheight
}

function modalOK(){
    $('#modal-ok').off('click');
    $('#modal-ok').on('click', function(event){
      let input_name = $('#inputName').val();
      let crop_size = $('#cropSizeModal').val();

      $('img[data-name='+input_name+']').attr('src', $('img#photo').attr('src'));
      $('#'+input_name+'_cords').val(crop_size);
      $('#photo').imgAreaSelect({remove: true});
      $('#modal-images').modal('hide');

      /*let cords = (crop_size).split('#');
      var scaleX = 100 / cords[4];
      var scaleY = 100 / cords[5];

      $('img[data-name='+input_name+']').css({
          width: Math.round(scaleX * 300),
          height: Math.round(scaleY * 300),
          marginLeft: -Math.round(scaleX * cords[0]),
          marginTop: -Math.round(scaleY * cords[1])
      });*/
  });
}

function modalCancel(){
  $('#modal-cancel').off('click');
  $('#modal-cancel').on('click', function(){
    $('#modal-images').modal('hide');
    $('#photo').imgAreaSelect({
       remove: true,
    });
  });
}

function addBannerRow(){
  $('.add-banner-row').off('click');
  $('.add-banner-row').on('click', function(){
    let banner_row = '<div class="col-md-12" style="margin-bottom: 5px;">'+
                       '<img src="http://www.sclance.com/pngs/image-placeholder-png/image_placeholder_png_698120.png" class="listingImgDiv" data-name="banner_'+(Math.round(new Date()/1000))+'" title="Click here to choose banner image">'+
                       '<input type="file" name="banner_images[]" class="form-control banner_'+(Math.round(new Date()/1000))+'" style="display: none" accept="image/gif, image/jpeg, image/png, image/jpg" onchange="showImgInDiv(this)">'+
                       '<input type="hidden" name="banner_image_cords[]" id="banner_'+(Math.round(new Date()/1000))+'_cords" value="0#0#250#380">'+
                       '<input type="text" style="display: inline-block;width: auto; margin-left: 3px;" class="form-control" name="banner_alt[]" placeholder="Alt Name">'+
                       '<i class="fa fa-plus-circle add-banner-row" style="font-size: 20px; margin-left: 5px;"></i>'+
                       '<i class="fa fa-times-circle remove-banner-row" style="font-size: 20px; margin-left: 5px; color: red;"></i>'+
                     '</div>';
    $(this).parent('div').after(banner_row);
    $(this).hide();
    removeBannerRow();
    addBannerRow();
    triggerInputFile();
  });
}

function removeBannerRow(){
  $('.remove-banner-row').off('click');
  $('.remove-banner-row').on('click', function(){
    $(this).parent('div').remove();
    $('.banner-div>div:last-child').find('.add-banner-row').show();
  });
}

function addGalleryRow(){
  $('.add-gallery-row').off('click');
  $('.add-gallery-row').on('click', function(){
    let gallery_row = '<div class="col-md-12" style="margin-bottom: 5px;">'+
                       '<img src="http://www.sclance.com/pngs/image-placeholder-png/image_placeholder_png_698120.png" class="listingImgDiv" data-name="gallery_'+(Math.round(new Date()/1000))+'" title="Click here to choose gallery image">'+
                       '<input type="file" name="gallery_images[]" class="form-control gallery_'+(Math.round(new Date()/1000))+'" style="display: none" accept="image/gif, image/jpeg, image/png, image/jpg" onchange="showImgInDiv(this)">'+
                       '<input type="hidden" name="gallery_image_cords[]" id="gallery_'+(Math.round(new Date()/1000))+'_cords" value="0#0#200#200">'+
                       '<input type="text" style="display: inline-block;width: auto; margin-left: 3px;" class="form-control" name="gallery_alt[]" placeholder="Alt Name">'+
                       '<input type="text" class="form-control" style="display: inline-block;width: auto; margin-left: 3px;" name="gallery_title[]" placeholder="Title Name">'+
                        '<input type="text" class="form-control" style="display: inline-block;width: auto; margin-left: 3px;" name="gallery_caption[]" placeholder="Caption Name">'+
                        '<select class="form-control" style="display: inline-block;width: auto; max-height: 35px; margin-left: 3px;" name="gallery_tag[]">'+
                            '<option value="">Select Tags</option>'+
                        '</select>'+
                       '<i class="fa fa-plus-circle add-gallery-row" style="font-size: 20px; margin-left: 5px;"></i>'+
                       '<i class="fa fa-times-circle remove-gallery-row" style="font-size: 20px; margin-left: 5px; color: red;"></i>'+
                     '</div>';
    $(this).parent('div').after(gallery_row);
    $('.gallery-div>div:last-child').find('select[name*=gallery_tag]').html($('select[name*=tag_id]').html()).select2({placeholder: "Select Tags",allowClear: true});
    $(this).hide();
    removeGalleryRow();
    addGalleryRow();
    triggerInputFile();
  });
}

function removeGalleryRow(){
  $('.remove-gallery-row').off('click');
  $('.remove-gallery-row').on('click', function(){
    $(this).parent('div').remove();
    $('.gallery-div>div:last-child').find('.add-gallery-row').show();
  });
}

function addTagRow(){
  $('.add-tag-row').off('click');
  $('.add-tag-row').on('click', function(){
    let tag_row = '<div class="col-md-12" style="margin-bottom: 5px;">'+
                    '<select name="tag_id[]" class="form-control" style="display: inline-block;width: 250px;">'+
                          '<option value="">Select Tags</option>'+
                    '</select>'+
                    '<input type="number" class="form-control" style="display: inline-block;width: auto;margin-left: 3px;" name="tag_min_price[]" placeholder="Minimum price">'+
                    '<input type="number" class="form-control" style="display: inline-block;width: auto;margin-left: 3px;" name="tag_max_price[]" placeholder="Maximum price">'+
                    '<i class="fa fa-plus-circle add-tag-row" style="font-size: 20px; margin-left: 5px;"></i>'+
                    '<i class="fa fa-times-circle remove-tag-row" style="font-size: 20px; margin-left: 5px; color: red;"></i>'+
                  '</div>';
    $(this).parent('div').after(tag_row);
    $('.tag-div>div:last-child').find('select[name*=tag_id]').html($('#clone_tag').html());//.select2({placeholder: "Select Tags",allowClear: true});
    $(this).hide();
    removeTagRow();
    addTagRow();
  });
}

function removeTagRow(){
  $('.remove-tag-row').off('click');
  $('.remove-tag-row').on('click', function(){
    $(this).parent('div').remove();
    $('.tag-div>div:last-child').find('.add-tag-row').show();
  });
}