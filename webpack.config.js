const MiniCssExtractPlugin = require("mini-css-extract-plugin");
let jsConfig = {
  resolve: {
    modules: [
      './node_modules',
      __dirname + '/assets/ts',
      __dirname + '/assets',
      __dirname + '/include/classes'
    ],
    extensions: [".ts", ".tsx", ".js", ".json"],
  },
  name: 'js',

  entry: {
    javascript: __dirname + '/assets/js/index.js',
  },

  output: {
    path: __dirname + '/html/javascript/',
    publicPath: '/javascript/',
    filename: 'main.js',
  },

  module: {
    rules: [
      {
        test: /\.tsx?$/,
        loader: 'ts-loader',
        exclude: /node_modules/,
      },
      {
        test: /\.s[ac]ss$/i,
        use: [
          // Creates `style` nodes from JS strings
          "style-loader",
          // Translates CSS into CommonJS
          "css-loader",
          // Compiles Sass to CSS
          "sass-loader",
        ],
      },
    ]
  }
}; // end js config

// Section 2: CSS/SCSS configuration
// let cssConfig = {
//   name: 'scss',
//   entry: {
//     main: [
//       __dirname + '/assets/scss/style.scss'
//     ],
//   },
//
//   output: {
//     path: __dirname + '/html/css/',
//     filename: 'main.css',
//   },
//   module: {
//     rules: [
//       {
//         test: /\.s[ac]ss$/i,
//         use: [
//           // fallback to style-loader in development
//           process.env.NODE_ENV !== "production"
//             ? "style-loader"
//             : MiniCssExtractPlugin.loader,
//           "css-loader",
//           "sass-loader",
//         ],
//       },
//     ],
//   },
//   plugins: [
//       new MiniCssExtractPlugin({
//         // Options similar to the same options in webpackOptions.output
//         // both options are optional
//         filename: "[name].css",
//         chunkFilename: "[id].css",
//       }),
//     ],
// };

let cssConfig = {
  entry: {
    style: __dirname + '/assets/scss/style.scss',
  },

  output: {
    path: __dirname + '/html/css/',
    filename: 'style.css',
  },

  module: {
    rules: [
      {
        test: /\.s[ac]ss$/i,
        use: [
          // Creates `style` nodes from JS strings
          "style-loader",
          // Translates CSS into CommonJS
          "css-loader",
          // Compiles Sass to CSS
          "sass-loader",
        ],
      },
    ],
  },
};

module.exports = [jsConfig, cssConfig];
