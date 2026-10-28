// Lab 2 - Tree dan Graph
import { BinarySearchTree } from './structures.js';

const folder = {
  nama: 'proyek',
  anak: [
    { nama: 'css', anak: [] },
    { nama: 'js', anak: [{ nama: 'app.js', anak: [] }] },
  ],
};

function cetakPohon(node, tingkat = 0) {
  console.log(' '.repeat(tingkat * 2) + node.nama);
  for (const anak of node.anak) cetakPohon(anak, tingkat + 1);
}

function hitungNode(node) {
  let total = 1;
  for (const anak of node.anak) total += hitungNode(anak);
  return total;
}

/**
 * Mencari node bernama `nama` secara rekursif.
 * @returns {string|null} jalur lengkap, mis. 'proyek/js/app.js', atau null bila tidak ada.
 */
function cariNode(node, nama, jalur = node.nama) {
  if (node.nama === nama) return jalur;
  for (const anak of node.anak) {
    const hasil = cariNode(anak, nama, `${jalur}/${anak.nama}`);
    if (hasil !== null) return hasil;
  }
  return null;
}

// Graf jaringan 6 kota (adjacency list, tidak berarah)
const graf = {
  Denpasar: ['Gianyar', 'Tabanan'],
  Gianyar: ['Denpasar', 'Ubud'],
  Tabanan: ['Denpasar', 'Negara', 'Singaraja'],
  Ubud: ['Gianyar', 'Singaraja'],
  Singaraja: ['Tabanan', 'Ubud'],
  Negara: ['Tabanan'],
};

function bfs(g, mulai) {
  const dikunjungi = new Set([mulai]);
  const antrean = [mulai];
  const urutan = [];
  for (let i = 0; i < antrean.length; i++) {
    const simpul = antrean[i];
    urutan.push(simpul);
    for (const tetangga of g[simpul]) {
      if (!dikunjungi.has(tetangga)) {
        dikunjungi.add(tetangga);
        antrean.push(tetangga);
      }
    }
  }
  return urutan;
}

function dfs(g, simpul, dikunjungi = new Set()) {
  dikunjungi.add(simpul);
  for (const tetangga of g[simpul]) {
    if (!dikunjungi.has(tetangga)) dfs(g, tetangga, dikunjungi);
  }
  return [...dikunjungi];
}

/**
 * Jarak terpendek (jumlah sisi) memakai BFS.
 * @returns {number} jumlah sisi, atau -1 bila tidak terhubung.
 * @throws {Error} bila asal/tujuan tidak ada di graf.
 */
function jarakTerpendek(g, asal, tujuan) {
  if (!(asal in g) || !(tujuan in g))
    throw new Error(`Kota tidak dikenal: ${asal} / ${tujuan}`);
  const jarak = new Map([[asal, 0]]);
  const antrean = [asal];
  for (let i = 0; i < antrean.length; i++) {
    const simpul = antrean[i];
    if (simpul === tujuan) return jarak.get(simpul);
    for (const tetangga of g[simpul]) {
      if (!jarak.has(tetangga)) {
        jarak.set(tetangga, jarak.get(simpul) + 1);
        antrean.push(tetangga);
      }
    }
  }
  return -1;
}

console.log('--- 1. Pohon folder ---');
cetakPohon(folder);
console.log('jumlah node :', hitungNode(folder));
console.log('cariNode app.js :', cariNode(folder, 'app.js'));
console.log('cariNode css    :', cariNode(folder, 'css'));
console.log('cariNode x.txt  :', cariNode(folder, 'x.txt'));

console.log('--- 2. Binary Search Tree ---');
const bst = new BinarySearchTree();
[50, 30, 70, 20, 40, 60, 80].forEach((n) => bst.insert(n));
console.log('inOrder :', bst.inOrder());
console.log('has(60) :', bst.has(60), '| has(65):', bst.has(65));

console.log('--- 3. Graf 6 kota ---');
console.log('bfs dari Denpasar:', bfs(graf, 'Denpasar'));
console.log('dfs dari Denpasar:', dfs(graf, 'Denpasar'));
console.log(
  'Denpasar -> Ubud      :',
  jarakTerpendek(graf, 'Denpasar', 'Ubud'),
);
console.log(
  'Denpasar -> Singaraja :',
  jarakTerpendek(graf, 'Denpasar', 'Singaraja'),
);
console.log('Negara   -> Ubud      :', jarakTerpendek(graf, 'Negara', 'Ubud'));
console.log(
  'Denpasar -> Denpasar  :',
  jarakTerpendek(graf, 'Denpasar', 'Denpasar'),
);
try {
  jarakTerpendek(graf, 'Denpasar', 'Mars');
} catch (error) {
  console.log('Kota salah ->', error.message);
}