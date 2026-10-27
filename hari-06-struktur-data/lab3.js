// Lab 3 - Stack
import { Stack } from './js/structures.js';
import { pathToFileURL } from 'node:url';

export function kurungSeimbang(teks) {
  const pasangan = { ')': '(', ']': '[', '}': '{' };
  const tumpukan = new Stack();
  for (const karakter of teks) {
    if ('([{'.includes(karakter)) {
      tumpukan.push(karakter);
    } else if (karakter in pasangan) {
      if (tumpukan.isEmpty() || tumpukan.pop() !== pasangan[karakter]) return false;
    }
  }
  return tumpukan.isEmpty();
}

/** Membalik string memakai Stack. */
export function balikString(teks) {
  const s = new Stack();
  for (const k of teks) s.push(k);
  let hasil = '';
  while (!s.isEmpty()) hasil += s.pop();
  return hasil;
}

/** Palindrom: abaikan huruf besar/kecil dan karakter non-alfanumerik. */
export function palindrom(teks) {
  const bersih = teks.toLowerCase().replace(/[^a-z0-9]/g, '');
  return bersih === balikString(bersih);
}

// Menjalankan uji hanya bila berkas ini dieksekusi langsung (bukan di-import)
if (import.meta.url === pathToFileURL(process.argv[1]).href) {
  console.log('--- 2. Uji Stack ---');
  const s = new Stack();
  console.log('pop stack kosong :', s.pop());
  console.log('peek stack kosong:', s.peek());
  s.push(1); s.push(2); s.push(3);
  console.log('size =', s.size(), '| peek =', s.peek());
  while (!s.isEmpty()) console.log('pop ->', s.pop());
  console.log('pop saat kosong  :', s.pop(), '(tidak error)');
  s.push('satu');
  console.log('satu elemen: peek =', s.peek(), '| pop =', s.pop(), '| isEmpty =', s.isEmpty());

  console.log('--- 3. kurungSeimbang ---');
  console.log(kurungSeimbang('(a+b)*[c-d]')); // true
  console.log(kurungSeimbang('(a+b]'));       // false
  console.log(kurungSeimbang('((a)'));        // false
  console.log(kurungSeimbang(''));            // true
  console.log(kurungSeimbang('))(('));        // false
  console.log(kurungSeimbang('{[()]}'));      // true

  console.log('--- 4. Balik string & palindrom ---');
  console.log(balikString('Struktur Data'));
  console.log(balikString(''));
  for (const t of ['katak', 'Kasur ini rusak', 'belajar', '', 'a']) {
    console.log(`"${t}" ->`, palindrom(t));
  }
}