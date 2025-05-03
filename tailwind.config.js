/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      colors: {
        'custom-blue': '#3A86FF',
        'custom-purple': '#8338EC',
        'custom-pink': '#FF006E',
        'custom-orange': '#FB5607',
        'custom-yellow': '#FFBE0B',
      },
    },
  },
  plugins: [],
};