const colors = require('tailwindcss/colors')
let plugin = require('tailwindcss/plugin')

module.exports = {
  content: [
    '../../config/**/*.yaml',
    '../../pages/**/*.md',
    './blueprints/**/*.yaml',
    './js/**/*.js',
    './templates/**/*.twig',
    './gravel.yaml',
    './gravel.php'
  ],
  darkMode: 'class', //false or 'media' or 'class'
  daisyui: {
    themes: ["bumblebee", "coffee"],
    base: true
  },
  theme: {
    backgroundSize: {
      'auto': 'auto',
      'cover': 'cover',
      'contain': 'contain',
      '120%': '120%',
    },
    extend: {
      fontFamily: {
        'shadows-light': ['"Shadows Into Light"', 'cursive'],
        'poppins': ['"Poppins"', 'sans-serif']
      },
    },
    container: {
      screens: {
        'sm': '640px',
        'md': '768px',
        'lg': '1024px',
        'xl': '1220px',
        '2xl': '1220px',
      }
    }
  },
  plugins: [
    require('@tailwindcss/typography'),
    require("daisyui"),
    plugin(function ({ addVariant }) {
      addVariant('scrolled', '.scrolled &')
    })
  ],
  important: false,
}
