import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['IBM Plex Sans', ...defaultTheme.fontFamily.sans],
                display: ['Bebas Neue', 'sans-serif'],
                mono: ['Space Mono', 'monospace'],
            },
            colors: {
                'nb-primary': 'var(--nb-primary)',
                'nb-secondary': 'var(--nb-secondary)',
                'nb-accent': 'var(--nb-accent)',
                'nb-ink': 'var(--nb-ink)',
                'nb-paper': 'var(--nb-paper)',
                'nb-surface': 'var(--nb-surface)',
                'nb-error': 'var(--nb-error)',
                'nb-success': 'var(--nb-success)',
                'nb-warning': 'var(--nb-warning)',
                'nb-info': 'var(--nb-info)',
            }
        },
    },
    plugins: [],
};
