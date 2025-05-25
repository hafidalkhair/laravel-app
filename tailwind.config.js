/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
      },
      colors: {
        primary: '#3B82F6',    // Blue-500
        secondary: '#6B7280',  // Gray
        success: '#10B981',    // Green
        warning: '#F59E0B',    // Yellow
        error: '#EF4444',      // Red
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

