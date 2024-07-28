let plugin = require("tailwindcss/plugin");
module.exports = {
  content: ["./*.{html,php}","./scripts/*.js"],
  theme: {
    extend: {
      colors: {
        teal: {
          400: '#49B8A5',  
          500: '#358073',
          900: '#013C4A'
        },
        orange:{
          500: '#E8A530',
          600: '#D6911A',
        },
        rose:{
          300: '#FBD6CE',
          400: '#FFC3B6'
        },
      },
      fontFamily: {
        comfortaa: ['Comfortaa', 'sans-serif'],
      },



    },
  },
  plugins: [
    require('tailwindcss-3d'),
    plugin(
      function ({ addVariant }) { /* ajoutez ici tous les états spécifiques à votre site */
      }
    )
  ],
}

