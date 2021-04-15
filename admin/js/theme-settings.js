;(function ($) {
  var $fontHeadingEl = $('.js-font-heading-options select')
  var $fontEl = $('.js-font-options select')
  var $fontPreview = $('.js-review-font p')
  var $headingPreview = $('.js-review-font-heading p')

  if ($fontHeadingEl.length && $headingPreview) {
    $fontHeadingEl.on('select2:select', () => {
      var $fontHeading = $fontHeadingEl.select2('data')
      $headingPreview.css('font-family', $fontHeading[0].text)
    })
  }

  if ($fontEl.length && $fontPreview) {
    $fontEl.on('select2:select', () => {
      var $font = $fontEl.select2('data')
      $fontPreview.css('font-family', $font[0].text)
    })
  }
})(jQuery)
