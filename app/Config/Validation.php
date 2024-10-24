<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $createTagihan = [
        'pelanggan_id'          => 'required|is_natural_no_zero',
        'total_pemakaian'       => 'required|is_natural_no_zero',
        'pemakaian_bulan_lalu'  => 'required',
        'pemakaian_bulan_ini'   => 'required|is_natural_no_zero',
        'total_tagihan'         => 'required|is_natural_no_zero'
    ];

    public array $createTagihan_errors = [
        'total_pemakaian' => [
            'required' => 'Kolom ini tidak boleh kosong',
            'is_natural_no_zero' => 'Total pemakaian tidak boleh ber-nilai negatif'
        ],
        'pelanggan_id' => [
            'required' => 'Kolom ini tidak boleh kosong',
        ],
        'pemakaian_bulan_lalu' => [
            'required' => 'Kolom ini tidak boleh kosong',
        ],
        'pemakaian_bulan_ini' => [
            'required' => 'Kolom ini tidak boleh kosong'
        ],
        'total_tagihan' => [
            'required' => 'Kolom ini tidak boleh kosong',
            'is_natural_no_zero' => 'Total tagihan tidak boleh ber-nilai negatif'
        ],
    ];
}
