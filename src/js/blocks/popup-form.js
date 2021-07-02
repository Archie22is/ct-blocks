import Modal from 'lib/modal'

export default el => {
  // eslint-disable-next-line no-unused-vars
  const instance = new Modal(el, {
    id: el.id
  })

  console.log(instance)
}
