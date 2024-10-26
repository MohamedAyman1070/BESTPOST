/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                //black -black (default)
                // "custom-black1": "#1a1d1f",
                // "custom-black2": "#111315",

                //blue -gold
                "custom-black1": "#001f3f",

                "custom-black2": "#001020",

                "custom-text": "#2f3367",

                // "custom-black2": "#FFD700",

                //teal -coral
                // "custom-black1": "#008080",
                // "custom-black2": "#FF7F50",

                //darkpurple - lavandar
                // "custom-black1": "#4B0082",
                // "custom-black2": "#E6E6FA",

                //forestgreen - mint
                // "custom-black1": "#228B22",
                // "custom-black2": "#98FF98",

                // Charcoal and Orange
                // "custom-black1": "#36454F",
                // "custom-black2": "#FFA500",

                //blue - white
                // "custom-black1": "#1DA1F2",
                // "custom-black2": "#FFFFFF",

                //Purple and Pink
                // "custom-black1": "#9146FF",
                // "custom-black2": "#FF69B4",

                //green - white
                // "custom-black1": "#25D366",
                // "custom-black2": "#FFFFFF",

                // orange - dark gray
                // "custom-black1": "#FF4500",
                // "custom-black2": "#333333",

                "name-color": "#2f3367",
            },
        },
    },
    plugins: [],
};
