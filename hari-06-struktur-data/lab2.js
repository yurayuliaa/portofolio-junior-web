// Lab 2 - Map dan Set

// 1. Frekuensi kata dengan Map, tampil terurut dari yang paling sering
function hitungFrekuensi(kalimat) {
  const frekuensi = new Map();
  for (const kata of kalimat.split(' ').filter(Boolean)) {
    frekuensi.set(kata, (frekuensi.get(kata) || 0) + 1);
  }
  return frekuensi;
}
const frek = hitungFrekuensi('saya belajar web saya suka web');
const terurut = [...frek].sort((a, b) => b[1] - a[1] || a[0].localeCompare(b[0]));
console.log('--- 1. Frekuensi kata (terurut) ---');
for (const [kata, jumlah] of terurut) console.log(`${kata}: ${jumlah}`);

// 2. Hilangkan duplikat email dengan Set
const emailAwal = ['a@x.com', 'b@x.com', 'a@x.com', 'c@x.com', 'b@x.com'];
console.log('--- 2. Hapus duplikat email ---');
console.log('Sebelum:', emailAwal);
console.log('Sesudah:', [...new Set(emailAwal)]);

// 3. Irisan dua daftar peserta dengan Set
function irisan(a, b) {
  const himpunanA = new Set(a);
  return [...new Set(b)].filter((x) => himpunanA.has(x));
}
const kelasA = ['Sari', 'Budi', 'Citra', 'Dewi'];
const kelasB = ['Budi', 'Eka', 'Dewi', 'Fajar'];
console.log('--- 3. Irisan kelas A dan B ---');
console.log(irisan(kelasA, kelasB));

// 4. adaDuplikat versi Set - O(n)
export function adaDuplikat(daftar) {
  const terlihat = new Set();
  for (const x of daftar) {
    if (terlihat.has(x)) return true;
    terlihat.add(x);
  }
  return false;
}
console.log('--- 4. adaDuplikat ---');
console.log('[]           ->', adaDuplikat([]));          // false
console.log('[7]          ->', adaDuplikat([7]));         // false
console.log('[1,2,3]      ->', adaDuplikat([1, 2, 3]));   // false
console.log('[1,2,3,2]    ->', adaDuplikat([1, 2, 3, 2])); // true