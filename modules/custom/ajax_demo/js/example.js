alert("test in js file");
console.log("testing...");

(function ($, Drupal) {
    // Drupal.AjaxCommands.prototype.example = function (ajax, response, status) {
    //   alert(response.message);
    // }
    $.fn.demo = function (){
        alert("Demmo Completed");
    };
  
  })(jQuery, Drupal);