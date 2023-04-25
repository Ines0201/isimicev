const lajk = document.getElementById('lajk');

function sakrijGumb(lajk) {
  lajk.disabled = true;
}
lajk.addEventListener('click', sakrijGumb);
