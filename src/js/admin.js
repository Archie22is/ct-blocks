/* global CODETOT_BLOCKS_IMAGES, jQuery */
import { select, selectAll, getData } from 'lib/dom'
import { map } from 'lib/utils'

const $ = jQuery

const blockImages = CODETOT_BLOCKS_IMAGES
const getBlockImageUrl = blockName => blockImages[blockName]

const init = () => {
  var blockListEl = select('.js-block-list')
  var blockListHtml = select('script[class="tmpl-popup"]')
  var $previewBlockEl = $('.js-preview-block')
  var $cloneEls = $('.acf-flexible-content:first > .clones')
  var $previewBlockItemEls = $(select('.js-preview-block-items'))

  const updatePreviewImages = () => {
    const previewEls = selectAll('.js-custom-preview-block')

    if (previewEls.length) {
      map(previewEl => {
        let blockName = getData('block', previewEl)
        blockName = blockName.replace('-', '_', blockName)
        const blockImageUrl = getBlockImageUrl(blockName)

        if (blockImageUrl) {
          previewEl.innerHTML = `<img class="preview-image" src="${blockImageUrl}" width="400" height="auto">`
        }
      }, previewEls)
    }
  }

  const updateBlockSidebar = () => {
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

    const $dataLayoutEls = $blockListEl.find('a')
    $dataLayoutEls.each(function () {
      var $dataLayoutEl = $(this)
      var nameImage = $dataLayoutEl.data('layout')
      $dataLayoutEl.attr('href', 'javascript:void(0)')

      const markup =
        '<svg viewBox="0 0 24 24"> <use xlink:href="#' +
        nameImage +
        '" /> </svg>'
      $dataLayoutEl.prepend(markup)

      const reset = () => {
        $previewBlockItemEls.html('')
        $previewBlockEl.removeClass('active')
        $dataLayoutEls.removeClass('active')
      }

      $dataLayoutEl.on('mouseenter', function (e) {
        reset()

        $(e.target).addClass('active')
        const imageUrl = getBlockImageUrl(nameImage)

        if (!imageUrl) {
          return
        }

        $previewBlockItemEls.html(
          '<div class="ct__preview-block-item"><img src="' +
            imageUrl +
            '" /></div>'
        )

        $previewBlockEl
          .css({
            top: $(this).offset().top - $(blockListEl).offset().top
          })
          .addClass('active')

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

        updatePreviewImages()
      })

      $dataLayoutEl.on('mouseleave', function (e) {
        $(e.target).removeClass('active')
      })
    })

    $('#codetot-flexible-button').on('mouseleave', function () {
      $previewBlockEl.removeClass('active')
      $blockListEl.removeClass('active')
    })
  }

  if (blockListEl && blockListHtml) {
    blockListEl.innerHTML = blockListHtml.innerHTML

    updateBlockSidebar()
    updatePreviewImages()
  }
}

document.addEventListener('DOMContentLoaded', init)
