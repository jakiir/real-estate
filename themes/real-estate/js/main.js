
jQuery(document).ready(function($){

  $(".nav-icon-btn").click(function(e){
    $(this).toggleClass('nav-icon-close');
    $('.main-nav').toggleClass('nav-open');
    e.stopPropagation();
  });
  $(".main-nav").click(function(e){
    e.stopPropagation();
  });
  $(document).click(function(){
    $('.nav-icon-btn').removeClass('nav-icon-close');
    $('.main-nav').removeClass('nav-open');
  });

  if ($(window).width() <= 767) {
    $('.template-tab-pane').hide();
    $('.template-tab-pane:first').show();
    $('.template-tab-nav li a').click(function(e){
      e.preventDefault();
      var tab_ID = $(this).attr('href');
      $('.template-tab-nav li a').removeClass('active-tab');
      $(this).addClass('active-tab');
      $('.template-tab-pane').slideUp();
      $(tab_ID).addClass('template-tab-pane-active').slideDown();
    });
  }

  /*if ($(window).width() > 1024) {
    var customize_templates_box_left_position = $('.customize-templates-box').offset().left;
    var customize_templates_box_right_position = $('.customize-templates-box').offset().left + $('.customize-templates-box').outerWidth();
    $('.tool-box').css('left', (customize_templates_box_left_position - 230));
    $('.floating-actions').css('left', (customize_templates_box_right_position + 30));
  }
  $(window).resize(function(){
    if ($(window).width() > 1024) {
      var customize_templates_box_left_position = $('.customize-templates-box').offset().left;
      var customize_templates_box_right_position = $('.customize-templates-box').offset().left + $('.customize-templates-box').outerWidth();
      $('.tool-box').css('left', (customize_templates_box_left_position - 230));
      $('.floating-actions').css('left', (customize_templates_box_right_position + 30));
    }
  });*/
  if ($(window).width() <= 1024) {
    $('.tool-box ul').slideUp();
    $('.tool-box-wrap').click(function(){
      $('.tool-box').toggleClass('open-tools');
      $('.tool-box ul').slideToggle();
    });
  }



});
