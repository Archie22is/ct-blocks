import { selectAll, getData } from 'lib/dom'
import { map } from 'lib/utils'

const blocks = selectAll('[data-ct-block]')
const woocommerceBlocks = selectAll('[data-ct-woocommerce-block]')

const initBlocks = () => {
  if (blocks && blocks.length) {
    map(block => {
      const blockName = getData('ct-block', block)
      if (!blockName) {
        return
      }

      require(`./blocks/${blockName}.js`).default(block)
    }, blocks)
  }
}

const initWooCommerceBlocks = () => {
  if (woocommerceBlocks && woocommerceBlocks.length) {
    map(block => {
      const blockName = getData('ct-woocommerce-block', block)
      if (!blockName) {
        return
      }

      require(`./woocommerce-blocks/${blockName}.js`).default(block)
    }, woocommerceBlocks)
  }
}

document.addEventListener('DOMContentLoaded', () => {
  initBlocks()
  initWooCommerceBlocks()
})
