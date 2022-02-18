(function ($, Drupal) {
  Drupal.behaviors.custom_movies_normalizer = {
    attach(context) {
      $('#edit-field-release-date-0-value-date', context).on('change', function () {
        let isFuture = isFutureDate($(this).val());
        if (isFuture) {
          $(this).addClass('error')
        }
        else {
          $(this).removeClass('error')
        }
      });
    }
  }
  function isFutureDate(idate){
    var today = new Date().getTime();
    idate = new Date(idate).getTime();
    return (today - idate) < 0;
  }
})(jQuery, Drupal);