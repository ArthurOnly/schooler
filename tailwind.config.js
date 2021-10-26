module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        primary: "#81b29a",
        secondary: "#e07a5f"
      }
    },
    customForms: theme => ({
      default: {
        input: {
          backgroundColor: theme('colors.primary'),
          '&:focus': {
            backgroundColor: theme('colors.white'),
          }
        },
        select: {
          '&:focus': {
            backgroundColor: theme('colors.white'),
          }
        },
        checkbox: {
          color: theme('colors.primary')
        },
      },
    })
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
