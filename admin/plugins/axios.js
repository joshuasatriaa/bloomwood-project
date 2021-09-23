export default function ({ $axios, app, redirect }) {
  $axios.onError((error) => {
    const code = parseInt(error.response && error.response.status)
    if (code === 401) {
      app.$auth.logout()
      redirect('/login')
    }
  })
}
