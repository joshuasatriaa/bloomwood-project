// import { POSITION } from 'vue-toastification'

export default (context, inject) => {
  const async = async (promise) => {
    context.app.store.dispatch('TOGGLE_LOADING', true)
    try {
      const data = await promise
      return [data, null]
    } catch (error) {
      return [null, error]
    } finally {
      context.app.store.dispatch('TOGGLE_LOADING', false)
    }
  }

  //   const inputWarning = (error) => {
  //     for (const item in error.response.data.errors) {
  //       context.app.$toast.warning(error.response.data.errors[item][0], {
  //         position: POSITION.BOTTOM_RIGHT,
  //         timeout: false,
  //       })
  //     }
  //     context.app.$toast.error(
  //       error.response.data.message ||
  //         error.response.data.error ||
  //         'Something went wrong.'
  //     )
  //   }

  //   const errorHandler = (errorData, message = '') => {
  //     const mess =
  //       message ||
  //       `${errorData.response?.status}, ${errorData.response?.data?.message}`
  //     context.app.$toast.error(mess)
  //   }

  //   const successHandler = (message = 'Data fetched.') => {
  //     context.app.$toast.success(message, {
  //       position: POSITION.TOP_LEFT,
  //       timeout: 1500,
  //     })
  //   }

  const qsHandler = (input, params) => {
    return `&${input}=${params}`
  }

  const getFullImageUrl = (path) => {
    return context.$config.BACKEND_URL + path
  }

  // Create our number formatter.
  const currencyFormat = (price) => {
    const formatter = Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',

      minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
      maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
    })

    return formatter.format(price)
  }

  const jsonToFormData = (json) => {
    const formData = new FormData()
    for (const [key, value] of Object.entries(json)) {
      if (json[key]) {
        if (Array.isArray(value)) {
          json[key].forEach((x, index) => {
            if (typeof x === 'object' && key !== 'images') {
              for (const [k, v] of Object.entries(x)) {
                formData.append(`${key}[${index}][${k}]`, v)
              }
            } else {
              formData.append(`${key}[${index}]`, x)
            }
          })
        } else {
          formData.append(`${key}`, value)
        }
      }
    }

    return formData
  }

  const setStorage = (key, value, ttl) => {
    const now = new Date()

    const item = {
      value,
      expiry: now.getTime() + ttl,
    }
    localStorage.setItem(key, JSON.stringify(item))
  }

  const getStorage = (key) => {
    const itemStr = localStorage.getItem(key)

    if (!itemStr) return null

    const item = JSON.parse(itemStr)
    const now = new Date()

    if (now.getTime() > item.expiry) {
      localStorage.removeItem(key)
      return null
    }

    return item.value
  }

  inject('async', async)
  inject('qsHandler', qsHandler)
  inject('getFullImageUrl', getFullImageUrl)
  inject('currencyFormat', currencyFormat)
  inject('jsonToFormData', jsonToFormData)
  inject('setStorage', setStorage)
  inject('getStorage', getStorage)
  //   inject('errorHandler', errorHandler)
  //   inject('successHandler', successHandler)
  //   inject('inputWarning', inputWarning)
}
