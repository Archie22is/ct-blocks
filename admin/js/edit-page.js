// global CODETOT_PLUGIN_URL
;(function ($) {
  var blockListEl = document.querySelector('.js-block-list')
  var blockListHtml = document.querySelector('script[class="tmpl-popup"]')
  var $previewBlockEl = $('.js-preview-block')
  var $cloneEls = $('.acf-flexible-content:first > .clones')
  var $previewBlockItemEls = $('.js-preview-block-items')

  if (blockListEl && blockListHtml) {
    blockListEl.innerHTML = blockListHtml.innerHTML

    updateBlockSidebar()
  }

  function updateBlockSidebar () {
    var $blockListEl = $('.js-block-list')

    if ($blockListEl.children().length === 0) {
      $blockListEl.html(
        '<span class="ct__message">Select the Flexible Page interface to display blocks</span>'
      )

      return false
    }

    $cloneEls.find('input').each(function () {
      $(this).prop('disabled', false)
    })

    var $dataLayoutEls = $blockListEl.find('a')
    $dataLayoutEls.each(function () {
      var $dataLayoutEl = $(this)
      var nameImage = $dataLayoutEl.data('layout')
      $dataLayoutEl.attr('href', 'javascript:void(0)')

      var markup =
        '<svg width="20" height="20"> <use xlink:href="#' +
        nameImage +
        '" /> </svg>'
      $dataLayoutEl.prepend(markup)

      $dataLayoutEl.on('mouseenter', function () {
        $previewBlockItemEls.html('')
        $dataLayoutEls.removeClass('active')
        $(this).addClass('active')

        if ($(window).width() < 850) {
          $blockListEl.addClass('active')
        }
      })

      $dataLayoutEl.on('click', function () {
        $('[data-type="flexible_content"]')
          .find('[data-name="add-layout"]')
          .last()
          .trigger('click')

        var layout = $(this).data('layout')
        $('.acf-tooltip.acf-fc-popup')
          .css({
            opacity: '0',
            visibility: 'hidden'
          })
          .find('[data-layout="' + layout + '"]')
          .trigger('click')
      })

      $dataLayoutEl.on('mouseleave', function () {
        $previewBlockEl.removeClass('active')
        $blockListEl.removeClass('active')
      })
    })

    $('#codetot-flexible-button').on('mouseleave', function () {
      $previewBlockEl.removeClass('active')
      $blockListEl.removeClass('active')
    })
  }
})(jQuery)
