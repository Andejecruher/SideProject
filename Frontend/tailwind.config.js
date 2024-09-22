/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        'black': '#000000',
        'red': '#FF0000',
        'blue': '#0064e0',
        'white': '#FFFFFF',
      },
      fontFamily: {
        'jacquard': ['Jacquard', 'sans-serif'],
      },
      spacing: {
        '1': '8px',
        '2': '12px',
        '3': '16px',
        '4': '24px',
        '5': '32px',
        '6': '48px',
      },
    },
  },
  plugins: [],
}