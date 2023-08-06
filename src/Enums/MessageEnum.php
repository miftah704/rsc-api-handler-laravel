<?php

namespace Mivu\Enums;

enum MessageEnum: string
{
    case available_en = 'Great, The data is available.';
    case unavailable_en = 'Sorry, The data is not available.';
    case available_id = 'Selamat, Data tersedia.';
    case unavailable_id = 'Maaf, Data tidak tersedia.';
    case error_retrieving_en = 'Error retrieving data: ';
    case error_retrieving_id = 'Galat mengambil Data: ';
}
