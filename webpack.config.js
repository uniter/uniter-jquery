module.exports = {
  context: __dirname,
  entry: './js/app.js',
  module: {
    loaders: [
      {
        test: /\.json$/,
        loader: 'json-loader'
      }
    ]
  },
  output: {
    path: 'dist/',
    filename: 'bundle.js',
  },
  resolve: {
    // TODO: These should only need to be specified in the Uniter core package
    alias: {
      'languages': 'uniter/languages',
      'js': 'uniter/js'
    },
    modulesDirectories: ['node_modules'],
  }
};
