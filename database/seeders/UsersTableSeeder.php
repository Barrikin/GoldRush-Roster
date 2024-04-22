<?php

namespace Database\Seeders;

use App\Models\Rank;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'call_sign' => 'ADMIN',
                'name'           => 'Berry West',
                'badge' => 000,
                'status' => 1,
                'phone_number' => '555-555-5555',
                'hired_on' => now(),
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);

        $json = json_decode(<<<EOD
	[
		{
			"fname": "Thomas",
			"lname": "Beckett",
			"phone": "8918771414",
			"callsign": "H-05",
			"badgenumber": "247",
			"rank": 3
		},
		{
			"fname": "Richard ",
			"lname": "Pain",
			"phone": "1286058865",
			"callsign": "R-36",
			"badgenumber": "911",
			"rank": 10
		},
		{
			"fname": "Otto",
			"lname": "Dixon",
			"phone": "9889107311",
			"callsign": "R-02",
			"badgenumber": "314",
			"rank": 10
		},
		{
			"fname": "Cole",
			"lname": "West",
			"phone": "3816361685",
			"callsign": "P-95",
			"badgenumber": "579",
			"rank": 8
		},
		{
			"fname": "Parker",
			"lname": "Hall",
			"phone": "5005329579",
			"callsign": "R-08",
			"badgenumber": "003",
			"rank": 10
		},
		{
			"fname": "Colt",
			"lname": "Dallas",
			"phone": "7143897032",
			"callsign": "R-11",
			"badgenumber": "243",
			"rank": 10
		},
		{
			"fname": "Tex",
			"lname": "Howdie",
			"phone": "7081480619",
			"callsign": "P-22",
			"badgenumber": "515",
			"rank": 6
		},
		{
			"fname": "Johnny",
			"lname": "Stars",
			"phone": "3892774409",
			"callsign": "S-04",
			"badgenumber": "378",
			"rank": 6
		},
		{
			"fname": "Thor",
			"lname": "Karlsson",
			"phone": "4877509561",
			"callsign": "P-10",
			"badgenumber": "655",
			"rank": 8
		},
		{
			"fname": "Joe",
			"lname": "King",
			"phone": "5032304926",
			"callsign": "R-18",
			"badgenumber": "120",
			"rank": 8
		},
		{
			"fname": "Randy",
			"lname": "Braxton Jr.",
			"phone": "4762290685",
			"callsign": "P-32",
			"badgenumber": "170",
			"rank": 7
		},
		{
			"fname": "Odin",
			"lname": "Björnsson",
			"phone": "3967264568",
			"callsign": "P-11",
			"badgenumber": "015",
			"rank": 8
		},
		{
			"fname": "Chris",
			"lname": "Ender",
			"phone": "5403720142",
			"callsign": "P-40",
			"badgenumber": "729",
			"rank": 7
		},
		{
			"fname": "Marco",
			"lname": "Belchior",
			"phone": "5225677850",
			"callsign": "T-02",
			"badgenumber": "545",
			"rank": 8
		},
		{
			"fname": "Iron",
			"lname": "Johnson",
			"phone": "6591493474",
			"callsign": "P-15",
			"badgenumber": "119",
			"rank": 8
		},
		{
			"fname": "Larry ",
			"lname": "Flynn",
			"phone": "3776786850",
			"callsign": "P-33",
			"badgenumber": "635",
			"rank": 7
		},
		{
			"fname": "Sayyam ",
			"lname": "Khan",
			"phone": "6529170379",
			"callsign": "H-04",
			"badgenumber": "147",
			"rank": 3
		},
		{
			"fname": "Mateo",
			"lname": "Trevino",
			"phone": "8169870258",
			"callsign": "R-09",
			"badgenumber": "285",
			"rank": 10
		},
		{
			"fname": "Kevin",
			"lname": "Treacy",
			"phone": "6159320057",
			"callsign": "C-09",
			"badgenumber": "246",
			"rank": 5
		},
		{
			"fname": "Qiyana",
			"lname": "Johnson",
			"phone": "5277810585",
			"callsign": "T-07",
			"badgenumber": "027",
			"rank": 10
		},
		{
			"fname": "Ranjit",
			"lname": "Sandeep",
			"phone": "4305110214",
			"callsign": "P-35",
			"badgenumber": "711",
			"rank": 8
		},
		{
			"fname": "Jackson",
			"lname": "Madge",
			"phone": "7571274370",
			"callsign": "P-49",
			"badgenumber": "020",
			"rank": 8
		},
		{
			"fname": "Nico",
			"lname": "Fury",
			"phone": "2593953937",
			"callsign": "P-05",
			"badgenumber": "017",
			"rank": 8
		},
		{
			"fname": "Berry",
			"lname": "West",
			"phone": "1242226609",
			"callsign": "C-01",
			"badgenumber": "342",
			"rank": 5
		},
		{
			"fname": "Joshua",
			"lname": "Campbell",
			"phone": "2802515704",
			"callsign": "T-05",
			"badgenumber": "341",
			"rank": 10
		},
		{
			"fname": "Romeo",
			"lname": "Doofy",
			"phone": "8304188653",
			"callsign": "R-06",
			"badgenumber": "041",
			"rank": 10
		},
		{
			"fname": "Nick",
			"lname": "Elwood",
			"phone": "5505074563",
			"callsign": "P-70",
			"badgenumber": "076",
			"rank": 7
		},
		{
			"fname": "Marcell",
			"lname": "Gwynn",
			"phone": "3979644512",
			"callsign": "P-36",
			"badgenumber": "722",
			"rank": 8
		},
		{
			"fname": "Jackson ",
			"lname": "briggs",
			"phone": "1368079787",
			"callsign": "P-29",
			"badgenumber": "626",
			"rank": 8
		},
		{
			"fname": "Malky",
			"lname": "Fraser",
			"phone": "9437788243",
			"callsign": "R-30",
			"badgenumber": "192",
			"rank": 10
		},
		{
			"fname": "Clank",
			"lname": "Hamm",
			"phone": "4794731612",
			"callsign": "P-16",
			"badgenumber": "882",
			"rank": 8
		},
		{
			"fname": "Vic",
			"lname": "Vega",
			"phone": "8266088234",
			"callsign": "P-75",
			"badgenumber": "884",
			"rank": 8
		},
		{
			"fname": "Julian",
			"lname": "Emmerich",
			"phone": "6667704477",
			"callsign": "C-07",
			"badgenumber": "304",
			"rank": 5
		},
		{
			"fname": "Connor",
			"lname": "Hall",
			"phone": "4942703909",
			"callsign": "P-08",
			"badgenumber": "369",
			"rank": 8
		},
		{
			"fname": "Gunner ",
			"lname": "Gamble",
			"phone": "7273025412",
			"callsign": "S-07",
			"badgenumber": "317",
			"rank": 6
		},
		{
			"fname": "Guadeloupe",
			"lname": "Canteloupe",
			"phone": "1005078081",
			"callsign": "R-24",
			"badgenumber": "669",
			"rank": 10
		},
		{
			"fname": "Thomas",
			"lname": "O'Connor",
			"phone": "6796892864",
			"callsign": "P-90",
			"badgenumber": "881",
			"rank": 8
		},
		{
			"fname": "James",
			"lname": "Marsh",
			"phone": "6661303050",
			"callsign": "R-05",
			"badgenumber": "357",
			"rank": 10
		},
		{
			"fname": "Mabel",
			"lname": "Greene",
			"phone": "5716527761",
			"callsign": "C-08",
			"badgenumber": "449",
			"rank": 5
		},
		{
			"fname": "Greg",
			"lname": "Grimes",
			"phone": "1304319847",
			"callsign": "P-38",
			"badgenumber": "321",
			"rank": 8
		},
		{
			"fname": "Patrick",
			"lname": "Swayze",
			"phone": "9332871327",
			"callsign": "R-14",
			"badgenumber": "697",
			"rank": 10
		},
		{
			"fname": "Walter",
			"lname": "Farley",
			"phone": "5551648095",
			"callsign": "P-01",
			"badgenumber": "885",
			"rank": 8
		},
		{
			"fname": "Jack",
			"lname": "Simmons",
			"phone": "4078434891",
			"callsign": "H-02",
			"badgenumber": "202",
			"rank": 2		},
		{
			"fname": "Scarlett",
			"lname": "White",
			"phone": "7426441258",
			"callsign": "S-05",
			"badgenumber": "312",
			"rank": 6
		},
		{
			"fname": "Robert",
			"lname": "Emmons",
			"phone": "3492720523",
			"callsign": "P-42",
			"badgenumber": "523",
			"rank": 8
		},
		{
			"fname": "Ronald ",
			"lname": "Watson ",
			"phone": "3912526844",
			"callsign": "R-17",
			"badgenumber": "467",
			"rank": 10
		},
		{
			"fname": "Jarod",
			"lname": "Smith",
			"phone": "5069872442",
			"callsign": "R-38",
			"badgenumber": "221",
			"rank": 10
		},
		{
			"fname": "Jacob",
			"lname": "Evans",
			"phone": "5025311709",
			"callsign": "P-12",
			"badgenumber": "420",
			"rank": 8
		},
		{
			"fname": "Dorian",
			"lname": "Murphy",
			"phone": "1019375675",
			"callsign": "R-29",
			"badgenumber": "137",
			"rank": 10
		},
		{
			"fname": "Benjamin",
			"lname": "Karma",
			"phone": "2193647727",
			"callsign": "T-01",
			"badgenumber": "110",
			"rank": 8
		},
		{
			"fname": "Cliff",
			"lname": "Gibson",
			"phone": "2833195453",
			"callsign": "H-01",
			"badgenumber": "519",
			"rank": 1
		},
		{
			"fname": "Mykal",
			"lname": "Seman",
			"phone": "3635453028",
			"callsign": "P-44",
			"badgenumber": "720",
			"rank": 8
		},
		{
			"fname": "Lester",
			"lname": "Dick",
			"phone": "5255298088",
			"callsign": "R-13",
			"badgenumber": "666",
			"rank": 10
		},
		{
			"fname": "David",
			"lname": "Kemper",
			"phone": "6149533257",
			"callsign": "S-09",
			"badgenumber": "225",
			"rank": 10
		},
		{
			"fname": "David ",
			"lname": "Lowenstein",
			"phone": "1082728626",
			"callsign": "P-100",
			"badgenumber": "105",
			"rank": 8
		},
		{
			"fname": "Jak",
			"lname": "Priest",
			"phone": "6587673399",
			"callsign": "P-31",
			"badgenumber": "343",
			"rank": 8
		},
		{
			"fname": "Alec",
			"lname": "Archer",
			"phone": "7863887056",
			"callsign": "P-76",
			"badgenumber": "406",
			"rank": 8
		},
		{
			"fname": "Ryan",
			"lname": "Kim",
			"phone": "2768611435",
			"callsign": "P-54",
			"badgenumber": "613",
			"rank": 8
		},
		{
			"fname": "Kenneth",
			"lname": "Hutchinson",
			"phone": "9153120462",
			"callsign": "T-04",
			"badgenumber": "841",
			"rank": 8
		},
		{
			"fname": "Thomas",
			"lname": "Devoe",
			"phone": "6183027745",
			"callsign": "R-39",
			"badgenumber": "036",
			"rank": 10
		},
		{
			"fname": "Jake",
			"lname": "Shepherd",
			"phone": "9281271492",
			"callsign": "P-03",
			"badgenumber": "200",
			"rank": 8
		},
		{
			"fname": "Alex",
			"lname": "Heartline",
			"phone": "6883919953",
			"callsign": "P-53",
			"badgenumber": "421",
			"rank": 8
		},
		{
			"fname": "Richard",
			"lname": "Carmichael",
			"phone": "3525487040",
			"callsign": "R-16",
			"badgenumber": "602",
			"rank": 10
		},
		{
			"fname": "CJ",
			"lname": "Toppe",
			"phone": "2269121472",
			"callsign": "C-06",
			"badgenumber": "047",
			"rank": 5
		},
		{
			"fname": "Sean",
			"lname": "Moore",
			"phone": "1611926900",
			"callsign": "P-09",
			"badgenumber": "883",
			"rank": 8
		},
		{
			"fname": "Ryan",
			"lname": "Wise",
			"phone": "5436186175",
			"callsign": "C-05",
			"badgenumber": "957",
			"rank": 5
		},
		{
			"fname": "Roman",
			"lname": "Petrov",
			"phone": "6079359239",
			"callsign": "S-08",
			"badgenumber": "111",
			"rank": 6
		},
		{
			"fname": "Jake",
			"lname": "Reynolds",
			"phone": "5678941246",
			"callsign": "R-22",
			"badgenumber": "088",
			"rank": 10
		},
		{
			"fname": "Michael",
			"lname": "Mercer",
			"phone": "2721978418",
			"callsign": "P-96",
			"badgenumber": "713",
			"rank": 8
		},
		{
			"fname": "Tony",
			"lname": "Grimm",
			"phone": "4953812610",
			"callsign": "P-52",
			"badgenumber": "522",
			"rank": 7
		},
		{
			"fname": "Miles",
			"lname": "Tucker",
			"phone": "4895402479",
			"callsign": "T-03",
			"badgenumber": "014",
			"rank": 10
		},
		{
			"fname": "Chris",
			"lname": "Shepherd",
			"phone": "6971186017",
			"callsign": "P-02",
			"badgenumber": "220",
			"rank": 8
		},
		{
			"fname": "Alex",
			"lname": "Rodriguez",
			"phone": "7912025507",
			"callsign": "P-43",
			"badgenumber": "559",
			"rank": 8
		},
		{
			"fname": "Jay",
			"lname": "Smith",
			"phone": "1915112602",
			"callsign": "R-31",
			"badgenumber": "128",
			"rank": 10
		},
		{
			"fname": "Gus",
			"lname": "Stone",
			"phone": "4653774095",
			"callsign": "P-26",
			"badgenumber": "615",
			"rank": 8
		},
		{
			"fname": "Beau ",
			"lname": "Stringfield",
			"phone": "5192309660",
			"callsign": "C-04",
			"badgenumber": "002",
			"rank": 5
		},
		{
			"fname": "Sonja",
			"lname": "Bearsen",
			"phone": "3966014105",
			"callsign": "P-97",
			"badgenumber": "313",
			"rank": 8
		},
		{
			"fname": "Joshua",
			"lname": "Brown",
			"phone": "4725607638",
			"callsign": "P-77",
			"badgenumber": "142",
			"rank": 8
		},
		{
			"fname": "Donal",
			"lname": "Langer",
			"phone": "9929222544",
			"callsign": "C-10",
			"badgenumber": "069",
			"rank": 5
		},
		{
			"fname": "Nathan",
			"lname": "Ox",
			"phone": "5022037515",
			"callsign": "R-23",
			"badgenumber": "747",
			"rank": 8
		},
		{
			"fname": "Aidan",
			"lname": "Yuki",
			"phone": "8096193901",
			"callsign": "P-60",
			"badgenumber": "262",
			"rank": 8
		},
		{
			"fname": "Eli",
			"lname": "Samuel",
			"phone": "2848200517",
			"callsign": "R-28",
			"badgenumber": "888",
			"rank": 10
		},
		{
			"fname": "Ray",
			"lname": "Hilbrand",
			"phone": "9416388512",
			"callsign": "L-01",
			"badgenumber": "991",
			"rank": 10
		},
		{
			"fname": "Caleb",
			"lname": "Jackson",
			"phone": "4523159674",
			"callsign": "S-01",
			"badgenumber": "407",
			"rank": 6
		},
		{
			"fname": "Jake",
			"lname": "Westwood",
			"phone": "9056748508",
			"callsign": "R-37",
			"badgenumber": "112",
			"rank": 10
		},
		{
			"fname": "John",
			"lname": "Miles",
			"phone": "3698807479",
			"callsign": "P-27",
			"badgenumber": "777",
			"rank": 8
		},
		{
			"fname": "Liam",
			"lname": "Montana",
			"phone": "6979931437",
			"callsign": "P-47",
			"badgenumber": "101",
			"rank": 8
		},
		{
			"fname": "Mackenna",
			"lname": "Gibson",
			"phone": "1131029694",
			"callsign": "P-21",
			"badgenumber": "555",
			"rank": 8
		},
		{
			"fname": "Dickie",
			"lname": "Richards",
			"phone": "4186300679",
			"callsign": "P-48",
			"badgenumber": "150",
			"rank": 8
		},
		{
			"fname": "Johnny",
			"lname": "Viddick",
			"phone": "6902513596",
			"callsign": "R-20",
			"badgenumber": "010",
			"rank": 10
		},
		{
			"fname": "Mac",
			"lname": "Tyson",
			"phone": "8684770338",
			"callsign": "P-45",
			"badgenumber": "218",
			"rank": 8
		},
		{
			"fname": "Todd",
			"lname": "Dillerson",
			"phone": "7279710542",
			"callsign": "P-93",
			"badgenumber": "328",
			"rank": 8
		},
		{
			"fname": "Leonardo ",
			"lname": "Reyes",
			"phone": "7056317590",
			"callsign": "P-51",
			"badgenumber": "823",
			"rank": 8
		},
		{
			"fname": "Selena",
			"lname": "Yaki",
			"phone": "5298613778",
			"callsign": "R-21",
			"badgenumber": "415",
			"rank": 10
		},
		{
			"fname": "Grant",
			"lname": "Stone",
			"phone": "8936720379",
			"callsign": "T-06",
			"badgenumber": "035",
			"rank": 10
		},
		{
			"fname": "Jordan",
			"lname": "Colby",
			"phone": "3137823050",
			"callsign": "P-18",
			"badgenumber": "401",
			"rank": 8
		},
		{
			"fname": "Bob",
			"lname": "Sausage",
			"phone": "5683816796",
			"callsign": "P-50",
			"badgenumber": "187",
			"rank": 8
		},
		{
			"fname": "paul",
			"lname": "Bianchelli",
			"phone": "4017327392",
			"callsign": "R-15",
			"badgenumber": "311",
			"rank": 10
		},
		{
			"fname": "Blaise ",
			"lname": "Vieira",
			"phone": "8457286996",
			"callsign": "R-07",
			"badgenumber": "013",
			"rank": 10
		},
		{
			"fname": "Jim",
			"lname": "Carver",
			"phone": "2427493507",
			"callsign": "R-35",
			"badgenumber": "999",
			"rank": 10
		},
		{
			"fname": "John",
			"lname": "Ramos",
			"phone": "3955397946",
			"callsign": "R-03",
			"badgenumber": "672",
			"rank": 10
		},
		{
			"fname": "nova",
			"lname": "johnson",
			"phone": "5363884391",
			"callsign": "P-99",
			"badgenumber": "210",
			"rank": 8
		},
		{
			"fname": "Cruz ",
			"lname": "Ortiz",
			"phone": "2144972736",
			"callsign": "R-27",
			"badgenumber": "206",
			"rank": 10
		}
	]
EOD);
        foreach ($json as $officer)
        {
            $user = User::create([
                'name' => $officer->fname . " " . $officer->lname,
                'phone_number' => $officer->phone,
                'call_sign' => $officer->callsign,
                'badge' => $officer->badgenumber,
                'hired_on' =>  Carbon::now()->format('Y-m-d'),
                'status' => 1,
                'remember_token' => null,
            ]);

            $rank = Rank::find($officer->rank);
            $user->rank()->associate($rank);
            $user->save();

        }
    }
}
