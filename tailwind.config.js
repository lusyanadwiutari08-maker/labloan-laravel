import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary: '#137fec',
                'primary-dark': '#0f65bd',
                'background-light': '#f6f7f8',
                'background-dark': '#111827',
                'surface-dark': '#1F2937',
                'border-dark': '#374151',
                'text-secondary': '#92adc9',
                'success-neon': '#00ff88',
                error: '#ef4444',
            },
            fontFamily: {
                display: ['Manrope', 'sans-serif'],
            },
            borderRadius: {
                DEFAULT: '0.25rem',
                lg: '0.5rem',
                xl: '0.75rem',
                full: '9999px',
            },
        },
    },
    plugins: [forms],
};
