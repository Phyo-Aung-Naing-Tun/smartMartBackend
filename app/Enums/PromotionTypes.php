<?
namespace App\Enums;

enum PromotionTypes: string
{
    case PERCENTAGE = 'percentage';
    case FIXED = 'fixed';
    case BY_ONE_GET_ONE = 'buy_one_get_one';
}