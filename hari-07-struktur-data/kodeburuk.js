//membuat tampilan kode otomatis baik dengan eslint dan prettier
import js from '@eslint/js';
export default [
  js.configs.recommended,
  {
    languageOptions: {
      ecmaVersion: 2022,
      sourceType: 'module',
        globals: { document: 'readonly', window: 'readonly', console: 'readonly' }
    },
    rules: {
      eqeqeq: 'error',
        'no-var': 'error',
        'prefer-const': 'warn',
        'no-unused-vars': 'warn'
    }
  }
];  
//contoh penggunaan eslint dan prettier untuk memperbaiki kode yang buruk
const d = [80, 65, 90];
function calculateAverage(a) {
  let sum = 0;          
    for (let i = 0; i < a.length; i++) {
        sum += a[i];
    }
    return sum / a.length;
}

function determineGrade(x) {
  if (x >= 85) {
    return 'A';     
    } else if (x >= 70) {
        return 'B';
    } else if (x >= 55) {
        return 'C';
    } else {
        return 'D';
    }
}   

function coba(){
    const r = calculateAverage(d);
    console.log(r);
}
coba(10)
/*
 
var d = [80,65,90];
function f(a){var s=0;for(var i=0;i<a.length;i++){s=s+a[i]}return s/a.length}
function g(x){ if(x>=85){return 'A'}else{ if(x>=70){return 'B'}else{ if(x>=55){return 'C'}else{return 'D'}}}}
var r=f(d);
if(r==80){console.log('bagus')}
function h(n){ var p=n*0.11; return n+p }
function k(n){ var p=n*0.11; return n+p }
console.log(g(r))
*/