import "bootstrap";
import "./stripe";
import { ClassicEditor } from "./ckeditor";
import { Eggy } from '@s-r0/eggy-js';

window.$ = require('./jquery')
window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
var csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

$('.post-comment-button').on('click', function(){
  axios.post('/comment/store', {
    comment: $('#comment').val(),
    post_id: $(this).data('post-id')
  })
  .then(function (response) {
    console.log(response);
  })
  .catch(function (error) {
    console.log(response);
  });
});


$('.delete-comment-button').on('click', function(){
  axios.post('/comment/delete', {
    comment_id: $(this).data('id')
  })
  .then(function (response) {
    console.log(response);
  })
  .catch(function (error) {
    console.log(response);
  });
});


$('.load-more-posts-button').on('click', function(){

  var offset = $(this).data('offset');

  var type = null;
  if ($(this).data('type')) {
    type = $(this).data('type');
  }

  $(this).hide();
  $('#loading-spinner').show();

  var newOffset = offset + 6;
  $(this).data('offset', newOffset);

  axios.post('/loadposts', {
    offset: offset,
    type: type
  })
  .then(function (response) {
    $('#post-container').append(response.data.html);
    var count = response.data.count;
    $('#loading-spinner').hide();
    if ( count == 6 ) {
      $('.load-more-posts-button').show();
    }
  })
  .catch(function (error) {
      console.log(response);
  }).then(function () {

  });
});




$('.hero-type-select').on('change', function(){
  if($(this).type != ""){
    $('.hero-item-select').empty();
    axios.post('/admin/items_by_type', {
      type: $(this).val()
    })
    .then(function (response) {
      if ( response.data.items.length > 0 ) {
        if($('.hero-type-select').val() == "item"){
          response.data.items.forEach(
            e => $('.hero-item-select').append(`<option value="`+e.id+`">`+e.name+`</option>`)
          );
        } else {
          response.data.items.forEach(
            e => $('.hero-item-select').append(`<option value="`+e.id+`">`+e.title+`</option>`)
          );
        }
      }
    })
    .catch(function (error) {
      console.log(error);
    });
  }
});

$('.new-hero-item').on('click', function(){
  var currentItemCount = $('.hero-item').length + 1;
  $('.hero-items-container').append(`
    <div class="bg-alt-yellow flex-x extra-rounded p-4 mb-4 hero-item" style="align-items: center;">
      <input type="hidden" name="hero_id[`+currentItemCount+`]" value="0">
      <span>#</span>
      <input type="number" name="order[`+currentItemCount+`]" value="`+currentItemCount+`">
      <span>Type</span>
      <input type="text" name="type[`+currentItemCount+`]" value="`+$('.hero-type-select').val()+`">
      <span>ID</span>
      <input type="text" name="id[`+currentItemCount+`]" value="`+$('.hero-item-select').val()+`">
    </div>
  `);
});

$('.enable-hero-button').on('click', function(){
  axios.post('/admin/hero/enable', {

  })
  .then(function (response) {
    $('#hero-banner-status').css('color', 'green').text("Enabled");
    $('.enable-hero-button').hide();
    $('.disable-hero-button').show();
  })
  .catch(function (error) {

  });
});

$('.disable-hero-button').on('click', function(){
  axios.post('/admin/hero/disable', {

  })
  .then(function (response) {
    $('#hero-banner-status').css('color', 'red').text("Disabled");
    $('.enable-hero-button').show();
    $('.disable-hero-button').hide();
  })
  .catch(function (error) {});
});


var currentHeroIndex = 0;
var maxIndex = $('.hero-item').length - 1;

$('#hero-right-button').on('click', function(){
  $('*[data-hero-index="'+currentHeroIndex+'"]').hide();
  currentHeroIndex = currentHeroIndex + 1;
  if(currentHeroIndex > maxIndex){
    currentHeroIndex = 0;
  }
  $('*[data-hero-index="'+currentHeroIndex+'"]').show();
});

$('#hero-left-button').on('click', function(){
  $('*[data-hero-index="'+currentHeroIndex+'"]').hide();
  currentHeroIndex = currentHeroIndex - 1;
  if(currentHeroIndex < 0){
    currentHeroIndex = maxIndex1;
  }
  $('*[data-hero-index="'+currentHeroIndex+'"]').show();
});

$('.hero-button').on('click', function(){
  $('*[data-hero-index="'+currentHeroIndex+'"]').hide();
  currentHeroIndex = $(this).data('index');
  $('*[data-hero-index="'+currentHeroIndex+'"]').show();
});

setInterval(function() {
  $('*[data-hero-index="'+currentHeroIndex+'"]').hide();
  currentHeroIndex += 1;
  $('*[data-hero-index="'+currentHeroIndex+'"]').show();
}, 10000);









$('#open-mobile-nav-button').on('click', function(){
  $('#mobile-nav-container').show();
});

$('#close-mobile-nav').on('click', function (){
  $('#mobile-nav-container').hide();
});


var currentImage = 0;
var imageCount = $('.shop-item-image').length;

$('.previous-image-button').on('click', function(){
  if ( currentImage > 0 ) {
    $('.show-image-button').removeClass("highlighted");
    $('#image-' + currentImage).hide();
    currentImage = currentImage - 1;
    $(".show-image-button[data-index='" + currentImage +"']").addClass("highlighted");
    $('#image-' + currentImage).show();
  }
});

$('.next-image-button').on('click', function(){
  if ( currentImage < imageCount - 1 ) {
    $('.show-image-button').removeClass("highlighted");
    $('#image-' + currentImage).hide();
    currentImage = currentImage + 1;
    $(".show-image-button[data-index='" + currentImage +"']").addClass("highlighted");
    $('#image-' + currentImage).show();
  }
});

$('.show-image-button').on('click', function(){
  $('.show-image-button').removeClass("highlighted");
  var index = $(this).data('index');
  $('#image-' + currentImage).hide();
  $('#image-' + index).show();
  $('#image-' + index).show();
  $(this).addClass("highlighted");
  currentImage = index;
});



$('#grant_title').on('change', function(){
  if ( $(this).is(':checked')) {
    $('.title-container').show();
  } else {
    $('.title-container').hide();
  }
});

$('#grant_badge').on('change', function(){
  if ( $(this).is(':checked')) {
    $('.badge-container').show();
  } else {
    $('.badge-container').hide();
  }
});

$('#unlock_item').on('change', function(){
  if ( $(this).is(':checked')) {
    $('.item-container').show();
  } else {
    $('.item-container').hide();
  }
});



$('.post_type_radio').on('change', function(){

  var selectedType = $(this).attr('id');

  if ( selectedType == "podcast" ) {
    $('.podcast_only').show();
    $('.blog_only').hide();
  }

  if ( selectedType == "blog" ) {
    $('.blog_only').show();
    $('.podcast_only').hide();
  }

});


$('#add-another-image-button').on('click', function(){
  var count = $('.image-input').length;
  $(`<input type="file" class="form-control image-input my-2" name="image[`+count+`]">`).insertBefore(this);
});


$('.delete-image-button').on('click', function(){
  var id = $(this).data('id');
  axios.post('/admin/delete_image', {
    id: id
  })
  .then(function (response) {
    console.log(response);
  })
  .catch(function (error) {
      console.log(response);
  });

});





$('.add-to-cart').on('click', function(){
  axios.post('/cart/add', {
    id: $(this).data('id'),
    quantity: $('#quantity').length > 0 ? $('#quantity').val() : 1
  })
  .then(function (response) {
    Eggy({
      title: 'Success',
      message: response.data.item_name + " added to cart",
      type: 'success',
      position: 'bottom-right',
    });
    $('#cart_total_items').text(response.data.total_cart_items);
  })
  .catch(function (error) {
      console.log(response);
  });
});


$('.delete-cart-item').on('click', function(){

var elem = $(this);

  axios.post('/cart/remove', {
    id: $(this).data('id'),
    index: $(this).data('index')
  })
  .then(function (response) {
      Eggy({
        title:  'Success',
        message:  response.data.item_name + " removed from cart",
        type:  'success',
        position: 'bottom-right',
      });

      if(response.data.total_cart_items > 0){
        $('#cart_total_items').text(response.data.total_cart_items);
      } else {
        location.reload()
      }

      $(elem).parent().parent().remove();
  })
  .catch(function (error) {
      console.log(response);
  });
});



$('.grant-role-button').on('click', function(){
  axios.post('/admin/user/grant', {
    id: $(this).data('id'),
    role_id: $(this).parent().find('.role-select').val()
  })
  .then(function (response) {
      console.log(response);
  })
  .catch(function (error) {
      console.log(response);
  });
});



$('.select-badge').on('click', function(){
  $('.select-badge').removeClass("highlighted");
  var id = $(this).data('id');
  $('#badge_id').val(id);
  $(this).addClass("highlighted");
});





$(".anim").mouseenter(function() {
  $(".anim").addClass("link-fade");
  $(this).addClass("animate__animated animate__pulse").removeClass("link-fade");
}).mouseleave(function() {
  $(".anim").removeClass("link-fade");
  $(this).removeClass("animate__animated animate__pulse");
});

$('.publish-button').on('click', function(){

  var e = $(this);

  axios.post('/admin/post/publish', {
    id: $(this).data('id')
  })
  .then(function (response) {
    $(e).parent().find('.hide-button').show();
    $(e).hide();
    $(e).parent().parent().find('.published-status').text("Yes");
    Eggy({
      title:  'Success',
      message:  'Post has been published',
      type:  'success',
      position: 'bottom-right',
    });
  })
  .catch(function (error) {
      console.log(response);
  });
});

$('.hide-button').on('click', function(){

  var e = $(this);

  axios.post('/admin/post/hide', {
    id: $(this).data('id')
  })
  .then(function (response) {
      $(e).parent().find('.publish-button').show();
      $(e).hide();
      $(e).parent().parent().find('.published-status').text("No");
      Eggy({
        title:  'Success',
        message:  'Post has been hidden',
        type:  'success',
        position: 'bottom-right',
      });
  })
  .catch(function (error) {
      console.log(response);
  });
});

$('.delete-button').on('click', function(){
  axios.post('/admin/post/delete', {
    id: $(this).data('id')
  })
  .then(function (response) {
    Eggy({
      title:  'Success',
      message:  'Post has been deleted',
      type:  'success',
      position: 'bottom-right',
    });
  })
  .catch(function (error) {
      console.log(response);
  });
});



/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
