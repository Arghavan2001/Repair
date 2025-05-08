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
      reject: [ // یا اینکه از reject برای فایل‌هایی که نمی‌خواهید بررسی شوند استفاده کنید.
        '!./assets/vendor/bootstrap/css/bootstrap.min.css',  // این فایل را نادیده می‌گیریم
        '!./assets/vendor/bootstrap/js/bootstrap.min.js',  // این فایل را نادیده می‌گیریم
      ]
    }),
  ],
};
