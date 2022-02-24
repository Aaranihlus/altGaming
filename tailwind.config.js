const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/*.blade.php',
    './resources/views/components/*.blade.php',
    './resources/views/layouts/*.blade.php',
    './resources/views/auth/*.blade.php'
  ],

  theme: {
    colors: {
      'alt-yellow': '#332b00'
    },

    extend: {
      fontFamily: {
        sans: ['Nunito', ...defaultTheme.fontFamily.sans]
      },
    },
  },

  plugins: [require('@tailwindcss/forms')],
};
