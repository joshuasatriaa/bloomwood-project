// const colors = require('tailwindcss/colors')

module.exports = {
  mode: 'jit',
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        primary: '#8A817C', // The Gray
        secondary: '#BCB8B1', // The Light Gray
        tertiary: '#F4F3EE', // The Chocolate
        pink: '#E0AFA0', // The Pink
        'soft-gray': '#DEDEDE', // Border
        brown: '#463F3A', // The Brown
      },
    },
    fontFamily: {
      sans: ['Libre Baskerville', 'ui-sans-serif', 'system-ui'],
    },
    container: {
      padding: {
        DEFAULT: '0.5rem',
        sm: '1rem',
        md: '0rem',
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
  purge: {
    content: [
      `components/**/*.{vue,js}`,
      `layouts/**/*.vue`,
      `pages/**/*.vue`,
      `plugins/**/*.{js,ts}`,
      `nuxt.config.{js,ts}`,
    ],
  },
}
