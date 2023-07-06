<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $institutions =  [
            ['institution_name'=>'A.C.C.A'],
            ['institution_name'=>'ABDUL-GUSAU POLYTECHNIC, TALATA-MAFARA'],
            ['institution_name'=>'ABIA STATE POLYTECHNIC'],
            ['institution_name'=>'ABIA STATE UNIVERSITY'],
            ['institution_name'=>'ABUBAKAR TAFAWA BALEWA UNIVERSITY BAUCHI'],
            ['institution_name'=>'ABUBAKAR TATARI ALI POLYTECHNIC'],
            ['institution_name'=>'ABUBAKAR TATARI ALI POLYTECHNIC, BAUCHI'],
            ['institution_name'=>'ABUJA SCHOOL OF ACCOUNTANCY AND COMPUTER STUDIES'],
            ['institution_name'=>'ACHIEVERS UNIVERSITY, OWO'],
            ['institution_name'=>'ADAM SMITH UNIVERSITY OF AMERICA'],
            ['institution_name'=>'ADAMAWA STATE POLYTECHNIC'],
            ['institution_name'=>'ADAMAWA STATE UNIVERSITY'],
            ['institution_name'=>'ADEKUNLE AJASIN UNIVERSITY'],
            ['institution_name'=>'ADENIRAN OGUNSANYA COLLEGE OF EDUC.'],
            ['institution_name'=>'ADEYEMI COLLEGE OF EDUCATION'],
            ['institution_name'=>'AHFAD UNIVERSITY FOR WOMEN'],
            ['institution_name'=>'AHMADU BELLO UNIVERSITY'],
            ['institution_name'=>'AJAYI CROWTHER UNIVERSITY'],
            ['institution_name'=>'AKANU-IBIAM FEDERAL POLYTECHNIC'],
            ['institution_name'=>'AKPERAN ORSHI COLLEGE OF AGRIC GBOKO'],
            ['institution_name'=>'AKWA-IBOM STATE POLYTECHNIC, IKOT-OSURUA'],
            ['institution_name'=>'AL-HIKMAH UNIVERSITY ILORIN'],
            ['institution_name'=>'ALL OVER CENTRAL POLYTECHNIC OTA'],
            ['institution_name'=>'AMBROSE ALLI UNIVERSITY, EKPOMA'],
            ['institution_name'=>'AMERICAN INTERCONTINENTAL UNIVERSITY'],
            ['institution_name'=>'AMERICAN UNIVERSITY OF NIGERIA, YOLA'],
            ['institution_name'=>'ANAMBRA STATE POLYTECHNIC, OKO'],
            ['institution_name'=>'ANAMBRA STATE UNIVERSITY ULI'],
            ['institution_name'=>'ANDREWS UNIVERSITY MICHIGAN'],
            ['institution_name'=>'ARELLANO UNIVERSITY'],
            ['institution_name'=>'ASSOCIATION OF NATIONAL ACCOUNTANTS OF NIG.'],
            ['institution_name'=>'ATS ICAN'],
            ['institution_name'=>'ATS LONDON'],
            ['institution_name'=>'AUCHI POLYTECHNIC AUCHI'],
            ['institution_name'=>'AYODEJI OTEGBOLA ICT POLYTECHNIC IGBESA'],
            ['institution_name'=>'BABCOCK UNIVERSITY, ILISHAN-REMO'],
            ['institution_name'=>'BAYERO UNIVERSITY'],
            ['institution_name'=>'BELLS UNIVERSITY OF SCIENCE AND TECHNOLOGY, OTTA'],
            ['institution_name'=>'BENDEL STATE UNIVERSITY, EKPOMA'],
            ['institution_name'=>'BENSON IDAHOSA UNIVERSITY BENIN'],
            ['institution_name'=>'BENUE STATE POLYTECHNIC, UGBOKOLO'],
            ['institution_name'=>'BENUE STATE UNIVERSITY, MAKURDI'],
            ['institution_name'=>'BINGHAM UNIVERSITY KARU'],
            ['institution_name'=>'BOWEN UNIVERSITY'],
            ['institution_name'=>'BUS &amp; TECH EDU LONDON'],
            ['institution_name'=>'C.I.B.N. (NEW)'],
            ['institution_name'=>'C.I.B.N. (OLD)'],
            ['institution_name'=>'C.I.I.N.'],
            ['institution_name'=>'C.I.M.A'],
            ['institution_name'=>'CALEB UNIVERSITY, IMOTA, LAGOS'],
            ['institution_name'=>'CALIFORNIA STATE UNIVERSITY, USA'],
            ['institution_name'=>'CARISTAS UNIVERSITY, ENUGU'],
            ['institution_name'=>'CERTIFIED PUBLIC ACCOUNTANTS'],
            ['institution_name'=>'CHARTERED INS OF MGT ACCOUNTANTS'],
            ['institution_name'=>'CHARTERED INST OF STOCKBROKER'],
            ['institution_name'=>'CHICAGO STATE UNIVERSITY'],
            ['institution_name'=>'CITN'],
            ['institution_name'=>'COLLEGE OF EDUCATION WARRI'],
            ['institution_name'=>'COLUMBIA PACIFIC UNIVERSITY'],
            ['institution_name'=>'COVENANT UNIVERSITY OTTA'],
            ['institution_name'=>'CRAWFORD UNIVERSITY, OGUN STATE'],
            ['institution_name'=>'CRESCENT UNIVERSITY ABEOKUTA'],
            ['institution_name'=>'CROSS RIVER UNIVERSITY OF TECHNOLOGY'],
            ['institution_name'=>'CROWN POLYTECHNIC, ADO-EKITI'],
            ['institution_name'=>'D.S. ADEGBENRO ICT POLYTECHNIC'],
            ['institution_name'=>'DEEMED UNIVERSITY'],
            ['institution_name'=>'DELTA STATE POLYTECHNIC, OGARA'],
            ['institution_name'=>'DELTA STATE UNIVERSITY, ABRAKA'],
            ['institution_name'=>'DELTAS UNIVERSITY COLLEGE, GHANA'],
            ['institution_name'=>'DEVI AHILYA INDORE'],
            ['institution_name'=>'DEVRY UNIVERSITY'],
            ['institution_name'=>'DORBEN POLYTECHNIC, ABUJA'],
            ['institution_name'=>'EBONYI STATE UNIVERSITY'],
            ['institution_name'=>'EDO STATE UNIVERSITY'],
            ['institution_name'=>'EKWENUGO OKEKE POLYTECHNIC, ULI'],
            ['institution_name'=>'ENUGU STATE UNIVERSITY OF SCIENCE &amp; TECHNOLOGY'],
            ['institution_name'=>'EXECUTIVE MANAGEMENT ACCOUNTANCY'],
            ['institution_name'=>'FANSHAWE COLLEGE'],
            ['institution_name'=>'FEDERAL COLL. OF EDU., KANO'],
            ['institution_name'=>'FEDERAL COLLEGE OF AGRIC IBADAN'],
            ['institution_name'=>'FEDERAL COLLEGE OF EDUCATION ABEOKUTA'],
            ['institution_name'=>'FEDERAL COLLEGE OF EDUCATION AKOKA'],
            ['institution_name'=>'FEDERAL COLLEGE OF EDUCATION OBUDU'],
            ['institution_name'=>'FEDERAL COLLEGE OF EDUCATION TECHNICAL, OMOKU'],
            ['institution_name'=>'FEDERAL COLLEGE OF FRESHWATER FISHRIES TECHNOLOGY'],
            ['institution_name'=>'FEDERAL POLYTECHNIC ADO-EKITI'],
            ['institution_name'=>'FEDERAL POLYTECHNIC BAUCHI'],
            ['institution_name'=>'FEDERAL POLYTECHNIC BIDA'],
            ['institution_name'=>'FEDERAL POLYTECHNIC EDE'],
            ['institution_name'=>'FEDERAL POLYTECHNIC IDAH'],
            ['institution_name'=>'FEDERAL POLYTECHNIC ILARO'],
            ['institution_name'=>'FEDERAL POLYTECHNIC KAURA NAMODA ZAMFARA STATE'],
            ['institution_name'=>'FEDERAL POLYTECHNIC MUBI'],
            ['institution_name'=>'FEDERAL POLYTECHNIC NASSARAWA'],
            ['institution_name'=>'FEDERAL POLYTECHNIC NEKEDE'],
            ['institution_name'=>'FEDERAL POLYTECHNIC OFFA'],
            ['institution_name'=>'FEDERAL POLYTECHNIC OKO'],
            ['institution_name'=>'FEDERAL POLYTECHNIC, DAMATURU'],
            ['institution_name'=>'FEDERAL SCHOOL OF STATISTICS'],
            ['institution_name'=>'FEDERAL TREASURY SCHOOL AKOKA'],
            ['institution_name'=>'FEDERAL UNIVERSITY OF AGRIC UMUAHIA'],
            ['institution_name'=>'FEDERAL UNIVERSITY OF TECHNOLOGY OWERRI'],
            ['institution_name'=>'FEDERAL UNIVERSITY OF TECHNOLOGY, AKURE'],
            ['institution_name'=>'FEDERAL UNIVERSITY OF TECHNOLOGY, MINNA'],
            ['institution_name'=>'FEDERAL UNIVERSITY OF TECHNOLOGY, YOLA'],
            ['institution_name'=>'FIDEI POLYTECHNIC GBOKO, BENUE STATE'],
            ['institution_name'=>'FOUNTAIN UNIVERSITY, OSHOGBO'],
            ['institution_name'=>'GOMBE STATE UNIVERSITY'],
            ['institution_name'=>'GOVERNORS STATE UNIVERSITY'],
            ['institution_name'=>'GRACE POLYTECHNIC LAGOS'],
            ['institution_name'=>'GRAMBLING STATE UNIV'],
            ['institution_name'=>'HASSAN USMAN KATSINA POLYTECHNIC, KATSINA'],
            ['institution_name'=>'HERIOT - WATT UNIVERSITY'],
            ['institution_name'=>'HIGHER COLL OF ECON'],
            ['institution_name'=>'HOFSTRA UNIVERSITY'],
            ['institution_name'=>'HONG KONG UNIVERSITY OF SCIENCE AND TECHNOLOGY'],
            ['institution_name'=>'HOUDEGBE NORTH AMERICAN UNIVERSITY BENIN'],
            ['institution_name'=>'IGBINEDION UNIVERSITY, OKADA'],
            ['institution_name'=>'IMO STATE UNIVERSITY'],
            ['institution_name'=>'INST.OF CHARTERED ACCOUNTANTS OF INDIA'],
            ['institution_name'=>'INSTITUTE OF BANKERS'],
            ['institution_name'=>'INSTITUTE OF CHARTERED SECRETARIES &amp; ADMINISTRATOR'],
            ['institution_name'=>'INSTITUTE OF ECUMENICAL EDUCATION, ENUGU'],
            ['institution_name'=>'INSTITUTE OF MANAGEMENT &amp; TECHNOLOGY ENUGU'],
            ['institution_name'=>'INSTITUTE OF NIG. SCIENCE LABORATORY TECHNOLOGY'],
            ['institution_name'=>'INTERNATIONAL ISLAMIC UNIVERSITY, PAKISTAN'],
            ['institution_name'=>'JIGAWA STATE POLYTECHNIC, DUTSE'],
            ['institution_name'=>'JOSEPH AYO BABALOLA UNIVERSITY, IKEJI-ARAKEJI'],
            ['institution_name'=>'KADUNA POLYTECHNIC'],
            ['institution_name'=>'KADUNA STATE COLLEGE OF EDUCATION'],
            ['institution_name'=>'KADUNA STATE UNIVERSITY'],
            ['institution_name'=>'KANO STATE POLYTECHNIC'],
            ['institution_name'=>'KATSINA POLY'],
            ['institution_name'=>'KEBBI STATE POLYTECHNIC, BIRNIN KEBBI'],
            ['institution_name'=>'KENNESSAW STATE UNIVERSITY, USA'],
            ['institution_name'=>'KINGSTON UNIVERSITY'],
            ['institution_name'=>'KOGI STATE POLYTECHNIC, LOKOJA'],
            ['institution_name'=>'KOGI STATE UNIVERSITY'],
            ['institution_name'=>'KWAME NKRUMAH UNIVERSITY OF SC. &amp; Tech.'],
            ['institution_name'=>'KWARA STATE COLLEGE OF EDUCATION'],
            ['institution_name'=>'KWARA STATE POLYTECHNIC'],
            ['institution_name'=>'KWARARAFA UNIVERSITY, WUKARI, TARABA'],
            ['institution_name'=>'LADOKE AKINTOLA UNIVERSITY OF TECHNOLOGY, OGBOMOSO'],
            ['institution_name'=>'LAGOS CITY POLYTECNIC'],
            ['institution_name'=>'LAGOS STATE POLYTECHNIC'],
            ['institution_name'=>'LAGOS STATE UNIVERSITY'],
            ['institution_name'=>'LANGSTON UNIVERSITY'],
            ['institution_name'=>'LEAD CITY UNIVERSITY'],
            ['institution_name'=>'LIVERPOOL POLYTECHNIC'],
            ['institution_name'=>'LONDON METROPOLITAN UNIVERSITY, UK'],
            ['institution_name'=>'LUMPUR METROPOLITAN UNIVERSITY, MALAYSIA'],
            ['institution_name'=>'MADONNA UNIVERSITY OKIJA'],
            ['institution_name'=>'MAGNITOGORSK STATE TECHNICAL UNIVERSITY'],
            ['institution_name'=>'MAHARSHI DAYANAND UNIVERSITY'],
            ['institution_name'=>'MARITIME ACADEMY OF NIGERIA'],
            ['institution_name'=>'MARSHALL UNIVERSITY WEST VIRGINIA'],
            ['institution_name'=>'MICHAEL OKPARA COLLEGE OF AGRICULTURE'],
            ['institution_name'=>'MICHAEL OKPARA UNIVERSITY OF AGRICULTURE, UMUDIKE'],
            ['institution_name'=>'MIDDLESEX UNIVERSITY, LONDON'],
            ['institution_name'=>'MOHAMMED ABDULLAHI WASE POLYTECHNIC, KANO'],
            ['institution_name'=>'MORGAN STATE UNIVERSITY'],
            ['institution_name'=>'MOSCOW STATE UNIVERSITY'],
            ['institution_name'=>'MOSHOOD ABIOLA POLYTECHNIC'],
            ['institution_name'=>'NAGARJUNA UNIVERSITY INDIA'],
            ['institution_name'=>'NAGPUR UNIVERSITY'],
            ['institution_name'=>'NASARAWA STATE UNIVERSITY'],
            ['institution_name'=>'NATIONAL OPEN UNIVERSITY NIGERIA'],
            ['institution_name'=>'NATIONAL TEACHERS INSTITUTE KADUNA'],
            ['institution_name'=>'NEW JERSEY INSTITUTE OF TECHNOLOGY'],
            ['institution_name'=>'NEW YORK UNIVERSITY STERN SCHOOL OF BUSINESS'],
            ['institution_name'=>'NIG. ARMY SCH. OF FIN. &amp; ADMIN.'],
            ['institution_name'=>'NIGER DELTA UNIVERSITY, YENAGOA BAYELSA STATE'],
            ['institution_name'=>'NIGER STATE POLYTECHNIC, ZUNGERU'],
            ['institution_name'=>'NIGERIAN DEFENCE ACADEMY'],
            ['institution_name'=>'NIGERIAN INST. OF SCIENCE LABORATORY TECHNOLOGY'],
            ['institution_name'=>'NNAMDI AZIKIWE UNIVERSITY'],
            ['institution_name'=>'NORTH CAROLINA AGRIC. &amp; TECH. STATE UNIVERSITY'],
            ['institution_name'=>'NOVENA UNIVERSITY, OGUME, DELTA STATE'],
            ['institution_name'=>'NUHU BAMALLI POLYTECHNIC'],
            ['institution_name'=>'OBAFEMI AWOLOWO UNIVERSITY'],
            ['institution_name'=>'OGUN STATE UNIVERSITY'],
            ['institution_name'=>'OLABISI ONABANJO UNIV'],
            ['institution_name'=>'ONDO STATE POLYTECHNIC'],
            ['institution_name'=>'ONDO STATE UNIVERSITY'],
            ['institution_name'=>'OSMANIA UNIVERSITY'],
            ['institution_name'=>'OSUN STATE COLLEGE OF EDU. ILA-ORANGUN'],
            ['institution_name'=>'OSUN STATE COLLEGE OF TECHNOLOGY, ESA-OKE'],
            ['institution_name'=>'OSUN STATE POLYTECHNIC'],
            ['institution_name'=>'OSUN STATE UNIVERSITY'],
            ['institution_name'=>'Others'],
            ['institution_name'=>'OUR SAVIOUR INSTITUTE OF SCIENCE, AGRIC. &amp; TECH'],
            ['institution_name'=>'OXFORD BROOKES UNIV OXFORD'],
            ['institution_name'=>'OYO STATE COLLEGE OF EDUCATION'],
            ['institution_name'=>'PANJAB UNIVERSITY'],
            ['institution_name'=>'PETROLEUM TRAINING INSTITUTE'],
            ['institution_name'=>'PLATEAU STATE POLYTECHNIC, BARKIN-LADI'],
            ['institution_name'=>'PONTIFICAL URBANIANA UNIVERSITY'],
            ['institution_name'=>'RAMAT POLYTECHNIC, MAIDIGURI'],
            ['institution_name'=>'REEDEMERS UNIVERSITY, MOWE'],
            ['institution_name'=>'RIVERS STATE COLL OF EDUCATION'],
            ['institution_name'=>'RIVERS STATE POLYTECHNIC'],
            ['institution_name'=>'RIVERS STATE UNIVERSITY OF SC. &amp; TECH.'],
            ['institution_name'=>'RUFUS GIWA POLYTECHNIC'],
            ['institution_name'=>'SALEM UNIVERSITY, LOKOJA'],
            ['institution_name'=>'SAMARU COLLEGE OF AGRIC. SAMARU, ZARIA'],
            ['institution_name'=>'SHAW UNIVERSITY'],
            ['institution_name'=>'SOUTHEASTERN UNIVERSITY WASHINGTON COLUMBIA'],
            ['institution_name'=>'SOUTHERN ARKANSAS UNIVERSITY USA'],
            ['institution_name'=>'SOUTHERN UNIVERSITY AND MECHANICAL COLLEGE, BATON ROUGE LOUISIANNA USA'],
            ['institution_name'=>'ST. ANDREWS COLLEGE OF EDUCATION OYO'],
            ['institution_name'=>'ST. JOHN UNIVERSITY, NEW YORK USA'],
            ['institution_name'=>'TAFAWA BALEWA UNIVERSITY, BAUCHI'],
            ['institution_name'=>'TAI SOLARIN COLLEGE OF EDUCATION'],
            ['institution_name'=>'TARABA STATE POLYTECHNIC'],
            ['institution_name'=>'TEXAS SOUTH UNIVERSITY'],
            ['institution_name'=>'THAME VALLEY UNIVERSITY, LONDON'],
            ['institution_name'=>'THE ASSOCIATION OF CERT ACCTS'],
            ['institution_name'=>'THE POLYTECHNIC CALABAR'],
            ['institution_name'=>'THE POLYTHECNIC IBADAN'],
            ['institution_name'=>'THE POLYTHECNIC ILE-IFE'],
            ['institution_name'=>'THE UNIV OF BUCKINGHAM'],
            ['institution_name'=>'THE UNIVERSITY OF LIVERPOOL'],
            ['institution_name'=>'UNI OF SOUTH AFRICA'],
            ['institution_name'=>'UNITED STATES INTL UNIVERSITY, NAIROBI KENYA'],
            ['institution_name'=>'UNIVERSAL COLLEGE OF TECHNOLOGY'],
            ['institution_name'=>'UNIVERSITY OF ABUJA'],
            ['institution_name'=>'UNIVERSITY OF ADO-EKITI, ADO-EKITI'],
            ['institution_name'=>'UNIVERSITY OF AGRIC MAKURDI'],
            ['institution_name'=>'UNIVERSITY OF AGRICULTURE ABEOKUTA'],
            ['institution_name'=>'UNIVERSITY OF AJEMER INDIA'],
            ['institution_name'=>'UNIVERSITY OF AKRON'],
            ['institution_name'=>'UNIVERSITY OF BALTIMORE, MARYLAND'],
            ['institution_name'=>'UNIVERSITY OF BENIN'],
            ['institution_name'=>'UNIVERSITY OF BIRMINGHAM'],
            ['institution_name'=>'UNIVERSITY OF BOTSWANA'],
            ['institution_name'=>'UNIVERSITY OF CALABAR'],
            ['institution_name'=>'UNIVERSITY OF CALCUTTA'],
            ['institution_name'=>'UNIVERSITY OF CALICUT'],
            ['institution_name'=>'UNIVERSITY OF CAPE COAST'],
            ['institution_name'=>'UNIVERSITY OF COMERTIRUT'],
            ['institution_name'=>'UNIVERSITY OF ESSEX'],
            ['institution_name'=>'UNIVERSITY OF GHANA'],
            ['institution_name'=>'UNIVERSITY OF HERTFORDSHIRE'],
            ['institution_name'=>'UNIVERSITY OF HOUSTON'],
            ['institution_name'=>'UNIVERSITY OF IBADAN'],
            ['institution_name'=>'UNIVERSITY OF ILORIN'],
            ['institution_name'=>'UNIVERSITY OF JABALPUR INDIA'],
            ['institution_name'=>'UNIVERSITY OF JAIPUR'],
            ['institution_name'=>'UNIVERSITY OF JOS'],
            ['institution_name'=>'UNIVERSITY OF KENT'],
            ['institution_name'=>'UNIVERSITY OF LAGOS'],
            ['institution_name'=>'UNIVERSITY OF LECIESTER'],
            ['institution_name'=>'UNIVERSITY OF LIVERPOOL'],
            ['institution_name'=>'UNIVERSITY OF MADRAS'],
            ['institution_name'=>'UNIVERSITY OF MAIDUGURI'],
            ['institution_name'=>'UNIVERSITY OF MKAR MKAR BENUE STATE'],
            ['institution_name'=>'UNIVERSITY OF NIGERIA'],
            ['institution_name'=>'UNIVERSITY OF NORTH LONDON'],
            ['institution_name'=>'UNIVERSITY OF PORT-HARCOURT'],
            ['institution_name'=>'UNIVERSITY OF PUNJAB'],
            ['institution_name'=>'UNIVERSITY OF SHEFFIELD'],
            ['institution_name'=>'UNIVERSITY OF SOUTHERN CALIFORNIA, USA'],
            ['institution_name'=>'UNIVERSITY OF STERLING, UK'],
            ['institution_name'=>'UNIVERSITY OF THE GAMBIA'],
            ['institution_name'=>'UNIVERSITY OF UYO'],
            ['institution_name'=>'UNIVERSITY OF WALES UK'],
            ['institution_name'=>'UNIVERSITY OF WEST INDIES'],
            ['institution_name'=>'USMAN DAN FODIO UNIVERSITY, SOKOTO'],
            ['institution_name'=>'VERITAS UNIVERSITY, ABUJA'],
            ['institution_name'=>'VIKRAM UNIVERSITY'],
            ['institution_name'=>'WAZIRI UMARU POLYTECHNIC BIRNIN-KEBBI'],
            ['institution_name'=>'WESTERN DELTA UNIVERSITY, OGARA'],
            ['institution_name'=>'WOLEX POLYTECHNIC LAGOS'],
            ['institution_name'=>'YABA COLLEGE OF TECHNOLOGY'],
        ];
        foreach($institutions as $name){
            Institution::create( $name);
        }
    }
}
