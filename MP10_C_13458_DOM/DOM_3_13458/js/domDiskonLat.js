var totalNode;
var totalElem;
var hematNode;

function init() {
  totalElem = document.getElementById("totalBayar");
  totalNode = totalElem.firstChild;
  hematNode = document.getElementById("hemat").firstChild;
  hitungTotal();
}

function hitungTotal() {
  var harga = parseFloat(document.getElementById("harga").value);
  var diskon = parseFloat(document.getElementById("diskon").value);

  if (isNaN(diskon) || diskon < 0 || diskon > 100) {
    totalNode.data = "Diskon tidak valid!";
    totalElem.style.color = "red";
    hematNode.data = 0;
  } else {
    var hargaValid = isNaN(harga) ? 0 : harga;
    var potongan = hargaValid * (diskon / 100);
    var akhir = hargaValid - potongan;

    totalNode.data = akhir;
    totalElem.style.color = "green";
    hematNode.data = potongan;
  }
}