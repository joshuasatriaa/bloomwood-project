// const colors = require('tailwindcss/colors')

module.exports = {
  mode: 'jit',
  important: true,
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        // primary: '#8A817C', // The Gray
        primary: '#000000', // The Black,
        secondary: '#A7A29E', // The New Gray
        'secondary-light': '#BCB8B1', // The Light Gray
        // tertiary: '#F4F3EE', // The Chocolate
        tertiary: '#F9F9F9', // The Chocolate
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
      sans: ['Inter', 'ui-sans-serif', 'system-ui'],
    },
    container: {
      padding: {
        DEFAULT: '0.5rem',
        sm: '1rem',
        md: '0.5rem',
      },
    },
    lineClamp: {
      1: '1',
      2: '2',
      3: '3',
      4: '4',
      5: '5',
      6: '6',
      7: '7',
      8: '8',
    },
    aspectRatio: {
      1: '1',
      22: '22',
      27: '27',
      40: '40',
      50: '50',
      108: '108',
      120: '120',
      148: '148',
      150: '150',
      162: '162',
      300: '300',
      335: '335',
      370: '370',
      398: '398',
      479: '479',
      480: '480',
      499: '499',
      578: '578',
      600: '600',
      650: '650',
      666: '666',
      731: '731',
      750: '750',
      960: '960',
      1920: '1920',
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
    require('@tailwindcss/forms'),
  ],
  purge: {
    content: [
      `components/**/*.{vue,js}`,
      `layouts/**/*.vue`,
      `pages/**/*.vue`,
      `plugins/**/*.{js,ts}`,
      `nuxt.config.{js,ts}`,
    ],
    // safelist: [
    //   'text-center',
    //   'hover:opacity-100',
    //   // ...
    //   'lg:text-right',
    // ],
  },
}
