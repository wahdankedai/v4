<?php 

return [
    "renstra" => '2015-2019',
    "evaluasi" => [
        /**
         *  Outcome
         */
        
        'add_indikator_outcome' => true,
        'edit_indikator_outcome' => true,
        'delete_indikator_outcome' => true,
        'edit_target_indikator_outcome' => false,

        'realisasi_outcome' => [
            "triwulan_1" => true,
            "triwulan_2" => false,
            "triwulan_3" => true,
            "triwulan_4" => true,
        ],

        /**
         * Output
         */
        
        'add_indikator_output' => true,
        'edit_indikator_output' => true,
        'delete_indikator_output' => true,
        'edit_target_indikator_output' => true,

        'realisasi_output' => [
            "triwulan_1" => true,
            "triwulan_2" => false,
            "triwulan_3" => true,
            "triwulan_4" => true,
        ],

        /**
         * anggaran
         */
        'anggaran' => [
            "target_triwulan_1" => true,
            "target_triwulan_2" => true,
            "target_triwulan_3" => true,
            "target_triwulan_4" => true,
            "realisasi_triwulan_1" => true,
            "realisasi_triwulan_2" => true,
            "realisasi_triwulan_3" => true,
            "realisasi_triwulan_4" => true,
        ],

    ]

    
];