import js from '@eslint/js';

export default [
  js.configs.recommended,
  {
    languageOptions: {
      ecmaVersion: 2022,
      sourceType: 'module',
      globals: {
        document: 'readonly',
        window: 'readonly',
        console: 'readonly',
        // tambahan agar lab Node/browser tidak dianggap "tidak terdefinisi"
        process: 'readonly',
        performance: 'readonly',
        localStorage: 'readonly',
        confirm: 'readonly',
        setTimeout: 'readonly',
        clearTimeout: 'readonly',
      },
    },
    rules: {
      eqeqeq: 'error',
      'no-var': 'error',
      'prefer-const': 'warn',
      'no-unused-vars': 'warn',
    },
  },
];