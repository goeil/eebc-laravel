<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\LieuEvenement;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lieu_evenements')->insert(
            [
              [
                'nom'    => 'La Chapelle',
                'adresse' => 'Rue du Temple 13\n2738 Court'
              ],
              [
                'nom'    => 'Moutier',
                'adresse' => 'Rue Centrale 60\n2740 Moutier'
              ],
            ]
        );
        DB::table('organisateur_evenements')->insert(
            [
              [
                'nom'    => 'EEBC',
                'description' => '',
                'url' => 'eebc.ch',
              ],
              [
                'nom'    => 'Église baptiste de Moutier',
                'description' => 'Église sœur de la région',
                'url' => 'eebm.ch',
              ],
              [
                'nom'    => 'Église baptiste de Bienne',
                'description' => 'Église sœur de la région',
                'url' => 'eebb.ch',
              ],
              [
                'nom'    => 'Église baptiste de Tramelan',
                'description' => 'Église sœur de la région',
                'url' => 'oratoiretramelan.ch',
              ],
              [
                'nom'    => 'Soirées de louange',
                'description' => 'Œuvre partenaire',
                'url' => 'louangereconvilier.ch',
              ],
            ]
        );
        DB::table('type_evenements')->insert(
            [
              [
                'nom'    => 'Culte',
              ],
              [
                'nom'    => 'Étude biblique',
              ],
              [
                'nom'    => 'Méditation et prière',
              ],
              [
                'nom'    => 'Groupe de maison',
              ],
              [
                'nom'    => 'Groupe de jeunes',
              ],
              [
                'nom'    => 'Rencontre inter-Églises',
              ],
              [
                'nom'    => 'Concert',
              ],
              [
                'nom'    => 'Couples',
              ],
              [
                'nom'    => 'Enfants',
              ],
              [
                'nom'    => 'Membres',
              ],
            ]
        );
        DB::table('livre_bibliques')->insert(
            [
              [
                'nom'         => 'Genèse',
                'abreviation' => 'Gn',
                'ordre'       =>  1,
              ],
              [
                'nom'         => 'Exode',
                'abreviation' => 'Ex',
                'ordre'       => 2,
              ],
              [
                'nom'         => 'Lévitique',
                'abreviation' => 'Lv',
                'ordre'       => 3,
              ],
              [
                'nom'         => 'Nombres',
                'abreviation' => 'Nb',
                'ordre'       => 4,
              ],
              [
                'nom'         => 'Deutéronome',
                'abreviation' => 'Dt',
                'ordre'       => 5,
              ],
              [
                'nom'         => 'Josué',
                'abreviation' => 'Js',
                'ordre'       => 6,
              ],
              [
                'nom'         => 'Juges',
                'abreviation' => 'Jg',
                'ordre'       => 7,
              ],
              [
                'nom'         => 'Ruth',
                'abreviation' => 'Rt',
                'ordre'       =>  8,
              ],
              [
                'nom'         => '1 Samuel',
                'abreviation' => '1 S',
                'ordre'       =>  9,
              ],
              [
                'nom'         => '2 Samuel',
                'abreviation' => '2 S',
                'ordre'       =>  10,
              ],
              [
                'nom'         => '1 Rois',
                'abreviation' => '1 R',
                'ordre'       =>  11,
              ],
              [
                'nom'         => '2 Rois',
                'abreviation' => '2 R',
                'ordre'       =>  12,
              ],
              [
                'nom'         => '1 Chroniques',
                'abreviation' => '1 Ch',
                'ordre'       =>  13,
              ],
              [
                'nom'         => '2 Chroniques',
                'abreviation' => '2 Ch',
                'ordre'       =>  14,
              ],
              [
                'nom'         => 'Esdras',
                'abreviation' => 'Esd',
                'ordre'       =>  15,
              ],
              [
                'nom'         => 'Néhémie',
                'abreviation' => 'Né',
                'ordre'       =>  16,
              ],
              [
                'nom'         => 'Esther',
                'abreviation' => 'Est',
                'ordre'       =>  17,
              ],
              [
                'nom'         => 'Job',
                'abreviation' => 'Jb',
                'ordre'       =>  18,
              ],
              [
                'nom'         => 'Psaumes',
                'abreviation' => 'Ps',
                'ordre'       =>  19,
              ],
              [
                'nom'         => 'Proverbes',
                'abreviation' => 'Pr',
                'ordre'       =>  20,
              ],
              [
                'nom'         => 'Ecclésiaste',
                'abreviation' => 'Ec',
                'ordre'       =>  21,
              ],
              [
                'nom'         => 'Cantique des cantiques',
                'abreviation' => 'Ct',
                'ordre'       =>  22,
              ],
              [
                'nom'         => 'Ésaïe',
                'abreviation' => 'És',
                'ordre'       =>  23,
              ],
              [
                'nom'         => 'Jérémie',
                'abreviation' => 'Jr',
                'ordre'       =>  24,
              ],
              [
                'nom'         => 'Lamentations',
                'abreviation' => 'Lm',
                'ordre'       =>  25,
              ],
              [
                'nom'         => 'Ézéchiel',
                'abreviation' => 'Éz',
                'ordre'       =>  26,
              ],
              [
                'nom'         => 'Daniel',
                'abreviation' => 'Dn',
                'ordre'       =>  27,
              ],
              [
                'nom'         => 'Osée',
                'abreviation' => 'Os',
                'ordre'       =>  28,
              ],
              [
                'nom'         => 'Joël',
                'abreviation' => 'Jl',
                'ordre'       =>  29,
              ],
              [
                'nom'         => 'Amos',
                'abreviation' => 'Am',
                'ordre'       =>  30,
              ],
              [
                'nom'         => 'Abdias',
                'abreviation' => 'Ab',
                'ordre'       =>  31,
              ],
              [
                'nom'         => 'Jonas',
                'abreviation' => 'Jon',
                'ordre'       =>  32,
              ],
              [
                'nom'         => 'Michée',
                'abreviation' => 'Mi',
                'ordre'       =>  33,
              ],
              [
                'nom'         => 'Nahum',
                'abreviation' => 'Na',
                'ordre'       =>  34,
              ],
              [
                'nom'         => 'Habakuk',
                'abreviation' => 'Ha',
                'ordre'       =>  35,
              ],
              [
                'nom'         => 'Sophonie',
                'abreviation' => 'So',
                'ordre'       =>  36,
              ],
              [
                'nom'         => 'Aggée',
                'abreviation' => 'Ag',
                'ordre'       =>  37,
              ],
              [
                'nom'         => 'Zacharie',
                'abreviation' => 'Za',
                'ordre'       =>  38,
              ],
              [
                'nom'         => 'Malachie',
                'abreviation' => 'Ml',
                'ordre'       =>  39,
              ],
              [
                'nom'         => 'Matthieu',
                'abreviation' => 'Mt',
                'ordre'       =>  40,
              ],
              [
                'nom'         => 'Marc',
                'abreviation' => 'Mc',
                'ordre'       =>  41,
              ],
              [
                'nom'         => 'Luc',
                'abreviation' => 'Lc',
                'ordre'       =>  42,
              ],
              [
                'nom'         => 'Jean',
                'abreviation' => 'Jn',
                'ordre'       =>  43,
              ],
              [
                'nom'         => 'Actes des apôtres',
                'abreviation' => 'Ac',
                'ordre'       =>  44,
              ],
              [
                'nom'         => 'Romains',
                'abreviation' => 'Rm',
                'ordre'       =>  45,
              ],
              [
                'nom'         => '1 Corinthiens',
                'abreviation' => '1 Co',
                'ordre'       =>  46,
              ],
              [
                'nom'         => '2 Corinthiens',
                'abreviation' => '2 Co',
                'ordre'       =>  47,
              ],
              [
                'nom'         => 'Galates',
                'abreviation' => 'Gl',
                'ordre'       =>  48,
              ],
              [
                'nom'         => 'Éphésiens',
                'abreviation' => 'Ép',
                'ordre'       =>  49,
              ],
              [
                'nom'         => 'Philippiens',
                'abreviation' => 'Ph',
                'ordre'       =>  50,
              ],
              [
                'nom'         => 'Colossiens',
                'abreviation' => 'Cl',
                'ordre'       =>  51,
              ],
              [
                'nom'         => '1 Thessaloniciens',
                'abreviation' => '1 Th',
                'ordre'       =>  52,
              ],
              [
                'nom'         => '2 Thessaloniciens',
                'abreviation' => '2 Th',
                'ordre'       =>  53,
              ],
              [
                'nom'         => '1 Timothée',
                'abreviation' => '1 Tm',
                'ordre'       =>  54,
              ],
              [
                'nom'         => '2 Timothée',
                'abreviation' => '2 Tm',
                'ordre'       =>  55,
              ],
              [
                'nom'         => 'Tite',
                'abreviation' => 'Tt',
                'ordre'       =>  56,
              ],
              [
                'nom'         => 'Philémon',
                'abreviation' => 'Phm',
                'ordre'       =>  57,
              ],
              [
                'nom'         => 'Hébreux',
                'abreviation' => 'Hb',
                'ordre'       =>  58,
              ],
              [
                'nom'         => 'Jacques',
                'abreviation' => 'Jc',
                'ordre'       =>  59,
              ],
              [
                'nom'         => '1 Pierre',
                'abreviation' => '1 P',
                'ordre'       =>  60,
              ],
              [
                'nom'         => '2 Pierre',
                'abreviation' => '2 P',
                'ordre'       =>  61,
              ],
              [
                'nom'         => '1 Jean',
                'abreviation' => '1 Jn',
                'ordre'       =>  62,
              ],
              [
                'nom'         => '2 Jean',
                'abreviation' => '2 Jn',
                'ordre'       =>  63,
              ],
              [
                'nom'         => '3 Jean',
                'abreviation' => '3 Jn',
                'ordre'       =>  64,
              ],
              [
                'nom'         => 'Jude',
                'abreviation' => 'Jd',
                'ordre'       =>  65,
              ],
              [
                'nom'         => 'Apocalypse de Jean',
                'abreviation' => 'Ap',
                'ordre'       =>  66,
              ],
            ]
        );
    }
}
