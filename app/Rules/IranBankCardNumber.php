<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class IranBankCardNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regexPatterns = [
            // c:  لیست regex برای هر بانک
            "/(603799)\d+/",    // bank: بانک ملی                       starts_with: ۶۰۳۷۹۹
            "/(621986)\d+/",    // bank: بانک سامان                     starts_with: ۶۲۱۹۸۶
            "/(589210)\d+/",    // bank: بانک سپه                       starts_with: ۵۸۹۲۱۰
            "/(639346)\d+/",    // bank: بانک سینا                      starts_with: ۶۳۹۳۴۶
            "/(627648)\d+/",    // bank: بانک توسعه صادرات              starts_with: ۶۲۷۶۴۸
            "/(639607)\d+/",    // bank: بانک سرمایه                    starts_with: ۶۳۹۶۰۷
            "/(627961)\d+/",    // bank: بانک صنعت و معدن               starts_with: ۶۲۷۹۶۱
            "/(504706)\d+/",    // bank: بانک شهر                       starts_with: ۵۰۴۷۰۶
            "/(603770)\d+/",    // bank: بانک کشاورزی                   starts_with: ۶۰۳۷۷۰
            "/(502938)\d+/",    // bank: بانک دی                        starts_with: ۵۰۲۹۳۸
            "/(628023)\d+/",    // bank: بانک مسکن                      starts_with: ۶۲۸۰۲۳
            "/(603769)\d+/",    // bank: بانک صادرات                    starts_with: ۶۰۳۷۶۹
            "/(627760)\d+/",    // bank: پست بانک                       starts_with: ۶۲۷۷۶۰
            "/(610433)\d+/",    // bank: بانک ملت                       starts_with: ۶۱۰۴۳۳
            "/(502908)\d+/",    // bank: بانک توسعه تعاون               starts_with: ۵۰۲۹۰۸
            "/(627383)\d+/",    // bank: بانک تجارت                     starts_with: ۶۲۷۳۵۳
            "/(627412)\d+/",    // bank: بانک اقتصاد نوین               starts_with: ۶۲۷۴۱۲
            "/(589463)\d+/",    // bank: بانک رفاه                      starts_with: ۵۸۹۴۶۳
            "/(622106)\d+/",    // bank: بانک پارسیان                   starts_with: ۶۲۲۱۰۶
            "/(507677)\d+/",    // bank: موسسه نور                      starts_with: ۵۰۷۶۷۷
            "/(502229)\d+/",    // bank: بانک پاسارگاد                  starts_with: ۵۰۲۲۲۹
            "/(606256)\d+/",    // bank: موسسه ملل                      starts_with: ۶۰۶۲۵۶
            "/(639599)\d+/",    // bank: بانک قوامین                    starts_with: ۶۳۹۵۹۹
            "/(606373)\d+/",    // bank: بانک قرض الحسنه مهر ایرانیان   starts_with: ۶۰۶۳۷۳
            "/(627488)\d+/",    // bank: بانک کارآفرین                  starts_with: ۶۲۷۴۸۸
            "/(505416)\d+/",    // bank: بانک گردشگری                   starts_with: ۵۰۵۴۱۶
        ];

        $isValid = false;
        foreach ($regexPatterns as $regexPattern) {
            if (preg_match($regexPattern, $value)) {
                $isValid = true;
                break;
            }
        }
        if (!$isValid)
            $fail('The :attribute must be a valid Iran bank card number.');

    }
}
