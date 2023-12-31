<?php

namespace Database\Seeders;

use App\Models\SponsoringDistrict;
use Illuminate\Database\Seeder;

class SponsoringDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $districts = [
            ['district_name'=>'ABA']
            ,['district_name'=>'ABAKALIKI']
            ,['district_name'=>'ABEOKUTA']
            ,['district_name'=>'ABRAKA']
            ,['district_name'=>'ABUJA']
            ,['district_name'=>'ADO-EKITI']
            ,['district_name'=>'Afikpo &amp; District']
            ,['district_name'=>'Akoko &amp; District']
            ,['district_name'=>'AKURE']
            ,['district_name'=>'ALIMOSHO']
            ,['district_name'=>'AMUWO']
            ,['district_name'=>'ASABA']
            ,['district_name'=>'AUCHI']
            ,['district_name'=>'AWKA']
            ,['district_name'=>'BAUCHI']
            ,['district_name'=>'BENIN']
            ,['district_name'=>'Bonny Kingdom']
            ,['district_name'=>'CALABAR']
            ,['district_name'=>'CAMEROON']
            ,['district_name'=>'CANADA']
            ,['district_name'=>'CBN Chapter']
            ,['district_name'=>'DUTSE']
            ,['district_name'=>'Eket &amp; District']
            ,['district_name'=>'Ekpoma']
            ,['district_name'=>'ENUGU']
            ,['district_name'=>'EPE']
            ,['district_name'=>'FIDELITY Bank Chapter']
            ,['district_name'=>'GOMBE']
            ,['district_name'=>'Gwagwalada &amp; District']
            ,['district_name'=>'HONGKONG']
            ,['district_name'=>'HUNGARY']
            ,['district_name'=>'IBADAN']
            ,['district_name'=>'IJEBU-ODE']
            ,['district_name'=>'IKEJA']
            ,['district_name'=>'IKORODU']
            ,['district_name'=>'ILARO']
            ,['district_name'=>'Ilesa &amp; district']
            ,['district_name'=>'ILORIN']
            ,['district_name'=>'ILUPEJU/GBAGADA']
            ,['district_name'=>'JALINGO']
            ,['district_name'=>'JOS']
            ,['district_name'=>'KADUNA']
            ,['district_name'=>'KANO/JIGAWA']
            ,['district_name'=>'KATSINA']
            ,['district_name'=>'LAFIA']
            ,['district_name'=>'LAGOS']
            ,['district_name'=>'LAGOS MAINLAND']
            ,['district_name'=>'LEKKI']
            ,['district_name'=>'LOKOJA']
            ,['district_name'=>'LSPS Chapter']
            ,['district_name'=>'MAIDUGURI/DAMATURU']
            ,['district_name'=>'MAKURDI']
            ,['district_name'=>'MALAYSIA']
            ,['district_name'=>'MINNA']
            ,['district_name'=>'MOWE']
            ,['district_name'=>'N/A']
            ,['district_name'=>'NASARAWA']
            ,['district_name'=>'NEPA, ABUJA']
            ,['district_name'=>'NEW YORK']
            ,['district_name'=>'NIGER']
            ,['district_name'=>'NNEWI']
            ,['district_name'=>'NNPC CHAPTER']
            ,['district_name'=>'NSUKKA']
            ,['district_name'=>'Nyanya-Mararaba']
            ,['district_name'=>'OAGF']
            ,['district_name'=>'OAuGF']
            ,['district_name'=>'OFFA']
            ,['district_name'=>'OGBOMOSO']
            ,['district_name'=>'OGHARA']
            ,['district_name'=>'OGUDU-OJOTA']
            ,['district_name'=>'OGUN']
            ,['district_name'=>'OGUN STATE PUBLIC SERVICE CHAPTER']
            ,['district_name'=>'OJO, BADAGRY,AGBARA']
            ,['district_name'=>'Okene']
            ,['district_name'=>'Okitipupa']
            ,['district_name'=>'ONDO']
            ,['district_name'=>'ONISTHA']
            ,['district_name'=>'OSOGBO']
            ,['district_name'=>'OSUN']
            ,['district_name'=>'OTA']
            ,['district_name'=>'OWERRI']
            ,['district_name'=>'OWO']
            ,['district_name'=>'OYO']
            ,['district_name'=>'PLATEAU']
            ,['district_name'=>'PORT HARCOURT']
            ,['district_name'=>'PORT-HARCOURT']
            ,['district_name'=>'REMO']
            ,['district_name'=>'RIVERS STATE']
            ,['district_name'=>'Satellite Town']
            ,['district_name'=>'SIERRA LEONE']
            ,['district_name'=>'SOKOTO']
            ,['district_name'=>'SOUTH AFRICA']
            ,['district_name'=>'SOUTHERN AFRICA']
            ,['district_name'=>'SRI LANKA']
            ,['district_name'=>'SURULERE']
            ,['district_name'=>'SWAN']
            ,['district_name'=>'SWITZERLAND']
            ,['district_name'=>'TANZANIA']
            ,['district_name'=>'TARABA']
            ,['district_name'=>'TOGO']
            ,['district_name'=>'TORONTO']
            ,['district_name'=>'U.K']
            ,['district_name'=>'U.S.A']
            ,['district_name'=>'UGEP']
            ,['district_name'=>'UMUAHIA']
            ,['district_name'=>'UYO']
            ,['district_name'=>'VICTORIA ISLAND']
            ,['district_name'=>'WARRI AND DISTRICT']
            ,['district_name'=>'WUSE']
            ,['district_name'=>'Yenagoa']
            ,['district_name'=>'YOLA']
            ,['district_name'=>'ZAMFARA']
            ,['district_name'=>'ZARIA']
        ];
        foreach($districts as $district){
            SponsoringDistrict::create($district);
        }
    }
}
