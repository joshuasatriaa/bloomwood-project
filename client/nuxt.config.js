export default {
  publicRuntimeConfig: {
    BASE_URL: process.env.BASE_URL,
    BACKEND_URL: process.env.BACKEND_URL,
  },
  privateRuntimeConfig: {
    auth: {
      strategies: {
        laravelSanctum: {
          provider: 'laravel/sanctum',
          url: process.env.BASE_URL,
          cookie: {
            name: 'XSRF-TOKEN',
          },
          user: {
            property: 'data',
          },
          endpoints: {
            logout: { url: '/logout', method: 'post' },
            user: { url: '/api/user', method: 'get' },
          },
        },
      },
      redirect: {
        login: '/accounts/login',
        logout: '/',
        callback: '/accounts/login',
        home: '/',
      },
    },
    axios: {
      baseURL: process.env.BASE_URL,
    },
  },
  // test

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'Bloomwood',
    htmlAttrs: {
      lang: 'en',
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' },
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      {
        rel: 'preconnect',
        href: 'https://fonts.googleapis.com',
      },
      {
        rel: 'preconnect',
        href: 'https://fonts.gstatic.com',
        crossorigin: true,
      },
      {
        rel: 'stylesheet',
        href: 'https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap',
      },
      {
        rel: 'stylesheet',
        href: 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
      },
    ],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '@/plugins/global.js',
    { src: '@/plugins/swiper.client.js' },
    '@/plugins/vue-modal.js',
    { src: '~/plugins/aos.js', mode: 'client' },
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/eslint
    '@nuxtjs/eslint-module',
    // https://go.nuxtjs.dev/tailwindcss
    '@nuxtjs/tailwindcss',
    '@nuxtjs/composition-api/module',
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
  ],

  auth: {
    strategies: {
      laravelSanctum: {
        provider: 'laravel/sanctum',
        url: process.env.BACKEND_URL,
        cookie: {
          name: 'XSRF-TOKEN',
        },
        user: {
          property: 'data',
        },
        endpoints: {
          logout: { url: '/logout', method: 'post' },
          user: { url: '/api/user', method: 'get' },
        },
      },
    },
    redirect: {
      login: '/accounts/login',
      logout: '/',
      callback: '/accounts/login',
      home: '/',
    },
  },

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  // axios: {
  //   credentials: true,
  //   baseURL: process.env.BASE_URL,
  //   https: process.env.HTTPS_BOOLEAN || false,
  // },
  axios: {
    credentials: true,
    baseURL: process.env.BACKEND_URL,
    https: process.env.HTTPS_BOOLEAN || false,
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {},
}
