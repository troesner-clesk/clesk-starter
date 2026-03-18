/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './**/*.php',
        './components/**/*.php',
        './src/**/*.js',
        'node_modules/preline/dist/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: 'var(--color-primary)',
                    hover: 'var(--color-primary-hover)',
                    light: 'var(--color-primary-light)',
                },
                secondary: {
                    DEFAULT: 'var(--color-secondary)',
                    hover: 'var(--color-secondary-hover)',
                },
                heading: 'var(--color-heading)',
                body: 'var(--color-text)',
                muted: 'var(--color-text-muted)',
                surface: {
                    DEFAULT: 'var(--color-surface)',
                    dark: 'var(--color-surface-dark)',
                },
                border: 'var(--color-border)',
            },
            fontFamily: {
                heading: 'var(--font-heading)',
                body: 'var(--font-body)',
                mono: 'var(--font-mono)',
            },
            borderRadius: {
                sm: 'var(--radius-sm)',
                md: 'var(--radius-md)',
                lg: 'var(--radius-lg)',
                xl: 'var(--radius-xl)',
            },
            boxShadow: {
                sm: 'var(--shadow-sm)',
                md: 'var(--shadow-md)',
                lg: 'var(--shadow-lg)',
                xl: 'var(--shadow-xl)',
            },
        },
    },
    plugins: [
        require('preline/plugin'),
        require('@tailwindcss/typography'),
    ],
};
