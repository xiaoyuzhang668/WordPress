// count up to 404
$('.counter').each(function() {
  var $this = $(this),
      countTo = $this.attr('data-count');  
  $({ countNum: $this.text()}).animate({
    countNum: countTo
  },

  {
    duration: 800,
    easing:'linear',
    step: function() {
      $this.text(Math.floor(this.countNum));
    },
    complete: function() {
      $this.text(this.countNum);
      //alert('finished');
    }
  }); 
});