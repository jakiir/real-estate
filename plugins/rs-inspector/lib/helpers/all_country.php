<?php
if (!class_exists( 'all_country' )){ 
		class all_country{
			
			//public $countryList;
			
		function __construct() {
			 //$this->create_countryList();						 
		  }
		
			  
	   function create_countryList(){
	       $countryList = array(
                    'AF' => __( 'Afghanistan', 'automobile' ),
					'AX' => __( '&#197;land Islands', 'automobile' ),
					'AL' => __( 'Albania', 'automobile' ),
					'DZ' => __( 'Algeria', 'automobile' ),
					'AD' => __( 'Andorra', 'automobile' ),
					'AO' => __( 'Angola', 'automobile' ),
					'AI' => __( 'Anguilla', 'automobile' ),
					'AQ' => __( 'Antarctica', 'automobile' ),
					'AG' => __( 'Antigua and Barbuda', 'automobile' ),
					'AR' => __( 'Argentina', 'automobile' ),
					'AM' => __( 'Armenia', 'automobile' ),
					'AW' => __( 'Aruba', 'automobile' ),
					'AU' => __( 'Australia', 'automobile' ),
					'AT' => __( 'Austria', 'automobile' ),
					'AZ' => __( 'Azerbaijan', 'automobile' ),
					'BS' => __( 'Bahamas', 'automobile' ),
					'BH' => __( 'Bahrain', 'automobile' ),
					'BD' => __( 'Bangladesh', 'automobile' ),
					'BB' => __( 'Barbados', 'automobile' ),
					'BY' => __( 'Belarus', 'automobile' ),
					'BE' => __( 'Belgium', 'automobile' ),
					'PW' => __( 'Belau', 'automobile' ),
					'BZ' => __( 'Belize', 'automobile' ),
					'BJ' => __( 'Benin', 'automobile' ),
					'BM' => __( 'Bermuda', 'automobile' ),
					'BT' => __( 'Bhutan', 'automobile' ),
					'BO' => __( 'Bolivia', 'automobile' ),
					'BQ' => __( 'Bonaire, Saint Eustatius and Saba', 'automobile' ),
					'BA' => __( 'Bosnia and Herzegovina', 'automobile' ),
					'BW' => __( 'Botswana', 'automobile' ),
					'BV' => __( 'Bouvet Island', 'automobile' ),
					'BR' => __( 'Brazil', 'automobile' ),
					'IO' => __( 'British Indian Ocean Territory', 'automobile' ),
					'VG' => __( 'British Virgin Islands', 'automobile' ),
					'BN' => __( 'Brunei', 'automobile' ),
					'BG' => __( 'Bulgaria', 'automobile' ),
					'BF' => __( 'Burkina Faso', 'automobile' ),
					'BI' => __( 'Burundi', 'automobile' ),
					'KH' => __( 'Cambodia', 'automobile' ),
					'CM' => __( 'Cameroon', 'automobile' ),
					'CA' => __( 'Canada', 'automobile' ),
					'CV' => __( 'Cape Verde', 'automobile' ),
					'KY' => __( 'Cayman Islands', 'automobile' ),
					'CF' => __( 'Central African Republic', 'automobile' ),
					'TD' => __( 'Chad', 'automobile' ),
					'CL' => __( 'Chile', 'automobile' ),
					'CN' => __( 'China', 'automobile' ),
					'CX' => __( 'Christmas Island', 'automobile' ),
					'CC' => __( 'Cocos (Keeling) Islands', 'automobile' ),
					'CO' => __( 'Colombia', 'automobile' ),
					'KM' => __( 'Comoros', 'automobile' ),
					'CG' => __( 'Congo (Brazzaville)', 'automobile' ),
					'CD' => __( 'Congo (Kinshasa)', 'automobile' ),
					'CK' => __( 'Cook Islands', 'automobile' ),
					'CR' => __( 'Costa Rica', 'automobile' ),
					'HR' => __( 'Croatia', 'automobile' ),
					'CU' => __( 'Cuba', 'automobile' ),
					'CW' => __( 'Cura&Ccedil;ao', 'automobile' ),
					'CY' => __( 'Cyprus', 'automobile' ),
					'CZ' => __( 'Czech Republic', 'automobile' ),
					'DK' => __( 'Denmark', 'automobile' ),
					'DJ' => __( 'Djibouti', 'automobile' ),
					'DM' => __( 'Dominica', 'automobile' ),
					'DO' => __( 'Dominican Republic', 'automobile' ),
					'EC' => __( 'Ecuador', 'automobile' ),
					'EG' => __( 'Egypt', 'automobile' ),
					'SV' => __( 'El Salvador', 'automobile' ),
					'GQ' => __( 'Equatorial Guinea', 'automobile' ),
					'ER' => __( 'Eritrea', 'automobile' ),
					'EE' => __( 'Estonia', 'automobile' ),
					'ET' => __( 'Ethiopia', 'automobile' ),
					'FK' => __( 'Falkland Islands', 'automobile' ),
					'FO' => __( 'Faroe Islands', 'automobile' ),
					'FJ' => __( 'Fiji', 'automobile' ),
					'FI' => __( 'Finland', 'automobile' ),
					'FR' => __( 'France', 'automobile' ),
					'GF' => __( 'French Guiana', 'automobile' ),
					'PF' => __( 'French Polynesia', 'automobile' ),
					'TF' => __( 'French Southern Territories', 'automobile' ),
					'GA' => __( 'Gabon', 'automobile' ),
					'GM' => __( 'Gambia', 'automobile' ),
					'GE' => __( 'Georgia', 'automobile' ),
					'DE' => __( 'Germany', 'automobile' ),
					'GH' => __( 'Ghana', 'automobile' ),
					'GI' => __( 'Gibraltar', 'automobile' ),
					'GR' => __( 'Greece', 'automobile' ),
					'GL' => __( 'Greenland', 'automobile' ),
					'GD' => __( 'Grenada', 'automobile' ),
					'GP' => __( 'Guadeloupe', 'automobile' ),
					'GT' => __( 'Guatemala', 'automobile' ),
					'GG' => __( 'Guernsey', 'automobile' ),
					'GN' => __( 'Guinea', 'automobile' ),
					'GW' => __( 'Guinea-Bissau', 'automobile' ),
					'GY' => __( 'Guyana', 'automobile' ),
					'HT' => __( 'Haiti', 'automobile' ),
					'HM' => __( 'Heard Island and McDonald Islands', 'automobile' ),
					'HN' => __( 'Honduras', 'automobile' ),
					'HK' => __( 'Hong Kong', 'automobile' ),
					'HU' => __( 'Hungary', 'automobile' ),
					'IS' => __( 'Iceland', 'automobile' ),
					'IN' => __( 'India', 'automobile' ),
					'ID' => __( 'Indonesia', 'automobile' ),
					'IR' => __( 'Iran', 'automobile' ),
					'IQ' => __( 'Iraq', 'automobile' ),
					'IE' => __( 'Republic of Ireland', 'automobile' ),
					'IM' => __( 'Isle of Man', 'automobile' ),
					'IL' => __( 'Israel', 'automobile' ),
					'IT' => __( 'Italy', 'automobile' ),
					'CI' => __( 'Ivory Coast', 'automobile' ),
					'JM' => __( 'Jamaica', 'automobile' ),
					'JP' => __( 'Japan', 'automobile' ),
					'JE' => __( 'Jersey', 'automobile' ),
					'JO' => __( 'Jordan', 'automobile' ),
					'KZ' => __( 'Kazakhstan', 'automobile' ),
					'KE' => __( 'Kenya', 'automobile' ),
					'KI' => __( 'Kiribati', 'automobile' ),
					'KW' => __( 'Kuwait', 'automobile' ),
					'KG' => __( 'Kyrgyzstan', 'automobile' ),
					'LA' => __( 'Laos', 'automobile' ),
					'LV' => __( 'Latvia', 'automobile' ),
					'LB' => __( 'Lebanon', 'automobile' ),
					'LS' => __( 'Lesotho', 'automobile' ),
					'LR' => __( 'Liberia', 'automobile' ),
					'LY' => __( 'Libya', 'automobile' ),
					'LI' => __( 'Liechtenstein', 'automobile' ),
					'LT' => __( 'Lithuania', 'automobile' ),
					'LU' => __( 'Luxembourg', 'automobile' ),
					'MO' => __( 'Macao S.A.R., China', 'automobile' ),
					'MK' => __( 'Macedonia', 'automobile' ),
					'MG' => __( 'Madagascar', 'automobile' ),
					'MW' => __( 'Malawi', 'automobile' ),
					'MY' => __( 'Malaysia', 'automobile' ),
					'MV' => __( 'Maldives', 'automobile' ),
					'ML' => __( 'Mali', 'automobile' ),
					'MT' => __( 'Malta', 'automobile' ),
					'MH' => __( 'Marshall Islands', 'automobile' ),
					'MQ' => __( 'Martinique', 'automobile' ),
					'MR' => __( 'Mauritania', 'automobile' ),
					'MU' => __( 'Mauritius', 'automobile' ),
					'YT' => __( 'Mayotte', 'automobile' ),
					'MX' => __( 'Mexico', 'automobile' ),
					'FM' => __( 'Micronesia', 'automobile' ),
					'MD' => __( 'Moldova', 'automobile' ),
					'MC' => __( 'Monaco', 'automobile' ),
					'MN' => __( 'Mongolia', 'automobile' ),
					'ME' => __( 'Montenegro', 'automobile' ),
					'MS' => __( 'Montserrat', 'automobile' ),
					'MA' => __( 'Morocco', 'automobile' ),
					'MZ' => __( 'Mozambique', 'automobile' ),
					'MM' => __( 'Myanmar', 'automobile' ),
					'NA' => __( 'Namibia', 'automobile' ),
					'NR' => __( 'Nauru', 'automobile' ),
					'NP' => __( 'Nepal', 'automobile' ),
					'NL' => __( 'Netherlands', 'automobile' ),
					'AN' => __( 'Netherlands Antilles', 'automobile' ),
					'NC' => __( 'New Caledonia', 'automobile' ),
					'NZ' => __( 'New Zealand', 'automobile' ),
					'NI' => __( 'Nicaragua', 'automobile' ),
					'NE' => __( 'Niger', 'automobile' ),
					'NG' => __( 'Nigeria', 'automobile' ),
					'NU' => __( 'Niue', 'automobile' ),
					'NF' => __( 'Norfolk Island', 'automobile' ),
					'KP' => __( 'North Korea', 'automobile' ),
					'NO' => __( 'Norway', 'automobile' ),
					'OM' => __( 'Oman', 'automobile' ),
					'PK' => __( 'Pakistan', 'automobile' ),
					'PS' => __( 'Palestinian Territory', 'automobile' ),
					'PA' => __( 'Panama', 'automobile' ),
					'PG' => __( 'Papua New Guinea', 'automobile' ),
					'PY' => __( 'Paraguay', 'automobile' ),
					'PE' => __( 'Peru', 'automobile' ),
					'PH' => __( 'Philippines', 'automobile' ),
					'PN' => __( 'Pitcairn', 'automobile' ),
					'PL' => __( 'Poland', 'automobile' ),
					'PT' => __( 'Portugal', 'automobile' ),
					'QA' => __( 'Qatar', 'automobile' ),
					'RE' => __( 'Reunion', 'automobile' ),
					'RO' => __( 'Romania', 'automobile' ),
					'RU' => __( 'Russia', 'automobile' ),
					'RW' => __( 'Rwanda', 'automobile' ),
					'BL' => __( 'Saint Barth&eacute;lemy', 'automobile' ),
					'SH' => __( 'Saint Helena', 'automobile' ),
					'KN' => __( 'Saint Kitts and Nevis', 'automobile' ),
					'LC' => __( 'Saint Lucia', 'automobile' ),
					'MF' => __( 'Saint Martin (French part)', 'automobile' ),
					'SX' => __( 'Saint Martin (Dutch part)', 'automobile' ),
					'PM' => __( 'Saint Pierre and Miquelon', 'automobile' ),
					'VC' => __( 'Saint Vincent and the Grenadines', 'automobile' ),
					'SM' => __( 'San Marino', 'automobile' ),
					'ST' => __( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'automobile' ),
					'SA' => __( 'Saudi Arabia', 'automobile' ),
					'SN' => __( 'Senegal', 'automobile' ),
					'RS' => __( 'Serbia', 'automobile' ),
					'SC' => __( 'Seychelles', 'automobile' ),
					'SL' => __( 'Sierra Leone', 'automobile' ),
					'SG' => __( 'Singapore', 'automobile' ),
					'SK' => __( 'Slovakia', 'automobile' ),
					'SI' => __( 'Slovenia', 'automobile' ),
					'SB' => __( 'Solomon Islands', 'automobile' ),
					'SO' => __( 'Somalia', 'automobile' ),
					'ZA' => __( 'South Africa', 'automobile' ),
					'GS' => __( 'South Georgia/Sandwich Islands', 'automobile' ),
					'KR' => __( 'South Korea', 'automobile' ),
					'SS' => __( 'South Sudan', 'automobile' ),
					'ES' => __( 'Spain', 'automobile' ),
					'LK' => __( 'Sri Lanka', 'automobile' ),
					'SD' => __( 'Sudan', 'automobile' ),
					'SR' => __( 'Suriname', 'automobile' ),
					'SJ' => __( 'Svalbard and Jan Mayen', 'automobile' ),
					'SZ' => __( 'Swaziland', 'automobile' ),
					'SE' => __( 'Sweden', 'automobile' ),
					'CH' => __( 'Switzerland', 'automobile' ),
					'SY' => __( 'Syria', 'automobile' ),
					'TW' => __( 'Taiwan', 'automobile' ),
					'TJ' => __( 'Tajikistan', 'automobile' ),
					'TZ' => __( 'Tanzania', 'automobile' ),
					'TH' => __( 'Thailand', 'automobile' ),
					'TL' => __( 'Timor-Leste', 'automobile' ),
					'TG' => __( 'Togo', 'automobile' ),
					'TK' => __( 'Tokelau', 'automobile' ),
					'TO' => __( 'Tonga', 'automobile' ),
					'TT' => __( 'Trinidad and Tobago', 'automobile' ),
					'TN' => __( 'Tunisia', 'automobile' ),
					'TR' => __( 'Turkey', 'automobile' ),
					'TM' => __( 'Turkmenistan', 'automobile' ),
					'TC' => __( 'Turks and Caicos Islands', 'automobile' ),
					'TV' => __( 'Tuvalu', 'automobile' ),
					'UG' => __( 'Uganda', 'automobile' ),
					'UA' => __( 'Ukraine', 'automobile' ),
					'AE' => __( 'United Arab Emirates', 'automobile' ),
					'GB' => __( 'United Kingdom (UK)', 'automobile' ),
					'US' => __( 'United States (US)', 'automobile' ),
					
                    );
			return $countryList;
	    }    
        
    }
}