<?php declare(strict_types=1);

namespace Lemonade\DataLayer;

/**
 * @Currency
 * @\Lemonade\DataLayer\Currency
 */
enum Currency: string
{

    case CZK = 'CZK';
    case EUR = 'EUR';
    case USD = 'USD';
    case GBP = 'GBP';
    case HRK = 'HRK';
    case HUF = 'HUF';
    case PLN = 'PLN';
    case RON = 'RON';
    case NOK = 'NOK';
    case SEK = 'SEK';

}