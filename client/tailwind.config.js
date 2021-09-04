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
        'dark-icon': '#625F60', // Dark Icon
        disabled: '#ECECEC',
        'disabled-dark': '#B2ADAF',
        success: '#77B17D',
        warn: '#CDCE86',
      },
    },
    fontFamily: {
      serif: [
        'Libre Baskerville',
        'Georgia',
        'Cambria',
        'Times New Roman',
        'Times',
        'serif',
      ],
      sans: ['Gotham', 'ui-sans-serif', 'system-ui'],
    },
    container: {
      padding: {
        DEFAULT: '0.5rem',
        sm: '1rem',
        md: '0.5rem',
      },
    },
    aspectRatio: {
      1: '1',
      27: '27',
      40: '40',
    },
  },
  variants: {
    extend: {
      borderRadius: ['first', 'last'],
    },
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/line-clamp'),
  ],
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
