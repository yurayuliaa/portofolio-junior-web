// Lab 1 - Array dan Objek (Data Peserta)
const peserta = [
  { id: 1, nama: 'Sari', kelas: 'Web', nilai: 90, aktif: true },
  { id: 2, nama: 'Budi', kelas: 'Web', nilai: 68, aktif: true },
  { id: 3, nama: 'Citra', kelas: 'Data', nilai: 82, aktif: false },
  { id: 4, nama: 'Dewi', kelas: 'Web', nilai: 75, aktif: true },
  { id: 5, nama: 'Eka', kelas: 'Data', nilai: 88, aktif: true },
  { id: 6, nama: 'Fajar', kelas: 'Jaringan', nilai: 71, aktif: false },
  { id: 7, nama: 'Gita', kelas: 'Jaringan', nilai: 93, aktif: true },
  { id: 8, nama: 'Hadi', kelas: 'Data', nilai: 64, aktif: true },
  { id: 9, nama: 'Indah', kelas: 'Web', nilai: 85, aktif: false },
  { id: 10, nama: 'Joko', kelas: 'Jaringan', nilai: 79, aktif: true },
];

// 1. Peserta aktif saja
const pesertaAktif = (daftar) => daftar.filter((p) => p.aktif);

// 2. Urut berdasarkan nama tanpa mengubah array asli
const urutNama = (daftar) => [...daftar].sort((a, b) => a.nama.localeCompare(b.nama));

// 3. Cari berdasarkan id, tangani bila tidak ditemukan
function cariById(daftar, id) {
  const hasil = daftar.find((p) => p.id === id);
  return hasil ?? null;
}

// 4. Hitung jumlah peserta per kelas dengan objek penghitung
function hitungPerKelas(daftar) {
  const hitung = {};
  for (const p of daftar) hitung[p.kelas] = (hitung[p.kelas] || 0) + 1;
  return hitung;
}

// 5. Tambah, ubah, hapus
function tambah(daftar, baru) {
  daftar.push(baru);
}
function ubah(daftar, id, perubahan) {
  const p = cariById(daftar, id);
  if (!p) return false;
  Object.assign(p, perubahan);
  return true;
}
function hapus(daftar, id) {
  const idx = daftar.findIndex((p) => p.id === id);
  if (idx === -1) return false;
  daftar.splice(idx, 1);
  return true;
}

// 6. Array -> objek berindeks id (pencarian O(1))
const indeksById = (daftar) => daftar.reduce((acc, p) => { acc[p.id] = p; return acc; }, {});

console.log('--- 1. Peserta aktif ---');
console.table(pesertaAktif(peserta).map((p) => ({ id: p.id, nama: p.nama })));

console.log('--- 2. Urut nama (array asli tidak berubah) ---');
console.log(urutNama(peserta).map((p) => p.nama).join(', '));
console.log('Array asli  :', peserta.map((p) => p.nama).join(', '));

console.log('--- 3. Cari id ---');
console.log('id 3  :', cariById(peserta, 3));
console.log('id 99 :', cariById(peserta, 99) ?? 'Peserta tidak ditemukan');

console.log('--- 4. Jumlah per kelas ---');
console.log(hitungPerKelas(peserta));

console.log('--- 5. Tambah / ubah / hapus ---');
tambah(peserta, { id: 11, nama: 'Kiki', kelas: 'Web', nilai: 80, aktif: true });
console.log('Setelah tambah :', peserta.length, 'peserta');
ubah(peserta, 2, { nilai: 78 });
console.log('Setelah ubah   :', cariById(peserta, 2));
hapus(peserta, 6);
console.log('Setelah hapus  :', peserta.length, 'peserta; id 6 =', cariById(peserta, 6));
console.log('ubah id 99     :', ubah(peserta, 99, { nilai: 0 }), '| hapus id 99:', hapus(peserta, 99));

console.log('--- 6. Objek berindeks id ---');
const byId = indeksById(peserta);
console.log('byId[5] =', byId[5]);
console.log('byId[6] =', byId[6], '(sudah dihapus)');