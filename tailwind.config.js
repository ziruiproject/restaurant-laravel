/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
    fontFamily: {
      'sans': ['Geologica']
    },
    colors: {
      'background': '#fafafa',
      'white': '#ffffff',
      'black': '#3d3d3d',
      'darker-gray': '#7f7f7f',
      'gray': '#ebebeb',
      'orange': '#ec7905',
      'orange-shade': '#fef0e1',
    }
  },
  plugins: [],
}

