<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
        $countries = array(
            array(
                "country_id"=> "0",
                "utc"=> "4",
                "continent"=> "asia",
                "region"=> "south asia",
                "name"=> "Afghanistan"
            ),
            array(
                "country_id"=> "1",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "south east europe",
                "name"=> "Albania"
            ),
            array(
                "country_id"=> "2",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "northern africa",
                "name"=> "Algeria"
            ),
            array(
                "country_id"=> "3",
                "utc"=> "-11",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "American Samoa"
            ),
            array(
                "country_id"=> "4",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "south west europe",
                "name"=> "Andorra"
            ),
            array(
                "country_id"=> "5",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "southern africa",
                "name"=> "Angola"
            ),
            array(
                "country_id"=> "6",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Anguilla"
            ),
            array(
                "country_id"=> "7",
                "utc"=> "0",
                "continent"=> "undecided",
                "region"=> "undecided",
                "name"=> "Antarctica"
            ),
            array(
                "country_id"=> "8",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Antigua and Barbuda"
            ),
            array(
                "country_id"=> "9",
                "utc"=> "-3",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Argentina"
            ),
            array(
                "country_id"=> "10",
                "utc"=> "4",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Armenia"
            ),
            array(
                "country_id"=> "11",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Aruba"
            ),
            array(
                "country_id"=> "12",
                "utc"=> "10",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Australia"
            ),
            array(
                "country_id"=> "13",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "central europe",
                "name"=> "Austria"
            ),
            array(
                "country_id"=> "14",
                "utc"=> "4",
                "continent"=> "asia",
                "region"=> "south asia",
                "name"=> "Azerbaijan"
            ),
            array(
                "country_id"=> "15",
                "utc"=> "-5",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Bahamas"
            ),
            array(
                "country_id"=> "16",
                "utc"=> "3",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Bahrain"
            ),
            array(
                "country_id"=> "17",
                "utc"=> "6",
                "continent"=> "asia",
                "region"=> "south asia",
                "name"=> "Bangladesh"
            ),
            array(
                "country_id"=> "18",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Barbados"
            ),
            array(
                "country_id"=> "19",
                "utc"=> "3",
                "continent"=> "3",
                "region"=> "eastern europe",
                "name"=> "Belarus"
            ),
            array(
                "country_id"=> "20",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "western europe",
                "name"=> "Belgium"
            ),
            array(
                "country_id"=> "21",
                "utc"=> "-6",
                "continent"=> "3",
                "region"=> "central america",
                "name"=> "Belize"
            ),
            array(
                "country_id"=> "22",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Benin"
            ),
            array(
                "country_id"=> "23",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Bermuda"
            ),
            array(
                "country_id"=> "24",
                "utc"=> "6",
                "continent"=> "asia",
                "region"=> "south asia",
                "name"=> "Bhutan"
            ),
            array(
                "country_id"=> "25",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Bolivia"
            ),
            array(
                "country_id"=> "26",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "south east europe",
                "name"=> "Bosnia and Herzegovina"
            ),
            array(
                "country_id"=> "27",
                "utc"=> "2",
                "continent"=> "africa",
                "region"=> "southern africa",
                "name"=> "Botswana"
            ),
            array(
                "country_id"=> "28",
                "utc"=> "-3",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Brazil"
            ),
            array(
                "country_id"=> "29",
                "utc"=> "6",
                "continent"=> "asia",
                "region"=> "south asia",
                "name"=> "British Indian Ocean Territory"
            ),
            array(
                "country_id"=> "30",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "British Virgin Islands"
            ),
            array(
                "country_id"=> "31",
                "utc"=> "8",
                "continent"=> "asia",
                "region"=> "south east asia",
                "name"=> "Brunei"
            ),
            array(
                "country_id"=> "32",
                "utc"=> "2",
                "continent"=> "3",
                "region"=> "south east europe",
                "name"=> "Bulgaria"
            ),
            array(
                "country_id"=> "33",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Burkina Faso"
            ),
            array(
                "country_id"=> "34",
                "utc"=> "2",
                "continent"=> "africa",
                "region"=> "central africa",
                "name"=> "Burundi"
            ),
            array(
                "country_id"=> "35",
                "utc"=> "7",
                "continent"=> "asia",
                "region"=> "south east asia",
                "name"=> "Cambodia"
            ),
            array(
                "country_id"=> "36",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Cameroon"
            ),
            array(
                "country_id"=> "37",
                "utc"=> "-5",
                "continent"=> "3",
                "region"=> "north america",
                "name"=> "Canada"
            ),
            array(
                "country_id"=> "38",
                "utc"=> "-1",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Cape Verde"
            ),
            array(
                "country_id"=> "39",
                "utc"=> "-5",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Cayman Islands"
            ),
            array(
                "country_id"=> "40",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "central africa",
                "name"=> "Central African Republic"
            ),
            array(
                "country_id"=> "41",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "central africa",
                "name"=> "Chad"
            ),
            array(
                "country_id"=> "42",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Chile"
            ),
            array(
                "country_id"=> "43",
                "utc"=> "8",
                "continent"=> "asia",
                "region"=> "east asia",
                "name"=> "China"
            ),
            array(
                "country_id"=> "44",
                "utc"=> "7",
                "continent"=> "asia",
                "region"=> "south east asia",
                "name"=> "Christmas Island"
            ),
            array(
                "country_id"=> "45",
                "utc"=> "6",
                "continent"=> "asia",
                "region"=> "south east asia",
                "name"=> "Cocos Islands"
            ),
            array(
                "country_id"=> "46",
                "utc"=> "-5",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Colombia"
            ),
            array(
                "country_id"=> "47",
                "utc"=> "3",
                "continent"=> "africa",
                "region"=> "indian ocean",
                "name"=> "Comoros"
            ),
            array(
                "country_id"=> "48",
                "utc"=> "-10",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Cook Islands"
            ),
            array(
                "country_id"=> "49",
                "utc"=> "-6",
                "continent"=> "3",
                "region"=> "central america",
                "name"=> "Costa Rica"
            ),
            array(
                "country_id"=> "50",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "south east europe",
                "name"=> "Croatia"
            ),
            array(
                "country_id"=> "51",
                "utc"=> "-5",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Cuba"
            ),
            array(
                "country_id"=> "52",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Curacao"
            ),
            array(
                "country_id"=> "53",
                "utc"=> "2",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Cyprus"
            ),
            array(
                "country_id"=> "54",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "central europe",
                "name"=> "Czech Republic"
            ),
            array(
                "country_id"=> "55",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Democratic Republic of the Congo"
            ),
            array(
                "country_id"=> "56",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "northern europe",
                "name"=> "Denmark"
            ),
            array(
                "country_id"=> "57",
                "utc"=> "3",
                "continent"=> "africa",
                "region"=> "eastern africa",
                "name"=> "Djibouti"
            ),
            array(
                "country_id"=> "58",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Dominica"
            ),
            array(
                "country_id"=> "59",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Dominican Republic"
            ),
            array(
                "country_id"=> "60",
                "utc"=> "9",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "East Timor"
            ),
            array(
                "country_id"=> "61",
                "utc"=> "-5",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Ecuador"
            ),
            array(
                "country_id"=> "62",
                "utc"=> "2",
                "continent"=> "africa",
                "region"=> "northern africa",
                "name"=> "Egypt"
            ),
            array(
                "country_id"=> "63",
                "utc"=> "-6",
                "continent"=> "3",
                "region"=> "central america",
                "name"=> "El Salvador"
            ),
            array(
                "country_id"=> "64",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Equatorial Guinea"
            ),
            array(
                "country_id"=> "65",
                "utc"=> "3",
                "continent"=> "africa",
                "region"=> "eastern africa",
                "name"=> "Eritrea"
            ),
            array(
                "country_id"=> "66",
                "utc"=> "2",
                "continent"=> "3",
                "region"=> "eastern europe",
                "name"=> "Estonia"
            ),
            array(
                "country_id"=> "67",
                "utc"=> "3",
                "continent"=> "africa",
                "region"=> "eastern africa",
                "name"=> "Ethiopia"
            ),
            array(
                "country_id"=> "68",
                "utc"=> "-3",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Falkland Islands"
            ),
            array(
                "country_id"=> "69",
                "utc"=> "0",
                "continent"=> "3",
                "region"=> "northern europe",
                "name"=> "Faroe Islands"
            ),
            array(
                "country_id"=> "70",
                "utc"=> "12",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Fiji"
            ),
            array(
                "country_id"=> "71",
                "utc"=> "2",
                "continent"=> "3",
                "region"=> "northern europe",
                "name"=> "Finland"
            ),
            array(
                "country_id"=> "72",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "western europe",
                "name"=> "France"
            ),
            array(
                "country_id"=> "73",
                "utc"=> "-3",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "French Guiana"
            ),
            array(
                "country_id"=> "74",
                "utc"=> "-10",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "French polynesia"
            ),
            array(
                "country_id"=> "75",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Gabon"
            ),
            array(
                "country_id"=> "76",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Gambia"
            ),
            array(
                "country_id"=> "77",
                "utc"=> "4",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Georgia"
            ),
            array(
                "country_id"=> "78",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "western europe",
                "name"=> "Germany"
            ),
            array(
                "country_id"=> "79",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Ghana"
            ),
            array(
                "country_id"=> "80",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "south west europe",
                "name"=> "Gibraltar"
            ),
            array(
                "country_id"=> "81",
                "utc"=> "2",
                "continent"=> "3",
                "region"=> "south east europe",
                "name"=> "Greece"
            ),
            array(
                "country_id"=> "82",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "north america",
                "name"=> "Greenland"
            ),
            array(
                "country_id"=> "83",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Grenada"
            ),
            array(
                "country_id"=> "84",
                "utc"=> "10",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Guam"
            ),
            array(
                "country_id"=> "85",
                "utc"=> "-6",
                "continent"=> "3",
                "region"=> "central america",
                "name"=> "Guatemala"
            ),
            array(
                "country_id"=> "86",
                "utc"=> "0",
                "continent"=> "3",
                "region"=> "western europe",
                "name"=> "Guernsey"
            ),
            array(
                "country_id"=> "87",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Guinea"
            ),
            array(
                "country_id"=> "88",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Guinea-Bissau"
            ),
            array(
                "country_id"=> "89",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Guyana"
            ),
            array(
                "country_id"=> "90",
                "utc"=> "-5",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Haiti"
            ),
            array(
                "country_id"=> "91",
                "utc"=> "-6",
                "continent"=> "3",
                "region"=> "central america",
                "name"=> "Honduras"
            ),
            array(
                "country_id"=> "92",
                "utc"=> "8",
                "continent"=> "asia",
                "region"=> "east asia",
                "name"=> "Hong Kong"
            ),
            array(
                "country_id"=> "93",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "central europe",
                "name"=> "Hungary"
            ),
            array(
                "country_id"=> "94",
                "utc"=> "0",
                "continent"=> "3",
                "region"=> "northern europe",
                "name"=> "Iceland"
            ),
            array(
                "country_id"=> "95",
                "utc"=> "5",
                "continent"=> "asia",
                "region"=> "south asia",
                "name"=> "India"
            ),
            array(
                "country_id"=> "96",
                "utc"=> "7",
                "continent"=> "asia",
                "region"=> "south east asia",
                "name"=> "Indonesia"
            ),
            array(
                "country_id"=> "97",
                "utc"=> "3",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Iran"
            ),
            array(
                "country_id"=> "98",
                "utc"=> "3",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Iraq"
            ),
            array(
                "country_id"=> "99",
                "utc"=> "0",
                "continent"=> "3",
                "region"=> "western europe",
                "name"=> "Ireland"
            ),
            array(
                "country_id"=> "100",
                "utc"=> "0",
                "continent"=> "3",
                "region"=> "western europe",
                "name"=> "Isle of Man"
            ),
            array(
                "country_id"=> "101",
                "utc"=> "2",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Israel"
            ),
            array(
                "country_id"=> "102",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "southern europe",
                "name"=> "Italy"
            ),
            array(
                "country_id"=> "103",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Ivory Coast"
            ),
            array(
                "country_id"=> "104",
                "utc"=> "-5",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Jamaica"
            ),
            array(
                "country_id"=> "105",
                "utc"=> "9",
                "continent"=> "asia",
                "region"=> "east asia",
                "name"=> "Japan"
            ),
            array(
                "country_id"=> "106",
                "utc"=> "0",
                "continent"=> "3",
                "region"=> "western europe",
                "name"=> "Jersey"
            ),
            array(
                "country_id"=> "107",
                "utc"=> "2",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Jordan"
            ),
            array(
                "country_id"=> "108",
                "utc"=> "5",
                "continent"=> "asia",
                "region"=> "central asia",
                "name"=> "Kazakhstan"
            ),
            array(
                "country_id"=> "109",
                "utc"=> "3",
                "continent"=> "africa",
                "region"=> "eastern africa",
                "name"=> "Kenya"
            ),
            array(
                "country_id"=> "110",
                "utc"=> "12",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Kiribati"
            ),
            array(
                "country_id"=> "111",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "southern europe",
                "name"=> "Kosovo"
            ),
            array(
                "country_id"=> "112",
                "utc"=> "3",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Kuwait"
            ),
            array(
                "country_id"=> "113",
                "utc"=> "6",
                "continent"=> "asia",
                "region"=> "central asia",
                "name"=> "Kyrgyzstan"
            ),
            array(
                "country_id"=> "114",
                "utc"=> "7",
                "continent"=> "asia",
                "region"=> "south east asia",
                "name"=> "Laos"
            ),
            array(
                "country_id"=> "115",
                "utc"=> "2",
                "continent"=> "3",
                "region"=> "eastern europe",
                "name"=> "Latvia"
            ),
            array(
                "country_id"=> "116",
                "utc"=> "2",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Lebanon"
            ),
            array(
                "country_id"=> "117",
                "utc"=> "2",
                "continent"=> "africa",
                "region"=> "southern africa",
                "name"=> "Lesotho"
            ),
            array(
                "country_id"=> "118",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Liberia"
            ),
            array(
                "country_id"=> "119",
                "utc"=> "2",
                "continent"=> "africa",
                "region"=> "northern africa",
                "name"=> "Libya"
            ),
            array(
                "country_id"=> "120",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "central europe",
                "name"=> "Liechtenstein"
            ),
            array(
                "country_id"=> "121",
                "utc"=> "2",
                "continent"=> "3",
                "region"=> "eastern europe",
                "name"=> "Lithuania"
            ),
            array(
                "country_id"=> "122",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "western europe",
                "name"=> "Luxembourg"
            ),
            array(
                "country_id"=> "123",
                "utc"=> "8",
                "continent"=> "asia",
                "region"=> "east asia",
                "name"=> "Macau"
            ),
            array(
                "country_id"=> "124",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "south east europe",
                "name"=> "Macedonia"
            ),
            array(
                "country_id"=> "125",
                "utc"=> "3",
                "continent"=> "africa",
                "region"=> "indian ocean",
                "name"=> "Madagascar"
            ),
            array(
                "country_id"=> "126",
                "utc"=> "2",
                "continent"=> "africa",
                "region"=> "southern africa",
                "name"=> "Malawi"
            ),
            array(
                "country_id"=> "127",
                "utc"=> "8",
                "continent"=> "asia",
                "region"=> "south east asia",
                "name"=> "Malaysia"
            ),
            array(
                "country_id"=> "128",
                "utc"=> "5",
                "continent"=> "asia",
                "region"=> "south asia",
                "name"=> "Maldives"
            ),
            array(
                "country_id"=> "129",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Mali"
            ),
            array(
                "country_id"=> "130",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "southern europe",
                "name"=> "Malta"
            ),
            array(
                "country_id"=> "131",
                "utc"=> "12",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Marshall Islands"
            ),
            array(
                "country_id"=> "132",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Mauritania"
            ),
            array(
                "country_id"=> "133",
                "utc"=> "4",
                "continent"=> "africa",
                "region"=> "indian ocean",
                "name"=> "Mauritius"
            ),
            array(
                "country_id"=> "134",
                "utc"=> "3",
                "continent"=> "africa",
                "region"=> "indian ocean",
                "name"=> "Mayotte"
            ),
            array(
                "country_id"=> "135",
                "utc"=> "-6",
                "continent"=> "3",
                "region"=> "central america",
                "name"=> "Mexico"
            ),
            array(
                "country_id"=> "136",
                "utc"=> "11",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Micronesia"
            ),
            array(
                "country_id"=> "137",
                "utc"=> "2",
                "continent"=> "3",
                "region"=> "eastern europe",
                "name"=> "Moldova"
            ),
            array(
                "country_id"=> "138",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "western europe",
                "name"=> "Monaco"
            ),
            array(
                "country_id"=> "139",
                "utc"=> "7",
                "continent"=> "asia",
                "region"=> "northern asia",
                "name"=> "Mongolia"
            ),
            array(
                "country_id"=> "140",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "southern europe",
                "name"=> "Montenegro"
            ),
            array(
                "country_id"=> "141",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Montserrat"
            ),
            array(
                "country_id"=> "142",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "northern africa",
                "name"=> "Morocco"
            ),
            array(
                "country_id"=> "143",
                "utc"=> "2",
                "continent"=> "africa",
                "region"=> "southern africa",
                "name"=> "Mozambique"
            ),
            array(
                "country_id"=> "144",
                "utc"=> "6",
                "continent"=> "asia",
                "region"=> "south east asia",
                "name"=> "Myanmar"
            ),
            array(
                "country_id"=> "145",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "southern africa",
                "name"=> "Namibia"
            ),
            array(
                "country_id"=> "146",
                "utc"=> "12",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Nauru"
            ),
            array(
                "country_id"=> "147",
                "utc"=> "6",
                "continent"=> "asia",
                "region"=> "south asia",
                "name"=> "Nepal"
            ),
            array(
                "country_id"=> "148",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "western europe",
                "name"=> "Netherlands"
            ),
            array(
                "country_id"=> "149",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Netherlands Antilles"
            ),
            array(
                "country_id"=> "150",
                "utc"=> "11",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "New Caledonia"
            ),
            array(
                "country_id"=> "151",
                "utc"=> "-11",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "New Zealand"
            ),
            array(
                "country_id"=> "152",
                "utc"=> "-6",
                "continent"=> "3",
                "region"=> "central america",
                "name"=> "Nicaragua"
            ),
            array(
                "country_id"=> "153",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Niger"
            ),
            array(
                "country_id"=> "154",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Nigeria"
            ),
            array(
                "country_id"=> "155",
                "utc"=> "-11",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Niue"
            ),
            array(
                "country_id"=> "156",
                "utc"=> "8",
                "continent"=> "asia",
                "region"=> "east asia",
                "name"=> "North Korea"
            ),
            array(
                "country_id"=> "157",
                "utc"=> "10",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Northern Mariana Islands"
            ),
            array(
                "country_id"=> "158",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "northern europe",
                "name"=> "Norway"
            ),
            array(
                "country_id"=> "159",
                "utc"=> "4",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Oman"
            ),
            array(
                "country_id"=> "160",
                "utc"=> "5",
                "continent"=> "asia",
                "region"=> "central asia",
                "name"=> "Pakistan"
            ),
            array(
                "country_id"=> "161",
                "utc"=> "9",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Palau"
            ),
            array(
                "country_id"=> "162",
                "utc"=> "2",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Palestine"
            ),
            array(
                "country_id"=> "163",
                "utc"=> "-5",
                "continent"=> "3",
                "region"=> "central america",
                "name"=> "Panama"
            ),
            array(
                "country_id"=> "164",
                "utc"=> "10",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Papua New Guinea"
            ),
            array(
                "country_id"=> "165",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Paraguay"
            ),
            array(
                "country_id"=> "166",
                "utc"=> "-5",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Peru"
            ),
            array(
                "country_id"=> "167",
                "utc"=> "8",
                "continent"=> "asia",
                "region"=> "south east asia",
                "name"=> "Philippines"
            ),
            array(
                "country_id"=> "168",
                "utc"=> "-8",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Pitcairn"
            ),
            array(
                "country_id"=> "169",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "eastern europe",
                "name"=> "Poland"
            ),
            array(
                "country_id"=> "170",
                "utc"=> "-1",
                "continent"=> "3",
                "region"=> "south west europe",
                "name"=> "Portugal"
            ),
            array(
                "country_id"=> "171",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Puerto Rico"
            ),
            array(
                "country_id"=> "172",
                "utc"=> "3",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Qatar"
            ),
            array(
                "country_id"=> "173",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "central africa",
                "name"=> "Republic of the Congo"
            ),
            array(
                "country_id"=> "174",
                "utc"=> "4",
                "continent"=> "africa",
                "region"=> "indian ocean",
                "name"=> "Reunion"
            ),
            array(
                "country_id"=> "175",
                "utc"=> "2",
                "continent"=> "3",
                "region"=> "south east europe",
                "name"=> "Romania"
            ),
            array(
                "country_id"=> "176",
                "utc"=> "3",
                "continent"=> "asia",
                "region"=> "northern asia",
                "name"=> "Russia"
            ),
            array(
                "country_id"=> "177",
                "utc"=> "2",
                "continent"=> "africa",
                "region"=> "central asia",
                "name"=> "Rwanda"
            ),
            array(
                "country_id"=> "178",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "central america",
                "name"=> "Saint Barthelemy"
            ),
            array(
                "country_id"=> "179",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Saint Helena"
            ),
            array(
                "country_id"=> "180",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Saint Kitts and Nevis"
            ),
            array(
                "country_id"=> "181",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Saint Lucia"
            ),
            array(
                "country_id"=> "182",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "central america",
                "name"=> "Saint Martin"
            ),
            array(
                "country_id"=> "183",
                "utc"=> "-3",
                "continent"=> "3",
                "region"=> "",
                "name"=> "Saint Pierre and Miquelon"
            ),
            array(
                "country_id"=> "184",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Saint Vincent and the Grenadines"
            ),
            array(
                "country_id"=> "185",
                "utc"=> "13",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Samoa"
            ),
            array(
                "country_id"=> "186",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "southern europe",
                "name"=> "San Marino"
            ),
            array(
                "country_id"=> "187",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Sao Tome and Principe"
            ),
            array(
                "country_id"=> "188",
                "utc"=> "3",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Saudi Arabia"
            ),
            array(
                "country_id"=> "189",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Senegal"
            ),
            array(
                "country_id"=> "190",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "south east europe",
                "name"=> "Serbia"
            ),
            array(
                "country_id"=> "191",
                "utc"=> "4",
                "continent"=> "africa",
                "region"=> "indian ocean",
                "name"=> "Seychelles"
            ),
            array(
                "country_id"=> "192",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Sierra Leone"
            ),
            array(
                "country_id"=> "193",
                "utc"=> "8",
                "continent"=> "asia",
                "region"=> "south east asia",
                "name"=> "Singapore"
            ),
            array(
                "country_id"=> "194",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "central america",
                "name"=> "Sint Maarten"
            ),
            array(
                "country_id"=> "195",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "central europe",
                "name"=> "Slovakia"
            ),
            array(
                "country_id"=> "196",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "south east europe",
                "name"=> "Slovenia"
            ),
            array(
                "country_id"=> "197",
                "utc"=> "11",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Solomon Islands"
            ),
            array(
                "country_id"=> "198",
                "utc"=> "3",
                "continent"=> "africa",
                "region"=> "eastern africa",
                "name"=> "Somalia"
            ),
            array(
                "country_id"=> "199",
                "utc"=> "2",
                "continent"=> "africa",
                "region"=> "southern africa",
                "name"=> "South Africa"
            ),
            array(
                "country_id"=> "200",
                "utc"=> "9",
                "continent"=> "asia",
                "region"=> "east asia",
                "name"=> "South Korea"
            ),
            array(
                "country_id"=> "201",
                "utc"=> "3",
                "continent"=> "africa",
                "region"=> "northern africa",
                "name"=> "South Sudan"
            ),
            array(
                "country_id"=> "202",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "south west europe",
                "name"=> "Spain"
            ),
            array(
                "country_id"=> "203",
                "utc"=> "5",
                "continent"=> "asia",
                "region"=> "south asia",
                "name"=> "Sri Lanka"
            ),
            array(
                "country_id"=> "204",
                "utc"=> "3",
                "continent"=> "africa",
                "region"=> "northern africa",
                "name"=> "Sudan"
            ),
            array(
                "country_id"=> "205",
                "utc"=> "-3",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Suriname"
            ),
            array(
                "country_id"=> "206",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "northern europe",
                "name"=> "Svalbard and Jan Mayen"
            ),
            array(
                "country_id"=> "207",
                "utc"=> "2",
                "continent"=> "africa",
                "region"=> "northern africa",
                "name"=> "Swaziland"
            ),
            array(
                "country_id"=> "208",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "northern europe",
                "name"=> "Sweden"
            ),
            array(
                "country_id"=> "209",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "central europe",
                "name"=> "Switzerland"
            ),
            array(
                "country_id"=> "210",
                "utc"=> "2",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Syria"
            ),
            array(
                "country_id"=> "211",
                "utc"=> "8",
                "continent"=> "asia",
                "region"=> "east asia",
                "name"=> "Taiwan"
            ),
            array(
                "country_id"=> "212",
                "utc"=> "5",
                "continent"=> "asia",
                "region"=> "central asia",
                "name"=> "Tajikistan"
            ),
            array(
                "country_id"=> "213",
                "utc"=> "3",
                "continent"=> "africa",
                "region"=> "eastern africa",
                "name"=> "Tanzania"
            ),
            array(
                "country_id"=> "214",
                "utc"=> "7",
                "continent"=> "asia",
                "region"=> "south east asia",
                "name"=> "Thailand"
            ),
            array(
                "country_id"=> "215",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "western africa",
                "name"=> "Togo"
            ),
            array(
                "country_id"=> "216",
                "utc"=> "13",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Tokelau"
            ),
            array(
                "country_id"=> "217",
                "utc"=> "13",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Tonga"
            ),
            array(
                "country_id"=> "218",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Trinidad and Tobago"
            ),
            array(
                "country_id"=> "219",
                "utc"=> "1",
                "continent"=> "africa",
                "region"=> "northern africa",
                "name"=> "Tunisia"
            ),
            array(
                "country_id"=> "220",
                "utc"=> "2",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Turkey"
            ),
            array(
                "country_id"=> "221",
                "utc"=> "5",
                "continent"=> "asia",
                "region"=> "central asia",
                "name"=> "Turkmenistan"
            ),
            array(
                "country_id"=> "222",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "west indies",
                "name"=> "Turks and Caicos Islands"
            ),
            array(
                "country_id"=> "223",
                "utc"=> "12",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Tuvalu"
            ),
            array(
                "country_id"=> "224",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "central america",
                "name"=> "U.S. Virgin Islands"
            ),
            array(
                "country_id"=> "225",
                "utc"=> "3",
                "continent"=> "africa",
                "region"=> "eastern africa",
                "name"=> "Uganda"
            ),
            array(
                "country_id"=> "226",
                "utc"=> "3",
                "continent"=> "3",
                "region"=> "eastern europe",
                "name"=> "Ukraine"
            ),
            array(
                "country_id"=> "227",
                "utc"=> "4",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "United Arab Emirates"
            ),
            array(
                "country_id"=> "228",
                "utc"=> "0",
                "continent"=> "3",
                "region"=> "western europe",
                "name"=> "United Kingdom"
            ),
            array(
                "country_id"=> "229",
                "utc"=> "-5",
                "continent"=> "3",
                "region"=> "north america",
                "name"=> "United States"
            ),
            array(
                "country_id"=> "230",
                "utc"=> "-3",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Uruguay"
            ),
            array(
                "country_id"=> "231",
                "utc"=> "5",
                "continent"=> "asia",
                "region"=> "central asia",
                "name"=> "Uzbekistan"
            ),
            array(
                "country_id"=> "232",
                "utc"=> "11",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Vanuatu"
            ),
            array(
                "country_id"=> "233",
                "utc"=> "1",
                "continent"=> "3",
                "region"=> "southern europe",
                "name"=> "Vatican"
            ),
            array(
                "country_id"=> "234",
                "utc"=> "-4",
                "continent"=> "3",
                "region"=> "south america",
                "name"=> "Venezuela"
            ),
            array(
                "country_id"=> "235",
                "utc"=> "7",
                "continent"=> "asia",
                "region"=> "south east asia",
                "name"=> "Vietnam"
            ),
            array(
                "country_id"=> "236",
                "utc"=> "12",
                "continent"=> "4",
                "region"=> "pacific",
                "name"=> "Wallis and Futuna"
            ),
            array(
                "country_id"=> "237",
                "utc"=> "0",
                "continent"=> "africa",
                "region"=> "northern africa",
                "name"=> "Western Sahara"
            ),
            array(
                "country_id"=> "238",
                "utc"=> "3",
                "continent"=> "asia",
                "region"=> "south west asia",
                "name"=> "Yemen"
            ),
            array(
                "country_id"=> "239",
                "utc"=> "2",
                "continent"=> "africa",
                "region"=> "southern africa",
                "name"=> "Zambia"
            ),
            array(
                "country_id"=> "240",
                "utc"=> "2",
                "continent"=> "africa",
                "region"=> "southern africa",
                "name"=> "Zimbabwe"
            )
        );
        DB::table('countries')->insert($countries);
    }
}
