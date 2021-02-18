const blocks = document.querySelectorAll('[data-ct-block]')

const initBlocks = () => {
  if (blocks) {
    blocks.forEach(block => {
      const blockName = block.getAttribute('data-ct-block')
      if (!blockName) {
        return
      }

      require(`./blocks/${blockName}.js`).default(block)
    })
  }
}

document.addEventListener('DOMContentLoaded', initBlocks)
