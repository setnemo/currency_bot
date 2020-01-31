<?php

namespace CurrencyUaBot\Traits;

use Exception;

trait CurrencyConvertable
{
    protected $currencyCodeMapping = [
        'code:971' =>
            [
                'aCode' => 'AFN',
                'aName' => 'Afghani',
            ],
        'code:978' =>
            [
                'aCode' => 'EUR',
                'aName' => 'Euro',
            ],
        'code:8' =>
            [
                'aCode' => 'ALL',
                'aName' => 'Lek',
            ],
        'code:12' =>
            [
                'aCode' => 'DZD',
                'aName' => 'Algerian Dinar',
            ],
        'code:840' =>
            [
                'aCode' => 'USD',
                'aName' => 'US Dollar',
            ],
        'code:973' =>
            [
                'aCode' => 'AOA',
                'aName' => 'Kwanza',
            ],
        'code:951' =>
            [
                'aCode' => 'XCD',
                'aName' => 'East Caribbean Dollar',
            ],
        'code:0' =>
            [
                'aCode' => 'XFU',
                'aName' => 'UIC-Franc',
            ],
        'code:32' =>
            [
                'aCode' => 'ARP',
                'aName' => 'Peso Argentino',
            ],
        'code:51' =>
            [
                'aCode' => 'AMD',
                'aName' => 'Armenian Dram',
            ],
        'code:533' =>
            [
                'aCode' => 'AWG',
                'aName' => 'Aruban Florin',
            ],
        'code:36' =>
            [
                'aCode' => 'AUD',
                'aName' => 'Australian Dollar',
            ],
        'code:944' =>
            [
                'aCode' => 'AZN',
                'aName' => 'Azerbaijanian Manat',
            ],
        'code:44' =>
            [
                'aCode' => 'BSD',
                'aName' => 'Bahamian Dollar',
            ],
        'code:48' =>
            [
                'aCode' => 'BHD',
                'aName' => 'Bahraini Dinar',
            ],
        'code:50' =>
            [
                'aCode' => 'BDT',
                'aName' => 'Taka',
            ],
        'code:52' =>
            [
                'aCode' => 'BBD',
                'aName' => 'Barbados Dollar',
            ],
        'code:933' =>
            [
                'aCode' => 'BYN',
                'aName' => 'Belarusian Ruble',
            ],
        'code:84' =>
            [
                'aCode' => 'BZD',
                'aName' => 'Belize Dollar',
            ],
        'code:952' =>
            [
                'aCode' => 'XOF',
                'aName' => 'CFA Franc BCEAO',
            ],
        'code:60' =>
            [
                'aCode' => 'BMD',
                'aName' => 'Bermudian Dollar',
            ],
        'code:356' =>
            [
                'aCode' => 'INR',
                'aName' => 'Indian Rupee',
            ],
        'code:64' =>
            [
                'aCode' => 'BTN',
                'aName' => 'Ngultrum',
            ],
        'code:68' =>
            [
                'aCode' => 'BOB',
                'aName' => 'Boliviano',
            ],
        'code:984' =>
            [
                'aCode' => 'BOV',
                'aName' => 'Mvdol',
            ],
        'code:977' =>
            [
                'aCode' => 'BAM',
                'aName' => 'Convertible Mark',
            ],
        'code:72' =>
            [
                'aCode' => 'BWP',
                'aName' => 'Pula',
            ],
        'code:578' =>
            [
                'aCode' => 'NOK',
                'aName' => 'Norwegian Krone',
            ],
        'code:986' =>
            [
                'aCode' => 'BRL',
                'aName' => 'Brazilian Real',
            ],
        'code:96' =>
            [
                'aCode' => 'BND',
                'aName' => 'Brunei Dollar',
            ],
        'code:975' =>
            [
                'aCode' => 'BGN',
                'aName' => 'Bulgarian Lev',
            ],
        'code:108' =>
            [
                'aCode' => 'BIF',
                'aName' => 'Burundi Franc',
            ],
        'code:132' =>
            [
                'aCode' => 'CVE',
                'aName' => 'Cabo Verde Escudo',
            ],
        'code:116' =>
            [
                'aCode' => 'KHR',
                'aName' => 'Riel',
            ],
        'code:950' =>
            [
                'aCode' => 'XAF',
                'aName' => 'CFA Franc BEAC',
            ],
        'code:124' =>
            [
                'aCode' => 'CAD',
                'aName' => 'Canadian Dollar',
            ],
        'code:136' =>
            [
                'aCode' => 'KYD',
                'aName' => 'Cayman Islands Dollar',
            ],
        'code:152' =>
            [
                'aCode' => 'CLP',
                'aName' => 'Chilean Peso',
            ],
        'code:990' =>
            [
                'aCode' => 'CLF',
                'aName' => 'Unidad de Fomento',
            ],
        'code:156' =>
            [
                'aCode' => 'CNY',
                'aName' => 'Yuan Renminbi',
            ],
        'code:170' =>
            [
                'aCode' => 'COP',
                'aName' => 'Colombian Peso',
            ],
        'code:970' =>
            [
                'aCode' => 'COU',
                'aName' => 'Unidad de Valor Real',
            ],
        'code:174' =>
            [
                'aCode' => 'KMF',
                'aName' => 'Comoro Franc',
            ],
        'code:976' =>
            [
                'aCode' => 'CDF',
                'aName' => 'Congolese Franc',
            ],
        'code:554' =>
            [
                'aCode' => 'NZD',
                'aName' => 'New Zealand Dollar',
            ],
        'code:188' =>
            [
                'aCode' => 'CRC',
                'aName' => 'Costa Rican Colon',
            ],
        'code:191' =>
            [
                'aCode' => 'HRK',
                'aName' => 'Croatian Kuna',
            ],
        'code:192' =>
            [
                'aCode' => 'CUP',
                'aName' => 'Cuban Peso',
            ],
        'code:931' =>
            [
                'aCode' => 'CUC',
                'aName' => 'Peso Convertible',
            ],
        'code:532' =>
            [
                'aCode' => 'ANG',
                'aName' => 'Netherlands Antillean Guilder',
            ],
        'code:203' =>
            [
                'aCode' => 'CZK',
                'aName' => 'Czech Koruna',
            ],
        'code:208' =>
            [
                'aCode' => 'DKK',
                'aName' => 'Danish Krone',
            ],
        'code:262' =>
            [
                'aCode' => 'DJF',
                'aName' => 'Djibouti Franc',
            ],
        'code:214' =>
            [
                'aCode' => 'DOP',
                'aName' => 'Dominican Peso',
            ],
        'code:818' =>
            [
                'aCode' => 'EGP',
                'aName' => 'Egyptian Pound',
            ],
        'code:222' =>
            [
                'aCode' => 'SVC',
                'aName' => 'El Salvador Colon',
            ],
        'code:232' =>
            [
                'aCode' => 'ERN',
                'aName' => 'Nakfa',
            ],
        'code:230' =>
            [
                'aCode' => 'ETB',
                'aName' => 'Ethiopian Birr',
            ],
        'code:238' =>
            [
                'aCode' => 'FKP',
                'aName' => 'Falkland Islands Pound',
            ],
        'code:242' =>
            [
                'aCode' => 'FJD',
                'aName' => 'Fiji Dollar',
            ],
        'code:953' =>
            [
                'aCode' => 'XPF',
                'aName' => 'CFP Franc',
            ],
        'code:270' =>
            [
                'aCode' => 'GMD',
                'aName' => 'Dalasi',
            ],
        'code:981' =>
            [
                'aCode' => 'GEL',
                'aName' => 'Lari',
            ],
        'code:936' =>
            [
                'aCode' => 'GHS',
                'aName' => 'Ghana Cedi',
            ],
        'code:292' =>
            [
                'aCode' => 'GIP',
                'aName' => 'Gibraltar Pound',
            ],
        'code:320' =>
            [
                'aCode' => 'GTQ',
                'aName' => 'Quetzal',
            ],
        'code:826' =>
            [
                'aCode' => 'GBP',
                'aName' => 'Pound Sterling',
            ],
        'code:324' =>
            [
                'aCode' => 'GNF',
                'aName' => 'Guinea Franc',
            ],
        'code:328' =>
            [
                'aCode' => 'GYD',
                'aName' => 'Guyana Dollar',
            ],
        'code:332' =>
            [
                'aCode' => 'HTG',
                'aName' => 'Gourde',
            ],
        'code:340' =>
            [
                'aCode' => 'HNL',
                'aName' => 'Lempira',
            ],
        'code:344' =>
            [
                'aCode' => 'HKD',
                'aName' => 'Hong Kong Dollar',
            ],
        'code:348' =>
            [
                'aCode' => 'HUF',
                'aName' => 'Forint',
            ],
        'code:352' =>
            [
                'aCode' => 'ISK',
                'aName' => 'Iceland Krona',
            ],
        'code:360' =>
            [
                'aCode' => 'IDR',
                'aName' => 'Rupiah',
            ],
        'code:960' =>
            [
                'aCode' => 'XDR',
                'aName' => 'SDR (Special Drawing Right)',
            ],
        'code:364' =>
            [
                'aCode' => 'IRR',
                'aName' => 'Iranian Rial',
            ],
        'code:368' =>
            [
                'aCode' => 'IQD',
                'aName' => 'Iraqi Dinar',
            ],
        'code:376' =>
            [
                'aCode' => 'ILS',
                'aName' => 'New Israeli Sheqel',
            ],
        'code:388' =>
            [
                'aCode' => 'JMD',
                'aName' => 'Jamaican Dollar',
            ],
        'code:392' =>
            [
                'aCode' => 'JPY',
                'aName' => 'Yen',
            ],
        'code:400' =>
            [
                'aCode' => 'JOD',
                'aName' => 'Jordanian Dinar',
            ],
        'code:398' =>
            [
                'aCode' => 'KZT',
                'aName' => 'Tenge',
            ],
        'code:404' =>
            [
                'aCode' => 'KES',
                'aName' => 'Kenyan Shilling',
            ],
        'code:408' =>
            [
                'aCode' => 'KPW',
                'aName' => 'North Korean Won',
            ],
        'code:410' =>
            [
                'aCode' => 'KRW',
                'aName' => 'Won',
            ],
        'code:414' =>
            [
                'aCode' => 'KWD',
                'aName' => 'Kuwaiti Dinar',
            ],
        'code:417' =>
            [
                'aCode' => 'KGS',
                'aName' => 'Som',
            ],
        'code:418' =>
            [
                'aCode' => 'LAK',
                'aName' => 'Kip',
            ],
        'code:422' =>
            [
                'aCode' => 'LBP',
                'aName' => 'Lebanese Pound',
            ],
        'code:426' =>
            [
                'aCode' => 'LSL',
                'aName' => 'Loti',
            ],
        'code:710' =>
            [
                'aCode' => 'ZAR',
                'aName' => 'Rand',
            ],
        'code:430' =>
            [
                'aCode' => 'LRD',
                'aName' => 'Liberian Dollar',
            ],
        'code:434' =>
            [
                'aCode' => 'LYD',
                'aName' => 'Libyan Dinar',
            ],
        'code:756' =>
            [
                'aCode' => 'CHF',
                'aName' => 'Swiss Franc',
            ],
        'code:446' =>
            [
                'aCode' => 'MOP',
                'aName' => 'Pataca',
            ],
        'code:807' =>
            [
                'aCode' => 'MKD',
                'aName' => 'Denar',
            ],
        'code:969' =>
            [
                'aCode' => 'MGA',
                'aName' => 'Malagasy Ariary',
            ],
        'code:454' =>
            [
                'aCode' => 'MWK',
                'aName' => 'Kwacha',
            ],
        'code:458' =>
            [
                'aCode' => 'MYR',
                'aName' => 'Malaysian Ringgit',
            ],
        'code:462' =>
            [
                'aCode' => 'MVR',
                'aName' => 'Rufiyaa',
            ],
        'code:478' =>
            [
                'aCode' => 'MRO',
                'aName' => 'Ouguiya',
            ],
        'code:480' =>
            [
                'aCode' => 'MUR',
                'aName' => 'Mauritius Rupee',
            ],
        'code:965' =>
            [
                'aCode' => 'XUA',
                'aName' => 'ADB Unit of Account',
            ],
        'code:484' =>
            [
                'aCode' => 'MXN',
                'aName' => 'Mexican Peso',
            ],
        'code:979' =>
            [
                'aCode' => 'MXV',
                'aName' => 'Mexican Unidad de Inversion (UDI)',
            ],
        'code:498' =>
            [
                'aCode' => 'MDL',
                'aName' => 'Moldovan Leu',
            ],
        'code:496' =>
            [
                'aCode' => 'MNT',
                'aName' => 'Tugrik',
            ],
        'code:504' =>
            [
                'aCode' => 'MAD',
                'aName' => 'Moroccan Dirham',
            ],
        'code:943' =>
            [
                'aCode' => 'MZN',
                'aName' => 'Mozambique Metical',
            ],
        'code:104' =>
            [
                'aCode' => 'MMK',
                'aName' => 'Kyat',
            ],
        'code:516' =>
            [
                'aCode' => 'NAD',
                'aName' => 'Namibia Dollar',
            ],
        'code:524' =>
            [
                'aCode' => 'NPR',
                'aName' => 'Nepalese Rupee',
            ],
        'code:558' =>
            [
                'aCode' => 'NIO',
                'aName' => 'Cordoba Oro',
            ],
        'code:566' =>
            [
                'aCode' => 'NGN',
                'aName' => 'Naira',
            ],
        'code:512' =>
            [
                'aCode' => 'OMR',
                'aName' => 'Rial Omani',
            ],
        'code:586' =>
            [
                'aCode' => 'PKR',
                'aName' => 'Pakistan Rupee',
            ],
        'code:590' =>
            [
                'aCode' => 'PAB',
                'aName' => 'Balboa',
            ],
        'code:598' =>
            [
                'aCode' => 'PGK',
                'aName' => 'Kina',
            ],
        'code:600' =>
            [
                'aCode' => 'PYG',
                'aName' => 'Guarani',
            ],
        'code:604' =>
            [
                'aCode' => 'PES',
                'aName' => 'Sol',
            ],
        'code:608' =>
            [
                'aCode' => 'PHP',
                'aName' => 'Philippine Peso',
            ],
        'code:985' =>
            [
                'aCode' => 'PLN',
                'aName' => 'Zloty',
            ],
        'code:634' =>
            [
                'aCode' => 'QAR',
                'aName' => 'Qatari Rial',
            ],
        'code:946' =>
            [
                'aCode' => 'RON',
                'aName' => 'New Romanian Leu',
            ],
        'code:643' =>
            [
                'aCode' => 'RUB',
                'aName' => 'Russian Ruble',
            ],
        'code:646' =>
            [
                'aCode' => 'RWF',
                'aName' => 'Rwanda Franc',
            ],
        'code:654' =>
            [
                'aCode' => 'SHP',
                'aName' => 'Saint Helena Pound',
            ],
        'code:882' =>
            [
                'aCode' => 'WST',
                'aName' => 'Tala',
            ],
        'code:678' =>
            [
                'aCode' => 'STD',
                'aName' => 'Dobra',
            ],
        'code:682' =>
            [
                'aCode' => 'SAR',
                'aName' => 'Saudi Riyal',
            ],
        'code:941' =>
            [
                'aCode' => 'RSD',
                'aName' => 'Serbian Dinar',
            ],
        'code:690' =>
            [
                'aCode' => 'SCR',
                'aName' => 'Seychelles Rupee',
            ],
        'code:694' =>
            [
                'aCode' => 'SLL',
                'aName' => 'Leone',
            ],
        'code:702' =>
            [
                'aCode' => 'SGD',
                'aName' => 'Singapore Dollar',
            ],
        'code:994' =>
            [
                'aCode' => 'XSU',
                'aName' => 'Sucre',
            ],
        'code:90' =>
            [
                'aCode' => 'SBD',
                'aName' => 'Solomon Islands Dollar',
            ],
        'code:706' =>
            [
                'aCode' => 'SOS',
                'aName' => 'Somali Shilling',
            ],
        'code:728' =>
            [
                'aCode' => 'SSP',
                'aName' => 'South Sudanese Pound',
            ],
        'code:144' =>
            [
                'aCode' => 'LKR',
                'aName' => 'Sri Lanka Rupee',
            ],
        'code:938' =>
            [
                'aCode' => 'SDG',
                'aName' => 'Sudanese Pound',
            ],
        'code:968' =>
            [
                'aCode' => 'SRD',
                'aName' => 'Surinam Dollar',
            ],
        'code:748' =>
            [
                'aCode' => 'SZL',
                'aName' => 'Lilangeni',
            ],
        'code:752' =>
            [
                'aCode' => 'SEK',
                'aName' => 'Swedish Krona',
            ],
        'code:947' =>
            [
                'aCode' => 'CHE',
                'aName' => 'WIR Euro',
            ],
        'code:948' =>
            [
                'aCode' => 'CHC',
                'aName' => 'WIR Franc (for electronic)',
            ],
        'code:760' =>
            [
                'aCode' => 'SYP',
                'aName' => 'Syrian Pound',
            ],
        'code:901' =>
            [
                'aCode' => 'TWD',
                'aName' => 'New Taiwan Dollar',
            ],
        'code:972' =>
            [
                'aCode' => 'TJS',
                'aName' => 'Somoni',
            ],
        'code:834' =>
            [
                'aCode' => 'TZS',
                'aName' => 'Tanzanian Shilling',
            ],
        'code:764' =>
            [
                'aCode' => 'THB',
                'aName' => 'Baht',
            ],
        'code:776' =>
            [
                'aCode' => 'TOP',
                'aName' => 'Pa’anga',
            ],
        'code:780' =>
            [
                'aCode' => 'TTD',
                'aName' => 'Trinidad and Tobago Dollar',
            ],
        'code:788' =>
            [
                'aCode' => 'TND',
                'aName' => 'Tunisian Dinar',
            ],
        'code:949' =>
            [
                'aCode' => 'TRY',
                'aName' => 'New Turkish Lira',
            ],
        'code:934' =>
            [
                'aCode' => 'TMT',
                'aName' => 'Turkmenistan New Manat',
            ],
        'code:800' =>
            [
                'aCode' => 'UGX',
                'aName' => 'Uganda Shilling',
            ],
        'code:980' =>
            [
                'aCode' => 'UAH',
                'aName' => 'Hryvnia',
            ],
        'code:784' =>
            [
                'aCode' => 'AED',
                'aName' => 'UAE Dirham',
            ],
        'code:997' =>
            [
                'aCode' => 'USN',
                'aName' => 'US Dollar (Next day)',
            ],
        'code:858' =>
            [
                'aCode' => 'UYU',
                'aName' => 'Peso Uruguayo',
            ],
        'code:940' =>
            [
                'aCode' => 'UYI',
                'aName' => 'Uruguay Peso en Unidades Indexadas (URUIURUI)',
            ],
        'code:860' =>
            [
                'aCode' => 'UZS',
                'aName' => 'Uzbekistan Sum',
            ],
        'code:548' =>
            [
                'aCode' => 'VUV',
                'aName' => 'Vatu',
            ],
        'code:937' =>
            [
                'aCode' => 'VEF',
                'aName' => 'Bolivar',
            ],
        'code:704' =>
            [
                'aCode' => 'VND',
                'aName' => 'Dong',
            ],
        'code:886' =>
            [
                'aCode' => 'YER',
                'aName' => 'Yemeni Rial',
            ],
        'code:967' =>
            [
                'aCode' => 'ZMW',
                'aName' => 'Zambian Kwacha',
            ],
        'code:932' =>
            [
                'aCode' => 'ZWL',
                'aName' => 'Zimbabwe Dollar',
            ],
        'code:955' =>
            [
                'aCode' => 'XBA',
                'aName' => 'Bond Markets Unit European Composite Unit (EURCO)',
            ],
        'code:956' =>
            [
                'aCode' => 'XBB',
                'aName' => 'Bond Markets Unit European Monetary Unit (E.M.U.-6)',
            ],
        'code:957' =>
            [
                'aCode' => 'XBC',
                'aName' => 'Bond Markets Unit European Unit of Account 9 (E.U.A.-9)',
            ],
        'code:958' =>
            [
                'aCode' => 'XBD',
                'aName' => 'Bond Markets Unit European Unit of Account 17 (E.U.A.-17)',
            ],
        'code:963' =>
            [
                'aCode' => 'XTS',
                'aName' => 'Codes specifically reserved for testing purposes',
            ],
        'code:999' =>
            [
                'aCode' => 'XXX',
                'aName' => 'The codes assigned for transactions where no currency is involved',
            ],
        'code:959' =>
            [
                'aCode' => 'XAU',
                'aName' => 'Gold',
            ],
        'code:964' =>
            [
                'aCode' => 'XPD',
                'aName' => 'Palladium',
            ],
        'code:962' =>
            [
                'aCode' => 'XPT',
                'aName' => 'Platinum',
            ],
        'code:961' =>
            [
                'aCode' => 'XAG',
                'aName' => 'Silver',
            ],
        'code:4' =>
            [
                'aCode' => 'AFA',
                'aName' => 'Afghani',
            ],
        'code:246' =>
            [
                'aCode' => 'FIM',
                'aName' => 'Markka',
            ],
        'code:20' =>
            [
                'aCode' => 'ADP',
                'aName' => 'Andorran Peseta',
            ],
        'code:724' =>
            [
                'aCode' => 'ESP',
                'aName' => 'Spanish Peseta',
            ],
        'code:250' =>
            [
                'aCode' => 'FRF',
                'aName' => 'French Franc',
            ],
        'code:24' =>
            [
                'aCode' => 'AON',
                'aName' => 'New Kwanza',
            ],
        'code:982' =>
            [
                'aCode' => 'AOR',
                'aName' => 'Kwanza Reajustado',
            ],
        'code:810' =>
            [
                'aCode' => 'RUR',
                'aName' => 'Russian Ruble',
            ],
        'code:40' =>
            [
                'aCode' => 'ATS',
                'aName' => 'Schilling',
            ],
        'code:945' =>
            [
                'aCode' => 'AYM',
                'aName' => 'Azerbaijan Manat',
            ],
        'code:31' =>
            [
                'aCode' => 'AZM',
                'aName' => 'Azerbaijanian Manat',
            ],
        'code:974' =>
            [
                'aCode' => 'BYR',
                'aName' => 'Belarusian Ruble',
            ],
        'code:112' =>
            [
                'aCode' => 'BYB',
                'aName' => 'Belarusian Ruble',
            ],
        'code:993' =>
            [
                'aCode' => 'BEC',
                'aName' => 'Convertible Franc',
            ],
        'code:56' =>
            [
                'aCode' => 'BEF',
                'aName' => 'Belgian Franc',
            ],
        'code:992' =>
            [
                'aCode' => 'BEL',
                'aName' => 'Financial Franc',
            ],
        'code:70' =>
            [
                'aCode' => 'BAD',
                'aName' => 'Dinar',
            ],
        'code:76' =>
            [
                'aCode' => 'BRN',
                'aName' => 'New Cruzado',
            ],
        'code:987' =>
            [
                'aCode' => 'BRR',
                'aName' => 'Cruzeiro Real',
            ],
        'code:100' =>
            [
                'aCode' => 'BGL',
                'aName' => 'Lev',
            ],
        'code:196' =>
            [
                'aCode' => 'CYP',
                'aName' => 'Cyprus Pound',
            ],
        'code:200' =>
            [
                'aCode' => 'CSK',
                'aName' => 'Koruna',
            ],
        'code:218' =>
            [
                'aCode' => 'ECS',
                'aName' => 'Sucre',
            ],
        'code:983' =>
            [
                'aCode' => 'ECV',
                'aName' => 'Unidad de Valor Constante (UVC)',
            ],
        'code:226' =>
            [
                'aCode' => 'GQE',
                'aName' => 'Ekwele',
            ],
        'code:233' =>
            [
                'aCode' => 'EEK',
                'aName' => 'Kroon',
            ],
        'code:954' =>
            [
                'aCode' => 'XEU',
                'aName' => 'European Currency Unit (E.C.U)',
            ],
        'code:268' =>
            [
                'aCode' => 'GEK',
                'aName' => 'Georgian Coupon',
            ],
        'code:278' =>
            [
                'aCode' => 'DDM',
                'aName' => 'Mark der DDR',
            ],
        'code:276' =>
            [
                'aCode' => 'DEM',
                'aName' => 'Deutsche Mark',
            ],
        'code:288' =>
            [
                'aCode' => 'GHC',
                'aName' => 'Cedi',
            ],
        'code:939' =>
            [
                'aCode' => 'GHP',
                'aName' => 'Ghana Cedi',
            ],
        'code:300' =>
            [
                'aCode' => 'GRD',
                'aName' => 'Drachma',
            ],
        'code:624' =>
            [
                'aCode' => 'GWP',
                'aName' => 'Guinea-Bissau Peso',
            ],
        'code:380' =>
            [
                'aCode' => 'ITL',
                'aName' => 'Italian Lira',
            ],
        'code:372' =>
            [
                'aCode' => 'IEP',
                'aName' => 'Irish Pound',
            ],
        'code:428' =>
            [
                'aCode' => 'LVR',
                'aName' => 'Latvian Ruble',
            ],
        'code:991' =>
            [
                'aCode' => 'ZAL',
                'aName' => 'Financial Rand',
            ],
        'code:440' =>
            [
                'aCode' => 'LTT',
                'aName' => 'Talonas',
            ],
        'code:989' =>
            [
                'aCode' => 'LUC',
                'aName' => 'Luxembourg Convertible Franc',
            ],
        'code:442' =>
            [
                'aCode' => 'LUF',
                'aName' => 'Luxembourg Franc',
            ],
        'code:988' =>
            [
                'aCode' => 'LUL',
                'aName' => 'Luxembourg Financial Franc',
            ],
        'code:450' =>
            [
                'aCode' => 'MGF',
                'aName' => 'Malagasy Franc',
            ],
        'code:466' =>
            [
                'aCode' => 'MLF',
                'aName' => 'Mali Franc',
            ],
        'code:470' =>
            [
                'aCode' => 'MTL',
                'aName' => 'Maltese Lira',
            ],
        'code:508' =>
            [
                'aCode' => 'MZM',
                'aName' => 'Mozambique Metical',
            ],
        'code:528' =>
            [
                'aCode' => 'NLG',
                'aName' => 'Netherlands Guilder',
            ],
        'code:616' =>
            [
                'aCode' => 'PLZ',
                'aName' => 'Zloty',
            ],
        'code:620' =>
            [
                'aCode' => 'PTE',
                'aName' => 'Portuguese Escudo',
            ],
        'code:642' =>
            [
                'aCode' => 'ROL',
                'aName' => 'Old Leu',
            ],
        'code:891' =>
            [
                'aCode' => 'YUM',
                'aName' => 'New Dinar',
            ],
        'code:703' =>
            [
                'aCode' => 'SKK',
                'aName' => 'Slovak Koruna',
            ],
        'code:705' =>
            [
                'aCode' => 'SIT',
                'aName' => 'Tolar',
            ],
        'code:996' =>
            [
                'aCode' => 'ESA',
                'aName' => 'Spanish Peseta',
            ],
        'code:995' =>
            [
                'aCode' => 'ESB',
                'aName' => '"A" Account (convertible Peseta Account)',
            ],
        'code:736' =>
            [
                'aCode' => 'SDD',
                'aName' => 'Sudanese Dinar',
            ],
        'code:740' =>
            [
                'aCode' => 'SRG',
                'aName' => 'Surinam Guilder',
            ],
        'code:762' =>
            [
                'aCode' => 'TJR',
                'aName' => 'Tajik Ruble',
            ],
        'code:626' =>
            [
                'aCode' => 'TPE',
                'aName' => 'Timor Escudo',
            ],
        'code:792' =>
            [
                'aCode' => 'TRL',
                'aName' => 'Old Turkish Lira',
            ],
        'code:795' =>
            [
                'aCode' => 'TMM',
                'aName' => 'Turkmenistan Manat',
            ],
        'code:804' =>
            [
                'aCode' => 'UAK',
                'aName' => 'Karbovanet',
            ],
        'code:998' =>
            [
                'aCode' => 'USS',
                'aName' => 'US Dollar (Same day)',
            ],
        'code:862' =>
            [
                'aCode' => 'VEB',
                'aName' => 'Bolivar',
            ],
        'code:720' =>
            [
                'aCode' => 'YDD',
                'aName' => 'Yemeni Dinar',
            ],
        'code:890' =>
            [
                'aCode' => 'YUN',
                'aName' => 'Yugoslavian Dinar',
            ],
        'code:180' =>
            [
                'aCode' => 'ZRZ',
                'aName' => 'Zaire',
            ],
        'code:894' =>
            [
                'aCode' => 'ZMK',
                'aName' => 'Zambian Kwacha',
            ],
        'code:716' =>
            [
                'aCode' => 'ZWD',
                'aName' => 'Zimbabwe Dollar',
            ],
        'code:942' =>
            [
                'aCode' => 'ZWN',
                'aName' => 'Zimbabwe Dollar (new)',
            ],
        'code:935' =>
            [
                'aCode' => 'ZWR',
                'aName' => 'Zimbabwe Dollar',
            ],
    ];

    /**
     * @param int $code
     * @return string
     * @throws Exception
     */
    protected function getCurrencyAlphabeticCode(int $code): string
    {
        if (array_key_exists("code:$code", $this->currencyCodeMapping)) {
            return $this->currencyCodeMapping["code:$code"]['aCode'] ?? '';
        }

        throw new Exception("Currency mapping ISO 4217 (without withdrawal codes) not contains $code");
    }


}