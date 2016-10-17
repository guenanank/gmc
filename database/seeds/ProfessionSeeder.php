<?php

use Illuminate\Database\Seeder;
use App\Profession;

class ProfessionSeeder extends Seeder {

    public function run() {
        DB::statement("SET foreign_key_checks=0");
        Profession::truncate();
        DB::statement("SET foreign_key_checks=1");
        $seeds = '[{"professionSubFrom":"0","professionName":"Belum bekerja","professionParent":null},{"professionSubFrom":"0","professionName":"Pelajar","professionParent":null},{"professionSubFrom":"0","professionName":"Mahasiwa","professionParent":null},{"professionSubFrom":"0","professionName":"Ibu Rumah Tangga","professionParent":null},{"professionSubFrom":"0","professionName":"Pensiunan","professionParent":null},{"professionSubFrom":"0","professionName":"Guru \/ Dosen","professionParent":null},{"professionSubFrom":"0","professionName":"Karyawan BUMN \/ BUMD","professionParent":null},{"professionSubFrom":"0","professionName":"Karyawan Swasta","professionParent":null},{"professionSubFrom":"0","professionName":"Pegawai Negeri Sipil","professionParent":null},{"professionSubFrom":"0","professionName":"Profesional","professionParent":null},{"professionSubFrom":"0","professionName":"TNI\/Polri","professionParent":null},{"professionSubFrom":"0","professionName":"Wiraswasta","professionParent":null},{"professionSubFrom":"0","professionName":"Freelance\/tenaga lepas","professionParent":null},{"professionSubFrom":"0","professionName":"Lainnya","professionParent":null},{"professionSubFrom":"7","professionName":"Staff","professionParent":"Karyawan BUMN \/ BUMD"},{"professionSubFrom":"7","professionName":"Supervisor \/ Kepala Sub Bagian","professionParent":"Karyawan BUMN \/ BUMD"},{"professionSubFrom":"7","professionName":"Manager \/ Kepala Bagian","professionParent":"Karyawan BUMN \/ BUMD"},{"professionSubFrom":"7","professionName":"Senior Manager \/ General Manager","professionParent":"Karyawan BUMN \/ BUMD"},{"professionSubFrom":"7","professionName":"Direktur \/ Pimpinan Perusahaan","professionParent":"Karyawan BUMN \/ BUMD"},{"professionSubFrom":"7","professionName":"Owner \/ Pemilik perusahaan","professionParent":"Karyawan BUMN \/ BUMD"},{"professionSubFrom":"8","professionName":"Staff","professionParent":"Karyawan Swasta"},{"professionSubFrom":"8","professionName":"Supervisor \/ Kepala Sub Bagian","professionParent":"Karyawan Swasta"},{"professionSubFrom":"8","professionName":"Manager \/ Kepala Bagian","professionParent":"Karyawan Swasta"},{"professionSubFrom":"8","professionName":"Senior Manager \/ General Manager","professionParent":"Karyawan Swasta"},{"professionSubFrom":"8","professionName":"Direktur \/ Pimpinan Perusahaan","professionParent":"Karyawan Swasta"},{"professionSubFrom":"8","professionName":"Owner \/ Pemilik perusahaan","professionParent":"Karyawan Swasta"},{"professionSubFrom":"9","professionName":"Staff","professionParent":"Pegawai Negeri Sipil"},{"professionSubFrom":"9","professionName":"Supervisor \/ Kepala Sub Bagian","professionParent":"Pegawai Negeri Sipil"},{"professionSubFrom":"9","professionName":"Manager \/ Kepala Bagian","professionParent":"Pegawai Negeri Sipil"},{"professionSubFrom":"9","professionName":"Senior Manager \/ General Manager","professionParent":"Pegawai Negeri Sipil"},{"professionSubFrom":"9","professionName":"Direktur \/ Pimpinan Perusahaan","professionParent":"Pegawai Negeri Sipil"},{"professionSubFrom":"9","professionName":"Owner \/ Pemilik perusahaan","professionParent":"Pegawai Negeri Sipil"}]';
        foreach (json_decode($seeds) as $row) :
            $seed = collect($row);
            $seed->pull('professionParent');
            Profession::create($seed->toArray());
        endforeach;
    }

}
