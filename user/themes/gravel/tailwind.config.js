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
  theme: {
    extend: {
      screens: {
        sm: '640px',
        md: '768px',
        lg: '1024px',
        xl: '1280px',
        '2xl': '1536px'
      }
    },
    colors: {
      'primary': {
        'lighter': colors.yellow[300],
        DEFAULT: colors.yellow[400],
        'darker' : colors.yellow[500],
      },
      gray: colors.gray,
      black: colors.black,
      white: colors.white,
      red: colors.red,
      green: colors.green,
      blue: colors.blue,
      orange: colors.orange,
      indigo: colors.indigo,
      transparent: 'transparent',
      'inherit': 'inherit',
    }
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
  important: false,
}
