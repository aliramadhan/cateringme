const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {        
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {             
        extend: {        
            zIndex: ['hover', 'active'],
            opacity: ['responsive', 'hover', 'focus', 'disabled'], 
        },

   
},

    

    plugins: [require('@tailwindcss/ui')],
};
