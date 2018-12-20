<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of util_helper
 *
 * @Adventure Soft
 */
function getCountryName() {
    $ci = &get_instance();
    $ci->country_array = Array(

        /*        "AF" => "Afghanistan",
                "AL" => "Albania",
                "DZ" => "Algeria",
                "AS" => "American Samoa",
                "AD" => "Andorra",
                "AO" => "Angola",
                "AI" => "Anguilla",
                "AQ" => "Antarctica",
                "AG" => "Antigua and Barbuda",
                "AR" => "Argentina",
                "AM" => "Armenia",
                "AW" => "Aruba",
                "AU" => "Australia",
                "AT" => "Austria",
                "AZ" => "Azerbaijan",
                "BS" => "Bahamas",
                "BH" => "Bahrain",  */
        "BD" => "Bangladesh"
        /*        "BB" => "Barbados",
                "BY" => "Belarus",
                "BE" => "Belgium",
                "BZ" => "Belize",
                "BJ" => "Benin",
                "BM" => "Bermuda",
                "BT" => "Bhutan",
                "BO" => "Bolivia",
                "BA" => "Bosnia and Herzegowina",
                "BW" => "Botswana",
                "BV" => "Bouvet Island",
                "BR" => "Brazil",
                "IO" => "British Indian Ocean Territory",
                "BN" => "Brunei Darussalam",
                "BG" => "Bulgaria",
                "BF" => "Burkina Faso",
                "BI" => "Burundi",
                "KH" => "Cambodia",
                "CM" => "Cameroon",
                "CA" => "Canada",
                "CV" => "Cape Verde",
                "KY" => "Cayman Islands",
                "CF" => "Central African Republic",
                "TD" => "Chad",
                "CL" => "Chile",
                "CN" => "China",
                "CX" => "Christmas Island",
                "CC" => "Cocos (Keeling) Islands",
                "CO" => "Colombia",
                "KM" => "Comoros",
                "CG" => "Congo",
                "CK" => "Cook Islands",
                "CR" => "Costa Rica",
                "CI" => "Cote D'Ivoire",
                "HR" => "Croatia",
                "CU" => "Cuba",
                "CY" => "Cyprus",
                "CZ" => "Czech Republic",
                "DK" => "Denmark",
                "DJ" => "Djibouti",
                "DM" => "Dominica",
                "DO" => "Dominican Republic",
                "TL" => "East Timor",
                "EC" => "Ecuador",
                "EG" => "Egypt",
                "SV" => "El Salvador",
                "GQ" => "Equatorial Guinea",
                "ER" => "Eritrea",
                "EE" => "Estonia",
                "ET" => "Ethiopia",
                "FK" => "Falkland Islands (Malvinas)",
                "FO" => "Faroe Islands",
                "FJ" => "Fiji",
                "FI" => "Finland",
                "FR" => "France",
                "FX" => "France, Metropolitan",
                "GF" => "French Guiana",
                "PF" => "French Polynesia",
                "TF" => "French Southern Territories",
                "GA" => "Gabon",
                "GM" => "Gambia",
                "GE" => "Georgia",
                "DE" => "Germany",
                "GH" => "Ghana",
                "GI" => "Gibraltar",
                "GR" => "Greece",
                "GL" => "Greenland",
                "GD" => "Grenada",
                "GP" => "Guadeloupe",
                "GU" => "Guam",
                "GT" => "Guatemala",
                "GN" => "Guinea",
                "GW" => "Guinea-bissau",
                "GY" => "Guyana",
                "HT" => "Haiti",
                "HM" => "Heard and Mc Donald Islands",
                "HN" => "Honduras",
                "HK" => "Hong Kong",
                "HU" => "Hungary",
                "IS" => "Iceland",
                "IN" => "India",
                "ID" => "Indonesia",
                "IR" => "Iran (Islamic Republic of)",
                "IQ" => "Iraq",
                "IE" => "Ireland",
                "IL" => "Israel",
                "IT" => "Italy",
                "JM" => "Jamaica",
                "JP" => "Japan",
                "JO" => "Jordan",
                "KZ" => "Kazakhstan",
                "KE" => "Kenya",
                "KI" => "Kiribati",
                "KP" => "Korea, Democratic People's Republic of",
                "KR" => "Korea, Republic of",
                "KW" => "Kuwait",
                "KG" => "Kyrgyzstan",
                "LA" => "Lao People's Democratic Republic",
                "LV" => "Latvia",
                "LB" => "Lebanon",
                "LS" => "Lesotho",
                "LR" => "Liberia",
                "LY" => "Libyan Arab Jamahiriya",
                "LI" => "Liechtenstein",
                "LT" => "Lithuania",
                "LU" => "Luxembourg",
                "MO" => "Macau",
                "MK" => "Macedonia, The Former Yugoslav Republic of",
                "MG" => "Madagascar",
                "MW" => "Malawi",
                "MY" => "Malaysia",
                "MV" => "Maldives",
                "ML" => "Mali",
                "MT" => "Malta",
                "MH" => "Marshall Islands",
                "MQ" => "Martinique",
                "MR" => "Mauritania",
                "MU" => "Mauritius",
                "YT" => "Mayotte",
                "MX" => "Mexico",
                "FM" => "Micronesia, Federated States of",
                "MD" => "Moldova, Republic of",
                "MC" => "Monaco",
                "MN" => "Mongolia",
                "MS" => "Montserrat",
                "MA" => "Morocco",
                "MZ" => "Mozambique",
                "MM" => "Myanmar",
                "NA" => "Namibia",
                "NR" => "Nauru",
                "NP" => "Nepal",
                "NL" => "Netherlands",
                "AN" => "Netherlands Antilles",
                "NC" => "New Caledonia",
                "NZ" => "New Zealand",
                "NI" => "Nicaragua",
                "NE" => "Niger",
                "NG" => "Nigeria",
                "NU" => "Niue",
                "NF" => "Norfolk Island",
                "MP" => "Northern Mariana Islands",
                "NO" => "Norway",
                "OM" => "Oman",
                "PK" => "Pakistan",
                "PW" => "Palau",
                "PA" => "Panama",
                "PG" => "Papua New Guinea",
                "PY" => "Paraguay",
                "PE" => "Peru",
                "PH" => "Philippines",
                "PN" => "Pitcairn",
                "PL" => "Poland",
                "PT" => "Portugal",
                "PR" => "Puerto Rico",
                "QA" => "Qatar",
                "RE" => "Reunion",
                "RO" => "Romania",
                "RU" => "Russian Federation",
                "RW" => "Rwanda",
                "KN" => "Saint Kitts and Nevis",
                "LC" => "Saint Lucia",
                "VC" => "Saint Vincent and the Grenadines",
                "WS" => "Samoa",
                "SM" => "San Marino",
                "ST" => "Sao Tome and Principe",
                "SA" => "Saudi Arabia",
                "SN" => "Senegal",
                "SC" => "Seychelles",
                "SL" => "Sierra Leone",
                "SG" => "Singapore",
                "SK" => "Slovakia (Slovak Republic)",
                "SI" => "Slovenia",
                "SB" => "Solomon Islands",
                "SO" => "Somalia",
                "ZA" => "South Africa",
                "GS" => "South Georgia and the South Sandwich Islands",
                "ES" => "Spain",
                "LK" => "Sri Lanka",
                "SH" => "St. Helena",
                "PM" => "St. Pierre and Miquelon",
                "SD" => "Sudan",
                "SR" => "Suriname",
                "SJ" => "Svalbard and Jan Mayen Islands",
                "SZ" => "Swaziland",
                "SE" => "Sweden",
                "CH" => "Switzerland",
                "SY" => "Syrian Arab Republic",
                "TW" => "Taiwan",
                "TJ" => "Tajikistan",
                "TZ" => "Tanzania, United Republic of",
                "TH" => "Thailand",
                "TG" => "Togo",
                "TK" => "Tokelau",
                "TO" => "Tonga",
                "TT" => "Trinidad and Tobago",
                "TN" => "Tunisia",
                "TR" => "Turkey",
                "TM" => "Turkmenistan",
                "TC" => "Turks and Caicos Islands",
                "TV" => "Tuvalu",
                "UG" => "Uganda",
                "UA" => "Ukraine",
                "AE" => "United Arab Emirates",
                "GB" => "United Kingdom",
                "US" => "United States",
                "UM" => "United States Minor Outlying Islands",
                "UY" => "Uruguay",
                "UZ" => "Uzbekistan",
                "VU" => "Vanuatu",
                "VA" => "Vatican City State (Holy See)",
                "VE" => "Venezuela",
                "VN" => "Viet Nam",
                "VG" => "Virgin Islands (British)",
                "VI" => "Virgin Islands (U.S.)",
                "WF" => "Wallis and Futuna Islands",
                "EH" => "Western Sahara",
                "YE" => "Yemen",
                "RS" => "Serbia",
                "CD" => "The Democratic Republic of Congo",
                "ZM" => "Zambia",
                "ZW" => "Zimbabwe",
                "JE" => "Jersey",
                "BL" => "St. Barthelemy",
                "XU" => "St. Eustatius",
                "XC" => "Canary Islands",
                "ME" => "Montenegro" */
    );

    return $ci->country_array;
}

function getDistrictName() {
    $ci = &get_instance();
    $ci->dist_array = Array(
        '',
        'Bagerhat',
        'Bandarban ',
        'Barguna',
        'Barisal',
        'Bhola',
        'Bogra',
        'Brahmanbaria',
        'Chandpur',
        'Chapainababganj',
        'Chittagong',
        'Chuadanga',
        'Comilla',
        'Cox\'s Bazar',
        'Dhaka',
        'Dinajpur',
        'Faridpur',
        'Feni',
        'Gaibandha',
        'Gazipur',
        'Gopalganj',
        'Habiganj',
        'Jaipurhat',
        'Jamalpur',
        'Jessore',
        'Jhalakati',
        'Jhenaidah',
        'Khagrachari',
        'Khulna',
        'Kishoreganj',
        'Kurigram',
        'Kushtia',
        'Lakshmipur',
        'Lalmonirhat',
        'Madaripur',
        'Magura',
        'Manikganj',
        'Meherpur',
        'Moulvibazar',
        'Munshiganj',
        'Mymensingh',
        'Naogaon',
        'Narail',
        'Narayanganj',
        'Narsingdi',
        'Natore',
        'Netrakona',
        'Nilphamari',
        'Noakhali',
        'Pabna',
        'Panchagarh',
        'Patuakhali',
        'Pirojpur',
        'Rajbari',
        'Rajshahi',
        'Rangamati',
        'Rangpur',
        'Satkhira',
        'Shariatpur',
        'Sherpur',
        'Sirajganj',
        'Sunamganj',
        'Sylhet',
        'Tangail',
        'Thakurgaon'
    );

    return $ci->dist_array;
}

/*
 * @ return Array
 */

function getinstituteType() {
    $ci = &get_instance();
    $ci->instituteType_array = Array(
        '1'=>'General',
        '2'=>'Madrasah',
        '3'=>'Polytechnic'
    );

    return $ci->instituteType_array;
}
function getParentStatus(){
    $ci = &get_instance();
    $ci->parentsstatus_array = array(
        '1'=> 'Alive',
        '2'=> 'Late'
    );

    return $ci->parentsstatus_array;
}

function getProfession() {

    $ci = &get_instance();
    $ci->profession_array = Array(
        '',
        'Business',
        'Doctor',
        'Economist',
        'Engineer',
        'Farmer',
        'Govt. Service',
        'House Wife',
        'Lawyer',
        'Nurse',
        'Pharmacists',
        'Public Service',
        'Scientists',
        'Social worker',
        'Teacher',
        'Self Employee'
    );

    return $ci->profession_array;
}

function getProfessionMother() {

    $ci = &get_instance();
    $ci->profession_array = Array(
        '',
        'Business',
        'Doctor',
        'Economist',
        'Engineer',
        'Govt. Service',
        'House Wife',
        'Lawyer',
        'Nurse',
        'Pharmacists',
        'Public Service',
        'Scientists',
        'Social worker',
        'Teacher',
        'Self Employee'
    );

    return $ci->profession_array;
}

function getProfessionFather() {

    $ci = &get_instance();
    $ci->profession_array = Array(
        '',
        'Business',
        'Doctor',
        'Economist',
        'Engineer',
        'Farmer',
        'Govt. Service',
        'Journalist',
        'Lawyer',
        'Pharmacists',
        'Public Service',
        'Scientists',
        'Social worker',
        'Teacher',
        'Self Employee'
    );

    return $ci->profession_array;
}

function getDay() {

    $ci = &get_instance();
    $ci->day_array = Array(
        'Saturday'=>'Saturday',
        'Sunday'=>'Sunday',
        'Monday'=>'Monday',
        'Tuesday'=>'Tuesday',
        'Wednessday'=>'Wednessday',
        'Thursday'=>'Thursday',
        'Friday'=>'Friday'
    );

    return $ci->day_array;
}

function getGendar() {

    $ci = &get_instance();
    $ci->gndr_array = Array(
        '1'=>'Boy',
        '2'=>'Girl'
    );

    return $ci->gndr_array;
}

function defineGendar($id) {
    $ci = &get_instance();
    if ($id == 1) {
        echo "Boy";
    } elseif ($id == 2) {
        echo "Girl";
    }
}

function getSex() {

    $ci = &get_instance();
    $ci->gndr_array = Array(
        '1'=>'Male',
        '2'=>'Female'
    );

    return $ci->gndr_array;
}

function defineSex($id) {
    $ci = &get_instance();
    if ($id == 1) {
        echo "Male";
    } elseif ($id == 2) {
        echo "Female";
    }
}


function getProgramLevel_institute() {
    $ci = &get_instance();
    $ci->Level_array_institute = Array(
        '1'=>'Pre-Primary',
        '2'=>'Primary',
        '3'=>'Junior Secondary',
        '4'=>'Secondary',
        '5'=>'Higher Secondary',
        '6'=>'Honours',
        '8'=>'Digree',
        '7'=>'Masters'


    );
    return $ci->Level_array_institute;
}


function getProgramLevel() {
    $ci = &get_instance();
    $ci->Level_array = Array(
        '1'=>'Pre-Primary',
        '2'=>'Primary',
        '3'=>'Junior Secondary',
        '4'=>'Secondary',
        '5'=>'Higher Secondary',
        '6'=>'Honours',
        '8'=>'Digree',
        '7'=>'Masters'
    );

    return $ci->Level_array;
}

function getPeriodInfoArray() {
    $ci = &get_instance();
    $ci->day_array = Array(
        '0'=>'Break',
        '1'=>'1st Period',
        '2'=>'2nd Period',
        '3'=>'3rd Period',
        '4'=>'4th Period',
        '5'=>'5th Period',
        '6'=>'6th Period',
        '7'=>'7th Period',
        '8'=>'8th Period',
        '9'=>'Extra'

    );

    return $ci->day_array;
}
function getPeriodTime($shiftId,$periodId) {
    $ci = &get_instance();
    $ci->load->model('admin/period/PeriodModleAdmin', 'PeriodModleAdmin');
    return $ci->PeriodModleAdmin->getPeriodTime($shiftId,$periodId);
}
function getlistPeriod() {
    $ci = &get_instance();
    $ci->load->model('admin/period/PeriodModleAdmin', 'PeriodModleAdmin');
    return $ci->PeriodModleAdmin->getlistPeriod();
}

function getclasslevelfrominstitute() {
    $ci = &get_instance();
    $ci->load->model('admin/Institute/InstituteModleAdmin', 'InstituteModleAdmin');
    return $ci->InstituteModleAdmin->getInstituteInfo();
}

/*
 *
 *
 */
/*
function getSalaryInfo() {

    $ci = &get_instance();
    $ci->salary_array = Array(
        '5000 - 10000',
        '10000 - 15000',
        '15000 - 20000',
        '20000 - 25000',
        '25000 - 30000',
        '30000 - 40000',
        '40000 - more'
    );
    return $ci->salary_array;
}
*/
function getReligion() {

    $ci = &get_instance();
    $ci->getReligion = Array(
        '0'=>'',
        '1'=>'Islam',
        '2'=>'Hindu',
        '3'=>'Buddist',
        '4'=>'Christian',
        '5'=>'Others'
    );
    return $ci->getReligion;
}

function defineReligion($id) {
    $ci = &get_instance();
    if ($id == 1) {
        echo "Islam";
    } elseif ($id == 2) {
        echo "Hindu";
    }
    elseif ($id == 3) {
        echo "Buddist";
    }
    elseif ($id == 4) {
        echo "Christian";
    }
    elseif ($id == 5) {
        echo "Others";
    }
}

function getBloodGroup() {

    $ci = &get_instance();
    $ci->getBloodGroup = Array(
        '0'=>'',
        '1'=>'A+',
        '2'=>'A-',
        '3'=>'B+',
        '4'=>'B-',
        '5'=>'O+',
        '6'=>'O-',
        '7'=>'AB+',
        '8'=>'AB-'
    );
    return $ci->getBloodGroup;
}

function getfinancecat() {

    $ci = &get_instance();
    $ci->getfinancecat = Array(
        '1' => 'Income',
        '2' => 'Expenses',
        '3' => 'Liabilities'
    );
    return $ci->getfinancecat;
}

function getMeritialStatus() {

    $ci = &get_instance();
    $ci->getMeritialStatus = Array(
        '0'=>'',
        '1'=>'Unmarried',
        '2'=>'Married',
        '3'=>'Single',
        '4'=>'Widow',
        '5'=>'Divorced'
    );
    return $ci->getMeritialStatus;
}

function getAdmissionMark() {

    $ci = &get_instance();
    $ci->getAdmissionMark = Array(
        '1' => '100-200',
        '2' => '90-99',
        '3' => '80-89',
        '4' => '70-79',
        '5' => '60-69',
        '6' => '50-59',
        '7' => '40-49',
        '8' => '1-30'

    );
    return $ci->getAdmissionMark;
}

function getattendanceStatus() {

    $ci = &get_instance();
    $ci->getAdmissionMark = Array(
        '1' => 'Present',
        '2' => 'Absent'

    );
    return $ci->getAdmissionMark;
}

function getAbsentReason() {
    $ci = &get_instance();
    $ci->getAbsentReason = Array(
        '1' => 'Authorized Leave',
        '2' => 'Un-authorized Leave',
        '3' => 'Casual Leave',
        '4' => 'Sickness',
        '5' => 'Study Leave',
        '6' => 'Transfer',
        '7' => 'Maternity Leave',
        '8' => 'Suspend',
        '9' => 'Official Duty'
    );
    return $ci->getAbsentReason;
}

function getcauseOfleaving() {

    $ci = &get_instance();
    $ci->getBoard = Array(
        '0' => 'Willing of the guardian.',
        '1' => 'End of the education to The Institute.',
        '2' => 'Change of residence.'

    );
    return $ci->getBoard;
}

function getBoardInfo() {

    $ci = &get_instance();
    $ci->getBoard = Array(
        '0' => '',
        '1' => 'Borishal Board',
        '2' => 'Chittagong Board',
        '3' => 'Comilla Board',
        '4' => 'Dhaka Board',
        '5' => 'Dinajpur Board',
        '6' => 'Jessore Board',
        '7' => 'Rajshahi Board',
        '8' => 'Sylhet Board',
        '9' => 'Madrasah Board',
        '10' => 'Polytechnic Board'
    );
    return $ci->getBoard;
}

function getprevcatInfo() {

    $ci = &get_instance();
    $ci->getprevinfo = Array(

        '1' => 'P.S.C',
        '2' => 'J.S.C',
        '3' => 'S.S.C'
    );
    return $ci->getprevinfo;
}

// Institute Information

function getInstituteInfo() {
    $ci = &get_instance();
    $ci->load->model('admin/institute/InstituteModleAdmin', 'InstituteModleAdmin');
    return $ci->InstituteModleAdmin->getInstituteInfo();
}
function getInstituteName() {
    $ci = &get_instance();
    $ci->load->model('admin/institute/InstituteModleAdmin', 'InstituteModleAdmin');
    return $ci->InstituteModleAdmin->getInstituteName();
}
function getInstituteLogo() {
    $ci = &get_instance();
    $ci->load->model('admin/institute/InstituteModleAdmin', 'InstituteModleAdmin');
    return $ci->InstituteModleAdmin->getInstituteLogo();
}


// Class Information
// get all program......
function ProgramInfoArray(){
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getProgramInfoArray();

}
// get program name......
function getProgramName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getProgramName($id);
}
// get offered program info......
function getOfferedProgram(){
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getOfferedProgram();

}

function getAssignCourseListByPrg_stuid($prgid,$stuid)
{
    $ci = &get_instance();
    $ci->load->model('admin/assigncourse/assigncoursemodleadmin', 'AssignCourseModleAdmin');
    return $ci->AssignCourseModleAdmin->getAssignCourseListByPrg_stuid($prgid,$stuid);
}

function getofferProgramInfoById($programid) {
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getofferProgramInfoById($programid);
}

// get All program offer info array(4m programoffer-table) by applicationId from admissionapplicant table
function getPrOfferArraybyApplicantionId($getid) {
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getPrOfferArraybyApplicantionId($getid);
}


// End Class Information

// Medium Information
// get all Medium......
function getMediumList() {
    $ci = &get_instance();
    $ci->load->model('admin/medium/MediumModleAdmin', 'MediumModleAdmin');
    return $ci->MediumModleAdmin->getMediumInfoArray();
}
// get Medium name......
function getmediumName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/medium/MediumModleAdmin', 'MediumModleAdmin');
    return $ci->MediumModleAdmin->mediumName($id);
}
// get offered Medium info......
function getOfferedMedium(){
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getOfferedMedium();

}

function getOfferedProgramLevel(){
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getOfferedprogramLevel();

}

// End Medium Information

// Group Information
// get all Group......
function getGroupInfoArray() {
    $ci = &get_instance();
    $ci->load->model('admin/group/GroupModleAdmin', 'GroupModleAdmin');
    return $ci->GroupModleAdmin->getGroupInfoArray();
}
// get Group name......
function getGroupName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/group/GroupModleAdmin', 'GroupModleAdmin');
    return $ci->GroupModleAdmin->getGroupName($id);
}
// get offered Group info......
function getOfferedGroup(){
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getOfferedGroup();

}

// End Group Information

// Shift Information
// get all Shift......

function getupoList($id) {

    $ci = &get_instance();
    $ci->load->model('admin/shift/ShiftModleAdmin', 'ShiftModleAdmin');
    return $ci->ShiftModleAdmin->getupozilaArray($id);
}

function getShiftList() {

    $ci = &get_instance();
    $ci->load->model('admin/shift/ShiftModleAdmin', 'ShiftModleAdmin');
    return $ci->ShiftModleAdmin->getShiftInfoArray();
}
// get Shift name......
function getshiftName($Id) {
    $ci = &get_instance();
    $ci->load->model('admin/shift/ShiftModleAdmin', 'ShiftModleAdmin');
    return $ci->ShiftModleAdmin->getShiftName($Id);
}
// get offered Shift info......
function getOfferedShift(){
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getOfferedShift();

}

// End Shift Information


// Section Information
// get all Section......

function getSectionList() {

    $ci = &get_instance();
    $ci->load->model('admin/section/SectionModleAdmin', 'SectionModleAdmin');
    return $ci->SectionModleAdmin->getSectionInfoArray();
}

// get offered Section info......
function getOfferedSection(){
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getOfferedSection();

}
// End Section Information

// Session Information
// get all Session......
function getSessionList() {

    $ci = &get_instance();
    $ci->load->model('admin/sessionsetup/SessionModleAdmin', 'SessionModleAdmin');
    return $ci->SessionModleAdmin->getSessionInfoArray();
}
// get Session name......
function getSessionName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/sessionsetup/SessionModleAdmin', 'SessionModleAdmin');
    return $ci->SessionModleAdmin->getsession($id);
}

// get offered Session info......
function getOfferedSession(){
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getOfferedSession();

}

// End Session Information

// Start Teacher Information

function GetStudentAssignCourse($prgid,$stuid)
{
    $ci = &get_instance();
    $ci->load->model('admin/assigncourse/assigncoursemodleadmin', 'AssignCourseModleAdmin');
    return $ci->AssignCourseModleAdmin->GetStudentAssignCourse($prgid,$stuid);
}

function getTeacherInfoArray() {
    $ci = &get_instance();
    $ci->load->model('admin/teacher/TeacherModleAdmin', 'TeacherModleAdmin');
    return $ci->TeacherModleAdmin->getTeacherInfoArray();
}
function getTeacher($id) {
    $ci = &get_instance();
    $ci->load->model('admin/teacher/TeacherModleAdmin', 'TeacherModleAdmin');
    return $ci->TeacherModleAdmin->getTeacher($id);
}

function getEmployeeName_Image($id) {
    $ci = &get_instance();
    $ci->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
    return $ci->EmployeeModleAdmin->getEmployeeName_Image($id);
}


function getAssignTeacher($courseid) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getAssignTeacher($courseid);
}

// get offered Session info......
function getOfferedClassTeacher(){
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getOfferedClassTeacher();

}


// End Teacher Information

// Get Section & ProgramOffer Info array without sectionId by used in Registration Confirm Select Section
function getProgramOfferIdBySessionStudent($data) {
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getProgramOfferIdBySessionStudent($data);
}


// get Subject Information helper

// get subject category

function getSubjectcategory() {
    $ci = &get_instance();
    $ci->getSubjectcategory = Array(
        '1'=>'Common',
        '2'=>'Optional',
        '3'=>'Group Main',
        '4'=>'Extra'
    );

    return $ci->getSubjectcategory;
}

// get subject list
function getCourseList() {

    $ci = &get_instance();
    $ci->load->model('admin/course/CourseModleAdmin', 'CourseModleAdmin');
    return $ci->CourseModleAdmin->getCourseInfoArray();
}

function getCourseListBYPrglevelId($prglvlId) {

    $ci = &get_instance();
    $ci->load->model('admin/course/CourseModleAdmin', 'CourseModleAdmin');
    return $ci->CourseModleAdmin->getCourseListBYPrglevelId($prglvlId);
}

function getSubjectValue($classid) {

    $ci = &get_instance();
    $ci->load->model('admin/course/CourseModleAdmin', 'CourseModleAdmin');
    return $ci->CourseModleAdmin->getSubjectValue($classid);
}

// End Subject Information helper

function getSemesterInfoArray() {

    $ci = &get_instance();
    $ci->load->model('admin/semester/SemesterModleAdmin', 'SemesterModleAdmin');
    return $ci->SemesterModleAdmin->getSemesterInfoArray();
}
function getSemesterName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/semester/SemesterModleAdmin', 'SemesterModleAdmin');
    return $ci->SemesterModleAdmin->getSemesterName($id);
}
function getExamList() {
    ini_set('max_execution_time', '-1');
    $ci = &get_instance();
    $ci->load->model('admin/examtype/ExamTypeModleAdmin', 'ExamTypeModleAdmin');
    return $ci->ExamTypeModleAdmin->getExamList();
}

function getsub_objecList() {
    ini_set('max_execution_time', '-1');
    $ci = &get_instance();
    $ci->load->model('admin/examtype/ExamTypeModleAdmin', 'ExamTypeModleAdmin');
    return $ci->ExamTypeModleAdmin->getOBList();
}

function getMarkCategory_ByCourse($courseId,$programOfferId) {
    ini_set('max_execution_time', '-1');
    $ci = &get_instance();
    $ci->load->model('admin/result_view/Result_viewModleAdmin', 'Result_viewModleAdmin');
    return $ci->Result_viewModleAdmin->getMarkCategory_ByCourse($courseId,$programOfferId);
}

function getExamTypeName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/examtype/ExamTypeModleAdmin', 'ExamTypeModleAdmin');
    return $ci->ExamTypeModleAdmin->getExamTypeName($id);
}


// Start Program Offer Information----------ID,Details
//
// Get ProgramOfferId with match all programoffer table data
function getProgramOfferId($getid) {

    //print_r($getid);exit;
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getProgramOfferId($getid);
}

function get_Program_offer_Id($getid) {

    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->get_program_offer_Id($getid);
}

function getProgramOfferIdforcourse($getid) {
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getProgramOfferIdforcourse($getid);
}


// End Program Offer Information helper

/*
 * lkajsdlfjsdalkf
 */


function getCourseName($courseId) {
    $ci = &get_instance();
    $ci->load->model('admin/course/CourseModleAdmin', 'CourseModleAdmin');
    return $ci->CourseModleAdmin->getCourseName($courseId);
}
function getCourseCode($courseId) {
    $ci = &get_instance();
    $ci->load->model('admin/course/CourseModleAdmin', 'CourseModleAdmin');
    return $ci->CourseModleAdmin->getCourseCode($courseId);
}
function getCourseMarks($data) {
    ini_set('memory_limit', '-1');
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getCourseMarks($data);
}

function getCourseMarksAnother($data) {
    ini_set('memory_limit', '-1');
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getCourseMarksAnother($data);
}

// Get Course List by employeeId & ProgramOfferId As Array
function getCourseIdByTeacher($data) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getCourseIdByTeacher($data);
}

function GetSubjectInformation($subjectId,$programOfferId) {
    ini_set('memory_limit', '-1');
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->GetSubjectInformation($subjectId,$programOfferId);
}

// Get Course List by studentId & ProgramOfferId As Array
function getCourseIdByStudent($data) {
    $ci = &get_instance();
    $ci->load->model('admin/courseassign/CourseAssignModleAdmin', 'CourseAssignModleAdmin');
    return $ci->CourseAssignModleAdmin->getCourseIdByStudent($data);
}
function getOfferedCourseInfoByCourse($courseId) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getOfferedCourseInfoByCourse($courseId);
}
function getCommonCourseName($courseId) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getCommonCourseName($courseId);
}
function getEmployeeIdBySubject($id) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getEmployeeIdBySubject($id);
}
// Get EmployeeId by programOfferId & courseId by group by -- used in "studentmarks controller"

function getEmployeeIdByProgramAndSubject($programOfferId,$courseid) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getEmployeeIdByProgramAndSubject($programOfferId,$courseid);
}

function getEmployeeInfoById($id) {
    $ci = &get_instance();
    $ci->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
    return $ci->EmployeeModleAdmin->viewemployeeinfo($id);
}

function getDesignationArray() {
    $ci = &get_instance();
    $ci->load->model('admin/designation/DesignationModleAdmin', 'DesignationModleAdmin');
    return $ci->DesignationModleAdmin->getlistDesignation();
}
function getdesignation() {

    $ci = &get_instance();
    $ci->getdesignation = Array(
        '40'=>'Chairman',
        '41'=>'President',
        '42'=>'Vice President',
        '43'=>'General Secretary',
        '44'=>'Donar Member',
        '45'=>'Teacher Representative',
        '46'=>'Guardian Representative',
        '47'=>'Education Member',
        '48'=>'Member',
        '1'=>'Principal',
        '2'=>'Vice Principal',
        '3'=>'Acting Principal',
        '4'=>'Head Master',
        '5'=>'Assistant Head Master',
        '6'=>'Acting Head Master',
        '7'=>'Senior Teacher',
        '8'=>'Teacher',
        '9'=>'Assistant Teacher',
        '10'=>'IT Teacher',
        '11'=>'Religion Teacher',
        '12'=>'Professor',
        '13'=>'Associate Professor',
        '14'=>'Assistant Professor',
        '15'=>'Lecturer',
        '16'=>'Lab Assistant',
        '17'=>'Office Assistant',
        '18'=>'Accountant',
        '49'=>'Account Officer',
        '50'=>'Junior Teacher',
        '51'=>'Pert-Time Teacher',
        '52'=>'Visitor',
        '53'=>'Demonstrator',
        '54'=>'Librarian',
        '55'=>'Cleaner',

        '25'=>'Pion',
        '26'=>'Guard'

    );
    return $ci->getdesignation;
}


function CountEmployeeByPosition($id) {
    $ci = &get_instance();
    $ci->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
    return $ci->EmployeeModleAdmin->CountEmployeeByPosition($id);
}
function gettodayattendance($today, $value)
{
    $ci = &get_instance();
    $ci->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
    return $ci->EmployeeModleAdmin->gettodayattendance($today, $value);
}

function getstudentattendancestatus()
{
    $ci = &get_instance();
    $ci->load->model('admin/studentattendance/Studentattendancemodleadmin', 'Studentattendancemodleadmin');
    return $ci->Studentattendancemodleadmin->getstudentattendancestatus();
}


//--------------------------------------------------

// list of helper offered coure/subject information

// get offered course information as array
function getOfferedCourseInfoArray() {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getCourseofferInfo();
}

function getOfferedCourseList($programId) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getOfferedCourseList($programId);
}

function getProgramLevelbyOffer($data) {
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->getOfferedCourseList($data);
}

function getValidateOfferedCourses($data) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getValidateOfferedCourses($data);
}
function getTeacherCourseList($employeeId) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getTeacherCourseList($employeeId);
}
function getOptionalCourseName($courseId) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getOptionalCourseName($courseId);
}

// list of helper offered coure/subject information


function getPaymentheadList() {

    $ci = &get_instance();
    $ci->getPaymentheadList = Array(
        'Exam-fees',
        'Admission-fees',
    );
    return $ci->getPaymentheadList;
}
function getHeadList() {
    $ci = &get_instance();
    $ci->load->model('admin/paymentshead/PaymentsHeadModleAdmin', 'PaymentsHeadModleAdmin');
    return $ci->PaymentsHeadModleAdmin->getPaymentHeadName();
}
function getPaymentHeadName($headId) {
    $ci = &get_instance();
    $ci->load->model('admin/paymentshead/PaymentsHeadModleAdmin', 'PaymentsHeadModleAdmin');
    return $ci->PaymentsHeadModleAdmin->getPaymentsHeadName($headId);
}

function getPaymentheadListarray($id) {
    $ci = &get_instance();
    $ci->load->model('admin/paymentshead/PaymentsHeadModleAdmin', 'PaymentsHeadModleAdmin');
    return $ci->PaymentsHeadModleAdmin->getPaymentheadListarray($id);
}

function getStudentpaymentList($studentId,$headId,$sessionId, $status = 0) {
    $ci = &get_instance();
    $ci->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
    return $ci->PaymentsModleAdmin->getStudentpaymentList($studentId,$headId,$sessionId, $status);
}

function getStudentpaymentListt($studentId,$te) {
    $ci = &get_instance();
    $ci->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
    return $ci->PaymentsModleAdmin->getStudentpaymentListt($studentId,$te);
}

function getStudentDiscountList($studentId,$headId, $programOfferId) {
    $ci = &get_instance();
    $ci->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
    return $ci->PaymentsModleAdmin->getStudentDiscountList($studentId,$headId, $programOfferId);
}
function totalpaidamountbydate($date) {
    $ci = &get_instance();
    $ci->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
    return $ci->PaymentsModleAdmin->totalpaidamountbydate($date);
}
function getfeesAmount($headId) {
    $ci = &get_instance();
    $ci->load->model('admin/fees/FeesModleAdmin', 'FeesModleAdmin');
    return $ci->FeesModleAdmin->getfeesAmount($headId);
}
function getFineHeadList() {
    $ci = &get_instance();
    $ci->load->model('admin/paymentshead/PaymentsHeadModleAdmin', 'PaymentsHeadModleAdmin');
    return $ci->PaymentsHeadModleAdmin->getFineHeadList();
}
function getStudentfineList($studentId,$finehead,$date) {
    $ci = &get_instance();
    $ci->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
    return $ci->PaymentsModleAdmin->getStudentfineList($studentId,$finehead,$date);
}
function getMonthList() {

    $ci = &get_instance();
    $ci->getMonthList = Array(
        '01'=>'January',
        '02'=>'February',
        '03'=>'March',
        '04'=>'April',
        '05'=>'May',
        '06'=>'June',
        '07'=>'July',
        '08'=>'August',
        '09'=>'Septenber',
        '10'=>'October',
        '11'=>'November',
        '12'=>'December',
    );
    return $ci->getMonthList;
}

function getSubjectList() {

    $ci = &get_instance();
    $ci->getSubjectList = Array(
        'Bangla-1' => 'Bangla-1',
        'Bangla-2' => 'Bangla-2',
        'English-1' => 'English-1',
        'English-2' => 'English-2',
        'English Science' => 'English Science',
        'Social Science' => 'Social Science',
        'Mathematics' => 'Mathematics',
        'IT' => 'IT',
        'Religion' => 'Religion'
    );
    return $ci->getSubjectList;
}
function getOptionalSubjectList() {

    $ci = &get_instance();
    $ci->getOptionalSubjectList = Array(
        'Art' => 'Art',
        'General Knowledge' => 'General Knowledge',
        'Family Studies' => 'Family Studies',
        'Higher Math' => 'Higher Math',
        'Spoken English' => 'Spoken English',

    );
    return $ci->getOptionalSubjectList;
}


function getExamtypeList() {

    $ci = &get_instance();
    $ci->geteExamtypeList = Array(
        'BA',
        'BCom',
        'BSc',
    );
    return $ci->geteExamtypeList;
}

function getExammastersList() {

    $ci = &get_instance();
    $ci->getExammastersList = Array(
        'MA',
        'MCom',
        'MSc',
    );
    return $ci->getExammastersList;
}

function getGradeList() {

    $ci = &get_instance();
    $ci->getGradeList = Array(
        'A+',
        'A-',
        'B+',
        'B-',
        'C+',
        'C-',
        'D+',
        'D-',
        'F'
    );
    return $ci->getGradeList;
}

function getBoardList() {

    $ci = &get_instance();
    $ci->getBoardList = Array(
        'DHAKA',
        'KHULNA',
        'COMILLA',
        'BARISAL',
        'RANGPUR',
        'SYLET',
    );
    return $ci->getBoardList;
}

function getyearList() {

    $ci = &get_instance();
    $ci->getyearList = Array(
        '2000' => '2000',
        '2001' => '2001',
        '2002' => '2002',
        '2003' => '2003',
        '2004' => '2004',
        '2005' => '2005',
        '2006' => '2006',
        '2007' => '2007',
        '2008' => '2008',
        '2009' => '2009',
        '2010' => '2010',
        '2011' => '2011',
        '2012' => '2012',
        '2013' => '2013',
        '2014' => '2014',
        '2015' => '2015',
        '2016' => '2016',
        '2017' => '2017',
        '2018' => '2018',
        '2019' => '2019',
        '2020' => '2020',
    );
    return $ci->getyearList;
}

function getSSCgroupList() {

    $ci = &get_instance();
    $ci->getSSCgroupList = Array(
        'Science',
        'Humanitis',
        'Business Studies'
    );
    return $ci->getSSCgroupList;
}

function getgovernmentList() {

    $ci = &get_instance();
    $ci->getemployeetypeList = Array(
        '1' => 'Faculty Member',
        '2' => 'Admin',


    );
    return $ci->getemployeetypeList;
}



function getmployeetypeList() {

    $ci = &get_instance();
    $ci->getemployeetypeList = Array(
        '1' => 'Faculty Member',
        '5' => 'Admin',
        '2' => 'Third Grade Staff',
        '3' => 'Fourth Grade Staff',

    );
    return $ci->getemployeetypeList;
}

function getemployeestatusList() {

    $ci = &get_instance();
    $ci->getemployeestatusList = Array(
        '1' => 'Parmanent',
        '2' => 'Part-time',
        '3' => 'Tempory'
    );
    return $ci->getemployeestatusList;
}

function getgoverningdesignation() {

    $ci = &get_instance();
    $ci->getdesignation = Array(

        '1'=>'Principal',
        '2'=>'Vice Principal',
        '3'=>'Acting Principal',


    );
    return $ci->getdesignation;
}

function getgoverningtypeList() {

    $ci = &get_instance();
    $ci->getemployeetypeList = Array(
        '1' => 'Chairman',
        '2' => 'Admin',

        '3' => 'Managing Committee'
    );
    return $ci->getemployeetypeList;
}

function getEmployeeStatus() {

    $ci = &get_instance();
    $ci->EmployeeStatus = Array(
        '1'=>'Regular',
        '2'=>'Leave For Training',
        '3'=>'Transfer',
        '4'=>'Leave',
        '5'=>'Suspend',
        '6'=>'Retired'

    );
    return $ci->EmployeeStatus;
}

function getEducationProgramType() {

    $ci = &get_instance();
    $ci->EmployeeStatus = Array(
        '1'=>'SSC',
        '2'=>'HSC',
        //'3'=>'BA/BA(Hons.)/BBA/BSS/BSC',
        '3'=>'BA(Pass)',
        '4'=>'BA(Hons.)BBA',
        '5'=>'BA(Hons.)BSS',
        '6'=>'BA(Hons.)BSC',
        '7'=>'BA(Hons.)CSE',
        '8'=>'MA',
        '9'=>'Msc',
        '10'=>'MBA',
        '11'=>'B.ed',
        '12'=>'M.ed'

    );
    return $ci->EmployeeStatus;
}

function getEducationProgramTypeOld() {

    $ci = &get_instance();
    $ci->EmployeeStatus = Array(
        '1'=>'SSC',
        '7'=>'Bped',
        '2'=>'HSC',
        '3'=>'BA/BA(Hons.)/BBA/BSS/BSC',
        '4'=>'MA/MBA',
        '5'=>'B.ed',
        '6'=>'M.ed'

    );
    return $ci->EmployeeStatus;
}

function getAccessStatus() {

    $ci = &get_instance();
    $ci->gethrList = Array(
        '2' => 'NO',
        '1' => 'Yes'

    );
    return $ci->gethrList;
}

function getCurriculumList() {

    $ci = &get_instance();
    $ci->load->model('admin/curriculum/CurriculumModleAdmin', 'CurriculumModleAdmin');
    return $ci->CurriculumModleAdmin->getCurriculumInfoArray();
}


function getAboutMessageInfo() {

    $ci = &get_instance();
    $ci->getMessageInfo = Array(
        '1'=>'About Us',
        '2'=>'Building Information',
        '3'=>'Principal/Headmaster Message',
        '10'=>'President Message',
        '4'=>'Land Information',
        '5'=>'Mission Statement',
        '6'=>'School History',
        '7'=>'Room Information',
        '8'=>'Rules & Regulation',
        '9'=>'Post Information'

    );
    return $ci->getMessageInfo;
}

function getboardmember() {

    $ci = &get_instance();
    $ci->getboardmember = Array(
        '0'=>'Donor Member',
        '1'=>'Principal (Past)',
        '2'=>'President (Past)'

    );
    return $ci->getboardmember;
}


function getAcademicMessageInfo() {

    $ci = &get_instance();
    $ci->getMessageInfo = Array(
        '1'=>'Academic Curriculum',
        '2'=>'Achievements',
        '3'=>'Awareness Program',
        '4'=>'Co-Curriculum',
        '5'=>'Functions',
        '6'=>'How To Apply For Admission',
        '7'=>'Notice Board',
        '8'=>'Library',
        '9'=>'Science Lab',
        '10'=>'IT Lab',
        '11'=>'Transport',
        '12'=>'Cafeteria',
        '13'=>'Multimedia Content',
        '14'=>'Upcoming Event'
    );
    return $ci->getMessageInfo;
}

function getMemberType() {

    $ci = &get_instance();
    $ci->getMessageInfo = Array(
        '1'=>'Board Member',
        '2'=>'Third Grade Employee',
        '3'=>'Fourth Grade Employee'
    );
    return $ci->getMessageInfo;
}



// Get ProgramOfferID BY applicant ID
function getprogramOfferIdByApplicant($getid) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getprogramOfferIdByApplicant($getid);
}

// Get All ApplicationId Array List BY programOffer ID
function getApplicationIdByprogramofferId($getapplicationid) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getApplicationIdByprogramofferId($getapplicationid);
}
// Get All ApplicationId Array List BY programOffer ID
function getApplicantInfoByApplicationId($applicationid) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getApplicantInfoByApplicationId($applicationid);
}
function getapplicantName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getapplicantName($id);
}
// get promoted applicant ID from admission promoted applicant
function getPromotedapplicantInfobyApplicationId($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getPromotedapplicantInfobyApplicationId($id);
}

function getApplicantInfoById($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getApplicantInfoById($id);
}

function getPromotedApplicant($id) {
    $ci = &get_instance();
    $ci->load->model('admin/admissiontest/AdmissiontestModleAdmin', 'AdmissiontestModleAdmin');
    return $ci->AdmissiontestModleAdmin->getPromotedApplicant($id);
}

//        check & get all applicant status(Allowed/Waiting/Disallow)

function getapplicantStatus($id) {
    $ci = &get_instance();
    $ci->load->model('admin/admissiontest/AdmissiontestModleAdmin', 'AdmissiontestModleAdmin');
    return $ci->AdmissiontestModleAdmin->getapplicantStatus($id);
}

// Get Student Info data by applicationId
function getstudentsInfoArrayByApplicationId($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getstudentsInfoArrayByApplicationId($id);
}

function getstudentNameInfo($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getstudentNameInfo($id);
}
// student basic info
function getstudentBasicInfo($id, $session_id = 0)  {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getstudentBasicInfo($id, $session_id);
}
function getstudentNameInfoList($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getstudentNameInfoList($id);
}

function getstudentPersonal_Info($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getstudentPersonal_Info($id);
}

// get student all information by student id as arraylist
//function getstudentNameInfoList($id) {
//    $ci = &get_instance();
//    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
//    return $ci->StudentModleAdmin->getstudentNameInfoList($id);
//}
// Search Student info by  programOfferID
function searchRegisteredStudent($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->searchRegisteredStudent($id);
}
// check validate student from student table by studentId & programOfferID
function checkCurrentStudent($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->checkCurrentStudent($id);
}
/*
 * intput int
 * return var
 *
 */





function getClasslevelInfoArray() {
    $ci = &get_instance();
    $ci->load->model('admin/classlevel/ClasslevelModleAdmin', 'ClasslevelModleAdmin');
    return $ci->ClasslevelModleAdmin->getClasslevelInfoArray();
}


function getClasslevelName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/classlevel/ClasslevelModleAdmin', 'ClasslevelModleAdmin');
    return $ci->ClasslevelModleAdmin->getClasslevelName($id);
}

function getsectionName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/section/SectionModleAdmin', 'SectionModleAdmin');
    return $ci->SectionModleAdmin->getsectionName($id);
}

function monthlist()
{
    $months = [
        '1' => 'January',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'Septenber',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December'
    ];
    return $months;
}


// Not used yet...similar getstudentName
//function getstudents($id) {
//    $ci = &get_instance();
//    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
//    return $ci->StudentModleAdmin->getstudents($id);
//}
function getStudentsInfo($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getStudentsInfo($id);
}
function getStudentId() {
    $ci = &get_instance();
    $ci->load->model('admin/admissiontest/AdmissiontestModleAdmin', 'AdmissiontestModleAdmin');
    return $ci->AdmissiontestModleAdmin->getStudentId();
}
function getRegisteredStudentId($id) {
    $ci = &get_instance();
    $ci->load->model('admin/studentregistration/StudentregistrationModleAdmin', 'StudentregistrationModleAdmin');
    return $ci->StudentregistrationModleAdmin->getRegisteredStudentId($id);
}

function getStudentName_Image($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getStudentName_Image($id);
}

function getStudentPhoneNumber($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getStudentPhoneNumber($id);
}
function getStudentFatherPhoneNumber($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getStudentFatherPhoneNumber($id);
}
function getStudentMotherPhoneNumber($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getStudentMotherPhoneNumber($id);
}
function getStudentByApplicationId($id) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getStudentByApplicationId($id);
}


function checkCourse($id,$test) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getofferedId($id,$test);
}
function tt($courseId,$programOfferId,$semesterId/*,$examtypeId*/,$studentId) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getofferedtt($courseId,$programOfferId,$semesterId/*,$examtypeId*/,$studentId);
}

function checkexamtypelist($courseId,$programOfferId) {
    $ci = &get_instance();
    $ci->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
    return $ci->StudentmarksModleAdmin->checkexamtypelist($courseId,$programOfferId);
}

function checkassigncourselist($id,$test) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getcourseofferlist($id,$test);
}

function CourseofferId($id) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getofferedIdBymrk($id);
}
function checkval($id) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getofferedval($id);
}
function checkCourseteacher($id) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getofferedteacher($id);
}

function getEmployeePhoneNumber($id) {
    $ci = &get_instance();
    $ci->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
    return $ci->EmployeeModleAdmin->getEmployeePhoneNumber($id);
}

function getoneEmployeeName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
    return $ci->EmployeeModleAdmin->getoneEmployeeName($id);
}

function getmarkcategoryList() {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseOfferModleAdmin', 'CourseOfferModleAdmin');
    return $ci->CourseOfferModleAdmin->getmarkcategoryList();
}

function getMarkTitle($id) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseOfferModleAdmin', 'CourseOfferModleAdmin');
    return $ci->CourseOfferModleAdmin->getMarkTitle($id);
}

function getTotalMarks($studentId) {
    $ci = &get_instance();
    $ci->load->model('admin/admissiontest/AdmissiontestModleAdmin', 'AdmissiontestModleAdmin');
    return $ci->AdmissiontestModleAdmin->getTotalMarks($studentId);
}
function getresultStatus($data) {
    $ci = &get_instance();
    $ci->load->model('admin/publish/PublishResultModelAdmin', 'PublishResultModelAdmin');
    return $ci->PublishResultModelAdmin->getresultStatus($data);
}

function counter() {
    $ci = &get_instance();
    //opens countlog.txt to read the number of hits
    $datei = fopen("counter.txt", "r");
    $count = fgets($datei, 1000);
    fclose($datei);
    $count = $count + 1;

    $datei = fopen("counter.txt", "w");
    fwrite($datei, $count);
    fclose($datei);
    return $count;
}

function idcounter() {
    $ci = &get_instance();

    $datei = fopen("idcounter.txt", "r");
    $count = fgets($datei, 1000);
    fclose($datei);
    $count = $count + 1;
    $datei = fopen("idcounter.txt", "w");
    fwrite($datei, $count);
    fclose($datei);
    return $count;
}

function empidcounter() {
    $ci = &get_instance();

    $datei = fopen("empidcounter.txt", "r");
    $count = fgets($datei, 100);
    fclose($datei);
    $count = $count + 1;
    $datei = fopen("empidcounter.txt", "w");
    fwrite($datei, $count);
    fclose($datei);
    return $count;
}





function chnageString($numb) {
    $ci = &get_instance();
    echo sprintf('%02d',$numb);

}

function getDepartmentInfoArray(){
    $ci = &get_instance();
    $ci->load->model('admin/department/DepartmentModleAdmin', 'DepartmentModleAdmin');
    return $ci->DepartmentModleAdmin->getlistDepartment();
}

function getDepartmentName($id){
    $ci = &get_instance();
    $ci->load->model('admin/department/DepartmentModleAdmin', 'DepartmentModleAdmin');
    return $ci->DepartmentModleAdmin->getDepartmentName($id);
}

function getpaymentamount($headid){
    $ci = &get_instance();
    $ci->load->model('admin/fees/FeesModleAdmin', 'FeesModleAdmin');
    return $ci->FeesModleAdmin->getfeesAmount($headid);
}

function getinventorycategoryList() {

    $ci = &get_instance();
    $ci->load->model('admin/inventory/InventoryModleAdmin', 'InventoryModleAdmin');
    return $ci->InventoryModleAdmin->getinventorycategoryList();
}
function getinventorycategoryName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/inventory/InventoryModleAdmin', 'InventoryModleAdmin');
    return $ci->InventoryModleAdmin->getinventorycategoryName($id);
}

function getinventoryList() {

    $ci = &get_instance();
    $ci->load->model('admin/inventory/InventoryModleAdmin', 'InventoryModleAdmin');
    return $ci->InventoryModleAdmin->getinventoryList();
}
function getinventoryName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/inventory/InventoryModleAdmin', 'InventoryModleAdmin');
    return $ci->InventoryModleAdmin->getinventoryName($id);
}

function getTransportcategoryList() {

    $ci = &get_instance();
    $ci->load->model('admin/transport/TransportModleAdmin', 'TransportModleAdmin');
    return $ci->TransportModleAdmin->getTransportcategoryList();
}
function gettransportcategoryName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/transport/TransportModleAdmin', 'TransportModleAdmin');
    return $ci->TransportModleAdmin->gettransportcategoryName($id);
}
function getTransportNameList() {

    $ci = &get_instance();
    $ci->load->model('admin/transportroot/TransportRootModleAdmin', 'TransportRootModleAdmin');
    return $ci->TransportRootModleAdmin->getTransportNameList();
}
function getTransportName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/transportroot/TransportRootModleAdmin', 'TransportRootModleAdmin');
    return $ci->TransportRootModleAdmin->getTransportName($id);
}
function getTransportRootList() {

    $ci = &get_instance();
    $ci->load->model('admin/transportfees/TransportFeesModleAdmin', 'TransportFeesModleAdmin');
    return $ci->TransportFeesModleAdmin->getTransportRootList();
}
function getTransportRoot($id) {
    $ci = &get_instance();
    $ci->load->model('admin/transportfees/TransportFeesModleAdmin', 'TransportFeesModleAdmin');
    return $ci->TransportFeesModleAdmin->getTransportRoot($id);
}

function getIncomeHeadCategoryList() {

    $ci = &get_instance();
    $ci->load->model('admin/financehead/FinanceHeadModleAdmin', 'FinanceHeadModleAdmin');
    return $ci->FinanceHeadModleAdmin->getlistfinancehead();
}
function getIncomeHeadCategoryName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/financehead/FinanceHeadModleAdmin', 'FinanceHeadModleAdmin');
    return $ci->FinanceHeadModleAdmin->getIncomeHeadCategoryName($id);
}
function getLiabilitiesHeadCategoryList() {

    $ci = &get_instance();
    $ci->load->model('admin/liabilities/LiabilitiesModleAdmin', 'LiabilitiesModleAdmin');
    return $ci->LiabilitiesModleAdmin->getLiabilitiesHeadCategoryList();
}
function getLiabilitiesHeadCategoryName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/liabilities/LiabilitiesModleAdmin', 'LiabilitiesModleAdmin');
    return $ci->LiabilitiesModleAdmin->getLiabilitiesHeadCategoryName($id);
}
function getHostelcategoryList() {

    $ci = &get_instance();
    $ci->load->model('admin/hostel/HostelModleAdmin', 'HostelModleAdmin');
    return $ci->HostelModleAdmin->getHostelcategoryList();
}
function getHostelcategoryName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/hostel/HostelModleAdmin', 'HostelModleAdmin');
    return $ci->HostelModleAdmin->getHostelcategoryName($id);
}
function getHostelNameList() {

    $ci = &get_instance();
    $ci->load->model('admin/hostel/HostelModleAdmin', 'HostelModleAdmin');
    return $ci->HostelModleAdmin->getHostelNameList();
}
function getHostelName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/hostel/HostelModleAdmin', 'HostelModleAdmin');
    return $ci->HostelModleAdmin->getHostelName($id);
}
function getHostelRoomList() {

    $ci = &get_instance();
    $ci->load->model('admin/hostelroom/HostelRoomModleAdmin', 'HostelRoomModleAdmin');
    return $ci->HostelRoomModleAdmin->gethostelRoomlist();
}
function getHostelBedList() {

    $ci = &get_instance();
    $ci->load->model('admin/hostelbed/HostelBedModleAdmin', 'HostelBedModleAdmin');
    return $ci->HostelBedModleAdmin->gethostelBedlist();
}
function getAssignBed($bedno) {

    $ci = &get_instance();
    $ci->load->model('admin/hostelbedassign/HostelBedAssignModleAdmin', 'HostelBedAssignModleAdmin');
    return $ci->HostelBedAssignModleAdmin->getAssignBed($bedno);
}
function getSelfInfoArray(){
    $ci = &get_instance();
    $ci->load->model('admin/bookself/BookselfModleAdmin', 'BookselfModleAdmin');
    return $ci->BookselfModleAdmin->getSelfInfoArray();
}


function getSelfNames($selfId){
    $ci = &get_instance();
    $ci->load->model('admin/bookself/BookselfModleAdmin', 'BookselfModleAdmin');
    return $ci->BookselfModleAdmin->getSelfNames($selfId);

//    print_r($redd);
}
function getBookCategoryArray(){
    $ci = &get_instance();
    $ci->load->model('admin/bookcategory/BookcategoryModleAdmin', 'BookcategoryModleAdmin');
    return $ci->BookcategoryModleAdmin->getBookCategoryArray();
}


function getBookCategoryNames($bookcategoryId){
    $ci = &get_instance();
    $ci->load->model('admin/bookcategory/BookcategoryModleAdmin', 'BookcategoryModleAdmin');
    return $ci->BookcategoryModleAdmin->getBookCategoryNames($bookcategoryId);

//    print_r($redd);
}

function getSelfStatus($bookCategoryName){
    $ci = &get_instance();
    $ci->load->model('admin/bookcategory/BookcategoryModleAdmin', 'BookcategoryModleAdmin');
    return $ci->BookcategoryModleAdmin->getSelfStatus($bookCategoryName);

//    print_r($redd);
}
function getBookArray(){
    $ci = &get_instance();
    $ci->load->model('admin/book/BookModleAdmin', 'BookModleAdmin');
    return $ci->BookModleAdmin->getBookArray();
}
function getBookNames($id){
    $ci = &get_instance();
    $ci->load->model('admin/book/BookModleAdmin', 'BookModleAdmin');
    return $ci->BookModleAdmin->getBookNames($id);
}

function getBookCount($id){
    $ci = &get_instance();
    $ci->load->model('admin/bookborrow/BookborrowModleAdmin', 'BookborrowModleAdmin');
    return $ci->BookborrowModleAdmin->getBookCount($id);
}
function getBookwriterArray(){
    $ci = &get_instance();
    $ci->load->model('admin/book/BookModleAdmin', 'BookModleAdmin');
    return $ci->BookModleAdmin->getBookwriterArray();
}
function getEventdate($date){
    $ci = &get_instance();
    $ci->load->model('admin/academiccalender/AcademicCalenderModleAdmin', 'AcademicCalenderModleAdmin');
    return $ci->AcademicCalenderModleAdmin->getEventdate($date);
}
function getEventdescription($dates){
    $ci = &get_instance();
    $ci->load->model('admin/academiccalender/AcademicCalenderModleAdmin', 'AcademicCalenderModleAdmin');
    return $ci->AcademicCalenderModleAdmin->getEventdescription($dates);
}
function getFinancedate(){
    $ci = &get_instance();
    $ci->load->model('admin/financehead/FinanceHeadModleAdmin', 'FinanceHeadModleAdmin');
    return $ci->FinanceHeadModleAdmin->getFinancedate();
}
function getPaymentdate(){
    $ci = &get_instance();
    $ci->load->model('admin/payments/PaymentsModleAdmin', 'PaymentsModleAdmin');
    return $ci->PaymentsModleAdmin->getPaymentdate();
}
// use to total view of student marks in admin >> result_view >> transcriptView
function getExamMarks($data) {
    $ci = &get_instance();
    $ci->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
    return $ci->StudentmarksModleAdmin->getExamMarks($data);
}

function getDivideMarks_bySubject($data) {
    $ci = &get_instance();
    $ci->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
    return $ci->StudentmarksModleAdmin->getDivideMarks_bySubject($data);
}

function getMarkDevidevalue($data) {
    $ci = &get_instance();
    $ci->load->model('admin/courseoffer/CourseofferModleAdmin', 'CourseofferModleAdmin');
    return $ci->CourseofferModleAdmin->getMarkDevidevalue($data);
}



// use to total view of student marks by studentID & ProgramofferId in Promotion >>
function CountMarksByStudent($data) {
    $ci = &get_instance();
    $ci->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
    return $ci->StudentmarksModleAdmin->CountMarksByStudent($data);
}
function getGradeInfo($mark) {
    $ci = &get_instance();
    $ci->load->model('admin/grading/GradingModleAdmin', 'GradingModleAdmin');
    return $ci->GradingModleAdmin->getGradeInfo($mark);
}

// Under both fuction doing same... first one is with semesterID & second one is without semesterID
function getMark_stuid_corid_emtyp($studentId,$courseId) {
    ini_set('memory_limit', '-1');
    $ci = &get_instance();
    $ci->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
    return $ci->StudentmarksModleAdmin->getMark_stuid_corid_emtyp($studentId,$courseId);
}

function GetMarkBy_StuId_CouId_PrgId($studentId,$prgramOfferId,$semesterId,$courseId) {
    ini_set('memory_limit', '-1');
    $ci = &get_instance();
    $ci->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
    return $ci->StudentmarksModleAdmin->GetMarkBy_StuId_CouId_PrgId($studentId,$prgramOfferId,$semesterId,$courseId);
}

function getMark_stuid_corid_semis_emtyp($studentId,$prgramOfferId,$semesterId,$courseId,$examtypeId) {
    ini_set('memory_limit', '-1');
    $ci = &get_instance();
    $ci->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
    return $ci->StudentmarksModleAdmin->getMark_stuid_corid_semis_emtyp($studentId,$prgramOfferId,$semesterId,$courseId,$examtypeId);
}
//function getTotalSemesterMarks($studentId) {
//    $ci = &get_instance();
//    $ci->load->model('admin/studentmarks/StudentMarksModleAdmin', 'StudentMarksModleAdmin');
//    return $ci->StudentMarksModleAdmin->getTotalSemesterMarks($studentId);
//}

function getStudentResult($data) {
    $ci = &get_instance();
    $ci->load->model('admin/studentmarks/StudentmarksModleAdmin', 'StudentmarksModleAdmin');
    return $ci->StudentmarksModleAdmin->getStudentResult($data);
}

function getQuatalist() {
    $ci = &get_instance();
    $ci->load->model('admin/quata/QuataModleAdmin', 'QuataModleAdmin');
    return $ci->QuataModleAdmin->getQuatalist();
}

function getQuataName($id) {
    $ci = &get_instance();
    $ci->load->model('admin/quata/QuataModleAdmin', 'QuataModleAdmin');
    return $ci->QuataModleAdmin->getQuataName($id);
}

function getDiscount_percentage() {

    $ci = &get_instance();
    $ci->getDiscount_percentage = Array(
        '2'=>'2%',
        '5'=>'5%',
        '10'=>'10%',
        '15'=>'15%',
        '20'=>'20%',
        '25'=>'25%',
        '30'=>'30%',
        '35'=>'35%',
        '40'=>'40%',
        '45'=>'45%',
        '50'=>'50%',
        '55'=>'55%',
        '60'=>'60%',
        '65'=>'65%',
        '70'=>'70%',
        '75'=>'75%',
        '80'=>'80%',
        '85'=>'85%',
        '90'=>'90%',
        '95'=>'95%',
        '100'=>'100%'
    );

    return $ci->getDiscount_percentage;
}


// Get All ApplicationId Array List BY programOffer ID
function getStudent_all_Class($studentId) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->getStudent_all_Class($studentId);
}

function count_all_fees_Byquata_head($count_student) {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->count_all_fees_Byquata_head($count_student);
}

function countTotalStudents() {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->countTotalStudents();
}

function countBoysStudents() {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->countBoysStudents();
}

function countGirlsStudents() {
    $ci = &get_instance();
    $ci->load->model('admin/student/StudentModleAdmin', 'StudentModleAdmin');
    return $ci->StudentModleAdmin->countGirlsStudents();
}

function countTotalEmployee_BYType($typeId) {
    $ci = &get_instance();
    $ci->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
    return $ci->EmployeeModleAdmin->countTotalEmployee_BYType($typeId);
}

function countMaleEmployee_BYType($typeId) {
    $ci = &get_instance();
    $ci->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
    return $ci->EmployeeModleAdmin->countMaleEmployee_BYType($typeId);
}

function countTFemaleEmployee_BYType($typeId) {
    $ci = &get_instance();
    $ci->load->model('admin/employee/EmployeeModleAdmin', 'EmployeeModleAdmin');
    return $ci->EmployeeModleAdmin->countTFemaleEmployee_BYType($typeId);
}

function getSemesterNameById($id) {
    $ci = &get_instance();
    $ci->load->model('admin/examroutine/ExamroutineModleAdmin', 'ExamroutineModleAdmin');
    return $ci->ExamroutineModleAdmin->getSemesterNameById($id);
}

function get_class_info($program_offer_info) {
    $ci = &get_instance();
    $ci->load->model('admin/program/ProgramModleAdmin', 'ProgramModleAdmin');
    return $ci->ProgramModleAdmin->get_class_info($program_offer_info);
}