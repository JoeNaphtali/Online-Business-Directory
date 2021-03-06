$(document).ready(function () {

    /* Navigation */

    $(document).click(function (event) {
        if ($(event.target).parents(".navbar-collapse").length < 1) {
            var click = $(event.target);
            var _open = $(".navbar-collapse").hasClass("show");
            if (_open === true && !click.hasClass("hamburger-icon")) {      
                $(".hamburger-icon").click();
            }
        }
    });

    $(document).click(function (event) {
        if ($(event.target).parents(".search-collapse").length < 1) {
            var click = $(event.target);
            var _open = $(".search-collapse").hasClass("show");
            if (_open === true && !click.hasClass("search-icon")) {      
                $(".search-icon").click();
            }
        }
    });

    /* Background Set */
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    $('.set-bg-dark').each(function () {
        var bg = $(this).data('setbgdark');
        $(this).css('background-image', 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(' + bg + ')');
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })

    $(window).scroll(function(){
        $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
    });

    /* Toggle distance radius control */

    $('#enableDistanceRadius').click(function(){
        // If the user checks the terms and conditions checkbox
        if($(this).is(':checked')){
            // Enable the 'Propose Idea' button.
            $('.distanceRangeInput').attr("disabled", false);
        } else{
            // If the user did not check the terms and conditions checkbox
            $('.distanceRangeInput').attr("disabled", true);
        }
    });

    /* Toggle search map on mobile view */

    $('.dropdown-panel-toggle').click(function(){
        $(".dropdown-panel-content").fadeToggle();
    });

    $('#show-map').click(function(){
        $('.map-container').removeClass('collapse-map');
        $('.map-container').addClass('display-map');
    });

    $('#hide-map').click(function(){
        $('.map-container').removeClass('display-map');
        $('.map-container').addClass('collapse-map');
    });

    $(window).resize(function() {
        if (window.matchMedia('(min-width: 767px)').matches) {
            $('.map-container').removeClass('hide');
            $('.map-container').removeClass('show');
        }
    });

});

$(function () {
 
    var $rateYo = $("#read-write-rating").rateYo();
   
    $("#submit-review").click(function () {
      /* get rating */
      var rating = $rateYo.rateYo("rating");
      document.getElementById("review-rating").value = rating;
    });
   
  });

$(function () {
 
    $(".read-only-rating").rateYo();
   
});

$(document).ready(function(){

    // if the user clicks the 'bookmark' button
    $('.bookmark-btn').on('click', function(){
      var listing_id = $(this).data('id');
      $clicked_btn = $(this);
      if ($clicked_btn.hasClass('inactive')) {
        action = 'bookmark';
      }
      else if ($clicked_btn.hasClass('active')) {
        action = 'removebookmark';
      }
      $.ajax({
        type: 'post',
        data: {
          'action': action,
          'listing_id': listing_id
        },
        success: function(data){ 
          var res = JSON.parse(JSON.stringify(data));     
          if (action == "bookmark") {
            $clicked_btn.removeClass('inactive');
            $clicked_btn.addClass('active');
          } else if(action == "removebookmark") {
            $clicked_btn.removeClass('active');
            $clicked_btn.addClass('inactive');
          }
  
          // Change button styling of the dislike button if user is reacting for the second time to an idea
          $clicked_btn.siblings('i.active').removeClass('active').addClass('inactive');
        }
      })
  
    });

    // if the user clicks the 'bookmark' button
    $('.btn-bookmark').on('click', function(){
      var listing_id = $(this).data('id');
      $clicked_btn = $(this);
      if ($clicked_btn.hasClass('inactive')) {
        action = 'bookmark';
      }
      else if ($clicked_btn.hasClass('active')) {
        action = 'removebookmark';
      }
      $.ajax({
        type: 'post',
        data: {
          'action': action,
          'listing_id': listing_id
        },
        success: function(data){ 
          var res = JSON.parse(JSON.stringify(data));     
          if (action == "bookmark") {
            $clicked_btn.removeClass('inactive');
            $clicked_btn.addClass('active');
          } else if(action == "removebookmark") {
            $clicked_btn.removeClass('active');
            $clicked_btn.addClass('inactive');
          }
  
          // Change button styling of the dislike button if user is reacting for the second time to an idea
          $clicked_btn.siblings('i.active').removeClass('active').addClass('inactive');
        }
      })
  
    });

    // if the user clicks the Facebook link
    $('.social-links-fb').on('click', function(){
      var listing_id = $(this).data('id');
      action = 'increment';
      $.ajax({
        type: 'post',
        data: {
          'fb_action': action,
          'listing_id': listing_id
        },
        success: function(data){ 
          var res = JSON.parse(JSON.stringify(data));
        }
      })
  
    });

    // if the user clicks the Twitter link
    $('.social-links-tt').on('click', function(){
      var listing_id = $(this).data('id');
      action = 'increment';
      $.ajax({
        type: 'post',
        data: {
          'tt_action': action,
          'listing_id': listing_id
        },
        success: function(data){ 
          var res = JSON.parse(JSON.stringify(data));
        }
      })
  
    });

    // if the user clicks the Instagram link
    $('.social-links-ig').on('click', function(){
      var listing_id = $(this).data('id');
      action = 'increment';
      $.ajax({
        type: 'post',
        data: {
          'ig_action': action,
          'listing_id': listing_id
        },
        success: function(data){ 
          var res = JSON.parse(JSON.stringify(data));
        }
      })
  
    });

    // if the user clicks the Instagram link
    $('.website-link').on('click', function(){
      var listing_id = $(this).data('id');
      action = 'increment';
      $.ajax({
        type: 'post',
        data: {
          'web_action': action,
          'listing_id': listing_id
        },
        success: function(data){ 
          var res = JSON.parse(JSON.stringify(data));
        }
      })
  
    });
  
  });