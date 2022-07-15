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



$('.event-sign-up-button').on('click', function(){
  axios.post('/event/register', {
    id: $(this).data('id')
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
        if($('.hero-type-select').val() == "item" || $('.hero-type-select').val() == "event" || $('.hero-type-select').val() == "altlan" ){
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

$('.enable-hero-button').on('click', function(){
  axios.post('/admin/hero/enable')
  .then(function (response) {
    $('#hero-banner-status').css('color', 'green').text("Enabled");
    $('.enable-hero-button').hide();
    $('.disable-hero-button').show();
  });
});

$('.disable-hero-button').on('click', function(){
  axios.post('/admin/hero/disable')
  .then(function (response) {
    $('#hero-banner-status').css('color', 'red').text("Disabled");
    $('.enable-hero-button').show();
    $('.disable-hero-button').hide();
  });
});

$('.delete-hero-button').on('click', function(e){
  var elem = $(this);
  axios.post('/admin/hero/delete', {
    id: $(this).data('id')
  })
  .then(function (response) {
    $(elem).parent().remove();
    Eggy({
      title: 'Success',
      message: 'Hero Banner Item has been deleted',
      type: 'success',
      position: 'bottom-right',
    });
  });
});




var currentHeroIndex = 0;
var maxIndex = $('.hero-item').length - 1;
var heroTimer = setInterval(heroStepForward, 12000);

$('#hero-right-button').on('click', function(){
  $('*[data-hero-index="'+currentHeroIndex+'"]').hide();
  currentHeroIndex = currentHeroIndex + 1;
  if(currentHeroIndex > maxIndex){
    currentHeroIndex = 0;
  }
  $('*[data-hero-index="'+currentHeroIndex+'"]').show();
  highlightActiveHeroButton();
  clearInterval(heroTimer);
  heroTimer = setInterval(heroStepForward, 12000);
});

$('#hero-left-button').on('click', function(){
  $('*[data-hero-index="'+currentHeroIndex+'"]').hide();
  currentHeroIndex = currentHeroIndex - 1;
  if(currentHeroIndex < 0){
    currentHeroIndex = maxIndex;
  }
  $('*[data-hero-index="'+currentHeroIndex+'"]').show();
  highlightActiveHeroButton();
  clearInterval(heroTimer);
  heroTimer = setInterval(heroStepForward, 12000);
});

$('.hero-button').on('click', function(){
  $('*[data-hero-index="'+currentHeroIndex+'"]').hide();
  currentHeroIndex = $(this).data('index');
  $('*[data-hero-index="'+currentHeroIndex+'"]').show();
  highlightActiveHeroButton();
  clearInterval(heroTimer);
  heroTimer = setInterval(heroStepForward, 12000);
});

function heroStepForward(){
  $('*[data-hero-index="'+currentHeroIndex+'"]').hide();
  currentHeroIndex += 1;
  if(currentHeroIndex > maxIndex){
    currentHeroIndex = 0;
  }
  $('*[data-hero-index="'+currentHeroIndex+'"]').show();
  highlightActiveHeroButton();
}

function highlightActiveHeroButton(){
  $('.hero-button').removeClass('highlighted-hero-button');
  $('.hero-button[data-index="'+currentHeroIndex+'"]').addClass('highlighted-hero-button');
}






var groupCount = $('.option-group-container').length;
var optionCount = $('.option-container').length;

$('#create-option-group-button').on('click', function(){

  groupCount = $('.option-group-container').length;
  var newGroupName = $('#new_group_name').val();

  if(newGroupName != ""){
    $('#option-groups-container').append(`
      <div class="bg-alt-yellow mb-3 extra-rounded p-3 option-group-container">
        <label class="form-label">`+ newGroupName +` Options</label>
        <input type="hidden" name="group[`+groupCount+`]" value="`+newGroupName+`">
        <div class="options-container"></div>
        <button type="button" id="add-another-option-button" data-group="`+groupCount+`" class="btn btn-warning">Add Option</button>
      </div>`);
    $('#new_group_name').val("");
  }
});


$('body').on('click', '#add-another-option-button', function(){

  optionCount = $(this).parent().find('.option-container').length;
  var index = $(this).data('group');

  $(this).parent().find('.options-container').append(`
    <div class="flex-x option-container mb-3" style="align-items: center;">
      <label class="form-label">Name</label>
      <input type="text" class="form-control mx-2" style="width: 160px;" name="option_name[`+index+`][`+optionCount+`]">
      <label class="form-label mx-2">Price Modifier</label>
      <input type="number" class="form-control mx-2" style="width: 160px;" name="option_price[`+index+`][`+optionCount+`]">
    </div>
  </div>`);
});








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




$('.item-quantity').on('change', function(){
  console.log($(this).val());
});


$( ".item-option-select" ).on('change', function(){

  var basePrice = parseFloat($('#base_price').text());
  var optionTotal = 0.00;

  $( ".item-option-select" ).each(function( index ) {
    if($(this).find(":selected").data('price-mod')){
      optionTotal += parseFloat($(this).find(":selected").data('price-mod'));
    }
  });

  $('#item-price').text(basePrice + optionTotal)

});


$('.add-to-cart').on('click', function(){

  var options = [];

  $( ".item-option-select" ).each(function( index ) {
    options.push( $(this).val() );
  });

  axios.post('/cart/add', {
    id: $(this).data('id'),
    quantity: $('#quantity').val(),
    options: options,
    unit_price: $('#item-price').text(),
    name: $('#item-name-header').text()
  })
  .then(function (response) {
    Eggy({
      title: 'Success',
      message: $('#item-name-header').text() + " added to cart",
      type: 'success',
      position: 'bottom-right',
    });
    $('#cart_total_items').text(response.data.cart_quantity);
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

      if ( response.data.cart_total > 0 ) {
        $('#cart-total').text(response.data.cart_total);
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






$('.create-game-button').on('click', function(){
  axios.post('/admin/game/store', {
    name: $('.game-name-input').val()
  })
  .then(function (response) {

    $('#game-table-body').append(`
      <tr>
        <td><span>`+ $('.game-name-input').val() +`</span></td>
        <td><button type="button" class="btn btn-warning mx-3 delete-game-button" data-id="`+ response.data.discord_id +`">Delete</button></td>
      </tr>
    `);

    $('.game-name-input').val("");

    Eggy({
      title:  'Success',
      message:  'Game has been created',
      type:  'success',
      position: 'bottom-right',
    });
  })
  .catch(function (error) {
      console.log(response);
  });
});


$('body').on('click', '#add-another-option-button', function(){

  var elem = $(this);

  axios.post('/admin/game/delete', {
    id: $(this).data('id')
  })
  .then(function (response) {

    $(elem).parent().remove();

    Eggy({
      title:  'Success',
      message:  'Game has been deleted',
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
