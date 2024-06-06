/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./views/**/*.{html,js}"],
  theme: {
    extend: {
      colors: {
        light:{
          font: '#131313',   
          button : '#A43131', 
          klik : '#7E1E1E',
          header : '#F3F4F6', 
        }
      },
      fontFamily :{
        inter : ['Inter'],
      },
    },
  },
  plugins: [],
}

