module.exports = {
  content: [
    "./wp-content/themes/joaosanches/**/*.php",
    "./wp-content/themes/joaosanches/**/*.html",
    "./wp-content/themes/joaosanches/src/**/*.js",
  ],
  darkMode: "media",
  theme: {
    extend: {
      fontFamily: {
        montserrat: ["Montserrat", "sans-serif"],
      },
      fontSize: {
        "80px": ["80px", 1.1],
        "64px": ["64px", 1.2],
        "56px": ["56px", 1.1],
        "48px": ["48px", 1.2],
        "40px": ["40px", 1.2],
        "32px": ["32px", 1.2],
        "24px": ["24px", 1.3],
        "20px": ["20px", 1.2],
        "16px": ["16px", 1.5],
        "14px": ["14px", 1.4],
        "12px": ["12px", 1.3],
      },
      colors: {
        orange: "#FA4F00",
        orangeLight: "#f77e1b",
        blue: "#006FFF",
        grey: {
          light: "#7C7C7C",
          dark: "#464646",
        },
      },
      spacing: {},
      screens: {
        "3xl": "1480px",
        "4xl": "1727px",
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
