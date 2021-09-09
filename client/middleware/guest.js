export default async function ({ app, redirect }) {
  await app.$auth.loggedIn
  console.log(app.$auth)
  if (app.$auth.loggedIn) {
    return redirect('/')
  }
}
