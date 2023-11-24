// // const mix = require('laravel-mix');

// // /*
// //  |--------------------------------------------------------------------------
// //  | Mix Asset Management
// //  |--------------------------------------------------------------------------
// //  |
// //  | Mix provides a clean, fluent API for defining some Webpack build steps
// //  | for your Laravel applications. By default, we are compiling the CSS
// //  | file for the application as well as bundling up all the JS files.
// //  |
// //  */

// // mix.js('resources/js/app.js', 'public/js')
// //     .postCss('resources/css/app.css', 'public/css', [
// //         require('postcss-import'),
// //         require('tailwindcss'),
// //     ]);

// // if (mix.inProduction()) {
// //     mix.version();
// // }

const mix = require("laravel-mix");

// const fileIncludeWebpackPlugin = require("file-include-webpack-plugin");

const postcssImport = require("postcss-import");
const tailwindcss = require("tailwindcss");
const tailwindConfig = require("./tailwind.config");
const postcssNested = require("postcss-nested");
const postcssCustomProperties = require("postcss-custom-properties");
const autoprefixer = require("autoprefixer");

// Public Path
mix.setPublicPath("public/dist");

// Resource Path
mix.setResourceRoot("src");

// Options
mix.options({
  processCssUrls: false,
  cssNano: false,
});

// CSS
mix.postCss("src/assets/css/style.css", "assets/css", [
  // postcssImport(),
  tailwindcss({
    ...tailwindConfig,
    purge: {
      enabled: mix.inProduction(),
      // content: ["src/**/*.html"],
      options: {
        safelist: ["dark"],
      },
    },
  }),
  postcssNested(),
  postcssCustomProperties(),
  autoprefixer(),
]);

// JS
mix.combine(
  [
    "src/assets/js/script.js",
    "src/assets/js/extras.js",
    "src/assets/js/components/",
  ],
  "public/dist/assets/js/script.js"
);

// Vendor JS
mix.combine(
  [
    "node_modules/@popperjs/core/dist/umd/popper.min.js",
    "node_modules/tippy.js/dist/tippy.umd.min.js",
  ],
  "public/dist/assets/js/vendor.js"
);

// Vendor Extras
mix.copy(
  [
    "node_modules/chart.js/dist/chart.min.js",
    "node_modules/sortablejs/Sortable.min.js",
    "node_modules/@glidejs/glide/dist/glide.min.js",
    "node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js",
  ],
  "public/dist/assets/js"
);

// Images
mix.copy("src/assets/images", "public/dist/assets/images");

// Fonts
mix.copy(
  "node_modules/line-awesome/dist/line-awesome/fonts/**/*",
  "public/dist/assets/fonts"
);

// mix.js('resources/js/app.js', 'laravel/js')
//     .postCss('resources/css/app.css', 'laravel/css', [
//         require('postcss-import'),
//         // require('tailwindcss'),
//     ]);

// if (mix.inProduction()) {
//     mix.version();
// }