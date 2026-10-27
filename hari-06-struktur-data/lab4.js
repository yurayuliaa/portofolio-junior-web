// Lab 4 - Uji Queue (simulasi UI ada di antrian.html)
import { Queue } from './js/structures.js';

const q = new Queue();
console.log('dequeue queue kosong:', q.dequeue(), '| front:', q.front(), '| isEmpty:', q.isEmpty());
q.enqueue('A001'); q.enqueue('A002'); q.enqueue('A003');
console.log('size =', q.size(), '| front =', q.front(), '| toArray =', q.toArray());
while (!q.isEmpty()) console.log('dequeue ->', q.dequeue());
console.log('dequeue saat kosong:', q.dequeue(), '(tidak error), size =', q.size());

q.enqueue('X');
console.log('satu elemen: front =', q.front(), '| dequeue =', q.dequeue(), '| isEmpty =', q.isEmpty());
q.enqueue('Y'); q.clear();
console.log('setelah clear: size =', q.size(), '| toArray =', q.toArray());