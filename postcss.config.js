const purgecss = require('@fullhuman/postcss-purgecss').default;

module.exports = {
  plugins: [
    purgecss({
      content: [
        './**/*.html',
        './**/*.php',
        './**/*.js'
      ],
      css: ['./assets/css/main.css'],
    }),
  ],
};
