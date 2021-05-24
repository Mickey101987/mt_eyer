<?php

/**
 * Hydrate a collection of objects with data from an array with multiple items.
 *
 * @template T
 *
 * @param array $items The items
 * @param class-string<T> $class The FQN
 *
 * @return T[] The list of object
 */
function hydrate(array $items, string $class): array
{
    /** @var T[] $result */
    $result = [];

    foreach ($items as $item) {
        $result[] = new $class($item);
    }

    return $result;
}

/**
 * @return array[]
 */
function communalMap():array
{
    return array(
        array(
            'country' => array(
                'name_fr' => 'CAMEROUN',
                'name_en' => 'CAMEROON',
                'iso' => 'CM',
                'devise' => 'XAF_BEAC'
            ),
            'region' => array(
                'name' => 'EST',
                'area' => '109011 km²',
                'density' => '6.9 h/km²',
                'capital' => 'BERTOUA'
            ),
            'division' => array(
                'name' => 'LOM ET DJEREM',
                'capital' => 'BERTOUA'
            ),
            'commune' => array(
                'BERTOUA 1er',
                'BERTOUA 2e',
                'BETARE-OYA',
                'BELABO',
                'GAROUA-BOULAÏ',
                'DIANG',
                'MANDJOU',
                'NGOURA')
        ),
        array(
            'country' => array(
                'name_fr' => 'CAMEROUN',
                'name_en' => 'CAMEROON',
                'iso' => 'CM',
                'devise' => 'XAF_BEAC'
            ),
            'region' => array(
                'name' => 'EST',
                'area' => '109011 km²',
                'density' => '6.9 h/km²',
                'capital' => 'BERTOUA'
            ),
            'division' => array(
                'name' => 'HAUT NYONG',
                'capital' => 'ABONG-MBANG'
            ),
            'commune' => array(
                'ABONG-MBANG',
                'ANGOSSAS',
                'ATOK',
                'DIMAKO',
                'DOUMAINTANG',
                'DOUME',
                'LOMIE',
                'MBOMA',
                'MESSAMENA',
                'MESSOK',
                'MINDOUROU',
                'NGOYLA',
                'NGUELEMENDOUKA',
                'SOMALOMO')
        ),
        array(
            'country' => array(
                'name_fr' => 'CAMEROUN',
                'name_en' => 'CAMEROON',
                'iso' => 'CM',
                'devise' => 'XAF_BEAC'
            ),
            'region' => array(
                'name' => 'EST',
                'area' => '109011 km²',
                'density' => '6.9 h/km²',
                'capital' => 'BERTOUA'
            ),
            'division' => array(
                'name' => 'KADEY',
                'capital' => 'BATOURI'
            ),
            'commune' => array(
                'BATOURI',
                'NDELELE',
                'KETTE',
                'MBANG',
                'KENZOU',
                'NGUELEBOK',
                'OULI')
        ),
        array(
            'country' => array(
                'name_fr' => 'CAMEROUN',
                'name_en' => 'CAMEROON',
                'iso' => 'CM',
                'devise' => 'XAF_BEAC'
            ),
            'region' => array(
                'name' => 'EST',
                'area' => '109011 km²',
                'density' => '6.9 h/km²',
                'capital' => 'BERTOUA'
            ),
            'division' => array(
                'name' => 'BOUMBA ET NGOKO',
                'capital' => 'YOKADOUMA'
            ),
            'commune' => array(
                'MOLOUNDOU',
                'SALAPOUMBE',
                'GARI-GOMBO',
                'YOKADOUMA')
        )
    );
}
