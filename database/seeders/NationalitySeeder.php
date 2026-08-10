<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->nationalities() as $key => $name) {
            Nationality::updateOrCreate(
                ['id' => $key + 1],
                ['name' => $name]
            );
        }
    }

    public function nationalities(): array
    {
        return [
            "Afghan", "Albanian", "Algerian", "Andorran", "Angolan", "Antiguan and Barbudan",
            "Argentinian", "Armenian", "Australian", "Austrian", "Azerbaijani", "Bahamian",
            "Bahraini", "Bangladeshi", "Barbadian", "Belarusian", "Belgian", "Belizean", "Beninese",
            "Bhutanese", "Bolivian", "Bosnian and Herzegovinian", "Motswana", "Brazilian",
            "Bruneian", "Bulgarian", "Burkinabé", "Burundian", "Caboverdean", "Cambodian", "Cameroonian",
            "Canadian", "Central African", "Chadian", "Chilean", "Chinese", "Colombian", "Comoran", "Congolese",
            "Costa Rican", "Croatian", "Cuban", "Cypriot", "Czech", "Danish", "Djiboutian",
            "Dominican", "Timorese", "Ecuadorian", "Egyptian", "Salvadoran", "Equatorial Guinean", "Eritrean",
            "Estonian", "Eswatini", "Ethiopian", "Fijian", "Finnish", "French", "Gabonese", "Gambian", "Georgian",
            "German", "Ghanaian", "Greek", "Grenadian", "Guatemalan", "Guinean", "Guinea-Bissauan", "Guyanese",
            "Haitian", "Honduran", "Hungarian", "Icelandic", "Indian", "Indonesian", "Iranian", "Iraqi", "Irish",
            "Italian", "Ivorian", "Jamaican", "Japanese", "Jordanian", "Kazakhstani", "Kenyan",
            "I-Kiribati", "Korean", "North Korean", "South Korean", "Kosovar", "Kuwaiti", "Kyrgyz", "Lao", "Latvian",
            "Lebanese", "Basotho", "Liberian", "Libyan", "Liechtensteiner", "Lithuanian", "Luxembourger",
            "Malagasy", "Malawian", "Malaysian", "Maldivian", "Malian", "Maltese", "Marshallese", "Mauritanian",
            "Mauritian", "Mexican", "Micronesian", "Moldovan", "Monégasque", "Mongolian", "Montenegrin",
            "Moroccan", "Mozambican", "Burmese", "Namibian", "Nauruan", "Nepalese", "Dutch", "New Zealand",
            "Nicaraguan", "Nigerien", "Nigerian", "North Macedonian", "Norwegian", "Omani", "Pakistani", "Palauan",
            "Palestinian", "Panamanian", "Papua New Guinean", "Paraguayan", "Peruvian", "Filipino", "Polish",
            "Portuguese", "Qatari", "Romanian", "Russian", "Rwandan", "Saint Kittian and Nevisian", "Saint Lucian",
            "Saint Vincent and the Grenadines", "Samoan", "San Marinese", "São Toméan", "Saudi", "Senegalese",
            "Serbian", "Seychellois", "Sierra Leonean", "Singaporean", "Slovak", "Slovenian", "Solomon Islander",
            "Somali", "South African", "South Sudanese", "Spanish", "Sri Lankan", "Sudanese", "Surinamese", "Swedish",
            "Swiss", "Syrian", "Tajikistani", "Tanzanian", "Thai", "Togolese", "Tongan", "Trinidadian or Tobagonian",
            "Tunisian", "Turkish", "Turkmen", "Tuvaluan", "Ugandan", "Ukrainian", "Emirian", "British", "American",
            "Uruguayan", "Uzbekistani", "Ni-Vanuatu", "Vatican", "Venezuelan", "Vietnamese", "Yemeni", "Zambian",
            "Zimbabwean"
        ];
    }
}
