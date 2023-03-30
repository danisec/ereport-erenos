/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        screens: {
            xs: { min: "300px" },
            // => @media (min-width: 300px and max-width: 479px) { ... }

            ms: { min: "480px" },
            // => @media (min-width: 480px and max-width: 639px) { ... }

            sm: { min: "640px" },
            // => @media (min-width: 640px and max-width: 767px) { ... }

            md: { min: "768px" },
            // => @media (min-width: 768px and max-width: 1023px) { ... }

            lg: { min: "1024px" },
            // => @media (min-width: 1024px and max-width: 1279px) { ... }

            xl: { min: "1280px" },
            // => @media (min-width: 1280px and max-width: 1535px) { ... }

            "2xl": { min: "1536px" },
            // => @media (min-width: 1536px) { ... }
        },
        fontFamily: {
            roboto: ["Roboto", "sans-serif"],
            josefin: ["Josefin Sans", "sans-serif"],
            crimson: ["Crimson Text", "sans-serif"],
            lexend: ["Lexend Deca", "sans-serif"],
            rubik: ["Rubik", "sans-serif"],
        },
        extend: {
            colors: {
                header: "#2F2CE4",
                "nav-active": "#7B7A79",
                hero: "#35A7FF",
                "button-yellow": "#EDF200",
            },
            backgroundImage: {
                "hero-pattern": "url('/public/images/pngwing.svg')",
                "login-pattern":
                    "url('/public/images/pattern/login-pattern.svg')",
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
