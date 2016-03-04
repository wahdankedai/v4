<?php 

return [
    "renstra" => '2011-2015',
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

        /**
         * Renstra Outcome
         */
        
        'add_indikator_outcome_renstra' => true,
        'edit_indikator_outcome_renstra' => true,
        'delete_indikator_outcome_renstra' => true,

        /**
         * Renstra output
         */
        
        'add_indikator_output_renstra' => true,
        'edit_indikator_output_renstra' => true,
        'delete_indikator_output_renstra' => true,

        /**
         * anggaran renstra
         */
        'anggaran_renstra' => [
            "awal" => true,
            "tahun1" => true,
            "tahun2" => true,
            "tahun3" => true,
            "tahun4" => true,
            "tahun5" => true
        ],

        /**
         * Program renstra
         */
        
        "add_program_renstra" => true,
        "delete_program_renstra" => true,

        /**
         * Kegiatan renstra
         */
        
        "add_kegiatan_renstra" => true,
        "delete_kegiatan_renstra" => true,
    ]

    
];