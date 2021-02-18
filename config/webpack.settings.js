module.exports = {
  entries: {
    // JS File
    'blocks-script': './src/js/blocks.js',
    'blocks-style': './src/postcss/blocks.css'
  },
  filename: {
    js: 'js/[name].js',
    css: 'css/[name].css',
    minifiedJs: 'js/[name].min.js',
    minifiedCss: 'css/[name].min.css'
  },
  paths: {
    src: {
      base: './src/',
      css: './src/postcss/',
      js: './src/js/'
    },
    dist: {
      base: './assets',
      clean: ['./css', './js']
    }
  },
  stats: {
    // Copied from `'minimal'`.
    all: false,
    errors: true,
    maxModules: 0,
    modules: true,
    warnings: true,
    // Our additional options.
    assets: true,
    errorDetails: true,
    excludeAssets: /\.(jpe?g|png|gif|svg|woff|woff2)$/i,
    moduleTrace: true,
    performance: true
  },
  ImageminPlugin: {
    test: /\.(jpe?g|png|gif)$/i
  },
  BrowserSyncConfig: {
    host: 'localhost',
    port: 3000,
    watch: true,
    proxy: {
      target: 'http://ecom.test',
      proxyReq: [
        proxyReq => {
          proxyReq.setHeader('X-Codetot-Block-Header', 'development')
        }
      ]
    },
    ignorePaths: '/wp-admin/**',
    open: 'local',
    browser: 'google chrome',
    notify: false,
    files: [
      '**/*.php',
      'assets/js/**/*.js',
      'assets/css/**/*.css',
      'assets/svg/**/*.svg',
      'assets/img/**/*.{jpg,jpeg,png,gif}',
      'assets/fonts/**/*.{eot,ttf,woff,woff2,svg}',
      'src/**/*.css',
      'src/**/*.js'
    ]
  },
  performance: {
    maxAssetSize: 100000
  },
  manifestConfig: {
    basePath: ''
  }
}