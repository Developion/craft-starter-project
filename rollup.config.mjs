import nodeResolve from '@rollup/plugin-node-resolve';
import nodePolyfills from 'rollup-plugin-polyfill-node'
import commonjs from '@rollup/plugin-commonjs';
import { babel } from '@rollup/plugin-babel';
import terser from '@rollup/plugin-terser';
import del from 'rollup-plugin-delete'
import { isDev, files } from './.build/Rollup.mjs'

export default [
  {
    input: [
      ...files("src/front/js"),
    ],
    output: {
      dir: 'dist/front/public/js',
      format: 'esm',
      sourcemap: isDev(),
    },
    plugins: [
      babel({ babelHelpers: 'bundled' }),
      del({
        targets: 'dist/front/public/js/*',
        runOnce: true
      }),
      terser(),
      nodeResolve({
        exportConditions: ['node']
      }),
      //   nodePolyfills(),
      commonjs()
    ],
  }
]
