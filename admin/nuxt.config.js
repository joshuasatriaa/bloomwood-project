export default {
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,

  publicRuntimeConfig: {
    BASE_URL: process.env.BASE_URL,
    BACKEND_URL: process.env.BACKEND_URL,
  },

  privateRuntimeConfig: {
    axios: {
      baseURL: process.env.BASE_URL,
    },
  },

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'Bloomwood Admin',
    htmlAttrs: {
      lang: 'en',
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' },
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: ['@/assets/scss/main.scss', '@/assets/css/main.css'],

  styleResources: {
    scss: '@/assets/scss/_variables.scss',
  },

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: ['@/plugins/bootstrap.js', '@/plugins/global.js'],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/eslint
    '@nuxtjs/eslint-module',
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    '@nuxtjs/style-resources',
    '@nuxtjs/auth-next',
    [
      'vue-toastification/nuxt',
      {
        transition: ' Vue-Toastification__fade',
      },
    ],
  ],

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
        redirect: {
          login: '/login',
          logout: '/',
          home: '/home',
        },
      },
    },
  },

  router: {
    linkExactActiveClass: 'active',
  },

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    credentials: true,
    baseURL: process.env.BASE_URL,
    https: process.env.HTTPS_BOOLEAN || false,
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {},
}
