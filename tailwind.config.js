/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      keyframes: {
        'fade-in': {
          '0%': { opacity: '0' },
          '100%': { opacity: '1'},
        },
        'slide-in-left': {
          '0%': { transform: 'translateX(-100%)', opacity: '0'},
          '100%': { transform: 'translateX(0)', opacity: '1' },
        },
        'slide-in-down': {
          '0%': { opacity: '0', transform: 'translateY(0px)' },
          '100%': { opacity: '1' , transform: 'translateY(-20)'},
        },
        'slide-in-right': {
          '0%': { transform: 'translateX(100%)', opacity: '0' },
          '100%': { transform: 'translateX(0)', opacity: '1' },
        }
      },
      animation: {
        'fade-in': 'fade-in 0.5s ease-out',
        'slide-in-left': 'slide-in-left 0.5s ease-out',
        'slide-in-down': 'slide-in-down 0.5s ease-out',
        'slide-in-right': 'slide-in-right 0.5s ease-out',
      },
    },
  },
  plugins: [],
}

