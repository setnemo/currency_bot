<?php

namespace CurrencyUaBot\Helpers;

trait CurrencyConvertable
{
    protected $currencyCodeMapping = array (
        'code:971' =>
            array (
                'aCode' => 'AFN',
                'aName' => 'Afghani',
            ),
        'code:978' =>
            array (
                'aCode' => 'EUR',
                'aName' => 'Euro',
            ),
        'code:8' =>
            array (
                'aCode' => 'ALL',
                'aName' => 'Lek',
            ),
        'code:12' =>
            array (
                'aCode' => 'DZD',
                'aName' => 'Algerian Dinar',
            ),
        'code:840' =>
            array (
                'aCode' => 'USD',
                'aName' => 'US Dollar',
            ),
        'code:973' =>
            array (
                'aCode' => 'AOA',
                'aName' => 'Kwanza',
            ),
        'code:951' =>
            array (
                'aCode' => 'XCD',
                'aName' => 'East Caribbean Dollar',
            ),
        'code:0' =>
            array (
                'aCode' => 'XFU',
                'aName' => 'UIC-Franc',
            ),
        'code:32' =>
            array (
                'aCode' => 'ARP',
                'aName' => 'Peso Argentino',
            ),
        'code:51' =>
            array (
                'aCode' => 'AMD',
                'aName' => 'Armenian Dram',
            ),
        'code:533' =>
            array (
                'aCode' => 'AWG',
                'aName' => 'Aruban Florin',
            ),
        'code:36' =>
            array (
                'aCode' => 'AUD',
                'aName' => 'Australian Dollar',
            ),
        'code:944' =>
            array (
                'aCode' => 'AZN',
                'aName' => 'Azerbaijanian Manat',
            ),
        'code:44' =>
            array (
                'aCode' => 'BSD',
                'aName' => 'Bahamian Dollar',
            ),
        'code:48' =>
            array (
                'aCode' => 'BHD',
                'aName' => 'Bahraini Dinar',
            ),
        'code:50' =>
            array (
                'aCode' => 'BDT',
                'aName' => 'Taka',
            ),
        'code:52' =>
            array (
                'aCode' => 'BBD',
                'aName' => 'Barbados Dollar',
            ),
        'code:933' =>
            array (
                'aCode' => 'BYN',
                'aName' => 'Belarusian Ruble',
            ),
        'code:84' =>
            array (
                'aCode' => 'BZD',
                'aName' => 'Belize Dollar',
            ),
        'code:952' =>
            array (
                'aCode' => 'XOF',
                'aName' => 'CFA Franc BCEAO',
            ),
        'code:60' =>
            array (
                'aCode' => 'BMD',
                'aName' => 'Bermudian Dollar',
            ),
        'code:356' =>
            array (
                'aCode' => 'INR',
                'aName' => 'Indian Rupee',
            ),
        'code:64' =>
            array (
                'aCode' => 'BTN',
                'aName' => 'Ngultrum',
            ),
        'code:68' =>
            array (
                'aCode' => 'BOB',
                'aName' => 'Boliviano',
            ),
        'code:984' =>
            array (
                'aCode' => 'BOV',
                'aName' => 'Mvdol',
            ),
        'code:977' =>
            array (
                'aCode' => 'BAM',
                'aName' => 'Convertible Mark',
            ),
        'code:72' =>
            array (
                'aCode' => 'BWP',
                'aName' => 'Pula',
            ),
        'code:578' =>
            array (
                'aCode' => 'NOK',
                'aName' => 'Norwegian Krone',
            ),
        'code:986' =>
            array (
                'aCode' => 'BRL',
                'aName' => 'Brazilian Real',
            ),
        'code:96' =>
            array (
                'aCode' => 'BND',
                'aName' => 'Brunei Dollar',
            ),
        'code:975' =>
            array (
                'aCode' => 'BGN',
                'aName' => 'Bulgarian Lev',
            ),
        'code:108' =>
            array (
                'aCode' => 'BIF',
                'aName' => 'Burundi Franc',
            ),
        'code:132' =>
            array (
                'aCode' => 'CVE',
                'aName' => 'Cabo Verde Escudo',
            ),
        'code:116' =>
            array (
                'aCode' => 'KHR',
                'aName' => 'Riel',
            ),
        'code:950' =>
            array (
                'aCode' => 'XAF',
                'aName' => 'CFA Franc BEAC',
            ),
        'code:124' =>
            array (
                'aCode' => 'CAD',
                'aName' => 'Canadian Dollar',
            ),
        'code:136' =>
            array (
                'aCode' => 'KYD',
                'aName' => 'Cayman Islands Dollar',
            ),
        'code:152' =>
            array (
                'aCode' => 'CLP',
                'aName' => 'Chilean Peso',
            ),
        'code:990' =>
            array (
                'aCode' => 'CLF',
                'aName' => 'Unidad de Fomento',
            ),
        'code:156' =>
            array (
                'aCode' => 'CNY',
                'aName' => 'Yuan Renminbi',
            ),
        'code:170' =>
            array (
                'aCode' => 'COP',
                'aName' => 'Colombian Peso',
            ),
        'code:970' =>
            array (
                'aCode' => 'COU',
                'aName' => 'Unidad de Valor Real',
            ),
        'code:174' =>
            array (
                'aCode' => 'KMF',
                'aName' => 'Comoro Franc',
            ),
        'code:976' =>
            array (
                'aCode' => 'CDF',
                'aName' => 'Congolese Franc',
            ),
        'code:554' =>
            array (
                'aCode' => 'NZD',
                'aName' => 'New Zealand Dollar',
            ),
        'code:188' =>
            array (
                'aCode' => 'CRC',
                'aName' => 'Costa Rican Colon',
            ),
        'code:191' =>
            array (
                'aCode' => 'HRK',
                'aName' => 'Croatian Kuna',
            ),
        'code:192' =>
            array (
                'aCode' => 'CUP',
                'aName' => 'Cuban Peso',
            ),
        'code:931' =>
            array (
                'aCode' => 'CUC',
                'aName' => 'Peso Convertible',
            ),
        'code:532' =>
            array (
                'aCode' => 'ANG',
                'aName' => 'Netherlands Antillean Guilder',
            ),
        'code:203' =>
            array (
                'aCode' => 'CZK',
                'aName' => 'Czech Koruna',
            ),
        'code:208' =>
            array (
                'aCode' => 'DKK',
                'aName' => 'Danish Krone',
            ),
        'code:262' =>
            array (
                'aCode' => 'DJF',
                'aName' => 'Djibouti Franc',
            ),
        'code:214' =>
            array (
                'aCode' => 'DOP',
                'aName' => 'Dominican Peso',
            ),
        'code:818' =>
            array (
                'aCode' => 'EGP',
                'aName' => 'Egyptian Pound',
            ),
        'code:222' =>
            array (
                'aCode' => 'SVC',
                'aName' => 'El Salvador Colon',
            ),
        'code:232' =>
            array (
                'aCode' => 'ERN',
                'aName' => 'Nakfa',
            ),
        'code:230' =>
            array (
                'aCode' => 'ETB',
                'aName' => 'Ethiopian Birr',
            ),
        'code:238' =>
            array (
                'aCode' => 'FKP',
                'aName' => 'Falkland Islands Pound',
            ),
        'code:242' =>
            array (
                'aCode' => 'FJD',
                'aName' => 'Fiji Dollar',
            ),
        'code:953' =>
            array (
                'aCode' => 'XPF',
                'aName' => 'CFP Franc',
            ),
        'code:270' =>
            array (
                'aCode' => 'GMD',
                'aName' => 'Dalasi',
            ),
        'code:981' =>
            array (
                'aCode' => 'GEL',
                'aName' => 'Lari',
            ),
        'code:936' =>
            array (
                'aCode' => 'GHS',
                'aName' => 'Ghana Cedi',
            ),
        'code:292' =>
            array (
                'aCode' => 'GIP',
                'aName' => 'Gibraltar Pound',
            ),
        'code:320' =>
            array (
                'aCode' => 'GTQ',
                'aName' => 'Quetzal',
            ),
        'code:826' =>
            array (
                'aCode' => 'GBP',
                'aName' => 'Pound Sterling',
            ),
        'code:324' =>
            array (
                'aCode' => 'GNF',
                'aName' => 'Guinea Franc',
            ),
        'code:328' =>
            array (
                'aCode' => 'GYD',
                'aName' => 'Guyana Dollar',
            ),
        'code:332' =>
            array (
                'aCode' => 'HTG',
                'aName' => 'Gourde',
            ),
        'code:340' =>
            array (
                'aCode' => 'HNL',
                'aName' => 'Lempira',
            ),
        'code:344' =>
            array (
                'aCode' => 'HKD',
                'aName' => 'Hong Kong Dollar',
            ),
        'code:348' =>
            array (
                'aCode' => 'HUF',
                'aName' => 'Forint',
            ),
        'code:352' =>
            array (
                'aCode' => 'ISK',
                'aName' => 'Iceland Krona',
            ),
        'code:360' =>
            array (
                'aCode' => 'IDR',
                'aName' => 'Rupiah',
            ),
        'code:960' =>
            array (
                'aCode' => 'XDR',
                'aName' => 'SDR (Special Drawing Right)',
            ),
        'code:364' =>
            array (
                'aCode' => 'IRR',
                'aName' => 'Iranian Rial',
            ),
        'code:368' =>
            array (
                'aCode' => 'IQD',
                'aName' => 'Iraqi Dinar',
            ),
        'code:376' =>
            array (
                'aCode' => 'ILS',
                'aName' => 'New Israeli Sheqel',
            ),
        'code:388' =>
            array (
                'aCode' => 'JMD',
                'aName' => 'Jamaican Dollar',
            ),
        'code:392' =>
            array (
                'aCode' => 'JPY',
                'aName' => 'Yen',
            ),
        'code:400' =>
            array (
                'aCode' => 'JOD',
                'aName' => 'Jordanian Dinar',
            ),
        'code:398' =>
            array (
                'aCode' => 'KZT',
                'aName' => 'Tenge',
            ),
        'code:404' =>
            array (
                'aCode' => 'KES',
                'aName' => 'Kenyan Shilling',
            ),
        'code:408' =>
            array (
                'aCode' => 'KPW',
                'aName' => 'North Korean Won',
            ),
        'code:410' =>
            array (
                'aCode' => 'KRW',
                'aName' => 'Won',
            ),
        'code:414' =>
            array (
                'aCode' => 'KWD',
                'aName' => 'Kuwaiti Dinar',
            ),
        'code:417' =>
            array (
                'aCode' => 'KGS',
                'aName' => 'Som',
            ),
        'code:418' =>
            array (
                'aCode' => 'LAK',
                'aName' => 'Kip',
            ),
        'code:422' =>
            array (
                'aCode' => 'LBP',
                'aName' => 'Lebanese Pound',
            ),
        'code:426' =>
            array (
                'aCode' => 'LSL',
                'aName' => 'Loti',
            ),
        'code:710' =>
            array (
                'aCode' => 'ZAR',
                'aName' => 'Rand',
            ),
        'code:430' =>
            array (
                'aCode' => 'LRD',
                'aName' => 'Liberian Dollar',
            ),
        'code:434' =>
            array (
                'aCode' => 'LYD',
                'aName' => 'Libyan Dinar',
            ),
        'code:756' =>
            array (
                'aCode' => 'CHF',
                'aName' => 'Swiss Franc',
            ),
        'code:446' =>
            array (
                'aCode' => 'MOP',
                'aName' => 'Pataca',
            ),
        'code:807' =>
            array (
                'aCode' => 'MKD',
                'aName' => 'Denar',
            ),
        'code:969' =>
            array (
                'aCode' => 'MGA',
                'aName' => 'Malagasy Ariary',
            ),
        'code:454' =>
            array (
                'aCode' => 'MWK',
                'aName' => 'Kwacha',
            ),
        'code:458' =>
            array (
                'aCode' => 'MYR',
                'aName' => 'Malaysian Ringgit',
            ),
        'code:462' =>
            array (
                'aCode' => 'MVR',
                'aName' => 'Rufiyaa',
            ),
        'code:478' =>
            array (
                'aCode' => 'MRO',
                'aName' => 'Ouguiya',
            ),
        'code:480' =>
            array (
                'aCode' => 'MUR',
                'aName' => 'Mauritius Rupee',
            ),
        'code:965' =>
            array (
                'aCode' => 'XUA',
                'aName' => 'ADB Unit of Account',
            ),
        'code:484' =>
            array (
                'aCode' => 'MXN',
                'aName' => 'Mexican Peso',
            ),
        'code:979' =>
            array (
                'aCode' => 'MXV',
                'aName' => 'Mexican Unidad de Inversion (UDI)',
            ),
        'code:498' =>
            array (
                'aCode' => 'MDL',
                'aName' => 'Moldovan Leu',
            ),
        'code:496' =>
            array (
                'aCode' => 'MNT',
                'aName' => 'Tugrik',
            ),
        'code:504' =>
            array (
                'aCode' => 'MAD',
                'aName' => 'Moroccan Dirham',
            ),
        'code:943' =>
            array (
                'aCode' => 'MZN',
                'aName' => 'Mozambique Metical',
            ),
        'code:104' =>
            array (
                'aCode' => 'MMK',
                'aName' => 'Kyat',
            ),
        'code:516' =>
            array (
                'aCode' => 'NAD',
                'aName' => 'Namibia Dollar',
            ),
        'code:524' =>
            array (
                'aCode' => 'NPR',
                'aName' => 'Nepalese Rupee',
            ),
        'code:558' =>
            array (
                'aCode' => 'NIO',
                'aName' => 'Cordoba Oro',
            ),
        'code:566' =>
            array (
                'aCode' => 'NGN',
                'aName' => 'Naira',
            ),
        'code:512' =>
            array (
                'aCode' => 'OMR',
                'aName' => 'Rial Omani',
            ),
        'code:586' =>
            array (
                'aCode' => 'PKR',
                'aName' => 'Pakistan Rupee',
            ),
        'code:590' =>
            array (
                'aCode' => 'PAB',
                'aName' => 'Balboa',
            ),
        'code:598' =>
            array (
                'aCode' => 'PGK',
                'aName' => 'Kina',
            ),
        'code:600' =>
            array (
                'aCode' => 'PYG',
                'aName' => 'Guarani',
            ),
        'code:604' =>
            array (
                'aCode' => 'PES',
                'aName' => 'Sol',
            ),
        'code:608' =>
            array (
                'aCode' => 'PHP',
                'aName' => 'Philippine Peso',
            ),
        'code:985' =>
            array (
                'aCode' => 'PLN',
                'aName' => 'Zloty',
            ),
        'code:634' =>
            array (
                'aCode' => 'QAR',
                'aName' => 'Qatari Rial',
            ),
        'code:946' =>
            array (
                'aCode' => 'RON',
                'aName' => 'New Romanian Leu',
            ),
        'code:643' =>
            array (
                'aCode' => 'RUB',
                'aName' => 'Russian Ruble',
            ),
        'code:646' =>
            array (
                'aCode' => 'RWF',
                'aName' => 'Rwanda Franc',
            ),
        'code:654' =>
            array (
                'aCode' => 'SHP',
                'aName' => 'Saint Helena Pound',
            ),
        'code:882' =>
            array (
                'aCode' => 'WST',
                'aName' => 'Tala',
            ),
        'code:678' =>
            array (
                'aCode' => 'STD',
                'aName' => 'Dobra',
            ),
        'code:682' =>
            array (
                'aCode' => 'SAR',
                'aName' => 'Saudi Riyal',
            ),
        'code:941' =>
            array (
                'aCode' => 'RSD',
                'aName' => 'Serbian Dinar',
            ),
        'code:690' =>
            array (
                'aCode' => 'SCR',
                'aName' => 'Seychelles Rupee',
            ),
        'code:694' =>
            array (
                'aCode' => 'SLL',
                'aName' => 'Leone',
            ),
        'code:702' =>
            array (
                'aCode' => 'SGD',
                'aName' => 'Singapore Dollar',
            ),
        'code:994' =>
            array (
                'aCode' => 'XSU',
                'aName' => 'Sucre',
            ),
        'code:90' =>
            array (
                'aCode' => 'SBD',
                'aName' => 'Solomon Islands Dollar',
            ),
        'code:706' =>
            array (
                'aCode' => 'SOS',
                'aName' => 'Somali Shilling',
            ),
        'code:728' =>
            array (
                'aCode' => 'SSP',
                'aName' => 'South Sudanese Pound',
            ),
        'code:144' =>
            array (
                'aCode' => 'LKR',
                'aName' => 'Sri Lanka Rupee',
            ),
        'code:938' =>
            array (
                'aCode' => 'SDG',
                'aName' => 'Sudanese Pound',
            ),
        'code:968' =>
            array (
                'aCode' => 'SRD',
                'aName' => 'Surinam Dollar',
            ),
        'code:748' =>
            array (
                'aCode' => 'SZL',
                'aName' => 'Lilangeni',
            ),
        'code:752' =>
            array (
                'aCode' => 'SEK',
                'aName' => 'Swedish Krona',
            ),
        'code:947' =>
            array (
                'aCode' => 'CHE',
                'aName' => 'WIR Euro',
            ),
        'code:948' =>
            array (
                'aCode' => 'CHC',
                'aName' => 'WIR Franc (for electronic)',
            ),
        'code:760' =>
            array (
                'aCode' => 'SYP',
                'aName' => 'Syrian Pound',
            ),
        'code:901' =>
            array (
                'aCode' => 'TWD',
                'aName' => 'New Taiwan Dollar',
            ),
        'code:972' =>
            array (
                'aCode' => 'TJS',
                'aName' => 'Somoni',
            ),
        'code:834' =>
            array (
                'aCode' => 'TZS',
                'aName' => 'Tanzanian Shilling',
            ),
        'code:764' =>
            array (
                'aCode' => 'THB',
                'aName' => 'Baht',
            ),
        'code:776' =>
            array (
                'aCode' => 'TOP',
                'aName' => 'Pa’anga',
            ),
        'code:780' =>
            array (
                'aCode' => 'TTD',
                'aName' => 'Trinidad and Tobago Dollar',
            ),
        'code:788' =>
            array (
                'aCode' => 'TND',
                'aName' => 'Tunisian Dinar',
            ),
        'code:949' =>
            array (
                'aCode' => 'TRY',
                'aName' => 'New Turkish Lira',
            ),
        'code:934' =>
            array (
                'aCode' => 'TMT',
                'aName' => 'Turkmenistan New Manat',
            ),
        'code:800' =>
            array (
                'aCode' => 'UGX',
                'aName' => 'Uganda Shilling',
            ),
        'code:980' =>
            array (
                'aCode' => 'UAH',
                'aName' => 'Hryvnia',
            ),
        'code:784' =>
            array (
                'aCode' => 'AED',
                'aName' => 'UAE Dirham',
            ),
        'code:997' =>
            array (
                'aCode' => 'USN',
                'aName' => 'US Dollar (Next day)',
            ),
        'code:858' =>
            array (
                'aCode' => 'UYU',
                'aName' => 'Peso Uruguayo',
            ),
        'code:940' =>
            array (
                'aCode' => 'UYI',
                'aName' => 'Uruguay Peso en Unidades Indexadas (URUIURUI)',
            ),
        'code:860' =>
            array (
                'aCode' => 'UZS',
                'aName' => 'Uzbekistan Sum',
            ),
        'code:548' =>
            array (
                'aCode' => 'VUV',
                'aName' => 'Vatu',
            ),
        'code:937' =>
            array (
                'aCode' => 'VEF',
                'aName' => 'Bolivar',
            ),
        'code:704' =>
            array (
                'aCode' => 'VND',
                'aName' => 'Dong',
            ),
        'code:886' =>
            array (
                'aCode' => 'YER',
                'aName' => 'Yemeni Rial',
            ),
        'code:967' =>
            array (
                'aCode' => 'ZMW',
                'aName' => 'Zambian Kwacha',
            ),
        'code:932' =>
            array (
                'aCode' => 'ZWL',
                'aName' => 'Zimbabwe Dollar',
            ),
        'code:955' =>
            array (
                'aCode' => 'XBA',
                'aName' => 'Bond Markets Unit European Composite Unit (EURCO)',
            ),
        'code:956' =>
            array (
                'aCode' => 'XBB',
                'aName' => 'Bond Markets Unit European Monetary Unit (E.M.U.-6)',
            ),
        'code:957' =>
            array (
                'aCode' => 'XBC',
                'aName' => 'Bond Markets Unit European Unit of Account 9 (E.U.A.-9)',
            ),
        'code:958' =>
            array (
                'aCode' => 'XBD',
                'aName' => 'Bond Markets Unit European Unit of Account 17 (E.U.A.-17)',
            ),
        'code:963' =>
            array (
                'aCode' => 'XTS',
                'aName' => 'Codes specifically reserved for testing purposes',
            ),
        'code:999' =>
            array (
                'aCode' => 'XXX',
                'aName' => 'The codes assigned for transactions where no currency is involved',
            ),
        'code:959' =>
            array (
                'aCode' => 'XAU',
                'aName' => 'Gold',
            ),
        'code:964' =>
            array (
                'aCode' => 'XPD',
                'aName' => 'Palladium',
            ),
        'code:962' =>
            array (
                'aCode' => 'XPT',
                'aName' => 'Platinum',
            ),
        'code:961' =>
            array (
                'aCode' => 'XAG',
                'aName' => 'Silver',
            ),
        'code:4' =>
            array (
                'aCode' => 'AFA',
                'aName' => 'Afghani',
            ),
        'code:246' =>
            array (
                'aCode' => 'FIM',
                'aName' => 'Markka',
            ),
        'code:20' =>
            array (
                'aCode' => 'ADP',
                'aName' => 'Andorran Peseta',
            ),
        'code:724' =>
            array (
                'aCode' => 'ESP',
                'aName' => 'Spanish Peseta',
            ),
        'code:250' =>
            array (
                'aCode' => 'FRF',
                'aName' => 'French Franc',
            ),
        'code:24' =>
            array (
                'aCode' => 'AON',
                'aName' => 'New Kwanza',
            ),
        'code:982' =>
            array (
                'aCode' => 'AOR',
                'aName' => 'Kwanza Reajustado',
            ),
        'code:810' =>
            array (
                'aCode' => 'RUR',
                'aName' => 'Russian Ruble',
            ),
        'code:40' =>
            array (
                'aCode' => 'ATS',
                'aName' => 'Schilling',
            ),
        'code:945' =>
            array (
                'aCode' => 'AYM',
                'aName' => 'Azerbaijan Manat',
            ),
        'code:31' =>
            array (
                'aCode' => 'AZM',
                'aName' => 'Azerbaijanian Manat',
            ),
        'code:974' =>
            array (
                'aCode' => 'BYR',
                'aName' => 'Belarusian Ruble',
            ),
        'code:112' =>
            array (
                'aCode' => 'BYB',
                'aName' => 'Belarusian Ruble',
            ),
        'code:993' =>
            array (
                'aCode' => 'BEC',
                'aName' => 'Convertible Franc',
            ),
        'code:56' =>
            array (
                'aCode' => 'BEF',
                'aName' => 'Belgian Franc',
            ),
        'code:992' =>
            array (
                'aCode' => 'BEL',
                'aName' => 'Financial Franc',
            ),
        'code:70' =>
            array (
                'aCode' => 'BAD',
                'aName' => 'Dinar',
            ),
        'code:76' =>
            array (
                'aCode' => 'BRN',
                'aName' => 'New Cruzado',
            ),
        'code:987' =>
            array (
                'aCode' => 'BRR',
                'aName' => 'Cruzeiro Real',
            ),
        'code:100' =>
            array (
                'aCode' => 'BGL',
                'aName' => 'Lev',
            ),
        'code:196' =>
            array (
                'aCode' => 'CYP',
                'aName' => 'Cyprus Pound',
            ),
        'code:200' =>
            array (
                'aCode' => 'CSK',
                'aName' => 'Koruna',
            ),
        'code:218' =>
            array (
                'aCode' => 'ECS',
                'aName' => 'Sucre',
            ),
        'code:983' =>
            array (
                'aCode' => 'ECV',
                'aName' => 'Unidad de Valor Constante (UVC)',
            ),
        'code:226' =>
            array (
                'aCode' => 'GQE',
                'aName' => 'Ekwele',
            ),
        'code:233' =>
            array (
                'aCode' => 'EEK',
                'aName' => 'Kroon',
            ),
        'code:954' =>
            array (
                'aCode' => 'XEU',
                'aName' => 'European Currency Unit (E.C.U)',
            ),
        'code:268' =>
            array (
                'aCode' => 'GEK',
                'aName' => 'Georgian Coupon',
            ),
        'code:278' =>
            array (
                'aCode' => 'DDM',
                'aName' => 'Mark der DDR',
            ),
        'code:276' =>
            array (
                'aCode' => 'DEM',
                'aName' => 'Deutsche Mark',
            ),
        'code:288' =>
            array (
                'aCode' => 'GHC',
                'aName' => 'Cedi',
            ),
        'code:939' =>
            array (
                'aCode' => 'GHP',
                'aName' => 'Ghana Cedi',
            ),
        'code:300' =>
            array (
                'aCode' => 'GRD',
                'aName' => 'Drachma',
            ),
        'code:624' =>
            array (
                'aCode' => 'GWP',
                'aName' => 'Guinea-Bissau Peso',
            ),
        'code:380' =>
            array (
                'aCode' => 'ITL',
                'aName' => 'Italian Lira',
            ),
        'code:372' =>
            array (
                'aCode' => 'IEP',
                'aName' => 'Irish Pound',
            ),
        'code:428' =>
            array (
                'aCode' => 'LVR',
                'aName' => 'Latvian Ruble',
            ),
        'code:991' =>
            array (
                'aCode' => 'ZAL',
                'aName' => 'Financial Rand',
            ),
        'code:440' =>
            array (
                'aCode' => 'LTT',
                'aName' => 'Talonas',
            ),
        'code:989' =>
            array (
                'aCode' => 'LUC',
                'aName' => 'Luxembourg Convertible Franc',
            ),
        'code:442' =>
            array (
                'aCode' => 'LUF',
                'aName' => 'Luxembourg Franc',
            ),
        'code:988' =>
            array (
                'aCode' => 'LUL',
                'aName' => 'Luxembourg Financial Franc',
            ),
        'code:450' =>
            array (
                'aCode' => 'MGF',
                'aName' => 'Malagasy Franc',
            ),
        'code:466' =>
            array (
                'aCode' => 'MLF',
                'aName' => 'Mali Franc',
            ),
        'code:470' =>
            array (
                'aCode' => 'MTL',
                'aName' => 'Maltese Lira',
            ),
        'code:508' =>
            array (
                'aCode' => 'MZM',
                'aName' => 'Mozambique Metical',
            ),
        'code:528' =>
            array (
                'aCode' => 'NLG',
                'aName' => 'Netherlands Guilder',
            ),
        'code:616' =>
            array (
                'aCode' => 'PLZ',
                'aName' => 'Zloty',
            ),
        'code:620' =>
            array (
                'aCode' => 'PTE',
                'aName' => 'Portuguese Escudo',
            ),
        'code:642' =>
            array (
                'aCode' => 'ROL',
                'aName' => 'Old Leu',
            ),
        'code:891' =>
            array (
                'aCode' => 'YUM',
                'aName' => 'New Dinar',
            ),
        'code:703' =>
            array (
                'aCode' => 'SKK',
                'aName' => 'Slovak Koruna',
            ),
        'code:705' =>
            array (
                'aCode' => 'SIT',
                'aName' => 'Tolar',
            ),
        'code:996' =>
            array (
                'aCode' => 'ESA',
                'aName' => 'Spanish Peseta',
            ),
        'code:995' =>
            array (
                'aCode' => 'ESB',
                'aName' => '"A" Account (convertible Peseta Account)',
            ),
        'code:736' =>
            array (
                'aCode' => 'SDD',
                'aName' => 'Sudanese Dinar',
            ),
        'code:740' =>
            array (
                'aCode' => 'SRG',
                'aName' => 'Surinam Guilder',
            ),
        'code:762' =>
            array (
                'aCode' => 'TJR',
                'aName' => 'Tajik Ruble',
            ),
        'code:626' =>
            array (
                'aCode' => 'TPE',
                'aName' => 'Timor Escudo',
            ),
        'code:792' =>
            array (
                'aCode' => 'TRL',
                'aName' => 'Old Turkish Lira',
            ),
        'code:795' =>
            array (
                'aCode' => 'TMM',
                'aName' => 'Turkmenistan Manat',
            ),
        'code:804' =>
            array (
                'aCode' => 'UAK',
                'aName' => 'Karbovanet',
            ),
        'code:998' =>
            array (
                'aCode' => 'USS',
                'aName' => 'US Dollar (Same day)',
            ),
        'code:862' =>
            array (
                'aCode' => 'VEB',
                'aName' => 'Bolivar',
            ),
        'code:720' =>
            array (
                'aCode' => 'YDD',
                'aName' => 'Yemeni Dinar',
            ),
        'code:890' =>
            array (
                'aCode' => 'YUN',
                'aName' => 'Yugoslavian Dinar',
            ),
        'code:180' =>
            array (
                'aCode' => 'ZRZ',
                'aName' => 'Zaire',
            ),
        'code:894' =>
            array (
                'aCode' => 'ZMK',
                'aName' => 'Zambian Kwacha',
            ),
        'code:716' =>
            array (
                'aCode' => 'ZWD',
                'aName' => 'Zimbabwe Dollar',
            ),
        'code:942' =>
            array (
                'aCode' => 'ZWN',
                'aName' => 'Zimbabwe Dollar (new)',
            ),
        'code:935' =>
            array (
                'aCode' => 'ZWR',
                'aName' => 'Zimbabwe Dollar',
            ),
    )

    ;

    protected function getCurrencyAlphabeticCode(int $code): string
    {
        if (array_key_exists("code:$code", $this->currencyCodeMapping)) {
            return $this->currencyCodeMapping["code:$code"]['aCode'] ?? '';
        }

        throw new \Exception("Currency mapping ISO 4217 (without withdrawal codes) not contains $code");
    }


}