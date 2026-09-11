import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    presets: [
        require("./vendor/wireui/wireui/tailwind.config.js")
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./vendor/wireui/wireui/src/*.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/WireUi/**/*.php",
        "./vendor/wireui/wireui/src/Components/**/*.php",
    ],

    darkMode: 'class',
    theme: {
        container: {
            center: true,
        },
        extend: {
            colors: {
                base: {
                    white: '#FFFFFF',
                    black: '#000611',
                    background: '#F5F5F5',
                    'text-primary': '#001F56',
                    'text-secondary': '#FAFAFA',
                    'text-subtitle': '#757575',
                    'text-muted': '#9E9E9E',
                    'text-disable': '#332F2F',
                    custom1: '#F1F7FF',
                    custom2:'#C6E2FF'
                },
                'deep-purple': {
                    500: '#673AB7',
                },
                // Blue Primary
                'blue-primary': {
                    0: '#7FADFF',
                    50: '#729FEE',
                    100: '#6691DD',
                    150: '#5982CC',
                    200: '#4C74BB',
                    300: '#33589A',
                    400: '#193B78',
                    500: '#001F56',
                    600: '#001945',
                    700: '#001334',
                    800: '#000C22',
                    850: '#00091A',
                    900: '#000611',
                    950: '#000309',
                },

                // Blue Secondary
                'blue-secondary': {
                    0: '#8FC7FF',
                    50: '#81B8F0',
                    100: '#72A9E0',
                    150: '#649BD1',
                    200: '#568CC2',
                    300: '#396EA3',
                    400: '#1D5185',
                    500: '#003366',
                    600: '#002952',
                    700: '#001F3D',
                    800: '#001429',
                    850: '#000F1F',
                    900: '#000A14',
                    950: '#00050A',
                },
                'blue-tertiary': {
                    0: '#E3EDFC',
                    50: '#CEDDF3',
                    100: '#BACEEA',
                    150: '#A5BEE1',
                    200: '#90AED8',
                    300: '#678FC7',
                    400: '#3D6FB5',
                    500: '#1450A3',
                    600: '#104082',
                    700: '#0C3062',
                    800: '#082041',
                    850: '#041021',
                    900: '#041021',
                    950: '#020810',
                },

                'yellow-accent-dark': {
                    3: '#FEDC66',
                    4: '#FDD133',
                    5: '#FDC500',
                },


                'yellow-accent-light': {
                    3: '#FFE366',
                    4: '#FFD933',
                    5: '#FFD000',
                },

                primary: {
                    DEFAULT: '#4361ee',
                    light: '#eaf1ff',
                    'dark-light': 'rgba(67,97,238,.15)',
                },
                secondary: {
                    DEFAULT: '#805dca',
                    light: '#BA68C8',
                    'dark-light': 'rgb(128 93 202 / 15%)',
                },
                success: {
                    DEFAULT: '#00ab55',
                    light: '#ddf5f0',
                    'dark-light': 'rgba(0,171,85,.15)',
                },
                danger: {
                    DEFAULT: '#e7515a',
                    light: '#fff5f5',
                    'dark-light': 'rgba(231,81,90,.15)',
                },
                warning: {
                    DEFAULT: '#e2a03f',
                    light: '#fff9ed',
                    'dark-light': 'rgba(226,160,63,.15)',
                },
                info: {
                    DEFAULT: '#2196f3',
                    light: '#e7f7ff',
                    'dark-light': 'rgba(33,150,243,.15)',
                },
                dark: {
                    DEFAULT: '#3b3f5c',
                    light: '#eaeaec',
                    'dark-light': 'rgba(59,63,92,.15)',
                },
                black: {
                    DEFAULT: '#0e1726',
                    light: '#e3e4eb',
                    'dark-light': 'rgba(14,23,38,.15)',
                },
                white: {
                    DEFAULT: '#ffffff',
                    light: '#e0e6ed',
                    dark: '#888ea8',
                },
            },
            fontFamily: {
                "vazir": "vazir",
                "vazirLight": "vazir light",
                "vazirBold": "vazir bold",
                "IranYekanWeb": "IranYekanWeb",
                "Esfahan": "Esfahan",
                "Titr": "Titr",
                "Nastaligh": "Nastaligh",
            },
            spacing: {
                4.5: '18px',
            },
            boxShadow: {
                '3xl': '0 2px 2px rgb(224 230 237 / 46%), 1px 6px 7px rgb(224 230 237 / 46%)',
            },
            typography: ({ theme }) => ({
                DEFAULT: {
                    css: {
                        '--tw-prose-invert-headings': theme('colors.white.dark'),
                        '--tw-prose-invert-links': theme('colors.white.dark'),
                        h1: { fontSize: '40px', marginBottom: '0.5rem', marginTop: 0 },
                        h2: { fontSize: '32px', marginBottom: '0.5rem', marginTop: 0 },
                        h3: { fontSize: '28px', marginBottom: '0.5rem', marginTop: 0 },
                        h4: { fontSize: '24px', marginBottom: '0.5rem', marginTop: 0 },
                        h5: { fontSize: '20px', marginBottom: '0.5rem', marginTop: 0 },
                        h6: { fontSize: '16px', marginBottom: '0.5rem', marginTop: 0 },
                        p: { marginBottom: '0.5rem' },
                        li: { margin: 0 },
                        img: { margin: 0 },
                    },
                },
            }),
        },
    },

    plugins: [
        forms,
        require('@tailwindcss/typography')
    ],
};
