const colors = require('tailwindcss/colors')

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
    }
  },
  plugins: [
    require('@tailwindcss/typography'),
    require("daisyui")
  ],
  important: false,
}
