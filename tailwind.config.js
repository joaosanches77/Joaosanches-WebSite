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
        outfit: ["Outfit", "sans-serif"],
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
        green: {
          "01": "#001A17",
          "02": "#00332E",
          "03": "#008375",
          "04": "#00C4B3",
        },
        grey: {
          "01": "#B0C4C2",
          "02": "#73807E",
        },
        beje: {
          "01": "#EDEBE4",
          "02": "#FAF8F0",
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
