/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './*.php',
        './inc/**/*.php',
        './components/**/*.php',
        './template-parts/**/*.php',
        './src/**/*.js',
    ],
    safelist: [
        { pattern: /^(gap|gap-x|gap-y|space-x|space-y)-(0|1|2|3|4|5|6|7|8|10|12)$/ },
        { pattern: /^(p|m|px|py|pt|pb|pl|pr|mx|my|mt|mb|ml|mr)-(0|1|2|3|4|5|6|8|10|12|16|20|24)$/ },
        { pattern: /^(grid-cols|col-span|row-span)-(1|2|3|4|5|6|7|8|9|10|11|12)$/ },
        { pattern: /^(w|h|min-w|min-h|max-w|max-h)-(full|screen|auto|0|1|2|3|4|5|6|8|10|12|16|20|24|32|40|48|56|64|72|80|96)$/ },
        { pattern: /^(text|bg|border)-(white|black|transparent|current)$/ },
        { pattern: /^(rounded|rounded-(sm|md|lg|xl|2xl|3xl|full))$/ },
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
        require('@tailwindcss/typography'),
    ],
};
