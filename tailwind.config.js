import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                espresso: "#332223",
                mocha: "#4A3133",
                cacau: "#5D3D40",
                taupe: "#968183",
                nude: "#C4A594",
                "rose-nude": "#DCC3B6",
                blush: "#EAD4CC",
                cream: "#F6EEE7",
                ivory: "#FBF6F0",
                gold: {
                    DEFAULT: "#C39A57",
                    light: "#E4C889",
                    deep: "#9A7433",
                },
                rose: "#D9A9A0",
            },
            fontFamily: {
                display: [
                    '"Playfair Display"',
                    ...defaultTheme.fontFamily.serif,
                ],
                body: ["Montserrat", ...defaultTheme.fontFamily.sans],
                sans: ["Montserrat", ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                soft: "0 10px 40px rgba(51,34,35,.12)",
                gold: "0 8px 30px rgba(195,154,87,.25)",
            },
            borderRadius: {
                brand: "18px",
                "brand-sm": "10px",
            },
        },
    },

    plugins: [forms],
};
