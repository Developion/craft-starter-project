import * as fs from 'fs';
import path from 'path';

const dir = 'src/js'
export const isDev = () => {
  return !!process.argv.find(el => el === '--config-dev');
}

export const files = (dir) => {
  return fs.readdirSync(dir).filter(el => path.extname(el) === '.js').map(el => dir + '/' + el)
}