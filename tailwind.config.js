import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Roboto", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                navbar: "#1b3758",
                sidebar: "#1f2937",
                background: "#001427",
                primary: "#3730a3",
                discord: "#5865F2",
                input: "#183046",
            },
        },
    },
    plugins: [require("@tailwindcss/typography")],
};
