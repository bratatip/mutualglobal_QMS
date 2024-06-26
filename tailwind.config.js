/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./*.{html,js}", 
    "./!(build|dist|.*)/**/*.{html,js}"
  ],
  theme: {
    extend: {
      backgroundImage: {
        // 'admin-login-bg': "config('app.url')/images/admin_login_bg.png",
        'mgibq-orange-gradient': 'linear-gradient(180deg, #E25E14 33.33%, #B34B11 100%)',
        'mgibq-blue-gradient': 'linear-gradient(180deg, #0E5D85 0%, #1C8AC0 100%)',
        'mgibq-website-logo': "url('/images/logo.svg')",
        'mgibq-white-gradient' : 'linear-gradient(180deg, #FFFFFF 0%, rgba(255, 255, 255, 0.996823) 0.52%, rgba(255, 255, 255, 0.79) 100%)',
      },

      colors: {
        'mgibq-blue': '#0F628B',
        // 'yellow':'#eab308',
        white: "#fff",
        black: "#000",
        ghostwhite: "#f8f9fc",
        gray: "#000008",
        orange: "#f7b610",
      },
      fontFamily: {
        inter: "Inter",
      },
      boxShadow: {
        'mgibq-box-shadow': '0px 2px 4px rgba(0, 0, 0, 0.25)',
      }
    },
    fontSize: {
      xl: "20px",
      mini: "15px",
      inherit: "inherit",
    },
  },
  // corePlugins: {
  //   preflight: false,
  // },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),

],


}

