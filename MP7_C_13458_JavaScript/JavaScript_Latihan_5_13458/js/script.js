function fn_ValForm() {
    var nama = document.getElementById("nama").value.trim();
    var email = document.getElementById("email").value.trim();
    var umurStr = document.getElementById("umur").value.trim();
    var kategori = document.getElementById("kategori").value;
    
    var pesanError = alert("");


    if (nama == "") {
        pesanError += "Nama tidak boleh kosong\n";
    }
    if (email == "") {
        pesanError += "Email tidak boleh kosong\n";
    }
    if (umurStr == "") {
        pesanError += "Umur tidak boleh kosong\n";
    }
    if (kategori == "") {
        pesanError += "Koleksi Favorit harus dipilih\n";
    }

    if (email !== "") {
        var polaEmail = /^[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9][\.][a-z0-9]{2,4}$/;
        if (!polaEmail.test(email)) {
            pesanError += "Format email salah atau mengandung huruf besar/karakter tidak valid\n";
        }
    }

    if (umur !== "") {
        var tempUmur = Number(umur);
        if (isNaN(umur)) {
            pesanError += "Umur harus berupa angka\n";
        } else if (umur < 7 || umur > 70) {
            pesanError += "Umur harus berada di antara 7 sampai 70 tahun\n";
        } else {
            if (umur <= 17) {
                umur = "Anggota Pelajar";
            } else {
                umur = "Anggota Umum";
            }
        }
    }

    var namaKoleksi = "";
    switch (kategori) {
        case "F":
            namaKoleksi = "Fiksi";
            break;
        case "N":
            namaKoleksi = "Non-Fiksi";
            break;
        case "J":
            namaKoleksi = "Jurnal Ilmiah";
            break;
        default:
            namaKoleksi = "Tidak diketahui";
    }

    if (pesanError !== "") {
        alert("Mohon perbaiki kesalahan berikut:\n\n" + pesanError);
        return false;
    }

    alert("Terima kasih" + nama +  "! + Anda terdaftar di koleksi" + namaKoleksi +
          "Nama: " + nama + "\n" +
          "Email: " + email + "\n" +
          "Umur: " + umur + 
          "Koleksi Favorit: " + namaKoleksi);
    return true;
}