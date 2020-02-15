const path = require("path");

module.exports = {
  pages: {
    index: {
      entry: "./client/main.js",
      template: "./client/public/index.html",
      filename: "index.html"
    }
  },
  chainWebpack: config => {
    config.resolve.alias.set("@", path.join(__dirname, "./client"));
  },
  indexPath: "/Users/jamescooper/Projects/cloudgallery/templates/index.twig",
  outputDir: "./public"
};
