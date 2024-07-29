/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors:{
        'custom-black1' : '#1a1d1f',
        'custom-black2' : '#111315',
      }
    },
  },
  plugins: [],
}

