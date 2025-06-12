import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import("tailwindcss").Config} */
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
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            screens: {
                xs: "450px",
            },
            colors: {
                primary: "var(--primary)",
                secondary: "var(--secondary)",
                "secondary-fonce": "var(--secondary-fonce)",
                third: "var(--third)",
                "third-fonce": "var(--third-fonce)",
                accent: "var(--accent)",
                header: "var(--header)",
                "accent-dark": "var(--accent-dark)",
                normal: "var(--normal)",
                muted: "var(--muted)",
                "extra-muted": "var(--extra-muted)",
                inverse: "var(--inverse)",
                error: "var(--error)",
            },
        },
    },
    plugins: [],
};
