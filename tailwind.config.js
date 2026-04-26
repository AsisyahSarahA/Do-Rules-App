import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import plugin from 'tailwindcss/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                donezo: {
                    dark: '#0e3f2b', // Very dark green for cards
                    primary: '#175e3a', // Primary green for active states/buttons
                    light: '#e6f4ed', // Very light green background
                    accent: '#3ebd7e', // Lighter green for charts/accents
                    text: '#1e293b', // Dark slate for text
                    gray: '#f8fafc', // Light gray backgrounds
                    border: '#e2e8f0', // Soft borders
                }
            }
        },
    },

    plugins: [
        forms,
        // Tambahan custom plugin untuk backdrop-blur (Tailwind v3+ sebenarnya sudah built-in class `backdrop-blur-sm`, dsb)
        plugin(function ({ addUtilities }) {
            addUtilities({
                '.backdrop-blur-custom': {
                    'backdrop-filter': 'blur(10px)',
                    '-webkit-backdrop-filter': 'blur(10px)',
                },
            });
        }),
    ],
};
