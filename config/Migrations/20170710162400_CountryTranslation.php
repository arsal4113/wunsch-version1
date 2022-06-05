<?php
use Migrations\AbstractMigration;
class CountryTranslation extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('translation_core_countries');
        $table->addColumn('locale', 'string', [
            'limit'   => 6,
            'null'    => false,
        ]);
        $table->addColumn('model', 'string', [
            'limit'   => 255,
            'null'    => false,
        ]);
        $table->addColumn('foreign_key', 'integer', [
            'limit'   => 11,
            'null'    => false,
        ]);
        $table->addColumn('field', 'string', [
            'limit'   => 255,
            'null'    => false,
        ]);
        $table->addColumn('content', 'text', [
            'null'    => false,
        ]);
        $table->addIndex(['locale', 'model', 'foreign_key', 'field'], ['unique' => true, 'name' => 'I18N_LOCALE_FIELD']);
        $table->addIndex(['model', 'foreign_key', 'field'], ['unique' => false, 'name' => 'I18N_FIELD']);
        $table->create();


        $this->execute("
	   		    UPDATE `core_countries` SET `name` = 'Germany'
	   		    WHERE `core_countries`.`name` = 'Deutschland';
	   		    UPDATE `core_countries` SET `name` = 'Spain'
	   		    WHERE `core_countries`.`name` = 'España';
	   		    UPDATE `core_countries` SET `name` = 'Italy'
	   		    WHERE `core_countries`.`name` = 'Italia';
	   		    UPDATE `core_countries` SET `name` = 'Austria'
	   		    WHERE `core_countries`.`name` = 'Österreich';
	   	        ");

        $en = [
            'Germany',
            'Spain',
            'Italy',
            'France',
            'Russia',
            'Ukraine',
            'Israel',
            'Malta',
            'USA',
            'Australia',
            'Austria',
            'Hong Kong',
            'India',
            'Philippines',
            'Malaysia',
            'Singapore',
            'Canada (English)',
            'Belgium (French)',
            'Belgium (Dutch)',
            'Netherlands',
            'Switzerland',
            'Ireland',
            'Canada (French)',
            'Poland',
            'Bulgaria',
            'China',
            'Croatia',
            'Republic of Cyprus',
            'Czech Republic',
            'Denmark',
            'Estonia',
            'Finland',
            'Georgia',
            'Greece',
            'Hungary',
            'Latvia',
            'Lithuania',
            'Luxembourg',
            'Morocco',
            'Pakistan',
            'Portugal',
            'Romania',
            'Slovakia',
            'Slovenia',
            'Sweden',
            'Thailand',
            'Iceland',
            'Liechtenstein',
            'Norway',
            'Japan',
            'Turkey'
        ];

        $de = [
            'Deutschland',
            'Spanien',
            'Italien',
            'Frankreich',
            'Russland',
            'Ukraine',
            'Israel',
            'Malta',
            'USA',
            'Australien',
            'Österreich',
            'Hong Kong',
            'Indien',
            'Philippinen',
            'Malaysia',
            'Singapur',
            'Kanada (Englisch)',
            'Belgien (Französisch)',
            'Belgien (Niederländisch)',
            'Niederlande',
            'Schweiz',
            'Irland',
            'Kanada (Französisch)',
            'Polen',
            'Bulgarien',
            'China',
            'Kroatien',
            'Republik Zypern',
            'Tschechien',
            'Dänemark',
            'Estland',
            'Finnland',
            'Georgia',
            'Griechenland',
            'Ungarn',
            'Island',
            'Lettland',
            'Litauen',
            'Luxemburg',
            'Marokko',
            'Pakistan',
            'Portugal',
            'Rumänien',
            'Slowakei',
            'Slowenien',
            'Schweden',
            'Thailand',
            'Liechtenstein',
            'Norwegen',
            'Japan',
            'Türkei'
        ];

        $es = [
            'Alemania',
            'España',
            'Italia',
            'Francia',
            'Rusia',
            'Ucrania',
            'Israel',
            'Malta',
            'Estados Unidos',
            'Australia',
            'Austria',
            'Hong Kong',
            'India',
            'Filipinas',
            'Malasia',
            'Singapur',
            'Canadá (Inglés)',
            'Bélgica (Francés)',
            'Bélgica (Holandés)',
            'Países Bajos',
            'Suiza',
            'Irlanda',
            'Canadá (Francés)',
            'Polonia',
            'Bulgaria',
            'China',
            'Croacia',
            'República de Chipre',
            'República Checa',
            'Dinamarca',
            'Estonia',
            'Finlandia',
            'Georgia',
            'Grecia',
            'Hungría',
            'Islandia',
            'Letonia',
            'Lituania',
            'Luxemburgo',
            'Marruecos',
            'Pakistán',
            'Portugal',
            'Rumania',
            'Eslovaquia',
            'Eslovenia',
            'Suecia',
            'Tailandia',
            'Liechtenstein',
            'Noruega',
            'Japón',
            'Turquía'
        ];

        $fr = [
            'Allemagne',
            'Espagne',
            'Italie',
            'France',
            'Russie',
            'Ukraine',
            'Israël',
            'Malte',
            'États-Unis',
            'Australie',
            'Autriche',
            'Hong Kong',
            'Inde',
            'Philippines',
            'Malaisie',
            'Singapour',
            'Canada (Anglais)',
            'Belgique (Français)',
            'Belgique (Néerlandais)',
            'Pays-Bas',
            'Suisse',
            'Irlande',
            'Canada (Français)',
            'Pologne',
            'Bulgarie',
            'Chine',
            'Croatie',
            'République de Chypre',
            'République Tchèque',
            'Danemark',
            'Estonie',
            'Finlande',
            'Géorgie',
            'Grèce',
            'Hongrie',
            'Islande',
            'Lettonie',
            'Lituanie',
            'Luxembourg',
            'Maroc',
            'Pakistan',
            'Portugal',
            'Roumanie',
            'Slovaquie',
            'Slovénie',
            'Suède',
            'Thaïlande',
            'Liechtenstein',
            'Norvège',
            'Japon',
            'Turquie'
        ];

        $it = [
            'Germania',
            'Spagna',
            'Italia',
            'Francia',
            'Russia',
            'Ucraina',
            'Israele',
            'Malta',
            'Stati Uniti',
            'Australia',
            'Austria',
            'Hong Kong',
            'India',
            'Filippine',
            'Malesia',
            'Singapore',
            'Canada (Inglese)',
            'Belgio (Francese)',
            'Belgio (Olandese)',
            'Paesi Bassi',
            'Svizzera',
            'Irlanda',
            'Canada (Francese)',
            'Polonia',
            'Bulgaria',
            'Cina',
            'Croazia',
            'Repubblica di Cipro',
            'Repubblica Ceca',
            'Danimarca',
            'Estonia',
            'Finlandia',
            'Georgia',
            'Grecia',
            'Ungheria',
            'Islanda',
            'Lettonia',
            'Lituania',
            'Lussemburgo',
            'Marocco',
            'Pakistan',
            'Portogallo',
            'Romania',
            'Slovacchia',
            'Slovenia',
            'Svezia',
            'Tailandia',
            'Liechtenstein',
            'Norvegia',
            'Giappone',
            'Turchia'
        ];

        $data = [];

        $countries = $this->fetchAll('SELECT * FROM core_countries');
        foreach ($countries as $country) {
            if (array_search($country['name'], $en) !== false) {
                $data[] = [
                    'locale' => 'de',
                    'model' => 'CoreCountries',
                    'foreign_key' => $country['id'],
                    'field' => 'name',
                    'content' => $de[array_search($country['name'], $en)]
                ];

                $data[] = [
                    'locale' => 'es',
                    'model' => 'CoreCountries',
                    'foreign_key' => $country['id'],
                    'field' => 'name',
                    'content' => $es[array_search($country['name'], $en)]
                ];

                $data[] = [
                    'locale' => 'fr',
                    'model' => 'CoreCountries',
                    'foreign_key' => $country['id'],
                    'field' => 'name',
                    'content' => $fr[array_search($country['name'], $en)]
                ];

                $data[] = [
                    'locale' => 'it',
                    'model' => 'CoreCountries',
                    'foreign_key' => $country['id'],
                    'field' => 'name',
                    'content' => $it[array_search($country['name'], $en)]
                ];
            }
        }

        $this->insert('translation_core_countries', $data);
    }
}