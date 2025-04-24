const second = 1000;
const minute = second * 60;
const hour = minute * 60;
const day = hour * 24;

let count_down = new Date('03/03/2025 00:00:00').getTime();
let x = setInterval(() => countDown(), second);

function countDown() {
  let now = new Date(Date.now()).getTime();
  let diff = count_down - now;

  document.getElementById('days').innerText = Math.floor(diff / day) < 0?0:Math.floor(diff / day);
  document.getElementById('hours').innerText = Math.floor(diff % day / hour) < 0?0:Math.floor(diff % day / hour);
  document.getElementById('minutes').innerText = Math.floor(diff % hour / minute) < 0?0:Math.floor(diff % hour / minute);
  document.getElementById('seconds').innerText = Math.floor(diff % minute / second) < 0?0:Math.floor(diff % minute / second);
}

function resetCountdown() {
  clearInterval(x);
  // document.form_main.date_end.value;
  let date_end = '2022-09-03'
  console.log(date_end)
  count_down = new Date(`${date_end} 00:00:00`).getTime();
  x = setInterval(() => countDown(), second);
}
resetCountdown()
