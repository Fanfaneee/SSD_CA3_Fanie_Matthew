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
        'custom-blue-dark': '#2A66C7',
        'custom-blue-form': '#4075CA',
        'custom-purple': '#8338EC',
        'custom-purple-dark': '#6D24D3',
        'custom-pink': '#FF006E',
        'custom-pink-dark': '#D5006D',
        'custom-orange': '#FB5607',
        'custom-yellow': '#FFBE0B',
        'custom-yellow-dark': '#DBA716',
        'custom-background': '#17181C',
        'custom-background-dark': '#090B15',
      },
      fontFamily: {
        'custom-rubik': ['Rubik', 'sans-serif'],
      },
      animation: {
        spin: 'spin 5s linear infinite', // Animation de rotation
      },
      keyframes: {
        spin: {
          '0%': { transform: 'rotate(0deg)' },
          '100%': { transform: 'rotate(360deg)' },
        },
      }
    },
  },
  plugins: [],
};